<?php

function camping_booking_admin_style() {
  wp_enqueue_style('admin-styles', plugin_dir_url( __FILE__ ) . '/styles/admin.css');
}
add_action('admin_enqueue_scripts', 'camping_booking_admin_style');