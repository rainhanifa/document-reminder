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
        <style type="text/css">
            .background {
                background:url('<?php echo base_url()?>assets/img/wallpaper.jpg');
                position: relative;
            }

            .layer {
                background-color: rgba(248, 247, 216, 0.7);
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
            }
        </style>
    </head>
    <body class="login-page">
        <div class="background">
        <div class="layer">
        <!-- BEGIN Main Content -->
        <div class="login-wrapper">
            <!-- BEGIN Login Form -->
            <?php echo form_open('auth/login'); ?>
                <h3>Document Reminder App</h3>
                <hr/>
                <?php if($error != ""){ ?>
                        <div class="alert alert-danger">
                            <button class="close" data-dismiss="alert">&times;</button>
                            <?php echo $error;?>
                        </div>
                <?php }?>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" placeholder="Username" class="form-control" name="username"/>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="password" placeholder="Password" class="form-control" name="password" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="submit" class="btn btn-primary form-control" name="submit" value="Login" />
                    </div>
                </div>
            </form>
            <!-- END Login Form -->
            <!-- END Register Form -->
        </div>
        <!-- END Main Content -->


        <!--basic scripts-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo base_url()?>assets/jquery/jquery-2.1.4.min.js"><\/script>')</script>
        <script src="<?php echo base_url()?>assets/assets/bootstrap/js/bootstrap.min.js"></script>

        <script type="text/javascript">
            function goToForm(form)
            {
                $('.login-wrapper > form:visible').fadeOut(500, function(){
                    $('#form-' + form).fadeIn(500);
                });
            }
        </script>
    </div>
    </div>
    </body>
</html>
