<?php
/*
Plugin Name: WordPress Post Tabs
Plugin URI: http://www.clickonf5.org/wordpress-post-tabs/
Description: WordPress Post Tabs will help you to easily display your WordPress Post or Page sections in structured tabs, so that if you are writing some review post, you can add distinct tabs representing each section of the review like overview, specifications, performance, final rating and so on. Watch Live Demo at <a href="http://www.clickonf5.org/wordpress-post-tabs/">Plugin Page</a>.
Version: 1.3.1	
Author: Internet Techies
Author URI: http://www.clickonf5.org/about/tejaswini
WordPress version supported: 2.8 and above
*/

/*  Copyright 2010  Internet Techies  (email : tedeshpa@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
if ( ! defined( 'WPTS_PLUGIN_BASENAME' ) )
	define( 'WPTS_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
function wpts_url( $path = '' ) {
	global $wp_version;
	if ( version_compare( $wp_version, '2.8', '<' ) ) { // Using WordPress 2.7
		$folder = dirname( plugin_basename( __FILE__ ) );
		if ( '.' != $folder )
			$path = path_join( ltrim( $folder, '/' ), $path );

		return plugins_url( $path );
	}
	return plugins_url( $path, __FILE__ );
}
//on activation, your WordPress Post Tabs options will be populated. Here a single option is used which is actually an array of multiple options
function activate_wpts() {
	$wpts_opts1 = get_option('wpts_options');
	if(isset($wpts_opts1) and $wpts_opts1['speed']=='1'){
		$pages=$wpts_opts1['pages'];
		$posts=$wpts_opts1['posts'];
		if(empty($pages) or !isset($pages)) {
		  $wpts_opts1['pages']='0';
		}
		if(empty($posts) or !isset($posts)) {
		  $wpts_opts1['posts']='0';
		}
	}
	$wpts_opts2 =array('speed' => '1',
	                   'transition' => '',
					   'pages' => '1',
					   'posts' => '1',
					   'stylesheet' => 'default',
					   'reload' => '0',
					   'tab_code' => 'tab',
					   'tab_end_code' => 'end_tabset',
					   'support' => '1', 
					   'fade' => '0', 
					   'jquerynoload' => '0',
					   'disable_cookies'=>'0',
					   'nav'=>'0',
					   'next_text'=>'Next &#187;',
					   'prev_text'=>'&#171; Prev',
					   'enable_everywhere'=>'0',
					   'disable_fouc'=>'0');
	if ($wpts_opts1) {
	    $wpts = $wpts_opts1 + $wpts_opts2;
		update_option('wpts_options',$wpts);
	}
	else {
		$wpts_opts1 = array();	
		$wpts = $wpts_opts1 + $wpts_opts2;
		add_option('wpts_options',$wpts);		
	}
}

register_activation_hook( __FILE__, 'activate_wpts' );
global $wpts;
$wpts = get_option('wpts_options');
define("WPTS_VER","1.3.1",false);
define('WPTS_URLPATH', trailingslashit( WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) ) );

function wpts_wp_init() {
    global $post,$wpts;
	if(is_singular() or $wpts['enable_everywhere'] == '1') { 
		$enablewpts = get_post_meta($post->ID, 'enablewpts', true);
		if( (is_page() and ((!empty($enablewpts) and $enablewpts=='1') or  $wpts['pages'] != '0'  ) ) 
			or (is_single() and ((!empty($enablewpts) and $enablewpts=='1') or $wpts['posts'] != '0'  ) ) or $wpts['enable_everywhere'] == '1' ) 
		{
			$css="css/styles/".$wpts['stylesheet'].'/style.css';
			wp_enqueue_style( 'wpts_ui_css', wpts_url( $css ),false, WPTS_VER, 'all'); 
			if(isset($wpts['jquerynoload']) and $wpts['jquerynoload']=='1') {
			    wp_deregister_script( 'jquery' );
				if(!isset($wpts['disable_cookies']) or $wpts['disable_cookies']!='1'){ 
					wp_enqueue_script('wpts_ui_cookie', wpts_url( 'js/jquery.cookie.js'), array('jquery-ui-core','jquery-ui-tabs'), WPTS_VER, true );
				}
				else{
				    wp_enqueue_script('jquery-ui-tabs', false, array('jquery-ui-core'), WPTS_VER, true);
				}
			}
			else{
			    if(!isset($wpts['disable_cookies']) or $wpts['disable_cookies']!='1'){
					wp_enqueue_script('wpts_ui_cookie', wpts_url( 'js/jquery.cookie.js'), array('jquery','jquery-ui-core','jquery-ui-tabs'), WPTS_VER, true );
				}
				else{
				    wp_enqueue_script('jquery-ui-tabs', false, array('jquery-ui-core'), WPTS_VER, true);
				}
			}
			global $wpts_count,$wpts_tab_count,$wpts_content,$wpts_prev_post;
			$wpts_count=0;
			$wpts_tab_count=0;
			$wpts_prev_post='';
			$wpts_content=array();
		}
	}
}
add_action( 'wp', 'wpts_wp_init' );

function wpts_edit_custom_box(){
	global $post;
	echo '<input type="hidden" name="enablewpts_noncename" id="enablewpts_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) . '" />'; 	?>
	<?php
			$enablewpts = get_post_meta($post->ID,'enablewpts',true);
			if($enablewpts=="1"){
				$checked = ' checked="checked" ';
			}else{
				$checked = '';
			}
	?>
		<p><input type="checkbox" id="enablewpts" name="enablewpts" value="1" <?php echo $checked;?> />&nbsp;<label for="enablewpts"><strong>Enable Post/Page Tabs Feature</strong></label></p>
	<?php
}
/* Prints the edit form for pre-WordPress 2.5 post/page */
function wpts_old_custom_box() {

  echo '<div class="dbx-b-ox-wrapper">' . "\n";
  echo '<fieldset id="myplugin_fieldsetid" class="dbx-box">' . "\n";
  echo '<div class="dbx-h-andle-wrapper"><h3 class="dbx-handle">' . 
        __( 'Post/Page Tabs', 'wordpress-post-tabs' ) . "</h3></div>";   
   
  echo '<div class="dbx-c-ontent-wrapper"><div class="dbx-content">';

  // output editing form

  wpts_edit_custom_box();

  // end wrapper

  echo "</div></div></fieldset></div>\n";
}
function wpts_add_custom_box() {
	if( function_exists( 'add_meta_box' ) ) {
		add_meta_box( 'wpts_box1', __( 'Post Tabs' ), 'wpts_edit_custom_box', 'post', 'side','high' );
		//add_meta_box( $id,   $title,     $callback,   $page, $context, $priority ); 
		add_meta_box( 'wpts_box2', __( 'Page Tabs' ), 'wpts_edit_custom_box', 'page', 'advanced' );
	} else {
		add_action('dbx_post_advanced', 'myplugin_old_custom_box' );
		add_action('dbx_page_advanced', 'myplugin_old_custom_box' );
	}
}
/* Use the admin_menu action to define the custom boxes */
add_action('admin_menu', 'wpts_add_custom_box');

