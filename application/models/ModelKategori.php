<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelKategori extends CI_Model {

	public function getKategoriBarang()
	{
		$query = $this->db->get('kategori_barang');
		return $query->result_array();
	}

	public function storeKategoriBarang($data)
	{
		$query = $this->db->insert('kategori_barang', $data);
		return $query;
	}

	public function updateKategoriBarang($id_kategori,$data){
        $this->db->where(array('id_kategori' => $id_kategori));
        $res = $this->db->update('kategori_barang',$data);
        return $res;
    }

    public function deleteKategoriBarang($where)
	{
		$this->db->where($where);
		$res = $this->db->delete("kategori_barang");
		return $res;
	}

	//sub kategori
	public function getSubKategori()
	{
		$this->db->select('*');
		$this->db->from('sub_kategori a');
		$this->db->join('kategori_barang b', 'b.id_kategori = a.kategori_id');
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function updateSubKategori($kode_sub,$data){
        $this->db->where(array('kode_sub' => $kode_sub));
        $res = $this->db->update('sub_kategori',$data);
        return $res;
    }

	public function deleteSubKategori($where)
	{
		$this->db->where($where);
		$res = $this->db->delete("sub_kategori");
		return $res;
	}

	public function get_sub_category($id_kategori)
	{
		$this->db->select('*');
		$this->db->from('sub_kategori');
		$this->db->where('kategori_id', $id_kategori);
		$this->db->group_by('nama_sub');
		
        $query = $this->db->get();
		return $query;
	}

}

/* End of file ModelJenisBarang.php */
/* Location: ./application/models/ModelJenisBarang.php */