<?php
function autogenerate_booking_title($post_id) {
	if (get_post_type($post_id) == 'booking' && (
        empty(get_the_title($post_id)) ||
        get_the_title($post_id) == 'Automatische concepten'
    )) {
    	$post_title = 'ER';
    	$post_title .= '_' . strtotime("now");
        $post_title .= '_' . substr(md5(microtime()),rand(0,26),5);

    	$my_post = array(
    		'ID'           => $post_id,
            'post_title' => $post_title
        );

        remove_action('save_post', 'autogenerate_booking_title'); //Avoid the infinite loop

        // Update the post into the database
        wp_update_post($my_post);
    }
}

add_action('save_post', 'autogenerate_booking_title');