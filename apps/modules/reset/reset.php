<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Eracik_Reset extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->events->add_action( 'load_dashboard', array( $this, 'reset_table' ) );
		$this->events->add_action( 'dashboard_footer', [ $this, 'footer' ]);
	}
	
	/**
	 * Reset table
	 * @return void
	**/
	
	function reset_table()
	{
		if ( isset( $_GET[ 'reset-process' ] ) ) 
		{
			unlink( APPPATH . '/config/database.php' );

			$this->load->dbforge();
			$this->dbforge->drop_database( $this->db->database );
			
			redirect( array( 'do-setup' ) );
		}
	}

	/**
	 * Dashboard Footer
	 * @return view
	 */
	
	public function footer()
	{
		$this->load->module_view( 'reset', 'prompt' );
	}
}
new Eracik_Reset;