<?php

namespace Springdevs\BPS;

use Springdevs\BPS\Admin\Order;
use Springdevs\BPS\Admin\Product;
use Springdevs\BPS\Admin\Subscription;

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
        require_once BPS_INCLUDES . '/Illuminate/Classes/ProductType.php';
    }
}
