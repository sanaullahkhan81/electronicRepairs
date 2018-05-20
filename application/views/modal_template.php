<!-- ============= MODAL MODIFICA RIPARAZIONI/ORDINI ============= -->
<div class="col-md-12 modal fade" id="obj" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="tit"><?= $this->lang->line('modifica');?></h4>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <p class="tips custip"></p>
                    <div class="row">
                        <form>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>
                                        <?= $this->lang->line('Cliente_t');?>
                                    </label>
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-xs-12">
                                            <div class="iconic-input"><i class="fa fa-user" style="right: 20px; right: 30px; top: -1px; z-index: 200;"></i>
                                                <select id="nominativo1" data-num="1" class="form-control m-bot15" style="width: 100%">

                                                    <?php 
foreach ($lista_c as $ogg) :
echo '<option value="'.$ogg['id'].'">'.$ogg['nome'].' '.$ogg['cognome'].'</option>';
endforeach; 
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <!--<div class="col-lg-2 col-sm-1 col-xs-2">
                                            <a class="add_c btn"><i class="fa fa-user-plus"></i></a>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>
                                        <?= $this->lang->line('Categoria_t');?>
                                    </label>
                                    <div class="iconic-input select_cat"><i class="fa fa-folder" style="right: 20px;"></i>
                                        <select id="categoria_s" data-num="1" class="form-control m-bot15" style="width: 100%">
                                            <?php
