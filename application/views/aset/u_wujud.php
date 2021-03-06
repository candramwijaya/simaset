<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<!-- Jquery date timepicker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Aset Berwujud</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Data Aset</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('aset_wujud')?>">Berwujud</a></li>
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
          <?php if (validation_errors()): ?>
            <div class="alert alert-danger col-md-8 alert-dismissible">                
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <?= validation_errors(); ?>
            </div>
          <?php endif ?>
          <!-- <p>*Keterangan Kode Aset :</p>
          <ul>
            <li>0000 = Kode Aset (0001/0002..dst) </li>
            <li>XXX = Kategori Aset (TIK,GEDUNG,dll)</li>
            <li>20XX = Tahun Perolehan Aset </li>
          </ul> -->
          <form class="form-horizontal" action="<?=base_url('aset_wujud/ubah')?>" autocomplete="off" method="post">
            <input type="hidden" name="id_aset" value="<?=$row['id_aset']?>">
            <div class="card-body">
              <!-- <div class="form-group row">
                <label for="kode_aset" class="col-sm-2 col-form-label">Kode Aset*</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" value="<?=$row['kode_aset']?>" name="kode_aset" placeholder="0000/XXX/20XX" readonly>
                </div>
              </div> -->
              <div class="form-group row">
                <label for="pr_assets" class="col-sm-2 col-form-label">Nomor Purchase Requisition ( PR )</label>
                <div class="col-sm-6">
                  <input type="text" value="<?=$row['pr_assets']?>" class="form-control" name="pr_assets" placeholder="Masukan PR" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="po_assets" class="col-sm-2 col-form-label">Nomor Purchase Order ( PO )</label>
                <div class="col-sm-6">
                  <input type="text" value="<?=$row['po_assets']?>" class="form-control" name="po_assets" placeholder="Masukan PO" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="id_barang" class="col-sm-2 col-form-label">Nama Aset</label>
                <div class="col-sm-6">
                  <select name="id_barang" class="form-control selectx" required>
                       <option value="">- Pilih --</option>
                        <?php foreach ($barang as $key) { ?>
                          <option value="<?=$key['id_barang'];?>" <?=($row['id_barang']==$key['id_barang'])? 'selected':'';?>><?=$key['nama_barang'];?></option>
                        <?php } ?> 
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="sn_assets" class="col-sm-2 col-form-label">Serial Number</label>
                <div class="col-sm-6">
                  <input type="text" value="<?=$row['sn_assets']?>" class="form-control" name="sn_assets" placeholder="Masukan Serial Number">
                </div>
              </div>
              <script>
		          $( function() {
            		$( "#datepicker" ).datepicker();
        	    } );
              </script>
              <div class="form-group row">
                <label for="tglbarangdatang_assets" class="col-sm-2 col-form-label">Tanggal Barang Datang</label>
                <div class="col-sm-6">
                  <!-- <input type="date" value="<?=$row['tglbarangdatang_assets']?>" class="form-control" name="tglbarangdatang_assets" placeholder="Masukan Tanggal Barang Datang"> -->
                  <input type="text" id="datepicker" name="tglbarangdatang_assets" class="form-control" placeholder="Masukan Tanggal Barang Datang" value="<?=$row['tglbarangdatang_assets']?>" selected="<?=$row['tglbarangdatang_assets']?>"required>	
                </div>
              </div>
              <div class="form-group row">
                <label for="picture" class="col-sm-2 col-form-label">Foto Barang</label>
                <div class="col-sm-6">
                  <input type="file" class="form-control" name="picture">
                  <small>Kosongkan jika tidak diisi</small>
                </div>
              </div>
              <div class="form-group row">
                <label for="id_user" class="col-sm-2 col-form-label">Nama User</label>
                <div class="col-sm-6">
                  <select name="user_id" id="id_user" class="form-control selectx" required>
                       <option value="">- Pilih --</option>
                        <?php foreach ($user as $key) { ?>
                          <option value="<?=$key['id_user'];?>" <?=($row['user_id']==$key['id_user'])? 'selected':'';?>><?=$key['nama_user'];?></option>
                        <?php } ?> 
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="jabatan" class="col-sm-2 col-form-label">Jabatan</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" value="<?=$row['jabatan']?>" id="jabatan" name="jabatan" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label for="volume" class="col-sm-2 col-form-label">Volume</label>
                <div class="col-sm-6">
                  <input type="number" value="<?=$row['volume']?>" class="form-control" name="volume" min="0" placeholder="Masukan Volume.." required>
                </div>
              </div>
              <div class="form-group row">
                <label for="satuan_id" class="col-sm-2 col-form-label">Satuan</label>
                <div class="col-sm-6">
                  <select name="satuan_id" class="form-control selectx" required>
                    <option value="">- Pilih --</option>
                    <?php foreach ($satuan as $key) { ?>
                      <option value="<?=$key['id_satuan'];?>" <?=($row['satuan_id']==$key['id_satuan'])? 'selected':'';?>><?=$key['nama_satuan'];?></option>
                    <?php } ?>    
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="kondisi" class="col-sm-2 col-form-label">Kondisi</label>
                <div class="col-sm-6">
                   <select name="kondisi" class="form-control" required>
                    <option value="">- Pilih --</option>
                    <option <?php if($row['kondisi'] == "Baik"){ echo 'selected="selected"'; } ?> value="Baik">Baik</option>
                    <option <?php if($row['kondisi'] == "Renovasi"){ echo 'selected="selected"'; } ?> value="Renovasi">Renovasi</option>
                    <option <?php if($row['kondisi'] == "Rusak"){ echo 'selected="selected"'; } ?> value="Rusak">Rusak</option>     
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="id_lokasi" class="col-sm-2 col-form-label">Lokasi Aset</label>
                <div class="col-sm-6">
                  <select name="id_lokasi" class="form-control" required>
                    <option value="">- Pilih --</option>
                    <?php foreach ($lokasi as $y): ?>
                      <option <?php if($y['id_lokasi'] == $row['id_lokasi']){ echo 'selected="selected"'; } ?> value="<?=$y['id_lokasi'];?>"><?=$y['nama_lokasi'];?></option>
                    <?php endforeach ?>      
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="umur_ekonomis" class="col-sm-2 col-form-label">Umur Ekonomis</label>
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                    <input type="number" name="umur_ekonomis" value="<?=$row['umur_ekonomis']?>" placeholder="1/2/3/.." class="form-control">
                    <div class="input-group-append">
                      <span class="input-group-text">Tahun</span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="harga" class="col-sm-2 col-form-label">Nilai Aset</label>
                <div class="col-sm-6">
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="number" value="<?=$row['harga']?>" name="harga" class="form-control" placeholder="0000" required>
                </div>
                </div>
              </div>
              <div class="form-group row">
                <label for="jenis_bantuan" class="col-sm-2 col-form-label">Asal Perolehan</label>
                <div class="col-sm-6">
                  <select name="jenis_bantuan" class="form-control" required>
                    <option value="">- Pilih --</option>
                    <option <?php if($row['jenis_bantuan'] == 'GA'){ echo 'selected="selected"'; } ?> value="GA">General Affair</option>
                    <option <?php if($row['jenis_bantuan'] == 'IT'){ echo 'selected="selected"'; } ?> value="IT">Information Technology</option>
                    <option <?php if($row['jenis_bantuan'] == 'Hibah'){ echo 'selected="selected"'; } ?> value="Hibah">Hibah</option>     
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                <div class="col-sm-6">
                  <textarea name="keterangan" class="form-control" required><?=$row['keterangan']?></textarea>
                </div>
              </div>
              <div class="form-group row">
                <label for="tanggal_terima" class="col-sm-2 col-form-label">Generate QR Code?</label>
                <div class="col-sm-6">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="generate" id="generate" <?php if($row['qr_code'] != NULL){ echo 'checked="checked"'; } ?>>
                    <label class="form-check-label" for="generate">
                      Ya
                    </label>
                  </div>
                </div>
              </div>           
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <a href="<?=base_url('aset_wujud')?>">
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
  
<!-- Select2 -->
<script src="<?=base_url()?>src/backend/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(document).ready(function(){
    $('.selectx').select2({
      placeholder: "Pilih..",
      allowClear: true,
      theme: 'bootstrap4'
    });
  });

  $('#id_user').change(function(){ 
      var id_user = $(this).val();
      $.ajax({
          url : "<?=site_url('get-user');?>",
          method : "POST",
          data : {id_user: id_user},
          async : true,
          dataType : 'json',
          success: function(data){
                
            var jbt = '';

            var i;
            for(i=0; i<data.length; i++){
                jbt = data[i].jabatan;
            }
            document.getElementById("jabatan").value = jbt;
          }
      });
      return false;
  });
</script>

