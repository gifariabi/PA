<?php 
    class Model_berita extends CI_Model{
        function simpan_berita($jdl,$berita,$gambar){
            $query = $this->db->query("INSERT INTO berita (judul,isi,gambar) VALUES ('$jdl','$berita','$gambar')");
            return $query;
        }
        function get_berita_by_kode($kode){
            $query =$this->db->query("SELECT * FROM berita WHERE id_berita='$kode'");
            return $query;
        }
        function get_all_berita(){
            $query = $this->db->query("SELECT * FROM berita ORDER BY id_berita DESC");
            return $query;
        }
    }
?>