<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Statistik extends CI_Controller {
	
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
        $this->load->model('Peneliti/Tbl_proposal_pengumuman');
        $this->load->model('Peneliti/Tbl_peneliti');
        $this->load->model('Peneliti/Tbl_peneliti_berkas');
        $this->load->model('Peneliti/Tbl_peneliti_buku');
        $this->load->model('Peneliti/Tbl_peneliti_jurnal');
        $this->load->model('Peneliti/Tbl_peneliti_pendidikan');
        $this->load->model('Peneliti/Tbl_peneliti_users');
    }
	
    public function Proposal(){
        $tbMKluster = $this->Tbl_master_kluster->read()->result();
        foreach ($tbMKluster as $value){
            $kluster[$value->id_kluster] = $this->Tbl_proposal->whereAnd(array("id_kluster" => $value->id_kluster))->num_rows();
        }

        $tbMBidangIlmu = $this->Tbl_master_bidang_ilmu->read()->result();
        foreach ($tbMBidangIlmu as $value){
            $bidang_ilmu[$value->id_bidang_ilmu] = $this->Tbl_proposal->whereAnd(array("id_bidang_ilmu" => $value->id_bidang_ilmu))->num_rows();
        }

        $data = array(
            'num_proposal'         => $this->Tbl_proposal->read()->num_rows(),
            'num_proposal_0'      => $this->Tbl_proposal->whereAnd(array('status_proposal' => '0'))->num_rows(),
            'num_proposal_1'      => $this->Tbl_proposal->whereAnd(array('status_proposal' => '1'))->num_rows(),
            'num_proposal_2'      => $this->Tbl_proposal->whereAnd(array('status_proposal' => '2'))->num_rows(),

            'tbMBidangIlmu'   => $tbMBidangIlmu,
            'bidang_ilmu'      => $bidang_ilmu,

            'tbMKluster'   => $tbMKluster,
            'kluster'      => $kluster,
        );

    	$this->load->view('admin/statistik/proposal', $data);
    }

    public function Peneliti(){
        $data = array(
            'num_peneliti'         => $this->Tbl_peneliti_users->read()->num_rows(),
            'num_peneliti_sudah'      => $this->Tbl_peneliti_users->whereAnd(array('status_aktivasi' => '1'))->num_rows(),
            'num_peneliti_belum'      => $this->Tbl_peneliti_users->whereAnd(array('status_aktivasi' => '0'))->num_rows(),
        );
        $this->load->view('admin/statistik/peneliti', $data);
    }
}