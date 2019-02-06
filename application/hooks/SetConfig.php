<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetConfig extends MX_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index($var = 0)
    {
        die('Wrong');
    }

    public function SetConfig()
    {
        $var = array();

        $this->load->model('Common_model', 'helper');
        $config = $this->helper->get_settings();

        foreach ($config as $key => $value)
            $var[$value->settings_name] = $value->settings_value;
        
        //redefine base_url through db
        if(isset($var['base_url']) && !is_null($var['base_url']))
            $this->config->set_item('base_url', $var['base_url']);
    }
}
