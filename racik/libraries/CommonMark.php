<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * Web App Starter CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 0.8
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

/**
 * Interface for converting CommonMark text to HTML using any library for which
 * a driver/adapter is available.
 */
class CommonMark
{
    /**
     * The adapter which communicates with the conversion library.
     * @var CommonMarkDriver
     */
    protected $adapter;

    /** @var CI_Controller The CI instance. */
    protected $ci;

    /** @var string The name of the default driver/adapter. */
    protected $defaultDriver = 'MarkdownExtended';

    /** @var string The name of the driver/adapter. */
    protected $driver;

    /** @var array The names of the valid driver(s)/adapter(s). */
    protected $valid_drivers = array('MarkdownExtended');

    /**
     * Get the configured/supplied driver name and load it.
     *
     * @param array $params An array of configuration values. Currently supports
     * 'driver' and 'defaultDriver'.
     */
    public function __construct(array $params = array())
    {
        $this->ci = get_instance();

        // If a valid driver was passed, set it.
        if (! empty($params['driver'])
            && in_array($params['driver'], $this->valid_drivers)
        ) {
            $this->driver = $params['driver'];
        }

        // If a valid default driver was passed, set it.
        if (! empty($params['defaultDriver'])
            && in_array($params['defaultDriver'], $this->valid_drivers)
        ) {
            $this->defaultDriver = $params['defaultDriver'];
        }

        // If the driver is still not set, use the default driver.
        if (empty($this->driver)) {
            $this->driver = $this->defaultDriver;
        }

        $this->loadDriver();
    }

    /**
     * Load the driver which will interface with the conversion library.
     *
     * @param string $driver The name of the driver to load. If omitted, or if
     * $driver is not in the list of valid drivers, $this->driver will be used.
     *
     * @return void
     */
    public function loadDriver($driver = '')
    {
        // If a valid driver was supplied, use it.
        if (! empty($driver) && in_array($driver, $this->valid_drivers)) {
            $this->driver = $driver;
        }

        // Load the abstract driver which the drivers extend.
        require_once(RPPATH . 'libraries/CommonMark/CommonMarkDriver.php');

        // Load the driver and set it as the adapter.
        $driverName = "CommonMark_{$this->driver}";
        $this->ci->load->library("CommonMark/drivers/{$driverName}");
        $driverName = strtolower($driverName);
        $this->adapter = $this->ci->{$driverName};
    }

    /**
     * Convert the CommonMark text to HTML.
     *
     * @param  string $text The CommonMark text to convert.
     *
     * @return string       The result of the conversion (HTML text).
     */
    public function convert($text)
    {
        return $this->adapter->convert($text);
    }
}
