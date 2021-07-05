<?php

namespace Springdevs\BPS;

use Springdevs\BPS\Frontend\Cart;
use Springdevs\BPS\Frontend\Order;
use Springdevs\BPS\Frontend\Product;

/**
 * Frontend handler class
 */
class Frontend
{
    /**
     * Frontend constructor.
     */
    public function __construct()
    {
        $this->dispatch_actions();
        new Product;
        new Order;
        new Cart;
    }

    /**
     * Dispatch and bind actions
     *
     * @return void
     */
    public function dispatch_actions()
    {
        require_once BPS_INCLUDES . '/Illuminate/Classes/ProductType.php';
    }
}
