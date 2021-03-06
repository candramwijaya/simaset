<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

<!-- Jquery date timepicker -->
<link rel="stylesheet" href="<?=base_url()?>src/css/yearpicker.css">
<script src="/path/to/cdn/jquery.slim.min.js"></script>
<script src="<?=base_url()?>src/js/yearpicker.js" async></script>

<!-- css border image -->
<style>
#borderimg1 {
  border: 10px solid transparent;
  padding: 15px;
  border-image: url(<?=base_url()?>src/img/border.png) 50 round;
}

#borderimg2 {
  border: 10px solid transparent;
  padding: 15px;
  border-image: url(<?=base_url()?>src/img/border.png) 20% round;
}

#borderimg3 {
  border: 10px solid transparent;
  padding: 15px;
  border-image: url(<?=base_url()?>src/img/border.png) 25% round;
}
</style>

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
                  <script>
                    $('.yearpicker').yearpicker();
                    $('.yearpicker').yearpicker({

                    // Initial Year
                    year: null,

                    // Start Year
                    startYear: null,

                    // End Year
                    endYear: null,

                    // Element tag
                    itemTag: 'li',

                    // Default CSS classes
                    selectedClass: 'selected',
                    disabledClass: 'disabled',
                    hideClass: 'hide',

                    // Custom template
                    template: `<div class="yearpicker-container">
                                <div class="yearpicker-header">
                                    <div class="yearpicker-prev" data-view="yearpicker-prev">&lsaquo;</div>
                                    <div class="yearpicker-current" data-view="yearpicker-current">SelectedYear</div>
                                    <div class="yearpicker-next" data-view="yearpicker-next">&rsaquo;</div>
                                </div>
                                <div class="yearpicker-body">
                                    <ul class="yearpicker-year" data-view="years">
                                    </ul>
                                </div>
                            </div>
                    `,

                    });

                    $('.yearpicker').yearpicker({

                    onShow: null,
                    onHide: null,
                    onChange: function(value){}

                    });

                  </script>
                  <!-- <input type="text" name="tahun_perolehan" class="form-control yearpicker" placeholder="20XX" required>	 -->
                </div>
              </div>
              <div class="form-group row">
                <label for="picture" class="col-sm-2 col-form-label">Foto (Tampak Depan)</label>
                <div class="col-sm-3">
                  <input type="file" class="form-control" name="picture" onchange="loadFile(event)">
                  
                  <br/>
                  
                  <!-- <font size="2px" id="text_fd" style="visibility: hidden" >Foto Tampak Depan</font> -->
                  <img id="output" max-height="auto" width="75%" style="border: 1px solid #ddd; border-radius: 4px;  padding: 5px;"/>

                  <script>
                    var loadFile = function(event) {
                      var output = document.getElementById('output');
                      output.src = URL.createObjectURL(event.target.files[0]);
                      output.onload = function() {
                        URL.revokeObjectURL(output.src) // free memory
                      }
                    };
                  </script>

                  
                  <!-- <input type="file" name="picture[]" multiple="multiple"> -->
                  <!-- <small>Kosongkan jika tidak diisi</small> -->
                </div>
              </div>

              <div class="form-group row">
                <label for="picture" class="col-sm-2 col-form-label">Foto (Tampak Samping)</label>
                <div class="col-sm-3">
                  <input type="file" class="form-control" name="picture1" onchange="loadFile1(event)">
                  
                  <br/>
                  
                  <!-- <font size="2px" id="text_fd" style="visibility: hidden" >Foto Tampak Depan</font> -->
                  <img id="output1" max-height="auto" width="75%" style="border: 1px solid #ddd; border-radius: 4px;  padding: 5px;"/>

                  <script>
                    var loadFile1 = function(event) {
                      var output1 = document.getElementById('output1');
                      output1.src = URL.createObjectURL(event.target.files[0]);
                      output1.onload = function() {
                        URL.revokeObjectURL(output1.src) // free memory
                      }
                    };
                  </script>

                  
                  <!-- <input type="file" name="picture[]" multiple="multiple"> -->
                  <!-- <small>Kosongkan jika tidak diisi</small> -->
                </div>
              </div>

              <div class="form-group row">
                <label for="picture" class="col-sm-2 col-form-label">Foto (Barcode)</label>
                <div class="col-sm-3">
                  <input type="file" class="form-control" name="picture2" onchange="loadFile2(event)">
                  
                  <br/>
                  
                  <!-- <font size="2px" id="text_fd" style="visibility: hidden" >Foto Tampak Depan</font> -->
                  <img id="output2" height="50%" width="auto" style="border: 1px solid #ddd; border-radius: 4px;  padding: 5px;"/>

                  <script>
                    var loadFile2 = function(event) {
                      var output2 = document.getElementById('output2');
                      output2.src = URL.createObjectURL(event.target.files[0]);
                      output2.onload = function() {
                        URL.revokeObjectURL(output2.src) // free memory
                      }
                    };
                  </script>

                  
                  <!-- <input type="file" name="picture[]" multiple="multiple"> -->
                  <!-- <small>Kosongkan jika tidak diisi</small> -->
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