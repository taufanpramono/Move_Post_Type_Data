<?php 


function move_single_post_type_a_to_b() {
    $args = array(

        // initial post type ==================== //
        'post_type' => 'post_type_key', 
        'posts_per_page' => -1, 
        'post_status' => 'any', 
        'tax_query' => array(
            array(
                'taxonomy' => 'taxonomy_key', 
                'field' => 'slug',
                'terms' => 'category_key'
            )
        )
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();

            // destination post type ==================== //
            wp_update_post(array(
                'ID' => $post_id,
                'post_type' => 'post_type_key'
            ));
        }
    }
    wp_reset_postdata();
}

add_action('init', 'move_single_post_type_a_to_b');




 ?>