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
            $this->db->select('id_rapat,perihal, tempat, DATE_FORMAT(tanggal,"%d %M %Y") AS tanggal, waktu, kategori');
            $this->db->from('rapat');
            $this->db->order_by('tanggal DESC');

            $query = $this->db->get();
            return $query;
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
            $this->db->select(' o.idOrganisasi,r.perihal, r.tempat, DATE_FORMAT(r.tanggal,"%d %M %Y") AS tanggal, r.waktu');
            $this->db->from('rapat r');
            $this->db->join('organisasi o','r.idOrganisasi = o.idOrganisasi');
            // $this->db->join('anggota a','an.nim =  a.nim');
            $this->db->where('o.idOrganisasi', $where);
            $this->db->where('tanggal >= CURDATE()');

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
		function getRapatOrganisasi($where){
            // FROM organisasi JOIN rapat ON organisasi.idOrganisasi = rapat.id_organisasi
            $this->db->select('rapat.id_organisasi, organisasi.namaOrganisasi, rapat.id_rapat, rapat.perihal, rapat.tempat, rapat.tanggal, rapat.waktu, rapat.kategori,');
            $this->db->from('organisasi');
            $this->db->join('rapat', 'organisasi.idOrganisasi = rapat.id_organisasi');
            $this->db->where_in('organisasi.idOrganisasi', $where);
            $this->db->order_by("rapat.tanggal", "asc");

            $query = $this->db->get();

            return $query;
        }
    }
?>