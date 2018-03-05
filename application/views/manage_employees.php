<?php require 'header.php'; ?>
	<script type="text/javascript">
		window.base_url = "<?=site_url(); ?>";
	</script>
<link rel="stylesheet" href="<?=site_url('assets/data-tables/DT_bootstrap.css'); ?>" />
<script type="text/javascript" src="<?=site_url('home/js/validate'); ?>"></script>
<script type="text/javascript" src="<?=site_url('/js/manage_employee.js'); ?>"></script>
<script type="text/javascript" src="<?=site_url('home/js/home'); ?>"></script>

	<!--main content start-->
	<section id="main-content">
		<section class="wrapper site-min-height">
			<!-- page start-->
            <!--state overview start-->
            <div class="state-overview">
                <section id="scrolldash" class="panel dragscroll">
                    <div class="panel-body">
                        <ul class="summary-list">
                            <li class="med">
								<a href="clienti">
									<i class=" fa fa-user text-muted"></i>
									<?=$total_users; ?> <?=$this->lang->line('employee');?>
								</a>
				            </li>
                            <li class="med">
								<a href="#manageEmployeeModal" data-toggle="modal" class="add_employee">
								    <i class=" fa fa-plus-circle text-success"></i> <?=$this->lang->line('add_employee');?>
								</a>
                            </li>
                        </ul>
                    </div>
                </section>
            </div>
            <!--state overview end-->
			<div class="col-lg-12">
				<section class="panel">
					<header class="panel-heading">
						<?=$this->lang->line('clienti');?>
					</header>
					<div class="panel-body">
						<div class="adv-table">
                            <table class="display compact table table-bordered table-striped" id="dynamic-table">
								<thead>
									<tr>
										<th><?=$this->lang->line('employee_name');?></th>
                                                                                <th><?=$this->lang->line('employee_sur_name');?></th>
                                                                                <th><?=$this->lang->line('employee_login_code');?></th>
										<th><?=$this->lang->line('email');?></th>
										<th><?=$this->lang->line('Telefono_t');?></th>
										<th><?=$this->lang->line('store_address');?></th>
                                                                                <th><?=$this->lang->line('Azioni_t');?></th>
									</tr>
								</thead>
						
								<tfoot>
									<tr>
										<th><?=$this->lang->line('employee_name');?></th>
                                                                                <th><?=$this->lang->line('employee_sur_name');?></th>
                                                                                <th><?=$this->lang->line('employee_login_code');?></th>
										<th><?=$this->lang->line('email');?></th>
										<th><?=$this->lang->line('Telefono_t');?></th>
										<th><?=$this->lang->line('store_address');?></th>
                                                                                <th><?=$this->lang->line('Azioni_t');?></th>
									</tr>
								</tfoot>
							</table>
						</div>
					</div>
				</section>
				
                <?php include('modal_template.php'); ?>
                
			<!-- page end-->
		</section>
	</section>
	<!--main content end-->
	<!--toastr-->
	<link rel="stylesheet" href="<?=site_url('assets/css/toastr.min.css'); ?>">
        
        <script type="text/javascript"><?php include(FCPATH.'assets/js/toastr.min.js'); ?></script>
        <script type="text/javascript"><?php include(FCPATH.'assets/advanced-datatable/media/js/jquery.dataTables.min.js'); ?></script>
        <script type="text/javascript"><?php include(FCPATH.'assets/advanced-datatable/media/js/jquery.dataTables.js'); ?></script>
        <script type="text/javascript"><?php include(FCPATH.'assets/advanced-datatable/media/js/dataTables.responsive.js'); ?></script>
        <script type="text/javascript"><?php include(FCPATH.'assets/data-tables/DT_bootstrap.js'); ?></script>

<script>
    jQuery('#dynamic-table').dataTable({
        "ajax": "<?=base_url('manageemployees/get_employee_list');?>",
        "order": [[ 0, "desc" ]],
        "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
        "language": {
            "lengthMenu": "<?= $this->lang->line('lengthMenu');?>",
            "zeroRecords": "<?= $this->lang->line('zeroRecords');?>",
            "info": "<?= $this->lang->line('info');?>",
            "infoEmpty": "<?= $this->lang->line('infoEmpty');?>",
            "search":    "<?= $this->lang->line('search');?>",
            "infoFiltered": "<?= $this->lang->line('infoFiltered');?>",
            "paginate": {
                "first":      "<?= $this->lang->line('first');?>",
                "last":       "<?= $this->lang->line('last');?>",
                "next":       "<?= $this->lang->line('next');?>",
                "previous":   "<?= $this->lang->line('previous');?>"
            },
        },
        responsive: true,
        "columns": [{
            "data": "name"
        }, {
            "data": "lastname"
        }, {
            "data": "login"
        }, {
            "data": "email"
        }, {
            "data": "phone"
        }, {
            "data": "address" 
        }, {
            "data": "actions"
        }]
    });
</script>

<?php require 'footer.php'; ?>