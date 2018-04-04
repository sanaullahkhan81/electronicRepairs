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

    <body class="login-body">
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
            <a href="/login" style="background: rgba(255, 255, 255, 0.45); float: right; margin: 0 10px 0; padding: 10px 30px; border: 1px solid rgba(255, 255, 255, 0.52); color: #e67e22; font-weight: bold;">LOGIN AREA</a>
            <a href="/employee" style="background: rgba(255, 255, 255, 0.45); float: right; margin: 0 10px 0; padding: 10px 30px; border: 1px solid rgba(255, 255, 255, 0.52); color: #e67e22; font-weight: bold;">EMPLOYEE AREA</a>
            <a href="/engineer" style="background: rgba(255, 255, 255, 0.45); float: right; margin: 0 10px 0; padding: 10px 30px; border: 1px solid rgba(255, 255, 255, 0.52); color: #e67e22; font-weight: bold;">ENGINEER AREA</a>
            <img src="<?= ($impostazioni[0]['logo'] == 'default') ? site_url('img').'/logo_nav.png' : site_url('img').'/'.$impostazioni[0]['logo']; ?>">
        </div>
        <div style="clear: both;"></div>
        </div>
        <div id="status">
            <div id="check">
                <h3> <?= $this->lang->line('oppure_traccia');?></h3>
                <div class="input-field">
                    <div class="form-group">
                        <label>
                            <?=$this->lang->line('cod_riparazione');?>
                        </label>
                        <p>
                            <?=$this->lang->line('desc_riparazione');?>
                        </p>
                        <div class="iconic-input right">
                            <input type="hidden" name="code_login_type" id="code_login_type" value="status"/>
                            <input id="codice_riparazione" type="text" class="validate form-control" placeholder="<?=$this->lang->line('inp_riparazione');?>" value="">
                        </div>
                    </div>
                </div>

                <div class="input-field">
                    <button id='submit' class='btn btn-lg btn-login btn-block'><i class="fa fa-eye"></i>
                        <?=$this->lang->line('vedistato');?>
                    </button>
                </div>
                <div class="input-field">
                    <div class="centre_box status_box">
                        <div class="row">
                            <div class="col-md-12 col-lg-6 bio-row">
                                <p><span class="bold"><i class="fa fa-user"></i> <?= $this->lang->line('Cliente_t');?> </span><span id="clientec"></span></p>
                            </div>
                            <div class="col-md-12 col-lg-6 bio-row">
                                <p><span class="bold"><i class="fa fa-barcode"></i> <?= $this->lang->line('ID_t');?> </span><span id="codicec"></span></p>
                            </div>
                            <div class="col-md-12 col-lg-6 bio-row stato">
                                <p><span class="bold"><i class="fa fa-signal"></i> <?= $this->lang->line('Stato_t');?> </span><span id="statoc"></span></p>
                            </div>
                            <div class="col-md-12 col-lg-6 bio-row">
                                <p><span class="bold"><i class="fa fa-calendar"></i> <?= $this->lang->line('Apertoil_t');?> </span><span id="dataAperturac"></span></p>
                            </div>
                            <div class="col-md-12 col-lg-6 bio-row">
                                <p><span class="bold"><i class="fa fa-chain-broken"></i> <?= $this->lang->line('Guasto_t');?></span><span id="guastoc"></span></p>
                            </div>
                            <div class="col-md-12 col-lg-6 bio-row">
                                <p><span class="bold"><i class="fa fa-folder-open"></i> <?= $this->lang->line('Categoria_t');?> </span><span id="categoriac"></span></p>
                            </div>
                            <div class="col-md-12 col-lg-6 bio-row">
                                <p><span class="bold"><i class="fa fa-tag"></i> <?= $this->lang->line('Modello_t');?> </span><span id="modelloc"></span></p>
                            </div>
                            <div class="col-md-12 col-lg-6 bio-row nofloat">
                                <p><span class="bold"><i class="fa fa-puzzle-piece"></i> <?= $this->lang->line('Pezzo_t');?> </span><span id="pezzoc"></span></p>
                            </div>
                            <div class="col-md-12 col-lg-6 bio-row">
                                <p><span class="bold"><i class="fa fa-money"></i> <?= $this->lang->line('Anticipo_t');?></span><span id="anticipoc"></span></p>
                            </div>
                            <div class="col-md-12 col-lg-6 bio-row nofloat">
                                <p><span class="bold"><i class="fa fa-euro"></i> <?= $this->lang->line('Prezzo_t');?> </span><span id="prezzoc"></span></p>
                            </div>
                            <div class="col-md-12 col-lg-6 bio-row">
                                <p><span class="bold"><i class="fa fa-phone"></i> <?= $this->lang->line('Telefono_t');?> </span><span id="telefonoc"></span></p>
                            </div>
                            <div class="col-md-12 col-lg-6 bio-row">
                                <p><span class="bold"><i class="fa fa-eye"></i> <?= $this->lang->line('cod_riparazione');?> </span><span id="cod_rip"></span></p>
                            </div>
                            <div class="col-md-12 col-lg-6 bio-row col_chiuso">
                                <p><span class="bold"><i class="fa fa-calendar"></i> <?= $this->lang->line('Chiusoil_t');?> </span><span id="dataChiusura"></span></p>
                            </div>


                        </div>
                    </div>
                </div>

                <link rel="stylesheet" href="<?=site_url('assets/css/toastr.min.css');?>">
                <script src="<?=site_url('assets/js/toastr.min.js');?>"></script>
                <script src="<?=site_url('js/bootstrap.min.js'); ?>"></script>


    </body>

</html>