<?php 
    class model_suratkeluar extends CI_Model{
        public function data($no_suratkeluar,$penerima,$tanggalkeluar,$perihal,$nim_pengurus){
            $query = "INSERT INTO suratkeluar VALUES('','$no_suratkeluar','$penerima','$tanggalkeluar','$perihal','$nim_pengurus')";
            $this->db->query($query);
        }
        function tampil(){
            $query = $this->db->query("SELECT no_suratkeluar,penerima,tanggalkeluar as 'tanggalkeluar', perihal FROM suratkeluar ORDER BY no_suratkeluar ASC");
            return $query->result();
        }
        public function edit_data($where,$table){      
            return $this->db->get_where($table,$where);
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
 
        function jumlah_data(){
        return $this->db->get('suratkeluar')->num_rows();
        }
    }
?>