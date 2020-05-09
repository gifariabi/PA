<?php
    class Model_lpj extends CI_Model{
        //input data
        function data($data,$table){
            // $query = "INSERT INTO kelas VALUES('','$nama','$spesifik','$jumlah','$kondisi')";
            // $this->db->query($query);
            return $this->db->insert($table,$data);
        }
        // function getId($where,$table){
        //      $this->db->where($where);
        //      $this->db->insert($table,$data);
        // }
        //mengambil database
        function _uploadImage(){
            $config['upload_path']          = './upload/product/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['file_name']            = $this->id_lpj;
            $config['overwrite']			= true;
            $config['max_size']             = 1024; // 1MB
            // $config['max_width']            = 1024;
            // $config['max_height']           = 768;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('image')) {
                return $this->upload->data("file_name");
            }
    
            return "default.jpg";
        }
        function tampil(){
            // $query = $this->db->query("SELECT * FROM kelas");
            // return $query->result();
            return $this->db->get('lpj');
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
        public function ceklpj($where)
        {
            $this->db->where('id_kegiatan', $where);
            return $this->db->get('lpj');   
        }
    }




?>