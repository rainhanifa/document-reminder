<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url()?>assets/assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/assets/font-awesome/css/font-awesome.min.css">
	</head>
	<body>
		<center>
			<h3>LAPORAN DOKUMEN TERSIMPAN</h3>
			<h4>Document Reminder</h4>
		</center>

		<div class="col-md-10 col-md-offset-1">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>No.</th>
						<th>Nama Debitur</th>
						<th>Jenis</th>
						<th>Nama Proyek</th>
						<th>Dokumen Tersimpan</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$counter = 1;
						foreach($dokumen as $d){?>
					<tr>
						<td><?php echo $counter?></td>
						<td><?php echo $d['nama_client'] ?></td>
						<td><?php echo ($d['tipe_client']==1)?'Perusahaan':'Perorangan'; ?></td>
						<td><?php echo $d['nama_proyek'] ?></td>
						<td><?php echo "(".$d['nama_dokumen'].") ".$d['tipe_dokumen']?></td>
						<td><?php echo ($d['status']==1)?'Ada':'Keluar';?></td>
					</tr>
					<?php $counter++; } ?>
				</tbody>
			</table>
		</div>
	</body>
</html>