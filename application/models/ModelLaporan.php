<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelLaporan extends CI_Model {

	public function getAsetWujud($tahun_pengadaan)
	{
		$this->db->select('*');
		$this->db->from('asets a');
    if($tahun_pengadaan){
      $this->db->where('tahun_pengadaan', $tahun_pengadaan);
    }
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getAsetWujudExcel($tahun_pengadaan)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->where('tahun_pengadaan', $tahun_pengadaan);
		$query = $this->db->get();
		return $query->result(); 
	}

	public function getAsetDihapuskan($tahun_pengadaan)
	{
		$this->db->select('*');
		$this->db->from('asets');
		$this->db->where('tahun_pengadaan', $tahun_pengadaan);
		$this->db->where('deleted_at !=', NULL);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getAsetDihapuskanExcel($tahun_pengadaan)
	{
		$this->db->select('*');
		$this->db->from('asets');
		$this->db->where('tahun_pengadaan', $tahun_pengadaan);
		$this->db->where('deleted_at !=', NULL);
		$query = $this->db->get();
		return $query->result(); 
	}

	public function getAsetQr($id_lokasi,$tahun_pengadaan)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->where('volume !=', 0);
		$this->db->where('volume >', 0);
		$this->db->where('id_lokasi', $id_lokasi);
		$this->db->where('tahun_pengadaan', $tahun_pengadaan);
		$this->db->where('qr_code !=', NULL);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getLokasi()
	{
		$query = $this->db->get('lokasi_aset');
		return $query->result_array();
	}

	public function getLokasiId($id_lokasi)
	{
		$this->db->select('*');
		$this->db->from('lokasi_aset');
		$this->db->where('id_lokasi', $id_lokasi);
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getPengadaan($tahun_pengadaan)
	{
		$this->db->select('*');
		$this->db->from('pengadaan');
		$this->db->where('tahun_pengadaan', $tahun_pengadaan);
		$this->db->where('status', '1');
		$res = $this->db->get();
		return $res->result_array();
	}

	public function getPengadaanExcel($tahun_pengadaan)
	{
		$this->db->select('*');
		$this->db->from('pengadaan');
		$this->db->where('tahun_pengadaan', $tahun_pengadaan);
		$res = $this->db->get();
		return $res->result();
	}

}

/* End of file ModelLaporan.php */
/* Location: ./application/models/ModelLaporan.php */