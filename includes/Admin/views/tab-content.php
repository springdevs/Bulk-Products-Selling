<div id='bulk_products_options' class='panel woocommerce_options_panel'>
    <div class='options_group'>
        <p class="form-field">
            <label for="bulk_products"><?php esc_html_e('Linked products', 'woocommerce'); ?></label>
            <select class="wc-product-search" multiple="multiple" style="width: 50%;" id="bulk_products" name="bulk_products[]" data-sortable="true" data-placeholder="<?php esc_attr_e('Search for a product&hellip;', 'woocommerce'); ?>" data-action="woocommerce_json_search_products" data-exclude="<?php echo intval(get_the_ID()); ?>">
                <?php
                $product_ids = get_post_meta(get_the_ID(), '_bpselling_bulk_products', true);
                if (!$product_ids || !is_array($product_ids)) $product_ids = [];
                foreach ($product_ids as $product_id) :
                    $product = wc_get_product($product_id);
                ?>
                    <option value="<?php echo esc_attr($product_id) . '"' . selected(true, true, false); ?>"><?php echo htmlspecialchars(wp_kses_post($product->get_formatted_name())); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
    </div>
</div>