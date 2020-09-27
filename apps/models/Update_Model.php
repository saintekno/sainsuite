<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Update_Model extends CI_Model
{
    private static $api_releases = 'https://api.github.com/repos/racikproject/eracik/releases';

    public function __construct()
    {
        $this->load->library('curl');
        $this->load->library('Filer');

        $this->core_version = $this->config->item('core_version');

        // $this->auto_update();
    }

    /**
     * Check Update
     * @return bool/array
    **/

    public function check()
    {
        // Get Repo Check Version Releases
        $json_api = $this->curl->security(false)->get(self::$api_releases);

        $Do_update = array();

        if ($json_api != '') 
        {
            $latest_release = array();

            // Fetching the latest stable release;
            // Current Branch Release
            $array_api = json_decode($json_api, true);
            foreach ($array_api as $_rel) 
            {
                if (riake('prerelease', $_rel) === false && riake('draft', $_rel) === false) {
                    $latest_release = $_rel;
                    break;
                }
            }

            if (is_array($latest_release) && ! empty($latest_release)) 
            {
                // retreiving informations
                $release_version  = riake('tag_name', $latest_release);
                $latest_release = array(
                    'version'     => $release_version,
                    'name'        => riake('name', $latest_release),
                    'description' => riake('body', $latest_release),
                    'beta'        => riake('prerelease', $latest_release),
                    'published'   => riake('published_at', $latest_release),
                    'link'        => riake('zipball_url', $latest_release),
                );
                $Do_update[ 'core' ] = $latest_release;

                // Set to DB
                set_option('latest_release', $Do_update);
            }
        }

        // Setting Core Warning
        $array = array();
        if ($release = riake('core', $Do_update)) 
        {
            $release_int = str_replace('.', '', $release[ 'version' ]);
            $current_int = str_replace('.', '', $this->core_version);
            // if (true) 
            if ($release_int > $current_int) 
            { 
                $array[] = array(
                    'link'    => $release[ 'link' ],
                    'content' => $release[ 'description' ],
                    'title'   => $release[ 'name' ],
                    'date'    => $release[ 'published' ],
                    'version' => $release[ 'version' ]
                );
            }
        }

        return $array;
    }
}
