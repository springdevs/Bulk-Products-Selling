<br>
<strong>Included : </strong>
<?php
foreach ($order->get_items() as $order_item) :
    if (isset($order_item['_bulk_product']) && $product->get_id() == $order_item['_bulk_product']) :
        $item_product = $order_item->get_product();
        $product_permalink = apply_filters('woocommerce_order_item_permalink', $item_product->get_permalink($order_item), $order_item, $order);
?>
        <a href="<?php echo $product_permalink; ?>" target="_blank"><?php echo $order_item->get_name(); ?></a> ,
<?php
    endif;
endforeach;