function wpts_savepost(){
	global $post;
	$post_id = $post->ID;
	// verify this came from the our screen and with proper authorization,
	  // because save_post can be triggered at other times
	  if ( !wp_verify_nonce( $_POST['enablewpts_noncename'], plugin_basename(__FILE__) )) {
		return $post_id;
	  }
	  // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
	  // to do anything
	  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;
	  // Check permissions
	  if ( 'page' == $_POST['post_type'] ) {
		if ( !current_user_can( 'edit_page', $post_id ) )
		  return $post_id;
	  } else {
		if ( !current_user_can( 'edit_post', $post_id ) )
		  return $post_id;
	  }
	  // OK, we're authenticated: we need to find and save the data
	$data =  ($_POST['enablewpts'] == "1") ? "1" : "0";
	update_post_meta($post_id, 'enablewpts', $data);
	return $data;
}
add_action('save_post', 'wpts_savepost');

function wpts_tab_shortcode($atts,$content) {
	extract(shortcode_atts(array(
		'name' => 'Tab Name',
	), $atts));
	
    global $wpts;
	global $wpts_content,$wpts_tab_count,$wpts_count;
	$wpts_content[$wpts_tab_count]['name'] = $name;
	$wpts_content[$wpts_tab_count]['content'] = do_shortcode($content);
    $wpts_tab_count = $wpts_tab_count+1;
		
	if(is_feed()){
	  $return = '<h4>'.$name.'</h4>'.$content;
	  return $return;
	}
    return null;
}
add_shortcode($wpts['tab_code'], 'wpts_tab_shortcode');
function wpts_end_shortcode($atts) {
 if(is_feed()){
   return null;
 }
 
 global $wpts,$post;
 global $wpts_content,$wpts_tab_count,$wpts_count,$wpts_prev_post;
 
 $post_id = $post->ID;
 
 if($wpts_prev_post!=$post_id){$wpts_count=0;}

	if(is_singular() or $wpts['enable_everywhere'] == '1') {
		
		if($wpts_tab_count!=0 and isset($wpts_tab_count)) {
			 $tab_content = '<ul>';
			  for($i=0;$i<$wpts_tab_count;$i++) {
			    if($wpts['reload']=='1') {
			     $onclick = 'onclick="return wptReload(\'tabs-'.$post_id.'-'.$wpts_count.'-'.$i.'\')"'; }
				else {
				 $onclick = '';
				}
				$pageurl="http://" . $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI'];
				$tab_content = $tab_content.'<li><a href="'.$pageurl.'#tabs-'.$post_id.'-'.$wpts_count.'-'.$i.'" '.$onclick.'>'.$wpts_content[$i]['name'].'</a></li>';
			  }
			 $tab_content = $tab_content.'</ul>';
			 for($i=0;$i<$wpts_tab_count;$i++) {
			    $tab_html='<div id="tabs-'.$post_id.'-'.$wpts_count.'-'.$i.'"><p>'.$wpts_content[$i]['content'].'</p></div>';
				$tab_html=str_replace('<p></p>','',$tab_html);
				$tab_html=str_replace('<p> </p>','',$tab_html);
				$tab_content = $tab_content.$tab_html;
			 }
		}
        if($wpts['disable_fouc']=='1'){$hide='class="wpts-hide"';}else {$hide='';}
		$tab_content = '<div id="tabs_'.$post_id.'_'.$wpts_count.'" '.$hide.'>'.$tab_content.'<div class="cf5_wpts_cl"></div><div class="cf5_wpts_cr"></div></div>';
		
		$wpts_count = $wpts_count+1;
		$wpts_tab_count = 0;
		
		$script = '';

		global $post;
		$post_id = $post->ID;
		$enablewpts = get_post_meta($post->ID, 'enablewpts', true);
		if( (!empty($enablewpts) and $enablewpts=='1') or $wpts['posts'] != '0'  ) 	{  
		  $script = $script.'<script type="text/javascript">
			jQuery(function() {';
			if($wpts_count and $wpts_count!=0){ 
				$i = $wpts_count-1;
				if(!isset($wpts['disable_cookies']) or $wpts['disable_cookies']!='1'){ 
				   $cookie = '{ cookie: { expires: 30 } }';
				} 
				else{
				   $cookie = '';
				}	
				$tab_name='tabs_'.$post_id.'_'.$i;
				
				$script = $script.'var $'.$tab_name.' = jQuery("#tabs_'.$post_id.'_'.$i.'").tabs('.$cookie.');';
				 if(!isset($wpts['disable_cookies']) or $wpts['disable_cookies']!='1'){ 
				  $script = $script.'	//getter
					var cookie = jQuery("#tabs_'.$post_id.'_'.$i.'").tabs( "option", "cookie" );
					//setter
					jQuery("#tabs_'.$post_id.'_'.$i.'").tabs( "option", "cookie", { expires: 30 } );';
				 }	
				 
				if(isset($wpts['fade']) and $wpts['fade']=='1'){ 
					$script = $script.'//fx for animation
					jQuery("#tabs_'.$post_id.'_'.$i.'").tabs({ fx: { opacity: "toggle" } });
					//getter
					var fx = jQuery("#tabs_'.$post_id.'_'.$i.'").tabs( "option", "fx" );
					//setter
					jQuery("#tabs_'.$post_id.'_'.$i.'").tabs( "option", "fx", { opacity: "toggle" } );';
				} 
			   if(isset($wpts['nav']) and $wpts['nav']=='1') {
			   
				   $script = $script.' var wpts_j=0;
				   jQuery("#tabs_'.$post_id.'_'.$i.' .ui-tabs-panel").each(function(wpts_j){
	
						  var totalSize = jQuery("#tabs_'.$post_id.'_'.$i.' .ui-tabs-panel").size();
				
						  if (wpts_j < (totalSize-1)) {
							  var wpts_next = wpts_j + 1;
								  jQuery(this).append("<a href=\'#\' class=\'wpts-next-tab wpts-mover\' rel=\'" + wpts_next + "\'>'.$wpts['next_text'].'</a>");
						  }
				
						  if (wpts_j >= 1) {
							  var wpts_prev = wpts_j - 1;
								  jQuery(this).append("<a href=\'#\' class=\'wpts-prev-tab wpts-mover\' rel=\'" + wpts_prev + "\'>'.$wpts['prev_text'].'</a>");
						  }
		
				   });
				   
					jQuery(".wpts-next-tab, .wpts-prev-tab").click(function() {
					   $'.$tab_name.'.tabs("select", jQuery(this).attr("rel"));
					   return false;
				   })';
			  } 
			  
			 }
		
			$script = $script.'})';
		
			$script = $script.'</script> ';
		}
		
		$wpts_prev_post = $post_id;
		
		$support_link='<div style="text-align:right;"><a style="color:#aaa;font-size:9px" href="http://www.clickonf5.org/wordpress-post-tabs" title="Tabs by WordPress Post Tabs" target="_blank">WP Post Tabs</a></div>';
		
		if($wpts['support']=='1'){
		  return '<div class="wordpress-post-tabs">'.$tab_content.$support_link.'</div>'.$script;
		}
		else {
		  return '<div class="wordpress-post-tabs">'.$tab_content.'</div>'.$script;
		}
	}
	else {
		return null;
	}
}
add_shortcode($wpts['tab_end_code'], 'wpts_end_shortcode');

//Code to add settings page link to the main plugins page on admin
function wpts_admin_url( $query = array() ) {
	global $plugin_page;

	if ( ! isset( $query['page'] ) )
		$query['page'] = $plugin_page;

	$path = 'admin.php';

	if ( $query = build_query( $query ) )
		$path .= '?' . $query;

	$url = admin_url( $path );

	return esc_url_raw( $url );
}

add_filter( 'plugin_action_links', 'wpts_plugin_action_links', 10, 2 );

function wpts_plugin_action_links( $links, $file ) {
	if ( $file != WPTS_PLUGIN_BASENAME )
		return $links;

	$url = wpts_admin_url( array( 'page' => 'wordpress-post-tabs.php' ) );

	$settings_link = '<a href="' . esc_attr( $url ) . '">'
		. esc_html( __( 'Settings') ) . '</a>';

	array_unshift( $links, $settings_link );

	return $links;
}

// function for adding settings page to wp-admin
function wpts_settings() {
    // Add a new submenu under Options:
    add_options_page('Post/Page Tabs', 'Post/Page Tabs', 9, basename(__FILE__), 'wpts_settings_page');
}

function wpts_admin_head() {?>
<style type="text/css">
#divFeedityWidget span {
        display:none !important;
}
#divFeedityWidget a{
        color:#06637D !important;
}
#divFeedityWidget a:hover{
		font-size:110%;
}
</style>
<?php }

