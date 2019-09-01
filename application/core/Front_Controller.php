<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Racik
 *
 * Web App Starter CodeIgniter-based
 *
 * @package     Racik
 * @copyright   Copyright (c) 2019
 * @version     1.0.0
 * @link        https://github.com/boedwinangun/racik
 * @filesource
 */

/**
 * Front Controller
 *
 * This class provides a common place to handle any tasks that need to
 * be done for all public-facing controllers.
 *
 * @package    Racik\Core\Controllers
 * @category   Controllers
 *
 */
class Front_Controller extends Base_Controller
{

    //--------------------------------------------------------------------

    /**
     * Class constructor
     *
     */
    public function __construct()
    {
        $this->autoload['libraries'][] = 'users/auth';
        $this->autoload['libraries'][] = 'template';
        $this->autoload['libraries'][] = 'assets';
        $this->autoload['libraries'][] = 'form_validation';

        parent::__construct();

        $this->form_validation->CI =& $this;
        $this->form_validation->set_error_delimiters('', '');
        
        Events::trigger('before_front_controller');

        $this->set_current_user();

        Events::trigger('after_front_controller');
    }//end __construct()

    //--------------------------------------------------------------------

}

/* End of file Front_Controller.php */
/* Location: ./application/core/Front_Controller.php */