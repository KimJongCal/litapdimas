<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengumuman extends CI_Controller {
    
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
        $this->load->model('Peneliti/Tbl_proposal_pengumuman');
        $this->load->model('Peneliti/Tbl_peneliti');
        $this->load->model('Peneliti/Tbl_peneliti_berkas');
        $this->load->model('Peneliti/Tbl_peneliti_buku');
        $this->load->model('Peneliti/Tbl_peneliti_jurnal');
        $this->load->model('Peneliti/Tbl_peneliti_pendidikan');
        $this->load->model('Peneliti/Tbl_peneliti_users');
    }
    
    public function index(){
        $tbProposalPengumuman = $this->Tbl_proposal_pengumuman->read()->result();
        $data = array(
            'tbProposalPengumuman' => $tbProposalPengumuman,
        );
        $this->load->view('peneliti/pengumuman/read', $data);
    }
}