add_action('admin_head', 'wpts_admin_head');
// This function displays the page content for the Iframe Embed For YouTube Options submenu
function wpts_settings_page() {
?>
<div class="wrap">
<h2>WordPress Post Tabs</h2>
<form  method="post" action="options.php">
<div id="poststuff" class="metabox-holder has-right-sidebar"> 

<div style="float:left;width:55%;">
<?php
settings_fields('wpts-group');
$wpts = get_option('wpts_options');
?>
<h2>Tabs Style and Basic Settings</h2> 
<table class="form-table">

<tr valign="top">
<th scope="row"><label for="wpts_options[stylesheet]">Select the style for your tabs</label></th> 
<td><select name="wpts_options[stylesheet]" id="wpts_stylesheet" >

<?php 
$directory = WP_PLUGIN_DIR.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)).'/css/styles/';
if ($handle = opendir($directory)) {
    while (false !== ($file = readdir($handle))) { 
     if($file != '.' and $file != '..') { ?>
      <option value="<?php echo $file;?>" <?php if ($wpts['stylesheet'] == $file){ echo "selected";}?> ><?php echo $file;?></option>
 <?php  } }
    closedir($handle);
}
?>
</select>
</td>
</tr>

<tr valign="top"> 
<th scope="row"><label for="wpts_options[reload]">Reload the page/post everytime the tab is clicked</label></th> 
<td><input name="wpts_options[reload]" type="checkbox" id="wpts_options_reload" value="1"  <?php checked("1", $wpts['reload']); ?> /> <small>This may increase your pageviews. </small></td> 
</tr> 

