<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_Dashboard", "model");
		$this->load->model("M_Tools", "tools");

		if ($this->session->userdata('username') != true) {
			$this->session->set_flashdata('notif_login', '<script>toastr.warning("Anda Tidak Memiliki Akses !", "Warning !", {"timeOut": "2000","extendedTImeout": "0"});</script>');
			redirect('');
		} else if ($this->session->userdata('username') == true && $this->session->userdata('level') != "Admin") {
			$this->session->set_flashdata('notif_login', '<script>toastr.warning("Anda Tidak Memiliki Akses !", "Warning !", {"timeOut": "2000","extendedTImeout": "0"});</script>');
			redirect('DashboardLPK');
		}
	}

	private function load($title = '', $datapath = '')
	{
		$data = array(
			'pelatihan' => $this->model->dataPelatihan()
		);
		$page = array(
			"head" => $this->load->view('dashboard/template/head', array("title" => $title), true),
			"footer" => $this->load->view('dashboard/template/footer', false, true),
			"sidebar" => $this->load->view('dashboard/template/sidebar', $data, true),
		);
		return $page;
	}

	public function index()
	{
		$index = array(
			'jumlahLPK' => $this
			->model
			->jumlahLPK(),
			'jumlahBLKLN' => $this
			->model
			->jumlahBLKLN(),
			'jumlahKegiatan' => $this
			->model
			->jumlahKegiatan(),
			'jumlahPeserta' => $this
			->model
			->jumlahPeserta(),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Dashboard", $path),
			"content" => $this->load->view('dashboard/index', $index, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function lpkblkln()
	{
		$lpkblkln = array(
			'lpkblkln' => $this
			->model
			->dataLPK()
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - LPK BLKLN", $path),
			"content" => $this->load->view('dashboard/lpkblkln', $lpkblkln, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function buatAkunLPK() {
		// Kode User 
		$kode       = $this->tools->get_kode_user();
		// Data Login
		$username 	= $this->input->post('username');
		$password 	= $this->input->post('password');
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
		$tipe 		= $this->input->post('tipe');
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


		$dataLogin = array(
			'username' => $username,
			'password' => md5($password),
			'level' => 'User',
			'status' => 'Aktif',
			'kode_user' => $kode
		);

		$data = array(
			'kode_user' => $kode,
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
			'tipe' => $tipe,
			'photo' => $_FILES['logo']['name']
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
			'aktivitas'  => 'Daftar : '.$nama,
			'detail' => json_encode($data),
			'photo' => $_FILES['logo']['name'],
			'kode_user' => $kode
		);

		move_uploaded_file($_FILES['logo']['tmp_name'], './assets/upload/logo/' . $_FILES['logo']['name']);
		$this->db->insert("table_login", $dataLogin);
		$this->db->insert("table_pengurus", $dataPengurus);
		$this->db->insert("table_user", $data);
		$this->db->insert_batch("table_anggota", $dataAnggota);
		$this->db->insert("table_history", $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/lpkblkln');
	}

	public function aktivasiAkun() {
		$id = $this->input->post('id');
		$email = $this->input->post('email');
		$nama = $this->input->post('nama');
		$alamat = $this->input->post('alamat');
		$ss = $this->session->userdata['kode'];
		$dataLPK = $this->model->LPK($id);

		$this->load->library('PHPMailer');
		$this->load->library('SMTP');

		// $email_admin = 'disnaker.depok@gmail.com';
		// $nama_admin = 'noreply-Simpel';
		// $password_admin = '2014umar';

		// $mail = new PHPMailer();
		// $mail->isSMTP();  
		// $mail->SMTPKeepAlive = true;
		// $mail->Charset  = 'UTF-8';
		// $mail->IsHTML(true);
  //       // $mail->SMTPDebug = 1;
		// $mail->SMTPAuth = true;
		// $mail->Host = 'smtp.gmail.com'; 
		// $mail->Port = 587;
		// $mail->SMTPSecure = 'ssl';
		// $mail->Username = $email_admin;
		// $mail->Password = $password_admin;
		// $mail->Mailer   = 'smtp';
		// $mail->WordWrap = 100;       

		// $mail->setFrom($email_admin);
		// $mail->FromName = $nama_admin;
		// $mail->addAddress($email);
		// // $mail->AddEmbeddedImage('assets/img-acc-pencaker.png', 'acc');
		// $mail->Subject          = 'Verifikasi Akun '.$nama;
		// $mail_data['subject']   = $nama;
		// $mail_data['nama']  = $nama;
		// $mail_data['alamat']  = $alamat;
		// $message = $this->load->view('email_temp', $mail_data, TRUE);
		// $mail->Body = $message;
		// if ($mail->send()) {
		$data = array(
			'status' => 'Aktif'
		);

		$dataHistory = array(
			'aktivitas'  => 'Aktivasi Akun : '.$id,
			'detail' => json_encode($dataLPK),
			'kode_user' => $ss
		);

		$this->db->where('kode_user', $id);
		$this->db->update('table_login', $data);
		$this->db->insert('table_history', $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/lpkblkln');
		// } else {
		// 	echo 'Message could not be sent.';
		// 	echo 'Mailer Error: ' . $mail->ErrorInfo;
		// }
	}

	public function blokirAkun() {
		$id = $this->input->post('id');
		$ss = $this->session->userdata['kode'];
		$dataLPK = $this->model->LPK($id);

		$data = array(
			'status' => 'Suspend'
		);

		$dataHistory = array(
			'aktivitas'  => 'Blokir Akun : '.$id,
			'detail' => json_encode($dataLPK),
			'kode_user' => $ss
		);

		$this->db->where('kode_user', $id);
		$this->db->update('table_login', $data);
		$this->db->insert('table_history', $dataHistory);
	}

	public function hapusAkun() {
		$id = $this->input->post('id');
		$data = $this->model->LPK($id);
		$ss = $this->session->userdata['kode'];

		$this->db->where('kode_user', $id);
		$this->db->delete('table_login');
		$this->db->where('kode_user', $id);
		$this->db->delete('table_user');
		$this->db->where('kode_user', $id);
		$this->db->delete('table_pengurus');
		$this->db->where('kode_user', $id);
		$this->db->delete('table_anggota');
		$this->db->where('kode_user', $id);
		$this->db->delete('table_berita');
		$this->db->where('kode_user', $id);
		$this->db->delete('table_pelatihan');
		$this->db->where('kode_user', $id);
		$this->db->delete('table_slider');

		unlink('assets/upload/logo/'.$data->photo);

		$dataHistory = array(
			'aktivitas'  => 'Hapus Akun : '.$id,
			'detail' => json_encode($data),
			'kode_user' => $ss
		);

		$this->db->insert('table_history', $dataHistory);
	}

	public function pelatihan() {
		$pelatihan = array(
			'jenis' => $this
			->model
			->dataJenis(),
			'kategori' => $this
			->model
			->dataKategori(),
			'pelatihan' => $this
			->model
			->dataPelatihan()
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Pelatihan Dan Kegiatan", $path),
			"content" => $this->load->view('dashboard/pelatihan', $pelatihan, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	// public function emailadm()
	// {
	// 	$email = $this->input->post('emailpeserta');
	// 	echo $email;
	// }

	// fungsi email
	public function emailadm()
    {
        $this->load->library('email');
        // Konfigurasi email
        $config = [
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'protocol'  => 'smtp',
            'smtp_host' => 'mail.ptsevel.com',
            'smtp_user' => 'admin@ptsevel.com',  // Email gmail
            'smtp_pass'   => 'langitbiru<>?',  // Password gmail
            'smtp_crypto' => 'ssl',
            'smtp_port'   => 465,
            'crlf'    => "\r\n",
            'newline' => "\r\n"
        ];

        // Load library email dan konfigurasinya
        
        $this->email->initialize($config);
        
        // Email dan nama pengirim
        $this->email->from('admin@ptsevel.com', 'Ptsevel.com');

        // Email penerima
		// $this->email->to($email);
		$this->email->to($this->input->post('emailpeserta'));
		// $this->email->to('ansori.kerja@gmail.com');

        // Lampiran email, isi dengan url/path file
        // $this->email->attach(base_url().'upload/qrcode/'.$kode_unik.".png");

        // Subject email
        $this->email->subject('Segera Registrasi Data Diri Untuk Melakukan Ujian');

        // Isi email
        $this->email->message('Selamat Anda berhasil lulus seleksi administrasi, Segera Registrasi Data Diri Anda Pada Link Berikut! https://simpel.depok.go.id/ujianonline/registerujian');

        // Tampilkan pesan sukses atau error
        if ($this->email->send()) {
            // echo 'Sukses! email berhasil dikirim.';
        } else {
            // echo 'Error! email tidak dapat dikirim.';
        }
    }

	// bank soal
	public function soal()
	{
		$pelatihan = array(
			'jenis' => $this
			->model
			->dataJenis(),
			'kategori' => $this
			->model
			->dataKategori(),
			'pelatihan' => $this
			->model
			->dataPelatihan()
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Pelatihan Dan Kegiatan", $path),
			"content" => $this->load->view('dashboard/soal/soal', $pelatihan, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function tambahsoal()
	{
		$pelatihan = array(
			'jenis' => $this
			->model
			->dataJenis(),
			'kategori' => $this
			->model
			->dataKategori(),
			'pelatihan' => $this
			->model
			->dataPelatihan()
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Pelatihan Dan Kegiatan", $path),
			"content" => $this->load->view('dashboard/soal/tambahsoal', $pelatihan, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	// end bank soal
	

	public function aktifkanPelatihan(){
		$idPelatihan = $this->input->post("idPelatihan");

		$data = array(
			'status' => 'Aktif',
		);

		$this->db->where('kode_pelatihan', $idPelatihan);
		$update = $this->db->update('table_pelatihan', $data);
		if ($update) {
			echo json_encode('ok');
		}
	}

	public function nonAktifkanPelatihan(){
		$idPelatihan = $this->input->post("idPelatihan");

		$data = array(
			'status' => 'Tidak Aktif',
		);

		$this->db->where('kode_pelatihan', $idPelatihan);
		$update = $this->db->update('table_pelatihan', $data);
		if ($update) {
			echo json_encode('ok');
		}
	}

	public function lulusPeserta(){
		$idUser = $this->input->post("idUser");
		$idPelatihan = $this->input->post("idPelatihan");
		$id = $this->input->post("id");

		$data = array(
			'status' => 1,
		);

		$this->db->where('nik', $idUser);
		$this->db->where('kode_pelatihan', $idPelatihan);
		$this->db->where('id', $id);
		$update = $this->db->update('table_peserta_pelatihan', $data);
		if ($update) {
			echo json_encode('ok');
		}
	}

	public function pesertaLulus(){
		$idUser = $this->input->post("idUser");
		$idPelatihan = $this->input->post("idPelatihan");
		$id = $this->input->post("id");

		$peserta_lulus = $this->db->query("SELECT * FROM table_peserta AS b JOIN table_peserta_pelatihan AS a ON a.nik = b.nik JOIN table_pelatihan AS c ON c.kode_pelatihan = a.kode_pelatihan WHERE a.kode_pelatihan = '$idPelatihan' AND a.status = '1'")->num_rows();

		if ($peserta_lulus < 1) {
			echo json_encode('0');
		} else {
			echo json_encode($peserta_lulus);
		}
	}

	public function batalPeserta(){
		$idUser = $this->input->post("idUser");
		$idPelatihan = $this->input->post("idPelatihan");
		$id = $this->input->post("id");

		$data = array(
			'status' => 0,
		);

		$this->db->where('nik', $idUser);
		$this->db->where('kode_pelatihan', $idPelatihan);
		$this->db->where('id', $id);
		$update = $this->db->update('table_peserta_pelatihan', $data);
		if ($update) {
			echo json_encode('ok');
		}
	}

	public function tambahPelatihan() {
		$ss = $this->session->userdata['kode'];
		$kode = $this->tools->get_kode_pelatihan();
		$nama = $this->input->post('nama');
		$jenis = $this->input->post('jenis');
		$kuota = $this->input->post('kuota');
		$kategori = $this->input->post('kategori');
		$standar = $this->input->post('standar');
		$ket = $this->input->post('ket');
		$tgl_a = $this->input->post('tgl_mulai_daftar');
		$tgl_b = $this->input->post('tgl_akhir_daftar');
		$tgl_c = $this->input->post('tgl_mulai_pel');
		$tgl_d = $this->input->post('tgl_akhir_pel');
		$tgl_e = $this->input->post('tgl_mulai_ujian');
		$tgl_f = $this->input->post('tgl_akhir_ujian');

		$data = array(
			'kode_pelatihan' => $kode,
			'nama' => $nama,
			'kode_jenis' => $jenis,
			'kuota' => $kuota,
			'kode_kategori' => $kategori,
			'standar_kompetensi' => $standar,
			'keterangan' => $ket,
			'tanggal_mulai_daftar' => $tgl_a,
			'tanggal_berakhir_daftar' => $tgl_b,
			'tanggal_mulai_pelatihan' => $tgl_c,
			'tanggal_berakhir_pelatihan' => $tgl_d,
			'tanggal_mulai_ujian' => $tgl_e,
			'tanggal_akhir_ujian' => $tgl_f,
			'kode_user' => $ss
		);

		$dataHistory = array(
			'aktivitas'  => 'Tambah Pelatihan : '.$kode,
			'detail' => json_encode($data),
			'kode_user' => $ss
		);

		$this->db->insert('table_pelatihan', $data);
		$this->db->insert('table_history', $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/pelatihan');
	}

	public function ubahPelatihan() {
		$id = $this->input->post('id');
		$ss = $this->session->userdata['kode'];
		$nama = $this->input->post('nama');
		$jenis = $this->input->post('jenis');
		$kuota = $this->input->post('kuota');
		$kategori = $this->input->post('kategori');
		$standar = $this->input->post('standar');
		$ket = $this->input->post('ket');
		$tgl_a = $this->input->post('tgl_mulai_daftar');
		$tgl_b = $this->input->post('tgl_akhir_daftar');
		$tgl_c = $this->input->post('tgl_mulai_pel');
		$tgl_d = $this->input->post('tgl_akhir_pel');
		$tgl_e = $this->input->post('tgl_mulai_ujian');
		$tgl_f = $this->input->post('tgl_akhir_ujian');

		$data = array(
			'nama' => $nama,
			'kode_jenis' => $jenis,
			'kuota' => $kuota,
			'kode_kategori' => $kategori,
			'standar_kompetensi' => $standar,
			'keterangan' => $ket,
			'tanggal_mulai_daftar' => $tgl_a,
			'tanggal_berakhir_daftar' => $tgl_b,
			'tanggal_mulai_pelatihan' => $tgl_c,
			'tanggal_berakhir_pelatihan' => $tgl_d,
			'tanggal_mulai_ujian' => $tgl_e,
			'tanggal_akhir_ujian' => $tgl_f,
			'kode_user' => $ss
		);

		$dataHistory = array(
			'aktivitas'  => 'Ubah Pelatihan : '.$kode,
			'detail' => json_encode($data),
			'kode_user' => $ss
		);

		$this->db->where('kode_pelatihan', $id);
		$this->db->update('table_pelatihan', $data);
		$this->db->insert('table_history', $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/pelatihan');
	}

	public function jenisPelatihan()
	{
		$jenis = array(
			'jenis' => $this
			->model
			->dataJenis()
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Pelatihan Dan Kegiatan", $path),
			"content" => $this->load->view('dashboard/jenispelatihan', $jenis, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function tambahJenisPelatihan() {
		$jenis = $this->input->post('jenis');
		$ss = $this->session->userdata['kode'];
		$kode = $this->tools->get_kode_jenis();

		$data = array(
			'kode_jenis' => $kode,
			'jenis' => $jenis
		);

		$dataHistory = array(
			'aktivitas'  => 'Tambah Jenis Pelatihan : '.$jenis,
			// 'detail' => json_encode($data),
			'kode_user' => $ss
		);

		$this->db->insert('table_jenis', $data);
		$this->db->insert('table_history', $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/jenisPelatihan');
	}

	public function ubahJenis() {
		$id = $this->input->post('id');
		$jenis = $this->input->post('jenis');
		$ss = $this->session->userdata['kode'];

		$data = array(
			'jenis' => $jenis
		);

		$dataHistory = array(
			'aktivitas'  => 'Ubah Jenis Pelatihan : '.$id,
			// 'detail' => json_encode($data),
			'kode_user' => $ss
		);

		$this->db->where('kode_jenis', $id);
		$this->db->update('table_jenis', $data);
		$this->db->insert('table_history', $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/jenisPelatihan');
	}

	public function kategoriPelatihan()
	{
		$kategori = array(
			'kategori' => $this
			->model
			->dataKategori()
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Pelatihan Dan Kegiatan", $path),
			"content" => $this->load->view('dashboard/kategoripelatihan', $kategori, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function tambahKategoriPelatihan() {
		$jenis = $this->input->post('jenis');
		$ss = $this->session->userdata['kode'];
		$kode = $this->tools->get_kode_kategori();

		$data = array(
			'kode_kategori' => $kode,
			'kategori' => $jenis
		);

		$dataHistory = array(
			'aktivitas'  => 'Tambah Kategori Pelatihan : '.$jenis,
			// 'detail' => json_encode($data),
			'kode_user' => $ss
		);

		$this->db->insert('table_kategori', $data);
		$this->db->insert('table_history', $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/kategoriPelatihan');
	}

	public function ubahKategori() {
		$id = $this->input->post('id');
		$jenis = $this->input->post('jenis');
		$ss = $this->session->userdata['kode'];

		$data = array(
			'kategori' => $jenis
		);

		$dataHistory = array(
			'aktivitas'  => 'Ubah Kategori Pelatihan : '.$id,
			// 'detail' => json_encode($data),
			'kode_user' => $ss
		);

		$this->db->where('kode_kategori', $id);
		$this->db->update('table_kategori', $data);
		$this->db->insert('table_history', $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/kategoriPelatihan');
	}

	public function info()
	{
		$kode = $this->session->userdata['kode'];
		$berita = array(
			'berita' => $this
			->model
			->dataBerita(),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Informasi", $path),
			"content" => $this->load->view('dashboard/info', $berita, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function tambahBerita(){
		$kode       = $this->session->userdata['kode'];
		$tipe 		= $this->input->post('tipe');
		$judul      = $this->input->post('judul');
		$deskripsi  = $this->input->post('deskripsi');

		$data = array(
			'tipe' => $tipe,
			'judul' => $judul,
			'detail' => $deskripsi,
			'photo' => $_FILES['foto']['name'],
			'kode_user' => $kode
		);

		$dataHistory = array(
			'aktivitas'  => 'Tambah Berita/Events : '.$judul,
			'detail' => $deskripsi,
			'photo' => $_FILES['foto']['name'],
			'kode_user' => $kode
		);

		move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/berita/' . $_FILES['foto']['name']);
		$this->db->insert("table_berita", $data);
		$this->db->insert("table_history", $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/info');
	}

	public function laporan()
	{
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Laporan", $path),
			"content" => $this->load->view('dashboard/laporan', false, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function user()
	{
		$user = array(
			'lpkblkln' => $this
			->model
			->dataLPK()
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - User", $path),
			"content" => $this->load->view('dashboard/user', $user, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function slider()
	{
		$kode = $this->session->userdata['kode'];
		$slider = array(
			'slider' => $this
			->model
			->dataSlider($kode),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Slider", $path),
			"content" => $this->load->view('dashboard/slider', $slider, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function youtube()
	{
		$kode = $this->session->userdata['kode'];
		$slider = array(
			'slider' => $this
			->model
			->dataYoutube($kode),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Youtube", $path),
			"content" => $this->load->view('dashboard/youtube', $slider, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function tambahSlider(){
		$kode       = $this->session->userdata['kode'];
		$judul      = $this->input->post('judul');
		// $deskripsi  = $this->input->post('deskripsi');
		$deskripsi  = 'slider';

		$data = array(
			'judul' => $judul,
			'detail' => $deskripsi,
			'photo' => $_FILES['foto']['name'],
			'kode_user' => $kode
		);

		$dataHistory = array(
			'aktivitas'  => 'Tambah Slider : '. $judul,
			'detail' => $deskripsi,
			'photo' => $_FILES['foto']['name'],
			'kode_user' => $kode
		);

		move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/slider/' . $_FILES['foto']['name']);
		$this->db->insert("table_slider", $data);
		$this->db->insert("table_history", $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/slider');
	}

	public function tambahYoutube(){
		$kode       	= $this->session->userdata['kode'];
		$judul  		= $this->input->post('judul');
		$linkgoogle      = $this->input->post('linkgoogle');
		$linkyt			= $this->input->post('linkyt'); 



		$data = array(
			'judul' => $judul,
			'linkyt' => $linkyt,
			'linkgoogle' => $linkgoogle,
			'photo' => $_FILES['foto']['name'],
			'kode_user' => $kode
		);

		$dataHistory = array(
			'aktivitas'  => 'Tambah Link Youtube : '. $judul,
			'detail' => $linkyt,
			'photo' => $_FILES['foto']['name'],
			'kode_user' => $kode
		);

		move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/youtube/' . $_FILES['foto']['name']);
		$this->db->insert("table_youtube", $data);
		$this->db->insert("table_history", $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/youtube');
	}

	public function editSlider(){
		$id      	= $this->input->post('id');
		$kode       = $this->session->userdata['kode'];
		$judul      = $this->input->post('judul');
		$deskripsi  = 'editSlider';
		// $deskripsi  = $this->input->post('deskripsi');


		$data = array(
			'judul' => $judul,
			'detail' => $deskripsi,
			'photo' => $_FILES['foto']['name'],
		);

		$dataHistory = array(
			'aktivitas'  => 'Ubah Slider : '. $judul,
			'photo' => $_FILES['foto']['name'],
			'detail' => $deskripsi.', Dengan ID Slider : '.$id,
			'kode_user' => $kode
		);

		move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/slider/' . $_FILES['foto']['name']);
		$this->db->where("id", $id);
		$this->db->update("table_slider", $data);
		$this->db->insert("table_history", $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/slider');
	}

	public function editYoutube(){
		$id      	= $this->input->post('id');
		$kode       = $this->session->userdata['kode'];
		$judul  		= $this->input->post('judul');
		$linkgoogle      = $this->input->post('linkgoogle');
		$linkyt			= $this->input->post('linkyt'); 


		$data = array(
			'judul' => $judul,
			'linkyt' => $linkyt,
			'linkgoogle' => $linkgoogle,
			'photo' => $_FILES['foto']['name'],
		);

		$dataHistory = array(
			'aktivitas'  => 'Ubah LinkYT : '. $link,
			'photo' => $_FILES['foto']['name'],
			'detail' => $linkyt.', Dengan ID LinkYT : '.$id,
			'kode_user' => $kode
		);

		move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/youtube/' . $_FILES['foto']['name']);
		$this->db->where("id", $id);
		$this->db->update("table_youtube", $data);
		$this->db->insert("table_history", $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/youtube');
	}


	public function marquetext()
	{
		$kode = $this->session->userdata['kode'];
		$marquetext = array(
			'marquetext' => $this
			->model
			->dataMarquetext($kode),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Slider", $path),
			"content" => $this->load->view('dashboard/marquetext', $marquetext, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function tambahmarque(){
		$kode       = $this->session->userdata['kode'];
		$judul      = $this->input->post('judul');

		$data = array(
			'judul' => $judul,
			'kode_user' => $kode
		);
		$this->db->insert("table_marquetext", $data);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/marquetext');
	}

	public function editmarque(){
		$id      	= $this->input->post('id');
		$kode       = $this->session->userdata['kode'];
		$judul      = $this->input->post('judul');

		$data = array(
			'judul' => $judul,
		);
		$this->db->where("id", $id);
		$this->db->update("table_marquetext", $data);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/marquetext');
	}

	public function aktivitas()
	{
		$kode = $this->session->userdata['kode'];
		$aktivitas = array(
			'history' => $this
			->model
			->dataHistory($kode),
			'historyAdmin' => $this
			->model
			->dataHistoryAdmin($kode),
		);
		$kode = 
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Aktivitas Terbaru", $path),
			"content" => $this->load->view('dashboard/aktivitas', $aktivitas, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function peserta()
	{
		$peserta = array(
			'pesertaPelatihan' => $this
			->model
			->dataPesertaPelatihan(),
			
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Daftar Peserta", $path),
			"content" => $this->load->view('dashboard/peserta', $peserta, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	/* Tambahan Developer */
	public function pelatihanPeserta(){
		$nik = $this->input->post("nik");
		$data = $this->model->dataPelatihanPeserta($nik);
		echo json_encode(array("data" => $data));
	}

	public function ubahPeserta() {
		$id = $this->input->post('id');
		$ss = $this->session->userdata['kode'];
		$status_kerja = $this->input->post('status_pekerjaan');
		if ($status_kerja == 'Belum Bekerja') {
			$nama = '';
			$alamat = '';
			$telpon = '';
		} else {
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$telpon = $this->input->post('telp');
		}

		$data = array(
			'status_pekerjaan' => $status_kerja,
			'nama_perusahaan' => $nama,
			'alamat_perusahaan' => $alamat,
			'no_telp_perusahaan' => $telpon
		);

		$dataHistory = array(
			'aktivitas'  => 'Ubah Peserta : '.$id,
			'detail' => json_encode($data),
			'kode_user' => $ss
		);

		$this->db->where('nik', $id);
		$this->db->update('table_peserta', $data);
		$this->db->insert('table_history', $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/peserta');
	}

	public function helpdesk()
	{
		$helpdesk = array(
			'helpdesk' => $this
			->model
			->dataHelpDesk(),
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Helpdesk", $path),
			"content" => $this->load->view('dashboard/helpdesk', $helpdesk, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function ubahStatusHelpdesk() {
		$id = $this->input->post('id');
		$status = $this->input->post('status');

		$data = array(
			"status_h" => $status
		);

		$this->db->where('id', $id);
		$this->db->update('table_helpdesk', $data);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/helpdesk');
	}

	public function laporanPeserta()
	{
		$tgl_awal 			= $this->input->post("tgl_awal");
		$tgl_akhir 	 		= $this->input->post("tgl_akhir");
		$pelatihan 	 		= $this->input->post("nama_pelatihan");
		// $tgl_awal       = $this->changeDateFormat($tgl_awal);
		// $tgl_akhir      = $this->changeDateFormat($tgl_akhir);

		$dataLaporan = $this->model->laporanPeserta($tgl_awal, $tgl_akhir, $pelatihan);

		$dataView = [
			'dataLaporan' => $dataLaporan,
			'tgl_awal' => date("d M Y", strtotime($tgl_awal)),
			'tgl_akhir' => date("d M Y", strtotime($tgl_akhir))
		];

		$view = $this->load->view('dashboard/laporan/laporan1', $dataView, true);
    // echo $view;
		$this->pdfgenerator->generate($view, "Laporan BKK", TRUE, 'A4', 'landscape');
	}

	public function laporanStatusPeserta()
	{
		$tgl_awal 			= $this->input->post("tgl_awal");
		$tgl_akhir 	 		= $this->input->post("tgl_akhir");
		$pelatihan 	 		= $this->input->post("nama_pelatihan");
		$status 	 		= $this->input->post("status");
		// $tgl_awal       = $this->changeDateFormat($tgl_awal);
		// $tgl_akhir      = $this->changeDateFormat($tgl_akhir);

		$dataLaporan = $this->model->laporanStatusPeserta($tgl_awal, $tgl_akhir, $pelatihan, $status);

		$dataView = [
			'dataLaporan' => $dataLaporan,
			'tgl_awal' => date("d M Y", strtotime($tgl_awal)),
			'tgl_akhir' => date("d M Y", strtotime($tgl_akhir))
		];

		$view = $this->load->view('dashboard/laporan/laporan2', $dataView, true);
    // echo $view;
		$this->pdfgenerator->generate($view, "Laporan BKK", TRUE, 'A4', 'landscape');
	}

	public function laporanLpkBlkln()
	{
		$tgl_awal 			= $this->input->post("tgl_awal");
		$tgl_akhir 	 		= $this->input->post("tgl_akhir");
		// $tgl_awal       = $this->changeDateFormat($tgl_awal);
		// $tgl_akhir      = $this->changeDateFormat($tgl_akhir);

		$dataLpk = $this->model->laporanLpk($tgl_awal, $tgl_akhir);
		$dataBlkln = $this->model->laporanBlkln($tgl_awal, $tgl_akhir);

		$dataView = [
			'dataLpk' => $dataLpk,
			'dataBlkln' => $dataBlkln,
			'tgl_awal' => date("d M Y", strtotime($tgl_awal)),
			'tgl_akhir' => date("d M Y", strtotime($tgl_akhir))
		];

		$view = $this->load->view('dashboard/laporan/laporan3', $dataView, true);
    // echo $view;
		$this->pdfgenerator->generate($view, "Laporan BKK", TRUE, 'A4', 'landscape');
	}

	public function laporanRekapitulasi()
	{
		$tgl_awal 			= $this->input->post("tgl_awal");
		$tgl_akhir 	 		= $this->input->post("tgl_akhir");
		// $tgl_awal       = $this->changeDateFormat($tgl_awal);
		// $tgl_akhir      = $this->changeDateFormat($tgl_akhir);

		$dataLaporan = $this->model->laporanRekapitulasi($tgl_awal, $tgl_akhir);

		$dataView = [
			'dataLaporan' => $dataLaporan,
			'tgl_awal' => date("d M Y", strtotime($tgl_awal)),
			'tgl_akhir' => date("d M Y", strtotime($tgl_akhir))
		];

		$view = $this->load->view('dashboard/laporan/laporan4', $dataView, true);
    // echo $view;
		$this->pdfgenerator->generate($view, "Laporan BKK", TRUE, 'A4', 'landscape');
	}

	public function laporanPesertaXls()
	{
		$tgl_awal 			= $this->input->post("tgl_awal");
		$tgl_akhir 	 		= $this->input->post("tgl_akhir");
		$pelatihan 	 		= $this->input->post("nama_pelatihan");
		// $tgl_awal       = $this->changeDateFormat($tgl_awal);
		// $tgl_akhir      = $this->changeDateFormat($tgl_akhir);

		$dataLaporan = $this->model->laporanPeserta($tgl_awal, $tgl_akhir, $pelatihan);

		$dirPath  = BASEPATH."../assets/template_excel/laporan_peserta.xls";
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($dirPath);

		$sheet = $spreadsheet->getActiveSheet();
    // $sheet->setCellValue('A1', 'Hello World !');
		$styleText = [
			'font' => [
				'bold' => false,
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
			],
			'borders' => [
				'top' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'left' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'right' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'bottom' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];

		$styleNumber = [
			'font' => [
				'bold' => false,
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
			],
			'borders' => [
				'top' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'left' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'right' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'bottom' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
		$tableIndex = 4;
		for ($i=0; $i < count($dataLaporan) ; $i++) { 
			$tableIndex++;
			$sheet->setCellValue('A'.$tableIndex, $dataLaporan[$i]->nik);
			$sheet->setCellValue('B'.$tableIndex, $dataLaporan[$i]->kk);
			$sheet->setCellValue('C'.$tableIndex, $dataLaporan[$i]->nama);
			$sheet->setCellValue('D'.$tableIndex, $dataLaporan[$i]->jenis_kelamin);
			$sheet->setCellValue('E'.$tableIndex, $dataLaporan[$i]->alamat);
			$sheet->setCellValue('F'.$tableIndex, $dataLaporan[$i]->kelurahan);
			$sheet->setCellValue('G'.$tableIndex, $dataLaporan[$i]->tempat_lahir." ".$dataLaporan[$i]->tanggal_lahir);
			$sheet->setCellValue('H'.$tableIndex, $dataLaporan[$i]->no_telepon);
			$sheet->setCellValue('I'.$tableIndex, $dataLaporan[$i]->pendidikan_terakhir);
			$sheet->setCellValue('J'.$tableIndex, $dataLaporan[$i]->jenis);
			$sheet->setCellValue('K'.$tableIndex, $dataLaporan[$i]->no_pencaker);
			$sheet->setCellValue('L'.$tableIndex, $dataLaporan[$i]->keterangan);

			// $spreadsheet->getActiveSheet()->getStyle('A'.$tableIndex)->applyFromArray($styleText);
			// $spreadsheet->getActiveSheet()->getStyle('B'.$tableIndex)->applyFromArray($styleNumber);
			// $spreadsheet->getActiveSheet()->getStyle('C'.$tableIndex)->applyFromArray($styleNumber);
			// $spreadsheet->getActiveSheet()->getStyle('D'.$tableIndex)->applyFromArray($styleNumber);
		}

		// if (!empty($tgl_awal)) {
		// 	$sheet->setCellValue('B2', date("d/m/Y", strtotime($tgl_awal)));
		// }

		// if (!empty($tgl_akhir)) {
		// 	$sheet->setCellValue('D2', date("d/m/Y", strtotime($tgl_akhir)));
		// }

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="laporan Peserta.xlsx"');
		$writer->save("php://output");
    // $fileName = "{$dirPath}/filename.xls";

    // recursively creates all required nested directories   
    // $writer->save($fileName);
    // echo $fileName;
	}

	public function laporanStatusPesertaXls()
	{
		$tgl_awal 			= $this->input->post("tgl_awal");
		$tgl_akhir 	 		= $this->input->post("tgl_akhir");
		$pelatihan 	 		= $this->input->post("nama_pelatihan");
		$status 	 		= $this->input->post("status");
		// $tgl_awal       = $this->changeDateFormat($tgl_awal);
		// $tgl_akhir      = $this->changeDateFormat($tgl_akhir);

		$dataLaporan = $this->model->laporanStatusPeserta($tgl_awal, $tgl_akhir, $pelatihan, $status);

		$dirPath  = BASEPATH."../assets/template_excel/laporan_status_peserta.xls";
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($dirPath);

		$sheet = $spreadsheet->getActiveSheet();
    // $sheet->setCellValue('A1', 'Hello World !');
		$styleText = [
			'font' => [
				'bold' => false,
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
			],
			'borders' => [
				'top' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'left' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'right' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'bottom' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];

		$styleNumber = [
			'font' => [
				'bold' => false,
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
			],
			'borders' => [
				'top' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'left' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'right' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'bottom' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
		$tableIndex = 5;
		for ($i=0; $i < count($dataLaporan) ; $i++) { 
			$tableIndex++;
			$sheet->setCellValue('A'.$tableIndex, $dataLaporan[$i]->nik);
			$sheet->setCellValue('B'.$tableIndex, $dataLaporan[$i]->kk);
			$sheet->setCellValue('C'.$tableIndex, $dataLaporan[$i]->nama);
			$sheet->setCellValue('D'.$tableIndex, $dataLaporan[$i]->jenis_kelamin);
			$sheet->setCellValue('E'.$tableIndex, $dataLaporan[$i]->alamat);
			$sheet->setCellValue('F'.$tableIndex, $dataLaporan[$i]->kelurahan);
			$sheet->setCellValue('G'.$tableIndex, $dataLaporan[$i]->tempat_lahir." ".$dataLaporan[$i]->tanggal_lahir);
			$sheet->setCellValue('H'.$tableIndex, $dataLaporan[$i]->no_telepon);
			$sheet->setCellValue('I'.$tableIndex, $dataLaporan[$i]->pendidikan_terakhir);
			$sheet->setCellValue('J'.$tableIndex, $dataLaporan[$i]->jenis);
			$sheet->setCellValue('K'.$tableIndex, $dataLaporan[$i]->status);
			$sheet->setCellValue('L'.$tableIndex, $dataLaporan[$i]->status_pekerjaan);
			$sheet->setCellValue('M'.$tableIndex, $dataLaporan[$i]->keterangan);
			$sheet->setCellValue('N'.$tableIndex, $dataLaporan[$i]->no_pencaker);

			// $spreadsheet->getActiveSheet()->getStyle('A'.$tableIndex)->applyFromArray($styleText);
			// $spreadsheet->getActiveSheet()->getStyle('B'.$tableIndex)->applyFromArray($styleNumber);
			// $spreadsheet->getActiveSheet()->getStyle('C'.$tableIndex)->applyFromArray($styleNumber);
			// $spreadsheet->getActiveSheet()->getStyle('D'.$tableIndex)->applyFromArray($styleNumber);
		}

		// if (!empty($tgl_awal)) {
		// 	$sheet->setCellValue('B2', date("d/m/Y", strtotime($tgl_awal)));
		// }

		// if (!empty($tgl_akhir)) {
		// 	$sheet->setCellValue('D2', date("d/m/Y", strtotime($tgl_akhir)));
		// }

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Laporan Status Peserta.xlsx"');
		$writer->save("php://output");
    // $fileName = "{$dirPath}/filename.xls";

    // recursively creates all required nested directories   
    // $writer->save($fileName);
    // echo $fileName;
	}

	public function laporanLpkBlklnXls()
	{
		$tgl_awal 			= $this->input->post("tgl_awal");
		$tgl_akhir 	 		= $this->input->post("tgl_akhir");
		// $tgl_awal       = $this->changeDateFormat($tgl_awal);
		// $tgl_akhir      = $this->changeDateFormat($tgl_akhir);

		$dataLpk = $this->model->laporanLpk($tgl_awal, $tgl_akhir);
		$dataBlkln = $this->model->laporanBlkln($tgl_awal, $tgl_akhir);

		$dirPath  = BASEPATH."../assets/template_excel/laporan_lpk_blkln.xls";
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($dirPath);

		$sheet = $spreadsheet->getActiveSheet();
    // $sheet->setCellValue('A1', 'Hello World !');
		$styleText = [
			'font' => [
				'bold' => false,
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
			],
			'borders' => [
				'top' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'left' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'right' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'bottom' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];

		$styleNumber = [
			'font' => [
				'bold' => false,
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
			],
			'borders' => [
				'top' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'left' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'right' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'bottom' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
		$tableIndex = 6;
		for ($i=0; $i < count($dataLpk) ; $i++) { 
			$tableIndex++;
			$lpk = $dataLpk[$i];
			$sheet->setCellValue('A'.$tableIndex, $lpk->no);
			$sheet->setCellValue('B'.$tableIndex, $lpk->nama_lpk);
			$sheet->setCellValue('C'.$tableIndex, $lpk->no_reg);
			$sheet->setCellValue('D'.$tableIndex, $lpk->alamat);
			$sheet->setCellValue('E'.$tableIndex, $lpk->no_izin." ".$lpk->tanggal_izin);
			$sheet->setCellValue('F'.$tableIndex, $lpk->nama_pimpinan." ".$lpk->no_telepon_pimpinan);
			$sheet->setCellValue('G'.$tableIndex, $lpk->nama_program);
			$sheet->setCellValue('H'.$tableIndex, $lpk->jumlah_peserta);
			$sheet->setCellValue('I'.$tableIndex, $lpk->jumlah_lulusan);

			// $spreadsheet->getActiveSheet()->getStyle('A'.$tableIndex)->applyFromArray($styleText);
			// $spreadsheet->getActiveSheet()->getStyle('B'.$tableIndex)->applyFromArray($styleNumber);
			// $spreadsheet->getActiveSheet()->getStyle('C'.$tableIndex)->applyFromArray($styleNumber);
			// $spreadsheet->getActiveSheet()->getStyle('D'.$tableIndex)->applyFromArray($styleNumber);
		}

		$tableIndex = 7;
		for ($i=0; $i < count($dataBlkln) ; $i++) { 
			$tableIndex++;
			$blkln = $dataBlkln[$i];
			$sheet->setCellValue('M'.$tableIndex, $blkln->kejuruan);
			$sheet->setCellValue('N'.$tableIndex, $blkln->skema);
			$sheet->setCellValue('O'.$tableIndex, $blkln->kapasitas);
			$sheet->setCellValue('P'.$tableIndex, $blkln->nama);
			$sheet->setCellValue('Q'.$tableIndex, $blkln->tptp);
			$sheet->setCellValue('R'.$tableIndex, $blkln->tptl);
			$sheet->setCellValue('S'.$tableIndex, $blkln->tpttp);
			$sheet->setCellValue('T'.$tableIndex, $blkln->tpttl);
			$sheet->setCellValue('U'.$tableIndex, $blkln->itp);
			$sheet->setCellValue('V'.$tableIndex, $blkln->itl);
			$sheet->setCellValue('W'.$tableIndex, $blkln->ittp);
			$sheet->setCellValue('X'.$tableIndex, $blkln->ittl);

			// $spreadsheet->getActiveSheet()->getStyle('A'.$tableIndex)->applyFromArray($styleText);
			// $spreadsheet->getActiveSheet()->getStyle('B'.$tableIndex)->applyFromArray($styleNumber);
			// $spreadsheet->getActiveSheet()->getStyle('C'.$tableIndex)->applyFromArray($styleNumber);
			// $spreadsheet->getActiveSheet()->getStyle('D'.$tableIndex)->applyFromArray($styleNumber);
		}

		// if (!empty($tgl_awal)) {
		// 	$sheet->setCellValue('B2', date("d/m/Y", strtotime($tgl_awal)));
		// }

		// if (!empty($tgl_akhir)) {
		// 	$sheet->setCellValue('D2', date("d/m/Y", strtotime($tgl_akhir)));
		// }

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Laporan LPK & BLKLN.xlsx"');
		$writer->save("php://output");
    // $fileName = "{$dirPath}/filename.xls";

    // recursively creates all required nested directories   
    // $writer->save($fileName);
    // echo $fileName;
	}

	public function laporanRekapitulasiXls()
	{
		$tgl_awal 			= $this->input->post("tgl_awal");
		$tgl_akhir 	 		= $this->input->post("tgl_akhir");
		// $tgl_awal       = $this->changeDateFormat($tgl_awal);
		// $tgl_akhir      = $this->changeDateFormat($tgl_akhir);

		$dataLaporan = $this->model->laporanRekapitulasi($tgl_awal, $tgl_akhir);

		$dirPath  = BASEPATH."../assets/template_excel/laporan_rekapitulasi.xls";
		$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($dirPath);

		$sheet = $spreadsheet->getActiveSheet();
    // $sheet->setCellValue('A1', 'Hello World !');
		$styleText = [
			'font' => [
				'bold' => false,
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT,
			],
			'borders' => [
				'top' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'left' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'right' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'bottom' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];

		$styleNumber = [
			'font' => [
				'bold' => false,
			],
			'alignment' => [
				'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
			],
			'borders' => [
				'top' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'left' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'right' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
				'bottom' => [
					'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
				],
			],
		];
		$tableIndex = 6;
		$total = new stdClass();
		$total->l = 0;
		$total->p = 0;
		$total->SAWANGAN = 0;
		$total->BOJONGSARI = 0;
		$total->PANCORANMAS = 0;
		$total->CIPAYUNG = 0;
		$total->SUKMAJAYA = 0;
		$total->CILODONG = 0;
		$total->CIMANGGIS = 0;
		$total->TAPOS = 0;
		$total->BEJI = 0;
		$total->LIMO = 0;
		$total->CINERE = 0;
		$total->DST = 0;
		for ($i=0; $i < count($dataLaporan) ; $i++) { 
			$tableIndex++;			
			$sheet->setCellValue('B'.$tableIndex, $dataLaporan[$i]->l);
			$sheet->setCellValue('C'.$tableIndex, $dataLaporan[$i]->p);
			$sheet->setCellValue('D'.$tableIndex, $dataLaporan[$i]->SAWANGAN);
			$sheet->setCellValue('E'.$tableIndex, $dataLaporan[$i]->BOJONGSARI);
			$sheet->setCellValue('F'.$tableIndex, $dataLaporan[$i]->PANCORANMAS);
			$sheet->setCellValue('G'.$tableIndex, $dataLaporan[$i]->CIPAYUNG);
			$sheet->setCellValue('H'.$tableIndex, $dataLaporan[$i]->SUKMAJAYA);
			$sheet->setCellValue('I'.$tableIndex, $dataLaporan[$i]->CILODONG);
			$sheet->setCellValue('J'.$tableIndex, $dataLaporan[$i]->CIMANGGIS);
			$sheet->setCellValue('K'.$tableIndex, $dataLaporan[$i]->TAPOS);
			$sheet->setCellValue('L'.$tableIndex, $dataLaporan[$i]->BEJI);
			$sheet->setCellValue('M'.$tableIndex, $dataLaporan[$i]->LIMO);
			$sheet->setCellValue('N'.$tableIndex, $dataLaporan[$i]->CINERE);
			// $sheet->setCellValue('O'.$tableIndex, $dataLaporan[$i]->DST);

			// $spreadsheet->getActiveSheet()->getStyle('A'.$tableIndex)->applyFromArray($styleText);
			// $spreadsheet->getActiveSheet()->getStyle('B'.$tableIndex)->applyFromArray($styleNumber);
			// $spreadsheet->getActiveSheet()->getStyle('C'.$tableIndex)->applyFromArray($styleNumber);
			// $spreadsheet->getActiveSheet()->getStyle('D'.$tableIndex)->applyFromArray($styleNumber);
			$total->l += $dataLaporan[$i]->l;
			$total->p += $dataLaporan[$i]->p;
			$total->SAWANGAN += $dataLaporan[$i]->SAWANGAN;
			$total->BOJONGSARI += $dataLaporan[$i]->BOJONGSARI;
			$total->PANCORANMAS +=$dataLaporan[$i]->PANCORANMAS;
			$total->CIPAYUNG += $dataLaporan[$i]->CIPAYUNG;
			$total->SUKMAJAYA += $dataLaporan[$i]->SUKMAJAYA;
			$total->CILODONG += $dataLaporan[$i]->CILODONG;
			$total->CIMANGGIS += $dataLaporan[$i]->CIMANGGIS;
			$total->TAPOS += $dataLaporan[$i]->TAPOS;
			$total->BEJI += $dataLaporan[$i]->BEJI;
			$total->LIMO += $dataLaporan[$i]->LIMO;
			$total->CINERE += $dataLaporan[$i]->CINERE;
			// $total->DST += $dataLaporan[$i]->DST;
		}

		$sheet->setCellValue('B11', $total->l);
		$sheet->setCellValue('C11', $total->p);
		$sheet->setCellValue('D11', $total->SAWANGAN);
		$sheet->setCellValue('E11', $total->BOJONGSARI);
		$sheet->setCellValue('F11', $total->PANCORANMAS);
		$sheet->setCellValue('G11', $total->CIPAYUNG);
		$sheet->setCellValue('H11', $total->SUKMAJAYA);
		$sheet->setCellValue('I11', $total->CILODONG);
		$sheet->setCellValue('J11', $total->CIMANGGIS);
		$sheet->setCellValue('K11', $total->TAPOS);
		$sheet->setCellValue('L11', $total->BEJI);
		$sheet->setCellValue('M11', $total->LIMO);
		$sheet->setCellValue('N11', $total->CINERE);
		// $sheet->setCellValue('O11', $total->DST);

		// if (!empty($tgl_awal)) {
		// 	$sheet->setCellValue('B2', date("d/m/Y", strtotime($tgl_awal)));
		// }

		// if (!empty($tgl_akhir)) {
		// 	$sheet->setCellValue('D2', date("d/m/Y", strtotime($tgl_akhir)));
		// }

		$writer = new Xlsx($spreadsheet);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename="Laporan Rekapitulasi Peserta Pelatihan.xlsx"');
		$writer->save("php://output");
    // $fileName = "{$dirPath}/filename.xls";

    // recursively creates all required nested directories   
    // $writer->save($fileName);
    // echo $fileName;
	}

	public function statusLpk(){
		$status = array(
			'laporan' => $this
			->model
			->dataLaporan()
		);
		$path = "";
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Status Laporan LPK/BLKLN", $path),
			"content" => $this->load->view('dashboard/statusLpk', $status, true),
		);
		$this->load->view('dashboard/template/default_template', $data);
	}

	public function hapusPelatihan(){
		$kode = $this->input->post('kode');
		$delete = $this->db->query("DELETE FROM table_pelatihan WHERE kode_pelatihan = '$kode'");
		if ($delete) {
			echo "ok";
		}else{
			echo "fail";
		}
	}

	public function hapusjenispelatihan(){
		$kode = $this->input->post('kode');
		$delete = $this->db->query("DELETE FROM table_jenis WHERE kode_jenis = '$kode'");
		if ($delete) {
			echo "ok";
		}else{
			echo "fail";
		}
	}

	public function hapuskategori(){
		$kode = $this->input->post('kode');
		$delete = $this->db->query("DELETE FROM table_kategori WHERE kode_kategori = '$kode'");
		if ($delete) {
			echo "ok";
		}else{
			echo "fail";
		}
	}


	public function editBerita(){
		$kode       = $this->input->post('kode');
		$tipe 		= $this->input->post('tipe');
		$judul      = $this->input->post('judul');
		$deskripsi  = $this->input->post('deskripsi');

		$data = array(
			'tipe' => $tipe,
			'judul' => $judul,
			'detail' => $deskripsi,
			'photo' => $_FILES['foto']['name'],
		);

		$dataHistory = array(
			'aktivitas'  => 'Edit Berita/Events : '.$judul,
			'detail' => $deskripsi,
			'photo' => $_FILES['foto']['name'],
			'kode_user' => $kode
		);

		move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/berita/' . $_FILES['foto']['name']);
		$this->db->where("id", $kode);
		$this->db->update("table_berita", $data);
		$this->db->insert("table_history", $dataHistory);
		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('Dashboard/info');
	}

	public function hapusBerita(){
		$kode = $this->input->post('kode');
		$delete = $this->db->query("DELETE FROM table_berita WHERE id = '$kode'");
		if ($delete) {
			echo "ok";
		}else{
			echo "fail";
		}
	}
	

	/* TAMBAHAN DEVELOPER */
	public function cekPeriodeDaftarPeserta() {
		date_default_timezone_set("Asia/Jakarta");
		$cek_periode = $this->tools->cek_periode($this->input->post('nik'));
		$hari_ini = date('Y-m-d');
		if(sizeof($cek_periode) > 0){
			$date1 = date_create($cek_periode[0]->tanggal_daftar);
			$date2 = date_create($hari_ini);
			$diff = date_diff($date1,$date2);
			if(!($diff->y <= 2)){
				return true;
			}
			else {
				return false;
			}
		}
		else {
			return true;
		}
	}

	public function daftarPelatihan() {
	    if($this->input->post('nik') != ''){
			if($this->cekPeriodeDaftarPeserta($this->input->post('nik'))){
				$pelatihan 	= $this->input->post('id');
				$kode_alm 	= $this->tools->get_kode_alamat();
				$date 		= date('Y-m-d');
				$nik 	 	= $this->input->post('nik');
				$kk 	 	= $this->input->post('kk');
				$ak1	 	= $this->input->post('ak1');
				$nama 		= $this->input->post('nama');
				$jk 	 	= $this->input->post('jk');
				$email 		= $this->input->post('email');
				$telepon 	= $this->input->post('no_telepon'); 
				$alamat 	= $this->input->post('alamat');
				$kelurahan 	= $this->input->post('kelurahan');
				$kecamatan 	= $this->input->post('kecamatan');
				$tem_lahir 	= $this->input->post('tempat_lahir');
				$tgl_lahir 	= $this->input->post('tanggal_lahir');
				$pend 		= $this->input->post('pendidikan');
				$kerja 	 	= $this->input->post('pekerjaan');
		
				$data = array(
					'nik'                   => $nik,
					'kk'                    => $kk,
					'no_ak1'                => $ak1,
					'nama'                  => $nama,
					'jenis_kelamin'         => $jk,
					'email'                 => $email,
					'no_telepon'            => $telepon,
					'pendidikan_terakhir'   => $pend,
					'status_pekerjaan'      => 'Belum Bekerja',
					'kode_alamat'           => $kode_alm,
					// 'foto_ktp'              => $_FILES['foto']['name'],
				);
		
				$dataAlamat = array(
					'kode_alamat'   => $kode_alm,
					'alamat'        => $alamat,
					'kelurahan'     => $kelurahan,
					'kecamatan'     => $kecamatan,
					'tempat_lahir'  => $tem_lahir,
					'tanggal_lahir' => $tgl_lahir
				);
		
				$dataHistory = array(
					'aktivitas'     => 'Daftar Pelatihan : '.$pelatihan,
					'detail'        => json_encode(array_merge($data, $dataAlamat)),
					'kode_user'     => 'Umum'
				);
		
				$dataPeserta = array(
					'tanggal_daftar'    => $date,
					'status'            => '0',
					'kode_pelatihan'    => $pelatihan,
					'nik'               => $nik
				);
				$cek = $this->tools->cek_nik($nik);	
				if ($cek > 0) {
					$periode        = $this->tools->cek_periode($nik);
					if(sizeof($periode) > 0){
						$umur           = intval(date('z', time() - strtotime($periode[0]->tanggal_daftar))) - date('z',1970);
						$jangka         = 730 - $umur;
						$years_remaining= intval($jangka / 365); 
						$days_remaining = $jangka % 365;          
						if ($umur <= 730) {
							// $this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">Gagal Mendaftar! Tersisa '.$years_remaining.' Tahun '.$days_remaining.' Hari Lagi Untuk Mendaftar</div>');
							// redirect('Home/pelatihanDetail/'.$pelatihan.'', 'refresh');
							echo json_encode(array("status" => FALSE, "notif" => "Gagal Mendaftar! Tersisa '.$years_remaining.' Tahun '.$days_remaining.' Hari Lagi Untuk Mendaftar"));
						} else {
							// move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/foto_ktp/' . $_FILES['foto']['name']);
							$this->db->insert('table_peserta_pelatihan', $dataPeserta);
							$this->db->insert('table_history', $dataHistory);
							// $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Berhasil Dikirim!</div>');
							// redirect('Home/pelatihanDetail/'.$pelatihan.'', 'refresh');
							echo json_encode(array("status" => TRUE, "notif" => "Berhasil Dikirim!"));
						}
					}	
					//Peserta yang tidak pernah mengikuti pelatihan.
					else{
						// move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/foto_ktp/' . $_FILES['foto']['name']);
						$this->db->insert('table_peserta_pelatihan', $dataPeserta);
						$this->db->insert('table_history', $dataHistory);
						// $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Berhasil Dikirim!</div>');
						// redirect('Home/pelatihanDetail/'.$pelatihan.'', 'refresh');
						echo json_encode(array("status" => TRUE, "notif" => "Berhasil Dikirim!"));
					}				
				} else {
					// move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/foto_ktp/' . $_FILES['foto']['name']);
					$this->db->insert('table_peserta', $data);
					$this->db->insert('table_alamat', $dataAlamat);
					$this->db->insert('table_history', $dataHistory);
					$this->db->insert('table_peserta_pelatihan', $dataPeserta);
					// $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Berhasil Dikirim!</div>');
					// redirect('Home/pelatihanDetail/'.$pelatihan.'', 'refresh');
					echo json_encode(array("status" => TRUE, "notif" => "Berhasil Dikirim!"));
				}		
			}
			else {
				echo json_encode(array("status" => FALSE, "notif" => "Mohon maaf, anda hanya dapat mendaftar pelatihan setiap 2 Tahun sekali."));      
			}
	    }	    
	    else {
			// redirect('Dashboard/pelatihan');	  
			echo json_encode(array("status" => FALSE, "notif" => "Mohon periksa kembali Form masukkan."));      
	    }	    
		
	}

	public function getPencakerByNIK() {
		$ch = curl_init();        
		curl_setopt($ch, CURLOPT_URL, 'https://betabkol.depok.go.id/dataapi/apipencaker/getPencakerByNIK');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		// curl_setopt($ch, CURLOPT_POSTFIELDS, array('nik'=> '3276021709950001'));
		$nik = $this->input->post('nik');
		curl_setopt($ch, CURLOPT_POSTFIELDS, array('nik'=> $nik));
		// curl_setopt($ch, CURLOPT_POSTFIELDS, array('nik' => $this->input->post('nik')));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$content = curl_exec($ch);              
		curl_close($ch);  
		$data = json_decode($content,true);
		echo json_encode( array("data"=>($data['response']), "csrf" => $this->security->get_csrf_hash()));
		// echo json_encode(array("data" => $this->input->post(), "csrf" => $this->security->get_csrf_hash()));
	}

	
}
