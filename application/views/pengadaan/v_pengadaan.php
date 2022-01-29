<link rel="stylesheet" href="<?=base_url()?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
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
            <li class="breadcrumb-item active">Lihat Data</li>
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
          Data Pengadaan Aset
        </h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
            </div>
        </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                  <th>No.</th>
                  <th>Tanggal Pengajuan</th>
                  <th>User</th>
                  <th>Jabatan</th>
                  <th>Tahun Pengadaan</th>
                  <th>Jumlah Item</th>
                  <th>Total Harga</th>
                  <th>Status Pengajuan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                  <?php $no=1; foreach ($item as $row): ?>               
                  <tr>
                    <td><?=$no++;?></td>
                    <td><?= date('d M Y',strtotime($row['tgl_keranjang']));?></td>
                    <td><?=$row['nama_user'];?></td>
                    <td><?=$row['jabatan'];?></td>
                    <td><?=$row['tahun_pengadaan'];?></td>
                    <td><?=number_format($row['Jumlah'],0);?></td>
                    <td><?=number_format($row['total'],0);?></td>
                    <td><?php if($row['status']=='0'){echo 'Pengajuan SPV';}else{
                      if($row['status']=='1'){echo 'Pengajuan MGR';}}?></td>
                      <td>
                        <a href="<?=base_url('pengadaan/excel/'.$row['tgl_keranjang'])?>" class="btn btn-success btn-sm">
                          <i class="fas fa-download"></i>
                        </a>
                        <a href="<?=base_url('pengadaan/detail/'.$row['tgl_keranjang'])?>" class="btn btn-success btn-sm">
                          <i class="fas fa-eye"></i>
                        </a>
                        <a href="<?=base_url('pengadaan/hapus/'.$row['tgl_keranjang'])?>" class="btn btn-danger btn-sm tombol-hapus">
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