<tr valign="top"> 
<th scope="row"><label for="wpts_options[fade]">Enable tabs 'Fade' effect</label></th> 
<td><input name="wpts_options[fade]" type="checkbox" id="wpts_options_fade" value="1" <?php checked("1", $wpts['fade']); ?> /></td> 
</tr> 

<tr valign="top"> 
<th scope="row"><label for="wpts_options[disable_cookies]">Disable Cookies</label></th> 
<td><input name="wpts_options[disable_cookies]" type="checkbox" id="wpts_options_disable_cookies" value="1" <?php checked("1", $wpts['disable_cookies']); ?> /></td> 
</tr> 

<tr valign="top"> 
<th scope="row"><label for="wpts_options[jquerynoload]">Do not load 'jQuery' library</label></th> 
<td><input name="wpts_options[jquerynoload]" type="checkbox" id="wpts_options_jquerynoload" value="1" <?php checked("1", $wpts['jquerynoload']); ?> /><small> (In case jQuery.js is added by hardcoding in active theme or plugin. This will avoid js conflict)</small></td> 
</tr> 

<tr valign="top"> 
<th scope="row"><label for="wpts_options[disable_fouc]">Disable FOUC (Flash of unstyled content)</label></th> 
<td><input name="wpts_options[disable_fouc]" type="checkbox" id="wpts_options_disable_fouc" value="1" <?php checked("1", $wpts['disable_fouc']); ?> /><small>(If you disable FOUC, tabs may not be displayed on the browser on which Javascript is disabled)</small></td> 
</tr> 

