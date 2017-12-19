<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
// use Restserver\Libraries\REST_Controller;

class Login extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    function index_post() {
        $data = $this->m_login->login($this->post('username'), $this->post('password'));
        if ($data != null) {
            $this->response($data, 200);
        }
    }

}
?>