<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aset extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("logged")<>1) {
	      redirect(site_url('login'));
	    }
		
		//load model
		$this->load->model('ModelAset','ma');
		$this->load->model('ModelBarang','mb');
		$this->load->model('ModelLokasi','ml');
		$this->load->model('ModelKategori','mk');
		$this->load->model('Master','m');

		//load library
		$this->load->library('ciqrcode');
		$this->load->library('uuid');
	}

	public function index()
	{		
		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getAsetWujud(),
			'kategori' => $this->mk->getKategoriBarang() 
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('aset/v_wujud',$data);
		$this->load->view('layouts/footer');
	}

	public function tambahAset()
	{
		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getAsetWujud(),
			'lokasi' => $this->ml->getLokasi(),
			'barang' => $this->mb->getDataBarang(),
			'satuan' => $this->m->getAllData('satuan'),
			'user' => $this->m->getAllData('users'),
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('aset/c_wujud',$data);
		$this->load->view('layouts/footer');
	}

	public function simpanAset()
	{
		// $this->form_validation->set_rules('kode_aset','Kode Aset','required|trim|is_unique[asets.kode_aset]',
		// 	array(
		// 		'required'=>"<p>Kode Aset tidak boleh kosong</p>",
		// 		'is_unique'=>"<p>Kode Aset sudah digunakan</p>",
		// 	)
		// );



		// if ($this->form_validation->run() != FALSE) {
			$generate = $this->input->post('generate');
			if ($generate) {

				// $kode_aset = $this->input->post('kode_aset');

		        $config['cacheable']    = true; //boolean, the default is true
		        $config['cachedir']     = './src/'; //string, the default is application/cache/
		        $config['errorlog']     = './src/'; //string, the default is application/logs/
		        $config['imagedir']     = './src/img/qrcode/'; //direktori penyimpanan qr code
		        $config['quality']      = true; //boolean, the default is true
		        $config['size']         = '1024'; //interger, the default is 1024
		        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
		        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
		        $this->ciqrcode->initialize($config);

		        $id = $this->uuid->v4();
		        $image = str_replace('-', '', $id);

		        $id_as = $this->uuid->v4();
		        $id_aset = str_replace('-', '', $id_as);

		        $image_name = $image.'.png'; //buat name dari qr code sesuai dengan nim

		        $url = 'http://urlkamu.com/aset/detail/'.$id_aset;

		        $params['data'] = $url; //data yang akan di jadikan QR CODE
		        $params['level'] = 'H'; //H=High
		        $params['size'] = 10;
		        $params['savename'] = FCPATH.$config['imagedir'].$image_name; 
		        $this->ciqrcode->generate($params);

		        $volume = $this->input->post('volume');
		        $harga = $this->input->post('harga');
		        $total = ($volume*$harga);

		        $data = array(
		        	'id_aset' => $id_aset,
					'user_id' => $this->input->post('user_id'),
		        	// 'kode_aset' => $kode_aset,
		        	'id_barang' => $this->input->post('id_barang'),
		        	'id_lokasi' => $this->input->post('id_lokasi'),
		        	'pr_assets' => $this->input->post('pr_assets'),
		        	'po_assets' => $this->input->post('po_assets'),
		        	'sn_assets' => $this->input->post('sn_assets'),
		        	'tglbarangdatang_assets' => $this->input->post('tglbarangdatang_assets'),
		        	'id_user_input' => $this->session->userdata("id_user"),
		        	'tgl_input' => date('Y-m-d H:i:s'),
		        	'device_input' => $_SERVER['HTTP_USER_AGENT'],
		        	'ip_input' => $_SERVER['REMOTE_ADDR'],
		        	'volume' => $volume,
		        	'satuan_id' => $this->input->post('satuan_id'),
		        	'harga' => $harga,
		        	'total_harga' => $total,
		        	'status_aset' => 'Aktif',
		        	'kondisi' => $this->input->post('kondisi'),
		        	'umur_ekonomis' => $this->input->post('umur_ekonomis'),
		        	'jenis_bantuan' => $this->input->post('jenis_bantuan'),
		        	'keterangan' => $this->input->post('keterangan'),
		        	'qr_code' => $image_name
		        );

		        $result = $this->ma->storeAset($data);

		        $get_id = $this->ma->get_id()->result_array();

		        foreach($get_id as $gs){
		        	$data_get['kode_aset'] = $gs['id_increment'].'/'.$gs['kode_kategori'].'/'.date('Y');
		        	echo $gs['id_increment'].'/'.$gs['kode_kategori'].'/'.date('Y').'AS';
		        	$this->ma->updateAset($gs['id_aset'],$data_get);
		        }

		        if($result>=1){
		        	$this->session->set_flashdata('sukses', 'Disimpan');
		        	redirect('aset_wujud');
		        }else{
		        	$this->session->set_flashdata('gagal', 'Disimpan');
		        	redirect('aset_wujud/tambah');
		        }

			} else {

				$id = $this->uuid->v4();
		        $id_aset = str_replace('-', '', $id);

				$volume = $this->input->post('volume');
		        $harga = $this->input->post('harga');
		        $total = ($volume*$harga);
				
				$data = array(
					'id_aset' => $id_aset,
					'user_id' => $this->input->post('user_id'),
		        	// 'kode_aset' => $this->input->post('kode_aset'),
		        	'id_barang' => $this->input->post('id_barang'),
		        	'id_lokasi' => $this->input->post('id_lokasi'),
		        	'pr_assets' => $this->input->post('pr_assets'),
		        	'po_assets' => $this->input->post('po_assets'),
		        	'sn_assets' => $this->input->post('sn_assets'),
		        	'tglbarangdatang_assets' => $this->input->post('tglbarangdatang_assets'),
		        	'id_user_input' => $this->session->userdata("id_user"),
		        	'tgl_input' => date('Y-m-d H:i:s'),
		        	'device_input' => $_SERVER['HTTP_USER_AGENT'],
		        	'ip_input' => $_SERVER['REMOTE_ADDR'],
		        	'volume' => $volume,
					'satuan_id' => $this->input->post('satuan_id'),
		        	'harga' => $harga,
		        	'total_harga' => $total,
		        	'status_aset' => 'Aktif',
		        	'kondisi' => $this->input->post('kondisi'),
		        	'umur_ekonomis' => $this->input->post('umur_ekonomis'),
		        	'jenis_bantuan' => $this->input->post('jenis_bantuan'),
					'keterangan' => $this->input->post('keterangan'),
		        );

		        $result = $this->ma->storeAset($data);

		        $get_id = $this->ma->get_id()->result_array();

		        foreach($get_id as $gs){
		        	$data_get['kode_aset'] = $gs['id_increment'].'/'.$gs['kode_kategori'].'/'.date('Y');
		        	echo $gs['id_increment'].'/'.$gs['kode_kategori'].'/'.date('Y').'Ab';
		        	$this->ma->updateAset($gs['id_aset'],$data_get);
		        }

		        if($result>=1){
		        	$this->session->set_flashdata('sukses', 'Disimpan');
		        	redirect('aset_wujud');
		        }else{
		        	$this->session->set_flashdata('gagal', 'Disimpan');
		        	redirect('aset_wujud/tambah');
		        }

			}
		// } else {
		// 	$data = array(
		// 		'title' => 'Aset Berwujud',
		// 		'active_menu_open' => 'menu-open',
		// 		'active_menu_aset' => 'active',
		// 		'active_menu_wujud' => 'active',
		// 		'aset' => $this->ma->getAsetWujud(),
		// 		'brg' => $this->mb->getDataBarang(),
		// 		'lokasi' => $this->ml->getLokasi()
		// 	);
		// 	$this->load->view('layouts/header',$data);
		// 	$this->load->view('aset/c_wujud',$data);
		// 	$this->load->view('layouts/footer');
		// }		
	}

	public function editAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);

		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'row' => $this->ma->getDetailAset($id_aset),
			'lokasi' => $this->ml->getLokasi(),
			'barang' => $this->mb->getDataBarang(),
			'satuan' => $this->m->getAllData('satuan'),
			'user' => $this->m->getAllData('users'),
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('aset/u_wujud',$data);
		$this->load->view('layouts/footer');
	}

	public function ubahAset()
	{
		// $this->form_validation->set_rules('kode_aset','Kode Aset','required|trim',
		// 	array(
		// 		'required'=>"<p>Kode Aset tidak boleh kosong</p>"
		// 	)
		// );

		$id_aset = $this->input->post('id_aset');

		// if ($this->form_validation->run() != FALSE) {
			$generate = $this->input->post('generate');
			if ($generate) {

				// $kode_aset = $this->input->post('kode_aset');

		        $config['cacheable']    = true; //boolean, the default is true
		        $config['cachedir']     = './src/'; //string, the default is application/cache/
		        $config['errorlog']     = './src/'; //string, the default is application/logs/
		        $config['imagedir']     = './src/img/qrcode/'; //direktori penyimpanan qr code
		        $config['quality']      = true; //boolean, the default is true
		        $config['size']         = '1024'; //interger, the default is 1024
		        $config['black']        = array(224,255,255); // array, default is array(255,255,255)
		        $config['white']        = array(70,130,180); // array, default is array(0,0,0)
		        $this->ciqrcode->initialize($config);

		        $id = $this->uuid->v4();
		        $image = str_replace('-', '', $id);

		        $image_name = $image.'.png'; //buat name dari qr code sesuai dengan nim

		        $url = 'http://urlkamu.com/aset/detail/'.$id_aset;

		        $params['data'] = $url; //data yang akan di jadikan QR CODE
		        $params['level'] = 'H'; //H=High
		        $params['size'] = 10;
		        $params['savename'] = FCPATH.$config['imagedir'].$image_name; 
		        $this->ciqrcode->generate($params);

		        $volume = $this->input->post('volume');
		        $harga = $this->input->post('harga');
		        $total = ($volume*$harga);

		        $data = array(
		        	// 'kode_aset' => $kode_aset,
					'user_id' => $this->input->post('user_id'),
		        	'id_barang' => $this->input->post('id_barang'),
		        	'id_lokasi' => $this->input->post('id_lokasi'),
		        	'pr_assets' => $this->input->post('pr_assets'),
		        	'po_assets' => $this->input->post('po_assets'),
		        	'sn_assets' => $this->input->post('sn_assets'),
		        	'tglbarangdatang_assets' => $this->input->post('tglbarangdatang_assets'),
		        	'id_user_ubah' => $this->session->userdata("id_user"),
		        	'tgl_ubah' => date('Y-m-d H:i:s'),
		        	'device_ubah' => $_SERVER['HTTP_USER_AGENT'],
		        	'ip_ubah' => $_SERVER['REMOTE_ADDR'],
		        	'volume' => $volume,
		        	'satuan_id' => $this->input->post('satuan_id'),
		        	'harga' => $harga,
		        	'total_harga' => $total,
		        	'status_aset' => 'Aktif',
		        	'kondisi' => $this->input->post('kondisi'),
		        	'umur_ekonomis' => $this->input->post('umur_ekonomis'),
		        	'jenis_bantuan' => $this->input->post('jenis_bantuan'),
					'keterangan' => $this->input->post('keterangan'),
		        	'qr_code' => $image_name
		        );

		        $result = $this->ma->updateAset($id_aset,$data);

		        if($result>=1){
		        	$this->session->set_flashdata('sukses', 'Diubah');
		        	redirect('aset_wujud');
		        }else{
		        	$this->session->set_flashdata('gagal', 'Diubah');
		        	redirect('aset_wujud/edit/'.$id_aset);
		        }

			} else {

				$this->db->where('id_aset',$id_aset);
        		$get_image_file=$this->db->get('asets')->row();
        		@unlink('src/img/qrcode/'.$get_image_file->qr_code);

				$volume = $this->input->post('volume');
		        $harga = $this->input->post('harga');
		        $total = ($volume*$harga);
				
				$data = array(
		        	// 'kode_aset' => $this->input->post('kode_aset'),
					'user_id' => $this->input->post('user_id'),
		        	'id_barang' => $this->input->post('id_barang'),
		        	'id_lokasi' => $this->input->post('id_lokasi'),
		        	'pr_assets' => $this->input->post('pr_assets'),
		        	'po_assets' => $this->input->post('po_assets'),
		        	'sn_assets' => $this->input->post('sn_assets'),
		        	'tglbarangdatang_assets' => $this->input->post('tglbarangdatang_assets'),
		        	'id_user_ubah' => $this->session->userdata("id_user"),
		        	'tgl_ubah' => date('Y-m-d H:i:s'),
		        	'device_ubah' => $_SERVER['HTTP_USER_AGENT'],
		        	'ip_ubah' => $_SERVER['REMOTE_ADDR'],
		        	'volume' => $volume,
		        	'satuan_id' => $this->input->post('satuan_id'),
		        	'harga' => $harga,
		        	'total_harga' => $total,
		        	'status_aset' => 'Aktif',
		        	'kondisi' => $this->input->post('kondisi'),
		        	'umur_ekonomis' => $this->input->post('umur_ekonomis'),
		        	'jenis_bantuan' => $this->input->post('jenis_bantuan'),
					'keterangan' => $this->input->post('keterangan'),
		        	'qr_code' => NULL
		        );

		        $result = $this->ma->updateAset($id_aset,$data);

		        if($result>=1){
		        	$this->session->set_flashdata('sukses', 'Disimpan');
		        	redirect('aset_wujud');
		        }else{
		        	$this->session->set_flashdata('gagal', 'Disimpan');
		        	redirect('aset_wujud/edit/'.$id_aset);
		        }

			}
		// } else {
		// 	$data = array(
		// 		'title' => 'Aset Berwujud',
		// 		'active_menu_open' => 'menu-open',
		// 		'active_menu_aset' => 'active',
		// 		'active_menu_wujud' => 'active',
		// 		'aset' => $this->ma->getDetailAsetWujud($id_aset),
		// 		'brg' => $this->mb->getDataBarang(),
		// 		'lokasi' => $this->ml->getLokasi()
		// 	);
		// 	$this->load->view('layouts/header',$data);
		// 	$this->load->view('aset/u_wujud',$data);
		// 	$this->load->view('layouts/footer');
		// }		
	}

	public function detailAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);
		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'd' => $this->ma->getDetailAset($id_aset)
		);

		$this->load->view('layouts/header',$data);
		$this->load->view('aset/d_wujud',$data);
		$this->load->view('layouts/footer');
	}

	public function hapusAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);

		$this->db->where('id_aset',$id_aset);
        $get_image_file=$this->db->get('asets')->row();
        @unlink('src/img/qrcode/'.$get_image_file->qr_code);

        $this->db->where('id_aset',$id_aset);
        $this->db->delete('asets');
        $this->session->set_flashdata('sukses', 'Dihapus');
		redirect('aset_wujud');
	}

	public function filterAset()
	{
		$id_kategori = $this->input->post('id_kategori');
		$tahun_perolehan = $this->input->post('tahun_perolehan');
		$kondisi = $this->input->post('kondisi');

		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_wujud' => 'active',
			'aset' => $this->ma->getFilterAsetWujud($id_kategori,$tahun_perolehan,$kondisi),
			'kategori' => $this->mk->getKategoriBarang() 
		);
		if (count($data['aset'])>0) {
			$this->load->view('layouts/header',$data);
			$this->load->view('aset/v_wujud',$data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
			redirect('aset_wujud');
		}		
	}

	public function dihapuskanAset()
	{
		$data = array(
			'title' => 'Aset Dihapuskan',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_hapuskan' => 'active',
			'kategori' => $this->mk->getKategoriBarang(),
			'aset' => $this->ma->getAsetDihapuskan() 
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('aset/v_dihapuskan',$data);
		$this->load->view('layouts/footer');
	}

	public function detailDihapuskanAset($id_aset)
	{
		$id_aset = $this->uri->segment(3);
		$data = array(
			'title' => 'Aset Berwujud',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_hapuskan' => 'active',
			'd' => $this->ma->getDetailAset($id_aset)
		);
		$this->load->view('layouts/header',$data);
		$this->load->view('aset/d_dihapuskan',$data);
		$this->load->view('layouts/footer');
	}

	public function filterAsetDihapuskan()
	{
		$id_kategori = $this->input->post('id_kategori');
		$tgl_penghapusan = $this->input->post('tgl_penghapusan');

		$data = array(
			'title' => 'Aset Dihapuskan',
			'active_menu_open' => 'menu-open',
			'active_menu_aset' => 'active',
			'active_menu_hapuskan' => 'active',
			'kategori' => $this->mk->getKategoriBarang(),
			'aset' => $this->ma->getFilterAsetDihapuskan($id_kategori,$tgl_penghapusan)  
		);
		if (count($data['aset'])>0) {
			$this->load->view('layouts/header',$data);
			$this->load->view('aset/v_dihapuskan',$data);
			$this->load->view('layouts/footer');
		} else {
			$this->session->set_flashdata('gagal', 'Ditemukan');
			redirect('aset_dihapuskan');
		}
	}

	public function cariAset()
	{
		$bar = $this->input->get('bar');
		$query = $this->ma->searchAset($bar, 'nama_barang');

		echo json_encode($query);
	}

	public function get_sub_data()
	{
		$aset_id = $this->input->post('aset_id',TRUE);
		
        $data = $this->ma->get_sub_aset($aset_id);
        echo json_encode($data);
	}

}

/* End of file Aset.php */
/* Location: ./application/controllers/Aset.php */