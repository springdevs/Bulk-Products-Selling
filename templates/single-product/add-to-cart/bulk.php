<?php

/**
 * Bulk Product [ Add to cart ]
 */
if (!defined('ABSPATH')) {
    exit;
}

global $product;

if (!$product->is_purchasable()) {
    return;
}

do_action('bulk_product_before_add_to_cart_form');

$product_ids = get_post_meta($product->get_id(), '_bpselling_bulk_products', true);
if (!$product_ids || !is_array($product_ids)) $product_ids = [];
?>

<form class="bulk_product_cart" method="post" enctype='multipart/form-data'>
    <ul>
        <?php
        foreach ($product_ids as $product_id) :
            $product_obj = wc_get_product($product_id);
        ?>
            <li><a href="<?php echo get_the_permalink($product_id); ?>"><?php echo $product_obj->get_name(); ?></a></li>
        <?php endforeach; ?>
    </ul>
    <br>
    <?php do_action("woocommerce_before_add_to_cart_button"); ?>
    <button type="submit" name="add-to-cart" value="<?php echo esc_attr($product->get_id()); ?>" class="single_add_to_cart_button button alt"><?php echo esc_html($product->single_add_to_cart_text()); ?></button>
</form>
<br>
<?php do_action('bulk_product_after_add_to_cart_form'); ?>