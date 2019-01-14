<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
        $this->load->model('Peneliti/Tbl_peneliti_users');
    }

	public function index(){
		$this->load->view('login-peneliti');
	}

	public function actLogin(){
	    $rules[] = array('field' => 'username',	'label' => 'Username', 'rules' => 'required');
	    $rules[] = array('field' => 'password', 'label' => 'Password', 'rules' => 'required');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message',validation_errors());
			$this->session->set_flashdata('type_message','danger');
			redirect('Login');
		}else{
			$data = array(
			    'username' => set_value('username'),
			    'password' => md5(md5(set_value('password'))),
            );
			$tblUsers	= $this->Tbl_peneliti_users->whereAndJoin($data);
			if ($tblUsers->num_rows() > 0) {
				$tblUsers = $tblUsers->row();

				if($tblUsers->status_aktivasi == 1){
					$data = array(
						'logged' 		=> TRUE, 
						'id_peneliti_users'		=> $tblUsers->id_peneliti_user,
						'id_peneliti'		=> $tblUsers->id_peneliti,
						'username'		=> $tblUsers->username,
						'nama'			=> $tblUsers->nama,
						'level'			=> 3,
					);
					$this->session->set_userdata($data);
					redirect('Peneliti/Dashboard');
				}else{
					$this->session->set_flashdata('message','Akun belum diaktivasi');
					$this->session->set_flashdata('type_message','danger');
					redirect('Login');
				}
			}else{
				$this->session->set_flashdata('message','Username atau Password Salah');
				$this->session->set_flashdata('type_message','danger');
				redirect('Login');
			}
		}
	}
	
	public function Logout(){
		$logout = array(
			'ip_logout' 	=> $this->getIPAddress(),
		);
		$where = array(
			'id_peneliti_user' => $this->session->userdata('id_peneliti_user'),
		);
		if ($this->Tbl_peneliti_users->update($where,$logout)) {
			$this->session->sess_destroy();
			redirect('Login');	
		}else{
			$this->session->set_flashdata('message','Terjadi kesalahan dalam proses logout');
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
