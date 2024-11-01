<?php
/*
Plugin Name: WP Profile Link Renamed and Relinked
Plugin URI: http://www.sebs-studio.com/wp-plugins/
Description: If a subscriber is logged in then link to users profile is renamed to a more friendly text and the link is redirected to there profile page.
Version: 0.1
Author: Sebs Studio (Sebastien)
Author URI: http://www.sebs-studio.com

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

/* Detects if the logged in user is a subscriber. */
function is_subscriber(){
    global $current_user;
    return $current_user->caps[ 'subscriber' ];
}

add_action('register', 'register_replacement');
function register_replacement($link){
	if(!is_user_logged_in()){
		if(get_option('users_can_register'))
			$link = $before.'<li><a href="'.site_url('wp-login.php?action=register', 'login').'">'. __('Register').'</a></li>'.$after;
		else
			$link = '';
	}
	else{
		if(is_subscriber()){
			$link = $before.'<li><a href="'.admin_url().'profile.php">'. __('Your Profile').'</a>'.$after;
		}
		else{
			$link = $before.'<li><a href="'.admin_url().'">'. __('Control Panel').'</a>'.$after;
		}
	}
	return $link;
}
?>