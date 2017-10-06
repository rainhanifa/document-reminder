
<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets')?>/assets/bootstrap-fileupload/bootstrap-fileupload.css" />
<script type="text/javascript" src="<?php echo base_url('assets')?>/assets/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>

<script type="text/javascript">
    function tambah_field(){
        var text = "<label class='col-sm-3 col-lg-2 control-label'>Dokumen</label><div class='col-sm-9 col-lg-9 controls'><div class='col-sm-3'><div class='col-sm-12 col-md-12 controls'><div class='fileupload fileupload-new' data-provides='fileupload'><span class='btn btn-default btn-file'><span class='fileupload-new'>Select file</span><span class='fileupload-exists'>Change</span><input type='file' class='file-input' name='dokumen[]'/></span><span class='fileupload-preview'></span><a href='#' class='close fileupload-exists' data-dismiss='fileupload' style='float: none'></a></div></div></div><div class='col-sm-8'><input type='text' class='form-control' name='tipe_dokumen[]' multiple='multiple' placeholder='Jenis Dokumen'/></div><div class='col-sm-1'><a class='btn btn-circle btn-success pull-right' onclick='tambah_field()'><i class='fa fa-plus'></i></a></div></div>";
        $("#container_upload").append(text);
    }

</script>

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
            <li class="active">Entry Data</li>
        </ul>
    </div>
    <!-- END Breadcrumb -->

    <!-- BEGIN Main Content -->
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-title">
                    <h3><i class="fa fa-bars"></i>Entry Data Master</h3>
                    <div class="box-tool">
                        <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                        <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                    </div>
                </div>
                <div class="box-content">
                <?php if(isset($success)){ ?>
                        <div class="alert alert-success">
                            <button class="close" data-dismiss="alert">&times;</button>
                            Data berhasil diupload!
                        </div>
                <?php }?>
                   <form action="<?php echo base_url()?>master/entry" class="form-horizontal" enctype=multipart/form-data method="POST">
                  
                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Nama Debitur</label>
                            <div class="col-sm-9 col-lg-9 controls">
                                <input type="text" class="form-control" name="nama_client" value="<?php if($_GET) { echo ($_GET['eid']) ? $nama_client: '' ; }?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-3 col-lg-2 control-label">Jenis</label>
                          <div class="col-sm-9 col-lg-9 controls">
                             <select class="form-control chosen" data-placeholder="Pilih Jenis" tabindex="1" name="tipe_client">
                                <option value=""> </option>
                                <option value="1" <?php if($_GET) { echo ($_GET['eid']) ? ($jenis_client == 1) ? 'selected' : '' : '' ;}?>>Perusahaan</option>
                                <option value="2" <?php if($_GET) { echo ($_GET['eid']) ? ($jenis_client == 2) ? 'selected' : '' : '' ;}?>>Perseorangan</option>
                             </select>
                          </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 col-lg-2 control-label">Nama Proyek</label>
                                <div class="col-sm-9 col-lg-9 controls">
                                    <input type="text" name="nama_proyek" class="form-control"
                                                value="<?php if($_GET) { echo (isset($_GET['eid'])) ? $nama_proyek: '' ;}?>"/>
                                </div>
                        </div>

                        <div class="form-group" name="upload_dokumen" id="container_upload">
                            <label class="col-sm-3 col-lg-2 control-label">Dokumen</label>
                            <div class="col-sm-9 col-lg-9 controls">
                                <div class="col-sm-3">
                                    <div class="col-sm-12 col-md-12 controls">
                                         <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <span class="btn btn-default btn-file">
                                                <span class="fileupload-new">Select file</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" class="file-input" name="dokumen[]"  multiple='multiple' />
                                            </span>
                                            <span class="fileupload-preview"></span>
                                            <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none" ></a>
                                         </div>
                                      </div>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" name="tipe_dokumen[]" placeholder="Jenis Dokumen"/>
                                </div>
                                <div class="col-sm-1">
                                    <a class="btn btn-circle btn-success pull-right" onclick="tambah_field();"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>                                   
                        <div class="form-group">
                            <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2">
                               <input type="submit" class="btn btn-primary" value="Save" />
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- END Main Content -->
