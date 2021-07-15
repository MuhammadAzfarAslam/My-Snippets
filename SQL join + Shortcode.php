Select COUNT(oim.meta_value) AS NumberOfProducts, oim.meta_value as product_id, p.post_title 
FROM 
`wp_woocommerce_order_items` as oi 
INNER JOIN `wp_woocommerce_order_itemmeta` as oim on oi.order_item_id = oim.order_item_id
INNER JOIN `wp_posts` as p on oim.meta_value = p.ID
#INNER JOIN `wp_users` as u on p.post_author = u.id
WHERE
oim.meta_key = '_product_id'
AND
post_author=9
GROUP BY oim.meta_value


function pixarsart_order_status( $atts) { 
  $atts = shortcode_atts(array(
        'limit'=>'3',
	  'instrument'=>'"saxophone","trombone","trumpet"',
    ), $atts, 'pixarsart_order_status');
        global $wpdb;
$result = $wpdb->get_results (
        "
		Select 
            COUNT(oim.meta_value) AS NumberOfProducts, 
            oim.meta_value as product_id, 
            p.post_title 
        FROM 
            `wp_woocommerce_order_items` as oi 
            INNER JOIN `wp_woocommerce_order_itemmeta` as oim on oi.order_item_id = oim.order_item_id
            INNER JOIN `wp_posts` as p on oim.meta_value = p.ID
            #INNER JOIN `wp_users` as u on p.post_author = u.id
        WHERE
            oim.meta_key = '_product_id'
            AND
            post_author=9
        GROUP BY 
            oim.meta_value
        "
        );
 	echo '<pre>';
 	print_r($result);
 	echo '</pre>';	
// Things that you want to do. 
$message = '<div class="order_detail_table">
<table>
    <thead>
        <tr>
            <th>Sr. No</th>
            <th>Event Title</th>
            <th>Sold Tickets Count</th>
        </tr>
    </thead>'; 
 foreach($result as $key=>$value){
	
$message.=	 '
        <tr>
            <td>'.++$key.'</td>
            <td>'.$value->post_title.'</td>
            <td>'.$value->NumberOfProducts.'</td>
        </tr>
    ';
 }
	$message .= '</table></div>'; 
 
// Output needs to be return
 return $message;
} 
// register shortcode
add_shortcode('pixarsart_order_status', 'pixarsart_order_status');