<?php
   /*
   Plugin Name: Camping-boekingstool
   Plugin URI: http://thommedia.nl
   description: Deze plugin wordt gebruikt voor het maken en bijhouden van reserveringen en boekingen.
   Version: 0.1
   Author: Thomas Bartels
   Author URI: http://thommedia.nl
   License: -   */

include( plugin_dir_path( __FILE__ ) . 'includes/global.php');
include( plugin_dir_path( __FILE__ ) . 'scripts.php');
include( plugin_dir_path( __FILE__ ) . 'styles.php');

include( plugin_dir_path( __FILE__ ) . 'includes/bookings/add-booking-post-type.php');
include( plugin_dir_path( __FILE__ ) . 'includes/bookings/all-bookings-overview.php');
include( plugin_dir_path( __FILE__ ) . 'includes/bookings/add-submenus.php');
include( plugin_dir_path( __FILE__ ) . 'includes/bookings/auto-generate-booking-title.php');

include( plugin_dir_path( __FILE__ ) . 'includes/endpoints/bookings.php');

include( plugin_dir_path( __FILE__ ) . 'includes/accomodations/add-accomodation-post-type.php');
include( plugin_dir_path( __FILE__ ) . 'includes/accomodations/all-accomodations-overview.php');