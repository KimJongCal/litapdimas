<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class JabatanFungsional extends CI_Controller {
	
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
        $this->load->model('Master/Tbl_master_jabatan_fungsional');
    }
	
    public function index(){
        $tbMasterJabatanFungsional = $this->Tbl_master_jabatan_fungsional->read()->result();
        $data = array(
            'tbMasterJabatanFungsional' => $tbMasterJabatanFungsional, 
        );
        $this->load->view('admin/master/jabatan_fungsional/read',$data);
    }

    public function Tambah(){
        $this->load->view('admin/master/jabatan_fungsional/form');
    }

    public function Add(){
        $rules[] = array('field' => 'jab_fungsional', 'label' => 'Jabatan Fungsional',  'rules' => 'required');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message',validation_errors());
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/JabatanFungsional/');
        }else{
            $year = date('Y');
            $data = array(
                'id_jab_fungsional'  => time().rand(100,900),
                'jab_fungsional'  => strtoupper($this->input->post('jab_fungsional')),
                'status'      => $this->input->post('status'),
                'date_created'     => date('Y-m-d H:i:s'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_created'     => $this->session->userdata('id_users'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            if ($this->Tbl_master_jabatan_fungsional->create($data)) {
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Admin/Master/JabatanFungsional/');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam tambah data.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Master/JabatanFungsional/');
            }
        }
    }

    public function Edit($id){
        $tbMasterJabatanFungsional = $this->Tbl_master_jabatan_fungsional->whereAnd(array('id_jab_fungsional' => $id))->row();
        $data = array(
            'tbMasterJabatanFungsional' => $tbMasterJabatanFungsional, 
        );
        $this->load->view('admin/master/jabatan_fungsional/form_edit',$data);
    }

    public function Update($id){
        $rules[] = array('field' => 'jab_fungsional', 'label' => 'JabatanFungsional',  'rules' => 'required');
        $rules[] = array('field' => 'status', 'label' => 'Status',  'rules' => 'required');
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('message',validation_errors());
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/JabatanFungsional/');
        }else{
            $data = array(
                'id_jab_fungsional'  => $this->input->post('id_jab_fungsional'),
                'jab_fungsional'  => strtoupper($this->input->post('jab_fungsional')),
                'status'      => $this->input->post('status'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            $where = array(
                'id_jab_fungsional' => $id,
            );
            if ($this->Tbl_master_jabatan_fungsional->update($where,$data)) {
                $this->session->set_flashdata('message','Data berhasil diubah.');
                $this->session->set_flashdata('type_message','success');
                redirect('Admin/Master/JabatanFungsional/');
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam edit data.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Master/JabatanFungsional/');
            }
        }
    }

    public function Delete($id){
        $where = array(
            'id_jab_fungsional' => $id,
        );
        if ($this->Tbl_master_jabatan_fungsional->delete($where)) {
            $this->session->set_flashdata('message','Data berhasil dihapus.');
            $this->session->set_flashdata('type_message','success');
            redirect('Admin/Master/JabatanFungsional');
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data user');
            $this->session->set_flashdata('type_message','danger');
            redirect('Admin/Master/JabatanFungsional');
        }
    }
}
