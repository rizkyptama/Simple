<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Tools extends CI_Model{ 

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    // public function read(){
    //     $this->db->select('*');
    //     $this->db->from('table_login');
    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function readBy($email, $password){
        $this->db->select('*');
        $this->db->from('table_login');
        $this->db->where('username', $email);
        $this->db->where('password', $password);
        $query = $this->db->get();
        return $query->row();
    }

    public function get_kode_user() {
    $kode = "";
    $this->db->select("REPLACE(kode_user, 'USER', '') as kode", FALSE);
    $this->db->order_by('(0 + kode)','DESC');
    $this->db->limit(1);
        $query = $this->db->get('table_user');//cek dulu apakah ada sudah ada kode di tabel.
        if($query->num_rows() <> 0){
           //jika kode ternyata sudah ada.
         $data = $query->row();
         $kode = intval($data->kode) + 1;
       }
       else {
           //jika kode belum ada
         $kode = 1;
       }
       return "USER".$kode;
    }


    public function get_kode_alamat() {
    $kode = "";
    $this->db->select("REPLACE(kode_alamat, 'ALM', '') as kode", FALSE);
    $this->db->order_by('(0 + kode)','DESC');
    $this->db->limit(1);
        $query = $this->db->get('table_alamat');//cek dulu apakah ada sudah ada kode di tabel.
        if($query->num_rows() <> 0){
           //jika kode ternyata sudah ada.
         $data = $query->row();
         $kode = intval($data->kode) + 1;
       }
       else {
           //jika kode belum ada
         $kode = 1;
       }
       return "ALM".$kode;
    }

    public function get_kode_pengurus() {
    $kode = "";
    $this->db->select("REPLACE(kode_user, 'USER', '') as kode", FALSE);
    $this->db->order_by('(0 + kode)','DESC');
    $this->db->limit(1);
        $query = $this->db->get('table_user');//cek dulu apakah ada sudah ada kode di tabel.
        if($query->num_rows() <> 0){
           //jika kode ternyata sudah ada.
         $data = $query->row();
         $kode = intval($data->kode) + 1;
       }
       else {
           //jika kode belum ada
         $kode = 1;
       }
       return "USER".$kode;
    }

    public function get_kode_jenis() {
    $kode = "";
    $this->db->select("REPLACE(kode_jenis, 'JENIS', '') as kode", FALSE);
    $this->db->order_by('(0 + kode)','DESC');
    $this->db->limit(1);
        $query = $this->db->get('table_jenis');//cek dulu apakah ada sudah ada kode di tabel.
        if($query->num_rows() <> 0){
           //jika kode ternyata sudah ada.
         $data = $query->row();
         $kode = intval($data->kode) + 1;
       }
       else {
           //jika kode belum ada
         $kode = 1;
       }
       return "JENIS".$kode;
    }

    public function get_kode_kategori() {
    $kode = "";
    $this->db->select("REPLACE(kode_kategori, 'KTG', '') as kode", FALSE);
    $this->db->order_by('(0 + kode)','DESC');
    $this->db->limit(1);
        $query = $this->db->get('table_kategori');//cek dulu apakah ada sudah ada kode di tabel.
        if($query->num_rows() <> 0){
           //jika kode ternyata sudah ada.
         $data = $query->row();
         $kode = intval($data->kode) + 1;
       }
       else {
           //jika kode belum ada
         $kode = 1;
       }
       return "KTG".$kode;
    }

    public function get_kode_pelatihan() {
    $kode = "";
    $this->db->select("REPLACE(kode_pelatihan, 'PLT', '') as kode", FALSE);
    $this->db->order_by('(0 + kode)','DESC');
    $this->db->limit(1);
        $query = $this->db->get('table_pelatihan');//cek dulu apakah ada sudah ada kode di tabel.
        if($query->num_rows() <> 0){
           //jika kode ternyata sudah ada.
         $data = $query->row();
         $kode = intval($data->kode) + 1;
       }
       else {
           //jika kode belum ada
         $kode = 1;
       }
       return "PLT".$kode;
    }

    public function get_kode_laporan() {
    $kode = "";
    $this->db->select("REPLACE(kode_lapor, 'LPR', '') as kode", FALSE);
    $this->db->order_by('(0 + kode)','DESC');
    $this->db->limit(1);
        $query = $this->db->get('table_lapor_detail');//cek dulu apakah ada sudah ada kode di tabel.
        if($query->num_rows() <> 0){
           //jika kode ternyata sudah ada.
         $data = $query->row();
         $kode = intval($data->kode) + 1;
       }
       else {
           //jika kode belum ada
         $kode = 1;
       }
       return "LPR".$kode;
    }

    public function cek_nik($id){
        $this->db->select('*');
        $this->db->from('table_peserta');
        $this->db->where('nik', $id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function cek_periode($id){
        $this->db->select('tanggal_daftar');
        $this->db->from('table_peserta_pelatihan');
        $this->db->where('nik', $id);
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->result();
    }

     public function get_provinsi()
    {
        $query = $this->db->get('provinces')->result();
        return $query;
    }

    public function get_kota($province_id)
    {
        $this->db->select('*');
        $this->db->from('provinces');
        $this->db->where('name', $province_id);
        $query = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from('regencies');
        $this->db->where('province_id', '32');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_kecamatan($regencies_id)
    {
        $this->db->select('*');
        $this->db->from('regencies');
        $this->db->where('name', $regencies_id);
        $query = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from('districts');
        $this->db->where('regency_id', '3276');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_kelurahan($district_id)
    {
        $this->db->select('*');
        $this->db->from('districts');
        $this->db->where('name', $district_id);
        $query = $this->db->get()->row();

        $this->db->select('*');
        $this->db->from('villages');
        $this->db->where('district_id', $query->id);
        $query = $this->db->get();
        return $query->result();
    }
}