foreach(preg_split("/((\r?\n)|(\r\n?))/", $impostazioni['0']['categorie']) as $line){
    echo '<option value="'.$line.'">'.$line.'</option>';
} 
                                            ?>
                                            <option value="other"><?= $this->lang->line('c_altro');?></option>
                                        </select>
                                    </div>

                                    <div class="iconic-input inp_cat"><i class="fa fa-folder"></i>
                                        <input id="categoria1" type="text" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>
                                        <?= $this->lang->line('Modello_t');?>
                                    </label>
                                    <div class="iconic-input"><i class="fa fa-mobile-phone"></i>
                                        <input id="modello1" type="text" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>
                                        <?= $this->lang->line('Guasto_t');?>
                                    </label>
                                    <div class="iconic-input"><i class="fa  fa-chain-broken"></i>
                                        <input id="guasto1" type="text" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>
                                        <?= $this->lang->line('PezzoDO_t');?>
                                    </label>
                                    <div class="iconic-input"><i class="fa fa-truck"></i>
                                        <input id="pezzo1" type="text" disabled="disabled" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="form-group">
                                    <label>
                                        <?= $this->lang->line('Anticipo_t');?>
                                    </label>
                                    <div class="iconic-input"><i class="fa fa-ticket"></i>
                                        <input id="anticipo1" type="text" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                                <div class="form-group">
                                    <label>
                                        <?= $this->lang->line('payment_type');?>
                                    </label>
                                    <!--<div class="iconic-input">-->
                                    <select id="payment_type" type="text" class="validate form-control" style="width: 100%">
                                        <option value="cash">Cash</option>
                                        <option value="card">Card</option>
                                    </select>
                                    <!--</div>-->
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>
                                        <?= $this->lang->line('PrezzoR_t');?>
                                    </label>
                                    <div class="iconic-input"><i class="fa fa-eur"></i>
                                        <input id="prezzo1" type="text" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <?php 
                                $campi = unserialize( base64_decode($impostazioni['0']['campi_personalizzati']));
                                foreach($campi as $line){
                            ?>
                            
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>
                                        <?= $line; ?>
                                    </label>
                                    <input id="mo<?= bin2hex($line); ?>" type="text" class="custom validate form-control">
                                </div>
                            </div>
                            
                            <?php } ?>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>
                                        <?= $this->lang->line('SMSA_t');?>
                                    </label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="" id="sms">
                                            <?= $this->lang->line('SMSAL_t');?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-12">
                                <div class="form-group">
                                    <label>
                                        <?= $this->lang->line('send_email_label');?>
                                    </label>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" value="" id="send_email">
                                            <?= $this->lang->line('send_email_checkbox');?>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div style="clear: both;"></div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>
                                        <?= $this->lang->line('Commenti_t');?>
                                    </label>
                                    <textarea class="form-control" id="commenti1" rows="6"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <input type="hidden" id="sig_img_name" value=""/>
                                <image id="signature_image" src="" style="display: none;"/>
                                <div id="signature-pad" class="signature-pad">
                                    <div class="signature-pad--body">
                                        <canvas></canvas>
                                    </div>
                                    <div class="signature-pad--footer">
                                        <div class="description">Agree Terms</div>

                                        <div class="signature-pad--actions">
                                            <div>
                                                <button type="button" class="button clear" data-action="clear">Clear</button>
                                                <button type="button" class="button" data-action="change-color" style="display: none;">Change color</button>
                                                <button type="button" class="button" data-action="undo" style="display: none;">Undo</button>
                                            </div>
                                            <div>
                                                <button type="button" class="button save" data-action="save-png">Save</button>
                                                <button type="button" class="button save" data-action="save-jpg" style="display: none;">Save as JPG</button>
                                                <button type="button" class="button save" data-action="save-svg" style="display: none;">Save as SVG</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-lg-4">
                                <input type="hidden" id="sig_img_name_collected" value=""/>
                                <image id="signature_image_collected" src="" style="display: none;"/>
                                <div id="signature-pad_collected" class="signature-pad_collected">
                                    <div class="signature-pad_collected--body">
                                        <canvas></canvas>
                                    </div>
                                    <div class="signature-pad_collected--footer">
                                        <div class="description">Collected the phone</div>

                                        <div class="signature-pad_collected--actions">
                                            <div>
                                                <button type="button" class="button clear" data-action="clear_collected">Clear</button>
                                                <button type="button" class="button" data-action="change-color_collected" style="display: none;">Change color</button>
                                                <button type="button" class="button" data-action="undo_collected" style="display: none;">Undo</button>
                                            </div>
                                            <div>
                                                <button type="button" class="button save" data-action="save-png_collected">Save</button>
                                                <button type="button" class="button save" data-action="save-jpg_collected" style="display: none;">Save as JPG</button>
                                                <button type="button" class="button save" data-action="save-svg_collected" style="display: none;">Save as SVG</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <button type="button" class="btn btn-primary col-lg-12 col-md-12 col-sm-12" data-toggle="collapse" data-target="#terms-list-section">Click for Open/Close Check List</button>
                                <div id="terms-list-section" class="collapse col-lg-12 col-md-12">
                                    <div id="check-list-table" class="col-lg-6 col-md-6"></div>
                                    <div class="col-lg-6 col-md-6">
                                        <h3>Dear Customers, </h3></br>
                                        <ol>
                                            <li>All parts used during repair will be replacement parts not from original brand</li>
                                            <li>Please take out any SIM and memory cards. We can not accept any responsibility or liability for these.</li>
                                            <li>There are not refund policy in all repairs. If something is faulty we will try to re-fix the fault or will issue you with a credit note</li>
                                            <li>Touch & LCD repair company only guarantee for color pixels or if touch not working. There is not refund or exchange for broken LCD or touch screens.</li>
                                            <li>Any repair done by us will be covered by 14 days warranty if the same fault occurs, but this warranty will not cover any accident damage of Touch & LCD screens.</li>
                                            <li>We only repair the fault that you phone come in for, if we repair the phone & on testing we notice it has additional faults, you will be quoted separately for those faults.</li>
                                            <li>Any phone which is coming back for re-fix, during re-fix if we found an additional fault, you will be quoted separately for those faults.</li>
                                            <li>If we successfully repair your phone and the phone turns out to be barred the quoted repair price will still stand.</li>
                                            <li>Please indicate if the data on your phone is important and you would like us to try our best to save it. However we cannot guarantee your data and settings on the phone will be saved during our repairs or unlocking.</li>
                                            <li>Our repairs will void your phone warranty. Please check you are happy with this before your hand over your phone.</li>
                                            <li>You must pick up your device within 28 days of repairs. Company could not be responsible after 28 days once we confirm that your device is ready to be picked up</li>
                                        </ol> 
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="footerOR1"> </div>
        </div>
    </div>
</div>

