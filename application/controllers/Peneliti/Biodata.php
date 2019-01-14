<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Biodata extends CI_Controller {
	
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

    public function Datadiri(){
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
            'tbPeneliti' => $tbPeneliti,
            'tbPenelitiUsers'  => $tbPenelitiUsers,
            'tbPSatker'  => $tbPSatker,
            'tbMSatker'  => $tbMSatker,
            'tbMFungsional'  => $tbMFungsional,
            'tbMPangkat'  => $tbMPangkat,
            'tbMJabatanFungsional'  => $tbMJabatanFungsional,
            'tbMBidangIlmu'  => $tbMBidangIlmu,
        );
        $this->load->view('peneliti/biodata/data_diri_form', $data);
    }

    public function EditDatadiri($id){
        $tbPeneliti = $this->Tbl_peneliti->whereAnd(array('id_peneliti' => $id))->row();
        $tbPenelitiUsers = $this->Tbl_peneliti_users->whereAnd(array('id_peneliti'=>$tbPeneliti->id_peneliti))->row();
        $tbPSatker = $this->Tbl_master_satker->whereAnd(array('id_satker'=>$tbPeneliti->id_satker))->row();
        $tbPFungsional = $this->Tbl_master_fungsional->whereAnd(array('id_fungsional'=>$tbPeneliti->id_fungsional))->row();

        $tbMSatker = $this->Tbl_master_satker->read()->result();        
        $tbMFungsional = $this->Tbl_master_fungsional->read()->result();
        $tbMPangkat = $this->Tbl_master_pangkat->read()->result();
        $tbMJabatanFungsional = $this->Tbl_master_jabatan_fungsional->read()->result();
        $tbMBidangIlmu = $this->Tbl_master_bidang_ilmu->read()->result();
        $data = array(
            'tbPeneliti' => $tbPeneliti,
            'tbPenelitiUsers'  => $tbPenelitiUsers,
            'tbPSatker'  => $tbPSatker,
            'tbMSatker'  => $tbMSatker,
            'tbMFungsional'  => $tbMFungsional,
            'tbMPangkat'  => $tbMPangkat,
            'tbMJabatanFungsional'  => $tbMJabatanFungsional,
            'tbMBidangIlmu'  => $tbMBidangIlmu,
        );
        $this->load->view('peneliti/biodata/data_diri_form_edit', $data);
    }

    public function UpdateDatadiri(){
        $data = array(
            'id_fungsional' => $this->input->post('fungsional'),
            'nidn' => $this->input->post('nidn'),
            'nip' => $this->input->post('nip'),
            'nama' => $this->input->post('nidn'),
            'tempat' => strtoupper($this->input->post('tempat')),
            'tgl_lhr' => $this->input->post('tgl_lhr'),
            'alamat' => strtoupper($this->input->post('alamat')),
            'id_satker' => $this->input->post('satker'),
            'jabatan' => strtoupper($this->input->post('jabatan')),
            'id_pangkat' => $this->input->post('gol'),
            'id_jab_fungsional' => $this->input->post('jabfung'),
            'email' => $this->input->post('email'),
            'hp' => $this->input->post('no_hp'),
            'id_bidang_ilmu' => $this->input->post('bidang_ilmu'),
        );
        $where = array(
            'id_peneliti' => $this->input->post('id_peneliti'),
        );
        if($this->Tbl_peneliti->update($where, $data)){
            $this->session->set_flashdata('message','Data berhasil diubah.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Biodata/Datadiri/');
        }else{
            $this->session->set_flashdata('message','Data gagal diubah.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Biodata/Datadiri/');
        }
    }

    public function Pendidikan(){
        $tbPeneliti = $this->Tbl_peneliti->whereAnd(array('id_peneliti' => $this->session->userdata('id_peneliti')))->row();
        $tbPenelitiPendidikan = $this->Tbl_peneliti_pendidikan->whereAnd(array('id_peneliti'=>$tbPeneliti->id_peneliti))->result();
        $tbPSatker = $this->Tbl_master_satker->whereAnd(array('id_satker'=>$tbPeneliti->id_satker))->row();
        $tbPFungsional = $this->Tbl_master_fungsional->whereAnd(array('id_fungsional'=>$tbPeneliti->id_fungsional))->row();


        $data = array(
            'tbPSatker'  => $tbPSatker,
            'tbPeneliti' => $tbPeneliti,
            'tbPenelitiPendidikan' => $tbPenelitiPendidikan,
        );
        $this->load->view('peneliti/biodata/pendidikan_form', $data);
    }

    public function TambahPendidikan(){
        $id_peneliti_pendidikan = time().rand(140,240);
        $this->load->library('upload');
        $filePath = './uploads/';
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'pdf|PDF';
        $config['overwrite']    = TRUE;
        $config['file_name'] = 'ijazah_'.$id_peneliti_pendidikan.$this->session->userdata('id_peneliti').'.pdf';
        $this->upload->initialize($config);

        if($this->upload->do_upload('ijazah')){
            $file1 = $this->upload->data();
            $data = array(
                'id_peneliti_pendidikan' => $id_peneliti_pendidikan,
                'id_peneliti' => $this->session->userdata('id_peneliti'),
                'jenjang' => strtoupper($this->input->post('jenjang')),
                'nama_pt' => strtoupper($this->input->post('nama_pt')),
                'program_studi' => strtoupper($this->input->post('program_studi')),
                'tahun' => strtoupper($this->input->post('tahun')),
                'ijazah' => $file1['file_name'],
            );
            if($this->Tbl_peneliti_pendidikan->create($data)){
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Peneliti/Biodata/Pendidikan/');
            }else{
                $this->session->set_flashdata('message','Data gagal disimpan.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Peneliti/Biodata/Pendidikan/');
            }
        }else{
            $this->session->set_flashdata('message','Ijazah tidak berhasil diupload atau kosong.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Biodata/Pendidikan/');
        }
    }

    public function HapusPendidikan($id){
        $where = array(
            'id_peneliti_pendidikan' => $id,
        );
        if ($this->Tbl_peneliti_pendidikan->delete($where)) {
            $this->session->set_flashdata('message','Data berhasil dihapus.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Biodata/Pendidikan/');
        }else{
            $this->session->set_flashdata('message','Terjadi kesalahan dalam hapus data user');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Biodata/Pendidikan/');
        }
    }

    public function Berkas(){
        $tbPeneliti = $this->Tbl_peneliti->whereAnd(array('id_peneliti' => $this->session->userdata('id_peneliti')))->row();
        $tbPenelitiBerkas = $this->Tbl_peneliti_berkas->whereAnd(array('id_peneliti'=>$tbPeneliti->id_peneliti))->row();
        $tbPSatker = $this->Tbl_master_satker->whereAnd(array('id_satker'=>$tbPeneliti->id_satker))->row();
        $tbPFungsional = $this->Tbl_master_fungsional->whereAnd(array('id_fungsional'=>$tbPeneliti->id_fungsional))->row();


        $data = array(
            'tbPSatker'  => $tbPSatker,
            'tbPeneliti' => $tbPeneliti,
            'tbPenelitiBerkas' => $tbPenelitiBerkas,
        );
        $this->load->view('peneliti/biodata/berkas_form', $data);
    }

    public function TambahBerkasKTP(){
        $this->load->library('upload');
        $filePath = './uploads/';
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'jpg|JPG';
        $config['overwrite']    = TRUE;
        $config['file_name'] = 'ktp_'.$this->input->post('id').$id_peneliti_pendidikan.$this->session->userdata('id_peneliti').'.jpg';
        $this->upload->initialize($config);

        if($this->upload->do_upload('ktp')){
            $file1 = $this->upload->data();
            $data = array(
                'ktp' => $file1['file_name'],
                'ktp_komentar' => $this->input->post('komentar'),
            );
            $where = array(
                'id_peneliti_berkas' => $this->input->post('id'),
            );
            if($this->Tbl_peneliti_berkas->update($where, $data)){
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Peneliti/Biodata/Berkas/');
            }else{
                $this->session->set_flashdata('message','Data gagal disimpan.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Peneliti/Biodata/Berkas/');
            }
        }else{
            $this->session->set_flashdata('message','Ijazah tidak berhasil diupload atau kosong.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Biodata/Berkas/');
        }
    }

    public function TambahBerkasSKPNS(){
        $this->load->library('upload');
        $filePath = './uploads/';
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'pdf|PDF';
        $config['overwrite']    = TRUE;
        $config['file_name'] = 'skpns_'.$this->input->post('id').$id_peneliti_pendidikan.$this->session->userdata('id_peneliti').'.pdf';
        $this->upload->initialize($config);

        if($this->upload->do_upload('sk_pns')){
            $file1 = $this->upload->data();
            $data = array(
                'sk_pns_dosen' => $file1['file_name'],
                'pns_dosen_komentar' => $this->input->post('komentar'),
            );
            $where = array(
                'id_peneliti_berkas' => $this->input->post('id'),
            );
            if($this->Tbl_peneliti_berkas->update($where, $data)){
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Peneliti/Biodata/Berkas/');
            }else{
                $this->session->set_flashdata('message','Data gagal disimpan.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Peneliti/Biodata/Berkas/');
            }
        }else{
            $this->session->set_flashdata('message','Ijazah tidak berhasil diupload atau kosong.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Biodata/Berkas/');
        }
    }

    public function TambahBerkasJabFung(){
        $this->load->library('upload');
        $filePath = './uploads/';
        $config['upload_path'] = $filePath;
        $config['allowed_types'] = 'pdf|PDF';
        $config['overwrite']    = TRUE;
        $config['file_name'] = 'jabfungsional_'.$this->input->post('id').$id_peneliti_pendidikan.$this->session->userdata('id_peneliti').'.pdf';
        $this->upload->initialize($config);

        if($this->upload->do_upload('jabfung')){
            $file1 = $this->upload->data();
            $data = array(
                'sk_jab_fungsional' => $file1['file_name'],
                'jab_fungsional_komentar' => $this->input->post('komentar'),
            );
            $where = array(
                'id_peneliti_berkas' => $this->input->post('id'),
            );
            if($this->Tbl_peneliti_berkas->update($where, $data)){
                $this->session->set_flashdata('message','Data berhasil disimpan.');
                $this->session->set_flashdata('type_message','success');
                redirect('Peneliti/Biodata/Berkas/');
            }else{
                $this->session->set_flashdata('message','Data gagal disimpan.');
                $this->session->set_flashdata('type_message','danger');
                redirect('Peneliti/Biodata/Berkas/');
            }
        }else{
            $this->session->set_flashdata('message','Ijazah tidak berhasil diupload atau kosong.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Biodata/Berkas/');
        }
    }

    public function JurnalPublikasi(){
        $tbPeneliti = $this->Tbl_peneliti->whereAnd(array('id_peneliti' => $this->session->userdata('id_peneliti')))->row();
        $tbPenelitiJurnal = $this->Tbl_peneliti_jurnal->whereAnd(array('id_peneliti'=>$tbPeneliti->id_peneliti))->result();
        $tbPSatker = $this->Tbl_master_satker->whereAnd(array('id_satker'=>$tbPeneliti->id_satker))->row();
        $tbPFungsional = $this->Tbl_master_fungsional->whereAnd(array('id_fungsional'=>$tbPeneliti->id_fungsional))->row();


        $data = array(
            'tbPSatker'  => $tbPSatker,
            'tbPeneliti' => $tbPeneliti,
            'tbPenelitiJurnal' => $tbPenelitiJurnal,
        );
        $this->load->view('peneliti/biodata/jurnal_publikasi_form', $data);
    }

    public function TambahJurnal(){
        $data = array(
            'id_peneliti_jurnal' => time().rand(310,610),
            'id_peneliti' => $this->session->userdata('id_peneliti'),
            'judul' => strtoupper($this->input->post('judul')),
            'nama_jurnal' => strtoupper($this->input->post('nama')),
            'volume' => strtoupper($this->input->post('volume')),
            'url' => strtoupper($this->input->post('url')),
        );
        if($this->Tbl_peneliti_jurnal->create($data)){
            $this->session->set_flashdata('message','Data berhasil ditambah.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Biodata/JurnalPublikasi/');
        }else{
            $this->session->set_flashdata('message','Data gagal ditambah.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Biodata/JurnalPublikasi/');
        }
    }

    public function HapusJurnal($id){
        $where = array(
            'id_peneliti_jurnal' => $id,
        );
        if ($this->Tbl_peneliti_jurnal->delete($where)) {
            $this->session->set_flashdata('message','Data berhasil dihapus.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Biodata/JurnalPublikasi/');
        }else{
            $this->session->set_flashdata('message','Data gagal dihapus');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Biodata/JurnalPublikasi/');
        }
    }

    public function Buku(){
        $tbPeneliti = $this->Tbl_peneliti->whereAnd(array('id_peneliti' => $this->session->userdata('id_peneliti')))->row();
        $tbPenelitiBuku = $this->Tbl_peneliti_buku->whereAnd(array('id_peneliti'=>$tbPeneliti->id_peneliti))->result();
        $tbPSatker = $this->Tbl_master_satker->whereAnd(array('id_satker'=>$tbPeneliti->id_satker))->row();
        $tbPFungsional = $this->Tbl_master_fungsional->whereAnd(array('id_fungsional'=>$tbPeneliti->id_fungsional))->row();


        $data = array(
            'tbPSatker'  => $tbPSatker,
            'tbPeneliti' => $tbPeneliti,
            'tbPenelitiBuku' => $tbPenelitiBuku,
        );
        $this->load->view('peneliti/biodata/buku_form', $data);
    }

    public function TambahBuku(){
        $data = array(
            'id_peneliti_buku' => time().rand(610,810),
            'id_peneliti' => $this->session->userdata('id_peneliti'),
            'judul' => strtoupper($this->input->post('judul')),
            'penerbit' => strtoupper($this->input->post('penerbit')),
            'isbn' => strtoupper($this->input->post('isbn')),
            'tahun' => strtoupper($this->input->post('tahun')),
        );
        if($this->Tbl_peneliti_buku->create($data)){
            $this->session->set_flashdata('message','Data berhasil ditambah.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Biodata/Buku/');
        }else{
            $this->session->set_flashdata('message','Data gagal ditambah.');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Biodata/Buku/');
        }
    }

    public function HapusBuku($id){
        $where = array(
            'id_peneliti_buku' => $id,
        );
        if ($this->Tbl_peneliti_buku->delete($where)) {
            $this->session->set_flashdata('message','Data berhasil dihapus.');
            $this->session->set_flashdata('type_message','success');
            redirect('Peneliti/Biodata/Buku/');
        }else{
            $this->session->set_flashdata('message','Data gagal dihapus');
            $this->session->set_flashdata('type_message','danger');
            redirect('Peneliti/Biodata/Buku/');
        }
    }
}
