<?php
/*
Plugin Name: MobileEPS for WordPress
Plugin URI: http://brooke.codes/projects/mobileesp4wp
Description: This WordPress plugin will detect mobile devices and redirect the user. This plugin uses the <a href="http://blog.mobileesp.com/">MobileESP</a> detection script (under Apache License 2.0) and is based almost entirely on Mobile Device Detect by <a href="http://straightvisions.com/"> Matthias Reuter</a> 
Version: 1.6
Date: 2016, October 4th
Author: Brooke.
Author URI: https://broo.ke
*/
/*
Note: This plugin draws inspiration (and sometimes code) from: 
   Mobile Device Detect (http://wordpress.org/extend/plugins/mobile-device-detect/)  by Matthias Reuter(http://straightvisions.com) 
   MobileESP (http://blog.mobileesp.com)
   */
/*  
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

define('WPMOBILEESP_PLUGINFILE', trailingslashit(dirname(__FILE__)). 'lib/mdetect.php' );

function mobileesp_redirectscript( ) {
// load plugin functions
if(file_exists(WPMOBILEESP_PLUGINFILE)){
	//include the plugin file
	require_once(WPMOBILEESP_PLUGINFILE);
	
	//check for wp_redirect function if it's not there include it

	if(!function_exists('wp_redirect')) { 
		require(ABSPATH . WPINC . '/pluggable.php');
	}
	
	//Let's see if we should set the full site cookie
	$get_cookie_check = (( !empty( $_GET['view_full_site'] ) ) && ('true' == strtolower( $_GET['view_full_site'] ) || 'false'  == strtolower( $_GET['view_full_site'] )) ? $_GET['view_full_site'] :  "");
	
	//strip the http://www from the domain 
	$site_url  =  site_url();
	$domain  =  parse_url($site_url, PHP_URL_HOST);
		if($get_cookie_check =='true'){
			//set the cookie
			setcookie("mobileesp_wp_full_site", 1, time()+86400, "/", $domain);
			$_COOKIE['mobileesp_wp_full_site'] = 1;

		}
		if($get_cookie_check =='false'){
			//set the cookie
			setcookie("mobileesp_wp_full_site", 0, time()-3600, "/", $domain);
			$_COOKIE['mobileesp_wp_full_site'] = 0;

		}
	
	//cookie variable
	$full_site_cookie= $_COOKIE['mobileesp_wp_full_site']; 
	
	//make sure the targert url is set and full site cookie isn't set
	if((esc_url(get_option('mobileesp_wp_target_url') != '')) && (empty($full_site_cookie))){
		$uagent_obj = new uagent_info();
		$detect_mobile = $uagent_obj->DetectMobileLong();
		//check for a mobile browser and redirect the user 
		if (($detect_mobile == 1)) {
		  wp_redirect(esc_url(get_option('mobileesp_wp_target_url')));
			exit();
		   }
		}
}
}

add_action('template_redirect', 'mobileesp_redirectscript');


// Hook for adding menu
function mobileeps_wp_add_menu() {
	add_options_page('MobileESP for WP', 'MobileESP for WP', 8, __FILE__, 'admin_options_wp_mobileesp');
}
add_action('admin_menu', 'mobileeps_wp_add_menu');


function admin_options_wp_mobileesp(){
	  if (!current_user_can('manage_options'))  {
	  	  wp_die( __('You do not have sufficient permissions to access this page.') );
    	  }
	echo '
	<div class="wrap">
		<h2>MobileESP for WordPress Settings</h2>
		<p>This WordPress plugin will detect mobile devices and redirect the user. For this plugin to work you must first enter the redirect url below. 
		You must also create a mobile site or have content at that location. </p>
		<form method="post" action="options.php">
			'.wp_nonce_field('update-options').'
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="mobileesp_wp_target_url">Where do we send mobile devices?</label></th>
					<td><input type="text" name="mobileesp_wp_target_url" id="mobileesp_wp_target_url" value="'.esc_url(get_option('mobileesp_wp_target_url')).'" class="regular-text code" /></td>
				</tr>
			</table>
			<input type="hidden" name="action" value="update" />
			<input type="hidden" name="page_options" value="mobileesp_wp_target_url" />
			<p class="submit"><input type="submit" name="Submit" value="Submit" class="button-primary" /></p>
		</form>
	</div>
	';
}
?>