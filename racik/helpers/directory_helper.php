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
 * Racik Directory Helper
 *
 * @package Racik\Helpers\directory_helper
 */
if (! function_exists('bcDirectoryMap')) {
    /**
     * Create a Directory Map
     *
     * Reads the specified directory and builds an array
     * representation of it. Sub-folders contained with the
     * directory will be mapped as well.
     *
     * @param   string  $source_dir     Path to source
     * @param   int $directory_depth    Depth of directories to traverse (0 = fully recursive, 1 = current dir, etc)
     * @param   bool    $hidden         Whether to show hidden files
     * @return  array
     */
    function bcDirectoryMap($source_dir, $directory_depth = 0, $hidden = false)
    {
        if ($fp = @opendir($source_dir)) {
            $filedata   = array();
            $new_depth  = $directory_depth - 1;
            $source_dir = rtrim($source_dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

            while (false !== ($file = readdir($fp))) {
                // Remove '.', '..', and hidden files [optional]
                if ($file === '.'
                    || $file === '..'
                    || ($hidden === false && $file[0] === '.')
                ) {
                    continue;
                }

                if (($directory_depth < 1 || $new_depth > 0)
                    && is_dir($source_dir . $file)
                ) {
                    $filedata[$file] = bcDirectoryMap(
                        $source_dir . $file . DIRECTORY_SEPARATOR,
                        $new_depth,
                        $hidden
                    );
                } else {
                    $filedata[] = $file;
                }
            }

            closedir($fp);
            return $filedata;
        }

        return false;
    }
}