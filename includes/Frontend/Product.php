<?php

namespace Springdevs\BPS\Frontend;

/**
 * Class Product
 * @package Springdevs\BPS\Frontend
 */
class Product
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_scripts']);
        add_action('woocommerce_single_product_summary', [$this, 'bulk_cart_template'], 30);
        add_action('woocommerce_add_to_cart', [$this, "bulk_add_to_cart"], 10, 2);
    }

    public function enqueue_scripts()
    {
        wp_enqueue_style('bulk_css');
    }

    public function bulk_cart_template()
    {
        global $product;
        if ('bulk' == $product->get_type()) {

            $template_path = BPS_PATH . '/templates/';
            // Load the template
            wc_get_template(
                'single-product/add-to-cart/bulk.php',
                '',
                '',
                trailingslashit($template_path)
            );
        }
    }

    public function bulk_add_to_cart($cart_item_key, $product_id)
    {
        $product = wc_get_product($product_id);
        if ($product->is_type('bulk')) {
            $bulk_products = get_post_meta($product_id, '_bpselling_bulk_products', true);
            if (!$bulk_products && !is_array($bulk_products)) $bulk_products = [];
            foreach ($bulk_products as $bulk_product) WC()->cart->add_to_cart($bulk_product, 1, 0, [], ['bulk_product' => $product_id]);
        }
    }
}
