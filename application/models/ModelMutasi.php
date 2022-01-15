<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelMutasi extends CI_Model {

	public function getDataMutasi()
	{
		$this->db->select('*');
		$this->db->from('mutasi a');
		$this->db->join('asets b', 'b.id_aset = a.aset_id');
		$this->db->join('users c', 'c.id_user = a.user_id');
		$this->db->join('lokasi_aset d', 'd.id_lokasi = a.lokasi_id');
		$this->db->join('barang e', 'e.id_barang = b.id_barang');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getDetailMutasi($id)
	{
		$this->db->select('*');
		$this->db->from('mutasi a');
		$this->db->join('asets b', 'b.id_aset = a.aset_id');
		$this->db->join('users c', 'c.id_user = a.user_id');
		$this->db->join('lokasi_aset d', 'd.id_lokasi = a.lokasi_id');
		$this->db->join('barang e', 'e.id_barang = b.id_barang');
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		return $query->row_array(); 
	}

}

/* End of file ModelBarang.php */
/* Location: ./application/models/ModelBarang.php */