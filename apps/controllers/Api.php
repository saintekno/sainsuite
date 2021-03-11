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

use Pecee\SimpleRouter\SimpleRouter as Route;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

class Api extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		// check if api key is correct
		// $api = $this->db->where( 'key', $this->input->server( 'HTTP_X_API_KEY' ) )
		// 	->get( 'restapi_keys' )
		// 	->result_array();

		// if( ! $api ) {
		// 	return response()->httpCode( 403 )->json([
		// 		'status' => 'failed',
		// 		'message' => __( 'Unable to authenticate the request. It seems like the API key provided is not valid.' )
		// 	]);
		// } 
		// else {
		// 	// check whether the user is connected or not
		// 	if( User::id() === 0 ) {
		// 		// if user is not connected, we're using the API user id if it's provider
		// 		if( $api[0][ 'user' ] != '0' ) {
		// 			// login using using provide API
		// 			$this->auth->login_fast( $api[0][ 'user' ] );
		// 		} 
		// 		else { 
		// 			// the API is being accessed from external app, and the user is using system API
		// 			return response()->httpCode( 403 )->json([
		// 				'status' =>	'failed',
		// 				'message' => 'core_keys_access_denied'
		// 			]);
		// 		}
		// 	}
		// }
	}

	public function login()
	{
		if ($_POST) {
			# code...
    		$response = array();
			$this->aauth->login(
				$this->input->post( 'email' ),
				$this->input->post( 'pass'),
				$this->input->post( 'keep_connected' ) != null ? true : false
			);
		
			if ($this->aauth->is_loggedin()) {

				$select = "
				aauth_users.*, 
				aauth_users.id as user_id, 
				aauth_groups.id as group_id,
				aauth_groups.name as group_name";

				$this->db->select($select)
					->from($this->aauth->config_vars[ 'users'])
					->join($this->aauth->config_vars[ 'user_to_group'], $this->aauth->config_vars['users'] . ".id = " . $this->aauth->config_vars['user_to_group'] . ".user_id")
					->join($this->aauth->config_vars[ 'groups' ], $this->aauth->config_vars[ 'groups' ] . '.id = ' . $this->aauth->config_vars['user_to_group']. '.group_id');
				
				$this->db->where($this->aauth->config_vars['users'] . '.id', $this->session->userdata('id'));
				$result = $this->db->get()->row();

				# code...
				$response['value']         = 1;
				$response['message']       = "Login Berhasil";
				$response['id']            = $result->user_id;
				$response['email']         = $result->email;
				$response['pass']          = $result->pass;
				$response['username']      = $result->username;
				$response['banned']        = $result->banned;
				$response['group']         = $result->group_name;
				$response['group_id']      = $result->group_id;
				$response['last_login']    = $result->last_login;
				$response['last_activity'] = $result->last_activity;
				$response['date_created']  = $result->date_created;
		
				echo json_encode($response);
			} 
			else {
				# code...
				$response['value']   = 0;
				$response['message'] = "Login Gagal";
				echo json_encode($response);
			}   
		}
	}

	public function lists($group_par = false)
	{
		$select = "
		aauth_users.*, 
		aauth_users.id as user_id, 
		aauth_groups.id as group_id,
		aauth_groups.name as group_name";

		$group_par = $this->aauth->get_group_id($group_par);

		$this->db->select($select)
			->from($this->aauth->config_vars[ 'users'])
			->join($this->aauth->config_vars[ 'user_to_group'], $this->aauth->config_vars['users'] . ".id = " . $this->aauth->config_vars['user_to_group'] . ".user_id")
			->join($this->aauth->config_vars[ 'groups' ], $this->aauth->config_vars[ 'groups' ] . '.id = ' . $this->aauth->config_vars['user_to_group']. '.group_id');
		
		$this->db->where_in($this->aauth->config_vars['user_to_group'] . '.group_id', $group_par);
		$result = $this->db->get()->result();

		echo json_encode($result); 
	}
	
	/**
	* Index for API
	* @return void
	*/
    public function _remap($page, $params = array())
	{
		global $Routes;
		
        if (method_exists($this, $page)) {
            return call_user_func_array(array( $this, $page ), $params);
        } 
        else {
			$Routes = new Route();
			
			$Routes->group([ 
				'prefix' => substr( request()->getHeader( 'script-name' ), 0, -10 ) . '/api' 
			], function() use ( $page, $Routes ) 
			{
				$addons = MY_Addon::get();
					
				foreach( force_array($addons) as $namespace => $addon )  
				{
					if( ! MY_Addon::is_active( $namespace ) ) {
						continue;
					}

					if( is_dir( $dir = ADDONSPATH . $namespace . '/api/' ) ) {
						foreach( glob( $dir . "*.php") as $filename) {
							include_once( $filename );
						}
					}

					if( is_file( ADDONSPATH . $namespace . '/api.php' ) ) {
						include_once( ADDONSPATH . $namespace . '/api.php' );
					}
				}
			});

			$Routes->error(function($request, \Exception $exception) {
				if($exception instanceof NotFoundHttpException && $exception->getCode() == 404) {
					return response()->httpCode( 404 )->json([
						'status'  	=>   'failed',
						'message' 	=>   $exception->getMessage()
					], 404 );
				}
			});
			
			$Routes->start();    
		}
	}
}