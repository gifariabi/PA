<?php 
    class proker_model extends CI_Model{
        //input data
        function data($data,$table){
            // $query = "INSERT INTO kelas VALUES('','$nama','$spesifik','$jumlah','$kondisi')";
            // $this->db->query($query);
            return $this->db->insert($table,$data);
        }
        //mengambil database
        function tampil($where){
            // $query = $this->db->query("SELECT * FROM kelas");
            // return $query->result();
            // return $this->db->get('programkerja');
            $this->db->select('p.id_programkerja,p.nama_programkerja, p.waktu_pelaksanaan, p.departemen');
            $this->db->from('programkerja p');
            $this->db->join('organisasi o','p.idOrganisasi = o.idOrganisasi');
            // $this->db->join('anggota a','an.nim =  a.nim');
            $this->db->where('o.idOrganisasi', $where);

            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->result();
            }
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
    }
?>