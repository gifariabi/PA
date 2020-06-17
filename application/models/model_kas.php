<?php
class Model_kas extends CI_Model{

    public function getKas($where){
    	$this->db->select('id_kas, pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('idOrganisasi',$where);
        
        $this->db->order_by('id_kas', 'ASC');
        $query = $this->db->get();
        //if($query->num_rows() > 0) {
            return $query;
        //}
   	}

    public function getKas1($where){
        $this->db->select('id_kas,keterangan, pemasukan_kas,tanggal,pengeluaran_kas, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('idOrganisasi',$where);
        $this->db->WHERE('pemasukan_kas > 0');
        
        $this->db->order_by('id_kas', 'ASC');
        $query = $this->db->get();
        //if($query->num_rows() > 0) {
            return $query;
        //}
    }

    public function getKas2($where){
        $this->db->select('id_kas, pengeluaran_kas, keterangan, tanggal , idOrganisasi');
        $this->db->from('kas');
        $this->db->where('idOrganisasi',$where);
        $this->db->WHERE('pengeluaran_kas > 0');
        
        $this->db->order_by('id_kas', 'ASC');
        $query = $this->db->get();
        //if($query->num_rows() > 0) {
            return $query;
        //}
    }

   	public function edit_kas($where,$table){      
        return $this->db->get_where($table,$where);
    }

    public function update_kas($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    } 

    public function getTotalKas($where){
    	$this->db->select("(SUM(pemasukan_kas)-SUM(pengeluaran_kas)) as total_kas");
        $this->db->where('idOrganisasi',$where);
    	$this->db->from('kas');
    	$query = $this->db->get();
    	return $query;
    }

    public function getlaporan($where){
        $this->db->select("SUM(pemasukan_kas) as total_masuk, SUM(pengeluaran_kas) AS total_keluar,(SUM(pemasukan_kas)-SUM(pengeluaran_kas)) as total_kas ,idOrganisasi");
        $this->db->where('idOrganisasi', $where);
        $this->db->from('kas');
        $query = $this->db->get();
        return $query;
    }


    public function hapus_kas($where,$table){
        $this->db->delete($table,$where);
    }
//Bulan Untuk Kas
    public function get_januari($where){
        $this->db->select('id_kas, pemasukan_kas AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');

        $this->db->from('kas');
        $this->db->where('MONTH(tanggal) = 01');
        $this->db->WHERE('idOrganisasi',$where);
        $query = $this->db->get();
        return $query;
    }

    public function get_februari($where){
        $this->db->select('id_kas, pemasukan_kas AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('MONTH(tanggal) = 02');
        $this->db->WHERE('idOrganisasi',$where);
        $query = $this->db->get();
        return $query;
    }

    public function get_maret($where){
        $this->db->select('id_kas, pemasukan_kas AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('MONTH(tanggal) = 03');
        $this->db->WHERE('idOrganisasi',$where);
        $query = $this->db->get();
        return $query;
    }

    public function get_april($where){
        $this->db->select('id_kas, pemasukan_kas AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('MONTH(tanggal) = 04');
        $this->db->WHERE('idOrganisasi',$where);
        $query = $this->db->get();
        return $query;
    }

    public function get_mei($where){
        $this->db->select('id_kas, pemasukan_kas AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('MONTH(tanggal) = 05');
        $this->db->WHERE('idOrganisasi',$where);
        $query = $this->db->get();
        return $query;
    }

    public function get_juni($where){
        $this->db->select('id_kas, pemasukan_kas AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('MONTH(tanggal) = 06');
        $this->db->WHERE('idOrganisasi',$where);
        $query = $this->db->get();
        return $query;
    }

    public function get_juli($where){
        $this->db->select('id_kas, pemasukan_kas AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('MONTH(tanggal) = 07');
        $this->db->WHERE('idOrganisasi',$where);
        $query = $this->db->get();
        return $query;
    }

    public function get_agustus($where){
        $this->db->select('id_kas, pemasukan_kas AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('MONTH(tanggal) = 08');
        $this->db->WHERE('idOrganisasi',$where);
        $query = $this->db->get();
        return $query;
    }

    public function get_september($where){
        $this->db->select('id_kas, pemasukan_kas AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('MONTH(tanggal) = 09');
        $this->db->WHERE('idOrganisasi',$where);
        $query = $this->db->get();
        return $query;
    }

    public function get_oktober($where){
        $this->db->select('id_kas, pemasukan_kas, AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('MONTH(tanggal) = 10');
        $this->db->WHERE('idOrganisasi',$where);
        $query = $this->db->get();
        return $query;
    }

    public function get_november($where){
        $this->db->select('id_kas, pemasukan_kas, AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('MONTH(tanggal) = 11');
        $this->db->WHERE('idOrganisasi',$where);
        $query = $this->db->get();
        return $query;
    }

    public function get_desember($where){
        $this->db->select('id_kas, pemasukan_kas AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from('kas');
        $this->db->where('MONTH(tanggal) = 12');
        $this->db->WHERE('idOrganisasi',$where);
        $query = $this->db->get();
        return $query;
    }

    public function get_kasMasuk($where){
        $this->db->select('id_kas, pemasukan_kas AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from("kas");
        $this->db->where("pemasukan_kas > 0 ");
        $this->db->where('idOrganisasi', $where);
        $query = $this->db->get();
        return $query;
    }

    public function get_kasKeluar($where){
        $this->db->select('id_kas, pemasukan_kas AS pemasukan_kas, pengeluaran_kas as pengeluaran_kas, keterangan, tanggal, idOrganisasi');
        $this->db->from("kas");
        $this->db->where("pengeluaran_kas > 0 ");
        $this->db->where('idOrganisasi', $where);
        $query = $this->db->get();
        return $query;
    }

    public function insert($data,$table){
        $this->db->insert($table,$data);
    }
}