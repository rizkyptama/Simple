<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_Tools', 'tools');
		// $this->load->helper('captcha');
		$this->load->helper('url');
		$this->load->library(array('recaptchagoogle','form_validation'));
	}

	private function load($title = '', $datapath = '')
	{
		$page = array(
			"head"      => $this->load->view('home/template/head', array("title" => $title), true),
			"main_js"   => $this->load->view('home/template/main_js', false, true),
		);
		return $page;
	}

	public function index()
	{
		if ($this->session->userdata('username') == true && $this->session->userdata('level') == "Admin") { 
			redirect('Dashboard');
		}elseif($this->session->userdata('email') == true && $this->session->userdata('level') == "User") {
			redirect('DashboardLPK');
		}
		$path = "";
		$data = array(
			"page"      => $this->load("Pelatihan Kota Depok - Login", $path),
			"content"   => $this->load->view('login', false, true),
			'recaptcha_html' => $this->recaptchagoogle->render()
		);

		// google captcha
		// $data = array(
        //     'recaptcha_html' => $this->recaptcha->render()
		// );
		
		
		
		
		/*=================CAPTCHA LAMA====================*/
		// Captcha configuration
		// $config = array(
		// 	'img_path'      => 'captcha_images/',
		// 	'img_url'       => base_url().'captcha_images/',
		// 	'img_width'     => '150',
		// 	'img_height'    => 50,
		// 	'word_length'   => 6,
		// 	'font_size'     => 30
		// );
		// $captcha = create_captcha($config);
		
		// Unset previous captcha and store new captcha word
		// $this->session->unset_userdata('captchaCode');
		// $this->session->set_userdata('captchaCode',$captcha['word']);
		
		// Send captcha image to view
		// $data['captchaImg'] = $captcha['image'];
		
	    /*=================END CAPTCHA LAMA====================*/
	    
	    
	    /*=================CAPTCHA BARU====================*/
	    
	    /*=================END CAPTCHA BARU====================*/
	    
		
		$this->load->view('login', $data);
	}
	