<!-- ============= MODAL VISUALIZZA ORDINI/RIPARAZIONI ============= -->
<div class="col-md-12 modal fade" id="visualizza_ordini" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><div id="titoloOE"></div></h4>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-4 bio-row">
                            <p><span class="bold"><i class="fa fa-user"></i> <?= $this->lang->line('Cliente_t');?> </span><span id="clientec"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-4 bio-row">
                            <p><span class="bold"><i class="fa fa-barcode"></i> <?= $this->lang->line('ID_t');?> </span><span id="codicec"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-4 bio-row stato">
                            <p><span class="bold"><i class="fa fa-signal"></i> <?= $this->lang->line('Stato_t');?> </span><span id="statoc"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-4 bio-row">
                            <p><span class="bold"><i class="fa fa-calendar"></i> <?= $this->lang->line('Apertoil_t');?> </span><span id="dataAperturac"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-4 bio-row">
                            <p><span class="bold"><i class="fa fa-chain-broken"></i> <?= $this->lang->line('Guasto_t');?></span><span id="guastoc"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-4 bio-row">
                            <p><span class="bold"><i class="fa fa-folder-open"></i> <?= $this->lang->line('Categoria_t');?> </span><span id="categoriac"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-4 bio-row">
                            <p><span class="bold"><i class="fa fa-tag"></i> <?= $this->lang->line('Modello_t');?> </span><span id="modelloc"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-4 bio-row nofloat">
                            <p><span class="bold"><i class="fa fa-puzzle-piece"></i> <?= $this->lang->line('Pezzo_t');?> </span><span id="pezzoc"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-4 bio-row">
                            <p><span class="bold"><i class="fa fa-money"></i> <?= $this->lang->line('Anticipo_t');?></span><span id="anticipoc"></span><span id="payment_type_c"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-4 bio-row nofloat">
                            <p><span class="bold"><i class="fa fa-money"></i> <?= $this->lang->line('Prezzo_t');?> </span><span id="prezzoc"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-4 bio-row">
                            <p><span class="bold"><i class="fa fa-phone"></i> <?= $this->lang->line('Telefono_t');?> </span><span id="telefonoc"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-4 bio-row">
                            <p><span class="bold"><i class="fa fa-eye"></i> <?= $this->lang->line('cod_riparazione');?> </span><span id="cod_rip"></span></p>
                        </div>
                        
                        <?php 
                        $campi = unserialize( base64_decode($impostazioni['0']['campi_personalizzati']));
                        foreach($campi as $line){
                        ?>
                        
                        <div class="col-md-12 col-lg-4 bio-row">
                            <p><span class="bold"><i class="fa fa-info-circle"></i> <?= $line; ?> </span><span class="show_custom" id="v<?= bin2hex($line); ?>"></span></p>
                        </div>

                        <?php } ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-md-4 bio-row fastsms">
                                    <div class="form-group commenti">
                                        <label>
                                            <?= $this->lang->line('Fastsms_t');?>
                                        </label>
                                        <textarea class="form-control" id="fastsms" rows="6" placeholder="<?= $this->lang->line('Fastsms_d');?>"></textarea>
                                        <button type="button" id="sendsmsfast"><i class="fa fa-check"></i> <?= $this->lang->line('Fastsms_b');?></button>
                                    </div>
                                </div>
                                <div class="col-md-4 bio-row textareacom">
                                    <div class="form-group commenti">
                                        <label>
                                            <?= $this->lang->line('Commenti_t');?>
                                        </label>
                                        <textarea class="form-control" id="commentic" rows="6" disabled=""></textarea>
                                    </div>
                                </div>
                                <div class="col-md-4 bio-row" id="comment-engineer">
                                    <div class="form-group commenti">
                                        <label>
                                            <?= $this->lang->line('engineer_comments');?>
                                            <div class="pull-right" id="div_engineer_status">Engineer status: </div>
                                        </label>
                                        <div id="conmments_section" style="overflow: auto; height: 135px; border: 1px solid #dddddd">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group commenti" id="send_comment_section">
                                        <input type="hidden" value="" id="comment_id_num"/>
                                        <input id="text_comment" type="text" value=""/><input type="button" id="btn_send_comment" value="Send Comment" data-num="">
                                    </div>
                                </div>
                                <div class="col-md-4 bio-row" id="btn-engineer">
                                    <input type="button" id="btn-send-engineer" class="btn btn-dark btn-primary" value="Send To Engineer"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <button type="button" class="btn btn-primary col-lg-12 col-md-12 col-sm-12" data-toggle="collapse" data-target="#terms-list-section-2">Click for Open/Close Check List</button>
                            <div id="terms-list-section-2" class="collapse col-lg-12 col-md-12">
                                <div id="check-list-table-2" class="col-lg-6 col-md-6"></div>
                                <div class="col-lg-6 col-md-6">
                                    <h3>Dear Customers, </h3></br>
                                    <ol>
                                        <li>All parts used during repair will be replacement parts not from original brand</li>
                                        <li>Please take out any SIM and memory cards. We can not accept any responsibility or liability for these.</li>
                                        <li>There are not refund policy in all repairs. If something is faulty we will try to re-fix the fault or will issue you with a credit note</li>
                                        <li>Touch & LCD repair company only guarantee for color pixels or if touch not working. There is not refund or exchange for broken LCD or touch screens.</li>
                                        <li>Any repair done by us will be covered by 14 days warranty if the same fault occurs, but this warranty will not cover any accident damage of Touch & LCD screens.</li>
                                        <li>We only repair the fault that you phone come in for, if we repair the phone & on testing we notice it has additional faults, you will be quoted separately for those faults.</li>
                                        <li>Any phone which is coming back for re-fix, during re-fix if we found an additional fault, you will be quoted separately for those faults.</li>
                                        <li>If we successfully repair your phone and the phone turns out to be barred the quoted repair price will still stand.</li>
                                        <li>Please indicate if the data on your phone is important and you would like us to try our best to save it. However we cannot guarantee your data and settings on the phone will be saved during our repairs or unlocking.</li>
                                        <li>Our repairs will void your phone warranty. Please check you are happy with this before your hand over your phone.</li>
                                        <li>You must pick up your device within 28 days of repairs. Company could not be responsible after 28 days once we confirm that your device is ready to be picked up</li>
                                    </ol> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="footerOR" class="modal-footer">

            </div>
        </div>
    </div>
