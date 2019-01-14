<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tbl_proposal_peneliti extends CI_Model {

	public function create($data){
		if($this->db->insert('tbl_proposal_peneliti',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function read() {
		return $this->db->get('tbl_proposal_peneliti');
	}

	public function update($where){
		$this->db->where($where);
		if($this->db->update('tbl_proposal_peneliti',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete($where){
		$this->db->where($where);
		if($this->db->delete('tbl_proposal_peneliti')){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function whereAnd($data){
		$this->db->where($data);
		return $this->db->get('tbl_proposal_peneliti');
	}

    public function whereOr($data){
        $this->db->or_where($data);
        return $this->db->get('tbl_proposal_peneliti');
    }

	public function likeAnd($data){
		$this->db->like($data);
		return $this->db->get('tbl_proposal_peneliti');
	}

	public function likeOr($data){
		$this->db->or_like($data);
		return $this->db->get('tbl_proposal_peneliti');
	}

	public function whereAndJoin($data){
		$this->db->select('a.no, a.id_proposal_peneliti, a.id_proposal, a.jabatan as jabatan_proposal, a.id_peneliti, b.nidn, b.nip, b.id_fungsional, b.nama, b.tempat, b.tgl_lhr, b.alamat, b.id_satker, b.jabatan, b.id_pangkat, b.id_jab_fungsional, b.email, b.hp, b.id_bidang_ilmu, c.satker');
		$this->db->from('tbl_proposal_peneliti a');
		$this->db->join('tbl_peneliti b', 'a.id_peneliti=b.id_peneliti');
		$this->db->join('tbl_master_satker c', 'c.id_satker=b.id_satker');
		$this->db->where($data);
		$this->db->order_by('jabatan_proposal');
		return $this->db->get();
	}
}
