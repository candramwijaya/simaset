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
            <h1>Mutasi Aset</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('mutasi')?>">Mutasi Aset</a></li>
              <li class="breadcrumb-item active">Ubah Data</li>
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
          <h3 class="card-title">Form Ubah Data</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">
          <form class="form-horizontal" action="<?=base_url('mutasi/ubah')?>" autocomplete="off" method="post">
          <input type="hidden" name="id" value="<?=$item['id'];?>">
            <div class="card-body">
              <div class="form-group row">
                <label for="aset_id" class="col-sm-2 col-form-label">Nama Aset</label>
                <div class="col-sm-6">
                    <select name="aset_id" id="aset_id" class="form-control selectx" required>
                      <option value="">- Pilih --</option>
                      <?php foreach ($aset as $row): ?>
                        <option value="<?=$row['id_aset'];?>" <?=($row['id_aset'] == $item['aset_id'])? 'selected':'';?>><?=$row['nama_barang'];?></option>
                      <?php endforeach ?>      
                    </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="id_user" class="col-sm-2 col-form-label">User</label>
                <div class="col-sm-6">
                   <input type="text" name="nama_user_m" value="<?=$item['nama_user_m'];?>" id="nama_user_m" class="form-control" readonly>     
                </div>
              </div>
              <div class="form-group row">
                <label for="asal_lokasi" class="col-sm-2 col-form-label">Lokasi</label>
                <div class="col-sm-6">
                  <input type="text" name="lokasi_m" value="<?=$item['lokasi_m'];?>" id="lokasi_m" class="form-control" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="user_id" class="col-sm-2 col-form-label">Ke User</label>
                <div class="col-sm-6">
                  <select name="user_id" class="form-control selectx" required>
                       <option value="">- Pilih --</option>
                        <?php foreach ($user as $key) { ?>
                          <option value="<?=$key['id_user'];?>" <?=($key['id_user'] == $item['user_id'])? 'selected':'';?>><?=$key['nama_user'];?></option>
                        <?php } ?> 
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="lokasi_id" class="col-sm-2 col-form-label">Ke Lokasi</label>
                <div class="col-sm-6">
                  <select name="lokasi_id" class="form-control selectx" required>
                    <option value="">- Pilih --</option>
                    <?php foreach ($lokasi as $row): ?>
                      <option value="<?=$row['id_lokasi'];?>" <?=($row['id_lokasi'] == $item['lokasi_id'])? 'selected':'';?>><?=$row['nama_lokasi'];?></option>
                    <?php endforeach ?>      
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="tgl_mutasi" class="col-sm-2 col-form-label">Tanggal Mutasi</label>
                <div class="col-sm-6">
                  <input type="date" class="form-control" value="<?=$item['tgl_mutasi'];?>" name="tgl_mutasi" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" value="<?=$item['status'];?>" name="status" placeholder="Masukan Status.." required>
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
    $('.selectx').select2({
      placeholder: "Pilih..",
      allowClear: true,
      theme: 'bootstrap4'
    });
  });

  $('#aset_id').change(function(){ 
      var aset_id = $(this).val();
      $.ajax({
          url : "<?=site_url('get-aset');?>",
          method : "POST",
          data : {aset_id: aset_id},
          async : true,
          dataType : 'json',
          success: function(data){
                
            var nl = '';
            var nu = '';

            var i;
            for(i=0; i<data.length; i++){
                nl = data[i].nama_lokasi;
                nu = data[i].nama_user;
            }
            document.getElementById("lokasi_m").value = nl;
            document.getElementById("nama_user_m").value = nu;
          }
      });
      return false;
  });
</script>