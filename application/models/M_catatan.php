<?php
class M_catatan extends CI_Model{	
	function __construct(){
		parent::__construct();		
	}

	function ambil_catatan() {
		$sql = "SELECT *
				FROM catatan";
		return $this->db->query($sql)->result();
	}

	function ambil_catatan_id($id) {
		$sql = "SELECT *
				FROM catatan
				WHERE id = ?";
		return $this->db->query($sql, array($id))->row();
	}

	function ambil_catatan_id_user($id_user) {
		$sql = "SELECT *
				FROM catatan
				WHERE id_user = ?";
		return $this->db->query($sql, array($id_user))->result();
	}

	function tambah_catatan($id_user, $catatan, $status) {
		$sql = "INSERT INTO catatan
				SET id_user = ?,
				catatan = ?,
				status = ?";
		$this->db->query($sql, array($id_user, $catatan, $status));
		
		return $this->ambil_catatan_id($this->db->insert_id());
	}

	function ubah_catatan($id, $catatan, $status) {
		$sql = "UPDATE catatan
				SET catatan = ?,
				status = ?
				WHERE id = ?";
		$this->db->query($sql, array($catatan, $status, $id));
		
		return $this->ambil_catatan_id($id);
	}

	function hapus_catatan($id) {
		$sql = "DELETE from catatan
				WHERE id = ?";
		$this->db->query($sql, array($id));		
	}
}
?>