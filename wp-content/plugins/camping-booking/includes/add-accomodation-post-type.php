<?php
// Register Custom Post Type
function post_type_accommodations() {

   $labels = array(
      'name'                  => 'Accomodaties',
      'singular_name'         => 'Accomodatie',
      'menu_name'             => 'Accomodaties',
      'name_admin_bar'        => 'Accomodatie',
      'archives'              => 'Accomodatie-archief',
      'attributes'            => 'Accomodatie-attributen',
      'parent_item_colon'     => 'Parent-item:',
      'all_items'             => 'Alle accomodaties',
      'add_new_item'          => 'Nieuwe accomodatie toevoegen',
      'add_new'               => 'Nieuwe toevoegen',
      'new_item'              => 'Nieuwe accomodatie',
      'edit_item'             => 'Accomodatie bewerken',
      'update_item'           => 'Accomodatie bijwerken',
      'view_item'             => 'Accomodatie bekijken',
      'view_items'            => 'Accomodatie bekijken',
      'search_items'          => 'Accomodatie zoeken',
      'not_found'             => 'Niets gevonden',
      'not_found_in_trash'    => 'Niets gevonden in de prullenbak',
      'featured_image'        => 'Featured Image',
      'set_featured_image'    => 'Set featured image',
      'remove_featured_image' => 'Remove featured image',
      'use_featured_image'    => 'Use as featured image',
      'insert_into_item'      => 'Insert into item',
      'uploaded_to_this_item' => 'Uploaded to this item',
      'items_list'            => 'Accomodatie-overzicht',
      'items_list_navigation' => 'Accomodatie-overzicht-navigatie',
      'filter_items_list'     => 'Accomodatie-overzicht filteren',
   );
   $args = array(
      'label'                 => 'accommodation',
      'description'           => 'accommodation',
      'labels'                => $labels,
      'supports'              => array( 'title' ),
      'hierarchical'          => false,
      'public'                => true,
      'show_ui'               => true,
      'show_in_menu'          => true,
      'menu_position'         => 6,
      'menu_icon'             => 'dashicons-admin-multisite',
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
   register_post_type('accommodation', $args);

}
add_action('init', 'post_type_accommodations');