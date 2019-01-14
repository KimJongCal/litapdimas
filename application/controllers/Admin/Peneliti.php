<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Peneliti extends CI_Controller {
	
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
        $this->load->model('Peneliti/Tbl_peneliti');
        $this->load->model('Peneliti/Tbl_peneliti_berkas');
        $this->load->model('Peneliti/Tbl_peneliti_buku');
        $this->load->model('Peneliti/Tbl_peneliti_jurnal');
        $this->load->model('Peneliti/Tbl_peneliti_pendidikan');
        $this->load->model('Peneliti/Tbl_peneliti_users');
    }
	
    public function index(){
        $tbPeneliti = $this->Tbl_peneliti->read()->result();

        $data = array(
            'tbPeneliti' => $tbPeneliti,
        );
    	$this->load->view('admin/peneliti/read', $data);
    }

    public function Detail($id){
        $tbPeneliti = $this->Tbl_peneliti->whereAnd(array('id_peneliti'=>$id))->row();
        $tbPenelitiBerkas = $this->Tbl_peneliti_berkas->whereAnd(array('id_peneliti'=>$tbPeneliti->id_peneliti))->row();
        $tbPenelitiBuku = $this->Tbl_peneliti_buku->whereAnd(array('id_peneliti'=>$tbPeneliti->id_peneliti))->result();
        $tbPenelitiJurnal = $this->Tbl_peneliti_jurnal->whereAnd(array('id_peneliti'=>$tbPeneliti->id_peneliti))->result();
        $tbPenelitiPendidikan = $this->Tbl_peneliti_pendidikan->whereAnd(array('id_peneliti'=>$tbPeneliti->id_peneliti))->result();

        $tbPenelitiFungsional = $this->Tbl_master_fungsional->whereAnd(array('id_fungsional'=>$tbPeneliti->id_fungsional))->row();
        $tbPenelitiJabFungsional = $this->Tbl_master_jabatan_fungsional->whereAnd(array('id_jab_fungsional'=>$tbPeneliti->id_jab_fungsional))->row();
        $tbPenelitiSatker = $this->Tbl_master_satker->whereAnd(array('id_satker'=>$tbPeneliti->id_satker))->row();
        $tbPenelitiBidangIlmu = $this->Tbl_master_bidang_ilmu->whereAnd(array('id_bidang_ilmu'=>$tbPeneliti->id_bidang_ilmu))->row();
        $tbPenelitiPangkat = $this->Tbl_master_pangkat->whereAnd(array('id_pangkat'=>$tbPeneliti->id_pangkat))->row();
        $tbPenelitiUsers = $this->Tbl_peneliti_users->whereAnd(array('id_peneliti'=>$tbPeneliti->id_peneliti))->row();


        $data = array(
            'tbPeneliti' => $tbPeneliti,
            'tbPenelitiBerkas' => $tbPenelitiBerkas,
            'tbPenelitiBuku' => $tbPenelitiBuku,
            'tbPenelitiJurnal' => $tbPenelitiJurnal,
            'tbPenelitiPendidikan' => $tbPenelitiPendidikan,
            'tbPenelitiFungsional' => $tbPenelitiFungsional,
            'tbPenelitiSatker' => $tbPenelitiSatker,
            'tbPenelitiJabFungsional' => $tbPenelitiJabFungsional,
            'tbPenelitiBidangIlmu' => $tbPenelitiBidangIlmu,
            'tbPenelitiPangkat' => $tbPenelitiPangkat,
            'tbPenelitiUsers' => $tbPenelitiUsers,
        );

        $this->load->view('admin/peneliti/detail', $data);
    }

    public function EditPassword(){
        $tbPeneliti = $this->Tbl_peneliti->read()->result();

        $data = array(
            'tbPeneliti' => $tbPeneliti,
        );
        $this->load->view('admin/peneliti/password_form_edit', $data);
    }
}
