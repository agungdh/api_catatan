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
        $id_user = $this->post('id_user');
        if ($id != null) {
            $data = $this->m_catatan->ambil_catatan_id($id);
        } elseif ($id_user != null) {
            $data = $this->m_catatan->ambil_catatan_id_user($id_user);
        } else {
            $data = $this->m_catatan->ambil_catatan();
        }
        
        $this->response($data, 200);
    }

    function tambah_post() {
        $catatan = $this->post('catatan');
        $status = $this->post('status');
        $data = $this->m_catatan->tambah_catatan($this->id_user, $catatan, $status);
        
        $this->response($data, 200);
    }

    function ubah_post() {
        $id = $this->post('id');
        $catatan = $this->post('catatan');
        $status = $this->post('status');
        $data = $this->m_catatan->ubah_catatan($id, $catatan, $status);
        
        $this->response($data, 200);
    }

    function hapus_post() {
        $id = $this->post('id');
        $catatan = $this->m_catatan->ambil_catatan_id($id);
        
        if ($catatan == null) {
            $data['id'] = $id;
            $data['status'] = "not found";
            
            $this->response($data, 404);            
        } else {
            $this->m_catatan->hapus_catatan($id);

            $data['id'] = $id;
            $data['status'] = "deleted";
            
            $this->response($data, 200);
        }
    }


}
?>