<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pangkat extends CI_Controller {
	
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
        $this->load->model('Master/Tbl_master_pangkat');
    }
	
    public function index(){
        $tbMasterPangkat = $this->Tbl_master_pangkat->read()->result();
        $data = array(
            'tbMasterPangkat' => $tbMasterPangkat, 
        );
        $this->load->view('admin/master/pangkat/read',$data);
    }

    public function Tambah(){
        $this->load->view('admin/master/pangkat/form');
    }

    public function Add(){
        $rules[] = array('field' => 'pangkat', 'label' => 'Pangkat',  'rules' => 'required');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message',validation_errors());
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Pangkat/');
        }else{
            $year = date('Y');
            $data = array(
                'id_pangkat'  => time().rand(100,900),
                'pangkat_gol'  => strtoupper($this->input->post('pangkat')),
                'status'      => $this->input->post('status'),
                'date_created'     => date('Y-m-d H:i:s'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_created'     => $this->session->userdata('id_users'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            if ($this->Tbl_master_pangkat->create($data)) {
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Admin/Master/Pangkat/');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam tambah data.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Master/Pangkat/');
            }
        }
    }

    public function Edit($id){
        $tbMasterPangkat = $this->Tbl_master_pangkat->whereAnd(array('id_pangkat' => $id))->row();
        $data = array(
            'tbMasterPangkat' => $tbMasterPangkat, 
        );
        $this->load->view('admin/master/pangkat/form_edit',$data);
    }

    public function Update($id){
        $rules[] = array('field' => 'pangkat', 'label' => 'Pangkat',  'rules' => 'required');
        $rules[] = array('field' => 'status', 'label' => 'Status',  'rules' => 'required');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message',validation_errors());
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Pangkat/');
        }else{
            $data = array(
                'id_pangkat'  => $this->input->post('id_pangkat'),
                'pangkat_gol'  => strtoupper($this->input->post('pangkat')),
                'status'      => $this->input->post('status'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            $where = array(
                'id_pangkat' => $id,
            );
            if ($this->Tbl_master_pangkat->update($where,$data)) {
                $this->session->set_flashdata('message','Data berhasil diubah.');
                $this->session->set_flashdata('type_message','success');
                redirect('Admin/Master/Pangkat/');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam edit data.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Master/Pangkat/');
            }
        }
    }

    public function Delete($id){
        $where = array(
            'id_pangkat' => $id,
        );
        if ($this->Tbl_master_pangkat->delete($where)) {
            $this->session->set_flashdata('message','Data berhasil dihapus.');
            $this->session->set_flashdata('type_message','success');
            redirect('Admin/Master/Pangkat');
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data user');
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Pangkat');
        }
    }
}
