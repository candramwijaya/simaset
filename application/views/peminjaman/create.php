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
            <h1>Peminjaman Aset</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?=base_url('peminjaman')?>">Peminjaman Aset</a></li>
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
          <?php if ($this->session->flashdata('failed')) { ?>
            <div class="alert alert-danger"> 
              <?= $this->session->flashdata('failed') ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button> 
            </div>
          <?php } ?>
          <form class="form-horizontal" action="<?=base_url('peminjaman/simpan')?>" autocomplete="off" method="post">
            <div class="card-body">
              <div class="form-group row">
                <label for="aset_id" class="col-sm-2 col-form-label">Nama Aset</label>
                <div class="col-sm-6">
                    <select name="aset_id" id="aset_id" class="form-control selectx" required>
                      <option value="">- Pilih --</option>
                      <?php foreach ($aset as $row): ?>
                        <option value="<?=$row['id_aset'];?>"><?=$row['nama_barang'];?></option>
                      <?php endforeach ?>      
                    </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="jml_pinjam" class="col-sm-2 col-form-label">Jumlah</label>
                <div class="col-sm-6">
                   <input type="number" name="jml_pinjam" placeholder="Masukan Jumlah.." class="form-control" required>     
                </div>
              </div>
              <div class="form-group row">
                <label for="kondisi_pinjam" class="col-sm-2 col-form-label">Kondisi</label>
                <div class="col-sm-6">
                  <input type="text" name="kondisi_pinjam" placeholder="Masukan Kondisi.." class="form-control" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="no_pinjam" class="col-sm-2 col-form-label">No. Pinjam</label>
                <div class="col-sm-6">
                  <input type="text" name="no_pinjam" placeholder="Masukan No. Pinjam" class="form-control" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="tgl_pinjam" class="col-sm-2 col-form-label">Tanggal Pinjam</label>
                <div class="col-sm-6">
                  <input type="date" class="form-control" name="tgl_pinjam" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="tgl_pinjam" class="col-sm-2 col-form-label">Tanggal Kembali</label>
                <div class="col-sm-6">
                  <input type="date" class="form-control" name="tgl_kembali" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="status" class="col-sm-2 col-form-label">Status</label>
                <div class="col-sm-6">
                  <input type="text" class="form-control" name="status" placeholder="Masukan Status.." required>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
              <a href="<?=base_url('peminjaman')?>">
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
</script>