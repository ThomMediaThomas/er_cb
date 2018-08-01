<?php

function add_pages_bookings() {
    add_submenu_page( 'edit.php?post_type=booking', __('Kalender'), __('Kalender'), 'manage_options', 'bookings_calendar', 'page_bookings_calendar' ); 
} 

function page_bookings_calendar() {
  include('pages/calendar.php');      
}

add_action('admin_menu', 'add_pages_bookings');