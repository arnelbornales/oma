=== WordPress Post Tabs ===
Contributors: internet techies
Tags:post, page, tabs, menu, ui-tabs, sections, options, edit, shortcode, navigation, jquery, slider
Donate link: http://www.clickonf5.org/go/donate-wp-plugins/
Requires at least: 2.8
Tested up to: 3.2.1
Stable tag: 1.3.1

You can add various tabs to your WordPress Post or Page easily through the edit post/page panel so that your posts and pages have well organized tabbed sections.

== Description ==

WordPress Post Tabs is a plugin for WordPress that will help you add as many tabs to your WordPress post or Page. So, say if you want to write some review, you can create various sections of the review post and display them in a tab view, i.e. separate tab for each section. This can be looked as a menu for your individual post, so that your readers can easily notice the distinct sections of your article or post or page. 

As you can see the format of gadgets review on PCWorld and CNET where they provide different sections like specifications, user review, full review, shop etc in different tabs. Similar format is visible on different automobile review sites. In fact the tabbing format is useful for movies review and recipes sites. You can use one tab for picture gallery and other tab for detailed review. To make your post more interesting, you can add videos under one tab as well.  

=Features:=

* You can choose from different styles, the looks of your post tabs. In fact you can easily create your own style, or download some pre-designed styles from the plugin page.
[Download Custom Styles] (http://www.clickonf5.org/wordpress-post-tabs)
* You can choose to reload or not to reload the page (AJAX like) every time the tab is clicked by the reader.
* If you disable the loading of the plugin on posts and pages, this plugin will not load any extra script on your other pages where you do not select to use the tabs. You would get a checkbox on each post and page, to enable the plugin on that particular page. So, for other posts and pages, there is no extra script load in the footer, and your pages remain optimized.
* The tabs are unobtrusive and will make your posts and pages very well organized and readable for the readers.
* Option to put Next-Previous buttons (links) in the tabs that can be clicked to go to next or previous tab
* Unlimited number of tab sets can be added to the post/page
* Option to show the tabs in the posts on Index, home and category archive pages. By default this is disabled
* Option to Enable or disable the tab cookies

[Plugin Information and FAQs](http://www.clickonf5.org/wordpress-post-tabs) | 
[Demo](http://blogern.com/2010/08/20/review-dell-mini10-inspiron-netbook/) |
[Get Support](http://clickonf5.com/)

**Find advanced and Stylish WordPress Slider Plugins at [SliderVilla](http://www.slidervilla.com/)**

== Installation ==

This plugin is easy to install like other plug-ins of WordPress as you need to just follow the below mentioned steps:

1. Copy Folder 'wordpress-post-tabs' from the downloaded and extracted file.

2. Paste it in 'wp-Content/plugins' folder on your WordPress Installation 

3. Activate the plugin from Dashboard / Plugins window.

4. Now Plugin is Activated, Go to the Usage section to see how to use WordPress Post Tabs.

== Usage ==

* To insert the tabs, you would need to use two shortcodes on your Edit Post/Page admin panel. The first shortcode is for tab names and the second shortcode represents the end of the set of the tabs. You can insert multiple number of tabset on a single page.
* Example how to put tabs:


`[tab name='Overview']

This is the overview section.

[/tab]

[tab name='Specifications']

Various product Specifications can be entered here.

[/tab]

[tab name='Screenshots']

You can insert images or screenshots of the product. 

[/tab]

[end_tabset]`

**Do not forget to insert the 'name' attribute for each tab. It is important 
** Just remember to put the 'end_tabset' shortcode at the end of all tab contents as shown above.
* On the 'Post/Page Tabs' Settings on your WordPress admin, you can select your style. Currently there are three styles - default, gray and red. You can add your own styles easily. Please refer the plugin page how to add the custom styles, its just 2 minute work.
* In case you wish to reload the page every time another tab is clicked, you can select that option from the settings page. This would be helpful if you wish to count these pageviews as well.
* If you check the 'Disable loading on all Posts' option, this will disable the plugin on the posts all together and you will get a custom box 'Enable Post/Page Tabs Feature' on your Edit Post panel. Now you can check this checkbox for those posts only where you wish to enable the tabs. This will prevent the loading of the script and style specific to this plugin on all other pages.
* Same as above is the case with 'Disable loading on all Pages', its for pages.
* You can replace the default shortcodes with your own, that are comfortable for you. 

== Screenshots ==

1. Tab 1 on post
2. Another tab on post (gallery tab)
3. Usage on Edit Post Panel

Visit the plugin page (http://www.clickonf5.org/wordpress-post-tabs) to read more about it.

== Upgrade Notice ==

!!IMPORTANT!! Do upgrade to version 1.2 and above as the tabs break in some cases for previous versions of the tabs plugin. Read changelog for the actual fix information.

== Changelog ==

Version 1.3.1 (08/02/2011)

1. Fix - For some installations, tabs were not working in case the Post/Page ID was changed in footer due to custom WP Query. Fixed this issue, so that the tabs JS will pick correct tab ID in all cases.
2. Fix - Tabs were trimmed off in RSS feed in case full post text is chosen to be displayed in the RSS feeds. Corrected the issue. Thanks Michael who brought it forward.
3. Fix - An extra space used to appear before the content in the tab in some cases due to empty p tags (WordPress autop formatter). Fixed this issue.


Version 1.3 (02/25/2011)

1. Fix - Settings page link was not working on Plugins admin page on dashboard.
2. New - You can now add 'Previous' and 'Next' links or buttons to the tabset
3. New - Now tabs in the post can be displayed on the home, index or the category or date archive pages
4. New - Option to disable tab cookies in the browser of the user that remembers which tab was last opened by the visitor
5. New - Option to disable FOUC (Flash Of Unstyled Content) before the page/document loads completely


Version 1.2 (01/28/2011)

1. Major Fix - The tabs were breaking the post/page in preview or on multiple comments page (post/page permalink change).

Version 1.1 (11/02/2010)

1. New - Facility to select 'Fade Effect' for the tabs
2. New - Facility to disable the load of jquery on the page in case the active theme or some plugin already has it hardcoded in the header or footer. This would avoid the JS conflict.

Visit the plugin page (http://www.clickonf5.org/wordpress-post-tabs) to see the changelog and release notes.