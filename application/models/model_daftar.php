<?php
class model_daftar extends CI_Model{
	public function simpan($nim,$username,$password,$nama,$prodi){
      	$query = "INSERT INTO anggota VALUES('$nim','$username','$password','$nama','','','','','$prodi','')";
        $this->db->query($query);
    }

    public function insertbaru($data,$table)
    {
        $this->db->insert($table,$data);
    }

    public function edit_data($nim){      
        return $this->db->get_where('anggota',array('nim'=>$nim),1);
    }
    public function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    } 

    public function lihat_akun($where){
    	$nim = array('nim'=>$where);
    	$this->db->select('*');
    	$this->db->from('anggota');
    	$this->db->where($nim);

    	$query = $this->db->get();
        return $query;
    }  
    
    public function view($table)
	{
		return $this->db->get($table);
	}

	public function view_where($table,$where)
	{
		return $this->db->get_where($table,$where);
	}
    
	public function insert($data,$table)
	{
		$this->db->insert($table,$data);
	}
	public function hapus_akun($where,$table){
        $this->db->delete($table,$where);
    }
		
	function tampilDaftar($where){
        $this->db->distinct();
		$this->db->select('*');
        $this->db->from('organisasi o');
        $this->db->join('ang_organisasi an','o.idOrganisasi =  an.idOrganisasi');
        $this->db->join('anggota a','an.nim =  a.nim');
        $this->db->where('a.nim', $where);

        $query = $this->db->get();
       	//if($query->num_rows() > 0) {
        	return $query;
    	//}
	}

    public function ambil_akun($nim){
        return $this->db->get_where('anggota',array('nim'=>$nim),1);
    }

    function search($keyword){
            $this->db->like('namaOrganisasi',$keyword);
            $this->db->or_like('ketua',$keyword);
            $query=$this->db->get('organisasi');
            return $query->result();
    }
}
?>