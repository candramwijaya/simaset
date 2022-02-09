<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPengadaan extends CI_Model {

	public function getSpesifikasi()
	{
		$query = $this->db->get('kriteria_spesifikasi');
		return $query->result_array();
	}

	public function getKualitas()
	{
		$query = $this->db->get('kriteria_kualitas');
		return $query->result_array();
	}

	public function getAset()
	{
		$query = $this->db->get('data_aset');
		return $query->result_array();
	}

	public function getPenilaian()
	{
		$this->db->select('id_nilai, a.id_spesifikasi as id_spek, a.id_kualitas as id_kual, a.id_aset as id_as, nama_aset, harga, c.keterangan as ket_spek, c.nilai as nilai_spek, d.nilai as nilai_kualitas, d.keterangan as ket_nilai');
		$this->db->from('keputusan_pengadaan a');
		$this->db->join('data_aset b', 'b.id_aset = a.id_aset');
		$this->db->join('kriteria_spesifikasi c', 'c.id_spesifikasi = a.id_spesifikasi');
		$this->db->join('kriteria_kualitas d', 'd.id_kualitas = a.id_kualitas');
		$this->db->order_by('id_nilai', 'asc');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getPenilaians()
	{
		$this->db->select('id_nilai, a.id_spesifikasi as id_spek, a.id_kualitas as id_kual, a.id_aset as id_as, nama_aset, harga, c.keterangan as ket_spek, c.nilai as nilai_spek, d.nilai as nilai_kualitas, d.keterangan as ket_nilai');
		$this->db->from('keputusan_pengadaan a');
		$this->db->join('data_aset b', 'b.id_aset = a.id_aset');
		$this->db->join('kriteria_spesifikasi c', 'c.id_spesifikasi = a.id_spesifikasi');
		$this->db->join('kriteria_kualitas d', 'd.id_kualitas = a.id_kualitas');
		$this->db->order_by('id_nilai', 'asc');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getMaxSpesifikasi()
	{
		$this->db->select('MAX(nilai) as maks_spek');
		$this->db->from('kriteria_spesifikasi');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getMaxKualitas()
	{
		$this->db->select('MAX(nilai) as maks_kualitas');
		$this->db->from('kriteria_kualitas');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getMinHarga()
	{
		$this->db->select('MIN(harga) as min_harga');
		$this->db->from('data_aset');
		$query = $this->db->get();
		return $query->row_array();
	}

	public function getPengadaanAset()
	{
		$this->db->select('*');
		$this->db->from('pengadaan a');
		$this->db->join('users b', 'b.id_user = a.id_user');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getPengadaanAset_new($status)
	{
		$this->db->select('nama_barang,nama_sub,nama_kategori,a.nama_item,a.tahun_pengadaan, a.id_pengadaan,a.volume,a.satuan,a.harga_satuan');
		$this->db->from('pengadaan a');
		$this->db->join('barang b', 'b.id_barang = a.nama_item');
		$this->db->join('sub_kategori c', 'c.kode_sub = b.id_sub_kategori');
		$this->db->join('kategori_barang d', 'd.id_kategori = c.kategori_id');
		$this->db->where('status_keranjang',$status);
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$query = $this->db->get();
		return $query->result_array();
	}
	public function getPengadaanAset_new1($status)
	{
		$this->db->select('nama_barang,nama_sub,nama_kategori,a.nama_item,a.tahun_pengadaan, a.id_pengadaan,a.volume,a.satuan,a.harga_satuan');
		$this->db->from('pengadaan a');
		$this->db->join('barang b', 'b.id_barang = a.nama_item');
		$this->db->join('sub_kategori c', 'c.kode_sub = b.id_sub_kategori');
		$this->db->join('kategori_barang d', 'd.id_kategori = c.kategori_id');
		$this->db->where('status_keranjang','1');
		$this->db->where('tgl_keranjang',$status);
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getPengadaanlihat($tgl=null){
		$this->db->select('a.tgl_keranjang,nama_user,jabatan_user,count(a.tgl_keranjang) as Jumlah,SUM(harga_satuan*volume) as total,status');
		$this->db->from('pengadaan a');
		$this->db->join('users b', 'b.id_user = a.id_user');
		$this->db->join('pengadaan_unik c','a.tgl_keranjang=c.tgl_keranjang');
		$this->db->where('status_keranjang','1');
		$this->db->where('a.id_user',$this->session->userdata('id_user'));
		if(!empty($tgl)){
			$this->db->where('a.tgl_keranjang',$tgl);
		}
		$this->db->group_by('1,2,3');
		return $this->db->get();
	}

	public function update_PengajuanPengadaan($id,$data){
		$this->db->where('id_user',$id);
		$this->db->where('status_keranjang','0');
        $res = $this->db->update('pengadaan',$data);
        return $res;
	}

	public function getPengadaanAsetUser($id_user)
	{
		$this->db->select('*');
		$this->db->from('pengadaan a');
		$this->db->join('users b', 'b.id_user = a.id_user');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->where('a.id_user', $id_user);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getDetailPengadaanAset($id_pengadaan)
	{
		$this->db->select('*');
		$this->db->from('pengadaan a');
		$this->db->join('users b', 'b.id_user = a.id_user');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->where('id_pengadaan', $id_pengadaan);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function getDetailPengadaanAset_new($id_pengadaan)
	{
		$this->db->select('nama_barang,nama_sub,nama_kategori,a.nama_item,a.tahun_pengadaan, a.id_pengadaan,a.volume,a.satuan,a.harga_satuan,c.kategori_id,b.id_sub_kategori');
		$this->db->from('pengadaan a');
		$this->db->join('barang b', 'b.id_barang = a.nama_item');
		$this->db->join('sub_kategori c', 'c.kode_sub = b.id_sub_kategori');
		$this->db->join('kategori_barang d', 'd.id_kategori = c.kategori_id');
		$this->db->where('id_pengadaan', $id_pengadaan);
		$this->db->where('status_keranjang','0');
		$this->db->where('id_user',$this->session->userdata('id_user'));
		$query = $this->db->get();
		return $query->row();
	}

	public function getFilterPengadaanAset($id_lokasi,$tahun_pengadaan)
	{
		$this->db->select('*');
		$this->db->from('pengadaan a');
		$this->db->join('users b', 'b.id_user = a.id_user');
		$this->db->join('lokasi_aset c', 'c.id_lokasi = a.id_lokasi');
		$this->db->where('a.id_lokasi', $id_lokasi);
		$this->db->where('tahun_pengadaan', $tahun_pengadaan);
		$query = $this->db->get();
		return $query->result_array();
	}

	public function storeAset($data)
	{
		$query = $this->db->insert('data_aset', $data);
		return $query;
	}

	public function storePenilaian($data)
	{
		$query = $this->db->insert('keputusan_pengadaan', $data);
		return $query;
	}

	public function storePengadaan($data)
	{
		$query = $this->db->insert('pengadaan', $data);
		return $query;
	}
	public function insert_data($table,$data)
	{
		$query = $this->db->insert($table, $data);
		return $query;
	}

	public function updateSpesifikasi($id_spesifikasi,$data){
        $this->db->where(array('id_spesifikasi' => $id_spesifikasi));
        $res = $this->db->update('kriteria_spesifikasi',$data);
        return $res;
    }

    public function updateKualitas($id_kualitas,$data){
        $this->db->where(array('id_kualitas' => $id_kualitas));
        $res = $this->db->update('kriteria_kualitas',$data);
        return $res;
    }

    public function updateAset($id_aset,$data){
        $this->db->where(array('id_aset' => $id_aset));
        $res = $this->db->update('data_aset',$data);
        return $res;
    }

    public function updatePenilaian($id_nilai,$data){
        $this->db->where(array('id_nilai' => $id_nilai));
        $res = $this->db->update('keputusan_pengadaan',$data);
        return $res;
    }

    public function updatePengadaan($id_pengadaan,$data){
        $this->db->where(array('id_pengadaan' => $id_pengadaan));
        $res = $this->db->update('pengadaan',$data);
        return $res;
    }

    public function deleteAset($where)
	{
		$this->db->where($where);
		$res = $this->db->delete("data_aset");
		return $res;
	}

	public function deletePenilaian($where)
	{
		$this->db->where($where);
		$res = $this->db->delete("keputusan_pengadaan");
		return $res;
	}

	public function deletePengadaan($where)
	{
		$this->db->where($where);
		$res = $this->db->delete("pengadaan");
		return $res;
	}

	public function deletePengadaan_new($where,$data)
	{
		$this->db->where($where);
		$res = $this->db->update("pengadaan",$data);
		return $res;
	}

}

/* End of file ModelPengadaan.php */
/* Location: ./application/models/ModelPengadaan.php */