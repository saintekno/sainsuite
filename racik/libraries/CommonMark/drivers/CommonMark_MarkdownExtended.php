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
 * CommonMark Driver for PHP Markdown Extra Extended v0.3
 *
 * Adapter to use the Markdown Extra Extended helper within the Racik CommonMark
 * library.
 */
class CommonMark_MarkdownExtended extends CommonMarkDriver
{
    /** @var string The class to instantiate and load into $this->converter. */
    protected $converterLib = 'MarkdownExtraExtended_Parser';

    /**
     * Load the Markdown Extended helper.
     *
     * @return boolean Returns true to indicate the helper has been loaded.
     */
    protected function init()
    {
        get_instance()->load->helper('markdown_extended');
        return true;
    }

    /**
     * The library method used to convert CommonMark to HTML.
     *
     * @param string $text CommonMark text to convert.
     *
     * @return string HTML text.
     */
    protected function toHtml($text)
    {
        return $this->converter->transform($text);
    }
}
