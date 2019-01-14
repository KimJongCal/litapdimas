<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Satker extends CI_Controller {
	
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
        $this->load->model('Master/Tbl_master_satker');
    }
	
    public function index(){
        $tbMasterSatker = $this->Tbl_master_satker->read()->result();
        $data = array(
            'tbMasterSatker' => $tbMasterSatker, 
        );
        $this->load->view('admin/master/satker/read',$data);
    }

    public function Tambah(){
        $this->load->view('admin/master/satker/form');
    }

    public function Add(){
        $rules[] = array('field' => 'satker', 'label' => 'Satker',  'rules' => 'required');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message',validation_errors());
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Satker/');
        }else{
            $year = date('Y');
            $data = array(
                'id_satker'  => time().rand(100,900),
                'satker'  => strtoupper($this->input->post('satker')),
                'status'      => $this->input->post('status'),
                'date_created'     => date('Y-m-d H:i:s'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_created'     => $this->session->userdata('id_users'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            if ($this->Tbl_master_satker->create($data)) {
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Admin/Master/Satker/');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam tambah data.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Master/Satker/');
            }
        }
    }

    public function Edit($id){
        $tbMasterSatker = $this->Tbl_master_satker->whereAnd(array('id_satker' => $id))->row();
        $data = array(
            'tbMasterSatker' => $tbMasterSatker, 
        );
        $this->load->view('admin/master/satker/form_edit',$data);
    }

    public function Update($id){
        $rules[] = array('field' => 'satker', 'label' => 'Satker',  'rules' => 'required');
        $rules[] = array('field' => 'status', 'label' => 'Status',  'rules' => 'required');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message',validation_errors());
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Satker/');
        }else{
            $data = array(
                'id_satker'  => $this->input->post('id_satker'),
                'satker'  => strtoupper($this->input->post('satker')),
                'status'      => $this->input->post('status'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            $where = array(
                'id_satker' => $id,
            );
            if ($this->Tbl_master_satker->update($where,$data)) {
                $this->session->set_flashdata('message','Data berhasil diubah.');
                $this->session->set_flashdata('type_message','success');
                redirect('Admin/Master/Satker/');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam edit data.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Master/Satker/');
            }
        }
    }

    public function Delete($id){
        $where = array(
            'id_satker' => $id,
        );
        if ($this->Tbl_master_satker->delete($where)) {
            $this->session->set_flashdata('message','Data berhasil dihapus.');
            $this->session->set_flashdata('type_message','success');
            redirect('Admin/Master/Satker');
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data user');
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/Satker');
        }
    }
}
