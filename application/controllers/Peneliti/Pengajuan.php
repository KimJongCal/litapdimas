<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pengajuan extends CI_Controller {
	
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
        $this->load->model('Peneliti/Tbl_proposal');
        $this->load->model('Peneliti/Tbl_proposal_content');
        $this->load->model('Peneliti/Tbl_proposal_peneliti');
        $this->load->model('Peneliti/Tbl_proposal_anggaran');
        $this->load->model('Peneliti/Tbl_proposal_berkas');
        $this->load->model('Peneliti/Tbl_peneliti');
    }
	
    public function index(){
        $search = array(
            'a.id_peneliti' => $this->session->userdata('id_peneliti'),
        );
        $tbProposal = $this->Tbl_proposal->whereAndJoinProposal($search)->result();
        $data = array(
            'tbProposal' => $tbProposal,
        );
    	$this->load->view('peneliti/pengajuan/read', $data);
    }

    /*public function index(){
        $search = array(
            'id_peneliti' => $this->session->userdata('id_peneliti'),
        );
        $tbProposal = $this->Tbl_proposal->whereAnd($search)->result();

        foreach ($tbProposal as $value) {
            $tbProposalContent = $this->Tbl_proposal_content->whereAnd(array('id_proposal' => $tbProposal->id_proposal))->row();
            $tbProposalPeneliti = $this->Tbl_proposal_peneli->whereAnd(array('id_proposal' => $tbProposal->id_proposal))->row();
            $tbProposalAnggaran = $this->Tbl_proposal_anggaran->whereAnd(array('id_proposal' => $tbProposal->id_proposal))->row();
            $tbProposalBerkas = $this->Tbl_proposal_berkas->whereAnd(array('id_proposal' => $tbProposal->id_proposal))->row();
            
            $data = array(
                'tbProposal' => $tbProposal,
                'tbProposalContent' => $tbProposal,
                'tbProposalPeneliti' => $tbProposal,
                'tbProposalAnggaran' => $tbProposal,
                'tbProposalBerkas' => $tbProposal,
            );
        }
        $this->load->view('peneliti/pengajuan/read', $data);
    }*/

    public function TambahRegistrasi(){
        $tbMKluster = $this->Tbl_master_kluster->read()->result();
        $tbMBidangIlmu = $this->Tbl_master_bidang_ilmu->read()->result();
        $data = array(
            'tbMKluster' => $tbMKluster,
            'tbMBidangIlmu' => $tbMBidangIlmu,
        );
        $this->load->view('peneliti/pengajuan/registrasi_form', $data);
    }

    public function AddRegistrasi(){
        $data = array(
            'id_proposal'   => time().rand(1000,1100),
            'id_kluster'    => $this->input->post('kluster'),
            'id_bidang_ilmu'    => $this->input->post('bidang_ilmu'),
            'id_peneliti'   => $this->session->userdata('id_peneliti'),
            'status_proposal'   => "0",
            'date_created'    => date('Y-m-d H:i:s'),
            'date_updated'    => date('Y-m-d H:i:s'),
            'ip_created'    => $this->getIPAddress(),
            'ip_updated'    => $this->getIPAddress(),
        );
        $data2 = array(
            'id_proposal_content' => time().rand(1300,1400),
            'id_proposal' => $data['id_proposal'],
            'date_created'    => date('Y-m-d H:i:s'),
            'date_updated'    => date('Y-m-d H:i:s'),
            'ip_created'    => $this->getIPAddress(),
            'ip_updated'    => $this->getIPAddress(),
        );
        $data4 = array(
            'id_proposal_anggaran' => time().rand(1100,1200),
            'id_proposal' => $data['id_proposal'],
            'date_created'    => date('Y-m-d H:i:s'),
            'date_updated'    => date('Y-m-d H:i:s'),
            'ip_created'    => $this->getIPAddress(),
            'ip_updated'    => $this->getIPAddress(),
        );
        $data5 = array(
            'id_proposal_berkas' => time().rand(1200,1300),
            'id_proposal' => $data['id_proposal'],
            'date_created'    => date('Y-m-d H:i:s'),
            'date_updated'    => date('Y-m-d H:i:s'),
            'ip_created'    => $this->getIPAddress(),
            'ip_updated'    => $this->getIPAddress(),
        );
        if ($this->Tbl_proposal->create($data)) {
            if($this->Tbl_proposal_content->create($data2)){
                if($this->Tbl_proposal_anggaran->create($data4)){
                    if($this->Tbl_proposal_berkas->create($data5)){
                        $this->session->set_flashdata('message','Data berhasil disimpan.');
                        $this->session->set_flashdata('type_message','success');
                        redirect('Peneliti/Pengajuan/EditIsi/'.$data['id_proposal']);
                    }else{
                        $this->session->set_flashdata('message','Terjadi kesalahan dalam tambah data berkas.');
                        $this->session->set_flashdata('type_message','danger');
                        redirect('Peneliti/Pengajuan');
                    }
                }else{
                    $this->session->set_flashdata('message','Terjadi kesalahan dalam tambah data anggaran.');
                    $this->session->set_flashdata('type_message','danger');
                    redirect('Peneliti/Pengajuan');
                }
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam tambah data isi.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Peneliti/Pengajuan');
            }
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam tambah data.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan');
        }
    }

    public function EditRegistrasi($id){
        $search = array(
            'id_proposal' => $id,
        );
        $tbProposal = $this->Tbl_proposal->whereAnd($search)->row();
        $tbMKluster = $this->Tbl_master_kluster->read()->result();
        $tbMBidangIlmu = $this->Tbl_master_bidang_ilmu->read()->result();
        $data = array(
            'tbMKluster' => $tbMKluster,
            'tbMBidangIlmu' => $tbMBidangIlmu,
            'tbProposal' => $tbProposal,
        );
        $this->load->view('peneliti/pengajuan/registrasi2_form', $data);
    }

    public function HapusRegistrasi($id){
        $where = array(
            'id_proposal' => $id,
        );
        if ($this->Tbl_proposal_anggaran->delete($where)) {
            if($this->Tbl_proposal_berkas->delete($where)){
                if($this->Tbl_proposal_content->delete($where)){
                    if($this->Tbl_proposal_peneliti->delete($where)){
                        if($this->Tbl_proposal->delete($where)){
                            $this->session->set_flashdata('message','Data berhasil dihapus.');
                            $this->session->set_flashdata('type_message','success');
                            redirect('Peneliti/Pengajuan/');
                        }else{
                            $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data proposal');
                            $this->session->set_flashdata('type_message','danger');
                            redirect('Peneliti/Pengajuan/');
                        }
                    }else{
                        $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data proposal peneliti');
                        $this->session->set_flashdata('type_message','danger');
                        redirect('Peneliti/Pengajuan/');
                    }
                }else{
                    $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data proposal isi');
                    $this->session->set_flashdata('type_message','danger');
                    redirect('Peneliti/Pengajuan/');
                }
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data proposal berkas');
                $this->session->set_flashdata('type_message','danger');
                redirect('Peneliti/Pengajuan/');
            }
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data proposal anggaran');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/');
        }
    }

    public function EditIsi($id){
        $search = array(
            'id_proposal' => $id,
        );
        $tbProposalContent = $this->Tbl_proposal_content->whereAnd($search)->row();
        $data = array(
            'tbProposalContent' => $tbProposalContent,
        );
        $this->load->view('peneliti/pengajuan/isi_form', $data);
    }

    public function EditPenelitiAnggaran($id){
        $search = array(
            'id_proposal' => $id,
        );
        $tbProposalPeneliti = $this->Tbl_proposal_peneliti->whereAndJoin($search)->result();
        $tbProposalAnggaran = $this->Tbl_proposal_anggaran->whereAnd($search)->row();
        $tbPeneliti = $this->Tbl_peneliti->Join()->result();
        $data = array(
            'tbProposalPeneliti' => $tbProposalPeneliti,
            'tbProposalAnggaran' => $tbProposalAnggaran,
            'tbPeneliti' => $tbPeneliti,
        );
        $this->load->view('peneliti/pengajuan/peneliti_anggaran_form', $data);
    }

    public function EditBerkas($id){
        $search = array(
            'id_proposal' => $id,
        );
        $tbProposalBerkas = $this->Tbl_proposal_berkas->whereAnd($search)->row();
        $data = array(
            'tbProposalBerkas' => $tbProposalBerkas,
        );
        $this->load->view('peneliti/pengajuan/berkas_form', $data);
    }

    public function TambahPeneliti(){
        $search = array(
            'id_proposal' => $this->input->post('id_proposal'),
            'a.id_peneliti' => $this->input->post('peneliti'),
        );
        $num_row = $this->Tbl_proposal_peneliti->whereAndJoin($search)->num_rows();

        if($num_row == 0){
            $num_rows_peneliti = $this->Tbl_proposal_peneliti->whereAnd(array('id_proposal'=>$search['id_proposal'], 'jabatan' => "KETUA"))->num_rows();
            if($num_rows_peneliti == 0){
                $data = array(
                    'id_proposal_peneliti' => time().rand(1400,1500),
                    'id_proposal'          => $this->input->post('id_proposal'),
                    'jabatan'               => "KETUA",
                    'id_peneliti' => $this->input->post('peneliti'),
                    'date_created'    => date('Y-m-d H:i:s'),
                    'date_updated'    => date('Y-m-d H:i:s'),
                    'ip_created'    => $this->getIPAddress(),
                    'ip_updated'    => $this->getIPAddress(),
                );
                if($this->Tbl_proposal_peneliti->create($data)){
                    $this->session->set_flashdata('message','Peneliti berhasil ditambah.');
                    $this->session->set_flashdata('type_message','success');
                    redirect('Peneliti/Pengajuan/EditPenelitiAnggaran/'.$this->input->post('id_proposal'));
                }else{
                    $this->session->set_flashdata('message','Peneliti gagal ditambah.');
                    $this->session->set_flashdata('type_message','danger');
                    redirect('Peneliti/Pengajuan/EditPenelitiAnggaran/'.$this->input->post('id_proposal'));
                }
            }else{
                $data = array(
                    'id_proposal_peneliti' => time().rand(1400,1500),
                    'id_proposal'          => $this->input->post('id_proposal'),
                    'jabatan'               => "ANGGOTA",
                    'id_peneliti' => $this->input->post('peneliti'),
                    'date_created'    => date('Y-m-d H:i:s'),
                    'date_updated'    => date('Y-m-d H:i:s'),
                    'ip_created'    => $this->getIPAddress(),
                    'ip_updated'    => $this->getIPAddress(),
                );
                if($this->Tbl_proposal_peneliti->create($data)){
                    $this->session->set_flashdata('message','Peneliti berhasil ditambah.');
                    $this->session->set_flashdata('type_message','success');
                    redirect('Peneliti/Pengajuan/EditPenelitiAnggaran/'.$this->input->post('id_proposal'));
                }else{
                    $this->session->set_flashdata('message','Peneliti gagal ditambah.');
                    $this->session->set_flashdata('type_message','danger');
                    redirect('Peneliti/Pengajuan/EditPenelitiAnggaran/'.$this->input->post('id_proposal'));
                }
            }
        }else{
            $this->session->set_flashdata('message','Data peneliti sudah ada.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditPenelitiAnggaran/'.$this->input->post('id_proposal'));
        }
    }

    public function HapusPeneliti($id_proposal_peneliti, $id_proposal){
        $where = array(
            'id_proposal_peneliti' => $id_proposal_peneliti,
        );
        if ($this->Tbl_proposal_peneliti->delete($where)) {
            $this->session->set_flashdata('message','Data berhasil dihapus.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Pengajuan/EditPenelitiAnggaran/'.$id_proposal);
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data user');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditPenelitiAnggaran/'.$id_proposal);
        }
    }

    public function UpdateRegistrasi($id){
        $data = array(
            'id_kluster'    => $this->input->post('kluster'),
            'id_bidang_ilmu'    => $this->input->post('bidang_ilmu'),
            'date_updated'    => date('Y-m-d H:i:s'),
            'ip_updated'    => $this->getIPAddress(),
        );
        $where = array(
            'id_proposal' => $this->input->post('id'),
        );
        if($this->Tbl_proposal->update($where, $data)){
            $this->session->set_flashdata('message','Data berhasil disimpan.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Pengajuan/EditIsi/'.$id);
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam ubah data judul.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditIsi/'.$id);
        }
    }

    public function UpdateBerkasCover($id){
        $this->load->library('upload');
        $filePath = './uploads';
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'pdf|PDF';
        $config['overwrite']    = TRUE;
        $config['file_name'] = 'cover_'.$this->session->userdata('id_peneliti').$id.'.pdf';
        $this->upload->initialize($config);

        if($this->upload->do_upload('cover')){
            $file1 = $this->upload->data();
            $namafile1 = $file1['file_name'];

            $data = array(
                'cover_proposal' => $namafile1,
            );
            $where = array(
                'id_proposal' => $id,
            );
            if($this->Tbl_proposal_berkas->update($where, $data)){
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam simpan berkas cover');
                $this->session->set_flashdata('type_message','danger');
                redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
            }
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam upload berkas cover');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
        }
    }

    public function UpdateBerkasIsi($id){
        $this->load->library('upload');
        $filePath = './uploads';
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'pdf|PDF';
        $config['overwrite']    = TRUE;
        $config['file_name'] = 'isi_'.$this->session->userdata('id_peneliti').$id.'.pdf';
        $this->upload->initialize($config);

        if($this->upload->do_upload('isi')){
            $file1 = $this->upload->data();
            $namafile1 = $file1['file_name'];

            $data = array(
                'content_proposal' => $namafile1,
            );
            $where = array(
                'id_proposal' => $id,
            );
            if($this->Tbl_proposal_berkas->update($where, $data)){
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam simpan berkas content isi');
                $this->session->set_flashdata('type_message','danger');
                redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
            }
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam upload berkas isi');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
        }
    }

    public function UpdateBerkasAnggaran($id){
        $this->load->library('upload');
        $filePath = './uploads';
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'pdf|PDF';
        $config['overwrite']    = TRUE;
        $config['file_name'] = 'anggaran_'.$this->session->userdata('id_peneliti').$id.'.pdf';
        $this->upload->initialize($config);

        if($this->upload->do_upload('anggaran_biaya')){
            $file1 = $this->upload->data();
            $namafile1 = $file1['file_name'];

            $data = array(
                'anggaran_biaya_proposal' => $namafile1,
            );
            $where = array(
                'id_proposal' => $id,
            );
            if($this->Tbl_proposal_berkas->update($where, $data)){
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam simpan berkas anggaran');
                $this->session->set_flashdata('type_message','danger');
                redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
            }
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam upload berkas anggaran');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
        }
    }

    public function UpdateBerkas($id){
        $this->load->library('upload');
        $filePath = './uploads';
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'pdf|PDF';
        $config['overwrite']    = TRUE;
        $config['file_name'] = 'cover_'.$this->session->userdata('id_peneliti').$id.'.pdf';
        $this->upload->initialize($config);

        // script upload file pertama
        if($this->upload->do_upload('cover')){
            $file1 = $this->upload->data();
            $namafile1 = $file1['file_name'];

            $config['file_name'] = 'isi_'.$this->session->userdata('id_peneliti').$id.'.pdf';
                $this->upload->initialize($config);
            if($this->upload->do_upload('isi')){
                
                $file2 = $this->upload->data();
                $namafile2 = $file2['file_name'];

                $config['file_name'] = 'anggaran_'.$this->session->userdata('id_peneliti').$id.'.pdf';
                    $this->upload->initialize($config);
                if($this->upload->do_upload('anggaran_biaya')){
                    
                    $file3 = $this->upload->data();
                    $namafile3 = $file3['file_name'];
                    $data = array(
                        'cover_proposal' => $namafile1,
                        'content_proposal' => $namafile2,
                        'anggaran_biaya_proposal' => $namafile3,
                        'date_created'    => date('Y-m-d H:i:s'),
                        'date_updated'    => date('Y-m-d H:i:s'),
                        'ip_created'    => $this->getIPAddress(),
                        'ip_updated'    => $this->getIPAddress(),
                    );
                    $where = array(
                        'id_proposal' => $id,
                    );
                    if($this->Tbl_proposal_berkas->update($where, $data)){
                        $this->session->set_flashdata('message','Data berhasil disimpan.');
                        $this->session->set_flashdata('type_message','success');
                        redirect('Peneliti/Pengajuan/');
                    }else{
                        $this->session->set_flashdata('message','Data gagal disimpan.');
                        $this->session->set_flashdata('type_message','danger');
                        redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
                    }
                }else{
                    $this->session->set_flashdata('message','Terjadi kesalahan dalam upload berkas anggaran');
                    $this->session->set_flashdata('type_message','danger');
                    redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
                }
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam upload berkas isi');
                $this->session->set_flashdata('type_message','danger');
                redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
            }
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam upload berkas cover');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
        }
    }

    public function UpdateAnggaran($id){
        if(!empty($this->input->post('ipteks'))){
            $ipteks = "1";
        }else{
            $ipteks = "0";
        }

        if(!empty($this->input->post('hki'))){
            $hki = "1";
        }else{
            $hki = "0";
        }

        if(!empty($this->input->post('bahan_ajar'))){
            $bahan_ajar = "1";
        }else{
            $bahan_ajar = "0";
        }

        if(!empty($this->input->post('teknologi_tg'))){
            $teknologi_tg = "1";
        }else{
            $teknologi_tg = "0";
        }

        if(!empty($this->input->post('lap_penelitian'))){
            $lap_penelitian = "1";
        }else{
            $lap_penelitian = "0";
        }

        if(!empty($this->input->post('jurnal'))){
            $jurnal = "1";
        }else{
            $jurnal = "0";
        }

        $data = array(
            'anggaran' => $this->input->post('anggaran'),
            'ipteks'    => $ipteks,
            'hki'       => $hki,
            'bahan_ajar'=> $bahan_ajar,
            'teknologi_tg'=> $teknologi_tg,
            'lap_penelitian'=> $lap_penelitian,
            'jurnal'    => $jurnal,
        );

        $where = array(
            'id_proposal' => $id,
        );
        if($this->input->post('anggaran') < 0){
            $this->session->set_flashdata('message','Anggran tidak bisa kurang dari 0.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditPenelitiAnggaran/'.$id);
        }else{
            if($this->Tbl_proposal_anggaran->update($where, $data)){
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
            }else{
                $this->session->set_flashdata('message','Terjadi kesalahan dalam ubah data judul.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Peneliti/Pengajuan/EditBerkas/'.$id);
            }
        }
    }

    public function UpdateIsiJudul(){
        $data = array(
            'judul' => $this->input->post('isi'),
        );
        $where = array(
            'id_proposal' => $this->input->post('id'),
        );
        if($this->Tbl_proposal_content->update($where, $data)){
            $this->session->set_flashdata('message','Data berhasil disimpan.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam ubah data judul.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }
    }

    public function UpdateIsiLatarBelakang(){
        $data = array(
            'latar_belakang' => $this->input->post('isi'),
        );
        $where = array(
            'id_proposal' => $this->input->post('id'),
        );
        if($this->Tbl_proposal_content->update($where, $data)){
            $this->session->set_flashdata('message','Data berhasil disimpan.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam ubah data latar belakang.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }
    }

    public function UpdateIsiRumusanMasalah(){
        $data = array(
            'rumusan_masalah' => $this->input->post('isi'),
        );
        $where = array(
            'id_proposal' => $this->input->post('id'),
        );
        if($this->Tbl_proposal_content->update($where, $data)){
            $this->session->set_flashdata('message','Data berhasil disimpan.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam ubah data rumusan masalah.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }
    }

    public function UpdateIsiTujuan(){
        $data = array(
            'tujuan_penelitian' => $this->input->post('isi'),
        );
        $where = array(
            'id_proposal' => $this->input->post('id'),
        );
        if($this->Tbl_proposal_content->update($where, $data)){
            $this->session->set_flashdata('message','Data berhasil disimpan.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam ubah data tujuan penelitian.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }
    }

    public function UpdateIsiKajian(){
        $data = array(
            'kajian_penelitian' => $this->input->post('isi'),
        );
        $where = array(
            'id_proposal' => $this->input->post('id'),
        );
        if($this->Tbl_proposal_content->update($where, $data)){
            $this->session->set_flashdata('message','Data berhasil disimpan.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam ubah data kajian penelitian.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }
    }

    public function UpdateIsiKonsep(){
        $data = array(
            'konsep_teori' => $this->input->post('isi'),
        );
        $where = array(
            'id_proposal' => $this->input->post('id'),
        );
        if($this->Tbl_proposal_content->update($where, $data)){
            $this->session->set_flashdata('message','Data berhasil disimpan.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam ubah data konsep teori.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }
    }

    public function UpdateIsiMetode(){
        $data = array(
            'metode_teknik' => $this->input->post('isi'),
        );
        $where = array(
            'id_proposal' => $this->input->post('id'),
        );
        if($this->Tbl_proposal_content->update($where, $data)){
            $this->session->set_flashdata('message','Data berhasil disimpan.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam ubah data metode teknik.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }
    }

    public function UpdateIsiRencana(){
        $data = array(
            'rencana_pembahasan' => $this->input->post('isi'),
        );
        $where = array(
            'id_proposal' => $this->input->post('id'),
        );
        if($this->Tbl_proposal_content->update($where, $data)){
            $this->session->set_flashdata('message','Data berhasil disimpan.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam ubah data rencana pembahasan.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }
    }

    public function UpdateIsiPustaka(){
        $data = array(
            'pustaka_bibliografi' => $this->input->post('isi'),
        );
        $where = array(
            'id_proposal' => $this->input->post('id'),
        );
        if($this->Tbl_proposal_content->update($where, $data)){
            $this->session->set_flashdata('message','Data berhasil disimpan.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam ubah data pustaka bibliografi.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan/EditIsi/'.$this->input->post('id'));
        }
    }

    public function Ajukan($id){
        $count = 0;
        $search = array(
            'id_proposal' => $id,
        );
        $tbProposal = $this->Tbl_proposal->whereAnd($search)->row();

        if (!empty($tbProposal->id_kluster)) {        
            $count += 1;
        }

        if (!empty($tbProposal->id_bidang_ilmu)) {
            $count += 1;
        }

        if (!empty($tbProposal->id_peneliti)) {        
            $count += 1;
        }

        if ($count==3) {        
            $this->cekProposalIsi($id);
        }else{
        
            $this->session->set_flashdata('message','Kluster atau bidang ilmu belum diisi.');
            $this->session->set_flashdata('type_message','danger');        
            redirect('Peneliti/Pengajuan');        
        }
    }

    public function cekProposalIsi($id){
        $count = 0;
        $search = array(
            'id_proposal' => $id,
        );
        $tbProposal = $this->Tbl_proposal_content->whereAnd($search)->row();

        if (!empty($tbProposal->judul)) {        
            $count += 1;
        }

        if (!empty($tbProposal->latar_belakang)) {
            $count += 1;
        }

        if (!empty($tbProposal->rumusan_masalah)) {        
            $count += 1;
        }

        if (!empty($tbProposal->tujuan_penelitian)) {        
            $count += 1;
        }

        if (!empty($tbProposal->kajian_penelitian)) {        
            $count += 1;
        }

        if (!empty($tbProposal->konsep_teori)) {        
            $count += 1;
        }

        if (!empty($tbProposal->metode_teknik)) {        
            $count += 1;
        }

        if (!empty($tbProposal->rencana_pembahasan)) {        
            $count += 1;
        }

        if (!empty($tbProposal->pustaka_bibliografi)) {        
            $count += 1;
        }

        if ($count==9) {        
            $this->cekProposalPeneliti($id);
        }else{
        
            $this->session->set_flashdata('message','Peneliti atau anggaran belum lengkap atau belum diisi.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan');
        }
    }

    public function cekProposalPeneliti($id){
        $count = 0;
        $search = array(
            'id_proposal' => $id,
        );
        $tbProposal = $this->Tbl_proposal_peneliti->whereAnd($search)->num_rows();

        if ($tbProposal > 0) {        
            $this->cekProposalAnggaran($id);
        }else{
        
            $this->session->set_flashdata('message','Peneliti belum lengkap atau belum diisi.');
            $this->session->set_flashdata('type_message','danger');        
            redirect('Peneliti/Pengajuan');        
        }
    }

    public function cekProposalAnggaran($id){
        $count = 0;
        $search = array(
            'id_proposal' => $id,
        );
        $tbProposal = $this->Tbl_proposal_anggaran->whereAnd($search)->row();

        if ($tbProposal->anggaran > 0) {        
            $count += 1;
        }

        if ($count==1) {        
            $this->cekProposalBerkas($id);
        }else{
        
            $this->session->set_flashdata('message','Anggaran belum diisi.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan');
        }
    }

    public function cekProposalBerkas($id){
        $count = 0;
        $search = array(
            'id_proposal' => $id,
        );
        $tbProposal = $this->Tbl_proposal_berkas->whereAnd($search)->row();

        if (!empty($tbProposal->cover_proposal)) {        
            $count += 1;
        }

        if (!empty($tbProposal->content_proposal)) {        
            $count += 1;
        }

        if (!empty($tbProposal->anggaran_biaya_proposal)) {        
            $count += 1;
        }

        if ($count==3) {        
            $data = array(
                'status_proposal' => "1",
            );
            if($this->Tbl_proposal->update($search, $data)){
                $this->session->set_flashdata('message','Berhasil di ajukan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Peneliti/Pengajuan');
            }else{
                $this->session->set_flashdata('message','Gagal di ajukan.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Peneliti/Pengajuan');
            }
        }else{
            $this->session->set_flashdata('message','Berkas belum lengkap.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Pengajuan');
        }
    }

    public function getIPAddress(){
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
}