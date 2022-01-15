<div class="row">
	<div class="col text-center">
		<strong>Laporan Pengadaan Aset <?=$lokasi['nama_lokasi']?></strong>
	</div>
</div>
<div class="row pt-3">
	<div class="col">
		<table class="table table-bordered table-sm">
			<thead>
				<th>NO.</th>
				<th>NAMA</th>
				<th style="text-align: center;">VOLUME</th>
				<th>SATUAN</th>
				<th style="text-align: center;">HARGA (Rp.)</th>
				<th style="text-align: center;">JUMLAH (Rp.)</th>
			</thead>
			<tbody>
				<?php 
				$sum=0; 
				$no=1; 
					foreach ($pnd as $row): 
				$sum+=$row['volume']*$row['harga_satuan'];			
				?>		
				<tr>
					<td><?=$no++;?></td>
					<td><?=$row['nama_aset']?></td>
					<td style="text-align: center;"><?=$row['volume']?></td>
					<td><?=$row['satuan']?></td>
					<td style="text-align: right;"><?=laporan($row['harga_satuan'])?></td>
					<td style="text-align: right;"><?=laporan($row['volume']*$row['harga_satuan'])?></td>
				</tr>
				<?php endforeach ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5"><b>Jumlah</b></td>
					<td style="text-align: right;"><?=laporan($sum);?></td>
				</tr>
			</tfoot>
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
