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
        public function tampil_pdf($where){
            $this->db->select('t.no_tiket, t.nama, t.nim, t.jurusan, t.email, t.jumlah, k.nama_kegiatan, k.waktu, k.tempat, k.qr_code');
            $this->db->from('tiket t');
            $this->db->join('kegiatan k','t.id_kegiatan = k.id_kegiatan');
            // $this->db->join('organisasi o','s.idOrganisasi =  o.idOrganisasi');
            $this->db->where('t.no_tiket', $where);

            $query = $this->db->get();
            //if($query->num_rows() > 0) {
                return $query;
            //}
        }
        public function tampil_tiket($where){
            $this->db->select('t.no_tiket, t.nama, t.nim, t.jurusan, t.email, t.jumlah, t.total, t.metode_pembayaran, t.status');
            $this->db->from('tiket t');
            $this->db->join('kegiatan k','t.id_kegiatan = k.id_kegiatan');
            $this->db->join('programkerja p','k.id_programkerja = p.id_programkerja');
            $this->db->join('organisasi o','o.idOrganisasi = p.idOrganisasi');
            $this->db->join('ang_organisasi a','a.idOrganisasi = o.idOrganisasi');
            // $this->db->join('organisasi o','s.idOrganisasi =  o.idOrganisasi');
            $this->db->where('a.nim', $where);

            $query = $this->db->get();
            //if($query->num_rows() > 0) {
                return $query;
            //}
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