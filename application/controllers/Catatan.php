<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
// use Restserver\Libraries\REST_Controller;

class Catatan extends REST_Controller {

    var $id_user = null;

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->model('m_catatan');

        $username = $this->post('username');
        $password = $this->post('password');
        $login = $this->m_login->login($this->post('username'), $this->post('password'));
        if ($login == null) {
            $data['status'] = "0";
            $data['keterangan'] = "Login salah";
            $this->response($data, 401);
            return;
        }

        $this->id_user = $login->id;
    }

    function ambil_post() {
        $id = $this->post('id');
        if ($id == null) {
            $data = $this->m_catatan->ambil_catatan();
        } else {
            $data = $this->m_catatan->ambil_catatan_id($id);
        }
        $this->response($data, 200);
    }

    function tambah_post() {
        $catatan = $this->post('catatan');
        $status = $this->post('status');
        $data = $this->m_catatan->ambil_catatan();
        
        $this->response($data, 200);
    }


}
?>