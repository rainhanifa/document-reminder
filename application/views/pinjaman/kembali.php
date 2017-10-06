<link rel="stylesheet" href="<?php echo base_url()?>assets/assets/bootstrap-datepicker/css/datepicker.css">
<script src="<?php echo base_url()?>assets/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>


<script>
    $(document).ready(function() {
        $("#container_client").hide();
        $("#container_input").hide();
    });
</script>

<script type="text/javascript">
    function load_client()
    {
        var id_cari = $("#id_cari").val();

        $.ajax({
            url: "<?php echo base_url(); ?>pinjaman/get_dokumen_kembali_by_nama_client",
            data: "id=" + id_cari,
            success: function(html)
            {
                $("#data_client").html(html);
                //$("#nama_dokumen").val(id_cari);
                $("#container_client").show();
                load_dokumen(id_cari);
            }
        });
    }

    
    function load_dokumen(dicari)
    {
        $.ajax({
            url: "<?php echo base_url(); ?>pinjaman/get_dokumen_kembali_by_id_client",
            data: "id=" + dicari,
            success: function(html)
            {
                $("#container_input").html(html);
                //$("#nama_dokumen").val(id_cari);
                $("#container_input").show();
                $("#datepicker").datepicker();
            }
        });
    }
</script>



<div id="main-content">

    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url()?>">Home</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url('pinjaman')?>">Pinjaman</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active">Entry Pengembalian</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <?php if(isset($success)){ ?>
        <div class="row">
            <div class="alert alert-success">
                <button class="close" data-dismiss="alert">&times;</button>
                Pengembalian dokumen berhasil!
            </div>
        </div>
    <?php }?>
    <div class="row">
        <div class="col-md-3">
            <div class="box">
                <div class="box-title">
                    <h4>Nama Proyek/Nama Debitur</h4>
                </div>
                <div class="box-content">
                    <form action="#" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-lg-12 controls">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <input type="text" placeholder="Masukkan Nama" class="form-control" id="id_cari" />
                                    <span class="input-group-btn">
                                        <button class="btn" type="button" onClick="load_client()">Cari!</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php if(isset($client)){?>
                        <p>Hasil pencarian untuk "<?php echo $hasil_pencarian;?>"</p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-9" id="container_client">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Data Dokumen</h4>
                </div>
                <div class="panel-body" id="data_client">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-9" id="container_input">
        </div>
    </div>

<!-- END Main Content -->