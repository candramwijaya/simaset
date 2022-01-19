<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelAset extends CI_Model {

	public function get_id(){
		$this->db->select('id_increment,kode_kategori,id_aset');
		$this->db->from('asets');
		$this->db->join('barang','asets.id_barang=barang.id_barang');
		$this->db->join('kategori_barang','barang.id_kategori=kategori_barang.id_kategori');
		$this->db->where('kode_aset IS NULL');
		return $this->db->get();
	}

	public function getAsetWujud()
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->where('volume !=', 0);
		$this->db->where('volume >', 0);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getAsetWujudRow($id_aset)
	{
		$this->db->select('*');
		$this->db->from('asets');
		$this->db->where('id_aset', $id_aset);
		$query = $this->db->get();
		return $query->row_array(); 
	}

	public function getAsetDihapuskan()
	{
		$this->db->select('*');
		$this->db->from('penghapusan a');
		$this->db->join('asets b', 'b.id_aset = a.id_aset');
		$this->db->join('barang c', 'c.id_barang = b.id_barang');
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function storeAset($data)
	{
		$query = $this->db->insert('asets', $data);
		return $query;
	}

	public function searchAset($bar, $column)
	{
		$this->db->select('*');
		$this->db->limit(10);
		$this->db->from('barang');
		$this->db->like('nama_barang', $bar);
		$this->db->order_by('id_barang', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getDetailAsetWujud($id_aset)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');
		$this->db->join('satuan e', 'e.id_satuan = a.satuan_id');
		$this->db->join('users f', 'f.id_user = a.user_id');
		$this->db->join('sub_kategori g', 'g.kategori_id = d.id_kategori');
		$this->db->where('id_aset', $id_aset);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	public function getDetailAset($id_aset)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');
		$this->db->join('satuan e', 'e.id_satuan = a.satuan_id');
		$this->db->join('users f', 'f.id_user = a.user_id');
		$this->db->join('sub_kategori g', 'g.kategori_id = d.id_kategori');
		$this->db->where('id_aset', $id_aset);
		$query = $this->db->get();
		return $query->row_array(); 
	}

	public function getFilterAsetWujud($id_kategori,$tahun_perolehan,$kondisi)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');
		$this->db->where('b.id_kategori', $id_kategori);
		$this->db->where('tahun_perolehan', $tahun_perolehan);
		$this->db->where('kondisi', $kondisi);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getFilterAsetDihapuskan($id_kategori,$tgl_penghapusan)
	{
		$this->db->select('*');
		$this->db->from('penghapusan a');
		$this->db->join('asets b', 'b.id_aset = a.id_aset');
		$this->db->join('barang c', 'c.id_barang = b.id_barang');
		$this->db->where('id_kategori', $id_kategori);
		$this->db->where('YEAR(`tgl_penghapusan`)', $tgl_penghapusan);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function updateAset($id_aset,$data){
        $this->db->where(array('id_aset' => $id_aset));
        $res = $this->db->update('asets',$data);
        return $res;
    }

    public function deleteBarang($where)
	{
		$this->db->where($where);
		$res = $this->db->delete("asets");
		return $res;
	}

	public function totalAset()
	{
		$query = $this->db->get('asets');
		return $query->num_rows();
	}

	public function totalAsetWujud()
	{
		$this->db->select('*');
		$this->db->from('asets');
		$this->db->where('volume !=', 0);
		$this->db->where('volume >', 0);
		$query = $this->db->get();
		return $query->num_rows(); 
	}

	public function totalAsetHapuskan()
	{
		$this->db->select('*');
		$this->db->from('penghapusan');
		$query = $this->db->get();
		return $query->num_rows(); 
	}

	public function get_sub_aset($aset_id)
	{
		$this->db->select('*');
		$this->db->from('asets a');
		$this->db->join('barang b', 'b.id_barang = a.id_barang');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->join('kategori_barang d', 'd.id_kategori = b.id_kategori');
		$this->db->join('users e', 'e.id_user = a.user_id');
		$this->db->where('id_aset', $aset_id);
		$query = $this->db->get();

		return $query->result();
	}

}

/* End of file ModelAset.php */
/* Location: ./application/models/ModelAset.php */