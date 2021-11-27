<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class M_Dashboard extends CI_Model{ 

  public function __construct(){
    parent::__construct();
    $this->load->database();
  }

  public function dataLaporan(){
    $this->db->select('*');
    $this->db->from('table_lapor_detail a');
    $this->db->join('table_laporan d', 'd.kode_lapor = a.kode_lapor');
    $this->db->join('table_pengurus c', 'c.kode_user = a.kode_user');
    $query = $this->db->get();
    return $query->result();
  }

  public function dataSlider($kode){
    $this->db->select('*');
    $this->db->from('table_slider');
    $this->db->where('kode_user', $kode);
    $query = $this->db->get();
    return $query->result();
  }

  public function dataYoutube($kode){
    $this->db->select('*');
    $this->db->from('table_youtube');
    $this->db->where('kode_user', $kode);
    $query = $this->db->get();
    return $query->result();
  }

  public function dataMarquetext($kode){
    $this->db->select('*');
    $this->db->from('table_marquetext');
    $this->db->where('kode_user', $kode);
    $query = $this->db->get();
    return $query->result();
  }

  public function dataHistory($kode){
    $this->db->select('*');
    $this->db->from('table_history');
    $this->db->where('kode_user !=', $kode);
    $this->db->limit(5);
    $this->db->order_by("waktu", "DESC");
    $query = $this->db->get();
    return $query->result();
  }

  public function dataHistoryAdmin($kode){
    $this->db->select('*');
    $this->db->from('table_history');
    $this->db->where('kode_user', $kode);
    $this->db->limit(5);
    $this->db->order_by("waktu", "DESC");
    $query = $this->db->get();
    return $query->result();
  }

  public function dataHelpDesk(){
    $this->db->select('*');
    $this->db->from('table_helpdesk');
    $query = $this->db->get();
    return $query->result();
  }

  public function dataBerita(){
    $this->db->select('*');
    $this->db->from('table_berita');
    $this->db->order_by('id', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function dataJenis(){
    $this->db->select('*');
    $this->db->from('table_jenis');
    $query = $this->db->get();
    return $query->result();
  }

  public function dataKategori(){
    $this->db->select('*');
    $this->db->from('table_kategori');
    $query = $this->db->get();
    return $query->result();
  }

  public function dataPelatihan(){
    $this->db->select('*');
    $this->db->from('table_pelatihan a');
    $this->db->join('table_jenis b', 'b.kode_jenis = a.kode_jenis');
    $this->db->join('table_kategori c', 'c.kode_kategori = a.kode_kategori');
    $this->db->order_by('a.kode_pelatihan', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function dataPesertaPelatihan(){
    $this->db->select('*, b.nama AS np');
    $this->db->from('table_peserta_pelatihan a');
    $this->db->join('table_peserta b', 'b.nik = a.nik');
    $this->db->join('table_pelatihan c', 'c.kode_pelatihan = a.kode_pelatihan');
    $this->db->join('table_alamat d', 'd.kode_alamat = b.kode_alamat');
    $this->db->order_by('a.id', 'DESC');
    $this->db->where('a.status !=', '0');
    $query = $this->db->get();
    return $query->result();
  }
  
  public function dataPelatihanPeserta($nik){
      $this->db->select("table_pelatihan.kode_pelatihan AS kode_pelatihan, table_pelatihan.nama AS nama_pelatihan, table_peserta_pelatihan.status AS status_pelatihan");
      $this->db->from("table_pelatihan, table_peserta_pelatihan");
      $this->db->where("table_peserta_pelatihan.kode_pelatihan = table_pelatihan.kode_pelatihan");
      $this->db->where("table_peserta_pelatihan.nik=" ,$nik);
      $query = $this->db->get();
      return $query->result();
  }

  public function dataLPK(){
    $this->db->select('*');
    $this->db->from('table_user a');
    $this->db->join('table_login b', 'b.kode_user = a.kode_user');
    $this->db->join('table_pengurus c', 'c.kode_user = a.kode_user');
    $this->db->order_by('b.created_date', 'DESC');
    $query = $this->db->get();
    return $query->result();
  }

  public function LPK($kode){
    $this->db->select('*');
    $this->db->from('table_user a');
    $this->db->join('table_login b', 'b.kode_user = a.kode_user');
    $this->db->join('table_pengurus c', 'c.kode_user = a.kode_user');
    $this->db->where('a.kode_user', $kode);
    $query = $this->db->get();
    return $query->result();
  }

  public function jumlahLPK(){
    $query = $this->db->query("SELECT COUNT(COALESCE(kode_user, 0)) as total FROM table_user WHERE tipe='LPK'");
    return $query->result_array();
  }

  public function jumlahBLKLN(){
    $query = $this->db->query("SELECT COUNT(COALESCE(kode_user, 0)) as total FROM table_user WHERE tipe='BLKLN'");
    return $query->result_array();
  }

  public function jumlahKegiatan(){
    $query = $this->db->query("SELECT COUNT(COALESCE(kode_pelatihan, 0)) as total FROM table_pelatihan");
    return $query->result_array();
  }

  public function jumlahPeserta(){
    $query = $this->db->query("SELECT * FROM table_peserta_pelatihan AS a JOIN table_pelatihan AS c ON c.kode_pelatihan = a.kode_pelatihan WHERE a.status != '0'");
    return $query->num_rows();
  }

  public function laporanPeserta($tgl_awal, $tgl_akhir, $pelatihan)
  {
    $where = "";
    if (!empty($tgl_awal) && !empty($tgl_akhir)) {
      $where .= " WHERE psrtp.tanggal_daftar BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}' AND plthn.kode_pelatihan = '{$pelatihan}'";
    }

    $sql = "SELECT 
    psrt.nik, 
    psrt.kk, 
    psrt.nama, 
    psrt.jenis_kelamin,
    almt.alamat,
    almt.kelurahan,
    almt.tempat_lahir,
    almt.tanggal_lahir,
    psrt.no_telepon,
    psrt.pendidikan_terakhir,
    jenis.jenis,
    psrt.no_ak1 AS no_pencaker,
    '' AS keterangan
    FROM table_peserta psrt
    LEFT JOIN table_alamat almt ON psrt.kode_alamat = almt.kode_alamat
    LEFT JOIN table_peserta_pelatihan psrtp ON psrt.nik = psrtp.nik
    LEFT JOIN table_pelatihan plthn ON psrtp.kode_pelatihan = plthn.kode_pelatihan
    LEFT JOIN table_jenis jenis ON plthn.kode_jenis = jenis.kode_jenis
    {$where}";

    $prepared = $this->db->query($sql);
    return $prepared->result();
  }

  public function laporanStatusPeserta($tgl_awal, $tgl_akhir, $pelatihan, $status)
  {
    $where = "";
    if (!empty($tgl_awal) && !empty($tgl_akhir)) {
      $where .= " WHERE psrtp.tanggal_daftar BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}' AND plthn.kode_pelatihan = '{$pelatihan}' AND psrt.status_pekerjaan = '{$status}'";
    }

    $sql = "SELECT 
    psrt.nik, 
    psrt.kk, 
    psrt.nama, 
    psrt.jenis_kelamin,
    almt.alamat,
    almt.kelurahan,
    almt.tempat_lahir,
    almt.tanggal_lahir,
    psrt.no_telepon,
    psrt.pendidikan_terakhir,
    jenis.jenis,
    plthn.status,
    psrt.status_pekerjaan,
    '' AS keterangan,
    psrt.no_ak1 AS no_pencaker
    FROM table_peserta psrt
    LEFT JOIN table_alamat almt ON psrt.kode_alamat = almt.kode_alamat
    LEFT JOIN table_peserta_pelatihan psrtp ON psrt.nik = psrtp.nik
    LEFT JOIN table_pelatihan plthn ON psrtp.kode_pelatihan = plthn.kode_pelatihan
    LEFT JOIN table_jenis jenis ON plthn.kode_jenis = jenis.kode_jenis
    {$where}";

    $prepared = $this->db->query($sql);
    return $prepared->result();
  }

  public function laporanLpk($tgl_awal, $tgl_akhir)
  {
    $where = "";
    if (!empty($tgl_awal) && !empty($tgl_akhir)) {
      $where .= " WHERE user.tanggal_izin BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}' ";
    }

    $sql = "SELECT 
    '' AS no,
    user.nama AS nama_lpk,
    user.no_izin AS no_reg,
    user.alamat,
    user.no_izin,
    user.tanggal_izin,
    pngrs.nama_pimpinan,
    pngrs.no_telepon_pimpinan,
    plthn.nama AS nama_program,
    jp.jumlah_peserta AS jumlah_peserta,
    jp.jumlah_lulusan AS jumlah_lulusan
    FROM table_user user
    LEFT JOIN table_pengurus pngrs ON user.kode_user = pngrs.kode_user
    LEFT JOIN table_pelatihan plthn ON user.kode_user = plthn.kode_user
    LEFT JOIN (
    SELECT 
    plthn.kode_user,
    COUNT(psrtp.id) AS jumlah_peserta,
    SUM(IF(psrtp.status = 1, 1, 0)) AS jumlah_lulusan
    FROM table_peserta_pelatihan psrtp 
    LEFT JOIN table_pelatihan plthn ON psrtp.kode_pelatihan = plthn.kode_pelatihan
    GROUP BY psrtp.kode_pelatihan
    ) jp ON user.kode_user = jp.kode_user
    {$where}";

    $prepared = $this->db->query($sql);
    return $prepared->result();
  }

  public function laporanBlkln($tgl_awal, $tgl_akhir)
  {
    $where = "";
    if (!empty($tgl_awal) && !empty($tgl_akhir)) {
      $where .= " WHERE user.tanggal_izin BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}' ";
    }

    $sql = "SELECT
    '' AS kejuruan,
    '' AS skema,
    '' AS kapasitas,
    user.nama,
    karyawan.tptp,
    karyawan.tptl,
    karyawan.tpttp,
    karyawan.tpttl,
    karyawan.itp,
    karyawan.itl,
    karyawan.ittp,
    karyawan.ittl
    FROM table_user user
    LEFT JOIN (
    SELECT 
    kode_user, 
    SUM(IF(tipe = 'Tenaga Pelatihan Tetap' AND jenis_kelamin = 'Laki-Laki', jumlah, 0)) AS tptl,
    SUM(IF(tipe = 'Tenaga Pelatihan Tetap' AND jenis_kelamin = 'Perempuan', jumlah, 0)) AS tptp,
    SUM(IF(tipe = 'Tenaga Pelatihan Tidak Tetap' AND jenis_kelamin = 'Laki-Laki', jumlah, 0)) AS tpttp,
    SUM(IF(tipe = 'Tenaga Pelatihan Tidak Tetap' AND jenis_kelamin = 'Perempuan', jumlah, 0)) AS tpttl,
    SUM(IF(tipe = 'Instruktur Tetap' AND jenis_kelamin = 'Laki-Laki', jumlah, 0)) AS itp,
    SUM(IF(tipe = 'Instruktur Tetap' AND jenis_kelamin = 'Perempuan', jumlah, 0)) AS itl,
    SUM(IF(tipe = 'Instruktur Tidak Tetap' AND jenis_kelamin = 'Laki-Laki', jumlah, 0)) AS ittp,
    SUM(IF(tipe = 'Instruktur Tidak Tetap' AND jenis_kelamin = 'Perempuan', jumlah, 0)) AS ittl
    FROM table_anggota 
    WHERE kode_user = 'USER1'
    GROUP BY kode_user
    ) karyawan ON user.kode_user = karyawan.kode_user
    {$where}";

    $prepared = $this->db->query($sql);
    return $prepared->result();
  }

  public function laporanRekapitulasi($tgl_awal, $tgl_akhir)
  {
    $where = "";
    if (!empty($tgl_awal) && !empty($tgl_akhir)) {
      $where .= " WHERE psrtp.tanggal_daftar BETWEEN '{$tgl_awal}' AND '{$tgl_akhir}' ";
    }

    $sql = "SELECT 
    tingkat.terakhir AS terakhir, 
    IFNULL(rekap.l, 0) AS l,
    IFNULL(rekap.p, 0) AS p,
    IFNULL(rekap.SAWANGAN, 0) AS SAWANGAN,
    IFNULL(rekap.BOJONGSARI, 0) AS BOJONGSARI,
    IFNULL(rekap.PANCORANMAS, 0) AS PANCORANMAS,
    IFNULL(rekap.CIPAYUNG, 0) AS CIPAYUNG,
    IFNULL(rekap.SUKMAJAYA, 0) AS SUKMAJAYA,
    IFNULL(rekap.CILODONG, 0) AS CILODONG,
    IFNULL(rekap.CIMANGGIS, 0) AS CIMANGGIS,
    IFNULL(rekap.TAPOS, 0) AS TAPOS,
    IFNULL(rekap.BEJI, 0) AS BEJI,
    IFNULL(rekap.LIMO, 0) AS LIMO,
    IFNULL(rekap.CINERE, 0) AS CINERE,
    IFNULL(rekap.DST, 0) AS DST
    FROM (
    SELECT '1' AS id, 'SD' AS terakhir
    UNION
    SELECT '2' AS id, 'SMP' AS terakhir
    UNION
    SELECT '3' AS id, 'SMK' AS terakhir
    UNION
    SELECT '4' AS id, 'Perguruan Tinggi' AS terakhir
    ) tingkat
    LEFT JOIN (
    SELECT 
    tp.pendidikan_terakhir,
    SUM(IF(tp.jenis_kelamin = 'Laki-laki', 1, 0)) AS l,
    SUM(IF(tp.jenis_kelamin = 'Perempuan', 1, 0)) AS p,
    SUM(IF(ta.kecamatan = 'SAWANGAN', 1, 0)) AS SAWANGAN,
    SUM(IF(ta.kecamatan = 'BOJONGSARI', 1, 0)) AS BOJONGSARI,
    SUM(IF(ta.kecamatan = 'PANCORAN MAS', 1, 0)) AS PANCORANMAS,
    SUM(IF(ta.kecamatan = 'CIPAYUNG', 1, 0)) AS CIPAYUNG,
    SUM(IF(ta.kecamatan = 'SUKMA JAYA', 1, 0)) AS SUKMAJAYA,
    SUM(IF(ta.kecamatan = 'CILODONG', 1, 0)) AS CILODONG,
    SUM(IF(ta.kecamatan = 'CIMANGGIS', 1, 0)) AS CIMANGGIS,
    SUM(IF(ta.kecamatan = 'TAPOS', 1, 0)) AS TAPOS,
    SUM(IF(ta.kecamatan = 'BEJI', 1, 0)) AS BEJI,
    SUM(IF(ta.kecamatan = 'LIMO', 1, 0)) AS LIMO,
    SUM(IF(ta.kecamatan = 'CINERE', 1, 0)) AS CINERE,
    SUM(IF(ta.kecamatan != 'SAWANGAN' AND ta.kecamatan != 'BOJONGSARI' AND ta.kecamatan != 'PANCORAN MAS' AND ta.kecamatan != 'CIPAYUNG' AND ta.kecamatan != 'SUKMA JAYA' AND ta.kecamatan != 'CILODONG' AND ta.kecamatan != 'CIMANGGIS' AND ta.kecamatan != 'TAPOS' AND ta.kecamatan != 'BEJI' AND ta.kecamatan != 'LIMO' AND ta.kecamatan != 'CINERE', 1, 0)) AS DST
    FROM table_peserta tp 
    LEFT JOIN table_peserta_pelatihan psrtp ON tp.nik = psrtp.nik
    LEFT JOIN table_pelatihan plthn ON psrtp.kode_pelatihan = plthn.kode_pelatihan
    LEFT JOIN table_alamat ta ON tp.kode_alamat = ta.kode_alamat
    {$where}
    GROUP BY tp.pendidikan_terakhir
    ) rekap ON tingkat.terakhir = rekap.pendidikan_terakhir
    GROUP BY tingkat.id, rekap.pendidikan_terakhir, tingkat.terakhir
    ORDER BY tingkat.id";

    $prepared = $this->db->query($sql);
    return $prepared->result();
  }
}