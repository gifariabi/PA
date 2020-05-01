<?php 
    class Modelnya extends CI_Model{
        function data($no_surat,$pengirim,$tanggalmasuk,$penerima,$perihal){
            $query = "INSERT INTO suratmasuk 
                    VALUES('','$no_surat','$pengirim','$tanggalmasuk','$penerima','$perihal')";
            $this->db->query($query);
        }
        function insert_req_surat($nama,$penerima,$tanggalkeluar,$perihal,$status){
            $query = "INSERT INTO requestSurat 
                    VALUES('','$nama','$penerima','$tanggalkeluar','$perihal','On Proccess')";
            $this->db->query($query);
        }
        function tampil(){
            $query = $this->db->query("call tampil_surat_masuk()");
            //$query = $this->db->query("SELECT COUNT($no_surat) FROM suratmasuk");
            return $query->result();
        }

        function update_status($no_tiket) {
            $where = array('no_tiket'=>$no_tiket);
            $this->db->set('status', 'Accepted');
            $this->db->where($where);
            $query = $this->db->update('tiket');
            return $query;
        }
        function tampil_req(){
            $query = $this->db->query("SELECT * FROM requestsurat WHERE nama='".$this->session->namaLengkap."'");
            //$this->db->where('namaLengkap',$nama);
            return $query->result();
        }
        function tampil_req_admin(){
            $query = $this->db->query("SELECT * FROM requestsurat");
            //$this->db->where('namaLengkap',$nama);
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
            $this->db->where('idsurat',$id);
            return $this->db->delete('suratmasuk');
        }
        function search($keyword){
            $this->db->like('pengirim',$keyword);
            $this->db->or_like('tanggalmasuk',$keyword);
            $query=$this->db->get('suratmasuk');
            return $query->result();
        }
        public function halaman($number,$offset){
            return $query = $this->db->get('suratmasuk',$number,$offset)->result();       
        }
 
        function jumlah_data(){
        return $this->db->get('suratmasuk')->num_rows();
        }
    }
?>