<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tbl_master_fungsional extends CI_Model {

	public function create($data){
		if($this->db->insert('tbl_master_fungsional',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function read() {
		return $this->db->get('tbl_master_fungsional');
	}

	public function update($where,$data){
		$this->db->where($where);
		if($this->db->update('tbl_master_fungsional',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete($where){
		$this->db->where($where);
		if($this->db->delete('tbl_master_fungsional')){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function whereAnd($data){
		$this->db->where($data);
		return $this->db->get('tbl_master_fungsional');
	}

    public function whereOr($data){
        $this->db->or_where($data);
        return $this->db->get('tbl_master_fungsional');
    }

	public function likeAnd($data){
		$this->db->like($data);
		return $this->db->get('tbl_master_fungsional');
	}

	public function likeOr($data){
		$this->db->or_like($data);
		return $this->db->get('tbl_master_fungsional');
	}

}
