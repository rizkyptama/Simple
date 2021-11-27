<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardLPK extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_DashboardLPK", "model");
		$this->load->model("M_Tools", "tools");

		if ($this->session->userdata('username') != true) {
			$this->session->set_flashdata('notif_login', '<script>toastr.warning("Anda Tidak Memiliki Akses !", "Warning !", {"timeOut": "2000","extendedTImeout": "0"});</script>');
			redirect('');
		} else if ($this->session->userdata('level') != "User") {
			$this->session->set_flashdata('notif_login', '<script>toastr.warning("Anda Tidak Memiliki Akses !", "Warning !", {"timeOut": "2000","extendedTImeout": "0"});</script>');
			redirect('Dashboard');
		}
	}

	private function load($title = '', $datapath = '')
	{
		$page = array(
			"head" => $this->load->view('dashboard/template/head', array("title" => $title), true),
			"footer" => $this->load->view('dashboard/template/footer', false, true),
			"sidebar" => $this->load->view('dashboard/template/sidebar', false, true),
		);
		return $page;
	}

	public function index()
	{
		$kode = $this->session->userdata['kode'];
		$profil = array(
			'lpkblkln' => $this
			->model
			->dataLPKdas($kode),
			'laporanlpkblkn' => $this
			->model
			->dataLaporandes($kode)
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Dashboard", $path),
			"content" => $this->load->view('dashboardLPK/index', $profil, true)
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function profil()
	{
		$kode = $this->session->userdata['kode'];
		$profil = array(
			'lpkblkln' => $this
			->model
			->dataLPK($kode)
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - My Profil", $path),
			"content" => $this->load->view('dashboardLPK/profil', $profil, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function ubahProfil() {
		// Data LPK/BLKLN
		$kode 		= $this->input->post('kode');
		$nama 		= $this->input->post('nama');
		$alamat 	= $this->input->post('alamat');
		$no_telepon = $this->input->post('no_telepon');
		$email	 	= $this->input->post('email');
		$no_izin 	= $this->input->post('no_izin');
		$tgl_izin 	= $this->input->post('tgl_izin');
		$jenis 		= $this->input->post('jenis');
		$status_a 	= $this->input->post('status_akreditas'); 
		$no_a 		= $this->input->post('no_akreditas');
		$ruang 	 	= $this->input->post('ruang_lingkup');
		// Data Pimpinan
		$nama_p 	= $this->input->post('nama_pimpinan');
		$telp_p		= $this->input->post('no_telepon_pimpinan');
		$nama_pj	= $this->input->post('nama_pj');
		$jabatan 	= $this->input->post('jabatan_pj');
		$telp_pj	= $this->input->post('no_telepon_pj');
		// Data Anggota
		$id = $this->input->post('id');//array
		$jumlah = $this->input->post('jumlah');//array

		$updateArray = array();

		for ($i=0; $i < sizeof($id) ; $i++) { 
			$updateArray[] = array(
				'id'=>$id[$i],
				'jumlah' => $jumlah[$i]
			);
		}

		$data = array(
			'nama' => $nama,		
			'alamat' => $alamat,
			'telepon	' => $no_telepon,
			'email' => $email,	 	
			'no_izin' => $no_izin, 	
			'tanggal_izin' => $tgl_izin, 	
			'jenis' => $jenis, 		
			'status_akreditas' => $status_a,	
			'no_akreditas' => $no_a,	
			'ruang_lingkup' => $ruang,
			'photo' => $_FILES['logo']['name']
		);

		$dataPengurus = array(
			'nama_pimpinan' => $nama_p,
			'no_telepon_pimpinan' => $telp_p,
			'nama_pj' => $nama_pj,
			'jabatan_pj' => $jabatan,
			'no_telepon_pj' => $telp_pj
		);

		move_uploaded_file($_FILES['logo']['tmp_name'], './assets/upload/logo/' . $_FILES['logo']['name']);
		$this->db->update_batch('table_anggota', $updateArray, 'id');
		$this->db->where('kode_user', $kode);
		$this->db->update('table_user', $data);
		$this->db->where('kode_user', $kode);
		$this->db->update('table_pengurus', $dataPengurus);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('DashboardLPK/profil');
	}

	public function kegiatan()
	{
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Kegiatan Dan Pelatihan", $path),
			"content" => $this->load->view('dashboardLPK/kegiatan', false, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function peserta()
	{
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Peserta", $path),
			"content" => $this->load->view('dashboardLPK/peserta', false, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function kemitraan()
	{
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Kemitraan", $path),
			"content" => $this->load->view('dashboardLPK/kemitraan', false, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function laporan()
	{
		$kode = $this->session->userdata['kode'];
		$laporan = array(
			'laporan' => $this->model->dataLaporan($kode),
			'lpkblkln' => $this->model->dataLPK($kode),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Laporan", $path),
			"content" => $this->load->view('dashboardLPK/laporan', $laporan, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function updateLaporan() {
		$id 		= $this->session->userdata['kode'];
		$kode       = $this->tools->get_kode_laporan();
		$date 		= date('Y-m-d');
		// Data LPK/BLKLN
		$nama 		= $this->input->post('nama');
		$alamat 	= $this->input->post('alamat');
		$no_telepon = $this->input->post('no_telepon');
		$email	 	= $this->input->post('email');
		$no_izin 	= $this->input->post('no_izin');
		$tgl_izin 	= $this->input->post('tanggal_izin');
		$jenis 		= $this->input->post('jenis');
		$status_a 	= $this->input->post('status_akreditas'); 
		$no_a 		= $this->input->post('no_akreditas');
		$ruang 	 	= $this->input->post('ruang_lingkup');
		$program 	= $this->input->post('program');

		// Data Pimpinan
		$nama_p 	= $this->input->post('nama_pimpinan');
		$telp_p		= $this->input->post('no_telepon_pimpinan');
		$nama_pj	= $this->input->post('nama_pj');
		$jabatan 	= $this->input->post('jabatan_pj');
		$telp_pj	= $this->input->post('no_telepon_pj');

		// Data Anggota
		$karyawan_l = $this->input->post('karyawan_laki');
		$karyawan_p = $this->input->post('karyawan_perempuan');
		$tpt_l 		= $this->input->post('tpt_laki');
		$tpt_p 		= $this->input->post('tpt_perempuan');
		$tptt_l 	= $this->input->post('tptt_laki');
		$tptt_p 	= $this->input->post('tptt_perempuan');
		$it_l 		= $this->input->post('it_laki');
		$it_p 		= $this->input->post('it_perempuan');
		$itt_l 		= $this->input->post('itt_laki');
		$itt_p 		= $this->input->post('itt_perempuan');
		$ak_l 		= $this->input->post('ak_laki');
		$ak_p 		= $this->input->post('ak_perempuan');
		$aw_l 		= $this->input->post('aw_laki');
		$aw_p 		= $this->input->post('aw_perempuan');

		//Data Pengembangan Pelatihan
		$nama_program 				= $this->input->post('nama_program');
		$inisiator_program 			= $this->input->post('inisiator_program');
		$durasi_pelatihan_program 	= $this->input->post('durasi_pelatihan_program');
		$standar_kompetensi_program = $this->input->post('standar_kompetensi_program');
		$keterangan_program 		= $this->input->post('keterangan_program');


		for ($i=0; $i < count($nama_program); $i++) 
		{   
			$data[$i]['nama_program'] = $nama_program[$i];
			$data[$i]['inisiator_program'] = $inisiator_program[$i];
			$data[$i]['durasi_pelatihan_program'] = $durasi_pelatihan_program[$i];
			$data[$i]['standar_kompetensi_program'] = $standar_kompetensi_program[$i];
			$data[$i]['keterangan_program'] = $keterangan_program[$i];
			$data[$i]['kode_lapor'] = $kode;
		}

		$this->db->insert_batch('table_program', $data);

		//Data Penyelenggaraan Pelatihan
		$nama_program_penyelenggara 		= $this->input->post('nama_program_penyelenggara');
		$jadwal_pelaksanaan_penyelenggara 	= $this->input->post('jadwal_pelaksanaan_penyelenggara');
		$jumlah_peserta_penyelenggara 		= $this->input->post('jumlah_peserta_penyelenggara');
		$jumlah_lulusan_penyelenggara 		= $this->input->post('jumlah_lulusan_penyelenggara');
		$keterangan_penyelenggara 			= $this->input->post('keterangan_penyelenggara');


		for ($i=0; $i < count($nama_program_penyelenggara); $i++) 
		{   
			$data1[$i]['nama_program_penyelenggara'] = $nama_program_penyelenggara[$i];
			$data1[$i]['jadwal_pelaksanaan_penyelenggara'] = $jadwal_pelaksanaan_penyelenggara[$i];
			$data1[$i]['jumlah_peserta_penyelenggara'] = $jumlah_peserta_penyelenggara[$i];
			$data1[$i]['jumlah_lulusan_penyelenggara'] = $jumlah_lulusan_penyelenggara[$i];
			$data1[$i]['keterangan_penyelenggara'] = $keterangan_penyelenggara[$i];
			$data1[$i]['kode_lapor'] = $kode;
		}

		$this->db->insert_batch('table_penyelenggara', $data1);
		
		//Data Penyelenggaraan Uji Kompetensi
		$nama_lsp 				= $this->input->post('nama_lsp');
		$skema_sertifikasi_lsp 	= $this->input->post('skema_sertifikasi_lsp');
		$jadwal_pelaksanaan_lsp = $this->input->post('jadwal_pelaksanaan_lsp');
		$jumlah_peserta_lsp 	= $this->input->post('jumlah_peserta_lsp');
		$keterangan_lsp 		= $this->input->post('keterangan_lsp');


		for ($i=0; $i < count($nama_lsp); $i++) 
		{   
			$data2[$i]['nama_lsp'] = $nama_lsp[$i];
			$data2[$i]['skema_sertifikasi_lsp'] = $skema_sertifikasi_lsp[$i];
			$data2[$i]['jadwal_pelaksanaan_lsp'] = $jadwal_pelaksanaan_lsp[$i];
			$data2[$i]['jumlah_peserta_lsp'] = $jumlah_peserta_lsp[$i];
			$data2[$i]['keterangan_lsp'] = $keterangan_lsp[$i];
			$data2[$i]['kode_lapor'] = $kode;
		}

		$this->db->insert_batch('table_lsp', $data2);

		//Data Pengembangan Kelembagaan dan SDM
		$nama_kegiatan_sdm 			= $this->input->post('nama_kegiatan_sdm');
		$jadwal_sdm 				= $this->input->post('jadwal_sdm');
		$lokasi_sdm 				= $this->input->post('lokasi_sdm');
		$penyelenggara_sdm = $this->input->post('penyelenggara_sdm');
		$keterangan_sdm 		= $this->input->post('keterangan_sdm');


		for ($i=0; $i < count($nama_kegiatan_sdm); $i++) 
		{   
			$data3[$i]['nama_kegiatan_sdm'] = $nama_kegiatan_sdm[$i];
			$data3[$i]['jadwal_sdm'] = $jadwal_sdm[$i];
			$data3[$i]['lokasi_sdm'] = $lokasi_sdm[$i];
			$data3[$i]['penyelenggara_sdm'] = $penyelenggara_sdm[$i];
			$data3[$i]['keterangan_sdm'] = $keterangan_sdm[$i];
			$data3[$i]['kode_lapor'] = $kode;
		}

		$this->db->insert_batch('table_sdm', $data3);

		//Data Kemitraan
		$nama_mitra 		= $this->input->post('nama_mitra');
		$alamat_mitra 		= $this->input->post('alamat_mitra');
		$bentuk_kemitraan 	= $this->input->post('bentuk_kemitraan');


		for ($i=0; $i < count($nama_mitra); $i++) 
		{   
			$data4[$i]['nama_mitra'] = $nama_mitra[$i];
			$data4[$i]['alamat_mitra'] = $alamat_mitra[$i];
			$data4[$i]['bentuk_kemitraan'] = $bentuk_kemitraan[$i];
			$data4[$i]['kode_lapor'] = $kode;
		}

		$this->db->insert_batch('table_mitra', $data4);

		$data = array(
			'kode_lapor' => $kode,
			'nama' => $nama,		
			'alamat' => $alamat,
			'telepon	' => $no_telepon,
			'email' => $email,	 	
			'no_izin' => $no_izin, 	
			'tanggal_izin' => $tgl_izin, 	
			'jenis' => $jenis, 		
			'status_akreditas' => $status_a,	
			'no_akreditas' => $no_a,	
			'ruang_lingkup' => $ruang,
			'program' => $program,
			'photo' => $_FILES['kegiatan']['name'],
			'absensi' => $_FILES['absensi']['name'],
			'kode_user' => $id
		);

		$dataPengurus = array(
			'nama_pimpinan' => $nama_p,
			'no_telepon_pimpinan' => $telp_p,
			'nama_pj' => $nama_pj,
			'jabatan_pj' => $jabatan,
			'no_telepon_pj' => $telp_pj,
			'kode_user' => $kode
		);

		$dataAnggota = array(
			array(
				'tipe' => 'Karyawan',
				'jenis_kelamin' => 'Laki-laki',
				'jumlah' => $karyawan_l,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Karyawan',
				'jenis_kelamin' => 'Perempuan',
				'jumlah' => $karyawan_p,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Tenaga Pelatihan Tetap',
				'jenis_kelamin' => 'Laki-laki',
				'jumlah' => $tpt_l,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Tenaga Pelatihan Tetap',
				'jenis_kelamin' => 'Perempuan',
				'jumlah' => $tpt_p,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Tenaga Pelatihan Tidak Tetap',
				'jenis_kelamin' => 'Laki-laki',
				'jumlah' => $tptt_l,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Tenaga Pelatihan Tidak Tetap',
				'jenis_kelamin' => 'Perempuan',
				'jumlah' => $tptt_p,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Instruktur Tetap',
				'jenis_kelamin' => 'Laki-laki',
				'jumlah' => $it_l,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Instruktur Tetap',
				'jenis_kelamin' => 'Perempuan',
				'jumlah' => $it_p,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Instruktur Tidak Tetap',
				'jenis_kelamin' => 'Laki-laki',
				'jumlah' => $itt_l,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Instruktur Tidak Tetap',
				'jenis_kelamin' => 'Perempuan',
				'jumlah' => $itt_p,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Asesor Kompetensi',
				'jenis_kelamin' => 'Laki-laki',
				'jumlah' => $ak_l,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Asesor Kompetensi',
				'jenis_kelamin' => 'Perempuan',
				'jumlah' => $ak_p,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Instruktur/Asesor WNA',
				'jenis_kelamin' => 'Laki-laki',
				'jumlah' => $aw_l,
				'kode_user' => $kode
			),
			array(
				'tipe' => 'Instruktur/Asesor WNA',
				'jenis_kelamin' => 'Perempuan',
				'jumlah' => $aw_p,
				'kode_user' => $kode
			),
		);

		$dataHistory = array(
			'aktivitas'  => 'Update Laporan : '.$nama,
			'detail' => json_encode($data),
			'kode_user' => $id
		);

		$dataHistoryLaporan = array(
			'tanggal_lapor' => $date,
			'kode_user' => $id,
			'kode_lapor' => $kode
		);


		move_uploaded_file($_FILES['kegiatan']['tmp_name'], './assets/upload/laporan/' . $_FILES['kegiatan']['name']);
		move_uploaded_file($_FILES['absensi']['tmp_name'], './assets/upload/laporan/' . $_FILES['absensi']['name']);
		$this->db->insert("table_pengurus", $dataPengurus);
		$this->db->insert("table_lapor_detail", $data);
		$this->db->insert_batch("table_anggota", $dataAnggota);
		$this->db->insert("table_history", $dataHistory);
		$this->db->insert("table_laporan", $dataHistoryLaporan);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('DashboardLPK/laporan');
	}

	public function kendalasolusi()
	{
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Kendala Dan Solusi", $path),
			"content" => $this->load->view('dashboardLPK/kendalasolusi', false, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}
	
	public function password(){
		$kode = $this->session->userdata['kode'];
		$profil = array(
			'lpkblkln' => $this
			->model
			->dataLPK($kode)
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - My Password", $path),
			"content" => $this->load->view('dashboardLPK/password', $profil, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}
	
	public function ubahPassword(){
		$passwordLama = $this->input->post('pwLama');
		$passwordBaru = $this->input->post('pwBaru');
		$lama = $this->session->userdata['password'];
		// $id = $this->session->userdata['id'];
		$id = $this->session->userdata['kode'];
		if (md5($passwordLama) == $lama) {
			$data = array("password" => md5($passwordBaru));
			$this->db->where('kode_user', $id);
			$update = $this->db->update('table_login', $data);
			if ($update) {
				$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
			}else{
				$this->session->set_flashdata('notif', '<script>toastr.success("Tidak dapat menyimpan data!", "Danger", {"timeOut": "2000","extendedTImeout": "0"});</script>');
			}
		}else{
			$this->session->set_flashdata('notif', '<script>toastr.success("Password Lama tidak valid.", "Danger", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		}
		redirect('DashboardLPK/password');

		// echo $this->session->userdata['kode'];
	}
	

}
