<html>
	<head>
		<link rel="stylesheet" href="<?php echo base_url()?>assets/assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo base_url()?>assets/assets/font-awesome/css/font-awesome.min.css">
	</head>
	<body>
		<center>
			<h3>LAPORAN DOKUMEN LENGKAP</h3>
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
						<th>Daftar Dokumen Tersimpan</th>
					</tr>
				</thead>
				<tbody>
				<?php $counter = 1;
				if($dokumen){
					foreach($dokumen as $d){?>
					<tr>
						<td><?php echo $counter;?></td>
						<td><?php echo $d['nama_client']?></td>
						<td><?php echo ($d['tipe_client']==1)?'Perusahaan':'Perorangan'; ?></td>
						<td><?php echo $d['nama_proyek']?></td>
						<td><ol>
							<?php
								$list_dokumen = dokumen_lengkap_by_master($d['id']);

								foreach($list_dokumen as $list){
								?>
								<li>(<?php echo $list['nama_dokumen']?>) <?php echo $list['tipe_dokumen']?></li>
								<?php } ?>
							</ol>
						</td>
					</tr>
				<?php $counter++; }}
					else{
						?>
					<tr>
						<td colspan="7">Tidak ada Dokumen</td>
					</tr>
					<?php
						} ?>
				</tbody>
			</table>
		</div>
	</body>
</html>