// 	refresh captcha
	public function refresh(){
		// Captcha configuration
		$config = array(
			'img_path'      => 'captcha_images/',
			'img_url'       => base_url().'captcha_images/',
			'img_width'     => '150',
			'img_height'    => 50,
			'word_length'   => 6,
			'font_size'     => 30
		);
		$captcha = create_captcha($config);
		
		// Unset previous captcha and store new captcha word
		$this->session->unset_userdata('captchaCode');
		$this->session->set_userdata('captchaCode',$captcha['word']);
		
		// Display captcha image
		echo $captcha['image'];
		
	}

	public function pendaftaran()
	{
		$path = "";
		$data = array(
			"page"      => $this->load("Pelatihan Kota Depok - Pendaftaran", $path),
			"content"   => $this->load->view('daftar', false, true),
// 			"csrf" => array(
//     			'name' => $this->security->get_csrf_token_name(),
//                 'hash' => $this->security->get_csrf_hash(),
//             ),
		);
		
		// Captcha configuration
		$config = array(
			'img_path'      => 'captcha_images/',
			'img_url'       => base_url().'captcha_images/',
			'img_width'     => '150',
			'img_height'    => 50,
			'word_length'   => 6,
			'font_size'     => 30
		);
		$captcha = create_captcha($config);
		
		// Unset previous captcha and store new captcha word
		$this->session->unset_userdata('captchaCode');
		$this->session->set_userdata('captchaCode',$captcha['word']);
		
		// Send captcha image to view
		$data['captchaImg'] = $captcha['image'];
		
		$this->load->view('daftar', $data);
	}

    //MENGECEK USERNAME DAN PASSWORD DARI DATABASE
	public function login() {
		$email          = $this->input->post('username');
		$password       = md5($this->input->post('password'));
        // $inputCaptcha   = $this->input->post('captcha');
		// $sessCaptcha    = $this->session->userdata('captchaCode');

		$recaptcha = $this->input->post('g-recaptcha-response');
		$verifyrecaptcha = $this->recaptchagoogle->verifyResponse($recaptcha, NULL);
		// if($status['success'] == TRUE){
		// 	echo "OKEEEE";
		// }

		
		$data = $this->tools->readBy($email, $password);

		if(isset($data->username) && isset($data->password)){
			if ($email == $data->username && $password == $data->password){
			    // if($inputCaptcha === $sessCaptcha){
				// if($verifyrecaptcha['success'] == TRUE){
				if(1 == 1){
    				if ($data->status == "Aktif") {
    	                //PENGURUS PUSAT
    					if($data->level == "Admin"){
    						$newdata = array(
    							"username"  => $data->username,
    							"password"  => $data->password,
    							"level"     => $data->level,
    							"kode"      => $data->kode_user
    						);
    
    						$this->session->set_userdata($newdata);
    
    						$dataLogin = array(
    							"aktivitas" => "Login",
    							"kode_user" => $data->kode_user
    						);
    
    						$this->db->insert('table_history', $dataLogin);
    
    						$this->session->set_flashdata('notif', '<script>toastr.success("Login Berhasil!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
    						redirect('Dashboard');
    					}elseif($data->level == "User"){
    						$newdata = array(
    							"username"  => $data->username,
    							"password"  => $data->password,
    							"level"     => $data->level,
    							"kode"      => $data->kode_user
    						);
    
    						$this->session->set_userdata($newdata);
    
    						$dataLogin = array(
    							"aktivitas" => "Login",
    							"kode_user" => $data->kode_user
    						);
    
    						$this->db->insert('table_history', $dataLogin);
    
    						$this->session->set_flashdata('notif', '<script>toastr.success("Login Berhasil!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
    						redirect('DashboardLPK');
    					}
    					
    				}elseif ($data->status == 'Pending'){
    					$this->session->set_flashdata("notif", "Akun Belum Diverifikasi");
    					redirect('login');
    				}else{
    					$this->session->set_flashdata("notif", "Akun Anda Telah Terblokir");
    					redirect('login');
    				}
			    }else{
			        $this->session->set_flashdata("notif", "Maaf Captcha Yang Anda Masukan Salah");
				    redirect('login');
			    }
			}else{
				$this->session->set_flashdata("notif", "Akun Belum Terdaftar");
				redirect('login');
			}
		}else{
			$this->session->set_flashdata("notif", "Masukkan Username & Password Dengan Benar");
			redirect('login');
		}
	}

	public function daftar() {
	    
	    if($this->input->post('password') != ''){
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
        
                $inputCaptcha   = $this->input->post('captcha');
        		$sessCaptcha    = $this->session->userdata('captchaCode');
        
        		$dataLogin = array(
        			'username'  => $username,
        			'password'  => md5($password),
        			'level'     => 'User',
        			'status'    => 'Pending',
        			'kode_user' => $kode
        		);
        
        		$data = array(
        			'kode_user'         => $kode,
        			'nama'              => $nama,		
        			'alamat'            => $alamat,
        			'telepon'           => $no_telepon,
        			'email'             => $email,	 	
        			'no_izin'           => $no_izin, 	
        			'tanggal_izin'      => $tgl_izin, 	
        			'jenis'             => $jenis, 		
        			'status_akreditas'  => $status_a,	
        			'no_akreditas'      => $no_a,	
        			'ruang_lingkup'     => $ruang,
        			'tipe'              => $tipe,
        			'photo'             => $_FILES['logo']['name']
        		);
        
        		$dataPengurus = array(
        			'nama_pimpinan'         => $nama_p,
        			'no_telepon_pimpinan'   => $telp_p,
        			'nama_pj'               => $nama_pj,
        			'jabatan_pj'            => $jabatan,
        			'no_telepon_pj'         => $telp_pj,
        			'kode_user'             => $kode
        		);
        
        		$dataAnggota = array(
        			array(
        				'tipe'          => 'Karyawan',
        				'jenis_kelamin' => 'Laki-laki',
        				'jumlah'        => $karyawan_l,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Karyawan',
        				'jenis_kelamin' => 'Perempuan',
        				'jumlah'        => $karyawan_p,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Tenaga Pelatihan Tetap',
        				'jenis_kelamin' => 'Laki-laki',
        				'jumlah'        => $tpt_l,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Tenaga Pelatihan Tetap',
        				'jenis_kelamin' => 'Perempuan',
        				'jumlah'        => $tpt_p,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Tenaga Pelatihan Tidak Tetap',
        				'jenis_kelamin' => 'Laki-laki',
        				'jumlah'        => $tptt_l,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Tenaga Pelatihan Tidak Tetap',
        				'jenis_kelamin' => 'Perempuan',
        				'jumlah'        => $tptt_p,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Instruktur Tetap',
        				'jenis_kelamin' => 'Laki-laki',
        				'jumlah'        => $it_l,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Instruktur Tetap',
        				'jenis_kelamin' => 'Perempuan',
        				'jumlah'        => $it_p,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Instruktur Tidak Tetap',
        				'jenis_kelamin' => 'Laki-laki',
        				'jumlah'        => $itt_l,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Instruktur Tidak Tetap',
        				'jenis_kelamin' => 'Perempuan',
        				'jumlah'        => $itt_p,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Asesor Kompetensi',
        				'jenis_kelamin' => 'Laki-laki',
        				'jumlah'        => $ak_l,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Asesor Kompetensi',
        				'jenis_kelamin' => 'Perempuan',
        				'jumlah'        => $ak_p,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Instruktur/Asesor WNA',
        				'jenis_kelamin' => 'Laki-laki',
        				'jumlah'        => $aw_l,
        				'kode_user'     => $kode
        			),
        			array(
        				'tipe'          => 'Instruktur/Asesor WNA',
        				'jenis_kelamin' => 'Perempuan',
        				'jumlah'        => $aw_p,
        				'kode_user'     => $kode
        			),
        		);
        
        		$dataHistory = array(
        			'aktivitas' => 'Daftar : '.$nama,
        			'detail'    => json_encode($data),
        			'photo'     => $_FILES['logo']['name'],
        			'kode_user' => $kode
        		);
        
                if($inputCaptcha === $sessCaptcha){
            		move_uploaded_file($_FILES['logo']['tmp_name'], './assets/upload/logo/' . $_FILES['logo']['name']);
            		$this->db->insert("table_login", $dataLogin);
            		$this->db->insert("table_pengurus", $dataPengurus);
            		$this->db->insert("table_user", $data);
            		$this->db->insert_batch("table_anggota", $dataAnggota);
            		$this->db->insert("table_history", $dataHistory);
            		$this->session->set_flashdata('notif', '<script>toastr.success("Data Anda Telah Tersimpan!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
            		redirect('/');
                }else{
                    $this->session->set_flashdata("notif", "Maaf Captcha Yang Anda Masukan Salah");
                    redirect('http://simpel.depok.go.id/pendaftaran');
                }
        
	    }
	    
	    else{
	        redirect('pendaftaran');
	    }
	
	}

    //UNTUK LOGOUT DAN MENGHAPUS SESSION LOGIN
	public function logout() {
		$kode = $this->session->userdata['kode'];

		$dataLogin = array(
			"aktivitas" => "Logout",
			"kode_user" => $kode
		);

		$this->db->insert('table_history', $dataLogin);

		$this->session->sess_destroy();

		$this->session->set_flashdata('notif', '<script>toastr.success("Logout Berhasil!", "Success", {"timeOut": "2000","extendedTImeout": "0"});</script>');
		redirect('?logout=success');
	}

	// public function gantiPw(){
	// 	$passwordLama = $this->input->post('pwLama');
	// 	$passwordBaru = $this->input->post('pwBaru');
	// 	$lama = $this->session->userdata['password'];
	// 	$id = $this->session->userdata['id'];
	// 	if (md5($passwordLama) == $lama) {
	// 		$data = array("password" => md5($passwordBaru));
	// 		$this->db->where('id', $id);
	// 		$update = $this->db->update('table_login', $data);
	// 		if ($update) {
	// 			echo json_encode('ok');
	// 		}else{
	// 			echo json_encode('fail');
	// 		}
	// 	}else{
	// 		echo json_encode('beda');
	// 	}
	// }
}