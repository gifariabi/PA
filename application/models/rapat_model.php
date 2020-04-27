<?php 
    class Rapat_model extends CI_Model{
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
            return $this->db->get('rapat');
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
        function tampil_data($where){
            $this->db->select('p.nim , o.idOrganisasi');
            $this->db->from('rapat r');
            $this->db->join('pengurus p','r.nim = p.nim');
            $this->db->join('organisasi o','p.idOrganisasi = o.idOrganisasi');
            // $this->db->join('anggota a','an.nim =  a.nim');
            $this->db->where('o.idOrganisasi', $where);

            $query = $this->db->get();
            // if($query->num_rows() > 0) {
                return $query;
            // }
        }
        // update data
        function update_data($where,$data,$table){
            $this->db->where($where);
            $this->db->update($table,$data);
        }
    }
?>