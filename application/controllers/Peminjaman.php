<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {

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

		$this->load->model('ModelPeminjaman','mp');
	}

	public function index()
	{
		$data = array(
			'title' => 'Peminjaman Aset',
			'active_menu_peminjaman' => 'active',
			'item' => $this->mp->getDataPeminjaman()  
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('peminjaman/index',$data);
		$this->load->view('layouts/footer');
	}

	public function create()
	{
		$data = array(
			'title' => 'Tambah Peminjaman Aset',
			'active_menu_peminjaman' => 'active',
			'aset' => $this->ma->getAsetWujud(),  
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('peminjaman/create',$data);
		$this->load->view('layouts/footer');
	}

	public function store()
	{
		//cek jumlah
		$aset_id = $this->input->post('aset_id');
		$aset = $this->ma->getAsetWujudRow($aset_id);

		$jml_pinjam = $this->input->post('jml_pinjam');

		if ($jml_pinjam > $aset['volume']) {
			$this->session->set_flashdata('failed', 'Gagal.. Jumlah Peminjaman lebih dari Jumlah Aset');
			redirect('peminjaman/tambah');
		} else {
			$data = array(
				'aset_id' => $aset_id,
				'jml_pinjam' => $jml_pinjam,
				'kondisi_pinjam' =>$this->input->post('kondisi_pinjam'),
				'no_pinjam' =>$this->input->post('no_pinjam'),
				'tgl_pinjam' =>$this->input->post('tgl_pinjam'),
				'tgl_kembali' =>$this->input->post('tgl_kembali'),
				'status' =>$this->input->post('status')
			);
			$this->m->addData('peminjaman', $data);

			//update jumlah
			$total = $aset['volume'] - $jml_pinjam;
			$data_aset['volume'] = $total;
			$this->ma->updateAset($aset_id, $data_aset);

			$this->session->set_flashdata('sukses', 'Disimpan');
			redirect('peminjaman');
		}
		
	}

	public function edit($id)
	{
		$id = $this->uri->segment(3);

		$data = array(
			'title' => 'Ubah Peminjaman Aset',
			'active_menu_peminjaman' => 'active',
			'aset' => $this->ma->getAsetWujud(),
			'item' => $this->mp->getDetailPeminjaman($id),
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('peminjaman/edit',$data);
		$this->load->view('layouts/footer');
	}

	public function ubah()
	{
		$id = $this->input->post('id');

		$item = $this->mp->getDetailPeminjaman($id);

		//cek jumlah
		$aset_id = $this->input->post('aset_id');
		$aset = $this->ma->getAsetWujudRow($aset_id);

		$jml_pinjam = $this->input->post('jml_pinjam');

		if ($jml_pinjam == $item['jml_pinjam']) {
			$data = array(
				'aset_id' => $aset_id,
				'jml_pinjam' => $jml_pinjam,
				'kondisi_pinjam' =>$this->input->post('kondisi_pinjam'),
				'no_pinjam' =>$this->input->post('no_pinjam'),
				'tgl_pinjam' =>$this->input->post('tgl_pinjam'),
				'tgl_kembali' =>$this->input->post('tgl_kembali'),
				'status' =>$this->input->post('status')
			);
			$this->m->updateData($id,'peminjaman',$data);
			redirect('peminjaman');
		} else {
			if ($jml_pinjam > $aset['volume']) {
				$this->session->set_flashdata('failed', 'Gagal.. Jumlah Peminjaman lebih dari Jumlah Aset');
				redirect('peminjaman/edit/',$id);
			} else {
				$data = array(
					'aset_id' => $aset_id,
					'jml_pinjam' => $jml_pinjam,
					'kondisi_pinjam' =>$this->input->post('kondisi_pinjam'),
					'no_pinjam' =>$this->input->post('no_pinjam'),
					'tgl_pinjam' =>$this->input->post('tgl_pinjam'),
					'tgl_kembali' =>$this->input->post('tgl_kembali'),
					'status' =>$this->input->post('status')
				);
				$this->m->updateData($id,'peminjaman',$data);

				//update jumlah
				$total = $aset['volume'] - $jml_pinjam;
				$data_aset['volume'] = $total;
				$this->ma->updateAset($aset_id, $data_aset);

				$this->session->set_flashdata('sukses', 'Disimpan');
				redirect('peminjaman');
			}
		}
	}

	public function destroy($id)
	{
		$id = $this->uri->segment(3);
		$this->m->deleteData($id, 'peminjaman');
		$this->session->set_flashdata('sukses', 'Dihapus');
		redirect('peminjaman');
	}

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */