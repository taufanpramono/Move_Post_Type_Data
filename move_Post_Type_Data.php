<?php 


function move_single_post_type_a_to_b() {
    $args = array(

        // POST TYPE ASAL
        'post_type' => 'hb_room', //slug / key post type asal
        'posts_per_page' => -1, // Ambil semua data post type asal
        'post_status' => 'any', // Ambil semua status posting publish, draft, private dll
        'tax_query' => array(
            array(
                'taxonomy' => 'hb_room_type', //slug taxonomy
                'field' => 'slug',
                'terms' => 'non-pool' //slug kategori 
            )
        )
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $post_id = get_the_ID();

            // POST TYPE TUJUAN
            wp_update_post(array(
                'ID' => $post_id,
                'post_type' => 'sewa-villa'
            ));
        }
    }
    wp_reset_postdata();
}

add_action('init', 'move_single_post_type_a_to_b');




 ?>