<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengadaan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		if ($this->session->userdata("logged")<>1) {
	      redirect(site_url('login'));
	    }

	    //load model
	    $this->load->model('ModelPengadaan','mp');
	    $this->load->model('ModelLokasi','ml');
	    $this->load->model('ModelMonitoring','mm');
		$this->load->model('Master','m');
		$this->load->model('ModelKategori','mk');
		$this->load->model('ModelBarang','mb');
		$this->load->model('ModelUser','mu');

	}

	public function index()
	{
		$data = array(
			'title' => 'Data Kriteria',
			'active_menu_kp' => 'menu-open',
			'active_menu_kpn' => 'active',
			'active_menu_dk' => 'active',
			'spek' => $this->mp->getSpesifikasi(),
			'klts' => $this->mp->getKualitas()  
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('pengadaan/v_kriteria',$data);
		$this->load->view('layouts/footer');
	}

	public function ubahSpesifikasi()
	{
		$id_spesifikasi = $this->input->post('id_spesifikasi');
		$data = array(
			'keterangan' => $this->input->post('keterangan'),
			'nilai' => $this->input->post('nilai')
		);
		unset($data['id_spesifikasi']);
		$result = $this->mp->updateSpesifikasi($id_spesifikasi,$data);

		if($result>=1){
			$this->session->set_flashdata('sukses', 'Diubah');
			redirect('kriteria');
		}else{
			$this->session->set_flashdata('gagal', 'Diubah');
			redirect('kriteria');
		}
	}

	public function ubahKualitas()
	{
		$id_kualitas = $this->input->post('id_kualitas');
		$data = array(
			'keterangan' => $this->input->post('keterangan'),
			'nilai' => $this->input->post('nilai')
		);
		unset($data['id_kualitas']);
		$result = $this->mp->updateKualitas($id_kualitas,$data);

		if($result>=1){
			$this->session->set_flashdata('sukses', 'Diubah');
			redirect('kriteria');
		}else{
			$this->session->set_flashdata('gagal', 'Diubah');
			redirect('kriteria');
		}
	}

	public function aset()
	{
		$data = array(
			'title' => 'Data Aset',
			'active_menu_kp' => 'menu-open',
			'active_menu_kpn' => 'active',
			'active_menu_da' => 'active',
			'aset' => $this->mp->getAset(),
			'spek' => $this->mp->getSpesifikasi(),
			'klts' => $this->mp->getKualitas(),
			'nilai' => $this->mp->getPenilaian()  
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('pengadaan/v_aset',$data);
		$this->load->view('layouts/footer');
	}

	public function simpanAset()
	{
		$data = $this->input->post(null,true);
		$result = $this->mp->storeAset($data);
		if($result>=1){
			$this->session->set_flashdata('sukses', 'Disimpan');
			redirect('data_aset');
		}else{
			$this->session->set_flashdata('gagal', 'Disimpan');
			redirect('data_aset');
		}
	}

	public function ubahAset()
	{
		$id_aset = $this->input->post('id_aset');
		$data = $this->input->post(null,true);
		unset($data['id_aset']);
		$result = $this->mp->updateAset($id_aset,$data);

		if($result>=1){
			$this->session->set_flashdata('sukses', 'Diubah');
			redirect('data_aset');
		}else{
			$this->session->set_flashdata('gagal', 'Diubah');
			redirect('data_aset');
		}
	}

	public function hapusAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);
		$where = array( 'id_aset' => $id_aset );
		$res = $this->mp->deleteAset($where);
		if($res>=1){
			$this->session->set_flashdata('sukses', 'Dihapus');
			redirect('data_aset');
		}else{
			$this->session->set_flashdata('gagal', 'Dihapus');
			redirect('data_aset');
		}
	}

	public function simpanPenilaian()
	{
		$data = $this->input->post(null,true);
		$result = $this->mp->storePenilaian($data);
		if($result>=1){
			$this->session->set_flashdata('sukses', 'Disimpan');
			redirect('data_aset');
		}else{
			$this->session->set_flashdata('gagal', 'Disimpan');
			redirect('data_aset');
		}
	}

	public function ubahPenilaian()
	{
		$id_nilai = $this->input->post('id_nilai');
		$data = $this->input->post(null,true);
		unset($data['id_nilai']);
		$result = $this->mp->updatePenilaian($id_nilai,$data);
		if($result>=1){
			$this->session->set_flashdata('sukses', 'Diubah');
			redirect('data_aset');
		}else{
			$this->session->set_flashdata('gagal', 'Diubah');
			redirect('data_aset');
		}
	}

	public function hapusPenilaian($id_nilai)
	{
		$id_nilai = $this->uri->segment(3);
		$where = array( 'id_nilai' => $id_nilai );
		$res = $this->mp->deletePenilaian($where);
		if($res>=1){
			$this->session->set_flashdata('sukses', 'Dihapus');
			redirect('data_aset');
		}else{
			$this->session->set_flashdata('gagal', 'Dihapus');
			redirect('data_aset');
		}
	}

	public function spk()
	{
		$data = array(
			'title' => 'Data Aset',
			'active_menu_kp' => 'menu-open',
			'active_menu_kpn' => 'active',
			'active_menu_spk' => 'active',
			'nilai' => $this->mp->getPenilaian(),
			'maxspek' => $this->mp->getMaxSpesifikasi(),
			'maxkual' => $this->mp->getMaxKualitas(),
			'minharga' => $this->mp->getMinHarga()  
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('pengadaan/v_spk',$data);
		$this->load->view('layouts/footer');
	}

	//Pengadaan
	public function pengajuan($id=null)
	{
		if($id==null){
		$data = array(
			'title' => 'Pengajuan',
			'active_menu_open_pnd' => 'menu-open',
			'active_pengadaan' => 'active',
			'active_menu_pnd' => 'active',
			'kategori' => $this->mk->getKategoriBarang(),
			'nilai' => $this->mp->getPenilaian(),
			'maxspek' => $this->mp->getMaxSpesifikasi(),
			'maxkual' => $this->mp->getMaxKualitas(),
			'minharga' => $this->mp->getMinHarga(),
			'mt' => $this->mm->getMonitoring(),
			'satuan' => $this->m->getAllData('satuan'),
			'item' => $this->mp->getPengadaanAset_new('0'),
			'user' => $this->m->getAllData('users'),  
		);
		}else{
			$cek = $this->mp->getDetailPengadaanAset_new($id);
			if(!empty($cek->kategori_id)){
			$data = array(
			'id_unik' => $id,
			'data_pengadaan' => $this->mp->getDetailPengadaanAset_new($id),
			'data_sub_kategori' => $this->mk->get_sub_category($cek->kategori_id)->result_array(),
			'data_barang' => $this->mb->get_barangsub($cek->id_sub_kategori),
			'title' => 'Pengajuan',
			'active_menu_open_pnd' => 'menu-open',
			'active_pengadaan' => 'active',
			'active_menu_pnd' => 'active',
			'kategori' => $this->mk->getKategoriBarang(),
			'nilai' => $this->mp->getPenilaian(),
			'maxspek' => $this->mp->getMaxSpesifikasi(),
			'maxkual' => $this->mp->getMaxKualitas(),
			'minharga' => $this->mp->getMinHarga(),
			'mt' => $this->mm->getMonitoring(),
			'satuan' => $this->m->getAllData('satuan'),
			'item' => $this->mp->getPengadaanAset_new('0'),
			'user' => $this->m->getAllData('users'),  
			);
			}else{
				redirect('pengajuan');
			}
		}
		$this->load->view('layouts/header',$data);
		$this->load->view('pengadaan/c_pengadaan',$data);
		$this->load->view('layouts/footer');
	}

	public function pengajuan_sub_kategori($id){
		echo json_encode($this->mk->get_sub_category($id)->result_array());
	}

	public function pengajuan_nama_item($id){
		echo json_encode($this->mb->get_barangsub($id));
	}

	public function pengadaan()
	{
		$id_user = $this->session->userdata('id_user');
		$data = array(
			'title' => 'Pengadaan',
			'active_menu_open_pnd' => 'menu-open',
			'active_pengadaan' => 'active',
			'active_menu_pgd' => 'active',
			'item' => $this->mp->getPengadaanlihat()->result_array()
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('pengadaan/v_pengadaan',$data);
		$this->load->view('layouts/footer');
	}

	public function simpanPengadaan()
	{
		$id_user = $this->session->userdata('id_user');
		if(empty($this->input->post('id_unik'))){
		$data = array(
			'id_user' => $id_user,
			'nama_item' => $this->input->post('nama_item'),
			'volume' => $this->input->post('volume'),
			'satuan' => $this->input->post('satuan'),
			'harga_satuan' => $this->input->post('harga_satuan'),
			'tahun_pengadaan' => $this->input->post('tahun_pengadaan'),
			'status' => '0',
			'created_at' => date('Y-m-d H:i:s')  
		);

		$result = $this->mp->storePengadaan($data);

		}else{
		$data = array(
			'id_user' => $id_user,
			'nama_item' => $this->input->post('nama_item'),
			'volume' => $this->input->post('volume'),
			'satuan' => $this->input->post('satuan'),
			'harga_satuan' => $this->input->post('harga_satuan'),
			'tahun_pengadaan' => $this->input->post('tahun_pengadaan'),
			'status' => '0',
		);
		$result = $this->mp->updatePengadaan($this->input->post('id_unik'),$data);

		}	

		if($result>=1){
			$this->session->set_flashdata('sukses', 'Disimpan');
			redirect('pengajuan');
		}else{
			$this->session->set_flashdata('gagal', 'Disimpan');
			redirect('pengajuan');
		}
	}

	public function detailPengadaan($id_pengadaan)
	{
		$id_pengadaan = $this->uri->segment(3);
		$id_pengadaan = str_replace("%20", ' ', $id_pengadaan);
		$data = array(
			'title' => 'Pengadaan',
			'active_menu_open_pnd' => 'menu-open',
			'active_pengadaan' => 'active',
			'active_menu_pgd' => 'active',
			'item' => $this->mp->getPengadaanAset_new1($id_pengadaan) 
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('pengadaan/d_pengadaan',$data);
		$this->load->view('layouts/footer');
	}

	public function setujuiPengadaan($id_pengadaan)
	{
		$id_pengadaan = $this->uri->segment(3);
		$data['status'] = '1';
		unset($data['id_pengadaan']);
		$result = $this->mp->updatePengadaan($id_pengadaan,$data);
		if($result>=1){
			$this->session->set_flashdata('sukses', 'Disetujui');
			redirect('pengadaan');
		}else{
			$this->session->set_flashdata('gagal', 'Disetujui');
			redirect('pengadaan');
		}
	}

	public function tolakPengadaan($id_pengadaan)
	{
		$id_pengadaan = $this->uri->segment(3);
		$data['status'] = '2';
		unset($data['id_pengadaan']);
		$result = $this->mp->updatePengadaan($id_pengadaan,$data);
		if($result>=1){
			$this->session->set_flashdata('sukses', 'Disetujui');
			redirect('pengadaan');
		}else{
			$this->session->set_flashdata('gagal', 'Disetujui');
			redirect('pengadaan');
		}
	}

	public function hapusPengadaan($id_pengadaan)
	{
		// $id_pengadaan = $this->uri->segment(3);
		$where = array( 'tgl_keranjang' => str_replace("%20", ' ', $id_pengadaan));
		$data['status_keranjang'] = '2';
		$res = $this->mp->deletePengadaan_new($where,$data);
		if($res>=1){
			$this->session->set_flashdata('sukses', 'Dihapus');
			redirect('pengadaan');
		}else{
			$this->session->set_flashdata('gagal', 'Dihapus');
			redirect('pengadaan');
		}
	}

	public function excelPengadaan($tgl_keranjang){
		$data = array(
			'item' => $this->mp->getPengadaanAset_new1(str_replace('%20', ' ', $tgl_keranjang)),
			'idea' => $this->mp->getPengadaanlihat(str_replace('%20', ' ', $tgl_keranjang))->result_array()
		);
		$this->load->view('pengadaan/e_pengadaan',$data);
	}

	public function hapusPengadaankeranjang($id_pengadaan)
	{
		$id_pengadaan = $this->uri->segment(3);
		$where = array( 'id_pengadaan' => $id_pengadaan);
		$res = $this->mp->deletePengadaan($where);
		if($res>=1){
			$this->session->set_flashdata('sukses', 'Dihapus');
			redirect('pengajuan');
		}else{
			$this->session->set_flashdata('gagal', 'Dihapus');
			redirect('pengajuan');
		}
	}

	public function PengajuanPengadaan(){
		$tan = date('Y-m-d H:i:s');
		$data = array(
			'status_keranjang' => '1',
			'tgl_keranjang' => $tan
		);
		$result = $this->mp->update_PengajuanPengadaan($this->session->userdata('id_user'),$data);
		$cek = $this->mu->getDetailUser_x($this->session->userdata('id_user'))->row();
		$datax = array(
        	'device_keranjang' => $_SERVER['HTTP_USER_AGENT'],
        	'ip_keranjang' => $_SERVER['REMOTE_ADDR'],
			'tgl_keranjang' => $tan,
			'id_user' => $this->session->userdata('id_user'),
			'jabatan_user'=> $cek->jabatan
		);
		$result = $this->mp->insert_data('pengadaan_unik',$datax);
		redirect('pengajuan');
	}

	public function filterPengadaan()
	{
		$id_lokasi = $this->input->post('id_lokasi');
		$tahun_pengadaan = $this->input->post('tahun_pengadaan');

		$data = array(
			'title' => 'Pengadaan',
			'active_menu_open_pnd' => 'menu-open',
			'active_pengadaan' => 'active',
			'active_menu_pgd' => 'active',
			'lokasi' => $this->ml->getLokasi(),
			'item' => $this->mp->getFilterPengadaanAset($id_lokasi,$tahun_pengadaan) 
		);

		if (count($data['item'])>0) {
			$this->load->view('layouts/header',$data);
			$this->load->view('pengadaan/v_pengadaan',$data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
			redirect('pengadaan');
		}
	}

	public function testpk()
	{
		$spk = $this->mp->getPenilaian();
		$maxspek = $this->mp->getMaxSpesifikasi();
		$maxkual = $this->mp->getMaxKualitas();
		$minharga = $this->mp->getMinHarga();

		$arr = array();
		$no = 1;
		foreach ($spk as $row) {
			$spek = ($row['nilai_spek']/$maxspek['maks_spek']);
			$kual = ($row['nilai_kualitas']/$maxkual['maks_kualitas']);
			$hrg = ($row['harga']/$minharga['min_harga']);
			$nilai = round(($spek*0.3)+($kual*0.3)+($hrg*0.4),3);

			$arr[] = $nilai.' yaitu V'.$no++.' dengan nama aset '.$row['nama_aset'];
		}

		//echo "<p>Dari hasil perhitungan ranking diatas, maka pemilihan aset terbaik untuk pengadaan dengan nilai tertinggi ".$output;
			
	}



}

/* End of file Pengadaan.php */
/* Location: ./application/controllers/Pengadaan.php */