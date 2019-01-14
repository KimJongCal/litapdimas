<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Controller {

	public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('logged') == FALSE) {
            redirect('Auth');
        }
        if ($this->session->userdata('level') >= 2) {
            $this->session->set_flashdata('message','Hak akses ditolak.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Auth');
        }
        $this->load->model('Tbl_users');
    }

	public function index(){
		$tbMasterUsers = $this->Tbl_users->read()->result();
		$data = array(
			'tbMasterUsers' => $tbMasterUsers, 
		);
		$this->load->view('admin/users/read',$data);
	}

	public function Tambah(){
		$this->load->view('admin/users/form');
	}

	public function Add(){
		$rules[] = array('field' => 'username',	'label' => 'Username',  'rules' => 'required');
		$rules[] = array('field' => 'password',	'label' => 'Password',  'rules' => 'required');
		$rules[] = array('field' => 'nama',     'label' => 'Nama',      'rules' => 'required');
		$rules[] = array('field' => 'level',	'label' => 'Level',     'rules' => 'required');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message',validation_errors());
			$this->session->set_flashdata('type_message','danger');
			redirect('Admin/Users/');
		}else{
			$data = array(
				'id_users'	=> time().rand(100,900),
				'username'	=> $this->input->post('username'),
				'password'	=> md5(md5($this->input->post('password'))),
				'nama'		=> strtoupper($this->input->post('nama')),
				'level'		=> $this->input->post('level'),
	            'user_created'    => $getIPAddress(),
	            'user_updated'    => $getIPAddress(),
			);
			if ($this->Tbl_users->create($data)) {
				$this->session->set_flashdata('message','Data berhasil disimpan.');
            	$this->session->set_flashdata('type_message','success');
            	redirect('Admin/Users/');
			}else{
				$this->session->set_flashdata('message','Terjadi kesalahan dalam tambah data.');
            	$this->session->set_flashdata('type_message','danger');
            	redirect('Admin/Users/');
			}
		}
	}

	public function Edit($id){
		$tbMasterUsers = $this->Tbl_users->whereAnd(array('id_user' => $id))->row();
		$data = array(
			'tbMasterUsers' => $tbMasterUsers, 
		);
		$this->load->view('admin/users/form_edit',$data);
	}

	public function Update($id){
        $rules[] = array('field' => 'username',	'label' => 'Username',  'rules' => 'required');
        $rules[] = array('field' => 'nama',     'label' => 'Nama',      'rules' => 'required');
        $rules[] = array('field' => 'level',	'label' => 'Level',     'rules' => 'required');
		$this->form_validation->set_rules($rules);
		if ($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('message',validation_errors());
			$this->session->set_flashdata('type_message','danger');
			redirect('Admin/Users/');
		}else{
			if (!empty($this->input->post('password'))) {
				$data = array(
                    'username'	=> $this->input->post('username'),
                    'password'	=> md5(md5($this->input->post('password'))),
                    'nama'		=> strtoupper($this->input->post('nama')),
                    'level'		=> $this->input->post('level'),
	            	'user_updated'    => $getIPAddress(),
                );
			}else{
				$data = array(
                    'username'	=> $this->input->post('username'),
                    'nama'		=> strtoupper($this->input->post('nama')),
                    'level'		=> $this->input->post('level'),
	            	'user_updated'    => $getIPAddress(),
                );
			}
			if ($this->Tbl_users->update($id,$data)) {
				$this->session->set_flashdata('message','Data berhasil diubah.');
            	$this->session->set_flashdata('type_message','success');
            	redirect('Admin/Users/');
			}else{
				$this->session->set_flashdata('message','Terjadi kesalahan dalam edit data.');
            	$this->session->set_flashdata('type_message','danger');
            	redirect('Admin/Users/');
			}
		}
	}

	public function Delete($id){
		$where = array(
			'id_user' => $id,
		);
		if ($this->Tbl_users->delete($where)) {
			$this->session->set_flashdata('message','Data berhasil dihapus.');
            $this->session->set_flashdata('type_message','success');
            redirect('Admin/Master/Users');
		}else{
			$this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data user');
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Users');
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
