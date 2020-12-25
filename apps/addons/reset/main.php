<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */
class Resets_Addons extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();
        
        $this->lang->load_lines(dirname(__FILE__) . '/language/*.php');

		$this->events->add_action( 'load_dashboard', array( $this, 'reset_table' ) );
		$this->events->add_action( 'dashboard_footer', [ $this, 'footer' ]);
    }
	
	/**
	 * Reset table
	 * @return void
	**/
	
	function reset_table()
	{
		if ( isset( $_GET[ 'reset-process' ] ) ) {
			unlink( APPPATH . '/config/database.php' );
			$this->load->dbforge();
			
			$this->dbforge->drop_database( $this->db->database );
			
			// doing log_user_out
			if ($this->aauth->logout() == null) {
				redirect( array( 'install' ) );
			}
		}
	}

	/**
	 * Dashboard Footer
	 * @return view
	 */
	public function footer()
	{
		$this->load->addon_view( 'reset', 'prompt' );
	}
}
new Resets_Addons;