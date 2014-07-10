=== Easy Pricing Tables by fatcat apps ===
Contributors: davidhme
Donate link: http://fatcatapps.com/easypricingtables/?utm_campaign=ept-donate-link&utm_source=wordpress.org-plugins&utm_medium=link
Tags: pricing table, responsive pricing table, comparison, comparison table, css table, price, price gird, pricing, pricing box, pricing grid, table, pricing page, landing page, woocommerce
Author URI: http://fatcatapps.com/?utm_campaign=ept-author-uri&utm_source=wordpress.org-plugins&utm_medium=link
Plugin URI: http://fatcatapps.com/easypricingtables/?utm_campaign=ept-plugin-uri&utm_source=wordpress.org-plugins&utm_medium=link
Requires at least: 3.6.0.1
Tested up to: 3.9.1
Stable tag: 1.6.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Create a Beautiful, Responsive and Highly Converting Pricing Table in Less Than 5 Minutes with Easy Pricing Tables for WordPress. No Coding Required.

== Description ==
*   [**Easy Pricing Tables for Wordpress** makes it easy to create and publish beautiful pricing tables on your WordPress site. You will be able to set up and publish your pricing table in no time.

*   [View A Pricing Table Live Demo &raquo;](http://fatcatapps.com/easypricingtables/free-demo/?utm_campaign=ept-description-demo&utm_source=wordpress.org-plugins&utm_medium=link)

*   Easy Pricing Tables implements conversion rate optimization (CRO) best practices and guides you through the process of creating a pricing table that converts 

*   This plugin works with any WordPress theme you have installed. After installing the plugin and creating your first pricing table, you can publish your table anywhere on your site using a shortcode.

[youtube http://www.youtube.com/watch?v=657Qs5Yng5Q]

**Features**

*   Works with any WordPress Theme
*   Responsive Pricing Tables
*   Intuitive User Interface
*   Built-in Conversion Rate Optimization Best Practices
*   Create Unlimited Rows and up to 10 Columns
*	Customize your design: font-size, color pickers and rounded borders.
*   Use drag & drop to reorder columns
*   Featured Your Most Popular Column

**Premium Version Features**

*	4 additional gorgeous designs
*	More customization options
*	Tooltips
*	Google Analytics Integration
*   Icons
*	Pricing Toggles
*	Priority support

*	[Learn more about Easy Pricing Tables Premium >>](http://fatcatapps.com/easypricingtables/?utm_campaign=ept-description-cta&utm_source=wordpress.org-plugins&utm_medium=link)

== Installation ==

1. Upload `easy-pricing-tables.zip` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. In your sidebar, select 'Pricing Tables -> Add New' to create a new table

== Frequently Asked Questions ==

= I'm using S2 member / WooCommerce / etc and would like to replace your built-in button with a button generated from a shortcode =
To disable the pricing table button and replace it with a shortcode, simply enter the following in the 'Button Text' row:
`[shortcode][my-example-shortcode/][/shortcode]`

= My table rows aren't aligned properly =
If within the same row, you use a lot more text in some features than in others, your feature height alignment might be weird.
This problem is due to tables being responsive instead of fixed width. You can fix it by adding manual linebreaks for your features.
<br/><br/> results in one linebreak.

= I want to change the design for each individual column =
This currently isn't supported in the user interface. However, each column has its own unique HTML class that can be modified using a css class selector.

*	Class of the first column: ptp-col-id-0
*	Class of the second column: ptp-col-id-1
*	Class of the third column: ptp-col-id-2
*	etc...

= How do I change the design of individual feature rows? =
This currently isn't supported in the user interface. However, each feature row has its own unique HTML class that can be modified using a css class selector.

*	Class of the first feature row: ptp-row-id-0
*	Class of the second feature row: ptp-row-id-1
*	Class of the third feature row: ptp-row-id-2
*	etc...

= I want to adjust my column width =
This currently isn't supported in the user interface. This plugin uses a fixed percentage column width based on how many columns your pricing table has.
For example, if your pricing table has 3 columns, each column has the following HTML class: ``ptp-three-col``.

The default CSS in this case looks like this:
`
.ptp-three-col {
	width: 31%;
}
`

Example code for changing your column width you can add to your theme:
`
.ptp-three-col {
width: 25%!important;
}
`

= Does this plugin use JavaScript? =
We're using a small jQuery library called (jquery.matchHeight.js)[https://github.com/liabru/jquery-match-height] for the "Automatically match Row Height" feature. This small library won't significantly impact load time, but please be aware that we are loading a JavaScript file if you enable "Automatically match Row Height".

== Screenshots ==
1. Example of a pricing table with 3 columns
2. Example of a pricing table with 2 columns
3. Creating a new table
4. Design options of free plugin
5. Additional table designs of [Easy Pricing Tables Premium](http://fatcatapps.com/easypricingtables/?utm_campaign=ept-sceenshots-cta&utm_source=wordpress.org-plugins&utm_medium=link)
6. Additional settings of [Easy Pricing Tables Premium](http://fatcatapps.com/easypricingtables/?utm_campaign=ept-sceenshots-cta&utm_source=wordpress.org-plugins&utm_medium=link)
7. One of the designs from [Easy Pricing Tables Premium](http://fatcatapps.com/easypricingtables/?utm_campaign=ept-sceenshots-cta&utm_source=wordpress.org-plugins&utm_medium=link)
8. Another design from [Easy Pricing Tables Premium](http://fatcatapps.com/easypricingtables/?utm_campaign=ept-sceenshots-cta&utm_source=wordpress.org-plugins&utm_medium=link)

== Changelog ==

= 1.6.0.1 =
* Fixed a minor issue that occured while deploying v1.6 that caused 'Automatically match Row Height' to not work.


= 1.6 =
* Automatically match Row Height - feature. For all newly created tables, all rows will now be forced to be of the same height using JS (you can activate/deactivate this in Design -> General Settings -> Automatically match Row Height)


= 1.5.5 =
* Fixed a JS bug (jquery-ui loaded in non easy-pricing-tables post-types)


= 1.5.4 =
* Improved the plugins' compatibility with shortcode-button generators
* Fixed a JS error in the Easy Pricing Tables editor
* Added the ability to use only one column
* Added 'template'-Tab


= 1.5.3 =
* Fixed a bug that added unnecessary CSS to some pages
* Confirmed compatibility with WordPress 3.9.1

= 1.5.2.1 =
* Updated links from http://easypricingtables.com to http://fatcatapps.com/

= 1.5.2 =
* Confirmed compatibility with WordPress 3.9
* Changed Easy Pricing Tables icon

= 1.5.1 =
* Bugfix: Unable to resize bullet font
* Bugfix: Preview didn't work for about 1% of sites
* Bugfix: "Pricing Table" menu disappears
* Improve HTML & CSS by removing a couple of !importants from my code
* Changes to email opt-in system
* Added Easy Pricing Tables Premium - preview

= 1.5.0.2 =
* Fixed incompatibility with netstudio-wp theme
* Added YouTube video link to readme.txt

= 1.5 =
* Easy Pricing Tables now supports translations (contact me if you'd like to submit a translation).
* Added Lithuanian language support. 
* Improved compatibility with legacy browsers (in particular old Internet Exploreer versions).
* Easy Pricing Tables is now compatible with http://wordpress.org/plugins/responsive-mobile-friendly-tooltip/.
* Small UI improvement: moved the "Pricing Tables" setting link in the left-hand navigation further down.

= 1.4.4 =
* UI improvements
* Added support for shortcode buttons like S2 member
* Fixed incompatibility with the Theme Foundry Basis theme
* Decreased file size of plugin
* Fixed CSS incompatibility with some themes
* Added an update notice

= 1.4.3 =
* Added the ability to clone existing tables
* Added row IDs to pricing table HTML (now you can change alternate row colors using CSS)
* Bugfixes
* Fixed CSS conflicts with some themes
* Minor UX improvements


= 1.4.2.2 =
* Fixed versioning issue

= 1.4.2.1 =
* Updated readme.txt (FAQ, screenshots, markdown formatting issues)

= 1.4.2 =
* Updated readme.txt
* Added sidebar link to Easy Pricing Tables Premium
* Fixed CSS conflict with Dynamik Genesis Child Theme
* Added ability to rename "Most Popular" Featured Label

= 1.4.1 =
* Fixed button-color bug introduced with version 1.4

= 1.4 =
* Bufix: Fixed CSS generation algorithm
* Fixed PHP 5.4 strict notices
* Improved compatibility with other plugins using the WPAlchemy framework
* UI improvements: Shortcodes can now be directly added via the editor
* After install, ask users if they want to allow usage tracking
* After install, ask users if they want to get a pricing-table mini-course
* Users can now change the text in the "most popular" label

= 1.3.2 =
* Improved CSS to cause less theme conflicts
* Various bugfixes
* Refactored table generation code
* UI improvements

= 1.3.1 =
* Minor Improvements

= 1.3 =
* Fixed incompatibility with s2 Member plugin
* Added font-size options
* Changed post-type 'public' => false
* Minor bugfixes
* Minor UI improvements

= 1.2.1 =
* Bugfix

= 1.2 =
* Added column drag & drop
* UI improvements
* Bugfixes
* Fixed CSS issues on the "Add new pricing tables"-page caused by WooThemes

= 1.1.2 =
* Fixed bug related to colorpicker introduced with version 1.1.0

= 1.1.1 =
* Fixed Woothems incompatibility

= 1.1.0 =
* Added new design options (colors & rounded corners)
* Added tabs to backend UI
* Replaced default-text with HTML5 placeholder
* Various bugfixes
* Added new screenshots
* Added banner for Wordpress directory

= 1.0.2.1 =
* Minor CSS Bugfix

= 1.0.2 =
* Fixed typos
* Improved responsive CSS
* Improved button design
* Changed design of highlighted column
* Bugfixes

= 1.0.1 =
* Improved readme.txt

= 1.0.0 =
* Initial release


== Upgrade Notice ==



`<?php code(); // goes in backticks ?>`