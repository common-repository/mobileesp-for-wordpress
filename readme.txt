=== MobileESP for WordPress ===

Contributors: brookedot
Tags: mobile, redirect, mobileesp, browser
Requires at least: 2.8.3
Tested up to: 5.3.1
Stable tag: 1.6

Redirect mobile visitors to a mobile-optimized site.

== Description ==

<p>This WordPress plugin will detect mobile devices and redirect the user to the mobile-optimized site of your choice (such as subdomain or subfolder). </p>
<p>This plugin uses the <a href="http://blog.mobileesp.com/">MobileESP</a> by Anthony Hand as its detection script (under Apache License 2.0) and is based on <a href="http://wordpress.org/plugins/mobile-device-detect/"> Mobile Device Detect</a> by Matthias Reuter</p>
<p>Banner drawing by <a href="http://greyrain.com">Felix Wolfstrom</a>.</p>

== Installation ==

= Automattic Install (recommended) =
1. Login to your Dashboard as an admin.
2. Once logged in select Plugins > Add New from the main menu.
3. Next search for "mobileesp-for-wordpress" (no quotes) and click the install button.
4. Update the MobileESP for WordPress settings with the url you want mobile viewers to be redirected to.

= Manual Install =
1. Extract the contents of mobileesp_wp.zip and upload to the wp-content/plugins folder.
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Update the MobileESP for WordPress settings with the url you want mobile viewers to be redirected to.


== Frequently Asked Questions ==

= I activated the plugin and nothing happened =
This plugin will only redirect users who are viewing the site on a mobile device. You also must first update the redirect URL within the plugin settings.

= How can I give my users the option to view the full site =
If you want to use this feature set a link to "example.com/?view_full_site=true" anywhere on your mobile site. The cookie will expire after one day.
You may change the expiration time by changing the time()+86400 on line 43.

= What about back to the mobile site? =
This can be done one of two ways, you can either link to the mobile site directly (m.example.com) or you can clear the cookie by linking to "example.com/?view_full_site=false" anywhere on your WordPress install.

== Changelog ==

= 1.6 (2016/10/04 =
 * UPDATED mdetect.php lib to fileversion 2015.05.13
 * ENHANCEMENT Added icons to Repo for search.

= 1.5.3 (2013/03/13) =
 * BUGFIX  D'oh, how about we don't define `__DIR__` as a constant and just use `dirname(__FILE__)` instead? Sounds great!

= 1.5.2 (2013/03/13) =
 * BUGFIX  Was using `__DIR__` which failed on PHP versions prior to 5.3 so added work around.

= 1.5.1 (2013/03/08) =
 * UPDATED mdetect.php lib to fileversion 2013.08.01
 * ENHANCEMENT No longer uses minified PHP source. Wasn't doing anything anyway.
 * ENHANCEMENT Now uses `template_redirect` hook instead of no hook
 * ENHANCEMENT Readme.txt clean up and new banner image
 * BUGFIX Now allows access to wp-admin from a mobile phone
 * BUGFIX Will still work if the plugin folder name is changed
 * BUGFIX  Sanitize that user input, yo

 = 1.5 (2013/20/07) =
 * UPDATED mdetect.php lib to fileversion 2013.07.13

= 1.4 (2013/26/02) =
* UPDATED mdetect.php lib to newest version

= 1.3.1 (2011/12/04) =
 * BUGFIX Fixed the full-site redirect (for reals this time)

= 1.3 (2011/08/10) =
 * ADDED view_full_site = false to go back to mobile from full site.

= 1.2 (2011/08/09) =
 * UPDATED mdetect.php lib to newest version
 * BUGFIX Now only have to click on "full site url" once instead of twice.

= 1.1.3 (2011/04/06) =
 * Wrong Plugin Dir for lib class.

= 1.1.2 (2011/04/06) =
 * Lib folder was missing from last revision. Someday I'll get used to the SVN thing.

= 1.1.1 (2011/04/04) =
 * Added view full site option ability to have the mobile device not redirect by using a cookie.

= 1.1.0 (2011/04/02) =
 * Fixed bug preventing Android and iPhone from redirecting
 * Updated mdetect.php lib to newest version
 * Minified the PHP source

= 1.0.0 (2011/01/08) =
 * Inital release

== To Do ==

* Update options to allow various states of redirect for various devices, ie Android, iPhone, iPad, etc.
* Admin settings update with custom cookie time
