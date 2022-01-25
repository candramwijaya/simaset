<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriBarang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('ModelKategori','mk');
	}

	public function index()
	{
		$data = array(
			'title' => 'Jenis Barang',
			'active_menu_master' => 'menu-open',
			'active_menu_mst' => 'active',
			'active_menu_jb' => 'active',
			'jb' => $this->mk->getKategoriBarang()  
		);
	
		$this->load->view('layouts/header',$data);
		$this->load->view('master/v_jb1',$data);
		$this->load->view('layouts/footer');
	}
	public function filter()
	{
		
		$data = array(
			'title' => 'Jenis Barang',
			'active_menu_master' => 'menu-open',
			'active_menu_mst' => 'active',
			'active_menu_jb' => 'active',
			'jb' => $this->mk->getfilterKategoriBarang($this->input->post('kata_kunci'))  
		);

		

		$this->load->view('layouts/header',$data);
		$this->load->view('master/v_jb1',$data);
		$this->load->view('layouts/footer');
	}
	public function search()
	{
		
		$data = array(
			'title' => 'Jenis Barang',
			'active_menu_master' => 'menu-open',
			'active_menu_mst' => 'active',
			'active_menu_jb' => 'active',
			'jb' => $this->mk->getfilterKategoriBarang($this->input->post('kata_kunci'))  
		);

		// Kita load file view.php sambil mengirim data siswa hasil query function search di SiswaModel
		$hasil = $this->load->view('master/vfil_jb', array('kategori'=>$data), true);
	
		// Buat sebuah array
		$callback = array(
			'hasil' => $hasil, // Set array hasil dengan isi dari view.php yang diload tadi
		);

		echo json_encode($callback); // konversi varibael $callback menjadi JSON

		// $this->load->view('layouts/header',$data);
		// $this->load->view('master/v_jb',$data);
		// $this->load->view('layouts/footer');
	}

	public function store()
	{
		$data = array(
			'kode_kategori' => $this->input->post('kode_kategori'),
			'nama_kategori' => $this->input->post('nama_kategori'),
			'updated_at' => date('Y-m-d H:i:s') 
		);

		$result = $this->mk->storeKategoriBarang($data);

		if($result>=1){
			$this->session->set_flashdata('sukses', 'Disimpan');
			redirect('kategori');
		}else{
			$this->session->set_flashdata('gagal', 'Disimpan');
			redirect('kategori');
		}
	}

	public function ubah()
	{
		$id_kategori = $this->input->post('id_kategori');
		$data = array(
			'kode_kategori' => $this->input->post('kode_kategori'),
			'nama_kategori' => $this->input->post('nama_kategori'),
			'updated_at' => date('Y-m-d H:i:s') 
		);
		unset($data['id_kategori']);
		$result = $this->mk->updateKategoriBarang($id_kategori,$data);

		if($result>=1){
			$this->session->set_flashdata('sukses', 'Diubah');
			redirect('kategori');
		}else{
			$this->session->set_flashdata('gagal', 'Diubah');
			redirect('kategori');
		}
	}

	public function hapus($id_kategori)
	{
		$id_kategori = $this->uri->segment(3);
		$where = array( 'id_kategori' => $id_kategori );
		$res = $this->mk->deleteKategoriBarang($where);
		if($res>=1){
			$this->session->set_flashdata('sukses', 'Dihapus');
			redirect('kategori');
		}else{
			$this->session->set_flashdata('gagal', 'Dihapus');
			redirect('kategori');
		}
	}

}

/* End of file JenisBarang.php */
/* Location: ./application/controllers/JenisBarang.php */