<link rel="stylesheet" href="<?php echo base_url()?>assets/assets/data-tables/bootstrap3/dataTables.bootstrap.css" />
<div id="main-content">
    <!-- BEGIN Page Title >
    <div class="page-title">
        <div>
            <h1>Hello!</h1>
            <h4>A horizontal menu sample in full width page</h4>
        </div>
    </div>
    <!-- END Page Title -->

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url()?>">Home</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active">Daftar Pinjaman</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Daftar Pinjaman</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="table-responsive" style="border:0">
                        <table class="table table-advance" id="data1">
                            <thead data-sortable="true">
                                <tr>
                                    <th>Nomor</th>
                                    <th>Tanggal Pinjaman</th>
                                    <th>Tanggal Jatuh Tempo</th>
                                    <th>Nama Client</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($pinjaman){
                                    $counter = 1;
                                    foreach($pinjaman as $row){?>
                                <tr>
                                    <td><?php echo $counter ?></td>
                                    <td><?php echo $row['tanggal_peminjaman']?></td>
                                    <td><?php echo $row['tanggal_jatuh_tempo']?></td>
                                    <td><?php echo $row['nama_client']?></td>
                                    <td><a href="#modal_document" data-toggle="modal" data-target="#modal_document"
                                            data-id="<?php echo $row['id']?>" class="load_document"><?php echo get_status_pinjaman_by_id($row['id'])?></a></td>
                                </tr>
                                <?php $counter++;}
                                    }
                                    else
                                        { ?>
                                <tr>
                                    <td colspan="5">Tidak ada data pinjaman</td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- END Main Content -->

<!-- Modal -->
<div class="modal fade" id="modal_document" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4><span class="glyphicon glyphicon-lock"></span> Daftar Dokumen Belum Kembali</h4>
            </div>
            <div class="modal-body" id="list_dokumen">
            </div>
        </div>
    </div>
</div>


<script type="text/javascript" src="<?php echo base_url('assets')?>/assets/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url('assets')?>/assets/data-tables/bootstrap3/dataTables.bootstrap.js"></script>


<script>
    jQuery(function($){
        $('a.load_document').click(function(ev){
            ev.preventDefault();
            var uid = $(this).data('id');
            $.get('<?php echo base_url(); ?>pinjaman/get_dokumen_by_id_pinjam?id=' + uid, function(html){
                $("#list_dokumen").html(html);
            });
        });
    });
</script>