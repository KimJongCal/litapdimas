<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fungsional extends CI_Controller {
	
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
        $this->load->model('Master/Tbl_master_fungsional');
    }
	
    public function index(){
        $tbMasterFungsional = $this->Tbl_master_fungsional->read()->result();
        $data = array(
            'tbMasterFungsional' => $tbMasterFungsional, 
        );
        $this->load->view('admin/master/fungsional/read',$data);
    }

    public function Tambah(){
        $this->load->view('admin/master/fungsional/form');
    }

    public function Add(){
        $rules[] = array('field' => 'fungsional', 'label' => 'Fungsional',  'rules' => 'required');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message',validation_errors());
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Fungsional/');
        }else{
            $year = date('Y');
            $data = array(
                'id_fungsional'  => time().rand(100,900),
                'fungsional'  => strtoupper($this->input->post('fungsional')),
                'status'      => $this->input->post('status'),
                'date_created'     => date('Y-m-d H:i:s'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_created'     => $this->session->userdata('id_users'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            if ($this->Tbl_master_fungsional->create($data)) {
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Admin/Master/Fungsional/');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam tambah data.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Master/Fungsional/');
            }
        }
    }

    public function Edit($id){
        $tbMasterFungsional = $this->Tbl_master_fungsional->whereAnd(array('id_fungsional' => $id))->row();
        $data = array(
            'tbMasterFungsional' => $tbMasterFungsional, 
        );
        $this->load->view('admin/master/fungsional/form_edit',$data);
    }

    public function Update($id){
        $rules[] = array('field' => 'fungsional', 'label' => 'Fungsional',  'rules' => 'required');
        $rules[] = array('field' => 'status', 'label' => 'Status',  'rules' => 'required');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message',validation_errors());
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Fungsional/');
        }else{
            $data = array(
                'id_fungsional'  => $this->input->post('id_fungsional'),
                'fungsional'  => strtoupper($this->input->post('fungsional')),
                'status'      => $this->input->post('status'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            $where = array(
                'id_fungsional' => $id,
            );
            if ($this->Tbl_master_fungsional->update($where,$data)) {
                $this->session->set_flashdata('message','Data berhasil diubah.');
                $this->session->set_flashdata('type_message','success');
                redirect('Admin/Master/Fungsional/');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam edit data.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Master/Fungsional/');
            }
        }
    }

    public function Delete($id){
        $where = array(
            'id_fungsional' => $id,
        );
        if ($this->Tbl_master_fungsional->delete($where)) {
            $this->session->set_flashdata('message','Data berhasil dihapus.');
            $this->session->set_flashdata('type_message','success');
            redirect('Admin/Master/Fungsional');
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data user');
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Fungsional');
        }
    }
}
