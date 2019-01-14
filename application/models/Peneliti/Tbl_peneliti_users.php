<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Tbl_peneliti_users extends CI_Model {

	public function create($data){
		if($this->db->insert('tbl_peneliti_users',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function read() {
		return $this->db->get('tbl_peneliti_users');
	}

	public function update($where,$data){
		$this->db->where($where);
		if($this->db->update('tbl_peneliti_users',$data)){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function delete($where){
		$this->db->where($where);
		if($this->db->delete('tbl_peneliti_users')){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	public function whereAnd($data){
		$this->db->where($data);
		return $this->db->get('tbl_peneliti_users');
	}

    public function whereOr($data){
        $this->db->or_where($data);
        return $this->db->get('tbl_peneliti_users');
    }

	public function likeAnd($data){
		$this->db->like($data);
		return $this->db->get('tbl_peneliti_users');
	}

	public function likeOr($data){
		$this->db->or_like($data);
		return $this->db->get('tbl_peneliti_users');
	}

	public function whereAndJoin($data){
		$this->db->select('a.no, a.id_peneliti_user, a.id_peneliti, a.username, a.password, b.nidn, b.nip, b.id_fungsional, a.status_aktivasi, b.nama, b.tempat, b.tgl_lhr, b.alamat, b.id_satker, b.jabatan, b.id_pangkat, b.id_jab_fungsional, b.email, b.hp, b.id_bidang_ilmu');
		$this->db->from('tbl_peneliti_users a');
		$this->db->join('tbl_peneliti b', 'a.id_peneliti=b.id_peneliti');
		$this->db->where($data);
		return $this->db->get();
	}

}