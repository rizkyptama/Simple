<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("M_Home", "model");
		$this->load->model("M_Tools", "tools");
		$this->load->helper('captcha');
		if ($this->session->userdata('username') == true && $this->session->userdata('level') == "Admin") {
			redirect('Dashboard');
		} else if ($this->session->userdata('username') == true && $this->session->userdata('level') == "User") {
			redirect('DashboardLPK');
		}
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
		$slider = array(
			'slider'    => $this->model->dataSlider(),
			'youtube'	=> $this->model->dataYoutube(),
			'marque'    => $this->model->dataMarque(),
            'lpk'       => $this->model->dataLPK(6),
            'berita'    => $this->model->dataBerita(6),
            'pelatihan' => $this->model->dataPelatihan(6),
            'jenis'     => $this->model->datajenis(),
        );
		$path = "";
		// $data1['model'] = $this->model->dataPelatihan();
		
		$data = array(
			"page"      => $this->load("Pelatihan Kota Depok", $path),
			"content"   => $this->load->view('home/index', $slider, true),
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
		
		$this->load->view('home/template/default_template', $data);
	}
	
	//refresh captcha
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

	public function cariPelatihan(){
		$bulanpelatihan = $this->input->post("bulanpelatihan");
		$tahunpelatihan = $this->input->post("tahunpelatihan");
		$jenispelatihan = $this->input->post("jenispelatihan");
		$keypelatihan = $this->input->post("keypelatihan");

		$this->db->select("*");
        $this->db->from('table_pelatihan');
        if ($bulanpelatihan != NULL || $bulanpelatihan != "") {
        	$this->db->where('MONTH(tanggal_berakhir_daftar)', $bulanpelatihan);
        }
        if ($tahunpelatihan != NULL || $tahunpelatihan != "") {
        	$this->db->where('YEAR(tanggal_berakhir_daftar)', $tahunpelatihan);
        }
        if ($jenispelatihan != NULL || $jenispelatihan != "") {
        	$this->db->where('kode_jenis', $jenispelatihan);
        }
        if ($keypelatihan != NULL || $keypelatihan != "") {
	        $this->db->like('nama', $keypelatihan);
        }
        $this->db->order_by("kode_pelatihan", "DESC");
        $this->db->limit(6);
        $query = $this->db->get();
        echo json_encode($query->result_array());
	}

	public function carilpk(){
		$keylpk = $this->input->post("keylpk");
		$this->db->select('*');
        $this->db->from('table_user a');
        $this->db->join('table_login b', 'b.kode_user = a.kode_user');
        $this->db->join('table_pengurus c', 'c.kode_user = a.kode_user');
        if ($keylpk != NULL || $keylpk != "") {
	        $this->db->like('a.nama', $keylpk);
        }
        $this->db->order_by('b.created_date', 'DESC');
        $this->db->limit(6);
        $query = $this->db->get();
        echo json_encode($query->result_array());
	}

	public function pelatihan()
	{
		$path = "";
		$arraydata = array(
		'pelatihan' => $this
            ->model
            ->dataPelatihan(12),
        );
		$data = array(
			"page" => $this->load("Pelatihan Kota Depok - Pelatihan", $path),
			"content" => $this->load->view('home/pelatihan', $arraydata, true),
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
		$this->load->view('home/template/default_template', $data);
	}

	public function pelatihanDetail($id)
	{
		$detail = array(
            'detail' => $this
            ->model
            ->dataPelatihanDetail($id),
            'lainnya' => $this
            ->model
            ->dataPelatihanLain($id),
        );
		$path = "";
		
		if (sizeof($detail['detail']) == 0){
		   $this->notfound();
		}
		else {
    		$data = array(
    			"page"      => $this->load("Pelatihan Kota Depok - Pelatihan Detail", $path),
    			"content"   => $this->load->view('home/pelatihanDetail', $detail, true),
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
    		
    		$this->load->view('home/template/default_template', $data); 
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
			$pelatihan 	= $this->input->post('id');
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
					'foto_ktp'              => $_FILES['foto']['name'],
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
							$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">Gagal Mendaftar! Tersisa '.$years_remaining.' Tahun '.$days_remaining.' Hari Lagi Untuk Mendaftar</div>');
							redirect('Home/pelatihanDetail/'.$pelatihan.'', 'refresh');
							// echo json_encode(array("status" => FALSE, "notif" => "Gagal Mendaftar! Tersisa '.$years_remaining.' Tahun '.$days_remaining.' Hari Lagi Untuk Mendaftar"));
						} else {
							move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/foto_ktp/' . $_FILES['foto']['name']);
							$this->db->insert('table_peserta_pelatihan', $dataPeserta);
							$this->db->insert('table_history', $dataHistory);
							$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Berhasil Dikirim!</div>');
							redirect('Home/pelatihanDetail/'.$pelatihan.'', 'refresh');
							// echo json_encode(array("status" => TRUE, "notif" => "Berhasil Dikirim!"));
						}
					}	
					//Peserta yang tidak pernah mengikuti pelatihan.
					else{
						move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/foto_ktp/' . $_FILES['foto']['name']);
						$this->db->insert('table_peserta_pelatihan', $dataPeserta);
						$this->db->insert('table_history', $dataHistory);
						$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Berhasil Dikirim!</div>');
						redirect('Home/pelatihanDetail/'.$pelatihan.'', 'refresh');
						// echo json_encode(array("status" => TRUE, "notif" => "Berhasil Dikirim!"));
					}				
				} else {
					move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/foto_ktp/' . $_FILES['foto']['name']);
					$this->db->insert('table_peserta', $data);
					$this->db->insert('table_alamat', $dataAlamat);
					$this->db->insert('table_history', $dataHistory);
					$this->db->insert('table_peserta_pelatihan', $dataPeserta);
					$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Berhasil Dikirim!</div>');
					redirect('Home/pelatihanDetail/'.$pelatihan.'', 'refresh');
					// echo json_encode(array("status" => TRUE, "notif" => "Berhasil Dikirim!"));
				}		
			}
			else {
				$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">Mohon maaf, anda hanya dapat mendaftar pelatihan setiap <br>2 Tahun sekali.</div>');
				redirect('Home/pelatihanDetail/'.$pelatihan.'', 'refresh');
				// echo json_encode(array("status" => FALSE, "notif" => "Mohon maaf, anda hanya dapat mendaftar pelatihan setiap <br>2 Tahun sekali</br>."));      
			}
	    }	    
	    else {
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">Mohon periksa kembali Form masukkan.</div>');
			redirect('pendaftaran');
			// echo json_encode(array("status" => FALSE, "notif" => "Mohon periksa kembali Form masukkan."));      
	    }	    
		
	}

	// public function daftarPelatihan() {
	//    // echo "coco";
	//     if($this->input->post('nik') != ''){
	        
    // 	    $pelatihan 	= $this->input->post('id');
    // 		$kode_alm 	= $this->tools->get_kode_alamat();
    // 		$date 		= date('Y-m-d');
    // 		$nik 	 	= $this->input->post('nik');
    // 		$kk 	 	= $this->input->post('kk');
    // 		$ak1	 	= $this->input->post('ak1');
    // 		$nama 		= $this->input->post('nama');
    // 		$jk 	 	= $this->input->post('jk');
    // 		$email 		= $this->input->post('email');
    // 		$telepon 	= $this->input->post('no_telepon'); 
    // 		$alamat 	= $this->input->post('alamat');
    // 		$kelurahan 	= $this->input->post('kelurahan');
    // 		$kecamatan 	= $this->input->post('kecamatan');
    // 		$tem_lahir 	= $this->input->post('tempat_lahir');
    // 		$tgl_lahir 	= $this->input->post('tanggal_lahir');
    // 		$pend 		= $this->input->post('pendidikan');
    // 		$kerja 	 	= $this->input->post('pekerjaan');
    
    // 		$data = array(
    // 			'nik'                   => $nik,
    // 			'kk'                    => $kk,
    // 			'no_ak1'                => $ak1,
    // 			'nama'                  => $nama,
    // 			'jenis_kelamin'         => $jk,
    // 			'email'                 => $email,
    // 			'no_telepon'            => $telepon,
    // 			'pendidikan_terakhir'   => $pend,
    // 			'status_pekerjaan'      => 'Belum Bekerja',
    // 			'kode_alamat'           => $kode_alm,
    // 			'foto_ktp'              => $_FILES['foto']['name'],
    // 		);
    
    // 		$dataAlamat = array(
    // 			'kode_alamat'   => $kode_alm,
    // 			'alamat'        => $alamat,
    // 			'kelurahan'     => $kelurahan,
    // 			'kecamatan'     => $kecamatan,
    // 			'tempat_lahir'  => $tem_lahir,
    // 			'tanggal_lahir' => $tgl_lahir
    // 		);
    
    // 		$dataHistory = array(
    // 			'aktivitas'     => 'Daftar Pelatihan : '.$pelatihan,
    // 			'detail'        => json_encode(array_merge($data, $dataAlamat)),
    // 			'kode_user'     => 'Umum'
    // 		);
    
    // 		$dataPeserta = array(
    // 			'tanggal_daftar'    => $date,
    // 			'status'            => '0',
    // 			'kode_pelatihan'    => $pelatihan,
    // 			'nik'               => $nik
    // 		);
    
    // 		$cek = $this->tools->cek_nik($nik);
    
    // 		if ($cek > 0) {
    // 			$periode        = $this->tools->cek_periode($nik);
    // 			$umur           = intval(date('z', time() - strtotime($periode[0]->tanggal_daftar))) - date('z',1970);
    // 			$jangka         = 730 - $umur;
    // 			$years_remaining= intval($jangka / 365); 
    // 			$days_remaining = $jangka % 365;          
    // 			if ($umur <= 730) {
    // 				$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert">Gagal Mendaftar! Tersisa '.$years_remaining.' Tahun '.$days_remaining.' Hari Lagi Untuk Mendaftar</div>');
    // 				redirect('Home/pelatihanDetail/'.$pelatihan.'', 'refresh');
    // 			} else {
    // 				move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/foto_ktp/' . $_FILES['foto']['name']);
    // 				$this->db->insert('table_peserta_pelatihan', $dataPeserta);
    // 				$this->db->insert('table_history', $dataHistory);
    // 				$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Berhasil Dikirim!</div>');
    // 				redirect('Home/pelatihanDetail/'.$pelatihan.'', 'refresh');
    // 			}
    // 		} else {
    // 			move_uploaded_file($_FILES['foto']['tmp_name'], './assets/upload/foto_ktp/' . $_FILES['foto']['name']);
    // 			$this->db->insert('table_peserta', $data);
    // 			$this->db->insert('table_alamat', $dataAlamat);
    // 			$this->db->insert('table_history', $dataHistory);
    // 			$this->db->insert('table_peserta_pelatihan', $dataPeserta);
    // 			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Berhasil Dikirim!</div>');
    // 			redirect('Home/pelatihanDetail/'.$pelatihan.'', 'refresh');
    // 		}		
		
	//     }
	    
	//     else {
	        
	//        // echo "jojo";
	//         redirect('pendaftaran');
	        
	//     }
	    
		
	// }

	public function lpk()
	{
	    $page = 0;
	    if($this->uri->segment(3) != "" && intval($this->uri->segment(3)) > 0){
    	    $page = intval($this->uri->segment(3));
	    }
	    $limit = 12;
	    $max_page = intval(ceil($this->model->dataLPKCount()/$limit));
	    if($page > $max_page || $page == 0){
	        $this->notfound();
	    }
	    else{
	        $next_button = '';
	        $prev_button = '';
	        if(($page+1) <= $max_page){
	            $next_button = '<a href="'.($page+1).'" class="next">Next</a>';
	        }
	        else{
	            $next_button = '<a href="" style="display:none;" class="next">Next</a>';
	        }
	        if((intval($page-1)) > 0){
	            $prev_button = '<a href="'.($page-1).'" class="next">Prev</a>';
	        }
	        else{
	            $prev_button = '<a href="" style="display:none;" class="next">Prev</a>';
	        }
    	    $offset = (($page*$limit)-$limit)+1;
	        $content = $this->model->dataLPKPagination($limit, $offset);
	        $path = "";
    		$arraydata = array(
    		    'lpk' => $content,
    			"next" => $next_button,
    			"prev" => $prev_button,
            );
    		$data = array(
    			"page"      => $this->load("Pelatihan Kota Depok - LPK", $path),
    			"content"   => $this->load->view('home/lpk', $arraydata, true),
    			
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
    		$this->load->view('home/template/default_template', $data);
	    }
	    
		
	}

	public function lpkDetail()
	{
		$id = $this->uri->segment(3);
		$array = array(
			"detail"    => $this->model->dataLPKdetail($id),
			'lpk'       => $this->model->dataLPK(6),
		);
		$path = "";
		if (sizeof($array['detail']) == 0){
		   $this->notfound();
		}
		else {
    		$data = array(
    			"page"      => $this->load("Pelatihan Kota Depok - LPK Detail", $path),
    			"content"   => $this->load->view('home/lpkDetail', $array, true),
    
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
    		
    		$this->load->view('home/template/default_template', $data);
		}
	}

	public function info()
	{
		$path = "";
		$arraydata = array(
		    'berita' => $this->model->dataBerita(6),
        );
		$data = array(
			"page"      => $this->load("Pelatihan Kota Depok - Informasi", $path),
			"content"   => $this->load->view('home/info', $arraydata, true),
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
	    	$this->load->view('home/template/default_template', $data);
	}

	public function infoDetail()
	{
		$id = $this->uri->segment(3);
		$array = array(
			"detail"    => $this->model->dataBeritaDetail($id),
			'info'      => $this->model->dataBerita(6),
		);
		$path = "";
 		if (sizeof($array['detail']) == 0){
		   $this->notfound();
		}
		else {
    		$data = array(
    			"page"      => $this->load("Pelatihan Kota Depok - Informasii Detail", $path),
    			"content"   => $this->load->view('home/infoDetail', $array, true),
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
    		
    		$this->load->view('home/template/default_template', $data);
		}
	}

	public function notfound()
	{
		$path = "";
		$data = array(
			"page"      => $this->load("Pelatihan Kota Depok - 404 Not Found", $path),
			"content"   => $this->load->view('404', false, true),
		);
		$this->load->view('404', $data);
	}

	public function tambahHelpDesk()
	{
	    $inputCaptcha   = $this->input->post('captcha');
		$sessCaptcha    = $this->session->userdata('captchaCode');
		
		if($inputCaptcha === $sessCaptcha){
		    $tipe           = $this->input->post('tipe');
		    $nik            = $this->input->post('nik');
		    $nama           = $this->input->post('nama');
		    $email          = $this->input->post('email');
		    $status         = $this->input->post('status');
		    $masukan        = $this->input->post('masukan');
    
		    $data = array(
		    	"tipe"      => $tipe,
		    	"email"     => $email,
		    	"nik"       => $nik,
		    	"nama"      => $nama,
		    	"status"    => $status,
		    	"pesan"     => $masukan
		    );

		    $this->db->insert("table_helpdesk", $data);
		  //  $this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert">Berhasil Dikirim!</div>');
		    $this->session->set_flashdata('notif', '<script>alert("Berhasil Dikirim!");</script>');
		    redirect($_SERVER['HTTP_REFERER']);
		}else{
		    $this->session->set_flashdata('notif', '<script>alert("Captcha Salah");</script>');
		    redirect($_SERVER['HTTP_REFERER']);
		}
	}

	
// 	public function checkPeserta()
//     {
//         $nik = $this->input->post('cari');
//         $data = array(
//             'data' => $this->model->checkPeserta($nik),
//         );
//         echo json_encode($data);
//     }


	public function getPencakerByNIK() {
		$ch = curl_init();        
		curl_setopt($ch, CURLOPT_URL, 'https://bkol.depok.go.id/dataapi/apipencaker/getPencakerByNIK');    
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        //curl_setopt($ch, CURLOPT_POSTFIELDS, array('nik'=> '3276021709950001'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, array('nik' => $this->input->post("nik")));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);              
		$content = curl_exec($ch);              
		curl_close($ch);    
		$data = json_decode($content,true);
		echo json_encode( array("data"=>($data['response'])));
	}

	
}
