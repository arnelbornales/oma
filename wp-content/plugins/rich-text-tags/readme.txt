=== Rich Text Tags ===
Contributors: katzwebdesign
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=zackkatz%40gmail%2ecom&item_name=Rich%20Text%20Tags&no_shipping=0&no_note=1&tax=0&currency_code=USD&lc=US&bn=PP%2dDonationsBF&charset=UTF%2d8
Tags: tag, tags, taxonomy, taxonomies, category, categories, category description, rich text category, editor, rich text, description, tag description, taxonomy description, rich text, wysiwyg, tinyMCE, SEO, search engine optimization
Requires at least: 2.6
Tested up to: 3.2.1
Stable tag: trunk

The Rich Text Tags Plugin allows you to edit tag, category, and taxonomy descriptions using Wordpress' built in WYSIWYG editor.

== Description ==

> __Support for this plugin & documentation on the <a href="http://www.seodenver.com/rich-text-tags/">official plugin page</a>__

### A TinyMCE Editor for Tags, Categories, and Taxonomies ###
The Rich Text Tags Plugin allows you to edit tag descriptions, category descriptions, and taxonomy descriptions using Wordpress' built in rich-text editor. Switch between WYSIWYG and HTML editing modes with the click of a link. Use the WordPress uploader to insert images from your computer or site's Media Library.

Use the PHP functions `tag_description()` and `category_description()` in your theme to show the descriptions. To learn how to show taxonomy descriptions, <a href="http://www.seodenver.com/rich-text-tags/" rel="nofollow">read more on the plugin page</a>.

<h4>Features</h4>
* Edit tag descriptions with tinyMCE's WYSIWYG editor
* Works with custom taxonomies (and custom post types, introduced in WP 3.0)
* Capability to turn off rich text editing with a click, so you can edit the HTML


== Installation ==

* Upload the `rich-text-tags` folder to the `/wp-content/plugins/` directory
* Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions == 

= What is the license of this plugin? =
* This plugin is released under a GPL license.

== Upgrade Notice ==

= 1.4 =
* Improved functionality in WordPress 3.2.1
* Fixed `First argument is expected to be a valid callback, 'wp_tiny_mce_preload_dialogs'` error (<a href="http://wordpress.org/support/topic/625561">issue <a href="http://wordpress.org/support/topic/625561">625561</a> and <a href="http://wordpress.org/support/topic/603480">603480</a>
* Improved plugin layout on main taxonomy page

= 1.3.3 = 
* Fixed issue <a href="http://wordpress.org/support/topic/537590">#537590</a>, where the rich text editor's link button wouldn't work. Thanks to <a href="http://wordpress.org/support/profile/deannas" rel="nofollow">DeannaS</a>

= 1.3.2 =
* Fixed "Attempt to assign property of non-object error" <a href="http://wordpress.org/support/topic/plugin-rich-text-tags-error-after-upgrading" rel="nofollow">as reported by chp2009</a>

= 1.3.1 = 
* Shortened term description in the Edit page so the table doesn't get too long (good idea, <a href="http://uniondesign.ca/" rel="nofollow">DL</a>). You can modify the length with the `term_excerpt_length` <a href="http://codex.wordpress.org/Plugin_API#Filters" rel="nofollow">filter</a>.

= 1.3 = 
* Added support for NextGen Gallery
* Improved Media Buttons support by gathering up stray link buttons
* Added shortcode functionality for term descriptions (tags, categories and taxonomies). Shortcodes will now work in these descriptions.

= 1.2.1 = 
* Fixed whitespace from being stripped in HTML mode

= 1.2 =
* Fixed issue where toggling between rich text and HTML editors removed paragraphs and line breaks (issue <a href="http://wordpress.org/support/topic/473880" rel="nofollow">473880</a>)

= 1.1 =
* Added support for WordPress 3.0+
* Improved code structure
* Fixed issues with rich text being stripped by WordPress (issue <a href="http://wordpress.org/support/topic/386264" rel="nofollow">386264</a> and <a href="http://wordpress.org/support/topic/460685" rel="nofollow">460685</a>

== Changelog ==

= 1.4 =
* Improved functionality in WordPress 3.2.1
* Fixed `First argument is expected to be a valid callback, 'wp_tiny_mce_preload_dialogs'` error (<a href="http://wordpress.org/support/topic/625561">issue <a href="http://wordpress.org/support/topic/625561">625561</a> and <a href="http://wordpress.org/support/topic/603480">603480</a>
* Improved plugin layout on main taxonomy page

= 1.3.3 = 
* Fixed issue <a href="http://wordpress.org/support/topic/537590">#537590</a>, where the rich text editor's link button wouldn't work. Thanks to <a href="http://wordpress.org/support/profile/deannas" rel="nofollow">DeannaS</a>

= 1.3.2 =
* Fixed "Attempt to assign property of non-object error" <a href="http://wordpress.org/support/topic/plugin-rich-text-tags-error-after-upgrading" rel="nofollow">as reported by chp2009</a>

= 1.3.1 = 
* Shortened term description in the Edit page so the table doesn't get too long (good idea, <a href="http://uniondesign.ca/" rel="nofollow">DL</a>). You can modify the length with the `term_excerpt_length` <a href="http://codex.wordpress.org/Plugin_API#Filters" rel="nofollow">filter</a>.

= 1.3 = 
* Added support for NextGen Gallery
* Improved Media Buttons support by gathering up stray link buttons
* Added shortcode functionality for term descriptions (tags, categories and taxonomies). Shortcodes will now work in these descriptions.

= 1.2.1 = 
* Fixed whitespace from being stripped in HTML mode

= 1.2 =
* Fixed issue where toggling between rich text and HTML editors removed paragraphs and line breaks (issue <a href="http://wordpress.org/support/topic/473880" rel="nofollow">473880</a>)

= 1.1 =
* Added support for WordPress 3.0+
* Improved code structure
* Fixed issues with rich text being stripped by WordPress (issue <a href="http://wordpress.org/support/topic/386264" rel="nofollow">386264</a> and <a href="http://wordpress.org/support/topic/460685" rel="nofollow">460685</a>

= 1.0.3.1 =
* Added additional GPL license information

= 1.0.3 =
* Added editor uploader/media library capability

= 1.0.2 =
* Improved Javascript to use jQuery
* Improved placement of Toggle link
* Added `remove_filter( 'pre_term_description', 'wp_filter_kses' );` code to allow for HTML in tag, 
  category, and taxonomy descriptions -- since that's what this plugin does :-)

= 1.0.1 =
* Updated the `readme.txt` file to make clearer

= 1.0 =
* First version of plugin
* Added link to disable Rich Text Editor

== Screenshots ==

1. How the rich text editor looks in the Edit Tags Page
2. The editor with rich text editing disabled
