<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url()?>assets/assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/assets/font-awesome/css/font-awesome.min.css">
	</head>
	<script>
	$(document).ready(function() {
		window.print();
	}
	</script>

	<body>
		<center>
			<h3>LAPORAN DOKUMEN KELUAR</h3>
			<h4>Document Reminder</h4>
		</center>

		<div class="col-md-10 col-md-offset-1">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>Dokumen Keluar</th>
						<th>Nama Debitur</th>
						<th>Jenis </th>
						<th>Nama Proyek</th>
						<th>Tanggal Keluar</th>
						<th>Tanggal Jatuh Tempo</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$counter = 1;
						if($dokumen){
						foreach($dokumen as $d){?>
					<tr>
						<td><?php echo $counter;?></td>
						<td><?php echo $d['tipe_dokumen'];?></td>
						<td><?php echo $d['nama_client'];?></td>
						<td><?php echo ($d['tipe_client']==1)?'Perusahaan':'Perorangan'; ?></td>
						<td><?php echo $d['nama_proyek'];?></td>
						<td><?php echo $d['tanggal_peminjaman'];?></td>
						<td><?php echo $d['tanggal_jatuh_tempo'];?></td>
					</tr>
					<?php $counter++; }}
					else{
						?>
					<tr>
						<td colspan="7">Tidak Ada Dokumen</td>
					</tr>
					<?php
						} ?>
				</tbody>
			</table>
		</div>
	</body>
</html>