<div class="row">
	<div class="col text-center">
		<strong>Data Peminjaman Aset</strong>
	</div>
</div>
<div class="row pt-3">
	<div class="col">
		<table class="table table-bordered table-sm">
			<thead>
				<tr>
				<th>No.</th>
				<th>Nama Barang</th>
				<th>Jumlah</th>
				<th>Kondisi</th>
				<th>No. Pinjaman</th>
				<th>Tgl Pinjam</th>
				<th>Tgl Kembali</th>
				<th>Status</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no=1;
				foreach ($item as $row): ?>
				<tr>
				<td><?=$no++;?></td>
				<td><?=$row['nama_barang'];?></td>
				<td><?=$row['jml_pinjam'];?></td>
				<td><?=$row['kondisi_pinjam'];?></td>
				<td><?=$row['no_pinjam'];?></td>
				<td><?=$row['tgl_pinjam'];?></td>
				<td><?=$row['tgl_kembali'];?></td>
				<td><?=$row['status'];?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
		</table>		
	</div>
</div>
<div class="row pt-4">
	<div class="col-md-6">
		
	</div>
	<div class="col-md-6 text-right">
		<p>Jakarta, <?=tgl_indo(date('Y-m-d'))?></p>
		<p class="ex1">Kepala Bagian</p>
		______________</br>
	</div>
</div> 			
  