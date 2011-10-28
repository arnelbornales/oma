=== Gravity Forms + Custom Post Types ===
Contributors: bradvin
Donate link: http://themergency.com/donate/
Tags: form,forms,gravity,gravity form,gravity forms,CPT,custom post types,custom post type,taxonomy,taxonomies
Requires at least: 3.0
Tested up to: 3.2
Stable tag: 2.1

Easily map your forms that create posts to a custom post type. Also map dropdown select, radio buttons list and checkboxes lists to a custom taxonomy.

== Description ==

> This plugin is an add-on for the [Gravity Forms Plugin](http://bit.ly/getgravityforms "visit the Gravity Forms website"). 
> If you don't yet own a license of the best forms plugin for WordPress, go and [buy one now!](http://bit.ly/getgravityforms "purchase Gravity Forms!")

Gravity forms allows you to create posts from a form using 'post fields'. By default the submitted form will create a draft post, but I wanted a way to save a custom post type instead. It can be done quite easily with some php code, but I wanted it to be easier without any code at all. Now it is easy. Maybe too easy :)

You can also link a custom taxomony to the field types : Drop Downs, Multiple Choice (radio buttons) or Checkboxes. So when the form is displayed a list of terms for the custom taxonomy are listed. And then when the post (or custom post type) is created, it automatically links the post to the selected taxonomy term(s).

**features**

*   Map a form to a custom post type
*   Map fields (Drop Downs, Multiple Choice or Checkboxes) to a custom taxonomy
*   Supports both Gravity Forms v1.5 beta and v.1.4.5
*   Much easier to map in Gravity Forms v1.5 - just select from a dropdown list
*   Ability to have more than 1 taxonomy linked in a form (see screenshots)
*   Hierarchical dropdowns for hierarchical taxonomies (see screenshots)

**How to map a form to a custom post type**

With Gravity Forms **v1.4.5**, all you need to do is add a CSS Class Name of *"posttype-YOUR_POST_TYPE"* to the form or your 'post title' field and your work is done.
Eg. adding a CSS class name of "posttype-movies" will save the post to the custom post type of "movies".

With **v1.5** of Gravity Forms, things get ALOT easier. You no longer need to set values for CSS class names. Rather just select the custom post types and taxonomies from a dropdown. Add a post title field to your form and under the advanced tab, tick the "Save As Custom Post Type" checkbox. A dropdown will appear with the available custom post types. Select the one you want.

**How to link a field to a custom taxonomy**

Custom taxonomies can be linked to Drop Downs, Multiple Choice (radio buttons) or Checkboxes. With Gravity Forms **v1.4.5**, simply, add a CSS class name of *"taxonomy-YOUR_TAXONOMY"* to the field.
Eg. adding a CSS class name of "taxonomy-actors" will link the dropdown to the "actors" custom taxonomy.

With **v1.5** of Gravity Forms, again things are alot easier. Under the advanced tab for your field, tick the "Populate with a Taxonomy" checkbox. A dropdown will appear and you can select your custom taxonomy from the list.

== Installation ==

1. Upload the plugin folder 'gravity-forms-custom-post-types' to your `/wp-content/plugins/` folder
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Make sure you also have Gravity Forms activated.

== Screenshots ==

1. An example of what the end result can look like
2. Support for hierarchical taxonomies
3. How to map a form to a custom post type in GF v.1.5
4. How to map a field to a custom taxonomy in GF v.1.5
5. How to map a form to a custom post type in GF v.1.4.5
6. How to map a field to a custom taxonomy in GF v.1.4.5

== Changelog ==

= 2.1 = 
* Fixed a bug where every 10th taxonomy was not being saved to the post. Thanks to Peter Schuster for the help on this fix
* Fixed most php warnings

= 2.0 =
* Added support for both Gravity Forms v1.5 beta and v.1.4.5
* Now supports linking taxonomies to Drop Downs, Multiple Choice or Checkboxes
* Integrated with GF v1.5 hooks for easier configuration (thanks to Alex and Carl from RocketGenius)
* Support linking more than 1 taxonomy to a form
* To keep in line with the GF standards, mapping a form to a CPT in GF v1.4.5 can now be done via the 'post title' field

= 1.0 =
* Initial Relase. First version.

== Frequently Asked Questions ==

= Does this plugin rely on anything? =
Yes, you need to install the [Gravity Forms Plugin](http://bit.ly/getgravityforms "visit the Gravity Forms website") for this plugin to work.

== Upgrade Notice ==

Please upgrade to the latest version