<tr valign="top"> 
<th scope="row"><label for="wpts_options[enable_everywhere]">Enable tabs on archives and Index page</label></th> 
<td><input name="wpts_options[enable_everywhere]" type="checkbox" id="wpts_options_enable_everywhere" value="1" <?php checked("1", $wpts['enable_everywhere']); ?> /></td> 
</tr> 

<tr valign="top"> 
<th scope="row"><label for="wpts_options[nav]">Enable Prev, Next navigation links </label></th> 
<td><input name="wpts_options[nav]" type="checkbox" id="wpts_options_nav" value="1" <?php checked("1", $wpts['nav']); ?> /></td> 
</tr> 

<tr valign="top">
<th scope="row"><label for="wpts_options[next_text]">'Next' navigation text</label></th>
<td><input type="text" name="wpts_options[next_text]" id="wpts_options_next_text" class="regular-text code" value="<?php echo $wpts['next_text']; ?>" /></td>
</tr>

<tr valign="top">
<th scope="row"><label for="wpts_options[prev_text]">'Prev' navigation text</label></th>
<td><input type="text" name="wpts_options[prev_text]" id="wpts_options_prev_text" class="regular-text code" value="<?php echo $wpts['prev_text']; ?>" /></td>
</tr>
 
</table> 
 
<h2>Disable Plugin Resources </h2> 
<small>This will help you avoid the loading of the plugin files (js,css) on all pages. You would get an option (custom checkbox) on edit post/page panel if disable the below options. If the below checkboxes are not ticked, then the plugin files will load on every page/post of your wordpress site.</small> 
 
<table class="form-table"> 
 
<tr valign="top"> 
<th scope="row"><label for="wpts_options[posts]">Disable loading on all Posts</label></th> 
<td><input name="wpts_options[posts]" type="checkbox" id="wpts_options_posts" value="0" <?php checked("0", $wpts['posts']); ?> /> <small>You would get a custom box on your edit post panel to enable tabs on that particular post. </small></td> 
</tr> 
 
<tr valign="top"> 
<th scope="row"><label for="wpts_options[pages]">Disable loading on all Pages</label></th> 
<td><input name="wpts_options[pages]" type="checkbox" id="wpts_options_pages" value="0" <?php checked("0", $wpts['pages']); ?>  /> <small>You would get a custom box on your edit page panel to enable tabs on that particular page. </small></td> 
</tr> 
</table> 
 
<h2>Custom Shortcodes</h2> 
<small>The default shortcodes are [tab] for adding a tab and [end_tabset] to end particular set/group of tabs. Please do not use spaces in the custom shortcodes. To check how to insert the tabs in your post/page, please refer the <a href="http://www.clickonf5.org/wordpress-post-tabs">plugin help page</a>.</small> 
<p style="color:#F04A4F">IMPORTANT: While changing these values to  new values, you would need to check if you have used old shortcode values in any of the posts.</p> 
 
<table class="form-table"> 
 