</div>

<!-- ============= MODAL VISUALIZZA CLIENTI ============= -->
<div class="modal fade" id="visualizza_clienti" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><div id="titoloclienti"></div></h4>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-6">
                            <a data-dismiss="modal" data-dismiss="modal" href="#obj" data-toggle="modal" data-id="" class="flatb add">
                                <i class="fa fa-plus-circle"></i> <?=$this->lang->line('a_ordine');?>
                            </a>
                        </div>
                        <div class="col-md-12 col-lg-6 bio-row">
                            <a data-dismiss="modal" data-dismiss="modal" href="#lista_del_cliente" data-toggle="modal" class="flatb lista">
                                <i class="fa fa-list"></i> <?=$this->lang->line('lista_ordini');?>
                            </a>
                        </div>
                        <div class="col-md-12 col-lg-6 bio-row">
                            <p><span class="bold"><i class="fa fa-user"></i> <?=$this->lang->line('nome');?> </span><span id="nomec"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-6 bio-row">
                            <p><span class="bold"><i class="fa fa-user"></i> <?=$this->lang->line('cognome');?> </span><span id="cognomec"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-6 bio-row">
                            <p><span class="bold"><i class="fa fa-road"></i> <?=$this->lang->line('indirizzo');?></span><span id="indirizzoc"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-6 bio-row">
                            <p><span class="bold"><i class="fa fa-globe"></i> <?=$this->lang->line('citta');?></span><span id="cittac"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-6 bio-row">
                            <p><span class="bold"><i class="fa fa-phone"></i> <?=$this->lang->line('Telefono_t');?> </span><span id="telefonocc"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-6 bio-row">
                            <p><span class="bold"><i class="fa fa-envelope"></i> <?=$this->lang->line('email');?> </span><span id="emailc"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-6 bio-row">
                            <p><span class="bold"><i class="fa fa-barcode"></i> <?=$this->lang->line('vat');?> </span><span id="vatc"></span></p>
                        </div>
                        <div class="col-md-12 col-lg-6 bio-row">
                            <p><span class="bold"><i class="fa fa-quote-left"></i> <?=$this->lang->line('cf');?> </span><span id="cfc"></span></p>
                        </div>

                    </div>
                    <div class="form-group commenti">
                        <label><?=$this->lang->line('Commenti_t');?></label>
                        <textarea class="form-control" id="commentiu" rows="6" disabled></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer" id="footerClienti"></div>
        </div>
    </div>
</div>

<!-- ================ MODAL LISTA PAZIENTI  ================  -->
<div class="modal fade" id="lista_del_cliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="tit_ordini_cliente"></h4>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <table class="display compact table table-bordered table-striped" id="clienti_table">
                        <thead>
                            <tr>
                                <th>
                                    #
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
                <div class="modal-footer" id="footlista"><div class="btn-group btn-group-justified left"><button data-dismiss="modal" class="btn btn-default" type="button"><i class="fa fa-reply"></i> <?= $this->lang->line('js_torna_indietro');?></button></div></div>
            </div>
        </div>
    </div>
</div>


