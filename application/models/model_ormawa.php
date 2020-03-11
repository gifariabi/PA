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
        public function simpan2($namaOrganisasi,$deskripsi,$logo,$ketua){
            $query = "INSERT INTO organisasi VALUES('','$namaOrganisasi','$deskripsi','$logo','$ketua')";
            $this->db->query($query);
        }

        function tampil_ormawa(){
            $query = $this->db->query("SELECT * FROM organisasi");
            return $query->result();
        }

        function getOrganisasi(){
            $this->db->from('organisasi');
            $this->db->order_by('idOrganisasi', 'DESC');
		  $query = $this->db->get();
		  return $query->result();
    	}

        public function getPengurus(){
            $this->db->select('nim_pengurus, nama, jabatan');
            $this->db->from('pengurus');
        //$this->db->where('MONTH(tanggal)', $tanggal);
        //$this->db->order_by('id_kas', 'ASC');
        
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
    }
?>