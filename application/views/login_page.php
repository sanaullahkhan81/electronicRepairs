<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="Mosaddek">
        <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
        <link rel="shortcut icon" href="img/favicon.png">

        <title>
            <?=$impostazioni[0]['titolo']; ?> -
            <?=$this->lang->line('login_title');?>
        </title>

        <script>
            <?=include(FCPATH.'js/jquery.js');?>
        </script>
        <link href="<?=site_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
        <link href="<?=site_url('css/hover.css'); ?>" rel="stylesheet">
        <link href="<?=site_url('css/bootstrap-reset.css'); ?>" rel="stylesheet">
        <link href="<?=site_url('css/style.css');?>" rel="stylesheet">
        <link href="<?=site_url('assets/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
    </head>

    <?php 
    $colore = $impostazioni[0]['colore_prim'];
    echo '<style id="colori">';
    $alfa = $this->Impostazioni_model->hex2rgba($impostazioni[0]['colore_prim'], 0.8);
    include 'js/colori_js.php';
    echo '</style>';
    ?>
    <script>
        jQuery(document).ready(function() {
            $("#black").fadeOut(500);
        });
    </script>

    <body class="login-body admin">
        <script type="text/javascript">
            window.base_url = "<?=site_url();?>";
        </script>
        <script>
            <?=include(FCPATH.'js/jquery.js');?>
        </script>
        <script type="text/javascript" src="<?=site_url('home/js/login');?>"></script>
        <script type="text/javascript" src="<?=site_url('home/js/status');?>"></script>
        <script type="text/javascript" src="<?=site_url('home/js/validate');?>"></script>

        <div id="login_head">
            <img src="<?= ($impostazioni[0]['logo'] == 'default') ? site_url('img').'/logo_nav.png' : site_url('img').'/'.$impostazioni[0]['logo']; ?>">
        </div>
        <div style="clear: both;"></div>

        <div id="login">
            <form role="form">
                <div class="login-wrap">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3> <?= $this->lang->line('effettua_accesso');?></h3>
                        </div>
                    </div>
                    <p class="tips"></p>

                    <div class="form-group">
                        <input id="email" type="text" class="validate form-control" required="">
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" class="validate form-control" required="">
                    </div>


                    <button class="btn btn-login btn-block btn-success" id="loginButton"><i class="fa fa-check-square-o"></i>
                        <?=$this->lang->line('accedi');?>
                    </button>

                </div>
            </form>
        </div>

        <link rel="stylesheet" href="<?=site_url('assets/css/toastr.min.css');?>">
        <script src="<?=site_url('assets/js/toastr.min.js');?>"></script>
        <script src="<?=site_url('js/bootstrap.min.js'); ?>"></script>


    </body>

</html>