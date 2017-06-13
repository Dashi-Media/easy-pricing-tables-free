=== Pricing Tables WordPress Plugin - Easy Pricing Tables ===
Contributors: davidhme, fatcatapps, ryannovotny
Donate link: https://fatcatapps.com/easypricingtables/?utm_campaign=donate%2Blink&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral
Tags: pricing table, pricing tables, comparison table, pricing grid, responsive pricing table, price comparison, price comparison table
Author URI: https://fatcatapps.com/?utm_campaign=author%2Buri&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral
Plugin URI: https://fatcatapps.com/easypricingtables/?utm_campaign=plugin%2Buri&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral
Requires at least: 3.6
Tested up to: 4.8
Stable tag: 2.3.8
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Pricing Table Plugin - Easy Pricing Tables Lets You Create A Beautiful, Responsive Pricing Table In 2 Minutes. No Coding Required.

== Description ==
*   The **Easy Pricing Tables** WordPress Plugin makes it easy to create and publish beautiful pricing tables and comparison tables on your WordPress site. You will be able to set up and publish your pricing table in no time.

*   [View screenshots of WordPress pricing tables built with this plugin](https://wordpress.org/plugins/easy-pricing-tables/screenshots/).

*   [View Easy Pricing Tables Premium Live Demo &raquo;](https://fatcatapps.com/easypricingtables/demo?utm_campaign=description%2Bdemo%2Blink&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral)

> #### Easy Pricing Tables Premium
> Easy Pricing Tables Premium comes with the following features.<br />
>
> Ten Gorgeous Pricing Table Designs.<br />
> Fully Customize your Pricing Table (Colors, etc...).<br />
> Priority Email Support.<br />
> Tooltips.<br />
> Google Analytics Integration (track pricing table button clicks).<br />
> Pricing Toggles (switch between multiple pricing tables - eg. currencies or monthly/yearly pricing.<br />
> And much more....<br />
>
> [Learn more about Easy Pricing Tables Premium >>](https://fatcatapps.com/easypricingtables/?utm_campaign=description%2Bcta&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral)

= Overview =

* Build beautiful WordPress pricing tables in minutes.

*   Easy Pricing Tables implements conversion rate optimization (CRO) best practices and guides you through the process of creating a pricing table that converts.

*   Easy Pricing Tables works with any WordPress theme you have installed. After creating your first pricing table using Easy Pricing Tables, you can publish your pricing tables anywhere on your site using a shortcode.


= Easy Pricing Tables - WordPress Pricing Table Plugin Features =

*   Works with any WordPress theme
*   Responsive WordPress Pricing Tables
*   Intuitive User Interface - building pricing tables has never been easier
*   Built-in Conversion Rate Optimization Best Practices
*   Create Unlimited Pricing Table Rows
*	Customize Your Pricing Table Design: Font-size, Color Pickers and Rounded Borders.
*   Use Drag & Drop To Reorder WordPress Pricing Tables Columns
*   Featured Your Most Popular Easy Pricing Tables Column
*   Custom CSS - Add Custom CSS to your Pricing Table


*   [Check out Easy Pricing Tables Premium](https://fatcatapps.com/easypricingtables/?utm_campaign=ept-description-cta&utm_source=wordpress.org%2Fplugins&utm_medium=referral)

= WordPress.org Support =

> As this is the lite version of [this WordPress pricing table plugin](https://fatcatapps.com/easypricingtables/?utm_campaign=donate%2Blink&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral), the only support we offer through these forums is for bugs. Support for questions regarding modifying your pricing tables, writing custom CSS, etc is available for customers of [Easy Pricing Tables Premium](https://fatcatapps.com/easypricingtables/?utm_campaign=donate%2Blink&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral).

== Installation ==

1. Upload the Easy Pricing Tables plugin file (`easy-pricing-tables.zip`) to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. In your sidebar, select 'Pricing Tables -> Add New' to create a new table

== Frequently Asked Questions ==

= I'm using S2 member / WooCommerce / etc and would like to replace your built-in Easy Pricing Tables button with a button generated from a shortcode =
To disable the pricing table button and replace it with a shortcode, simply enter the following in the 'Button Text' row:
`[shortcode][my-example-shortcode/][/shortcode]`

= My pricing table rows aren't aligned properly =
If within the same row, you use a lot more text in some features than in others, your feature height alignment might be weird.
This problem is due to tables being responsive instead of fixed width. You can fix it by adding manual linebreaks for your features.
<br/><br/> results in one linebreak.

= I want to change the design for each individual column =
This currently isn't supported in the user interface. However, each column has its own unique HTML class that can be modified using a css class selector.

*	Class of the first column: ptp-col-id-0
*	Class of the second column: ptp-col-id-1
*	Class of the third column: ptp-col-id-2
*	etc...

= How do I change the design of individual pricing table feature rows? =
This currently isn't supported in the user interface. However, each feature row has its own unique HTML class that can be modified using a css class selector.

*	Class of the first feature row: ptp-row-id-0
*	Class of the second feature row: ptp-row-id-1
*	Class of the third feature row: ptp-row-id-2
*	etc...

= I want to adjust my pricing table column width =
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
We're using a small jQuery library called (jquery.matchHeight.js)[https://github.com/liabru/jquery-match-height] for the "Automatically match Row Height" feature. This small library won't significantly impact load time.

== Screenshots ==
1. Example of a pricing table with 3 columns
2. Example of a pricing table with 2 columns
3. Creating a new pricing table
4. Design options of Easy Pricing Tables Lite
6. Additional settings of [Easy Pricing Tables Premium](https://fatcatapps.com/easypricingtables/?utm_campaign=screenshots%2Bcta&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral)
7. One of the designs from [Easy Pricing Tables Premium](https://fatcatapps.com/easypricingtables/?utm_campaign=screenshots%2Bcta&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral)
8. Another design from [Easy Pricing Tables Premium](https://fatcatapps.com/easypricingtables/?utm_campaign=screenshots%2Bcta&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral)
9. Another design from [Easy Pricing Tables Premium](https://fatcatapps.com/easypricingtables/?utm_campaign=screenshots%2Bcta&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral)
10. Another design from [Easy Pricing Tables Premium](https://fatcatapps.com/easypricingtables/?utm_campaign=screenshots%2Bcta&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral)
11. Another design from [Easy Pricing Tables Premium](https://fatcatapps.com/easypricingtables/?utm_campaign=screenshots%2Bcta&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral)
12. Another design from [Easy Pricing Tables Premium](https://fatcatapps.com/easypricingtables/?utm_campaign=screenshots%2Bcta&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral)
13. Another design from [Easy Pricing Tables Premium](https://fatcatapps.com/easypricingtables/?utm_campaign=screenshots%2Bcta&utm_source=https%3A%2F%2Fwordpress.org%2Fplugins%2Feasy-pricing-tables%2F&utm_medium=referral)

== Changelog ==

= Easy Pricing Tables 2.3.8 =
* Add uninstall feedback survey
* Tested up to WordPress 4.8

= Easy Pricing Tables 2.3.7 =
* Add save confirmation prompt
* Update jQuery MatchHeight library to latest (v0.7.0)
* Fix conflict with "Calls to Action" plugin

= Easy Pricing Tables 2.3.6 =
* Allow shortcodes in Plan Name, Plan Price, Button Text and Button URL fields
* Fix footer URL link not working

= Easy Pricing Tables 2.3.5 =
[released for premium editions only]

= Easy Pricing Tables 2.3.4 =
* Include updated WPAlchemy library for PHP7 compatibility
* Replace deprecated function get_currentuserinfo with wp_get_current_user

= Easy Pricing Tables 2.3.3 =
* Improved performance up to 50%
* Added WordPress filter for inline CSS ( 'fca_ept_css_filter' ) see https://github.com/davidhme/easy-pricing-tables-free/compare/release-2-3-3?expand=1#diff-6c2a3ec8c1f99e3832bfd514b00470b6R45

= Easy Pricing Tables 2.3.2 =
* Changed default button text and place holder to 'Add to Cart'
* Fixed conflict with 'All In One Schema.org Rich Snippets' plugin
* Updated a few headings and tooltip texts for better clarity
* Tested up to WP 4.6 Beta

= Easy Pricing Tables 2.3.1 =
* This release was only for Easy Pricing Tables premium

= Easy Pricing Tables 2.3.0 =
* Added Dutch translations
* Fix a warning that occured with PHP 7
* Changed CSS enqueue order to allow overwriting any rules with custom css

= Easy Pricing Tables 2.2.0 =
* Fix possible conflict with other plugins using Mixpanel library
* Fix conflict with Yoast SEO plugin causing incorrect styles on some themes/configurations
* Included French language translations
* Minor UI Improvements

= Easy Pricing Tables 2.1.0 =
* Fixed a plugin conflict with iThemes exchange.
* Fixed a bug in the backend introduced by a new version of jQuery included in WP 4.5

= Easy Pricing Tables 2.0.6 =
* Small UI improvements: pricing table editor now looks a bit nicer.
* Fix: Easy Pricing Tables now cleans up the database when the plugin is deleted. (It removes dh_ptp_allow_tracking and dh_ptp_mailing_list)
* Fix: Easy Pricing Tables disabled the WordPress post auto save feature on some configurations.
* Fix: pricing tables used to be listed as public posts.

= Easy Pricing Tables 2.0.5 =
* Added text domain for compatibility with translate.wordpress.org

= Easy Pricing Tables 2.0.4 =
* Reverted the <p>-related fix introduced with 2.0.3 as it ended up causing problems.

= Easy Pricing Tables 2.0.3 =
* Fix: Some themes insert <p> tags into our pricing tables which made them look weird. We now hide these paragraphs using CSS.

= Easy Pricing Tables 2.0.2 =
* Confirmed WordPress 4.3 compatibility

= Easy Pricing Tables 2.0.1 =
* Fixed Phantom "1" bug that showed up on some sites

= Easy Pricing Tables 2.0 =
* Updated version to 2.0 to correspond with Easy Pricing Tables Premium
* Updated copy of Easy Pricing Tables Premium banner
* Updated anonymous tracking script
* Fixed error that occured when activating Easy Pricing Tables Premium when Easy Pricing Tables Lite was installed.

= Easy Pricing Tables 1.9.5.4 =
* Updated readme.txt

= Easy Pricing Tables 1.9.5.3 =
* Confirmed compatibility with WordPress 4.0.1

= Easy Pricing Tables 1.9.5 =
* Improvement: Empty rows will now automatically be hidden on smartphones
* Improvement: Changed mouse cursor from arrow to hand on button hover
* Improvement: Changed aesthetics (CSS) of the tabs in the Easy Pricing Tables editor
* Improvement: Made the pricing table columns in the Easy Pricing Tables editor wider
* Changed version number of Easy Pricing Tables to correspond to Easy Pricing Tables Premium
* Added Easy Pricing Tables - icon to media button

= Easy Pricing Tables 1.7.1 =
* Fixed CSS bug related to the "rounded pricing table corners" - feature
* Fixed a rare bug by adding jquey lib dependency after matchHeight lib
* Minor CSS change in the UI
* Add unique ID element to every call to action button

= Easy Pricing Tables 1.7 =
* Add Custom Pricing Table CSS Feature

= Easy Pricing Tables 1.6.1.1 =
* Tiny CSS fix (Easy Pricing Tables user interface)

= Easy Pricing Tables 1.6.1 =
* Small user interface improvements


= Easy Pricing Tables 1.6.0.3 =
* Confirmed Easy Pricing Tables compatibility with WordPress 4.0


= Easy Pricing Tables 1.6.0.2 =
* Confirmed Easy Pricing Tables compatibility with WordPress 3.9.2


= Easy Pricing Tables 1.6.0.1 =
* Fixed a minor issue that occured while deploying Easy Pricing Tables v1.6 that caused 'Automatically match Row Height' to not work.


= Easy Pricing Tables 1.6 =
* Automatically match Pricing Table Row Height - feature. For all newly created tables, all rows will now be forced to be of the same height using JS (you can activate/deactivate this in Design -> General Settings -> Automatically match Row Height)


= Easy Pricing Tables 1.5.5 =
* Fixed a JS bug in the Easy Pricing Tables backend (jquery-ui loaded in non easy-pricing-tables post-types)


= Easy Pricing Tables 1.5.4 =
* Improved the plugins' compatibility with shortcode-button generators
* Fixed a JS error in the Easy Pricing Tables editor
* Added the ability to use only one column
* Added 'template'-Tab


= Easy Pricing Tables 1.5.3 =
* Fixed a bug that added unnecessary pricing table CSS to some pages
* Confirmed compatibility with WordPress 3.9.1

= Easy Pricing Tables 1.5.2.1 =
* Updated links to new Easy Pricing Tables landing page - https://fatcatapps.com/easypricingtables

= Easy Pricing Tables 1.5.2 =
* Confirmed compatibility of Easy Pricing Tables with WordPress 3.9
* Changed Easy Pricing Tables icon

= Easy Pricing Tables 1.5.1 =
* Bugfix: Unable to resize bullet font
* Bugfix: Preview didn't work for about 1% of sites
* Bugfix: "Pricing Table" menu disappears
* Improve HTML & CSS by removing a couple of !importants from my code
* Changes to email opt-in system
* Added Easy Pricing Tables Premium - preview

= Easy Pricing Tables 1.5.0.2 =
* Fixed incompatibility with netstudio-wp theme
* Added YouTube video link to readme.txt

= Easy Pricing Tables 1.5 =
* Easy Pricing Tables now supports translations (contact me if you'd like to submit a translation).
* Added Lithuanian language support. 
* Improved compatibility with legacy browsers (in particular old Internet Exploreer versions).
* Easy Pricing Tables is now compatible with http://wordpress.org/plugins/responsive-mobile-friendly-tooltip/.
* Small UI improvement: moved the "Pricing Tables" setting link in the left-hand navigation further down.

= Easy Pricing Tables 1.4.4 =
* Pricing Table editor UI improvements
* Added support for shortcode buttons like S2 member
* Fixed incompatibility with the Theme Foundry Basis theme
* Decreased file size of Easy Pricing Tables plugin
* Fixed CSS incompatibility with some themes
* Added an update notice

= Easy Pricing Tables 1.4.3 =
* Added the ability to clone existing pricing tables
* Added row IDs to pricing table HTML (now you can change alternate row colors using CSS)
* Bugfixes
* Fixed CSS conflicts with some themes
* Minor UX improvements


= Easy Pricing Tables 1.4.2.2 =
* Fixed versioning issue

= Easy Pricing Tables 1.4.2.1 =
* Updated readme.txt (FAQ, pricing table screenshots, markdown formatting issues)

= Easy Pricing Tables 1.4.2 =
* Updated readme.txt
* Added sidebar link to Easy Pricing Tables Premium
* Fixed CSS conflict with Dynamik Genesis Child Theme
* Added ability to rename "Most Popular" Featured Label

= Easy Pricing Tables 1.4.1 =
* Fixed pricing tables button-color bug introduced with version 1.4

= Easy Pricing Tables 1.4 =
* Bufix: Fixed Easy Pricing Tables CSS generation algorithm
* Fixed PHP 5.4 strict notices
* Improved compatibility with other plugins using the WPAlchemy framework
* UI improvements: Shortcodes can now be directly added via the editor
* After install, ask users if they want to allow usage tracking
* After install, ask users if they want to get a pricing-table mini-course
* Users can now change the text in the "most popular" label

= Easy Pricing Tables 1.3.2 =
* Improved CSS to cause less Easy Pricing Tables / theme conflicts
* Various bugfixes
* Refactored pricing table generation code
* UI improvements

= Easy Pricing Tables 1.3.1 =
* Minor Improvements

= Easy Pricing Tables 1.3 =
* Fixed incompatibility with s2 Member plugin
* Added font-size options
* Changed Easy Pricing Tables post-type 'public' => false
* Minor bugfixes
* Minor UI improvements

= Easy Pricing Tables 1.2.1 =
* Bugfix

= Easy Pricing Tables 1.2 =
* Added column drag & drop to pricing tables editor
* UI improvements
* Bugfixes
* Fixed CSS issues on the "Add new pricing tables"-page caused by WooThemes

= Easy Pricing Tables 1.1.2 =
* Fixed bug related to colorpicker introduced with version 1.1.0

= Easy Pricing Tables 1.1.1 =
* Fixed Woothems incompatibility

= Easy Pricing Tables 1.1.0 =
* Added new pricing tables design options (colors & rounded corners)
* Added tabs to backend Easy Pricing Tables UI
* Replaced default-text with HTML5 placeholder
* Various bugfixes
* Added new screenshots
* Added banner for Wordpress directory

= Easy Pricing Tables 1.0.2.1 =
* Minor CSS Bugfix

= Easy Pricing Tables 1.0.2 =
* Fixed typos
* Improved responsive CSS
* Improved button design
* Changed design of highlighted column
* Bugfixes

= Easy Pricing Tables 1.0.1 =
* Improved readme.txt of Easy Pricing Tables

= Easy Pricing Tables 1.0.0 =
* Initial release of Easy Pricing Tables


== Upgrade Notice ==



`<?php code(); // goes in backticks ?>`
