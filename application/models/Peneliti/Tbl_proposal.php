<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tbl_proposal extends CI_Model {

	public function create($data){
		if($this->db->insert('tbl_proposal',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function read() {
		return $this->db->get('tbl_proposal');
	}

	public function update($where,$data){
		$this->db->where($where);
		if($this->db->update('tbl_proposal',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete($where){
		$this->db->where($where);
		if($this->db->delete('tbl_proposal')){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function whereAnd($data){
		$this->db->where($data);
		return $this->db->get('tbl_proposal');
	}

    public function whereOr($data){
        $this->db->or_where($data);
        return $this->db->get('tbl_proposal');
    }

	public function likeAnd($data){
		$this->db->like($data);
		return $this->db->get('tbl_proposal');
	}

	public function likeOr($data){
		$this->db->or_like($data);
		return $this->db->get('tbl_proposal');
	}

	public function whereAndJoinProposal($data){
		$this->db->select('a.no, a.id_proposal, a.id_peneliti, a.id_kluster, a.id_bidang_ilmu, a.status_proposal, a.date_created, a.status_proposal, b.anggaran, c.judul');
		$this->db->from('tbl_proposal a');
		$this->db->join('tbl_proposal_anggaran b', 'a.id_proposal=b.id_proposal');
		$this->db->join('tbl_proposal_content c', 'c.id_proposal=a.id_proposal');
		$this->db->where($data);
		return $this->db->get();
	}

}
