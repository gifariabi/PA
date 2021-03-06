<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model 
{
	// Mengambil semua data di database
	public function getAll()
	{
		return $this->db->get($this->_table)->result();
	}

	// Mengambil data akun sesuai username dan password
	public function ambil_akun($username, $password){
		$query = $this->db->get_where('mahasiswa',
			array(
				'username' => $username,
				'password' => $password),
				1);
		return $query->result();
	}

	public function view_where($table,$where){
  		return $this->db->get_where($table,$where);
 	}


	// Input data ke database
	
	// update akun pengurus
	public function update($nim){
		$this->db->update($this->_table, $this, array('nim' => $nim));
	}

	// hapus akun pengurus
	public function delete($nim)
	{
		return $this->db->delete($this->_table, array('nim' => $nim));
	}
}