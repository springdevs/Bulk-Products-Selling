<?php

namespace Springdevs\BPS\Frontend;

/**
 * Class Cart
 * @package Springdevs\BPS\Frontend
 */
class Cart
{
    public function __construct()
    {
        add_filter("woocommerce_cart_item_class", [$this, "add_bulk_class"], 10, 2);
        add_action('woocommerce_before_calculate_totals', [$this, "calculate_cart_totals"], 99);
        add_action('woocommerce_remove_cart_item', [$this, 'remove_bulk_item_from_cart'], 10, 2);
        add_filter('woocommerce_widget_cart_item_visible', [$this, 'remove_bulk_item_from_mini_cart'], 10, 2);
        add_filter('woocommerce_cart_contents_count', [$this, 'change_cart_count']);
    }

    public function add_bulk_class($class, $cart_item)
    {
        if (isset($cart_item['bulk_product']) && $cart_item['bulk_product']) return $class . " bulk-product-cart";
        return $class;
    }

    public function calculate_cart_totals($cart_object)
    {
        if (!WC()->session->__isset("reload_checkout")) {
            foreach ($cart_object->cart_contents as $key => $value) if (isset($value['bulk_product']) && $value['bulk_product']) $value['data']->set_price(0);
        }
    }

    public function remove_bulk_item_from_cart($cart_item_key, $cart)
    {
        $product_id = $cart->cart_contents[$cart_item_key]['product_id'];
        $product = wc_get_product($product_id);
        if ($product->is_type('bulk')) {
            $bulk_products = get_post_meta($product_id, '_bpselling_bulk_products', true);
            if (!$bulk_products && !is_array($bulk_products)) $bulk_products = [];
            foreach ($cart->cart_contents as $cart_content_key => $cart_content) {
                if (isset($cart_content['bulk_product']) && $cart_content['bulk_product'] && $cart_content['bulk_product'] == $product_id && in_array($cart_content['product_id'], $bulk_products)) {
                    WC()->cart->remove_cart_item($cart_content_key);
                }
            }
        }
    }

    public function remove_bulk_item_from_mini_cart($visible, $cart_item)
    {
        if (isset($cart_item['bulk_product']) && $cart_item['bulk_product']) return false;
        return $visible;
    }

    public function change_cart_count($count)
    {
        $cart_items = WC()->cart->cart_contents;
        foreach ($cart_items as $cart_item) if (isset($cart_item['bulk_product']) && $cart_item['bulk_product']) $count -= 1;
        return $count;
    }
}
