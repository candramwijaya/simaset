<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Sub Kategori Barang</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item active">Sub Kategori Barang</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="flash-data" data-flashdata="<?=$this->session->flashdata('sukses');?>"></div>
  <div class="flash-data-gagal" data-flashdatagagal="<?=$this->session->flashdata('gagal');?>"></div>

  <!-- Main content -->
  <section class="content">
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <button type="button" data-toggle="modal" data-target="#modal-default" class="btn btn-block bg-gradient-primary">Tambah Data</button>
        </h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
            </div>
        </div>
          <div class="card-body">
            <?php echo form_error('jenis_barang'); ?>
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Kode Sub Kategori</th>
                    <th>Nama Sub Kategori</th>
                    <th>Kategori</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  foreach ($item as $row): ?>
                  <tr>
                    <td><?=$no++;?></td>
                    <td><?=$row['kode_sub'];?></td>
                    <td><?=$row['nama_sub'];?></td>
                    <td><?=$row['nama_kategori'];?></td>
                    <td>
                       <a href="#" data-toggle="modal" data-target="#modal-ubah<?=$row['kode_sub'];?>">
                          <button type="button" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                          </button>
                        </a>
                        <a href="<?=base_url('sub-kategori/hapus/'.$row['kode_sub'])?>" class="btn btn-danger btn-sm tombol-hapus">
                          <i class="fas fa-trash"></i>
                        </a>
                    </td>
                  </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div> 
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            
          </div>
          <!-- /.card-footer-->
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
  <!-- Modal Tambah -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Sub Kategori Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="<?=base_url('sub-kategori/simpan')?>" autocomplete="off" method="post">
            <div class="form-group">
              <label for="kode_sub" class="col-sm-6 col-form-label">Kode Sub Kategori</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" placeholder="Masukan Kode.." name="kode_sub" required>
              </div>
            </div>  
            <div class="form-group">
              <label for="nama_sub" class="col-sm-6 col-form-label">Nama Sub Kategori</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" placeholder="Nama Sub Kategori.." name="nama_sub" required>
              </div>
            </div>
            <div class="form-group">
              <label for="kategori_id" class="col-sm-6 col-form-label">Kategori</label>
              <div class="col-sm-12">
                <select name="kategori_id" class="form-control kategori_id" required>
                  <option value="">Pilih..</option>
                  <?php foreach ($jb as $row): ?>
                    <option value="<?=$row['id_kategori'];?>"><?=$row['nama_kategori'];?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <!-- /.card-body -->                
          </div>
          <div class="modal-footer content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </form>
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal tambah -->
   <!-- Modal Ubah -->
   <?php 
    $no=1;
    foreach ($item as $row): 
      $kode_sub = $row['kode_sub'];
      $kategori_id = $row['kategori_id'];
      $nama_sub = $row['nama_sub'];

    ?>
  <div class="modal fade" id="modal-ubah<?=$kode_sub;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah SUb Kategori Barang</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="<?=base_url('sub-kategori/ubah')?>" autocomplete="off" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="kode_sub" class="col-sm-6 col-form-label">Kode Kategori</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" value="<?=$kode_sub?>" placeholder="Masukan Kode.." name="kode_sub" readonly>
              </div>
            </div>  
            <div class="form-group">
              <label for="nama_sub" class="col-sm-6 col-form-label">Nama Kategori</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" value="<?=$nama_sub?>" placeholder="Nama Kategori.." name="nama_sub" required>
              </div>
            </div>
            <div class="form-group">
              <label for="kategori_id" class="col-sm-6 col-form-label">Kategori</label>
              <div class="col-sm-12">
                <select name="kategori_id" class="form-control kategori_id" required>
                  <option value="">Pilih..</option>
                  <?php foreach ($jb as $row): ?>
                    <option value="<?=$row['id_kategori'];?>" <?=($row['id_kategori'] == $kategori_id)? 'selected':''; ?>><?=$row['nama_kategori'];?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <!-- /.card-body -->                
          </div>
          <div class="modal-footer content-between">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Ubah</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </form>
    </div>
    <!-- /.modal-dialog -->
  </div>
  <?php endforeach ?>
  <!-- /.modal Ubah -->
</div>
<script src="<?=base_url()?>src/backend/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?=base_url()?>src/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "language": {
        "sSearch": "Cari"
      }
    });
  });
</script>

<!-- Select2 -->
<script src="<?=base_url()?>src/backend/plugins/select2/js/select2.full.min.js"></script>
<script>
  $(document).ready(function(){
    $('.kategori_id').select2({
      placeholder: "Pilih..",
      allowClear: true,
      theme: 'bootstrap4'
    });
  });
</script>