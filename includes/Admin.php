<?php

namespace Springdevs\BPSelling;

use Springdevs\BPSelling\Admin\Order;
use Springdevs\BPSelling\Admin\Product;
use Springdevs\BPSelling\Admin\Subscription;

/**
 * The admin class
 */
class Admin
{

    /**
     * Initialize the class
     */
    public function __construct()
    {
        $this->dispatch_actions();
        new Product;
        new Subscription;
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
