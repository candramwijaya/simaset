<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Pengadaan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pengadaan</a></li>
            <li class="breadcrumb-item active">Pengajuan</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="flash-data" data-flashdata="<?=$this->session->flashdata('sukses');?>"></div>
  <div class="flash-data-gagal" data-flashdatagagal="<?=$this->session->flashdata('gagal');?>"></div>

  <!-- Main content -->
  <section class="content">
     <div class="container-fluid">
        <!-- <div class="row">
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Rekomendasi Pengadaan Aset</h3>
              </div>
              <div class="card-body">
                  <?php 
                    $no=1; 
                    $arr = array();

                    foreach ($nilai as $row){
                      $spek = ($row['nilai_spek']/$maxspek['maks_spek']);
                      $kual = ($row['nilai_kualitas']/$maxkual['maks_kualitas']);
                      $hrg = ($row['harga']/$minharga['min_harga']);
                      $nilai = round(($spek*0.3)+($kual*0.3)+($hrg*0.4),3);
                  
                      $arr[] = '<b>'.$row['nama_aset'].'</b>';
                    } 

                    $output = max($arr);

                    echo "<p>Berdasarkan hasil perhitungan, maka pemilihan aset terbaik untuk pengadaan  adalah ".$output;                
                  ?>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Rekomendasi Jumlah Pengadaan</h3>
              </div>
              <div class="card-body">
                <select name="id_lokasi" class="selectx form-control" required>
                  <option value="">Cari..</option>
                  <?php foreach ($mt as $x): ?>
                    <option><?=$x['nama_barang'];?> | Jumlah Kerusakan : <?=$x['jml_rusak'];?> <?=$x['nama_satuan'];?></option>
                  <?php endforeach ?>      
                </select>
              </div>
            </div>
          </div>
        </div> -->
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Pengadaan Aset</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form class="form-horizontal" action="<?=base_url('pengadaan/simpan')?>" autocomplete="off" method="post">
                <div class="card-body">
                 <div class="form-group row">
                  <label for="id_lokasi" class="col-sm-2 col-form-label">Kategori</label>
                  <div class="col-sm-6">
                    <input type="hidden" name="id_unik" value="<?php if(isset($id_unik)){echo $id_unik;} ?>">
                    <select name="id_kategori" class="selectx form-control" onchange="sub_kategori(this.value)" required>
                      <option value="">- Pilih --</option>
                      <?php foreach ($kategori as $x): ?>
                        <option value="<?=$x['id_kategori'];?>" <?php if(isset($id_unik)){if($data_pengadaan->kategori_id==$x['id_kategori']){echo 'selected';}} ?>><?=$x['nama_kategori'];?></option>
                      <?php endforeach ?>      
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                    <label for="id_user" class="col-sm-2 col-form-label">Sub Kategori</label>
                    <div class="col-sm-6">
                      <div id="id_sub_view">
                      <select name="id_sub_kategori" id="id_user" onchange="nama_itema(this.value)" class="form-control selectx" required>
                        <?php if(!isset($id_unik)){ ?>
                          <option value="">- Pilih --</option>
                    <?php }else{
                      foreach($data_sub_kategori as $sub){
                      ?>
                        <option value="<?php echo $sub['kode_sub'] ?>" <?php if($sub['kode_sub']==$data_pengadaan->kategori_id){echo 'selected';} ?>><?php echo $sub['nama_sub'] ?></option>
                      <?php }} ?>
                      </select>
                    </div>
                    </div>
                  </div>
                <div class="form-group row">
                    <label for="id_user" class="col-sm-2 col-form-label">Nama Item</label>
                    <div class="col-sm-6">
                      <div id="nama_item">
                      <select name="nama_item" id="id_user" class="form-control selectx" required>
                        <?php if(!isset($id_unik)){ ?>
                          <option value="">- Pilih --</option>
                    <?php }else{
                      foreach($data_barang as $sub){
                      ?>
                        <option value="<?php echo $sub['id_barang'] ?>" <?php if($sub['id_barang']==$data_pengadaan->nama_item){echo 'selected';} ?>><?php echo $sub['nama_barang'] ?></option>
                      <?php }} ?>
                      </select>
                    </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="volume" class="col-sm-2 col-form-label">Volume</label>
                    <div class="col-sm-6">
                      <input type="number" class="form-control" name="volume" min="0" placeholder="Masukan Volume.." value="<?php if(isset($id_unik)){echo $data_pengadaan->volume;} ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="satuan" class="col-sm-2 col-form-label">Satuan</label>
                    <div class="col-sm-6">
                      <select name="satuan" class="form-control selectx" required>
                        <option value="">- Pilih --</option>
                        <?php foreach ($satuan as $key) { ?>
                          <option value="<?=$key['nama_satuan'];?>" <?php if(isset($id_unik)){if($data_pengadaan->satuan==$key['nama_satuan']){echo 'selected';}} ?>><?=$key['nama_satuan'];?></option>
                        <?php } ?>    
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="harga_satuan" class="col-sm-2 col-form-label">Harga Satuan</label>
                    <div class="col-sm-6">
                      <input type="number" class="form-control" name="harga_satuan" placeholder="Masukan Harga.." value="<?php if(isset($id_unik)){echo $data_pengadaan->harga_satuan;} ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="tahun_pengadaan" class="col-sm-2 col-form-label">Tahun Pengadaan</label>
                    <div class="col-sm-6">
                      <div class="input-group mb-3">
                        <input type="text" name="tahun_pengadaan" placeholder="20XX" class="form-control" value="<?php if(isset($id_unik)){echo $data_pengadaan->tahun_pengadaan;} ?>" required>
                      </div>
                    </div>
                  </div>          
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <div class="col-2">
                    
                  </div>
                  <div class="col-6">
                    <button type="submit" class="btn btn-info">Simpan</button>
                  </div>                 
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
          </div>
        </div>
      </div>
              <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Keranjang Aset</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                  <th>No.</th>
                  <!-- <th>Nama</th>
                  <th>Penempatan</th> -->
                  <th>Nama Aset</th>
                  <th>Volume</th>
                  <th>Harga</th>
                  <th>Tahun</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($item as $row): ?>               
                  <tr>
                    <td><?=$no++;?></td>
                    <!-- <td><?=$row['nama_user'];?></td>
                    <td><?=$row['nama_lokasi'];?></td> -->
                    <td><?=$row['nama_kategori'].' '.$row['nama_sub'].' '.$row['nama_barang'];?></td>
                    <td><?=$row['volume'].' '.$row['satuan'];?></td>
                    <td><?=number_format($row['harga_satuan'],0);?></td>
                    <td><?=$row['tahun_pengadaan'];?></td>
                      <td>
                      <a href="<?=base_url('pengajuan/'.$row['id_pengadaan'])?>" class="btn btn-info btn-sm">
                      <i class="fas fa-edit"></i>
                    </a>
                        <a href="<?=base_url('pengadaan/hapus_keranjang/'.$row['id_pengadaan'])?>" class="btn btn-danger btn-sm tombol-hapus">
                          <i class="fas fa-trash"></i>
                        </a>
                      </td>
                    </tr>
                  <?php endforeach ?>
            
                </tbody>
              </table>
              <form action="<?=base_url('PengajuanPengadaan')?>">
              <button type="submit" class="btn btn-info">Pengajuan Pengadaan</button>
              </form>
            </div> 
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- Select2 -->
<script>

  $(document).ready(function() {
    $('.selectx').select2({
      placeholder: "Pilih..",
      allowClear: true,
      theme: 'bootstrap4'
    });
  });

  function sub_kategori(id){
    var text_agent = '<div id="id_sub_view"><select name="id_sub_kategori" id="id_user" class="form-control selectx" onchange="nama_itema(this.value)" required><option value="">- Pilih --</option>';
        $.getJSON('<?php echo base_url(); ?>pengajuan_sub_kategori/'+id, {
                  format: "json"
              })
              .done(function (data) {
                  $.each(data, function (key, val) {
                    text_agent += '<option value="'+val.kode_sub+'">' + val.nama_sub + '</option>';
                    
                  });
                  text_agent += '</select></div>';

                  var fg = document.getElementById("id_sub_view");
                  fg.innerHTML= text_agent;
             })


    var text_agent1 = '<div id="nama_item"><select name="nama_item" id="id_user" class="form-control selectx" required><option value="">- Pilih --</option>';
                  text_agent1 += '</select></div>';

                  var fg = document.getElementById("nama_item");
                  fg.innerHTML= text_agent1;
  }

  function nama_itema(id){
    var text_agent = '<div id="nama_item"><select name="nama_item" id="id_user" class="form-control selectx" required><option value="">- Pilih --</option>';
        $.getJSON('<?php echo base_url(); ?>pengajuan_nama_item/'+id, {
                  format: "json"
              })
              .done(function (data) {
                  $.each(data, function (key, val) {
                    text_agent += '<option value="'+val.id_barang+'">' + val.nama_barang + '</option>';
                    
                  });
                  text_agent += '</select></div>';

                  var fg = document.getElementById("nama_item");
                  fg.innerHTML= text_agent;
             })
  }
</script>
<script src="<?=base_url()?>src/backend/plugins/select2/js/select2.full.min.js"></script>