<tr valign="top"> 
<th scope="row"><label for="wpts_options[tab_code]">Replace [tab] shortcode with</label></th> 
<td>[<input type="text" name="wpts_options[tab_code]" id="wpts_options_tab_code" value="<?php echo $wpts['tab_code']; ?>" />]<small> &nbsp; &nbsp; (For example, you can enter: mytabs)</small></td> 
</tr> 
<tr valign="top"> 
<th scope="row"><label for="wpts_options[tab_end_code]">Replace [end_tabset] shortcode with</label></th> 
<td>[<input type="text" name="wpts_options[tab_end_code]" id="wpts_options_tab_end_code" value="<?php echo $wpts['tab_end_code']; ?>" />]<small> &nbsp; &nbsp; (For example, you can enter: end_mytabs)</small></td> 
</tr> 
 
<tr valign="top"> 
<th scope="row"><label for="wpts_options[support]">Promote WordPress Post Tabs WP Plugin</label></th> 
<td><input name="wpts_options[support]" type="checkbox" id="wpts_options_support" value="1"  <?php checked("1", $wpts['support']); ?> /> </td> 
</tr> 
 
</table> 

<p class="submit">
<input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>

<a href="http://www.clickonf5.org/go/donate-wp-plugins/" target="_blank" rel="nofollow"><img src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif" /></a>
<div style="clear:both;"></div>

</div>

<div style="float:right;width:28%;"> 
			<div class="postbox"> 
			  <h3 class="hndle"><span>About this Plugin:</span></h3> 
			  <div class="inside">
                <ul>
                <li><a href="http://www.clickonf5.org/wordpress-post-tabs" title="Wordpress Post Tabs Homepage" >Plugin Homepage</a></li>
                <li><a href="http://www.clickonf5.org/" title="Visit Internet Techies" >Plugin Parent Site</a></li>
				<li><a href="http://clickonf5.com/" title="Internet Techies Premium Support" >Support Forum</a></li>
                <li><a href="http://www.clickonf5.org/about/tejaswini" title="WordPress Post Tabs Author Page" >About the Author</a></li>
                <li><a href="http://www.clickonf5.org/go/donate-wp-plugins/" title="Donate if you liked the plugin and support in enhancing this plugin and creating new plugins" >Donate with Paypal</a></li>
                </ul> 
              </div> 
			</div> 
     
           <div class="postbox"> 
     		 <div class="inside">

              <div style="margin:10px auto;">
                        <a href="http://slidervilla.com/" title="Premium WordPress Slider Plugins" target="_blank"><img src="<?php echo wpts_url('images/slidervilla-ad1.jpg');?>" alt="Premium WordPress Slider Plugins" /></a>
              </div>
            </div>
           </div>
           
          <div class="postbox"> 
			  <h3 class="hndle"><span></span><?php _e('Recommended Themes'); ?></h3> 
			  <div class="inside">
                     <div style="margin:10px 5px">
                        <a href="http://slidervilla.com/go/elegantthemes/" title="Recommended WordPress Themes" target="_blank"><img src="<?php echo wpts_url('images/elegantthemes.gif');?>" alt="Recommended WordPress Themes" /></a>
                        <p><a href="http://slidervilla.com/go/elegantthemes/" title="Recommended WordPress Themes" target="_blank">Elegant Themes</a> are attractive, compatible, affordable, SEO optimized WordPress Themes and have best support in community.</p>
                        <p><strong>Beautiful themes, Great support!</strong></p>
                        <p><a href="http://slidervilla.com/go/elegantthemes/" title="Recommended WordPress Themes" target="_blank">For more info visit ElegantThemes</a></p>
                     </div>
               </div></div>
     
			<div class="postbox"> 
			  <h3 class="hndle"><span></span>Our Facebook Fan Page</h3> 
			  <div class="inside">
                <script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php/en_GB"></script><script type="text/javascript">FB.init("2aeebe9fb014836a6810ec4426d26f7e");</script><fb:fan profile_id="127760528543" stream="" connections="8" width="270" height="250"></fb:fan>
              </div> 
			</div> 

			<div class="postbox"> 
			  <h3 class="hndle"><span>Support &amp; Donations</span></h3> 
			  <div class="inside">
					<a target="_blank" href="http://www.clickonf5.org/go/donate-wp-plugins/" >Make a kind donation, to support our efforts</a>
              </div> 
			</div> 
    </div>  
</div> <!--end of poststuff -->
</form>

</div> <!--end of float wrap -->

<?php	
}
// Hook for adding admin menus
if ( is_admin() ){ // admin actions
  add_action('admin_menu', 'wpts_settings');
  add_action( 'admin_init', 'register_wpts_settings' ); 
} 
function register_wpts_settings() { // whitelist options
  register_setting( 'wpts-group', 'wpts_options' );
}
?>