<?php require 'header.php';
?>
<script type="text/javascript">
    window.base_url = "<?= site_url(); ?>";
</script>


<link rel="stylesheet" href="<?= site_url('assets/data-tables/DT_bootstrap.css'); ?>" />
<script type="text/javascript" src="<?=site_url().'home/js/validate'; ?>"></script>
<script type="text/javascript" src="<?=site_url().'home/js/home'; ?>"></script>
<script type="text/javascript" src="<?=site_url().'home/js/clienti'; ?>"></script>

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
                            <a href="javascript:;">
                                <i class=" fa fa-wrench text-warning"></i>
                                <?= $n_riparazioni.' '.$this->lang->line('r_in_corso'); ?>
                            </a>
                        </li>
                        <li class="med">
                            <a href="javascript:;">
                                <i class="fa fa-truck text-warning"></i>
                                <?= $n_ordini.' '.$this->lang->line('o_in_corso'); ?>
                            </a>
                        </li>
                        <li class="full">
                            <a href="clienti">
                                <i class=" fa fa-user text-muted"></i>
                                <?= $n_clienti.' '.$this->lang->line('clienti'); ?>
                            </a>
                        </li>
                        <li class="med">
                            <a href="#obj" data-toggle="modal" data-tipo="2" class="add">
                                <i class=" fa fa-plus-circle text-success"></i>
                                <?= $this->lang->line('a_riparazione'); ?>
                            </a>
                        </li>
                        <li class="med">
                            <a href="#obj" data-toggle="modal" data-tipo="1" class="add">
                                <i class="fa fa-plus-circle text-success"></i>
                                <?= $this->lang->line('a_ordine');?>
                            </a>
                        </li>
                        <li class="med">
                            <a href="<?= site_url('home/download/1'); ?>">
                                <i class="fa fa-download text-warning"></i>
                                <?= $this->lang->line('download_xml'); ?>
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
                    <?= $this->lang->line('o_e_r_titolo');?>
                    <div class="pull-right" style="margin-top: -5px;">
                        Status Filter: 
                        <select id="select_filters">
                            <option value="">all</option>
                            <option value="In progress">In progress</option>
                            <option value="To be deliver">To be deliver</option>
                            <option value="To be approved">To be approved</option>
                            <option value="Delivered">Delivered</option>
                            <option value="Cancelled">Cancelled</option>
                            <option value="Not Sent">Not Sent (Engineer)</option>
                            <option value="In Progress eng">In Progress (Engineer)</option>
                            <option value="Completed">Completed (Engineer)</option>
                        </select>
                    </div>
                </header>
                <div class="panel-body">
                    <div class="adv-table">
                        <table class="display compact table table-bordered table-striped" id="dynamic-table">
                            <thead>
                                <tr>
                                    <th>
                                       #
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Stato_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Stato_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Cliente_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Tipo_t');?>
                                    </th>
                                    <th id="modello_ht">
                                        <?= $this->lang->line('Modello_t');?>
                                    </th>
                                    <th id="guasto_ht">
                                        <?= $this->lang->line('Guasto_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Data_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Telefono_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Status_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Azioni_t');?>
                                    </th>
                                </tr>
                            </thead>

                            <tfoot>
                                <tr>
                                    <th>
                                        <?= $this->lang->line('ID_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Stato_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Stato_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Cliente_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Tipo_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Modello_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Guasto_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Data_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Telefono_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Status_t');?>
                                    </th>
                                    <th>
                                        <?= $this->lang->line('Azioni_t');?>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </section>
        </div>
        
        <?php include('modal_template.php'); ?>
        
<!-- page end-->
</section>
</section>
<!--main content end-->
<link rel="stylesheet" href="<?= site_url('assets/css/toastr.min.css'); ?>">
<script><?php include(FCPATH.'assets/js/toastr.min.js'); ?></script>

<script type="text/javascript"><?php include(FCPATH.'assets/advanced-datatable/media/js/jquery.dataTables.min.js'); ?></script>
<script type="text/javascript"><?php include(FCPATH.'assets/advanced-datatable/media/js/jquery.dataTables.js'); ?></script>
<script type="text/javascript"><?php include(FCPATH.'assets/advanced-datatable/media/js/dataTables.responsive.js'); ?></script>
<script type="text/javascript"><?php include(FCPATH.'assets/advanced-datatable/media/js/dataTables.responsive.js'); ?></script>
<script type="text/javascript"><?php include(FCPATH.'assets/data-tables/DT_bootstrap.js'); ?></script>
<script type="text/javascript"><?php include(FCPATH.'assets/js/drag_scroll.js'); ?></script>

<script>
    var oTable = jQuery('#dynamic-table').dataTable({
        "ajax": "<?= site_url('home/ajax/1'); ?>",
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
            "data": "id"
        }, {
            "data": "stato"
        }, {
            "data": "status_eng"
        }, {
            "data": "cliente"
        }, {
            "data": "tipo"
        }, {
            "data": "modello"
        }, {
            "data": "guasto"
        }, {
            "data": "data"
        }, {
            "data": "telefono"
        }, {
            "data": "code"
        }, {
            "data": "azioni"
        }]
    });
    
    jQuery(document).ready(function(){
        
    }); 
    
    $('#select_filters').on('change',function(){
        var selectedValue = $(this).val();
        if(selectedValue == 'Not Sent' || selectedValue == 'In Progress eng' || selectedValue == 'Completed'){
            if(selectedValue == 'In Progress eng'){
                selectedValue = 'In Progress';
            }
            oTable.fnFilter('', 1, false);
            oTable.fnFilter(selectedValue, 2, false);
        }else{
            oTable.fnFilter('', 2, false);
            oTable.fnFilter(selectedValue, 1, false);
        }
    });
</script>

<?php require 'footer.php'; ?>