<link rel="stylesheet" href="<?php echo base_url()?>assets/assets/bootstrap-datepicker/css/datepicker.css">
<script src="<?php echo base_url()?>assets/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

<script>
    $(document).ready(function() {
       // $("#container_client").hide();
       // $("#container_input").hide();
    });
</script>

<script type="text/javascript">
    function load_client()
    {
        var id_client = $("#id_client").val();

        $.ajax({
            url: "<?php echo base_url(); ?>master/get_client_by_id",
            data: "id=" + id_client,
            success: function(html)
            {
                //$("#data_client").html(html);
                $("#container_client").show();
                $("#container_input").show();
            }
        });
    }

    function load_dokumen()
    {
        var id_client = $("#id_client").val();
        $.ajax({
            url: "<?php echo base_url(); ?>master/get_dokumen_by_id_client",
            data: "id_master_data=" + id_client,
            success: function(html)
            {
                $("#list_dokumen").html(html);
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
            <li class="active">Entry Peminjaman</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->

    <div class="row">
    <?php if(isset($success)){ ?>
            <div class="alert alert-success">
                <button class="close" data-dismiss="alert">&times;</button>
                Data peminjaman berhasil disimpan!
            </div>
    <?php }?>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="box">
                <div class="box-title">
                    <h34>Nama Debitur/Nama Proyek</h4>
                </div>
                <div class="box-content">
                    <form action="<?php echo base_url()?>pinjaman/entry" class="form-horizontal" method="POST">
                        <div class="form-group">
                            <div class="col-lg-12 controls">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-search"></i></span>
                                    <input type="text" placeholder="Masukkan nama" class="form-control" name="id_client" id="id_client" />
                                    <span class="input-group-btn">
                                        <input type="submit" class="btn" value="Cari!">
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

        <?php if(isset($client)){?>
        <div class="col-md-9" id="container_client">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Data Client</h4>
                </div>
                <div class="panel-body" id="data_client">
                <?php 
                    foreach($client as $d){
                        $id_client = $d['id'];
                        echo "<div class='row'>
                            <div class='col-md-2'>ID Debitur</div>
                            <div class='col-md-10'>".$id_client."</div>
                          </div>
                          <div class='row'>
                            <div class='col-md-2'>Nama Debitur</div>
                            <div class='col-md-10'>".$d['nama_client']."</div>
                          </div>
                          <div class='row'>
                            <div class='col-md-2'>Jenis</div>
                            <div class='col-md-10'>";
                    echo ($d['tipe_client']==1)?"Perusahaan":"Perorangan";
                    echo "</div>
                         </div>
                          <div class='row'>
                            <div class='col-md-2'>Nama Proyek</div>
                            <div class='col-md-10'>".$d['nama_proyek']."</div>
                          </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

    <?php if(isset($dokumen)){ ?>
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-9" id="container_input">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">Dokumen yang Dipinjam</h4>
                </div>
                <div class="panel-body">
                <form action="<?php echo base_url()?>pinjaman/save" method="post">
                    <input type="hidden" name="id_client" value="<?php echo $id_client?>">
                    <div class="form-group col-sm-12 col-lg-12" id="list_dokumen">
                        <?php
                        
                        foreach($dokumen as $d){
                            echo "<label class='checkbox'>
                                    <input type='checkbox' value='".$d['id_dokumen']."' name='dokumen[]'/>(".$d['nama_dokumen'].") ".$d['tipe_dokumen']."</label>";
                            }
                        ?>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Tanggal Peminjaman</label>
                                <div class="col-sm-6 col-lg-5 controls">
                                    <div class="input-group date date-picker" data-date="12-05-2017" data-date-format="dd-mm-yyyy" data-date-viewmode="years">
                                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                <input class="form-control date-picker" size="16" type="text" value="12-05-2017" name="tanggal_peminjaman">
                                             </div>
                                </div>
                                <div class="col-sm-3 col-lg-5 controls">
                                    <div class="input-group">
                                        <input type="text" name="durasi_pinjam" class="form-control">
                                        <span class="input-group-addon">hari</span>
                                    </div>  
                                    </select>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-9">
                               <input type="submit" class="btn btn-primary" value="Save" />
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
<!-- END Main Content -->

<script>
      $(function() {
            $( "#datepicker" ).datepicker();
      } );
  </script>