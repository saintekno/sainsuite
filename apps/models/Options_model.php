<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Options_Model extends CI_Model
{
    private $options = array();

    public function __construct()
    {
        $this->init();
    }

    /**
     * Is being loader after active modules has been loaded
    **/
    public function init()
    {
        global $Options;
        $Options = $this->options = $this->get();
    }

    /**
     * If language is set on dashboard
    **/
    public function defineLanguage()
    {
        get_instance()->config->set_item('site_language', $this->events->apply_filters( 'site_language', $this->get( 'site_language', 'en_US' ) ) );
    }

    /**
     * Set option
     *
     * Save quickly option to database
     *
     * @access : public
     * @param : string
     * @param : vars
     * @param : int user_id
     * @param : string script context ([app_namespace]/[app_type]), example : 'blogster/module' , 'avera/theme'
     * @return : void
    **/
    public function set($key, $value, $app = 'system')
    {
        global $Options;

        // get option if exists
        if ($key != null) {
            $this->db->where('key', $key);
        }

        $Options[ $key ]  = $value;
        
        $value = is_array($value) ? json_encode($value) : $value;                 // converting array to JSON
        $value = is_bool($value) ? $value === true ? 'true' : 'false' : $value;  // Converting Bool to string
        
        $query   = $this->db->get('options');
        $options = $query->result_array();

        if ($options) 
        {
            $this->db->where('key', $key);

            $this->db->update('options', array(
                'key'      => $key,
                'value'    => $value,
                'app'      => $app
            ));
        } 
        else {
            $this->db->insert('options', array(
                'key'      => $key,
                'value'    => $value,
                'app'      => $app
            ));
        }
    }

    /**
     * Get option
     *
     * Get option from database
     *
     * @access : public
     * @param : string
     * @param : int user id
     * @return : var (can return null if key is not set)
    **/
    public function get($key = null)
    {
        // option general otpions can be saved on global options array for autoload parameters. User Parameters must be loaded from db.
        if ( ! empty( @$this->options[ $key ] ) ) {
            return $this->options[ $key ];
        } 

        if ($key !== null) {
            $this->db->where('key', $key);
        }

        // fetch data
        $query = $this->db->get('options');
        $option = $query->result_array();

        // if there is any result
        if ($key != null) 
        {
            if ($option) 
            {
                $value = riake('value', farray($option));
                $value = is_array($array = json_decode($value, true)) ? $array : $value; // converting array to JSON
                $value = in_array($value, array( 'true', 'false' )) ? $value === 'true' ? true : false : $value; // Converting Bool to string

                // Internal Cache
                $this->options[ $key ] = $value;
                    
                return $value;
            }
        } 
        else {
            $key_value = array();
            foreach ($option as $_option) 
            {
                $value = riake('value', $_option);
                $value = is_array($array = json_decode($value, true)) ? $array : $value; // converting array to JSON
                $value = in_array($value, array( 'true', 'false' )) ? $value === 'true' ? true : false : $value;  // Converting Bool to string

                $key_value[ riake('key', $_option) ] = $value;
                // Internal Cache
                $this->options[ riake('key', $_option) ] = $value;
            }
            return $key_value;
        }
        return null;
    }

    /**
     * Delete Option
     *
     * @access : public
     * @param : string
     * @param : int users id
     * @return : bool
    **/
    public function delete($key = null, $app = 'system')
    {
        // Each options can't be deleted
        if ($key == null && $app == 'system') {
            return false;
        }

        // get only data from key
        if ($key != null): $this->db->where('key', $key);
        endif;

        // filter app option
        $this->db->where('app', $app);
        
        // fetch data
        return $this->db->delete('options');
    }
}
