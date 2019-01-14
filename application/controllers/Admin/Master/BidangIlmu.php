<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BidangIlmu extends CI_Controller {
	
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
        $this->load->model('Master/Tbl_master_bidang_ilmu');
    }
	
    public function index(){
        $tbMasterBidangIlmu = $this->Tbl_master_bidang_ilmu->read()->result();
        $data = array(
            'tbMasterBidangIlmu' => $tbMasterBidangIlmu, 
        );
        $this->load->view('admin/master/bidang_ilmu/read',$data);
    }

    public function Tambah(){
        $this->load->view('admin/master/bidang_ilmu/form');
    }

    public function Add(){
        $rules[] = array('field' => 'bidang_ilmu', 'label' => 'Bidang Ilmu',  'rules' => 'required');
        $rules[] = array('field' => 'status', 'label' => 'Status',  'rules' => 'required');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message',validation_errors());
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/BidangIlmu/');
        }else{
            $data = array(
                'id_bidang_ilmu'  => time().rand(100,900),
                'bidang_ilmu'  => strtoupper($this->input->post('bidang_ilmu')),
                'status'      => $this->input->post('status'),
                'date_created'     => date('Y-m-d H:i:s'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_created'     => $this->session->userdata('id_users'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            if ($this->Tbl_master_bidang_ilmu->create($data)) {
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Admin/Master/BidangIlmu/');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam tambah data.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Master/BidangIlmu/');
            }
        }
    }

    public function Edit($id){
        $tbMasterBidangIlmu = $this->Tbl_master_bidang_ilmu->whereAnd(array('no' => $id))->row();
        $data = array(
            'tbMasterBidangIlmu' => $tbMasterBidangIlmu, 
        );
        $this->load->view('admin/master/bidang_ilmu/form_edit',$data);
    }

    public function Update($id){
        $rules[] = array('field' => 'bidang_ilmu', 'label' => 'Bidang Ilmu',  'rules' => 'required');
        $rules[] = array('field' => 'status', 'label' => 'Status',  'rules' => 'required');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message',validation_errors());
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/BidangIlmu/');
        }else{
            $data = array(
                'id_bidang_ilmu'  => $this->input->post('id_bidang_ilmu'),
                'bidang_ilmu'  => strtoupper($this->input->post('bidang_ilmu')),
                'status'      => $this->input->post('status'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            if ($this->Tbl_master_bidang_ilmu->update($id,$data)) {
                $this->session->set_flashdata('message','Data berhasil diubah.');
                $this->session->set_flashdata('type_message','success');
                redirect('Admin/Master/BidangIlmu/');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam edit data.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Master/BidangIlmu/');
            }
        }
    }

    public function Delete($id){
        if ($this->Tbl_master_bidang_ilmu->delete($id)) {
            $this->session->set_flashdata('message','Data berhasil dihapus.');
            $this->session->set_flashdata('type_message','success');
            redirect('Admin/Master/BidangIlmu');
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data user');
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/BidangIlmu');
        }
    }
}
