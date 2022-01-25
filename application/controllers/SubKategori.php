<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SubKategori extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Master','m');
		$this->load->model('ModelKategori','mk');
	}

	public function index()
	{
		$data = array(
			'title' => 'Sub Kategori Barang',
			'active_menu_master' => 'menu-open',
			'active_menu_mst' => 'active',
			'active_menu_sk' => 'active',
			'item' => $this->mk->getSubKategori(),
			'jb' => $this->mk->getKategoriBarang() 
		);
	
		$this->load->view('layouts/header',$data);
		$this->load->view('master/sub-kategori/index');
		$this->load->view('layouts/footer');
	}

	public function filter()
	{
		$data = array(
			'title' => 'Sub Kategori Barang',
			'active_menu_master' => 'menu-open',
			'active_menu_mst' => 'active',
			'active_menu_sk' => 'active',
			'item' => $this->mk->getSubKategori(),
			'jb' => $this->mk->getfilterKategoriBarang() 
		);
	
		$this->load->view('layouts/header',$data);
		$this->load->view('master/sub-kategori/index');
		$this->load->view('layouts/footer');
	}

	public function store()
	{
		$data = array(
			'kode_sub' => $this->input->post('kode_sub'),
			'nama_sub' => $this->input->post('nama_sub'),
			'kategori_id' => $this->input->post('kategori_id')
		);

		$this->m->addData('sub_kategori', $data);

		$this->session->set_flashdata('sukses', 'Disimpan');
		redirect('sub-kategori');
	}

	public function ubah()
	{
		$kode_sub = $this->input->post('kode_sub');
		$data = array(
			'nama_sub' => $this->input->post('nama_sub'),
			'kategori_id' => $this->input->post('kategori_id') 
		);

		$this->mk->updateSubKategori($kode_sub,$data);

		$this->session->set_flashdata('sukses', 'Diubah');
		redirect('sub-kategori');

	}

	public function hapus($kode_sub)
	{
		$kode_sub = $this->uri->segment(3);
		$where = array( 'kode_sub' => $kode_sub );
		$this->mk->deleteSubKategori($where);

		$this->session->set_flashdata('sukses', 'Dihapus');
		redirect('sub-kategori');
	}

	public function get_sub_kategori()
	{
		$id_kategori = $this->input->post('id_kategori',TRUE);
        $data = $this->mk->get_sub_category($id_kategori)->result();
        echo json_encode($data);
	}

}

/* End of file JenisBarang.php */
/* Location: ./application/controllers/JenisBarang.php */