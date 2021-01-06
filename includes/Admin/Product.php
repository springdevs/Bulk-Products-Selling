<?php

namespace Springdevs\BPSelling\Admin;

/**
 * Product Handler
 *
 * Class Product
 * @package Springdevs\BPSelling\Admin
 */
class Product
{
    public function __construct()
    {
        add_filter('product_type_selector', [$this, 'add_type']);
        add_action('woocommerce_product_options_general_product_data', function () {
            echo '<div class="options_group show_if_bulk clear"></div>';
        });
        add_filter('woocommerce_product_data_tabs', [$this, 'bulk_pricing_tab']);
        add_action('woocommerce_product_data_panels', [$this, 'bulk_products_options_tab_content']);
        add_action('save_post_product', [$this, 'save_bulk_data']);
        add_action('admin_footer', [$this, 'enable_js_on_wc_product']);
    }

    public function add_type($types)
    {
        $types['bulk'] = __('Bulk Products', 'sdevs_wea');
        return $types;
    }

    public function bulk_pricing_tab($tabs)
    {
        $tabs['bulk_products'] = array(
            'label'     => __('Bulk Products', 'wcpt'),
            'target' => 'bulk_products_options',
            'class'  => ['show_if_bulk'],
        );
        return $tabs;
    }

    public function bulk_products_options_tab_content()
    {
        include 'views/tab-content.php';
    }

    public function save_bulk_data($post_id)
    {
        if (isset($_POST['bulk_products']) && is_array($_POST['bulk_products'])) {
            update_post_meta($post_id, '_bpselling_bulk_products', $_POST['bulk_products']);
        }
    }

    public function enable_js_on_wc_product()
    {
        global $post, $product_object;
        if (!$post) return;
        if ('product' != $post->post_type) return;
        $is_bulk = $product_object && 'bulk' === $product_object->get_type() ? true : false;
        include_once 'views/footer-script.php';
    }
}
