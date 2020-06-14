<?php 
    class Tiket_model extends CI_Model{
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
            $this->db->select('t.no_tiket, t.nama, t.nim, t.jurusan, t.email, FORMAT(t.total,0) as total, k.nama_kegiatan, k.waktu, k.tempat, k.qr_code');
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
            $this->db->select('no_tiket, nama, nimAkun, nim, jurusan, email, FORMAT(total,0) AS total, metode_pembayaran, status');
            $this->db->from('tiket ');
            // $this->db->join('kegiatan k','t.id_kegiatan = k.id_kegiatan');
            // $this->db->join('programkerja p','k.id_programkerja = p.id_programkerja');
            // $this->db->join('organisasi o','o.idOrganisasi = p.idOrganisasi');
            // $this->db->join('ang_organisasi a','a.idOrganisasi = o.idOrganisasi');
            // $this->db->join('mahasiswa m','m.nim = a.nim');
            // $this->db->join('organisasi o','s.idOrganisasi =  o.idOrganisasi');
            $this->db->where('nimAkun', $where);

            $query = $this->db->get();
            // if($query->num_rows() > 0) {
                return $query;
            // }
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
        function edit($where2){
            $this->db->select('');
            $this->db->from('kegiatan k');
            $this->db->join('programkerja p','k.id_programkerja = p.id_programkerja');
            $this->db->join('organisasi o', 'p.idOrganisasi = o.idOrganisasi');
            $this->db->join('ang_organisasi a','a.idOrganisasi = o.idOrganisasi');
            $this->db->join('mahasiswa m','a.nim = m.nim');

            // $this->db->where('k.id_kegiatan', $where);
            $this->db->where('m.nim', $where2);

            $query =$this->db->get();
            return $query;
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
            $query = $this->db->query("SELECT t.no_tiket, t.nim, t.nama,t.jurusan, t.email, k.nama_kegiatan,FORMAT(total,0) AS total, metode_pembayaran, status FROM tiket t JOIN kegiatan k ON t.id_kegiatan = k.id_kegiatan");
            //$this->db->where('namaLengkap',$nama);
            return $query->result();
        }
        function cekTiket($nim, $idKegiatan){
            $sql = "SELECT EXISTS(SELECT * FROM tiket WHERE nim = '$nim' AND id_kegiatan = $idKegiatan) as cekTiket";

            $query = $this->db->query($sql);
            return $query;
        }
    }
?>