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
                <a href="index.html">Home</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active">Master Data</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <?php if(isset($alert)){ ?>
            <div class="alert alert-danger">
                <button class="close" data-dismiss="alert">&times;</button>
                <?php echo $alert;?>
            </div>
    <?php }?>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Master Data</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                    <div class="table-responsive" style="border:0">
                        <table class="table table-advance" id="data1">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>ID Master Data</th>
                                    <th>Nama Debitur</th>
                                    <th>Jenis</th>
                                    <th>Nama Proyek</th>
                                    <th>Dokumen</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $counter = 1;
                                    foreach($client as $row){?>
                                <tr>
                                    <td><?php echo $counter?></td>
                                    <td><?php echo $row['id']?></td>
                                    <td><?php echo $row['nama_client']?></td>
                                    <td><?php echo ($row['tipe_client']==1)?'Perusahaan':'Perorangan'?></td>
                                    <td><?php echo $row['nama_proyek']?></td>
                                    <td><a href="#modal_document" data-toggle="modal" data-target="#modal_document"
                                            data-id="<?php echo $row['id']?>" class="load_document"><i class="fa fa-folder-open"></i>Lihat Dokumen</a></td>
                                    <td><a href="<?php echo base_url() ?>master/entry?eid=<?php echo $row['id']?>"><i class="fa fa-edit"></i> Edit </a> |
                                        <a href="#" data-href="<?php echo base_url()?>master/delete?id=<?php echo $row['id']?>" data-toggle="modal" data-target="#confirm-delete"><i class="fa fa-trash-o"></i> Hapus</a></td>
                                </tr>
                                <?php $counter++;
                                    }
                                ?>
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
                <h4><span class="glyphicon glyphicon-lock"></span> Daftar Dokumen</h4>
            </div>
            <div class="modal-body" id="list_dokumen">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="confirm-delete" ole="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Konfirmasi Hapus
            </div>
            <div class="modal-body">
                Anda yakin menghapus data ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <a class="btn btn-danger btn-ok">Hapus</a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });
</script>
<script>
    jQuery(function($){
        $('a.load_document').click(function(ev){
            ev.preventDefault();
            var uid = $(this).data('id');
            $.get('<?php echo base_url(); ?>master/get_dokumen_by_id?id=' + uid, function(html){
                $("#list_dokumen").html(html);
            });
        });
    });
</script>