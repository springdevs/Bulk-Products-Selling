<?php

/**
 * Bulk Product Type
 */

if(!class_exists('WC_Product_Simple')) return;

class WC_Product_Bulk extends WC_Product_Simple
{

    public function __construct($product)
    {
        parent::__construct($product);
    }

    /**
     * Return the product type
     * @return string
     */
    public function get_type()
    {
        return 'bulk';
    }

    /**
     * Returns the product's active price.
     *
     * @param  string $context What the value is for. Valid values are view and edit.
     * @return string price
     */
    public function get_price($context = 'view')
    {
        if (current_user_can('manage_options')) {
            $price = $this->get_meta('_bulk_price', true);
            if (is_numeric($price)) {
                return $price;
            }
        }
        return $this->get_prop('price', $context);
    }
}
