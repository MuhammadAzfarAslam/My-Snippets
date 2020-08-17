<?php 
    $storeuserid2 = $store_user->id;  // Get Author ID Here 
    $args = array(
        'post_type' => 'product',
        'post_status' => 'publish',
        'author'    => $storeuserid2 ,
        'posts_per_page' => -1 
    );
    
    $loop2 = new WP_Query( $args );
    if ( $loop2->have_posts() ) { 
        while ( $loop2->have_posts() ) : $loop2->the_post();
            // the_title();
            $post_categories[] = wc_get_product_category_list($product->get_id());
            $cats = array_unique($post_categories);
        endwhile;
        foreach($cats as $cat){
            echo $cat;
            echo '<br/>';
        }
    }
    else{
        echo 'No Products Found';
    }
    wp_reset_postdata();
                
?>