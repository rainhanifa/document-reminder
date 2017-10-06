<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Document Reminder</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <!--base css styles-->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/assets/font-awesome/css/font-awesome.min.css">

        <!--page specific css styles-->

        <!--flaty css styles-->
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/flaty.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/css/flaty-responsive.css">

        <link rel="shortcut icon" href="<?php echo base_url()?>assets/img/favicon.png">
        <!-- basic scripts-->

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url()?>assets/assets/jquery/jquery-2.1.4.min.js"><\/script>')

        </script>

        <!--basic scripts-->
        <script src="<?php echo base_url()?>assets/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url()?>assets/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="<?php echo base_url()?>assets/assets/jquery-cookie/jquery.cookie.js"></script>

        <!--page specific plugin scripts-->


        <!--flaty scripts-->
        <script src="<?php echo base_url()?>assets/js/flaty.js"></script>
        <script src="<?php echo base_url()?>assets/js/flaty-demo-codes.js"></script>

        <!-- -->
    </head>
    <body>

        <!-- BEGIN Theme Setting -->
        <div id="theme-setting">
            <a href="#"><i class="fa fa-gears fa fa-2x"></i></a>
            <ul>
                <li>
                    <span>Skin</span>
                    <ul class="colors" data-target="body" data-prefix="skin-">
                        <li class="active"><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="magenta" href="#"></a></li>
                        <li><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span>Navbar</span>
                    <ul class="colors" data-target="#navbar" data-prefix="navbar-">
                        <li class="active"><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="magenta" href="#"></a></li>
                        <li><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span>Sidebar</span>
                    <ul class="colors" data-target="#main-container" data-prefix="sidebar-">
                        <li class="active"><a class="blue" href="#"></a></li>
                        <li><a class="red" href="#"></a></li>
                        <li><a class="green" href="#"></a></li>
                        <li><a class="orange" href="#"></a></li>
                        <li><a class="yellow" href="#"></a></li>
                        <li><a class="pink" href="#"></a></li>
                        <li><a class="magenta" href="#"></a></li>
                        <li><a class="gray" href="#"></a></li>
                        <li><a class="black" href="#"></a></li>
                    </ul>
                </li>
                <li>
                    <span></span>
                    <a data-target="navbar" href="#"><i class="fa fa-square-o"></i> Fixed Navbar</a>
                    <a class="hidden-inline-xs" data-target="sidebar" href="#"><i class="fa fa-square-o"></i> Fixed Sidebar</a>
                </li>
            </ul>
        </div>
        <!-- END Theme Setting -->

        <!-- BEGIN Navbar -->
        <div id="navbar" class="navbar">
            <button type="button" class="navbar-toggle navbar-btn for-nav-horizontal collapsed" data-toggle="collapse" data-target="#nav-horizontal">
                <span class="fa fa-bars"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url()?>dashboard">
                <small>
                    <i class="fa fa-desktop"></i>
                    DOCREM APP
                </small>
            </a>

            <!-- BEGIN Navbar Buttons -->
            <ul class="nav flaty-nav pull-right">

                <!-- BEGIN Button Notifications -->

                 <?php
                    $a = get_jumlah_dokumen_akan_jatuh_tempo();
                    $b = get_jumlah_dokumen_jatuh_tempo();

                    $total_notif = $a+$b;
                    ?>
                <li class="hidden-xs">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="fa fa-bell"></i>
                        <?php if($total_notif > 0){ echo "<span class='badge badge-important'>$total_notif</span>";} ?>
                    </a>

                    <!-- BEGIN Notifications Dropdown -->
                    <ul class="dropdown-navbar dropdown-menu">
                        <li class="nav-header">
                            <i class="fa fa-warning"></i><?php echo $total_notif;?> Notifikasi
                        </li>

                        <li class="notify">
                            <a href="<?php echo base_url()?>pinjaman/akan_jatuh_tempo">
                                <i class="fa fa-warning orange"></i>
                                <p>Dokumen Akan Jatuh Tempo</p>
                                <span class="badge badge-warning"><?php echo $a;?></span>
                            </a>
                        </li>

                        <li class="notify">
                            <a href="<?php echo base_url()?>pinjaman/lewat_jatuh_tempo">
                                <i class="fa fa-times-circle pink"></i>
                                <p>Dokumen Belum Kembali</p>
                                <span class="badge badge-warning"><?php echo $b;?></span>
                            </a>
                        </li>

                        <li class="more">
                            <a href="<?php echo base_url()?>pinjaman">Lihat semua</a>
                        </li>
                    </ul>
                    <!-- END Notifications Dropdown -->
                </li>
                <!-- END Button Notifications -->

                <!-- BEGIN Button User -->
                <li class="user-profile">
                    <a data-toggle="dropdown" href="#" class="user-menu dropdown-toggle">
                        <img class="nav-user-photo" src="<?php echo base_url()?>assets/img/demo/avatar/avatar.png" alt="Admin's Photo" />
                        <span id="user_info">
                            Administrator
                        </span>
                        <b class="arrow fa fa-caret-down"></b>
                    </a>

                    <!-- BEGIN User Dropdown -->
                    <ul class="dropdown-menu dropdown-navbar" id="user_menu">
                        <li>
                            <a href="<?php echo base_url()?>dashboard/deskripsi">
                                <i class="fa fa-cog"></i>
                                Setting
                            </a>
                        </li>

                        <li class="divider visible-xs"></li>

                        <li class="visible-xs">
                            <a href="#">
                                <i class="fa fa-bell"></i>
                                Notifications
                                <span class="badge badge-important">8</span>
                            </a>
                        </li>

                        <li>
                            <a href="<?php echo base_url()?>auth/logout">
                                <i class="fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                    <!-- BEGIN User Dropdown -->
                </li>
                <!-- END Button User -->
				
            </ul>
            <!-- END Navbar Buttons -->

            <!-- BEGIN Horizontal Menu -->
            <ul class="nav flaty-nav navbar-collapse collapse" id="nav-horizontal">
				<li>
                    <a href="<?php echo base_url('master/entry')?>">
                        <i class="fa fa-edit"></i>
                        <span>Entry Data</span>
                    </a>
                </li>
				<li>
                    <a href="<?php echo base_url('master/view') ?>">
                        <i class="fa fa-th-large"></i>
                        <span>Master Data</span>
                    </a>
                </li>

				<li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-list-alt"></i>
                        <span>Peminjaman</span>
                        <b class="arrow fa fa-caret-down"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-navbar">
                        <li><a href="<?php echo base_url('pinjaman/view') ?>"><i class="fa fa-list-alt"></i>Daftar Pinjaman</a></li>
                        <li><a href="<?php echo base_url('pinjaman/entry') ?>"><i class="fa fa-share-square-o"></i>Entry Peminjaman</a></li>
                        <li><a href="<?php echo base_url('pinjaman/kembali') ?>"><i class="fa fa-mail-reply"></i>Entry Pengembalian</a></li>
                    </ul>
                </li>
                
				<li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-file"></i>
                        <span>Report</span>
                        <b class="arrow fa fa-caret-down"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-navbar">
                        <li><a href="<?php echo base_url('report/dokumen_tersimpan') ?>">Dokumen Tersimpan</a></li>
                        <li><a href="<?php echo base_url('report/dokumen_lengkap') ?>">Dokumen Lengkap</a></li>
                        <li><a href="<?php echo base_url('report/dokumen_keluar') ?>">Dokumen Keluar</a></li>
                    </ul>
                </li>
                
            </ul>
            <!-- END Horizontal Menu -->

        </div>
        <!-- END Navbar -->

        <!-- BEGIN Container -->
        <div class="container" id="main-container">

            <!-- BEGIN Content -->
            <?php echo $contents; ?>
                <footer>
                    <p>2017 © Aji Brama</p>
                </footer>

                <a id="btn-scrollup" class="btn btn-circle btn-lg" href="#"><i class="fa fa-chevron-up"></i></a>
            </div>
            <!-- END Content -->
        </div>
        <!-- END Container -->

    </body>
</html>
