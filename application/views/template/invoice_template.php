<?php
$tasse = ($impostazioni[0]['tax'] / 100) * $db['Prezzo'];
$senza_tasse = ($db['Prezzo']) - (($impostazioni[0]['tax'] / 100) * $db['Prezzo']); // PRICE WITHOUT TAX
$advance = $db['Anticipo'];
$totale = $db['Prezzo']; // PRICE WITH TAX
$balanceToPay = $totale - $advance;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= lang('invoice');?></title>
        <style><?php include FCPATH.'css/invoice.css'; ?></style>
        <script src="<?=site_url('js/jquery.js'); ?>"></script>
    </head>
    <?php 
echo '<style id="colori">';
echo $stile;
echo '</style>';
    ?>
    <body>
        <div id="editable_invoice"><?= lang('editable_invoice');?></div>
        <header class="clearfix">
            <div id="company" contentEditable="true">
                <h2 class="name"><?= $impostazioni[0]['titolo']; ?></h2>
                <div><?= $impostazioni[0]['invoice_name']; ?></div>
                <div><?= $impostazioni[0]['indirizzo']; ?></div>
                <div><?= $impostazioni[0]['telefono']; ?></div>
                <div><a href="mailto:<?= $impostazioni[0]['invoice_mail']; ?>"><?= $impostazioni[0]['invoice_mail']; ?></a></div>
                <div><?= $impostazioni[0]['vat']; ?></div>
            </div>
            </div>
        </header>
    <main>
        <div id="details" class="clearfix">
            <div id="client" contentEditable="true">
                <div class="to"><?= lang('Cliente_t');?>:</div>
                <h2 class="name"><?=$db['Nominativo']; ?></h2>
                <div class="address"><?=($cliente['indirizzo']); ?></div>
                <div class="vat">
                    <?php 
if(isset($cliente['vat']))
{
    echo $cliente['vat']; 
    $ve = 1;
}
if(isset($cliente['cf']))
{
    if($ve) echo ' / ';
    echo $cliente['cf'];
}
                    ?>
                </div>
                <div class="email"><a href="mailto:<?=$cliente['email']; ?>"><?=$cliente['email']; ?></a></div>
            </div>
            <div id="invoice" contentEditable="true">
                <h1><?= lang('invoice_n');?> <i><?= $storedata['name']."-".$storedata['code']."-".$db['ID'] ?></i></h1>
                <div class="date"><?= lang('data_fattura');?>: <?= date_format(date_create($db['dataChiusura']),"Y/m/d"); ?></div>
            </div>
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
                <tr>
                    <th class="no">#</th>
                    <th class="desc"><?= lang('descrizione');?></th>
                    <th class="unit"><?= lang('Prezzo_t');?></th>
                    <th class="qty"><?= lang('quantity');?></th>
                    <th class="total"><?= lang('Prezzo_t');?></th>
                </tr>
            </thead>
            <tbody contentEditable="true">
                <tr>
                    <td class="no">01</td>
                    <td class="desc"><h3><?php if($db['Tipo'] == 2) {echo lang('js_tipo_riparazione').': '.$db['Guasto'].' '.$db['Modello']; } else { echo $db['Pezzo'].' '.$db['Modello'];} ?></td>
                    <td class="unit"><?=$this->Impostazioni_model->get_money($senza_tasse);?></td>
                    <td class="qty">1</td>
                    <td class="total"><?=$this->Impostazioni_model->get_money($senza_tasse);?></td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" rowspan="4" id="commenti"><textarea id="commento" onkeyup="auto_grow(this)" contentEditable="true"><?=$db['Commenti']; ?></textarea></td>
                    <td colspan="2"><?= lang('subtotal');?></td>
                    <td contentEditable="true"><?=$this->Impostazioni_model->get_money($senza_tasse);?></td>
                </tr>
                <tr>
                    <td colspan="2"><?= lang('tax');?> <?= $impostazioni[0]['tax']; ?>%</td>
                    <td contentEditable="true"><?=$this->Impostazioni_model->get_money($tasse);?></td>
                </tr>
                <tr>
                    <td colspan="2"><?= lang('advance_paid');?></td>
                    <td contentEditable="true"><?=$this->Impostazioni_model->get_money($advance);?></td>
                </tr>
                <tr>
                    <td colspan="2"><?= lang('balance_to_pay');?></td>
                    <td contentEditable="true"><?=$this->Impostazioni_model->get_money($balanceToPay);?></td>
                </tr>
            </tfoot>
        </table>
        <table border="0" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td colspan="5" style="background: none; padding: 0px;"></td>
                </tr>
                <tr>
                    <td colspan="5" style="background: none; padding: 0px;">Track your order on</td>
                </tr>
                <tr>
                    <td colspan="5" style="background: none; padding: 0px;"><a href="//www.pos.i-techuk.com" target="_blank">www.pos.i-techuk.com</a></td>
                </tr>
                <tr>
                    <td colspan="5" style="background: none; padding: 0px;">Tracking code: <?= $db['codice'];?></td>
                </tr>
            </tbody>
        </table>
    </main>
    <footer>
        <?= $impostazioni[0]['disclaimer']; ?>
    </footer>

    <div id="print_button"><?= lang('print_invoice');?></div>

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

