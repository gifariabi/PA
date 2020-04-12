<?php 
    class model_suratkeluar extends CI_Model{
        public function data($data,$table){
            $this->db->insert($table, $data);
        }
        function tampil($where){
            $this->db->SELECT ('*');
            $this->db->from('suratkeluar');
            $this->db->where('idOrganisasi',$where);
            //$this->db->where('nim',$where);
            $query = $this->db->get();
            return $query->result();
        }

        public function edit_data($where,$table){      
            return $this->db->get_where($table,$where);
        }

        public function tampil_pdf($where){
            
            $this->db->select('s.no_suratkeluar,s.penerima,s.tanggalkeluar,s.perihal, o.idOrganisasi, o.namaOrganisasi, o.logo, o.ketua, s.waktu');
            $this->db->from('pengurus p');
            $this->db->join('suratkeluar s','p.nim = s.nim');
            $this->db->join('organisasi o','s.idOrganisasi =  o.idOrganisasi');
            $this->db->where('s.id', $where);

            $query = $this->db->get();
            //if($query->num_rows() > 0) {
                return $query;
            //}
        }
        public function update_data($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }   
        public function hapus_data($id){
            $this->db->where('id',$id);
            return $this->db->delete('suratkeluar');
        }
        function search($keyword){
            $this->db->like('penerima',$keyword);
            $this->db->or_like('tanggalkeluar',$keyword);
            $this->db->or_like('no_suratkeluar',$keyword);
            $this->db->or_like('perihal',$keyword);
            $query=$this->db->get('suratkeluar');
            return $query->result();
        }
        public function halaman($number,$offset){
            return $query = $this->db->get('suratkeluar',$number,$offset)->result();       
        }
 
        function jumlah_data($where){
            $this->db->SELECT('*');
            $this->db->from('suratkeluar');

            $query = $this->db->get()->num_rows();
            return $query;
        }
    }
?>