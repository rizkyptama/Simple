<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Pelatihansimpel extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data kontak
    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('table_pelatihan')->result();
        } else {
            $this->db->where('kode_pelatihan', $id);
            $kontak = $this->db->get('table_pelatihan')->result();
        }
        $this->response($kontak, 200);
    }

    //Masukan function selanjutnya disini
}
?>