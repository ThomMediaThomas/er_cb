<?php
   /*
   Plugin Name: Camping-boekingstool
   Plugin URI: http://thommedia.nl
   description: Deze plugin wordt gebruikt voor het maken en bijhouden van reserveringen en boekingen.
   Version: 0.1
   Author: Thomas Bartels
   Author URI: http://thommedia.nl
   License: -   */

include( plugin_dir_path( __FILE__ ) . 'includes/add-booking-post-type.php');
include( plugin_dir_path( __FILE__ ) . 'includes/all-bookings-overview.php');