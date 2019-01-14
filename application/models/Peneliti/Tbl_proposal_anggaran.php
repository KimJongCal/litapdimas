<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tbl_proposal_anggaran extends CI_Model {

	public function create($data){
		if($this->db->insert('tbl_proposal_anggaran',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function read() {
		return $this->db->get('tbl_proposal_anggaran');
	}

	public function update($where, $data){
		$this->db->where($where);
		if($this->db->update('tbl_proposal_anggaran',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete($where){
		$this->db->where($where);
		if($this->db->delete('tbl_proposal_anggaran')){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function whereAnd($data){
		$this->db->where($data);
		return $this->db->get('tbl_proposal_anggaran');
	}

    public function whereOr($data){
        $this->db->or_where($data);
        return $this->db->get('tbl_proposal_anggaran');
    }

	public function likeAnd($data){
		$this->db->like($data);
		return $this->db->get('tbl_proposal_anggaran');
	}

	public function likeOr($data){
		$this->db->or_like($data);
		return $this->db->get('tbl_proposal_anggaran');
	}

}
