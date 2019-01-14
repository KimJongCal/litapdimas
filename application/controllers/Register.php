<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Register extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');

        $this->load->model('Master/Tbl_master_kluster');
        $this->load->model('Master/Tbl_master_bidang_ilmu');
        $this->load->model('Master/Tbl_master_fungsional');
        $this->load->model('Master/Tbl_master_jabatan_fungsional');
        $this->load->model('Master/Tbl_master_pangkat');
        $this->load->model('Master/Tbl_master_satker');
        $this->load->model('Peneliti/Tbl_proposal');
        $this->load->model('Peneliti/Tbl_proposal_content');
        $this->load->model('Peneliti/Tbl_proposal_peneliti');
        $this->load->model('Peneliti/Tbl_proposal_anggaran');
        $this->load->model('Peneliti/Tbl_proposal_berkas');
        $this->load->model('Peneliti/Tbl_proposal_pengumuman');
        $this->load->model('Peneliti/Tbl_peneliti');
        $this->load->model('Peneliti/Tbl_peneliti_berkas');
        $this->load->model('Peneliti/Tbl_peneliti_buku');
        $this->load->model('Peneliti/Tbl_peneliti_jurnal');
        $this->load->model('Peneliti/Tbl_peneliti_pendidikan');
        $this->load->model('Peneliti/Tbl_peneliti_users');
    }
    
    public function index(){
        $tbMSatker = $this->Tbl_master_satker->read()->result();        
        $tbMFungsional = $this->Tbl_master_fungsional->read()->result();
        $tbMPangkat = $this->Tbl_master_pangkat->read()->result();
        $tbMJabatanFungsional = $this->Tbl_master_jabatan_fungsional->read()->result();
        $tbMBidangIlmu = $this->Tbl_master_bidang_ilmu->read()->result();

        $data = array(
        	'tbMSatker' => $tbMSatker,
        	'tbMFungsional'  => $tbMFungsional,
            'tbMPangkat'  => $tbMPangkat,
            'tbMJabatanFungsional'  => $tbMJabatanFungsional,
            'tbMBidangIlmu'  => $tbMBidangIlmu,
        );
        $this->load->view('peneliti/register/read', $data);
    }

    public function Add(){
    	$data = array(
    		'id_peneliti' => time().rand(100,200),
    		'nama' => strtoupper($this->input->post('nama')),
    		'id_satker' => $this->input->post('id_satker'),
    		'email' => $this->input->post('email'),
    		'hp' => $this->input->post('no_hp'),
    		'id_fungsional' => $this->input->post('fungsional'),
    		'id_jab_fungsional' => $this->input->post('jabfung'),
    		'id_bidang_ilmu' => $this->input->post('bidang_ilmu'),
    		'id_pangkat' => $this->input->post('gol'),
    		'date_created' => date('Y-m-d H:i:s'),
    		'date_updated' => date('Y-m-d H:i:s'),
    		'user_created' => time().rand(100,200),
    		'user_updated' => time().rand(100,200),
    	);

    	$id_peneliti_user = time();

    	$data2 = array(
    		'id_peneliti_user' => $id_peneliti_user,
    		'id_peneliti'		=> $data['id_peneliti'],
    		'username'			=> $this->input->post('email'),
    		'password'			=> md5(md5($this->input->post('password'))),
    		'date_created'		=> date('Y-m-d H:i:s'),
    		'date_updated' 		=> date('Y-m-d H:i:s'),
    		'ip_created' 		=> $this->getIPAddress(),
    		'ip_updated' 		=> $this->getIPAddress(),
    	);

    	$password1 = $this->input->post('password');
    	$password2 = $this->input->post('password2');

    	if($password1 != $password2){
    		$this->session->set_flashdata('message','Password tidak sama.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Register');
    	}else{
    		$search = array(
    			'username' => $this->input->post('email'),
    		);
    		$tbPenelitiUsers = $this->Tbl_peneliti_users->whereAnd($search)->num_rows();
    		if($tbPenelitiUsers > 0){
    			$this->session->set_flashdata('message','Email sudah terdaftar. Silahkan Gunakan email lain.');
			    $this->session->set_flashdata('type_message','danger');
			    redirect('Register');
    		}else{
    			if($this->Tbl_peneliti->create($data)){
					if($this->Tbl_peneliti_users->create($data2)){
						// Konfigurasi email.
				        $config = [
				               'useragent' => 'CodeIgniter',
				               'protocol'  => 'smtp',
				               'mailpath'  => '/usr/sbin/sendmail',
				               'smtp_host' => 'ssl://smtp.gmail.com',
				               'smtp_user' => 'piscalpratama@gmail.com',   // Ganti dengan email gmail Anda.
				               'smtp_pass' => 'piscal02',             // Password gmail Anda.
				               'smtp_port' => 465,
				               'smtp_keepalive' => TRUE,
				               'smtp_crypto' => 'SSL',
				               'wordwrap'  => TRUE,
				               'wrapchars' => 80,
				               'mailtype'  => 'html',
				               'charset'   => 'utf-8',
				               'validate'  => TRUE,
				               'crlf'      => "\r\n",
				               'newline'   => "\r\n",
				           ];
				 
				        // Load library email dan konfigurasinya.
				        $this->load->library('email', $config);
				 
				        // Pengirim dan penerima email.
				        $this->email->from('no-reply@LP2M', 'LP2M');    // Email dan nama pegirim.
				        $this->email->to($this->input->post('email'));                       // Penerima email.
				 
				        // Subject email.
				        $this->email->subject('Aktivasi Akun Peneliti');
				 
				        // Isi email. Bisa dengan format html.
				        $html = '<strong>Nama Lengkap</strong> : '.$data['nama'].'<br>';
				        $html .= '<strong>Email</strong> : '.$data['email'].'<br>';
				        $html .= '<strong>Password</strong> : '.$password1.'<br>';
				        $html .= '<strong>No. Handphone</strong> : '.$data['hp'].'<br>';
				        $html .= '<br>Klik link di bawah untuk aktivasi akun.';
				        $html .= '<br><a href="'.base_url('index.php/Register/Aktivasi/'.$id_peneliti_user).'">Aktivasi Akun</a>';
				        $this->email->message($html);
				 
				        if ($this->email->send()){
				        	$this->session->set_flashdata('message','Berhasil register. Silahkan cek email untuk aktivasi akun.');
					        $this->session->set_flashdata('type_message','success');
					        redirect('Login');
				        }else{
				            $this->session->set_flashdata('message','Gagal register akun.');
						    $this->session->set_flashdata('type_message','danger');
						    redirect('Register');
				        }
					}else{
						$this->session->set_flashdata('message','Gagal register peneliti.');
					    $this->session->set_flashdata('type_message','danger');
					    redirect('Register');
					}
				}else{
					$this->session->set_flashdata('message','Gagal register user peneliti.');
				    $this->session->set_flashdata('type_message','danger');
				    redirect('Register');
				}
    		}
    	}
    }

    public function LupaPassword(){
    	$this->load->view('peneliti/register/lupa_password');
    }

    public function ActLupaPassword(){
    	$search = array(
    		'username' => $this->input->post('email'),
    	);

    	$tbPenelitiUsers = $this->Tbl_peneliti_users->whereAnd($search)->row();
    	$tbPenelitiUsers_num_rows = $this->Tbl_peneliti_users->whereAnd($search)->num_rows();

    	if($tbPenelitiUsers_num_rows > 0){
			$tbPeneliti = $this->Tbl_peneliti->whereAnd(array('id_peneliti' => $tbPenelitiUsers->id_peneliti))->row();    		
    		// Konfigurasi email.

			$password_baru = rand(20000,99999);
    		$data = array(
    			'password' => md5(md5($password_baru)),
    		);
    		if($this->Tbl_peneliti_users->update(array('id_peneliti_user' => $tbPenelitiUsers->id_peneliti_user), $data)){
    			$config = [
		               'useragent' => 'CodeIgniter',
		               'protocol'  => 'smtp',
		               'mailpath'  => '/usr/sbin/sendmail',
		               'smtp_host' => 'ssl://smtp.gmail.com',
		               'smtp_user' => 'piscalpratama@gmail.com',   // Ganti dengan email gmail Anda.
		               'smtp_pass' => 'piscal02',             // Password gmail Anda.
		               'smtp_port' => 465,
		               'smtp_keepalive' => TRUE,
		               'smtp_crypto' => 'SSL',
		               'wordwrap'  => TRUE,
		               'wrapchars' => 80,
		               'mailtype'  => 'html',
		               'charset'   => 'utf-8',
		               'validate'  => TRUE,
		               'crlf'      => "\r\n",
		               'newline'   => "\r\n",
		           ];
		 
		        // Load library email dan konfigurasinya.
		        $this->load->library('email', $config);
		 
		        // Pengirim dan penerima email.
		        $this->email->from('no-reply@LP2M', 'LP2M');    // Email dan nama pegirim.
		        $this->email->to($this->input->post('email'));                       // Penerima email.
		 
		        // Subject email.
		        $this->email->subject('Lupa Password Akun Peneliti');
		 
		        // Isi email. Bisa dengan format html.
		        $html = '<strong>Nama Lengkap</strong> : '.$tbPeneliti->nama.'<br>';
		        $html .= '<strong>Email</strong> : '.$tbPenelitiUsers->username.'<br>';
		        $html .= '<strong>Password</strong> : '.$password_baru.'<br>';
		        $html .= '<strong>No. Handphone</strong> : '.$tbPeneliti->hp.'<br>';
		        $this->email->message($html);
		 
		        if ($this->email->send()){
		        	$this->session->set_flashdata('message','Berhasil terkirim. Silahkan cek email untuk mengetahui password baru.');
			        $this->session->set_flashdata('type_message','success');
			        redirect('Login');
		        }else{
		            $this->session->set_flashdata('message','Password gagal terkirim.');
				    $this->session->set_flashdata('type_message','danger');
				    redirect('Register/LupaPassword');
		        }
    		}else{
    			$this->session->set_flashdata('message','Password gagal diubah.');
			    $this->session->set_flashdata('type_message','danger');
			    redirect('Register/LupaPassword');
    		}
    	}else{
    		$this->session->set_flashdata('message','Email tidak terdaftar.'.$tbPenelitiUsers_num_rows.$this->input->post('email'));
		    $this->session->set_flashdata('type_message','danger');
		    redirect('Register/LupaPassword');
    	}
    }

    public function Aktivasi($id){
    	$where = array(
    		'id_peneliti_user' => $id,
    	);
    	$data = array(
    		'status_aktivasi' => "1",
    	);

    	if($this->Tbl_peneliti_users->update($where, $data)){
    		$this->session->set_flashdata('message','Berhasil aktivasi akun. Silahkan login menggunakan username dan password yang telah dibuat');
			$this->session->set_flashdata('type_message','success');
			redirect('Login');
    	}else{
    		$this->session->set_flashdata('message','Gagal Aktivasi');
			$this->session->set_flashdata('type_message','danger');
			redirect('Login');
    	}
    }

    public function getIPAddress(){
		$ipaddress = '';
	    if (isset($_SERVER['HTTP_CLIENT_IP']))
	        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_X_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
	    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
	    else if(isset($_SERVER['HTTP_FORWARDED']))
	        $ipaddress = $_SERVER['HTTP_FORWARDED'];
	    else if(isset($_SERVER['REMOTE_ADDR']))
	        $ipaddress = $_SERVER['REMOTE_ADDR'];
	    else
	        $ipaddress = 'UNKNOWN';
	    return $ipaddress;
	}
}