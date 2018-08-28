<?php
/**
 * Plugin Name:          Woocommerce Coming Soon
 * Plugin URI:           https://github.com/WorksOnline/woocommerce-coming-soon
 * Description:          Simple plugin that changes products status to coming soon
 * Author:               Johan Nielsen
 * Author URI:           https://github.com/0dp
 * Text Domain:          woocommerce-coming-soon
 * Domain Path:          /languages
 * Version:              1.0
 * Requires at least:    4.4
 * Tested up to:         4.9
 * WC requires at least: 3.0
 * WC tested up to:      3.4
 * @package              Woocommerce_Coming_Soon
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


// Add metabox to products
add_action( 'add_meta_boxes', 'wco_meta_boxes' );

function wco_meta_boxes( $meta_boxes )
{

    add_meta_box(
        'wco_meta_boxes',
        __('Coming Soon', 'woocommerce-coming-soon'),
        'wco_meta_boxes_callback',
        'product',
        'side',
        'default'
    );
}

function wco_meta_boxes_callback ($post )
{
    woocommerce_wp_checkbox(
        array(
            'id'      => 'coming_soon',
            'value'   => get_post_meta( get_the_ID(), 'coming_soon', true ),
            'label'   => __('Enable Coming Soon ', 'woocommerce-coming-soon'),
            'desc_tip' => false,
            'description' => '<br/><br/>' . __('If you enable this feature, the product will be displayed as coming soon', 'woocommerce-coming-soon'),
        )
    );
}

add_action( 'woocommerce_process_product_meta', 'wco_meta_boxes_save_fields', 10, 2 );

function wco_meta_boxes_save_fields( $id, $post )
{
    update_post_meta( $id, 'coming_soon', $_POST['coming_soon'] );
}
