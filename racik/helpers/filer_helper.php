<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * Web App Starter CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 0.1
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

/**
 * Filer helper functions.
 *
 * Functions to aid in reading and saving config items to and from configuration
 * files.
 *
 * @package Racik\Helpers\filer_helper
 */

// Ensure this is defined before using it in write_db_config().
defined('DIR_READ_MODE') || define('DIR_READ_MODE', 0755);

if (! function_exists('read_config')) {
    /**
     * Return an array of configuration settings from a single config file.
     *
     * @param string  $file           The config file to read.
     * @param boolean $failGracefully Whether to show errors or simply return false.
     * @param string  $module         Name of the module where the config file exists.
     * @param boolean $moduleOnly     Whether to fail if config does not exist in
     * module directory.
     *
     * @return array An array of settings, or false on failure (if $failGracefully
     * is true).
     */
    function read_config($file, $failGracefully = true, $module = '', $moduleOnly = false)
    {
        $file = $file == '' ? 'config' : str_replace('.php', '', $file);

        // Look in module first
        $found = false;
        if ($module) {
            $fileDetails = Modules::file_path($module, 'config', "{$file}.php");
            if (! empty($fileDetails)) {
                $file = str_replace('.php', '', $fileDetails);
                $found = true;
            }
        }

        // Fall back to application directory
        if (! $found && ! $moduleOnly) {
            $checkLocations = array();

            if (defined('ENVIRONMENT')) {
                $checkLocations[] = APPPATH . 'config/' . ENVIRONMENT . "/{$file}";
            }

            $checkLocations[] = APPPATH . "config/{$file}";

            foreach ($checkLocations as $location) {
                if (file_exists($location . '.php')) {
                    $file = $location;
                    $found = true;
                    break;
                }
            }
        }

        if (! $found) {
            if ($failGracefully === true) {
                return false;
            }

            show_error("The configuration file {$file}.php does not exist.");
        }

        include($file . '.php');

        if (! isset($config) || ! is_array($config)) {
            if ($failGracefully === true) {
                return false;
            }

            show_error("Your {$file}.php file does not appear to contain a valid configuration array.");
        }

        return $config;
    }
}

if (! function_exists('write_config')) {
    /**
     * Save the passed array settings into a single config file located in the
     * config directory.
     *
     * @param string $file     The config file to write to.
     * @param array  $settings An array of config setting name/value pairs to be
     * written to the file.
     * @param string $module   Name of the module where the config file exists.
     *
     * @return boolean False on error, else true.
     */
    function write_config($file = '', $settings = null, $module = '', $apppath = APPPATH)
    {
        if (empty($file) || ! is_array($settings)) {
            return false;
        }

        $configFile = "config/{$file}";

        // Look in module first.
        $found = false;
        if ($module) {
            $fileDetails = Modules::find($configFile, $module, '');
            if (! empty($fileDetails) && ! empty($fileDetails[0])) {
                $configFile = implode('', $fileDetails);
                $found = true;
            }
        }
        
        // Look for in environment
        if (! $found)  {
            $checkLocations = array();
            if (defined('ENVIRONMENT')) {
                $checkLocations[] = APPPATH . 'config/' . ENVIRONMENT . "/{$file}";
            }
            $checkLocations[] = APPPATH . "config/{$file}";
            foreach ($checkLocations as $location) {
                if (file_exists($location . '.php')) {
                    $configFile = $location;
                    $found = true;
                    break;
                }
            }
        }
        
        // Fall back to application directory.
        if (! $found) {
            $configFile = "{$apppath}{$configFile}";
            $found = is_file($configFile . '.php');
        }

        // Load the file and loop through the lines.
        if ($found) {
            $contents = file_get_contents($configFile . '.php');
            $empty = false;
        } else {
            // If the file was not found, create a new file.
            $contents = '';
            $empty = true;
        }

        foreach ($settings as $name => $val) {
            // Is the config setting in the file?
            $start  = strpos($contents, '$config[\'' . $name . '\']');
            $end    = strpos($contents, ';', $start);
            $search = substr($contents, $start, $end - $start + 1);

            // Format the value to be written to the file.
            if (is_array($val)) {
                // Get the array output.
                $val = config_array_output($val);
            } elseif (! is_numeric($val)) {
                $val = "\"$val\"";
            }

            // For a new file, just append the content. For an existing file, search
            // the file's contents and replace the config setting.
            //
            // @todo Don't search new files at the beginning of the loop?

            if ($empty) {
                $contents .= '$config[\'' . $name . '\'] = ' . $val . ";\n";
            } else {
                $contents = str_replace(
                    $search,
                    '$config[\'' . $name . '\'] = ' . $val . ';',
                    $contents
                );
            }
        }

        // Backup the file for safety.
        $source = $configFile . '.php';
        $dest = ($module == '' ? "{$apppath}archives/{$file}" : $configFile)
            . '.php.bak';

        if ($empty === false) {
            copy($source, $dest);
        }

        // Make sure the file still has the php opening header in it...
        if (strpos($contents, '<?php') === false) {
            $contents = "<?php defined('BASEPATH') || exit('No direct script access allowed');\n\n{$contents}";
        }

        // Write the changes out...
        if (! function_exists('write_file')) {
            get_instance()->load->helper('file');
        }
        $result = write_file("{$configFile}.php", $contents);

        return $result !== false;
    }
}