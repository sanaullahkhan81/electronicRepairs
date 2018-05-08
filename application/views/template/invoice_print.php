<?php


$tasse = ($impostazioni[0]['tax'] / 100) * $db['Prezzo'];
$senza_tasse = ($db['Prezzo']) - (($impostazioni[0]['tax'] / 100) * $db['Prezzo']); // PRICE WITHOUT TAX
$totale = $db['Prezzo']; // PRICE WITH TAX
//<style><?php include FCPATH.'css/invoice.css';</style> 
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= lang('invoice');?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="<?=site_url('js/jquery.js'); ?>"></script>
        <style>
            body{
                font-weight:bolder;
            }
            table {
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid black;
}
@media print {
    #completa{
        display: none !important;
    }
}
            </style>
    </head>
    <?php 
echo '<style id="colori">';
echo $stile;
echo '</style>';
    ?>
    <body style="width: 7.5cm; margin:0 auto;">
      
        <header class="clearfix">
            <div id="company" contentEditable="true">
                <h2 class="name" align="center"><?= $impostazioni[0]['titolo']; ?></h2>
<!--                <div><?= $impostazioni[0]['invoice_name']; ?></div>-->
                <p align="center">
                    <?= $impostazioni[0]['indirizzo']; ?><br>
                    <?= $impostazioni[0]['telefono']; ?><br>
                    <a href=""><?= $impostazioni[0]['invoice_mail']; ?></a><br>
               <?= $impostazioni[0]['vat']; ?>
                </p>
                <hr>
                
            </div>
            </div>
        </header>
    <main>
        <div id="details" class="clearfix">
      
            <div id="invoice" contentEditable="true">
                <h3>Receipt # <i><?=$db['codice']?></i></h3>
                <div class="date"><?= lang('data_fattura');?>: <?= date_format(date_create($db['dataChiusura']),"d/m/Y"); ?></div>
            </div>
        <!--</div>-->
        
         <table border="1" cellspacing="5" cellpadding="5" >
            
                <tr>
                    <th >#</th>
                    <th ><?= lang('descrizione');?></th>
                    <th ><?= lang('Prezzo_t');?></th>
                    <th ><?= lang('quantity');?></th>
                    <th ><?= lang('Prezzo_t');?></th>
                </tr>

            
                <tr>
                    <td> 01</td>
                    <td ><?php echo lang('js_tipo_riparazione').': '.$db['Guasto'].' '.$db['Modello'];?></td>
                    <td ><?=$this->Impostazioni_model->get_money($senza_tasse);?></td>
                    <td >1</td>
                    <td ><?=$this->Impostazioni_model->get_money($senza_tasse);?></td>
                </tr>
                 <tr>
                    <td colspan="2" rowspan="3" id="commenti">
                        Fault:<br>
                        <?= $db['Guasto']; ?>
                    </td>
                    <td colspan="2"><?= lang('subtotal');?></td>
                    <td contentEditable="true"><?=$this->Impostazioni_model->get_money($senza_tasse);?></td>
                </tr>
                <tr>
                    <td colspan="2">Advance Paid</td>
                    <td><?= '£ '.$db['Anticipo'];?></td>
                </tr>
                <tr>
                    <td colspan="2">Balance to Pay: </td>
                    <td><?= 
                    
                    '£ '.$bal = $db['Prezzo']-$db['Anticipo'];?></td>
                </tr>
           
         </table>
       
        </div>
       
    </main>
    <footer>
        <?= $impostazioni[0]['disclaimer']; ?>
    </footer>
<button type="button" id="completa" class="btn btn-primary" onClick="window.print()"><i class="fa fa-print"></i> Print Receipt</button>
<!--    <div id="print_button"><?= lang('print_invoice');?></div>-->

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

