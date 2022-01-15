<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Satuan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?=base_url('home')?>">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Data Master</a></li>
            <li class="breadcrumb-item active">Satuan</li>
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
                    <th>ID Satuan</th>
                    <th>Nama Satuan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $no=1;
                  foreach ($item as $row): ?>
                  <tr>
                    <td><?=$no++;?></td>
                    <td><?=$row['id_satuan'];?></td>
                    <td><?=$row['nama_satuan'];?></td>
                    <td>
                       <a href="#" data-toggle="modal" data-target="#modal-ubah<?=$row['id_satuan'];?>">
                          <button type="button" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                          </button>
                        </a>
                        <a href="<?=base_url('satuan/hapus/'.$row['id_satuan'])?>" class="btn btn-danger btn-sm tombol-hapus">
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
          <h4 class="modal-title">Tambah Satuan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="<?=base_url('satuan/simpan')?>" autocomplete="off" method="post">
            <div class="form-group">
              <label for="id_satuan" class="col-sm-6 col-form-label">ID Satuan</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" placeholder="Masukan ID.." name="id_satuan" required>
              </div>
            </div>  
            <div class="form-group">
              <label for="nama_satuan" class="col-sm-6 col-form-label">Nama Satuan</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" placeholder="Nama Satuan.." name="nama_satuan" required>
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
      $id_satuan = $row['id_satuan'];
      $nama_satuan = $row['nama_satuan'];

    ?>
  <div class="modal fade" id="modal-ubah<?=$id_satuan;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Satuan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="<?=base_url('satuan/ubah')?>" autocomplete="off" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label for="id_satuan" class="col-sm-6 col-form-label">ID Satuan</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" value="<?=$id_satuan?>" placeholder="Masukan ID.." name="id_satuan" readonly>
              </div>
            </div>  
            <div class="form-group">
              <label for="nama_satuan" class="col-sm-6 col-form-label">Nama Satuan</label>
              <div class="col-sm-12">
                <input type="text" class="form-control" value="<?=$nama_satuan?>" placeholder="Nama Kategori.." name="nama_satuan" required>
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
