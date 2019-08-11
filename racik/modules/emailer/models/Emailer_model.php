<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * An open source project to allow developers to Starter Web App of CodeIgniter-based
 *
 * @package   Racik
 * @copyright Copyright (c) 2019
 * @since     Version 1.2
 * @link      https://github.com/boedwinangun/racik
 * @filesource
 */

/**
 * Emailer Model
 *
 */
class Emailer_model extends RP_Model
{
    /** @var string Name of the table. */
    protected $table_name = 'email_queue';

    /** @var string Name of the primary key. */
    protected $key = 'id';

    /** @var bool Whether to use soft deletes. */
    protected $soft_deletes = false;

    /** @var string The date format to use. */
    protected $date_format = 'datetime';

    /** @var bool Whether to set the created time automatically. */
    protected $set_created = false;

    /** @var bool Whether to set the modified time automatically. */
    protected $set_modified = false;
}
