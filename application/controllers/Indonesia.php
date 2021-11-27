<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Indonesia extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Tools', 'tools');

    }

    public function get_provinsi()
    {
        $provincesData = $this->tools->get_provinsi();

        echo json_encode($provincesData);
    }

    public function get_kota()
    {
        $provincesId = $this->input->post('provincesId');

        $regenciesData = $this->tools->get_kota($provincesId);

        echo json_encode($regenciesData);

    }

    public function get_kecamatan()
    {
        $regenciesId = $this->input->post('regenciesId');

        $districtsData = $this->tools->get_kecamatan($regenciesId);

        echo json_encode($districtsData);

    }

    public function get_kelurahan()
    {
        $districtsId = $this->input->post('districtsId');

        $villagesData = $this->tools->get_kelurahan($districtsId);

        echo json_encode($villagesData);

    }
}
