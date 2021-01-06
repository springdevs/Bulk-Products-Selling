<?php

namespace Springdevs\BPSelling\Frontend;

/**
 * Class Order
 * @package Springdevs\BPSelling\Frontend
 */
class Order
{
    public function __construct()
    {
        add_action('woocommerce_checkout_create_order_line_item', [$this, 'save_order_item_product_meta'], 10, 4);
        add_filter('woocommerce_order_item_class', [$this, 'add_bulk_class_order_table'], 10, 2);
    }

    public function save_order_item_product_meta($item, $cart_item_key, $cart_item, $order)
    {
        if (isset($cart_item['bulk_product'])) {
            $item->update_meta_data('_bulk_product', $cart_item['bulk_product']);
        }
    }

    public function add_bulk_class_order_table($class, $item)
    {
        if (isset($item['_bulk_product'])) $class .= " bulk-product-cart";
        return $class;
    }
}
