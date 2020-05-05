<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Pecee\SimpleRouter\SimpleRouter as Route;
use Pecee\Handlers\IExceptionHandler;
use Pecee\Http\Request;
use Pecee\SimpleRouter\Exceptions\NotFoundHttpException;

class Api extends Eracik_Controller
{
	public function __construct()
	{
		parent::__construct();
		// check if api key is correct
		$api = $this->db->where( 'key', $this->input->server( 'HTTP_X_API_KEY' ) )
			->get( 'restapi_keys' )
			->result_array();

		if( ! $api ) {
			return response()->httpCode( 403 )->json([
				'status'  => 'failed',
				'message' => __( 'Unable to authenticate the request. It seems like the API key provided is not valid.' )
			]);
		} 
		else {
			// check whether the user is connected or not
			if( User::id() === 0 ) 
			{
				// if user is not connected, we're using the API user id if it's provider
				if( $api[0][ 'user' ] != '0' ) {
					// login using using provide API
					$this->auth->login_fast( $api[0][ 'user' ] );
				} 
				else { 
					// the API is being accessed from external app, and the user is using system API
					return response()->httpCode( 403 )->json([
						'status'  => 'failed',
						'message' => 'core_keys_access_denied'
					]);
				}
			}
		}
	}
	
	/**
	* Index for API
	* @return void
	*/
	public function index( $page_slug ) 
	{
		global $Routes;
		
		$Routes = new Route();
		
		$Routes->group([ 'prefix' => substr( request()->getHeader( 'script-name' ), 0, -10 ) . '/api' ], function() use ( $page_slug, $Routes ) 
		{
			$modules = Modules::get();
			foreach( $modules as $namespace => $module ) 
			{
				if( ! Modules::is_active( $namespace ) ) {
					continue;
				}

				if( is_dir( $dir = MODULESPATH . $namespace . '/api/' ) ) {
					foreach( glob( $dir . "*.php") as $filename) {
						include_once( $filename );
					}
				}

				if( is_file( MODULESPATH . $namespace . '/api.php' ) ) {
					include_once( MODULESPATH . $namespace . '/api.php' );
				}
			}

			$modules = Modules::get( null, 'addins' );
			foreach( $modules as $namespace => $module ) 
			{
				if( is_dir( $dir = ADDINSPATH . $namespace . '/api/' ) ) {
					foreach( glob( $dir . "*.php") as $filename) {
						include_once( $filename );
					}
				}

				if( is_file( ADDINSPATH . $namespace . '/api.php' ) ) {
					include_once( ADDINSPATH . $namespace . '/api.php' );
				}
			}
		});

		$Routes->error(function($request, \Exception $exception) {
			if($exception instanceof NotFoundHttpException && $exception->getCode() == 404) {
				return response()->httpCode( 404 )->json([
					'status'  => 'failed',
					'message' => $exception->getMessage()
				], 404 );
			}
		});
		
		$Routes->start();    
	}
}