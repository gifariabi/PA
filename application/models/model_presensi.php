<?php
class model_presensi extends CI_Model{
	
		
	function tampilPresensi($where){
        $this->db->distinct();
		$this->db->select('m.nama, m.nim, k.nama_kegiatan, waktu, status, tempat, waktu_submit, prodi');
        $this->db->from('kegiatan k');
        $this->db->join('presensi p','k.id_kegiatan =  p.id_kegiatan');
        $this->db->join('mahasiswa m','p.nim =  m.nim');
        $this->db->where('k.id_kegiatan',$where);

        $query = $this->db->get();
       	//if($query->num_rows() > 0) {
        return $query->result();
    	//}
	}
}
?>