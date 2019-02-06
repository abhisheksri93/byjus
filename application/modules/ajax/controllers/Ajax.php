<?php

class Ajax extends MX_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ajax_model', 'update');
        ini_set('auto_detect_line_endings', TRUE);
    }

    public function index()
    {
        $data['heading'] = 'Page Not Found';
        $data['message'] = 'The URL you requested doesnot Exists';
        $this->load->view('errors/html/error_404', $data);
    }

    function randomDigits($length)
    {
        $digits = '';
        $numbers = range(1, 9);
        shuffle($numbers);
        for ($i = 0; $i < $length; $i++)
            $digits .= $numbers[$i];
        return $digits;
    }
}

?>