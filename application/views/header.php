	<!DOCTYPE html>

    <?php if( $impostazioni[0]['rtl_support'] ) echo '<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ar" dir="rtl">';
    else echo '<html lang="en">'; ?>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Luigi Verzì">
		<link rel="shortcut icon" href="img/favicon.png">

		<title><?=$impostazioni[0]['titolo']; ?> - <?=$this->lang->line('pannello_dc_w');?></title>


        <script><?php include(FCPATH.'js/jquery.js');?></script>
		<link href="<?=site_url('css/bootstrap.min.css'); ?>" rel="stylesheet">
		<link href="<?=site_url('css/hover.css'); ?>" rel="stylesheet">
		<link href="<?=site_url('css/bootstrap-reset.css'); ?>" rel="stylesheet">
		<link href="<?=site_url('assets/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" />
		<link href="<?=site_url('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css'); ?>" rel="stylesheet" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?=site_url('css/owl.carousel.css'); ?>" type="text/css">
        <link rel="stylesheet" href="<?= site_url('assets/advanced-datatable/media/css/dataTables.responsive.css'); ?>" />
		<link href="<?=site_url('css/style.css'); ?>" rel="stylesheet">
        
        <?php // ADD THE RTL SUPPORT IF CHECKED
        if( $impostazioni[0]['rtl_support'] ) echo '<link href="'.site_url('css/rtl.css').'" rel="stylesheet">'; 
        ?>
		<link href="<?=site_url('css/style-responsive.css'); ?>" rel="stylesheet" />
        <script><?php include(FCPATH.'assets/js/pace.min.js');?></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
		<!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
	</head>

                
    <?php 
        echo '<style id="colori">';
        echo $stile;
        echo '</style>';
    ?>
    <script>
        jQuery(document).ready(function () {
            $("#black").fadeOut(500);
        });
    </script>

	<body>
        <?php if(!$impostazioni[0]['background_transition']) { ?><div id="black"></div><?php } ?>
		<section id="container">
			<!--header start-->
			<header class="header white-bg">
				<div class="sidebar-toggle-box">
					<div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
				</div>
				<!--logo start-->
				<a href="<?=site_url(''); ?>" class="logo">
					<p><span><?=$this->lang->line('pannello_dc');?></span></p>
                    <p><?=rawurldecode($impostazioni[0]['titolo']); ?></p>
				</a>
				<!--logo end-->

				<div class="welcome">

					<img alt="" src="<?=site_url('img/avatar1_small.jpg') ?>">
                    <span class="welcome"><?=$this->lang->line('welcome_a');?> <?= $impostazioni[0]['invoice_name']; ?></span>
                    <a href="<?=site_url('login/logout'); ?>" class="log-out"><i class="fa fa-key"></i> <?=$this->lang->line('logout');?></a> <a href="<?=site_url(''); ?>"><i class="fa fa-home"></i> <?=$this->lang->line('js_torna_indietro');?></a>
				</div>
			</header>
			<!--header end-->
			<!--sidebar start-->
			<aside>
				<div id="sidebar" class="nav-collapse ">
					<!-- sidebar menu start-->
					<ul class="sidebar-menu" id="nav-accordion">
                        <li class="nav_title"><img src="<?= ($impostazioni[0]['logo'] == 'default') ? 'http://fixbook.it/img/logo_nav.png' : site_url('img').'/'.$impostazioni[0]['logo']; ?>"></li>
						<li>
                            <a class="hvr-bounce-to-right <?php if ('http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] == site_url('')) {
    echo 'active';
    } ?>" href="<?=site_url(''); ?>">
								<i class="fa fa-map-marker"></i>
								<span><?=$this->lang->line('o_e_r_titolo');?></span>
							</a>
						</li>

						<li>
                            <a class="hvr-bounce-to-right <?php if ('http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] == site_url('clienti/')) {
    echo 'active';
    } ?>" href="<?=site_url('clienti/'); ?>">
								<i class="fa fa-user"></i>
								<span><?=$this->lang->line('clienti');?></span>
							</a>
						</li>
						<li>
                            <a class="hvr-bounce-to-right <?php if ('http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] == site_url('finanze/')) {
    echo 'active';
    } ?>" href="<?=site_url('finanze/'); ?>">
								<i class="fa fa-bar-chart-o"></i>
								<span><?=$this->lang->line('finanze');?></span>
							</a>
						</li>
						<li>
							<a class="hvr-bounce-to-right <?php if ('http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] == site_url('impostazioni/')) {
    echo 'active';
} ?>" href="<?=site_url('impostazioni//'); ?>">
								<i class="fa fa-cog"></i>
								<span><?=$this->lang->line('impostazioni');?></span>
							</a>
						</li>
                                                <?php if($this->session->userdata('user_type') == 'admin'){ ?>
                                                <li>
							<a class="hvr-bounce-to-right <?php if ('http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] == site_url('manageusers/')) {
    echo 'active';
} ?>" href="<?=site_url('manageusers/'); ?>">
								<i class="fa fa-user-plus"></i>
                                                                <span><?=$this->lang->line('manage_users');?></span>
							</a>
						</li>
                                                <?php }else if($this->session->userdata('user_type') == 'store'){ ?>
                                                <li>
							<a class="hvr-bounce-to-right <?php if ('http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] == site_url('manageemployees/')) {
    echo 'active';
} ?>" href="<?=site_url('manageemployees/'); ?>">
								<i class="fa fa-user-plus"></i>
                                                                <span><?=$this->lang->line('manage_employee');?></span>
							</a>
						</li>
                                                <?php } ?>
                        <li class="logout">
                            <a class="hvr-bounce-to-right" href="<?=site_url('login/logout'); ?>">
                                <i class="fa fa-key"></i>
								<span><?=$this->lang->line('logout');?></span>
							</a>
						</li>

					</ul>
					<!-- sidebar menu end-->
				</div>
			</aside>
			<!--sidebar end-->