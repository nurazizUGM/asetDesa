<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelStatistik extends CI_Model
{

  public function getKondisiAset()
  {
    $this->db->select('COUNT(kondisi) as kon');
    $this->db->from('asets');
    $this->db->where('volume !=', 0);
    $this->db->where('volume >', 0);
    $this->db->group_by('kondisi');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      foreach ($query->result() as $data) {
        $hasil[] = $data;
      }
      return $hasil;
    }
  }

  public function getJenisAset()
  {
    $this->db->select('COUNT(status_aset) as status');
    $this->db->from('asets a');
    $this->db->group_by('status_aset');
    $query = $this->db->get();

    if ($query->num_rows() > 0) {
      foreach ($query->result() as $data) {
        $hasil[] = $data;
      }
      return $hasil;
    }
  }

  public function getNamaKategoriAset()
  {
    return [
      ModelAset::KATEGORI_TANAH,
      ModelAset::KATEGORI_PERALATAN,
      ModelAset::KATEGORI_BANGUNAN,
    ];
  }

  public function getKodeKategoriAset()
  {
    $this->db->select('COUNT(*) AS count, kategori_aset');
    $this->db->from('asets a');
    $this->db->group_by('kategori_aset');
    $this->db->where('deleted_at', NULL);
    $query = $this->db->get();

    $result = [
      ModelAset::KATEGORI_TANAH => 0,
      ModelAset::KATEGORI_PERALATAN => 0,
      ModelAset::KATEGORI_BANGUNAN => 0,
    ];
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $data) {
        $result[$data->kategori_aset] = intval($data->count);
      }
    }
    
    return [
      $result[ModelAset::KATEGORI_TANAH],
      $result[ModelAset::KATEGORI_PERALATAN],
      $result[ModelAset::KATEGORI_BANGUNAN]
    ];
  }

  public function getAsetWujud()
  {
    $this->db->select('*');
    $this->db->from('asets a');
    $this->db->where('deleted_at', NULL);
    $query = $this->db->get();
    return $query->num_rows();
  }

  public function countAsetHapus()
  {
    $this->db->select('count(*) as hapus');
    $this->db->from('asets a');
    $this->db->where('deleted_at !=', NULL);
    $query = $this->db->get();

    if ($query->num_rows() == 0) {
      return 0;
    }
    $result = $query->row();
    return $result->hapus;
  }
}

/* End of file ModelStatistik.php */
/* Location: ./application/models/ModelStatistik.php */