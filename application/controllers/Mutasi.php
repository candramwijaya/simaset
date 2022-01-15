<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("logged")<>1) {
	      redirect(site_url('login'));
	    }

		//load model
		$this->load->model('ModelAset','ma');
		$this->load->model('ModelMutasi','mt');
		$this->load->model('ModelLokasi','ml');
		$this->load->model('Master','m');
	}

	public function index()
	{
		$data = array(
			'title' => 'Mutasi Aset',
			'active_menu_mutasi' => 'active',
			'item' => $this->mt->getDataMutasi()  
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('mutasi/index',$data);
		$this->load->view('layouts/footer');
	}

	public function create()
	{
		$data = array(
			'title' => 'Tambah Mutasi Aset',
			'active_menu_mutasi' => 'active',
			'aset' => $this->ma->getAsetWujud(),
			'user' => $this->m->getAllData('users'),
			'lokasi' => $this->ml->getLokasi(),  
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('mutasi/create',$data);
		$this->load->view('layouts/footer');
	}

	public function store()
	{
		$aset_id = $this->input->post('aset_id');

		$data = array(
			'aset_id' => $this->input->post('aset_id'), 
			'nama_user_m' =>$this->input->post('nama_user_m'), 
			'lokasi_m' => $this->input->post('lokasi_m'), 
			'user_id' => $this->input->post('user_id'), 
			'lokasi_id' => $this->input->post('lokasi_id'), 
			'tgl_mutasi' => $this->input->post('tgl_mutasi'), 
			'status' => $this->input->post('status'), 
		);

		//update data aset
		$aset = array(
			'user_id' => $this->input->post('user_id'), 
			'id_lokasi' => $this->input->post('lokasi_id'), 
		);

		$this->ma->updateAset($aset_id,$aset);

		//insert data aset
		$this->m->addData('mutasi', $data);

		$this->session->set_flashdata('sukses', 'Disimpan');
		redirect('mutasi');
	}

	public function edit($id)
	{
		$id = $this->uri->segment(3);

		$data = array(
			'title' => 'Mutasi Aset',
			'active_menu_mutasi' => 'active', 
			'aset' => $this->ma->getAsetWujud(),
			'user' => $this->m->getAllData('users'),
			'lokasi' => $this->ml->getLokasi(),
			'item' => $this->mt->getDetailMutasi($id),
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('mutasi/edit',$data);
		$this->load->view('layouts/footer');
	}

	public function ubah()
	{
		$id = $this->input->post('id');
		
		$aset_id = $this->input->post('aset_id');

		$data = array(
			'aset_id' => $aset_id, 
			'nama_user_m' =>$this->input->post('nama_user_m'), 
			'lokasi_m' => $this->input->post('lokasi_m'), 
			'user_id' => $this->input->post('user_id'), 
			'lokasi_id' => $this->input->post('lokasi_id'), 
			'tgl_mutasi' => $this->input->post('tgl_mutasi'), 
			'status' => $this->input->post('status'), 
		);

		//update aset
		$aset = array(
			'user_id' => $this->input->post('user_id'), 
			'id_lokasi' => $this->input->post('lokasi_id'), 
		);

		$this->ma->updateAset($aset_id,$aset);

		$this->m->updateData($id,'mutasi',$data);

		$this->session->set_flashdata('sukses', 'Diubah');
		redirect('mutasi');
	}

	public function destroy($id)
	{
		$id = $this->uri->segment(3);
		$this->m->deleteData($id, 'mutasi');
		$this->session->set_flashdata('sukses', 'Dihapus');
		redirect('mutasi');
	}

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */