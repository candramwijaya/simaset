<table id="example1" class="table table-bordered table-striped table-sm">
<thead>
    <tr>
    <th>No.</th>
    <th>Kode Kategori</th>
    <th>Nama Kategori</th>
    <th>Terakhir Update</th>
    <th>Aksi</th>
    </tr>
</thead>
<tbody>
    <?php 
    $no=1;
    foreach ($kategori as $row): ?>
    <tr>
    <td><?=$no++;?></td>
    <td><?=$row['kode_kategori'];?></td>
    <td><?=$row['nama_kategori'];?></td>
    <td><?=date('d F Y H:i', strtotime($row['updated_at']));?></td>
    <td>
        <a href="#" data-toggle="modal" data-target="#modal-ubah<?=$row['id_kategori'];?>">
            <button type="button" class="btn btn-info btn-sm">
            <i class="fas fa-edit"></i>
            </button>
        </a>
        <a href="<?=base_url('kategori/hapus/'.$row['id_kategori'])?>" class="btn btn-danger btn-sm tombol-hapus">
            <i class="fas fa-trash"></i>
        </a>
    </td>
    </tr>
    <?php endforeach ?>
</tbody>
</table>