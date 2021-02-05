<?php

namespace Springdevs\BPSelling\Admin;

/**
 * Admin Order Handler
 *
 * Class Order
 * @package Springdevs\BillingCycle\Admin
 */
class Order
{
    public function __construct()
    {
        add_filter('woocommerce_order_item_display_meta_key', [$this, "change_order_item_meta_title"], 10, 3);
        add_filter('woocommerce_order_item_display_meta_value', [$this, "change_order_item_meta_value"], 20, 3);
    }

    public function change_order_item_meta_title($key, $meta, $item)
    {
        if ('_bulk_product' === $meta->key) {
            $key = __('Bulk items of', 'sdevs_wea');
        }
        return $key;
    }

    public function change_order_item_meta_value($value, $meta, $item)
    {
        if ('_bulk_product' === $meta->key) {
            $value = "<a href='" . get_the_permalink($value) . "' target='_blank'>" . get_the_title($value) . "</a>";
        }
        return $value;
    }
}
