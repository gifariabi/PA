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
            $query = $this->db->query("SELECT * FROM berita WHERE status = 'Publish' ORDER BY id_berita DESC");
            return $query;
        }
        function data(){
            $query = $this->db->query("SELECT * FROM berita ORDER BY tanggal DESC");
            return $query;
        }
        function update_status($id_berita) {
            $where = array('id_berita' => $id_berita);
            $this->db->set('status', 'Publish');
            $this->db->where($where);
            $query = $this->db->update('berita');
            return $query;
        }
        function update_status2($id_berita) {
            $where = array('id_berita' => $id_berita);
            $this->db->set('status', 'Unpublish');
            $this->db->where($where);
            $query = $this->db->update('berita');
            return $query;
        }
    }
?>