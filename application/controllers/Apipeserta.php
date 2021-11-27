<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Apipeserta extends CI_Controller {

    function __construct()
	{
		parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('M_Apipeserta');
    }

    function getPesertaByNIK() {
        header('Access-Control-Allow-Origin: *');
        $NIK = $this->input->post("nik");
        $data = $this->M_Apipeserta->getPesertaByNIK($NIK);
        echo json_encode(array("response" => $data));
    }
    
}

?>