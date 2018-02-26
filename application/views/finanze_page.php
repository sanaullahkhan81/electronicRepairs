<?php require 'header.php'; ?>
<script type="text/javascript">
	window.base_url = "<?=site_url(); ?>";
</script>
	<link rel="stylesheet" href="<?=site_url('assets/morris.js-0.4.3/morris.css'); ?>" />
	<link rel="stylesheet" href="<?=site_url('assets/bootstrap-datepicker/css/datepicker.css'); ?>" />


	<!--main content start-->
	<section id="main-content">

		<section class="wrapper site-min-height">
			<!-- page start-->
			<div class="interno" id="morris">
				<div class="col-lg-12">
					<section class="panel">
						<header class="panel-heading">
							<?=$this->lang->line('resoconto_entrate_mese');?>: <i><?=$lista[32].'/'.$lista[33]; ?></i>
				            <span class="totale_resoconto"><?=$this->lang->line('entrate_lorde');?>: <?php 
                                $totale = 0;
                                for ($i = 1; $i <= 30; ++$i) {
                                    $totale += $lista[$i];
                                }
                                echo $this->Impostazioni_model->get_money($totale); ?>
                            </span>
						</header>
						<div class="panel-body">
							<div id="hero-area" class="graph"></div>
						</div>
					</section>
				</div>
				<div class="col-lg-8 col-sm-6">
					<section class="panel">
						<header class="panel-heading">
							<?=$this->lang->line('scegli_mese_visionare');?>
						</header>
						<div class="form-group panel-body date_pc">
							<div data-date-minviewmode="months" data-date-viewmode="years" data-date-format="mm/yyyy" data-date="102/2012" class="input-append date dpMonths">
								<input type="text" readonly="" value="<?=$lista[32].'/'.$lista[33]; ?>" id="data_salto" size="16" class="form-control">
								<span class="input-group-btn add-on">
                                        	<button class="btn btn-danger" type="button"><i class="fa fa-calendar"></i></button>
							</span>
							</div>
							<button type="button" class="finanze_subdate btn btn-info "><i class="fa fa-refresh"></i>
								<?=$this->lang->line('aggiorna');?>
							</button>
						</div>
					</section>
				</div>
				<div class="col-lg-4 col-sm-6 state-overview">
					<section class="panel">
						<div class="symbol blue">
							<i class="fa fa-bar-chart-o"></i>
						</div>
						<div class="value">
							<h1>
                                <?=$this->Impostazioni_model->get_money($totale,'color: rgb(51, 223, 51);font-weight: 400;font-size: 17px;');?>
				            </h1>
							<p>
								<?=$this->lang->line('questo_mese');?>
							</p>
						</div>
					</section>
				</div>

			</div>

			<!-- page end-->
		</section>
	</section>
	<!--main content end-->

    <script type="text/javascript"><?php include(FCPATH.'assets/morris.js-0.4.3/raphael-min.js');?></script>
        
    <script type="text/javascript"><?php include(FCPATH.'assets/morris.js-0.4.3/morris.min.js'); ?></script>


	<script>
		var Script = function() {

			//morris chart

			jQuery(function() {
				// data stolen from http://howmanyleft.co.uk/vehicle/jaguar_'e'_type
				Morris.Area({
					element: 'hero-area',
					data: [



						<?php 
if (count($lista) <= 1) {
    echo "{period: '01', guadagni: '0'}";
} else {
    for ($i = 1; $i <= 30; ++$i) {
        echo '{period: \''.$lista[33].'-'.$lista[32].'-'.$i.'\', guadagni: '.$lista[$i].'},';
    }
}
            ?>
					],

					xkey: 'period',
					ykeys: ['guadagni'],
					labels: ['<?=$this->lang->line('guadagni_graph');?>'
					],
					hideHover: 'auto',
					lineWidth: 1,
					pointSize: 2,
					lineColors: ['#000000', '#000000', '#a9d86e'],
					fillOpacity: 0.5,
					smooth: true,
					xLabelAngle: 0,
					xLabels: 'day',
					xLabelFormat: function(x) {
						return x.getUTCDate();
					},
					yLabelFormat: function(y) {
                        <?php if(strpos($valuta, '£') || ($impostazioni[0]['valuta'] == 'CUSTOM' && $impostazioni[0]['currency_position'] == 'left' )) echo "return '".$valuta." ' + y.toString();";
                        else echo "return y.toString() + '".$valuta."';";
                        ?>
					}
				});
			});

		}();
		
		jQuery(document).ready(function ()
							   {

			jQuery('.finanze_subdate').click(function (e)
											 {
				var url = jQuery("#data_salto").val();
				window.location = base_url+"finanze/data/" + url;
			});

		});

	</script>
    <script src="<?=site_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.js'); ?>"></script>
	<script src="<?=site_url('js/advanced-form-components.js'); ?>"></script>

	<?php require 'footer.php'; ?>