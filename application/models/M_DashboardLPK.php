<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_DashboardLPK extends CI_Model{ 

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function dataLPK($id){
        $this->db->select('*');
        $this->db->from('table_user a');
        $this->db->join('table_login b', 'b.kode_user = a.kode_user');
        $this->db->join('table_pengurus c', 'c.kode_user = a.kode_user');
        $this->db->where('a.kode_user', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function dataLPKdas($id){
        $this->db->select('*');
        $this->db->from('table_user a');
        $this->db->join('table_login b', 'b.kode_user = a.kode_user');
        $this->db->join('table_pengurus c', 'c.kode_user = a.kode_user');
        $this->db->where('a.kode_user', $id);
      
        $query = $this->db->get();
        return $query->row();
    }

    public function dataLaporan($id){
        $this->db->select('*');
        $this->db->from('table_laporan a');
        $this->db->join('table_user b', 'b.kode_user = a.kode_user');
        $this->db->where('a.kode_user', $id);
        $query = $this->db->get();
        return $query->result();
    }
    
     public function dataLaporandes($id){
        $this->db->select('*');
        $this->db->from('table_laporan a');
        $this->db->join('table_user b', 'b.kode_user = a.kode_user');
        $this->db->where('a.kode_user', $id);
        $this->db->order_by("a.tanggal_lapor", "desc");
        $query = $this->db->get();
        return $query->row();
    }

}