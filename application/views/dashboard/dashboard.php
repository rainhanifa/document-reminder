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
                    </ul>
                </div>
                <!-- END Breadcrumb -->

                <!-- BEGIN Main Content -->
                <div class="row">
                    <div class="col-md-7">
                        <div class="box">
                            <div class="col-md-12">
                                <div class="tile">
                                    <p class="title">Hello, Administrator</p>
                                    <?php echo $deskripsi;?>
                                    <div class="img img-bottom">
                                        <i class="fa fa-desktop"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="box box-green">
                            <div class="box-title">
                                <h3><i class="fa fa-check"></i> Informasi</h3>
                                <div class="box-tool">
                                    <a data-action="collapse" href="#"><i class="fa fa-chevron-up"></i></a>
                                    <a data-action="close" href="#"><i class="fa fa-times"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <ul class="todo-list">
                                    <li>
                                        <div class="todo-desc">
                                            <p><a href="<?php echo base_url()?>pinjaman/akan_jatuh_tempo">Dokumen akan jatuh tempo</a></p>
                                        </div>
                                        <div class="todo-actions">
                                            <span class="label label-warning"><?php echo get_jumlah_dokumen_akan_jatuh_tempo()?></span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="todo-desc">
                                            <p><a href="<?php echo base_url()?>pinjaman/lewat_jatuh_tempo">Dokumen belum kembali setelah jatuh tempo</a></p>
                                        </div>
                                        <div class="todo-actions">
                                            <span class="label label-important"><?php echo get_jumlah_dokumen_jatuh_tempo()?></span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Main Content -->
                