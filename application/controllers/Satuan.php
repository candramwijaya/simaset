<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Satuan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('Master','m');
		$this->load->model('ModelKategori','mk');
	}

	public function index()
	{
		$data = array(
			'title' => 'Satuan',
			'active_menu_master' => 'menu-open',
			'active_menu_mst' => 'active',
			'active_menu_st' => 'active',
			'item' => $this->m->getAllData('satuan'),
		);
	
		$this->load->view('layouts/header',$data);
		$this->load->view('master/satuan/index');
		$this->load->view('layouts/footer');
	}

	public function store()
	{
		$data = array(
			'id_satuan' => $this->input->post('id_satuan'),
			'nama_satuan' => $this->input->post('nama_satuan'),
		);

		$this->m->addData('satuan', $data);

		$this->session->set_flashdata('sukses', 'Disimpan');
		redirect('satuan');
	}

	public function ubah()
	{
		$id_satuan = $this->input->post('id_satuan');
		$data = array(
			'nama_satuan' => $this->input->post('nama_satuan'),
		);

		$this->m->updateDataID('id_satuan', $id_satuan, 'satuan', $data);

		$this->session->set_flashdata('sukses', 'Diubah');
		redirect('satuan');

	}

	public function hapus($id_satuan)
	{
		$id_satuan = $this->uri->segment(3);
		$this->m->deleteDataID('id_satuan', $id_satuan, 'satuan');

		$this->session->set_flashdata('sukses', 'Dihapus');
		redirect('satuan');
	}

}

/* End of file JenisBarang.php */
/* Location: ./application/controllers/JenisBarang.php */