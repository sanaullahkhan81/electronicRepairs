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

        <script src="<?=site_url('js/jquery-1.8.3.min.js');?>"></script>
        <link href="<?=site_url('css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?=site_url('css/bootstrap-reset.css');?>" rel="stylesheet">
        <link href="<?=site_url('assets/font-awesome/css/font-awesome.css');?>" rel="stylesheet" />
        <link href="<?=site_url('css/style.css');?>" rel="stylesheet">
    </head>

    <body class="login-body">
        <script type="text/javascript">
            window.base_url = "<?=site_url();?>";
        </script>
        <script type="text/javascript" src="<?=site_url('home/js/login');?>"></script>
        <script type="text/javascript" src="<?=site_url('home/js/status');?>"></script>
        <script type="text/javascript" src="<?=site_url('home/js/validate');?>"></script>

        <div class="container">

            <div class="form-signin container" id="login-form">
                <img src="<?=site_url('img/logo.png');?>">
                <div class="order-check col-lg-12">
                    <div class="input-field col-lg-12">
                        <h2 class="form-signin-heading"><?=$this->lang->line('oppure_traccia');?></h2>
                    </div>
                    <div class="input-field col-lg-12">
                        <div class="form-group">
                            <label>
                                <?=$this->lang->line('cod_riparazione');?>
                            </label>
                            <div class="iconic-input right"><i class="fa fa-hourglass-end"></i>
                                <input id="codice_riparazione" type="text" class="validate form-control" value="">
                            </div>
                        </div>
                    </div>

                    <div class="input-field col-lg-12">
                        <button id='submit' class='btn btn-lg btn-login btn-block btn-warning'><i class="fa fa-eye"></i>
                            <?=$this->lang->line('vedistato');?>
                        </button>
                    </div>
                    <div class="input-field col-lg-12">
                        <div class="centre_box status_box row">
                            <p class="col-lg-6 col-md-12"><b><?=$this->lang->line('Modello_t');?>:</b> <i class="modello"></i></p>
                            <p class="col-lg-6 col-md-12"><b><?=$this->lang->line('Stato_t');?>:</b> <i class="stato"></i></p>
                            <p class="col-lg-6 col-md-12 col_aperto"><b><?=$this->lang->line('Apertoil_t');?>:</b> <i class="aperto"></i></p>
                            <p class="col-lg-6 col-md-12 col_chiuso"><b><?=$this->lang->line('Chiusoil_t');?>:</b> <i class="chiuso"></i></p>
                        </div>
                    </div>

                </div>
                <div style="clear: both;"></div>
            </div>
        </div>

        <link rel="stylesheet" href="<?=site_url('assets/css/toastr.min.css');?>">
        <script src="<?=site_url('assets/js/toastr.min.js');?>"></script>


    </body>

</html>