<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tbl_users extends CI_Model {

	public function create($data){
		if($this->db->insert('tbl_users',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function read() {
		return $this->db->get('tbl_users');
	}

	public function update($where,$data){
		$this->db->where($where);
		if($this->db->update('tbl_users',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete($where){
		$this->db->where($where);
		if($this->db->delete('tbl_users')){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function whereAnd($data){
		$this->db->where($data);
		return $this->db->get('tbl_users');
	}

    public function whereOr($data){
        $this->db->or_where($data);
        return $this->db->get('tbl_users');
    }

	public function likeAnd($data){
		$this->db->like($data);
		return $this->db->get('tbl_users');
	}

	public function likeOr($data){
		$this->db->or_like($data);
		return $this->db->get('tbl_users');
	}

}