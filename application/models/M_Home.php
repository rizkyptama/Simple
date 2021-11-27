<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Home extends CI_Model{ 

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function dataSlider(){
        $this->db->select('*');
        $this->db->from('table_slider');
        $this->db->where('kode_user', 'ADMIN');
        $query = $this->db->get();
        return $query->result();
    }

    public function dataYoutube(){
        $this->db->select('*');
        $this->db->from('table_youtube');
        $this->db->where('kode_user', 'ADMIN');
        $query = $this->db->get();
        return $query->result();
    }

    public function dataMarque(){
        $this->db->select('*');
        $this->db->from('table_marquetext');
        $this->db->where('kode_user', 'ADMIN');
        $query = $this->db->get();
        return $query->result();
    }

    public function periodeDaftar($kode){
        $this->db->select('tanggal_daftar');
        $this->db->from('table_peserta_pelatihan a');
        // $this->db->join('table_pelatihan b', 'b.kode_pelatihan = a.kode_pelatihan');
        $this->db->join('table_peserta c', 'c.nik = a.nik');
        $this->db->where('a.nik', $kode);
        $query = $this->db->get();
        return $query->result();
    }

    public function dataBerita($limit){
        $this->db->select('*');
        $this->db->from('table_berita');
        $this->db->limit($limit);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function dataBeritaDetail($id){
        $this->db->select('*');
        $this->db->from('table_berita');
        $this->db->where('id', $id);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function dataPelatihan($limit){
        $this->db->select('*');
        $this->db->from('table_pelatihan a');
        $this->db->join('table_jenis b', 'b.kode_jenis = a.kode_jenis');
        $this->db->join('table_kategori c', 'c.kode_kategori = a.kode_kategori');
        $this->db->limit($limit);
        $this->db->order_by('a.kode_pelatihan', 'DESC');
        $this->db->where('a.status', 'Aktif');
        $query = $this->db->get();
        return $query->result();
    }

    public function dataLPK($limit){
        $this->db->select('*');
        $this->db->from('table_user a');
        $this->db->join('table_login b', 'b.kode_user = a.kode_user');
        $this->db->join('table_pengurus c', 'c.kode_user = a.kode_user');
        $this->db->limit($limit);
        $this->db->order_by('b.created_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function dataLPKPagination($limit, $offset){
        $this->db->select('*');
        $this->db->from('table_user a');
        $this->db->join('table_login b', 'b.kode_user = a.kode_user');
        $this->db->join('table_pengurus c', 'c.kode_user = a.kode_user');
        $this->db->limit($limit, $offset);
        $this->db->order_by('b.created_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function dataLPKCount(){
        $this->db->select('a.kode_user');
        $this->db->from('table_user a');
        $this->db->join('table_login b', 'b.kode_user = a.kode_user');
        $this->db->join('table_pengurus c', 'c.kode_user = a.kode_user');
        $this->db->order_by('b.created_date', 'DESC');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function dataLPKdetail($id){
        $this->db->select('*');
        $this->db->from('table_user a');
        $this->db->join('table_login b', 'b.kode_user = a.kode_user');
        $this->db->join('table_pengurus c', 'c.kode_user = a.kode_user');
        $this->db->where("a.kode_user", $id);
        $this->db->order_by('b.created_date', 'DESC');
        $query = $this->db->get();
        return $query->result();
    }

    public function dataPelatihanDetail($id){
        $this->db->select('*');
        $this->db->from('table_pelatihan a');
        $this->db->join('table_jenis b', 'b.kode_jenis = a.kode_jenis');
        $this->db->join('table_kategori c', 'c.kode_kategori = a.kode_kategori');
        $this->db->where('kode_pelatihan', $id);
        $query = $this->db->get();
        return $query->result();
    }

    public function dataPelatihanLain($id){
        $this->db->select('*');
        $this->db->from('table_pelatihan a');
        $this->db->join('table_jenis b', 'b.kode_jenis = a.kode_jenis');
        $this->db->join('table_kategori c', 'c.kode_kategori = a.kode_kategori');
        $this->db->where('kode_pelatihan !=', $id);
        $this->db->limit(4);
        $query = $this->db->get();
        return $query->result();
    }

    public function datajenis(){
        $this->db->select('*');
        $this->db->from('table_jenis');
        $query = $this->db->get();
        return $query->result();
    }

    public function checkPeserta($cari){
        $query = $this->db->query("SELECT * FROM table_peserta WHERE nik = '$cari'");
        if ($query->result() != NULL) {
            return $query->result();
        } else {
            return null;
        }
    }

}