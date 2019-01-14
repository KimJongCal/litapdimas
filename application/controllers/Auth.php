<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller {
	
	public function __construct(){
        parent::__construct();
        $this->load->model('Tbl_users');
    }

	public function index(){
		$this->load->view('login');
	}

	public function actLogin(){
	    $rules[] = array('field' => 'username',	'label' => 'Username', 'rules' => 'required');
	    $rules[] = array('field' => 'password', 'label' => 'Password', 'rules' => 'required');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message',validation_errors());
			$this->session->set_flashdata('type_message','danger');
			redirect('Auth');
		}else{
			$data = array(
			    'username' => set_value('username'),
			    'password' => md5(md5(set_value('password'))),
            );
			$tblUsers	= $this->Tbl_users->whereAnd($data);
			if ($tblUsers->num_rows() > 0) {
				$tblUsers = $tblUsers->row();
				$data = array(
					'logged' 		=> TRUE, 
					'id_users'		=> $tblUsers->id_user,
					'username'		=> $tblUsers->username, 
					'nama'			=> $tblUsers->nama, 
					'level'			=> $tblUsers->level,
				);
				$this->session->set_userdata($data);
				redirect('Admin/Dashboard');
			}else{
				$this->session->set_flashdata('message','Username atau Password Salah');
				$this->session->set_flashdata('type_message','danger');
				redirect('Auth');
			}
		}
	}
	
	public function Logout(){
		$logout = array(
			'ip_logout' 	=> $this->getIPAddress(),
		);
		$where = array(
			'id_user' => $this->session->userdata('id_users'),
		);
		if ($this->Tbl_users->update($where,$logout)) {
			$this->session->sess_destroy();
			redirect('Auth');	
		}else{
			$this->session->set_flashdata('message','Terjadi kesalahan dalam proses logout');
			$this->session->set_flashdata('type_message','danger');
			redirect('Auth');
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
