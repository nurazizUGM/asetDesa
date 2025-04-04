<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelMonitoring extends CI_Model
{

  public function getMonitoring()
  {
    $this->db->select('*');
    $this->db->from('monitoring_aset a');
    $this->db->join('asets b', 'b.id_aset = a.id_aset');
    $query = $this->db->get();
    return $query->result_array();
  }

  public function storeMonitoring($data)
  {
    $query = $this->db->insert('monitoring_aset', $data);
    return $query;
  }

  public function getDetailAset($id_monitoring)
  {
    $this->db->select('*');
    $this->db->from('monitoring_aset a');
    $this->db->join('asets b', 'b.id_aset = a.id_aset');
    $this->db->where('id_monitoring', $id_monitoring);
    $query = $this->db->get();
    return $query->result_array();
  }

  public function getDetailMonitoring($id_monitoring)
  {
    $this->db->select('*');
    $this->db->from('monitoring_aset a');
    $this->db->join('asets b', 'b.id_aset = a.id_aset');
    $this->db->where('id_monitoring', $id_monitoring);
    $query = $this->db->get();
    $monitoring = $query->row_array();
    if ($monitoring && isset($monitoring['kategori_aset'])) {
      switch ($monitoring['kategori_aset']) {
        case ModelAset::KATEGORI_TANAH:
          $this->db->select('*');
          $this->db->from('aset_tanah');
          $this->db->where('id_aset', $monitoring['id_aset']);
          $query = $this->db->get();
          $monitoring['detail'] = $query->row_array();
          break;
        case ModelAset::KATEGORI_PERALATAN:
          $this->db->select('*');
          $this->db->from('aset_peralatan_mesin');
          $this->db->where('id_aset', $monitoring['id_aset']);
          $query = $this->db->get();
          $monitoring['detail'] = $query->row_array();
          break;
        case ModelAset::KATEGORI_BANGUNAN:
          $this->db->select('*');
          $this->db->from('aset_gedung_bangunan');
          $this->db->where('id_aset', $monitoring['id_aset']);
          $query = $this->db->get();
          $monitoring['detail'] = $query->row_array();
          break;
      }
    }

    return $monitoring;
  }

  public function updateMonitoring($id_monitoring, $data)
  {
    $this->db->where(array('id_monitoring' => $id_monitoring));
    $res = $this->db->update('monitoring_aset', $data);
    return $res;
  }
}

/* End of file ModelMonitoring.php */
/* Location: ./application/models/ModelMonitoring.php */