<?php 
    class tiket_model extends CI_Model{
        //input data
        function data($data,$table){
            // $query = "INSERT INTO kelas VALUES('','$nama','$spesifik','$jumlah','$kondisi')";
            // $this->db->query($query);
            return $this->db->insert($table,$data);
        }
        //mengambil database
        function tampil(){
            // $query = $this->db->query("SELECT * FROM kelas");
            // return $query->result();
            return $this->db->get('tiket');
        }
        // menghapus data
        function hapus_data($where,$table){
            $this->db->where($where);
            $this->db->delete($table);
        }
        //mengedit data
        function edit_data($where,$table){
            return $this->db->get_where($table,$where);
        }
        // update data
        function update_data($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }
        function update_status($no_tiket) {
            $where = array('no_tiket' => $no_tiket);
            $this->db->set('status', 'Accepted');
            $this->db->where($where);
            $query = $this->db->update('tiket');
            return $query;
        }
        function tampil_req(){
            $query = $this->db->query("SELECT * FROM tiket ");
            //$this->db->where('namaLengkap',$nama);
            return $query->result();
        }
    }
?>