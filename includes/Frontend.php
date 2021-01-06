<?php

namespace Springdevs\BPSelling;

use Springdevs\BPSelling\Frontend\Order;
use Springdevs\BPSelling\Frontend\Product;

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
    }

    /**
     * Dispatch and bind actions
     *
     * @return void
     */
    public function dispatch_actions()
    {
        require_once BPSELLING_INCLUDES . '/Illuminate/Classes/ProductType.php';
    }
}
