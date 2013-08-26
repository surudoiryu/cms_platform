<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name CI Smarty
* @copyright Dwayne Charrington, 2011.
* @author Dwayne Charrington and other Github contributors
* @license (DWYWALAYAM) 
           Do What You Want As Long As You Attribute Me Licence
* @version 1.2
* @link http://ilikekillnerds.com
*/

require_once APPPATH."third_party/Smarty/Smarty.class.php";

class CI_Smarty extends Smarty {

    public function __construct()
    {
        parent::__construct();

        // Store the Codeigniter super global instance... whatever
        $CI = get_instance();

        //$CI->load->config('smarty');	
		
        $this->template_dir      = SMARTY_TEMPLATE_DIRECTORY;//config_item('template_directory');
        $this->compile_dir       = SMARTY_COMPILE_DIRECTORY;//config_item('compile_directory');
        $this->cache_dir         = SMARTY_CACHE_DIRECTORY;//config_item('cache_directory');
        $this->config_dir        = SMARTY_CONFIG_DIRECTORY;//config_item('config_directory');
        $this->template_ext      = SMARTY_TEMPLATE_EXT; //config_item('template_ext');
        $this->exception_handler = null;
        
        // Only show serious errors. Without this if you try and use variables that
        // do not exist, Smarty will throw variable does not exist errors
        $this->error_reporting   = SMARTY_ERROR_REPORTING;//config_item('error_reporting');

        // Add all helpers to plugins_dir
        $helpers = glob(APPPATH . 'helpers/', GLOB_ONLYDIR | GLOB_MARK);
		$basehelpers = glob(BASEPATH . 'helpers/', GLOB_ONLYDIR | GLOB_MARK);

        foreach ($helpers as $helper)
        {
            $this->plugins_dir[] = $helper;
        }
        
        foreach ($basehelpers as $bhelper)
        {
            $this->plugins_dir[] = $bhelper;
        }		
		
        // Should let us access Codeigniter stuff in views
        $this->assign("this", $CI);
    }

}