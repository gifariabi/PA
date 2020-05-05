<?php
class Model_daftar extends CI_Model{
	public function simpan($nim,$username,$password,$nama,$prodi){
      	$query = "INSERT INTO mahasiswa VALUES('$nim','$username','$password','$nama','','','','','$prodi','')";
        $this->db->query($query);
    }

    public function insertbaru($data,$table)
    {
        $this->db->insert($table,$data);
    }

    public function edit_data($nim){      
        return $this->db->get_where('mahasiswa',array('nim'=>$nim),1);
    }
    public function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    } 

    public function lihat_akun($where){
    	$nim = array('nim'=>$where);
    	$this->db->select('*');
    	$this->db->from('mahasiswa');
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
        $this->db->select('m.nama, m.nim, o.namaOrganisasi, o.deskripsi,o.logo,o.ketua, o.idOrganisasi');
        $this->db->from('ang_organisasi g');
        $this->db->join('organisasi o','g.idOrganisasi = o.idOrganisasi');
        $this->db->join('pengurus an','o.idOrganisasi =  an.idOrganisasi');
        $this->db->join('mahasiswa m','an.nim =  m.nim');
        $this->db->where('m.nim', $where);

        $query = $this->db->get();
        //if($query->num_rows() > 0) {
            return $query;
        //}
	}

    public function ambil_akun($nim){
        return $this->db->get_where('mahasiswa',array('nim'=>$nim),1);
    }

    function search($keyword){
            $this->db->like('namaOrganisasi',$keyword);
            $this->db->or_like('ketua',$keyword);
            $query=$this->db->get('organisasi');
            return $query->result();
    }

    function searchPengurus($search){
            $this->db->like('nama',$search);
            $this->db->or_like('nim',$search);
            $query=$this->db->get('mahasiswa');
            return $query->result();
    }

    function searchAnggota($search){
            $this->db->like('nama',$search);
            $this->db->or_like('nim',$search);
            $query=$this->db->get('mahasiswa');
            return $query->result();
    }

    function searchOrg($search){
            $this->db->like('namaOrganisasi',$search);
            $this->db->or_like('ketua',$search);
            $query=$this->db->get('organisasi');
            return $query->result();
    }

    public function get($where){
        $this->db->select('*');
        $this->db->from('organisasi');
        $this->db->where('idOrganisasi', $where);
    }

    public function getOrganisasi(){
        $this->db->select('*');
        $this->db->from('organisasi');
        $query=$this->db->get();
        return $query->result();
    }

    public function edit_Org($where,$table){      
        return $this->db->get_where($table,$where);
    }

    public function update_Org($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }

    public function hapus_Org($where,$table){
        $this->db->delete($table,$where);
    }
}
?>