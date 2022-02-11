<!-- Content Wrapper. Contains page content -->
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
            <li class="breadcrumb-item active">Detail Data</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
     <div class="container-fluid">
        <div class="row">
           <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Detail Pengadaan Aset</h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
              <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                  <th>No.</th>
                  <!-- <th>Nama</th>
                  <th>Penempatan</th> -->
                  <th>Nama Aset</th>
                  <th>Volume / Jumlah</th>
                  <th>Harga Satuan</th>
                  <th>Tahun</th>
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
                    </tr>
                  <?php endforeach ?>
            
                </tbody>
              </table>
                  <br/>
                  <a href="<?=base_url('pengadaan')?>">
                    <button type="button" class="btn btn-danger">Kembali</button>
                  </a>
              </div>
              <!-- /.card-body -->            
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
