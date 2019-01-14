<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Kluster extends CI_Controller {
	
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
        $this->load->model('Master/Tbl_master_kluster');
    }
	
    public function index(){
        $tbMasterKluster = $this->Tbl_master_kluster->read()->result();
        $data = array(
            'tbMasterKluster' => $tbMasterKluster, 
        );
        $this->load->view('admin/master/kluster/read',$data);
    }

    public function Tambah(){
        $this->load->view('admin/master/kluster/form');
    }

    public function Add(){
        $rules[] = array('field' => 'kluster', 'label' => 'Kluster',  'rules' => 'required');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message',validation_errors());
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Kluster/');
        }else{
            $year = date('Y');
            $data = array(
                'id_kluster'  => time().rand(100,900),
                'kluster'  => strtoupper($this->input->post('kluster')),
                'tahun'  => $this->input->post('tahun'),
                'status'      => $this->input->post('status'),
                'date_created'     => date('Y-m-d H:i:s'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_created'     => $this->session->userdata('id_users'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            if ($this->Tbl_master_kluster->create($data)) {
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Admin/Master/Kluster/');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam tambah data.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Master/Kluster/');
            }
        }
    }

    public function Edit($id){
        $tbMasterKluster = $this->Tbl_master_kluster->whereAnd(array('no' => $id))->row();
        $data = array(
            'tbMasterKluster' => $tbMasterKluster, 
        );
        $this->load->view('admin/master/kluster/form_edit',$data);
    }

    public function Update($id){
        $rules[] = array('field' => 'kluster', 'label' => 'Kluster',  'rules' => 'required');
        $rules[] = array('field' => 'status', 'label' => 'Status',  'rules' => 'required');
        $rules[] = array('field' => 'tahun', 'label' => 'Tahun',  'rules' => 'required');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message',validation_errors());
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Kluster/');
        }else{
            $data = array(
                'id_kluster'  => $this->input->post('id_kluster'),
                'kluster'  => strtoupper($this->input->post('kluster')),
                'tahun'  => $this->input->post('tahun'),
                'status'      => $this->input->post('status'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            if ($this->Tbl_master_kluster->update($id,$data)) {
                $this->session->set_flashdata('message','Data berhasil diubah.');
                $this->session->set_flashdata('type_message','success');
                redirect('Admin/Master/Kluster/');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam edit data.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Master/Kluster/');
            }
        }
    }

    public function Delete($id){
        if ($this->Tbl_master_kluster->delete($id)) {
            $this->session->set_flashdata('message','Data berhasil dihapus.');
            $this->session->set_flashdata('type_message','success');
            redirect('Admin/Master/Kluster');
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data user');
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Kluster');
        }
    }
}
