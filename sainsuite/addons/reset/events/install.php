<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020-2021 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */
class Resets_Install extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();

        // Installation
        $this->events->add_action('do_after_db_setup', [ $this, 'enable_addon' ] );
    }

    public function enable_addon()
    {
        MY_Addon::enable('reset');
    }
}
new Resets_Install;