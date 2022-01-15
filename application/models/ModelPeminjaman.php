<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPeminjaman extends CI_Model {

	public function getDataPeminjaman()
	{
		$this->db->select('*');
		$this->db->from('peminjaman a');
		$this->db->join('asets b', 'b.id_aset = a.aset_id');
		$this->db->join('barang c', 'c.id_barang = b.id_barang');
		$this->db->order_by('id', 'desc');
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getDetailPeminjaman($id)
	{
		$this->db->select('*');
		$this->db->from('peminjaman a');
		$this->db->join('asets b', 'b.id_aset = a.aset_id');
		$this->db->join('barang c', 'c.id_barang = b.id_barang');
		$this->db->where('id', $id);
		
		$query = $this->db->get();
		return $query->row_array(); 
	}

}

/* End of file ModelBarang.php */
/* Location: ./application/models/ModelBarang.php */