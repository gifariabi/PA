<?php
class model_ormawa extends CI_Model{
		public function simpan($namaOrganisasi,$deskripsi,$logo,$ketua){
            $data = array (
            'namaOrganisasi' => $namaOrganisasi,
            'deskripsi' => $deskripsi,
            'logo' => $logo,
            'ketua' => $ketua,
        );
            $this->db->insert('organisasi', $data);
        }

        public function simpanfoto($foto,$nim){
            /*$data = array (
                'foto' => $foto
            );
            $where = 'nim' => $nim;*/
            $data = array(
                'foto' => $foto
            );
 
            $where = array(
                'nim' => $nim
            );
       
            $this->db->insert('mahasiswa',$where, $data);
        }

        public function simpan2($namaOrganisasi,$deskripsi,$logo,$ketua){
            $query = "INSERT INTO organisasi VALUES('','$namaOrganisasi','$deskripsi','$logo','$ketua')";
            $this->db->query($query);
        }

        function tampil_ormawa(){
            $query = $this->db->query("SELECT * FROM organisasi");
            return $query->result();
        }

        function getOrganisasi(){
            $this->db->SELECT('*');
            $this->db->from('organisasi');
            $this->db->order_by('namaOrganisasi', 'ASC');
		  $query = $this->db->get();
		  return $query->result();
    	}

        public function getPengurus($where){
            $this->db->select('p.nim, p.nama, p.jabatan, o.idOrganisasi, id_thnAjaran');
            $this->db->from('organisasi o');
            $this->db->join('pengurus p','o.idOrganisasi =  p.idOrganisasi');
            $this->db->join('mahasiswa a','p.nim =  a.nim');
            $this->db->where('p.id_thnAjaran', 1);
            $this->db->where('o.idOrganisasi', $where);
        
            $query = $this->db->get();
            return $query->result();
        }

        public function getPengurus1($where){
            $this->db->select('nim, nama, jabatan,id_thnAjaran');
            $this->db->from('pengurus');
            $this->db->where('idOrganisasi',$where);
            $this->db->where('id_thnAjaran',1);
        
            $query = $this->db->get();
            return $query->result();
        }

        public function getPengurus2($where){
            $this->db->select('nim, nama, jabatan,id_thnAjaran');
            $this->db->from('pengurus');
            $this->db->where('idOrganisasi',$where);
            $this->db->where('id_thnAjaran',2);
        
            $query = $this->db->get();
            return $query->result();
        }

        public function getPengurus3($where){
            $this->db->select('nim, nama, jabatan,id_thnAjaran');
            $this->db->from('pengurus');
            $this->db->where('idOrganisasi',$where);
            $this->db->where('id_thnAjaran',3);
        
            $query = $this->db->get();
            return $query->result();
        }

        public function edit_pengurus($where,$table){      
            return $this->db->get_where($table,$where);
        }

        public function update_pengurus($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }

        public function hapus_pengurus($where,$table){
        $this->db->delete($table,$where);
        }

        public function getAnggota($where){

            $this->db->select('a.nim, an.nama, an.jabatan, o.idOrganisasi');
            $this->db->from('organisasi o');
            $this->db->join('ang_organisasi an','o.idOrganisasi =  an.idOrganisasi');
            $this->db->join('mahasiswa a','an.nim =  a.nim');
            $this->db->where('o.idOrganisasi', $where);

            $query = $this->db->get();
            //if($query->num_rows() > 0) {
                return $query->result();
            //}
        }

        public function edit_anggota($where,$table){      
            return $this->db->get_where($table,$where);
        }

        public function update_anggota($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }

        public function hapus_anggota($where,$table){
        $this->db->delete($table,$where);
        }

        public function edit_foto($where,$table){      
            return $this->db->get_where($table,$where);
        }

        public function update_foto($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }

        public function getAnggotabaru(){
            $this->db->select('*');
            $this->db->from('mahasiswa');
            $this->db->where('nim > 0');

            $query = $this->db->get();
            return $query->result();
        }
        public function deskripsi($where){
            $this->db->SELECT('*');
            $this->db->from('organisasi');
            $this->db->where('idOrganisasi',$where);

            $query = $this->db->get();
            if($query->num_rows() > 0) {
            return $query;
        }

        }

         public function getPengurusbaru(){
            $this->db->select('*');
            $this->db->from('mahasiswa');
            $this->db->where('nim > 0');

            $query = $this->db->get();
            return $query->result();
        }

    }
?>