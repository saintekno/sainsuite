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
class Reset extends MY_Addon
{

    public function __construct()
    {
        parent::__construct();
    }
	
	/**
	 * Reset table
	 * @return void
	**/
	
	function index()
	{
		if (! User::control('manage.core') ) : 
			$this->session->set_flashdata('info_message', __( 'Youre not allowed to see that page.' ));
			redirect(site_url('admin/page404'));
		endif;

		if ( isset( $_GET[ 'reset-process' ] ) ) {
			unlink( APPPATH . '/config/database.php' );
			$this->load->dbforge();
			
			$this->dbforge->drop_database( $this->db->database );
			
			// doing log_user_out
			if ($this->aauth->logout() == null) {
				redirect( array( 'install' ) );
			}
		}
        
        // Title
		Polatan::set_title( get('signature') );

		$this->events->add_action( 'dashboard_footer', function () {
			$this->addon_view( 'reset', 'prompt' );
		});

        $this->polatan->output();
	}

}