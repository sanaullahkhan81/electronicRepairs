<?php
$tasse = ($impostazioni[0]['tax'] / 100) * $db['Prezzo'];
$senza_tasse = ($db['Prezzo']) - (($impostazioni[0]['tax'] / 100) * $db['Prezzo']); // PRICE WITHOUT TAX
$totale = $db['Prezzo']; // PRICE WITH TAX

if($db['Tipo'] == 2) $tipo = strtolower(lang('js_tipo_riparazione'));
else {
    if($lingua == "greek") $tipo = lang('js_tipo_ordine_pezzo');
    else$tipo = strtolower(lang('js_tipo_ordine_pezzo'));
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= lang('resoconto');?></title>
        <style><?php include FCPATH.'css/invoice.css'; ?></style>
        <script src="<?=site_url('js/jquery.js'); ?>"></script>
    </head>
    <?php 
$colore = $impostazioni[0]['colore_prim'];
echo '<style id="colori">';
include FCPATH.'application/views/js/colori_js.php';
echo '</style>';
    ?>
    <body>
        <div id="editable_invoice"><?= lang('editable_invoice');?></div>
        <div class="halfinvoice <?=(!$impostazioni[0]['printinonepage'] ? 'full' : '');?>">
            <header class="clearfix">
                <div id="company" contentEditable="true">
                    <h2 class="name"><?= $impostazioni[0]['titolo']; ?></h2>
                </div>
            </header>
            <main>
                <div id="details" class="clearfix">
                    <div id="client" contentEditable="true">
                        <div class="to"><?= lang('Cliente_t');?>:</div>
                        <h2 class="name"><?=$db['Nominativo']; ?></h2> 
                    </div>
                    <div id="invoice" contentEditable="true">
                        <h1><?= lang('resoconto').' '.$tipo.' '.$db['Modello'];?></h1>
                        <div class="date"><?= lang('data_resoconto');?>: <?= date_format(date_create($db['dataApertura']),"Y/m/d"); ?></div>
                    </div>
                </div>

                <div id="dati">
                    <div class="col"><b><?= lang('Modello_t');?>:</b> <?=$db['Modello'];?></div>
                    <div class="col"><b><?= lang('Categoria_t');?>:</b> <?=$db['Categoria'];?></div>
                    <div class="col"><b><?= lang('Guasto_t');?>:</b> <?=$db['Guasto'];?></div>
                    <div class="col"><b><?= lang('Pezzo_t');?>:</b> <?=$db['Pezzo'];?></div>
                    <div class="col"><b><?= lang('Anticipo_t');?>:</b> <?=$this->Impostazioni_model->get_money($db['Anticipo']);?></div>
                    <div class="col"><b><?= lang('Prezzo_t');?>:</b><?=$this->Impostazioni_model->get_money($db['Prezzo']);?></div>
                    <div class="col"><b><?= lang('cod_riparazione');?>:</b> <?=$db['codice'];?></div>
                    <div class="col"><b><?= lang('ID_t');?>:</b> <?=$db['ID'];?></div>
                    <?php $campi = unserialize( base64_decode($impostazioni['0']['campi_personalizzati']));
                    $valori = json_decode($db['custom_field'], true);
                    foreach($campi as $line){ ?>

                    <div class="col"><b> <?= $line; ?> :</b> <?= $valori[bin2hex($line)]; ?></div>

                    <?php } ?>
                    <div class="col txt"><textarea id="commento" onkeyup="auto_grow(this)" contentEditable="true"><?=$db['Commenti']; ?></textarea></div>
                    <div style="clear: both;"></div>
                </div>

            </main>
            <footer>
                <?= $impostazioni[0]['disclaimer']; ?>
            </footer>

            <div id="print_button"><?= lang('print_resoconto');?></div>
        </div>
        
        <?php if($impostazioni[0]['stampadue']) { ?>
        <!-- SECONDA COPIA -->
        <div class="halfinvoice seconda <?=(!$impostazioni[0]['printinonepage'] ? 'full' : '');?>">
            <header class="clearfix">
                <div id="company" contentEditable="true">
                    <h2 class="name"><?= $impostazioni[0]['titolo']; ?></h2>
                </div>
            </header>
            <main>
                <div id="details" class="clearfix">
                    <div id="client" contentEditable="true">
                        <div class="to"><?= lang('Cliente_t');?>:</div>
                        <h2 class="name"><?=$db['Nominativo']; ?></h2> 
                    </div>
                    <div id="invoice" contentEditable="true">
                        <h1><?= lang('resoconto').' '.$tipo.' '.$db['Modello'];?></h1>
                        <div class="date"><?= lang('data_resoconto');?>: <?= date_format(date_create($db['dataApertura']),"Y/m/d"); ?></div>
                    </div>
                </div>

                <div id="dati">
                    <div class="col"><b><?= lang('Modello_t');?>:</b> <?=$db['Modello'];?></div>
                    <div class="col"><b><?= lang('Categoria_t');?>:</b> <?=$db['Categoria'];?></div>
                    <div class="col"><b><?= lang('Guasto_t');?>:</b> <?=$db['Guasto'];?></div>
                    <div class="col"><b><?= lang('Pezzo_t');?>:</b> <?=$db['Pezzo'];?></div>
                    <div class="col"><b><?= lang('Anticipo_t');?>:</b> <?=$this->Impostazioni_model->get_money($db['Anticipo']);?></div>
                    <div class="col"><b><?= lang('Prezzo_t');?>:</b><?=$this->Impostazioni_model->get_money($db['Prezzo']);?></div>
                    <div class="col"><b><?= lang('cod_riparazione');?>:</b> <?=$db['codice'];?></div>
                    <div class="col"><b><?= lang('ID_t');?>:</b> <?=$db['ID'];?></div>
                    <?php $campi = unserialize( base64_decode($impostazioni['0']['campi_personalizzati']));
                                                 $valori = json_decode($db['custom_field'], true);
                                                 foreach($campi as $line){ ?>

                    <div class="col"><b> <?= $line; ?> :</b> <?= $valori[bin2hex($line)]; ?></div>

                    <?php } ?>
                    <div class="col txt"><textarea id="commento" onkeyup="auto_grow(this)" contentEditable="true"><?=$db['Commenti']; ?></textarea></div>
                    <div style="clear: both;"></div>
                </div>

            </main>
            <footer>
                <?= $impostazioni[0]['disclaimer']; ?>
            </footer>

            <div id="print_button"><?= lang('print_invoice');?></div>
        </div>
        <?php } ?>
    </body>

    <script>
        jQuery(document).on("click", "#print_button", function() {
            var num = jQuery(this).data("num");
            toastr['success']("<?= lang('js_stampa_in_corso');?>");
            window.print();
            setInterval(function() {
                window.close();
            }, 500);
        });
        function auto_grow(element) {
            element.style.height = "5px";
            element.style.height = (element.scrollHeight)+"px";
        }
        auto_grow(document.getElementById("commento"));
    </script>
    <link rel="stylesheet" href="<?= site_url('assets/css/toastr.min.css'); ?>">
    <script src="<?= site_url('assets/js/toastr.min.js'); ?>"></script>

</html>

