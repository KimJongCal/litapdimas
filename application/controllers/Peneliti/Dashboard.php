<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends CI_Controller {
	
    public function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        if ($this->session->userdata('logged') == FALSE) {
            redirect('Login');
        }
        if ($this->session->userdata('level') <= 2) {
            $this->session->set_flashdata('message','Hak akses ditolak.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Login');
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
    	$tbPeneliti = $this->Tbl_peneliti->whereAnd(array('id_peneliti' => $this->session->userdata('id_peneliti')))->row();
        $tbPenelitiUsers = $this->Tbl_peneliti_users->whereAnd(array('id_peneliti'=>$tbPeneliti->id_peneliti))->row();
        $tbPSatker = $this->Tbl_master_satker->whereAnd(array('id_satker'=>$tbPeneliti->id_satker))->row();
        $tbPFungsional = $this->Tbl_master_fungsional->whereAnd(array('id_fungsional'=>$tbPeneliti->id_fungsional))->row();

        $tbMSatker = $this->Tbl_master_satker->read()->result();        
        $tbMFungsional = $this->Tbl_master_fungsional->read()->result();
        $tbMPangkat = $this->Tbl_master_pangkat->read()->result();
        $tbMJabatanFungsional = $this->Tbl_master_jabatan_fungsional->read()->result();
        $tbMBidangIlmu = $this->Tbl_master_bidang_ilmu->read()->result();
        $data = array(
            'num_proposal'         => $this->Tbl_proposal->read()->num_rows(),
            'num_proposal_0'      => $this->Tbl_proposal->whereAnd(array('status_proposal' => '0', 'id_peneliti' => $this->session->userdata('id_peneliti')))->num_rows(),
            'num_proposal_1'      => $this->Tbl_proposal->whereAnd(array('status_proposal' => '1', 'id_peneliti' => $this->session->userdata('id_peneliti')))->num_rows(),
            'num_proposal_2'      => $this->Tbl_proposal->whereAnd(array('status_proposal' => '2', 'id_peneliti' => $this->session->userdata('id_peneliti')))->num_rows(),

            'tbPeneliti' => $tbPeneliti,
            'tbPenelitiUsers'  => $tbPenelitiUsers,
            'tbPSatker'  => $tbPSatker,
            'tbMSatker'  => $tbMSatker,
            'tbMFungsional'  => $tbMFungsional,
            'tbMPangkat'  => $tbMPangkat,
            'tbMJabatanFungsional'  => $tbMJabatanFungsional,
            'tbMBidangIlmu'  => $tbMBidangIlmu,
        );
        $this->load->view('peneliti/dashboard', $data);
    }
}
