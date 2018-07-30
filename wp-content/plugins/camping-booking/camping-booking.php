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

include( plugin_dir_path( __FILE__ ) . 'includes/add-booking-post-type.php');
include( plugin_dir_path( __FILE__ ) . 'includes/add-accomodation-post-type.php');
include( plugin_dir_path( __FILE__ ) . 'includes/all-bookings-overview.php');
include( plugin_dir_path( __FILE__ ) . 'includes/all-accomodations-overview.php');

function camping_booking_admin_style() {
  wp_enqueue_style('admin-styles', plugin_dir_url( __FILE__ ) . '/admin.css');
}
add_action('admin_enqueue_scripts', 'camping_booking_admin_style');