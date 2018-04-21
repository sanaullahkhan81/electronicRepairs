<!--footer start-->
<footer class="site-footer">
	<div class="text-center">
		2016 &copy;
		<?=$impostazioni[0]['titolo'];
if (!$impostazioni[0]['showcredit']) {
    ?>
        <span style="font-size: 80%; padding-right: 10px;"><a class="rate" href="http://codecanyon.net/downloads"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></a><?=$this->lang->line('sviluppatoda');?> <a href="http://luigiverzi.it" style="color: lightgrey;">Luigi Verzì</a></span>
			<?php 
} ?>
				<a href="#" class="go-top"><i class="fa fa-angle-up"></i></a>
	</div>
</footer>
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->

<script><?php include(FCPATH.'js/bootstrap.min.js'); ?></script>
<script><?php include(FCPATH.'js/jquery.scrollTo.min.js'); ?></script>
<script><?php include(FCPATH.'js/jquery.nicescroll.js'); ?></script>
<script><?php include(FCPATH.'js/respond.min.js'); ?></script>
<script><?php include(FCPATH.'js/common-scripts.js'); ?></script>
<link href="<?=site_url('assets/select2/select2.min.css'); ?>" rel="stylesheet" />
<script><?php include(FCPATH.'assets/select2/select2.min.js'); ?></script>
<script><?php include(FCPATH.'js/signature_pad.js');?></script>
<script type="text/javascript" src="<?=site_url().'home/js/common'; ?>"></script>
<script><?php include(FCPATH.'js/app.js');?></script>
<script><?php include(FCPATH.'js/collected_sign.js');?></script>
<script>
	;(function($){
		$("#lingua").select2({placeholder: "<?=$this->lang->line('seleziona_lingua_select');?>"});
		$("select").select2();
		$("#categorie").select2({tags: true});
        $("#campi_personalizzati").select2({tags: true});
	})(jQuery);
</script> 

    <div id='ajax_loader' style="width: 100%; height: 100%; background: #ffffff; opacity: 0.5; position: absolute; text-align: center; vertical-align: middle; top: 0; left: 0; display: none; z-index: 9999; padding-top: 150px;">
        <img src="assets/images/ajax-loader.gif"></img>
    </div>
  </body>
</html>