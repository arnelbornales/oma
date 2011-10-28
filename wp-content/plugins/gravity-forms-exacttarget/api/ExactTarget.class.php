<?php
/*
	ExactTarget for PHP
	
	_______________________________________

	Copyright (C) 2011 Katz Web Services, Inc.
	Authored by Zack Katz <zack@katzwebservices.com>

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/
class ExactTarget {
	
	var $username = '';
	var $password = '';	
	var $s4 = '';
	var $debug = '';
	var $mid = '';
	
	function ExactTarget($apikey = null, $user = null, $password=null) {
		self::updateSettings($this);
	}
	
	public function updateSettings($object = false) {
		$api->lastError = '';
		$settings = get_option("gf_exacttarget_settings");
		if(!$settings || !is_array($settings)) { return; }
		foreach($settings as $key => $value) {
			if($key == 'debug') { $object->debug = !empty($value); }
			$object->{$key} = trim($value);
		}
	}
	
	public function TestAPI() {
		$xml = $this->MakeRequest('<system></system>');
		$result = $this->DoRequest($xml);
		$response = $this->getResponse($result, true);
		if(is_array($response) || $response === false) {
			return false;
		}

		return true;
	}
	
	public function AddList($name = '', $type = 'public') {
	
		$xml = self::MakeRequest('
		<system>
		    <system_name>list</system_name>\
		    <action>add</action>
		    <search_type></search_type>
		    <search_value></search_value>
		    <list_type>'.$type.'</list_type>
		    <list_name>'.$name.'</list_name>
		</system>'
		);
		
		return self::DoRequest($xml);
	}
	
	public function MakeRequest($xml = '') {
		return '
		<?xml version="1.0" ?>
		<exacttarget>
			<authorization>
				<username>'.$this->username.'</username>
				<password>'.$this->password.'</password>
			</authorization>
			'.$xml.'
		</exacttarget>';	
	}
	
	public function DoRequest($xml = '') {
	
		$args = array(
	    	'headers'=> array('Content-Type' => 'application/x-www-form-urlencoded'), 
	       	'method' => 'POST',
	    	'sslverify' => false,
	    	'timeout' => apply_filters('exacttarget_dorequest_timeout', 30)
	    );
	    
	    if($this->s4) {
	    	$url = 'https://api.s4.exacttarget.com/integrate.aspx?qf=xml&xml='.urlencode($xml);
		} else {
			$url = 'https://api.dc1.exacttarget.com/integrate.aspx?qf=xml&xml='.urlencode($xml);
		}
	    
		$result = wp_remote_request($url, $args);
		
		$this->lastRequest = $result;
		
		if(is_wp_error($result)) {
			$this->lastError = $result->get_error_message();
			$this->r($this->lastError);
			return false;
		}
		
		$body = wp_remote_retrieve_body($result);
		
		$this->r(array('URL Submitted To' => $url, 'WordPress `wp_remote_request` Settings' => $args, 'Result' => $result));
		
		return $body;
	}
	
	public function Lists($showRaw = false) {
		
		flush();
		
		if((!isset($_REQUEST['refresh']) || isset($_REQUEST['refresh']) && $_REQUEST['refresh'] !== 'lists') && !isset($_REQUEST['retrieveListNames'])) {
			
			// Is it saved already in a transient?
			$lists = get_transient('extr_lists_all');
			if(!empty($lists) && is_array($lists)) {
				return $lists;
			}
			
			// Check if raw data already exists
			$lists = get_transient('extr_lists_raw');
			if(!empty($lists) && is_array($lists)) {
				return $lists;
			}
			
		} else {
			$lists = array();
		}
		
		$xml = self::MakeRequest('
		<system>
		    <system_name>list</system_name>\
		    <action>retrieve</action>
		    <search_type>listname</search_type>
		    <search_value></search_value>
		</system>'
		);

		$result = self::DoRequest($xml);
		
		if(!$result) {
			$this->r('List retrieval failed.');
			return false;
		}
		
		$response = @simplexml_load_string($result);

		if(!empty($response->system) && !empty($response->system->list->listid) && !empty($response->system->list->listid)) {
			$i = 0; $count = sizeof($response->system->list->listid);
			
			if($count > 20 || $showRaw) {
				if(!empty($response->system) && !empty($response->system->list->listid) && !empty($response->system->list->listid)) {
					foreach($response->system->list->listid as $listid) {
						$lists["{$listid}"] = array('list_name' => (string)$listid);
					}
				}
				@set_transient('extr_lists_raw', $lists, 60*60*24*365);
			} elseif(!$showRaw) {
				foreach($response->system->list->listid as $listid) {
					$list_xml = self::ListRetrieve($listid);
					if($list_xml->system->list->list_type == 'Public') {
						$lists["{$listid}"] = (array)$list_xml->system->list;
					}
				}
				@set_transient('extr_lists_all', $lists, 60*60*24*365);
			}
			
		}
		
		return $lists;
	}
	
	public function ListRetrieve($listid = 0) {
		$list = self::DoRequest(self::MakeRequest('<system>
				    <system_name>list</system_name>
				    <action>retrieve</action>
				    <search_type>listid</search_type>    
				    <search_value>'.$listid.'</search_value>
				</system>'));
		$list_xml = @simplexml_load_string( $list );
		return $list_xml;
	}
	
	public function Attributes() {
		
		$attrs = get_transient('extr_attributes');
			
		if(!empty($attrs) && is_array($attrs) && (!isset($_REQUEST['refresh']) || isset($_REQUEST['refresh']) && $_REQUEST['refresh'] !== 'attributes')) {
			return $attrs;
		} else {
			$attrs = array();
		}
		
		$xml = self::MakeRequest('
		<system>
			<system_name>accountinfo</system_name>
			<action>retrieve_attrbs</action>
			<search_type/>
			<search_value/>
		</system>'
		);
		
		$result = self::DoRequest( $xml );
		
		if(!$result) {
			$this->r('Attribute retrieval failed.');
			return false;
		}
		
		$response = @simplexml_load_string( $result );

		if(!empty($response->system) && !empty($response->system->profile) && !empty($response->system->profile->attribute)) { 
			foreach($response->system->profile->attribute as $key => $attr) {
				
				foreach($attr as $k => $v) {
					if(!is_array($v)) {
						$attr->{$k} = (string)$v;
					}
				}
				
				$attrs[sanitize_user(str_replace(' ', '_', strtolower((string)$attr->name)), true)] = (array)$attr;
			}
		
			set_transient('extr_attributes', $attrs, 60*60*24);
			return $attrs;
		}
		return false;
	}
	
	public function AddMembership($list, $email, $additional = array(), $update = '') {
		
		if(empty($update)) {
			$this->r(array('List ID' => $list, 'Email Address' => $email, 'Mapped, Submitted Fields' => $additional));
		}
		
		$xml = '
		<system>
			<system_name>subscriber</system_name>
			<action>'; if(empty($update)) { $xml .= 'add'; } else { $xml .= 'edit'; } $xml .= '</action>
			<search_type>listid</search_type>
			<search_value>'.$list.'</search_value>
			<search_value2>'.$update.'</search_value2>
			<values>
				<Email__Address>'.$email.'</Email__Address>
				<status>active</status>';
		 foreach($additional as $key => $value) {
		 	if(empty($key)) { continue; }
		 	$newkey = str_replace(' ', '__', ucwords(str_replace('_', ' ', $key)));
		 	
		 	if(is_array($value)) {
		 		$value = esc_html(implode(', ', $value));
		 	} elseif(!preg_match('/\<\!\[CDATA\[/', $value)) { 
		 		$value = esc_html($value); 
		 	}
		 	$xml .= '
		 		<'.$newkey.'>'.$value.'</'.$newkey.'>';
		 }
		if(!empty($this->mid) && is_numeric($this->mid)) {
			$xml .= '<ChannelMemberID>'.$this->mid.'</ChannelMemberID>';
		}
		 
		 $xml .= '
			</values>';
		  if(empty($update)) { $xml .= '
			<update>true</update>'; }
		$xml .= '
		</system>';
		
		$this->r(htmlentities($xml), 'Posted XML');
		
		$xml = self::MakeRequest( $xml );
		
		$response = self::DoRequest($xml);
		
		if(!$response) {
			$this->r('Add/update subscriber failed.');
			return false;
		}
		
		$response = $this->getResponse($response);
		if($response === false || is_array($response)) {
			if($response[0] == 14) {
				$this->r($response[1],'Error 14');
				self::AddMembership($list, $email, $additional, $email);
			} else {
				$this->r($this->lastError);
				return false;
			}
		} else {
			// Return subscriber ID if successful
			$this->r($response, 'ID of Subscriber');
			return $response;
		}
		
		return true;
	}
	
	public function getResponse($response = '', $testapi = false) {
		if(preg_match('/\<error\>([0-9]+)\<\/error\>(?:\s+)?<error\_description\>(.*?)\<\/error_description\>/ism', $response, $matches)) {
			if($testapi && $matches[1] === '71') {
				$this->lastError = false;
				return $matches[1];
			}
			$this->lastError = 'Error '.$matches[1].': '.$matches[2];
			return array($matches[1], $matches[2]);
		} elseif(preg_match('/\<subscriber_description\>([0-9]+)\<\/subscriber_description\>/ism', $response, $matches)) {
			$this->lastError = false;
			return $matches[1];
		}
		return false;
	}
	
	public function errorCodeMessage($errorcode = '', $errorcontrol = '') {
		
		switch($errorcode) {  
  		        case "1" : $strError =	__("An error has occurred while attempting to save your subscriber information.", "gravity-forms-exacttarget"); break;  
                case "2" : $strError =	__("The list provided does not exist.", "gravity-forms-exacttarget"); break;  
                case "3" : $strError =	__("Information was not provided for a mandatory field. (".$errorcontrol.")", "gravity-forms-exacttarget"); break;  
                case "4" : $strError =	__("Invalid information was provided. (".$errorcontrol.")", "gravity-forms-exacttarget"); break;  
                case "5" : $strError =	__("Information provided is not unique. (".$errorcontrol.")", "gravity-forms-exacttarget"); break;  
                case "6" : $strError =	__("An error has occurred while attempting to save your subscriber information.", "gravity-forms-exacttarget"); break;  
                case "7" : $strError =	__("An error has occurred while attempting to save your subscriber information.", "gravity-forms-exacttarget"); break;  
                case "8" : $strError =	__("Subscriber already exists.", "gravity-forms-exacttarget"); break;  
                case "9" : $strError =  __("An error has occurred while attempting to save your subscriber information.", "gravity-forms-exacttarget"); break;  
                case "10" : $strError = __("An error has occurred while attempting to save your subscriber information.", "gravity-forms-exacttarget"); break;    
                case "12" : $strError =	__("The subscriber you are attempting to insert is on the master unsubscribe list or the global unsubscribe list.", "gravity-forms-exacttarget"); break;  
                case "13" : $strError =	__("Check that the list ID and/or MID specified in your code is correct.", "gravity-forms-exacttarget"); break;
                default : $strError =	__("Error", "gravity-forms-exacttarget"); break;
        }
        return $strError;
	}
	
	public function listSubscribe($lists = array(), $email = '', $merge_vars = array()) {
		
		$this->lastError = '';
		
		if(!is_array($lists)) { $lists = explode(',',$lists); }
		
		if(empty($this->mid)) {
			$this->lastError = 'The MID was not defined in the ExactTarget settings. The attempt to add the subscriber was not made.';
			$this->r($this->lastError);
			return;
		} elseif(empty($lists)) {
			$this->lastError = 'No lists were selected. The attempt to add the subscriber was not made.';
			$this->r($this->lastError);
			return;
		}
		
        $params = $merge_vars;
        
		foreach($params as $key => $p) {
			if(is_array($p)) {
				$p = implode(', ', $p);
			} else {
        		$p = rtrim(trim($p));
        	}
        	if(empty($p) && $p !== '0') {
        		unset($params[$key]);
        	} else {
	        	$params[$key] = $p;
	        }
        }
		
		
		foreach($params as $key => $value) {
		 	$newkey = ucwords(str_replace('_', ' ', $key));
		 	$params["{$newkey}"] = esc_html($value);
		 	unset($params[$key]);
		}
		
		$params['MID'] = $this->mid;
		$params['SubAction'] = 'sub_add_update';
		
		$this->r(array('List IDs' => $lists, 'Email Address' => $email, 'Mapped, Submitted Fields' => $params));
		
		
		$args = array(
			'method' => 'POST',
	    	'sslverify' => false,
	    	'timeout' => 30
	    );
	    
	    if($this->s4) {
			$url = 'http://cl.s4.exct.net/subscribe.aspx?lid='.implode('&lid=',$lists).'&'.http_build_query($params);
		} else {
			$url = 'http://cl.exct.net/subscribe.aspx?lid='.implode('&lid=',$lists).'&'.http_build_query($params);
		}
	    
		$result = wp_remote_request($url, $args);
		
		$this->r(array('URL Submitted To' => $url, 'WordPress `wp_remote_request` Settings' => $args, 'Result' => $result));
		
		$body = $result['body'];
		
		if($result['response']['code'] !== 200) {
			if($result['response']['code'] == 500) {
				$this->lastError = $body;
			} else {
				$this->lastError = 'Server error: '.$result['response']['code'].' ('.$result['response']['message'].')';
			}
		} else if(is_wp_error($result) || !$result) {
			$this->lastError = 'The form submission failed.';
		} elseif(preg_match('/action\=\"app_error\.aspx\?(.*?)"/', $body, $matches)) {
			parse_str(str_replace('&amp;', '&', $matches[1]), $error);
			$this->lastError = $this->errorCodeMessage($error['errorcode'], $error['errorcontrol']);
		} else {
			$this->lastError = '';
			$this->r('It seems the form was successfully submitted.', 'Contact Creation Success');
			return true;
		}
		
		$this->r($this->lastError, 'Contact Creation Failure');
		return false;
        
	}
	
	function r($debugging = '', $title = '') {
		if($this->debug && current_user_can('manage_options') && !is_admin()) {
			echo '<div style="background-color:white;border:1px solid #ccc; padding:10px; margin:6px; position:relative; font-size:14px;">
				<p style="text-align:center; color:#ccc; margin:0; padding:0; position:absolute; right:.5em; top:.5em;">Admin-only Debugging Results</p>
			';
				if($title) {
					echo '<h3>'.$title.'</h3>';
				}
				echo '<pre>';
					print_r($debugging);
				echo '</pre>
			</div>';
		}
	}
}