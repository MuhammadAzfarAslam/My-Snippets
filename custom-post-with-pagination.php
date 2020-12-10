<?php
/**
* Template Name: Advisors Grid
*/
get_header();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'post_type' => 'advisor', // enter custom post type
    'orderby' => 'date',
    'posts_per_page'=> 6,
    'paged'=> $paged,
    'order' => 'DESC',
);
$wp_query = new WP_Query( $args );
if( $wp_query->have_posts() ):
    while( $wp_query->have_posts() ): $wp_query->the_post(); global $post;
    //Content goes here
    the_title();
    endwhile;
    next_posts_link();
    previous_posts_link();
endif;

get_footer();
?>