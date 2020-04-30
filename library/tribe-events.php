<?php
 
add_filter( 'tribe_get_event_website_link_label', 'tribe_get_event_website_link_label_default' );
 
//Modern Tribe Events change the text from the URL to a “Visit Website →”
function tribe_get_event_website_link_label_default( $label ) {
 
    if ( $label === tribe_get_event_website_url() ) {
        $label = "Visit Website »";
        return '<a href="' . tribe_get_event_website_url() . '">' . $label . '</a>';
    }
 
    return $label;
}

add_action('wp_loaded', function() {
    $query = new WP_Query([
        'post_type' => 'tribe_events',
        'post_status' => '-1',
        'posts_per_page' => -1
    ]);
    if ($query->have_posts()) {
        foreach ($query->posts as $p) {
            $p->post_status = 'publish';
            wp_update_post($p);
        }
    }
});

add_filter('tribe_aggregator_before_insert_event', 'tribe_status_fix');
add_filter('tribe_aggregator_before_save_event', 'tribe_status_fix');

function tribe_status_fix($event) {
    if (isset($event['post_status']) && $event['post_status'] == -1) {
        $event['post_status'] = 'publish';
    }
    return $event;
}