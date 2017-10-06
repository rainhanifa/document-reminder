
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
<script type="text/javascript" src="<?php echo base_url('assets')?>/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script> 
<script type="text/javascript" src="<?php echo base_url('assets')?>/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>

<div id="main-content">
    <!-- BEGIN Breadcrumb -->
    <div id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="<?php echo base_url()?>">Home</a>
                <span class="divider"><i class="fa fa-angle-right"></i></span>
            </li>
            <li class="active">Setting</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box">
                <div class="box-title">
                    <h3>Deskripsi Aplikasi</h3>
                </div>
                <div class="box-content">
                <?php if(isset($success)){ ?>
                        <div class="alert alert-success">
                            <button class="close" data-dismiss="alert">&times;</button>
                            Deskripsi Berhasil Diubah
                        </div>
                <?php }?>
                    <form action="<?php base_url()?>deskripsi/view" class="form-horizontal" method="POST" id="deskripsi_form">
                        
                        <div class="form-group">
                            <div class="col-sm-9 col-lg-10 controls">
                                <div class="input-group col-md-12">
                                    <textarea class="form-control wysihtml5" rows="6" id="wysdeskripsi"><?php echo $deskripsi?></textarea>
                                </div>
                                <input type="hidden" id="deskripsi" name="deskripsi"/>

                                <div class="input-group">
                                    <input type="submit" class="btn" value="Simpan">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $("#deskripsi_form").submit(function() {
           // Retrieve the HTML from the plugin
           var isi = $('#wysdeskripsi').val();
           // Put this in the hidden field
           $("#deskripsi").val(isi);
        });
    </script>

<!-- END Main Content -->
