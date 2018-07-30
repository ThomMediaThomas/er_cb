<?php
// Register Custom Post Type
function post_type_bookings() {

   $labels = array(
      'name'                  => 'bookings',
      'singular_name'         => 'booking',
      'menu_name'             => 'Boekingen',
      'name_admin_bar'        => 'Boeking',
      'archives'              => 'Boekingsarchief',
      'attributes'            => 'Boekingsattributen',
      'parent_item_colon'     => 'Parent-item:',
      'all_items'             => 'Alle boekingen',
      'add_new_item'          => 'Nieuwe boeking toevoegen',
      'add_new'               => 'Nieuwe toevoegen',
      'new_item'              => 'Nieuwe boeking',
      'edit_item'             => 'Boeking bewerken',
      'update_item'           => 'Boeking bijwerken',
      'view_item'             => 'Boeking bekijken',
      'view_items'            => 'Boekingen bekijken',
      'search_items'          => 'Boeking zoeken',
      'not_found'             => 'Niets gevonden',
      'not_found_in_trash'    => 'Niets gevonden in de prullenbak',
      'featured_image'        => 'Featured Image',
      'set_featured_image'    => 'Set featured image',
      'remove_featured_image' => 'Remove featured image',
      'use_featured_image'    => 'Use as featured image',
      'insert_into_item'      => 'Insert into item',
      'uploaded_to_this_item' => 'Uploaded to this item',
      'items_list'            => 'Boekingsoverzicht',
      'items_list_navigation' => 'Boekingsoverzicht-navigatie',
      'filter_items_list'     => 'Boekingsoverzicht filteren',
   );
   $args = array(
      'label'                 => 'booking',
      'description'           => 'Booking',
      'labels'                => $labels,
      'supports'              => array( 'title' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 5,
      'menu_icon'             => 'dashicons-calendar-alt',
      'show_in_admin_bar'     => true,
      'show_in_nav_menus'     => true,
      'can_export'            => true,
      'has_archive'           => true,
      'exclude_from_search'   => true,
      'publicly_queryable'    => false,
      'rewrite'               => false,
      'capability_type'       => 'page',
      'show_in_rest'          => false,
   );
   register_post_type('booking', $args);

}
add_action('init', 'post_type_bookings', 0);