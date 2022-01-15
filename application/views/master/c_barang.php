<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Barang</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Data Master</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('barang')?>">Barang</a></li>
              <li class="breadcrumb-item active">Tambah Data</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="flash-data-gagal" data-flashdatagagal="<?=$this->session->flashdata('gagal');?>"></div>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Form Tambah Data</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form class="form-horizontal" action="<?=base_url('barang/simpan')?>" autocomplete="off" method="post" enctype="multipart/form-data">
            <div class="card-body">
              <div class="form-group row">
                <label for="id_kategori" class="col-sm-2 col-form-label">Kategori Barang</label>
                <div class="col-sm-6">
                    <select name="id_kategori" id="id_kategori" class="form-control selectx" required>
                      <option value="">- Pilih --</option>
                      <?php foreach ($jb as $row): ?>
                        <option value="<?=$row['id_kategori'];?>"><?=$row['kode_kategori'];?> - <?=$row['nama_kategori'];?></option>
                      <?php endforeach ?>      
                    </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="id_sub_kategori" class="col-sm-2 col-form-label">Sub Kategori Barang</label>
                <div class="col-sm-6">
                    <select name="id_sub_kategori" id="id_sub_kategori" class="form-control selectx" required>
                      <option>No Selected</option>     
                    </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="nama_barang" placeholder="Masukan Nama Barang.." required>
                </div>
              </div>
              <div class="form-group row">
                <label for="merek" class="col-sm-2 col-form-label">Merek</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="merek" placeholder="Masukan Merek.." required>
                </div>
              </div>           
              <div class="form-group row">
                <label for="tahun_perolehan" class="col-sm-2 col-form-label">Tahun Perolehan</label>
                <div class="col-sm-6">
                  <input type="number" class="form-control" name="tahun_perolehan" placeholder="20XX" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="picture" class="col-sm-2 col-form-label">Foto Barang</label>
                <div class="col-sm-6">
                  <input type="file" class="form-control" name="picture">
                  <small>Kosongkan jika tidak diisi</small>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <a href="<?=base_url('barang')?>">
                <button type="button" class="btn btn-danger">Kembali</button>
              </a>
              <button type="submit" class="btn btn-info">Simpan</button>
            </div>
            <!-- /.card-footer -->
          </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<!-- Select2 -->
<script src="<?=base_url()?>src/backend/plugins/select2/js/select2.full.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){

      $('#id_kategori').change(function(){ 
          var id_kategori = $(this).val();
          $.ajax({
              url : "<?php echo site_url('get-sub-kategori');?>",
              method : "POST",
              data : {id_kategori: id_kategori},
              async : true,
              dataType : 'json',
              success: function(data){
                    
                  var html = '';
                  var i;
                  for(i=0; i<data.length; i++){
                      html += '<option value='+data[i].kode_sub+'>'+data[i].nama_sub+'</option>';
                  }
                  $('#id_sub_kategori').html(html);

              }
          });
          return false;
      });
      
      $('.selectx').select2({
        placeholder: "Pilih..",
        allowClear: true,
        theme: 'bootstrap4'
      });
        
  });
</script>