<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Proposal extends CI_Controller {
	
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
	
    public function index(){
        $search = array(
            'status_proposal' => "1",
        );
        $tbProposal = $this->Tbl_proposal->whereAnd($search)->result();

        $data = array(
            'tbProposal' => $tbProposal,
        );
    	$this->load->view('admin/proposal/read', $data);
    }

    public function Detail($id){
        $search = array(
            'id_proposal' => $id,
        );
        $tbProposal = $this->Tbl_proposal->whereAnd($search)->row();
        $tbProposalAnggaran = $this->Tbl_proposal_anggaran->whereAnd(array('id_proposal'=>$tbProposal->id_proposal))->row();
        $tbProposalBerkas = $this->Tbl_proposal_berkas->whereAnd(array('id_proposal'=>$tbProposal->id_proposal))->row();
        $tbProposalContent = $this->Tbl_proposal_content->whereAnd(array('id_proposal'=>$tbProposal->id_proposal))->row();
        $tbProposalPeneliti = $this->Tbl_proposal_peneliti->whereAnd(array('id_proposal'=>$tbProposal->id_proposal))->result();
        $tbProposalKluster = $this->Tbl_master_kluster->whereAnd(array('id_kluster'=>$tbProposal->id_kluster))->row();
        $tbProposalBidangIlmu = $this->Tbl_master_bidang_ilmu->whereAnd(array('id_bidang_ilmu'=>$tbProposal->id_bidang_ilmu))->row();

        $tbMSatker = $this->Tbl_master_satker->read()->result();        
        $tbMFungsional = $this->Tbl_master_fungsional->read()->result();
        $tbMPangkat = $this->Tbl_master_pangkat->read()->result();
        $tbMJabatanFungsional = $this->Tbl_master_jabatan_fungsional->read()->result();
        $tbMBidangIlmu = $this->Tbl_master_bidang_ilmu->read()->result();

        $data = array(
            'tbProposal' => $tbProposal,
            'tbProposalContent' => $tbProposalContent,
            'tbProposalBerkas' => $tbProposalBerkas,
            'tbProposalAnggaran' => $tbProposalAnggaran,
            'tbProposalPeneliti' => $tbProposalPeneliti,
            'tbProposalKluster' => $tbProposalKluster,
            'tbProposalBidangIlmu' => $tbProposalBidangIlmu,
            'tbMSatker'  => $tbMSatker,
            'tbMFungsional'  => $tbMFungsional,
            'tbMPangkat'  => $tbMPangkat,
            'tbMJabatanFungsional'  => $tbMJabatanFungsional,
            'tbMBidangIlmu'  => $tbMBidangIlmu,
        );
        $this->load->view('admin/proposal/detail', $data);
    }

    public function Diterima(){
        $search = array(
            'status_proposal' => "2",
        );
        $tbProposal = $this->Tbl_proposal->whereAnd($search)->result();

        $data = array(
            'tbProposal' => $tbProposal,
        );
        $this->load->view('admin/proposal/diterima', $data);
    }

    public function Terima($id){
        $search = array(
            'id_proposal' => $id,
        );
        $tbProposal = $this->Tbl_proposal->whereAnd($search)->row();
        $tbProposalContent = $this->Tbl_proposal_content->whereAnd(array('id_proposal'=>$tbProposal->id_proposal))->row();
        $tbProposalKluster = $this->Tbl_master_kluster->whereAnd(array('id_kluster'=>$tbProposal->id_kluster))->row();
        $tbProposalBidangIlmu = $this->Tbl_master_bidang_ilmu->whereAnd(array('id_bidang_ilmu'=>$tbProposal->id_bidang_ilmu))->row();

        $data = array(
            'tbProposal' => $tbProposal,
            'tbProposalContent' => $tbProposalContent,
            'tbProposalKluster' => $tbProposalKluster,
            'tbProposalBidangIlmu' => $tbProposalBidangIlmu,
        );
        $this->load->view('admin/proposal/terima_form', $data);
    }

    public function ActTerima($id){
        $this->load->library('upload');
        $filePath = './uploads';
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'pdf|PDF';
        $config['overwrite']    = TRUE;
        $config['file_name'] = 'SK_'.$this->input->post('id_proposal').'.pdf';
        $this->upload->initialize($config);

        if($this->upload->do_upload('sk')){
            $file1 = $this->upload->data();
            $namafile1 = $file1['file_name'];

            $data = array(
                'status_proposal' => "2",
            );
            $data2 = array(
                'id_proposal_pengumuman' => time().rand(100,400),
                'id_proposal' => $id,
                'tahun' => date('Y'),
                'id_kluster' => $this->input->post('id_kluster'),
                'keterangan' => $this->input->post('keterangan'),
                'sk' => $namafile1,
                'date_created'     => date('Y-m-d H:i:s'),
                'date_updated'     => date('Y-m-d H:i:s'),
                'user_created'     => $this->session->userdata('id_users'),
                'user_updated'     => $this->session->userdata('id_users'),
            );
            $where = array(
                'id_proposal' => $id,
            );

            if($this->Tbl_proposal_pengumuman->create($data2)){
                if ($this->Tbl_proposal->update($where,$data)) {
                    $this->session->set_flashdata('message','Berhasil.');
                    $this->session->set_flashdata('type_message','success');
                    redirect('Admin/Proposal/');
                }else{
                    $this->session->set_flashdata('message','Terjadi kesalahan.');
                    $this->session->set_flashdata('type_message','danger');
                    redirect('Admin/Proposal/');
                }
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Admin/Proposal/');
            }
        }else{
            echo $this->upload->display_errors();
        }
    }
}