<!-- ============= MODAL MODIFICA CLIENTI ============= -->
<div class="modal fade" id="clientimodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="titclienti"></h4>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <p class="tips custip"></p>
                    <div class="row">
                        <form class="col s12">
                            <div class="col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('nome');?></label>
                                    <div class="iconic-input"><i class="fa  fa-user"></i>
                                        <input id="nome1" type="text" class="validate form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('cognome');?></label>
                                    <div class="iconic-input"><i class="fa  fa-user"></i>
                                        <input id="cognome1" type="text" class="validate form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label><?=$this->lang->line('indirizzo');?></label>
                                    <div class="iconic-input"><i class="fa fa-road"></i>
                                        <input id="indirizzo1" type="text" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('citta');?></label>
                                    <div class="iconic-input"><i class="fa fa-globe"></i>
                                        <input id="citta1" type="text" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('Telefono_t');?></label>
                                    <div class="iconic-input"><i class="fa fa-phone"></i>
                                        <input id="telefono1" type="text" class="validate form-control" data-mask="(999) 999-9999">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('email');?></label>
                                    <div class="iconic-input"><i class="fa fa-envelope"></i>
                                        <input id="email1" type="email" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('vat');?></label>
                                    <div class="iconic-input"><i class="fa fa-envelope"></i>
                                        <input id="vat1" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('cf');?></label>
                                    <input id="cf1"  class="validate form-control"></textarea>
                            </div>
                            </div>
                        <div class="input-field col-lg-12">
                            <div class="form-group">
                                <label><?=$this->lang->line('Commenti_t');?></label>
                                <textarea class="form-control" id="commentiu1" rows="6"></textarea>
                            </div>
                        </div>
                        </form>
                </div>
            </div>
            <div class="modal-footer" id="footerClienti1"> </div>
        </div>
    </div>
</div>
</div>

<!-- ============= MODAL ADD EDIT USERS ============= -->
<div class="modal fade" id="manageUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="titleUser"></h4>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <p class="tips custip"></p>
                    <div class="row">
                        <form class="col s12">
                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('store_name');?></label>
                                    <div class="iconic-input"><i class="fa  fa-user"></i>
                                        <input id="store_name" type="text" class="validate form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('store_code');?></label>
                                    <div class="iconic-input"><i class="fa  fa-user"></i>
                                        <input id="store_code" type="text" class="validate form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label><?=$this->lang->line('store_username');?></label>
                                    <div class="iconic-input"><i class="fa fa-road"></i>
                                        <input id="store_username" type="text" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('store_password');?></label>
                                    <div class="iconic-input"><i class="fa fa-globe"></i>
                                        <input id="store_password" type="text" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('Telefono_t');?></label>
                                    <div class="iconic-input"><i class="fa fa-phone"></i>
                                        <input id="store_phone" type="text" class="validate form-control" data-mask="(999) 999-9999">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('store_address');?></label>
                                    <div class="iconic-input"><i class="fa fa-envelope"></i>
                                        <input id="store_address" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
            <div class="modal-footer" id="footerManageUser"> </div>
        </div>
    </div>
</div>
</div>

<!-- ============= MODAL ADD EDIT EMPLOYEES ============= -->
<div class="modal fade" id="manageEmployeeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="titleEmployee"></h4>
            </div>
            <div class="modal-body">
                <div class="panel-body">
                    <p class="tips custip"></p>
                    <div class="row">
                        <form class="col s12">
                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('employee_name');?></label>
                                    <div class="iconic-input"><i class="fa  fa-user"></i>
                                        <input id="employee_name" type="text" class="validate form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('employee_sur_name');?></label>
                                    <div class="iconic-input"><i class="fa  fa-user"></i>
                                        <input id="employee_lastname" type="text" class="validate form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label><?=$this->lang->line('employee_login_code');?></label>
                                    <div class="iconic-input"><i class="fa fa-road"></i>
                                        <input id="employee_logincode" type="text" class="validate form-control" placeholder="code will generate automatically and you can see after save" readonly="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('email');?></label>
                                    <div class="iconic-input"><i class="fa fa-globe"></i>
                                        <input id="employee_email" type="text" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('Telefono_t');?></label>
                                    <div class="iconic-input"><i class="fa fa-phone"></i>
                                        <input id="employee_phone" type="text" class="validate form-control" data-mask="(999) 999-9999">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6 input-field">
                                <div class="form-group">
                                    <label><?=$this->lang->line('store_address');?></label>
                                    <div class="iconic-input"><i class="fa fa-envelope"></i>
                                        <input id="employee_address" class="validate form-control">
                                    </div>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
            <div class="modal-footer" id="footerManageEmployee"> </div>
        </div>
    </div>
</div>
</div>