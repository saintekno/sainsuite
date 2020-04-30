<?php
class Update_Model extends CI_model
{
    private static $api_releases = 'https://api.github.com/repos/racikproject/eracik/releases';

    private static $api_zip = 'https://codeload.github.com/racikproject/eracik/legacy.zip/';

    // Expect Do_code
    public function __construct()
    {
        parent::__construct();
        
        $this->load->library('curl');
        $this->load->library('Filer');

        $this->core_version = $this->config->item('core_version');

        $this->auto_update();
    }

    /**
     * Auto Update Feature
     *
     * @return int/void
    **/

    public function auto_update()
    {
        // Protecting
        if ( User::can('manage_core') ) 
        {
            $this->cache = new CI_Cache(array('adapter' => 'apc', 'backup' => 'file', 'key_prefix' => 'Do_update_' ));
            if (! $this->cache->get('regular_release') || ! $this->cache->get('major_release')) 
            {
                $json_api        = $this->curl->security(false)->get(self::$api_releases);
                $array_api       = json_decode($json_api, true);
                $regular_release = $this->config->item('core_version');
                $major_release   = $this->config->item('core_version');

                if (is_array($array_api) && $array_api) 
                {
                    // Fetch Auto update
                    foreach ($array_api as $_rel) 
                    {
                        if (is_array($_rel)) 
                        {
                            if (
                                version_compare($this->config->item('core_version'), $_rel[ 'tag_name' ], '<') &&
                                riake('prerelease', $_rel) === false &&
                                riake('draft', $_rel) === false
                            ) {
                                // La valeur change lorsqu'il y a une mise à jour supérieure
                                if (version_compare($regular_release, $_rel[ 'tag_name' ], '<')) {
                                    $regular_release = $_rel[ 'tag_name' ];
                                }
                                if (version_compare($major_release, $_rel[ 'tag_name' ], '<') && preg_match("/\#auto_update\#/", $_rel[ 'body' ])) {
                                    $major_release = $_rel[ 'tag_name' ];
                                }
                            }
                        }
                    }
                }

                // Save cache
                $this->cache->save('regular_release', $regular_release, 7200);
                $this->cache->save('major_release', $major_release, 7200);
            }

            // Auto Update
            if (version_compare($this->cache->get('major_release'), $this->config->item('core_version'), '>') && $this->config->item('force_major_updates') === true) 
            {
                if (isset($_GET[ 'install_update' ]) && is_dir(APPPATH . '/temp/core')) 
                {
                    $this->install(3, $this->cache->get('major_release'));
                    redirect(array( 'dashboard', 'about' ));
                }

                if (is_file(APPPATH . '/temp/eracik.zip')) 
                {
                    $this->install(2, $this->cache->get('major_release'));
                }

                if (! is_file(APPPATH . '/temp/eracik.zip') && ! is_dir(APPPATH . '/temp/core')) 
                {
                    $this->install(1, $this->cache->get('major_release'));
                }

                if (is_dir(APPPATH . '/temp/core') || ! isset($_GET[ 'install_update' ])) 
                {
                    $this->notice->push_notice(
                        Do_info(
                            sprintf(
                                __('An update is ready to be installed. <a href="%s">Click here to install it</a>'),
                                current_url() . '?install_update=true'
                            )
                        )
                    );
                }
            }

            // If any regular release exist or major update we show a notice
            if ($this->cache->get('regular_release') || $this->cache->get('major_release')) 
            {
                if (
                    version_compare($this->cache->get('regular_release'), $this->config->item('core_version'), '>') ||
                    version_compare($this->cache->get('major_release'), $this->config->item('core_version'), '>')
                ) {
                    $this->events->add_filter('update_center_notice_nbr', function ($nbr) {
                        return $nbr + 1;
                    });
                }
            }
        }
    }

    /**
     * Check Update
     * @return bool/array
    **/

    public function check()
    {
        // if (! riake( 'has_logged_store' , $_SESSION )) 
        // { 
        //     return false;
        // }
        
        $_SESSION[ 'has_logged_store' ] = true;
        
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

    /**
     * Get Release
     *
     * @param string release id
     * @return string error code
    **/

    public function get($release_version)
    {
        $json_api = $this->curl->security(false)->get(self::$api_releases);
        if ($json_api != '') 
        {
            $array_api = json_decode($json_api, true);
            
            $release = array();
            
            foreach ($array_api as $_rel) 
            {
                if (riake('tag_name', $_rel) == $release_version) 
                {
                    $release = $_rel;
                    break;
                }
            }

            if ($release) 
            {
                $release_int = intval(str_replace('.', '', riake('tag_name', $release)));
                $current_int = intval(str_replace('.', '', $this->core_version));

                if ($release_int > $current_int) 
                {
                    return riake('tag_name', $_rel); // get release tag_name
                }
                return 'old-release';
            }
        }
        return 'unknow-release';
    }

    /**
     * Install a release
     *
     * @param string version
     * @param string zipball name
     * @return array
    **/

    public function install($stage, $zipball = null)
    {
        $Do_zip = APPPATH . 'temp/eracik.zip';

        if ($stage === 1 && $zipball != null) 
        { 
            // for downloading
            $Do_zip_core = $this->curl->security(false)->get(self::$api_zip . $zipball);
            if (! empty($Do_zip_core)) 
            {
                file_put_contents($Do_zip, $Do_zip_core);
                return array(
                    'code' => 'archive-downloaded'
                );
            }
        } 
        elseif ($stage === 2) 
        { 
            if ( is_file($Do_zip) ) 
            {
                // for uncompressing
                $zip = new ZipArchive;
                if ($zip->open($Do_zip)) 
                {
                    if (is_dir(APPPATH . 'temp/core')) 
                    {
                        Filer::drop(APPPATH . 'temp/core'); // if any update failed, we drop temp/core before
                    }
                    mkdir(APPPATH . 'temp/core');
                    $zip->extractTo(APPPATH . 'temp/core');
                    $zip->close();
                }
                unlink($Do_zip); // removing zip file
                return array(
                    'code' => 'archive-uncompressed'
                );
            }
        } 
        elseif ($stage === 3) 
        { 
            // updating itself
            if (is_dir(APPPATH . 'temp/core')) 
            { 
                // looping internal dir
                $dir = opendir(APPPATH . 'temp/core');
                while (false !== ($file = readdir($dir))) 
                {
                    if (!in_array($file, array( '.', '..' ))) 
                    { 
                        $dirs = $file;
                        break;
                    }
                }

                $diroot = opendir(APPPATH . 'temp/core/' . $dirs);
                while (false !== ($files = readdir($diroot))) 
                {
                    if ($files == basename(BASEPATH)) 
                    { 
                        Filer::extractor(APPPATH . 'temp/core/' . $dirs .'/'. $files, BASEPATH);
                    }
                    elseif ($files == basename(APPPATH)) 
                    { 
                        Filer::extractor(APPPATH . 'temp/core/' . $dirs .'/'. $files, APPPATH);
                    }
                    elseif ($files == basename(FCPATH)) 
                    { 
                        Filer::extractor(APPPATH . 'temp/core/' . $dirs .'/'. $files, FCPATH);
                    }
                }
                // Filer::drop(APPPATH . 'temp/core'); // if any update failed, we drop temp/core before
                return array(
                    'code' => 'update-done'
                );
            }
        }

        return array(
            'code' => 'error-occured'
        );
    }
}
