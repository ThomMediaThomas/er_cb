<?php

wp_register_script('calendar-contextmenu-scripts', plugin_dir_url( __FILE__ ) . '/scripts/vendor/contextMenu.min.js');
wp_register_script('calendar-scripts', plugin_dir_url( __FILE__ ) . '/scripts/pages/calendar.js');
wp_register_script('edit-booking-scripts', plugin_dir_url( __FILE__ ) . '/scripts/pages/edit-booking.js');

function camping_booking_admin_scripts () {
  wp_enqueue_script('calendar-contextmenu-scripts');
  wp_enqueue_script('calendar-scripts');
  wp_enqueue_script('edit-booking-scripts');
}

add_action('admin_enqueue_scripts', 'camping_booking_admin_scripts');