<?php

namespace Springdevs\BPS\Admin;

/**
 * Subscription Handler
 *
 * Class Subscription
 * @package Springdevs\BPS\Admin
 */
class Subscription
{
    public function __construct()
    {
        add_filter("subscrpt_simple_enable_checkbox_classes", [$this, "show_subscription_checkbox"]);
    }

    public function show_subscription_checkbox($class)
    {
        return $class . " show_if_bulk";
    }
}
