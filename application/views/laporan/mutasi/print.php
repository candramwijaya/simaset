<div class="row">
	<div class="col text-center">
		<strong>Data Mutasi Aset</strong>
	</div>
</div>
<div class="row pt-3">
	<div class="col">
		<table class="table table-bordered table-sm">
			<thead>
				<tr>
				<th>No.</th>
				<th>Nama Barang</th>
				<th>User</th>
				<th>Lokasi</th>
				<th>Ke User</th>
				<th>Ke Lokasi</th>
				<th>Tanggal</th>
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
					<td><?=$row['nama_user_m'];?></td>
					<td><?=$row['lokasi_m'];?></td>
					<td><?=$row['nama_user'];?></td>
					<td><?=$row['nama_lokasi'];?></td>
					<td><?=$row['tgl_mutasi'];?></td>
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
  