<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Barang extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata("logged")<>1) {
	      redirect(site_url('login'));
	    }

		//load model
		$this->load->model('ModelBarang','mb');
		$this->load->model('ModelKategori','mjb');
		$this->load->model('Master','m');
	}

	//menampilkan data barang
	public function index()
	{
		$data = array(
			'title' => 'Data Barang',
			'active_menu_master' => 'menu-open',
			'active_menu_mst' => 'active',
			'active_menu_brg' => 'active',
			'barang' => $this->mb->getDataBarang()  
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('master/v_barang',$data);
		$this->load->view('layouts/footer');
	}

	public function filter()
	{
		$data = array(
			'title' => 'Data Barang',
			'active_menu_master' => 'menu-open',
			'active_menu_mst' => 'active',
			'active_menu_brg' => 'active',
			'barang' => $this->mb->getfilterDataBarang($this->input->post('kata_kunci'))  
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('master/v_barang',$data);
		$this->load->view('layouts/footer');
	}

	public function tambahBarang()
	{
		$data = array(
			'title' => 'Data Barang',
			'active_menu_master' => 'menu-open',
			'active_menu_mst' => 'active',
			'active_menu_brg' => 'active',
			'jb' => $this->mjb->getKategoriBarang() 
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('master/c_barang',$data);
		$this->load->view('layouts/footer');
	}

	public function simpanBarang()
	{
		$config['upload_path'] = 'src/img/barang/'; 
        $config['allowed_types'] = 'jpg|png|jpeg';  
        $config['encrypt_name'] = TRUE; 

		$config1['upload_path'] = 'src/img/barang/'; 
        $config1['allowed_types'] = 'jpg|png|jpeg';  
        $config1['encrypt_name'] = TRUE; 

		$config2['upload_path'] = 'src/img/barang/'; 
        $config2['allowed_types'] = 'jpg|png|jpeg';  
        $config2['encrypt_name'] = TRUE; 
		
		$this->upload->initialize($config);
		if(!empty($_FILES['picture']['name'])){
 
            if ($this->upload->do_upload('picture')){
				$gbr = $this->upload->data();
				//Compress Image
				$config['image_library']='gd2';
				$config['source_image']='src/img/barang/'.$gbr['file_name'];
				$config['create_thumb']= FALSE;
				$config['maintain_ratio']= FALSE;
				$config['quality']= '60%';
				$config['new_image']= 'src/img/barang/'.$gbr['file_name'];
				$this->load->library('image_lib', $config);
				$this->image_lib->resize();
				if ($this->upload->do_upload('picture1')){
					$gbr1 = $this->upload->data();
					//Compress Image
					$config1['image_library']='gd2';
					$config1['source_image']='src/img/barang/'.$gbr1['file_name'];
					$config1['create_thumb']= FALSE;
					$config1['maintain_ratio']= FALSE;
					$config1['quality']= '60%';
					$config1['new_image']= 'src/img/barang/'.$gbr1['file_name'];
					$this->load->library('image_lib', $config1);
					$this->image_lib->resize();
					if ($this->upload->do_upload('picture2')){
						$gbr2 = $this->upload->data();
						//Compress Image
						$config2['image_library']='gd2';
						$config2['source_image']='src/img/barang/'.$gbr2['file_name'];
						$config2['create_thumb']= FALSE;
						$config2['maintain_ratio']= FALSE;
						$config2['quality']= '60%';
						$config2['new_image']= 'src/img/barang/'.$gbr2['file_name'];
						$this->load->library('image_lib', $config2);
						$this->image_lib->resize();

						$data = array(
							'id_kategori' => $this->input->post('id_kategori'),
							'id_sub_kategori' => $this->input->post('id_sub_kategori'),
							'nama_barang' => $this->input->post('nama_barang'),
							'merek' => $this->input->post('merek'),
							'tahun_perolehan' => $this->input->post('tahun_perolehan'),
							'picture_fr' => $gbr['file_name'],
							'picture_bs' => $gbr1['file_name'],
							'picture_br' => $gbr2['file_name'],
						);
						$this->mb->storeBarang($data);

						$this->session->set_flashdata('sukses', 'Disimpan');
						redirect('barang');
					}
				}
            }           
        }else{
            $data = array(
				'id_kategori' => $this->input->post('id_kategori'),
				'id_sub_kategori' => $this->input->post('id_sub_kategori'),
				'nama_barang' => $this->input->post('nama_barang'),
				'merek' => $this->input->post('merek'),
				'tahun_perolehan' => $this->input->post('tahun_perolehan')
			);
			$this->mb->storeBarang($data);

			$this->session->set_flashdata('sukses', 'Disimpan');
			redirect('barang');
        }
	}

	public function editBarang($id_barang)
	{
		$id_barang = $this->uri->segment(3);

		$data = array(
			'title' => 'Data Barang',
			'active_menu_master' => 'menu-open',
			'active_menu_mst' => 'active',
			'active_menu_brg' => 'active',
			'brg' => $this->mb->getDetailBarang($id_barang),
			'jb' => $this->mjb->getKategoriBarang(), 
			'sub' => $this->m->getAllData('sub_kategori'), 
		);
			
		$this->load->view('layouts/header',$data);
		$this->load->view('master/u_barang',$data);
		$this->load->view('layouts/footer');
	}

	public function ubahBarang()
	{
		$id_barang = $this->input->post('id_barang');
		if ($_FILES['picture']['name'] || $_FILES['picture1']['name'] || $_FILES['picture2']['name']){

			$config['upload_path'] = 'src/img/barang/'; 
			$config['allowed_types'] = 'jpeg|jpg|png';  
			$config['encrypt_name'] = TRUE;

			$config1['upload_path'] = 'src/img/barang/'; 
			$config1['allowed_types'] = 'jpeg|jpg|png';  
			$config1['encrypt_name'] = TRUE;

			$config2['upload_path'] = 'src/img/barang/'; 
			$config2['allowed_types'] = 'jpeg|jpg|png';  
			$config2['encrypt_name'] = TRUE;

			$this->upload->initialize($config);
			if ( ! $this->upload->do_upload('picture')){
				$this->session->set_flashdata('gagal', 'Diupload');
				redirect('barang/edit/'.$id_barang);
			}else{
				$foto = $this->mb->getSingleDataBarang($id_barang);
				// unlink('src/img/barang/'.$foto['picture']);

				$gbr = $this->upload->data();
                $config['image_library']='gd2';
                $config['source_image']='src/img/barang/'.$gbr['file_name'];
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '60%';
                $config['new_image']= 'src/img/barang/'.$gbr['file_name'];
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

				if ($this->upload->do_upload('picture1')){
					$gbr1 = $this->upload->data();
					//Compress Image
					$config1['image_library']='gd2';
					$config1['source_image']='src/img/barang/'.$gbr1['file_name'];
					$config1['create_thumb']= FALSE;
					$config1['maintain_ratio']= FALSE;
					$config1['quality']= '60%';
					$config1['new_image']= 'src/img/barang/'.$gbr1['file_name'];
					$this->load->library('image_lib', $config1);
					$this->image_lib->resize();
					if ($this->upload->do_upload('picture2')){
						$gbr2 = $this->upload->data();
						//Compress Image
						$config2['image_library']='gd2';
						$config2['source_image']='src/img/barang/'.$gbr2['file_name'];
						$config2['create_thumb']= FALSE;
						$config2['maintain_ratio']= FALSE;
						$config2['quality']= '60%';
						$config2['new_image']= 'src/img/barang/'.$gbr2['file_name'];
						$this->load->library('image_lib', $config2);
						$this->image_lib->resize();

						$data = array(
							'id_kategori' => $this->input->post('id_kategori'),
							'id_sub_kategori' => $this->input->post('id_sub_kategori'),
							'nama_barang' => $this->input->post('nama_barang'),
							'merek' => $this->input->post('merek'),
							'tahun_perolehan' => $this->input->post('tahun_perolehan'),
							'picture_fr' => $gbr['file_name'],
							'picture_bs' => $gbr1['file_name'],
							'picture_br' => $gbr2['file_name'],
						);
					}
					
				}
                $this->mb->updateBarang($id_barang,$data);

               	$this->session->set_flashdata('sukses', 'Diubah');
				redirect('barang');
			}
		}else{ 
            $data = array(
				'id_kategori' => $this->input->post('id_kategori'),
				'id_sub_kategori' => $this->input->post('id_sub_kategori'),
				'nama_barang' => $this->input->post('nama_barang'),
				'merek' => $this->input->post('merek'),
				'tahun_perolehan' => $this->input->post('tahun_perolehan')
			);
			$this->mb->updateBarang($id_barang,$data);

            $this->session->set_flashdata('sukses', 'Diubah');
			redirect('barang');
		}
	}

	public function hapusBarang($id_barang)
	{
		$id_barang = $this->uri->segment(3);
		//delete foto
		$foto = $this->mb->getSingleDataBarang($id_barang);
		if($foto['picture'] != NULL){
			unlink('src/img/barang/'.$foto['picture']);
		}
		$where = array( 'id_barang' => $id_barang );
		$res = $this->mb->deleteBarang($where);
		if($res>=1){
			$this->session->set_flashdata('sukses', 'Dihapus');
			redirect('barang');
		}else{
			$this->session->set_flashdata('gagal', 'Dihapus');
			redirect('barang');
		}
	}

}

/* End of file Barang.php */
/* Location: ./application/controllers/Barang.php */