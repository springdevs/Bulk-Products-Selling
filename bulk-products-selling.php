<?php

// don't call the file directly
if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Sdevs_bpselling class
 *
 * @class Sdevs_bpselling The class that holds the entire Sdevs_bpselling plugin
 */
final class Sdevs_bpselling
{
    /**
     * Plugin version
     *
     * @var string
     */
    const version = '1.0.0';

    /**
     * Holds various class instances
     *
     * @var array
     */
    private $container = [];

    /**
     * Constructor for the Sdevs_bpselling class
     *
     * Sets up all the appropriate hooks and actions
     * within our plugin.
     */
    private function __construct()
    {
        $this->define_constants();

        add_action('plugins_loaded', [$this, 'init_plugin']);
    }

    /**
     * Initializes the Sdevs_bpselling() class
     *
     * Checks for an existing Sdevs_bpselling() instance
     * and if it doesn't find one, creates it.
     *
     * @return Sdevs_bpselling|bool
     */
    public static function init()
    {
        static $instance = false;

        if (!$instance) {
            $instance = new Sdevs_bpselling();
        }

        return $instance;
    }

    /**
     * Magic getter to bypass referencing plugin.
     *
     * @param $prop
     *
     * @return mixed
     */
    public function __get($prop)
    {
        if (array_key_exists($prop, $this->container)) {
            return $this->container[$prop];
        }

        return $this->{$prop};
    }

    /**
     * Magic isset to bypass referencing plugin.
     *
     * @param $prop
     *
     * @return mixed
     */
    public function __isset($prop)
    {
        return isset($this->{$prop}) || isset($this->container[$prop]);
    }

    /**
     * Define the constants
     *
     * @return void
     */
    public function define_constants()
    {
        define('BPSELLING_VERSION', self::version);
        define('BPSELLING_FILE', __FILE__);
        define('BPSELLING_PATH', dirname(BPSELLING_FILE));
        define('BPSELLING_INCLUDES', BPSELLING_PATH . '/includes');
        define('BPSELLING_URL', plugins_url('', BPSELLING_FILE));
        define('BPSELLING_ASSETS', BPSELLING_URL . '/assets');
    }

    /**
     * Load the plugin after all plugis are loaded
     *
     * @return void
     */
    public function init_plugin()
    {
        $this->includes();
        $this->init_hooks();
    }

    /**
     * Include the required files
     *
     * @return void
     */
    public function includes()
    {
        if ($this->is_request('admin')) {
            $this->container['admin'] = new Springdevs\BPSelling\Admin();
        }

        if ($this->is_request('frontend')) {
            $this->container['frontend'] = new Springdevs\BPSelling\Frontend();
        }

        if ($this->is_request('ajax')) {
            // require_once BPSELLING_INCLUDES . '/class-ajax.php';
        }
    }

    /**
     * Initialize the hooks
     *
     * @return void
     */
    public function init_hooks()
    {
        add_action('init', [$this, 'init_classes']);
    }

    /**
     * Instantiate the required classes
     *
     * @return void
     */
    public function init_classes()
    {
        if ($this->is_request('ajax')) {
            // $this->container['ajax'] =  new Springdevs\BPSelling\Ajax();
        }

        $this->container['api']    = new Springdevs\BPSelling\Api();
        $this->container['assets'] = new Springdevs\BPSelling\Assets();
    }

    /**
     * What type of request is this?
     *
     * @param string $type admin, ajax, cron or frontend.
     *
     * @return bool
     */
    private function is_request($type)
    {
        switch ($type) {
            case 'admin':
                return is_admin();

            case 'ajax':
                return defined('DOING_AJAX');

            case 'rest':
                return defined('REST_REQUEST');

            case 'cron':
                return defined('DOING_CRON');

            case 'frontend':
                return (!is_admin() || defined('DOING_AJAX')) && !defined('DOING_CRON');
        }
    }
} // Sdevs_bpselling

/**
 * Initialize the main plugin
 *
 * @return \Sdevs_bpselling|bool
 */
function sdevs_bpselling()
{
    return Sdevs_bpselling::init();
}

/**
 *  kick-off the plugin
 */
sdevs_bpselling();
