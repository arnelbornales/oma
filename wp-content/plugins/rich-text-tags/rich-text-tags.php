<?php
/*
Plugin Name: Rich Text Tags, Categories, and Taxonomies
Plugin URI: http://www.seodenver.com/rich-text-tags/
Description: This plugin offers rich text editing capabilities for descriptions of tags, categories, and taxonomies.
Author: Katz Web Services, Inc.
Version: 1.4
Author URI: http://www.katzwebservices.com
*/
/*
	Based on Rich Text Biography by Matthew Praetzel. http://www.ternstyle.us
	Modified by Katz Web Services, Inc. to work with Simple Taxonomies.
	The license applied to the Rich Text Biography was in violation of the terms of use specified 
	on the WordPress.org website (http://wordpress.org/extend/plugins/about/), namely that the plugin
	MUST be GPL Compatible (http://www.gnu.org/licenses/gpl.html).
	As such, the license included with the original Rich Text Biography plugin was invalid.
*/

/*  Copyright 2010  Katz Web Services, Inc.  (email : info@katzwebservices.com.com)

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


add_action('plugins_loaded', 'kws_rich_text_tags');
function kws_rich_text_tags() {
	
	global $wpdb, $user, $current_user, $pagenow, $wp_version;
	
	// ADD EVENTS
	if(
	$pagenow == 'edit-tags.php' ||
	$pagenow == 'categories.php'
	) {
		if(!user_can_richedit()) { return; }
			
		wp_enqueue_script('post');
		//if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) return;
		if(floatval($wp_version) >= 2.7) {
//			wp_enqueue_script('tiny_mce');
			wp_enqueue_script('jquery');
			wp_enqueue_script('thickbox');
			add_action('admin_head','wp_tiny_mce');
		} else {
			wp_enqueue_script('tiny_mce');
		}
		wp_enqueue_script('quicktags');
		add_filter( 'tiny_mce_before_init', 'kws_rt_remove_filter');
		add_filter( 'tiny_mce_before_init', 'kws_rt_tinymce_settings');
		
		// Thanks, DeannaS!
		if(function_exists('wp_tiny_mce_preload_dialogs')) {
			add_action( 'admin_print_footer_scripts', 'wp_tiny_mce_preload_dialogs', 30 );
		}
		
		wp_enqueue_script('media');
		wp_enqueue_script('postbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('swfupload-all');
		wp_enqueue_script('swfupload-handlers');
			
		add_action('init','kws_rt_taxonomy_load_mce');
		add_action('wp_print_scripts','kws_rt_taxonomy_scripts');
		
		if(empty($_REQUEST['action'])) {
			add_filter('get_terms', 'kws_shorten_term_description');
		}
		
	}
	
	
	if($pagenow == 'edit-tags.php' && isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
		if(isset($_REQUEST['taxonomy'])) {
			add_action(esc_attr($_REQUEST['taxonomy']).'_edit_form_fields', 'kws_show_media_upload');
		} else {
			add_action('edit_tag_form_fields','kws_show_media_upload'); // Add link to disable Rich Text
			add_action('edit_term','kws_rt_taxonomy_save');
		}
		//	add_action( 'media_buttons', 'media_buttons' );
	} 
	
	// Enable shortcodes in category, taxonomy, tag descriptions
	if(function_exists('term_description')) {
		add_filter('term_description', 'do_shortcode');
	} else {
		add_filter('category_description', 'do_shortcode');
	}
	
	add_action('init', 'kws_rt_remove_filter');
	
	if($pagenow == 'categories.php' && isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') { // (!isset($_REQUEST['action']) || $_REQUEST['action'] == 'edit')) {
		add_action('edit_category_form_fields','kws_show_media_upload'); // Add link to disable Rich Text
		add_action('edit_category','kws_rt_category_save');
	}
	
	
	// LOAD SCRIPTS
	function kws_rt_taxonomy_load_mce() {
		$kwsScript = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)).'kws_rt_taxonomy.js';
		wp_enqueue_style( 'thickbox' );
		wp_enqueue_script('kws_rte',$kwsScript);	
	}
	function kws_rt_taxonomy_scripts() {
		global $pagenow;
		if(	$pagenow == 'edit-tags.php' && isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' ||
		$pagenow == 'categories.php' && $_REQUEST['action'] == 'edit') {
			echo '<link rel="stylesheet" href="'.WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__)).'kws_rt_taxonomy.css" type="text/css" media="all" />' . "\n";
		}
	}
	
	// PROCESS FIELDS
	function kws_rt_taxonomy_save() {
		global $tag_ID;
		$a = array('description');
		foreach($a as $v) {
			wp_update_term($tag_ID,$v,$_POST[$v]);
		}
	}
	
	// PROCESS FIELDS
	function kws_rt_category_save() {
		global $cat_ID;
		$a = array('category_description');
		foreach($a as $v) {
			wp_update_category($cat_ID,$v,$_POST[$v]);
		}
	}
	
	function kws_show_media_upload() { 
		global $post_ID, $temp_ID, $tag_ID;
		
		$post_ID = $temp_ID = -1 * time();
	
		$uploading_iframe_ID = (int) (0 == $post_ID ? $temp_ID : $post_ID);
		$context = apply_filters('media_buttons_context', __('<div id="editor-toolbar"><div id="media-buttons" class="hide-if-no-js">Upload/Insert %s</div></div>'));
		$media_upload_iframe_src = "media-upload.php?post_id=$uploading_iframe_ID";
		$media_title = __('Add Media');
		$image_upload_iframe_src = apply_filters('image_upload_iframe_src', "$media_upload_iframe_src&amp;type=image");
		$image_title = __('Add an Image');
		$video_upload_iframe_src = apply_filters('video_upload_iframe_src', "$media_upload_iframe_src&amp;type=video");
		$video_title = __('Add Video');
		$audio_upload_iframe_src = apply_filters('audio_upload_iframe_src', "$media_upload_iframe_src&amp;type=audio");
		$audio_title = __('Add Audio');
		$out = <<<EOF
		
		<a href="{$image_upload_iframe_src}&amp;TB_iframe=true" id="add_image" class="thickbox" title='$image_title' onclick="return false;"><img src='images/media-button-image.gif' alt='$image_title' /></a>
		<a href="{$video_upload_iframe_src}&amp;TB_iframe=true" id="add_video" class="thickbox" title='$video_title' onclick="return false;"><img src='images/media-button-video.gif' alt='$video_title' /></a>
		<a href="{$audio_upload_iframe_src}&amp;TB_iframe=true" id="add_audio" class="thickbox" title='$audio_title' onclick="return false;"><img src='images/media-button-music.gif' alt='$audio_title' /></a>
		<a href="{$media_upload_iframe_src}&amp;TB_iframe=true" id="add_media" class="thickbox" title='$media_title' onclick="return false;"><img src='images/media-button-other.gif' alt='$media_title' /></a>
EOF;
	//	echo $out;
		printf($context, $out);
	}
	// Remove XHTML filtering from descriptions
	remove_filter( 'pre_term_description', 'wp_filter_kses' );
	remove_filter( 'term_description', 'wp_kses_data' );
	
	function kws_rt_tinymce_settings($array = array()) {
		global $pagenow;
		if(	$pagenow == 'edit-tags.php' && isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' ||
		$pagenow == 'categories.php' && $_REQUEST['action'] == 'edit') {
			if(	$pagenow == 'edit-tags.php' && isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit' ) {
				$array['editor_selector'] = 'description';
			} else {
				$array['editor_selector'] = 'category_description';
			}
		}
		$array['remove_linebreaks'] = false;
		$array['apply_source_formatting'] = true;
		return $array;
	}
	
	function kws_rt_remove_filter($array) {
		global $pagenow;
		if (( is_admin() || defined('DOING_AJAX') ) && current_user_can('manage_categories')) {
			remove_filter('pre_term_description', 'wp_filter_kses');
		}
		return $array;
	}
}

function kws_wp_trim_excerpt($text) {
	$raw_excerpt = $text;

#			$text = strip_shortcodes( $text );	
#			$text = apply_filters('the_content', $text);
	$text = str_replace(']]>', ']]&gt;', $text);
#			$text = strip_tags($text);
	$excerpt_length = apply_filters('term_excerpt_length', 40);
	$excerpt_more = ' ' . '[...]';
	$words = preg_split("/[\n\r\t ]+/", $text, $excerpt_length + 1, PREG_SPLIT_NO_EMPTY);
	if ( count($words) > $excerpt_length ) {
		array_pop($words);
		$text = implode(' ', $words);
		$text = $text . $excerpt_more;
	} else {
		$text = implode(' ', $words);
	}
	return apply_filters('wp_trim_term_excerpt', force_balance_tags($text), $raw_excerpt);
}

function kws_shorten_term_description($terms = array(), $taxonomies = null, $args = array()) {
	if(is_array($terms)) {
	foreach($terms as $key=>$term) {
		if(is_object($term) && isset($term->description)) {
			$term->description = kws_wp_trim_excerpt($term->description);
		}
	}
	}
	return $terms;
}

?>