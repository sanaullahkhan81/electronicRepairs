<?php 
if(!isset($noheader)) header('Content-type: text/xml');

echo '<?xml version="1.0" encoding="UTF-8"?><DocumentElement>';

    if(isset($id)) { ?>

    <<?=formatToTag( 'o_e_r_titolo');?>>
    <?= addXMLField('ID_t', $ordine['ID']); ?>
    <Customer>
        <?= addXMLField('ID_t', $cliente['id']); ?>
        <?= addXMLField('nome', $cliente['nome']); ?>
        <?= addXMLField('cognome', $cliente['cognome']); ?>
        <?= addXMLField('indirizzo', $cliente['indirizzo']); ?>
        <?= addXMLField('citta', $cliente['citta']); ?>
        <?= addXMLField('email', $cliente['email']); ?>
        <?= addXMLField('vat', $cliente['vat']); ?>
        <?= addXMLField('cf', $cliente['cf']); ?>
        <?= addXMLField('Data_t', date('d/m/Y',strtotime($cliente['data']))); ?>
        <?= addXMLField('Commenti_t', $cliente['commenti']); ?>
    </Customer>
    <?= addXMLField('Cliente_t', $ordine['Nominativo']); ?>
    <?= addXMLField('data_resoconto', date('d/m/Y H:i',strtotime($ordine['dataApertura']))); ?>
    <?= addXMLField('Modello_t', $ordine['Modello']); ?>
    <?= addXMLField('Categoria_t', $ordine['Categoria']); ?>
    <?= addXMLField('Guasto_t', $ordine['Guasto']); ?>
    <?= addXMLField('Pezzo_t', $ordine['Pezzo']); ?>
    <?= addXMLField('Anticipo_t',  $ordine['Anticipo']); ?>
    <?= addXMLField('Prezzo_t', $ordine['Prezzo']); ?>
    <?= addXMLField('cod_riparazione', $ordine['codice']); ?>
    <?= addXMLField('invoice', site_url('downloads/order_'.$ordine['ID'].'/'.formatToTag('xml_invoice').'.html')); ?>
    </<?=formatToTag( 'o_e_r_titolo');?>>
    <?php
    }
else
{
    if($page == 1) { foreach ($lista as $ogg) { ?>

    <<?=formatToTag( 'o_e_r_titolo');?>>

<?= addXMLField('ID_t', $ogg['ID']); ?>
<?= addXMLField('Cliente_t', $ogg['Nominativo']); ?>
<?= addXMLField('data_resoconto', date('d/m/Y H:i',strtotime($ogg['dataApertura']))); ?>
<?= addXMLField('Modello_t', $ogg['Modello']); ?>
<?= addXMLField('Categoria_t', $ogg['Categoria']); ?>
<?= addXMLField('Guasto_t', $ogg['Guasto']); ?>
<?= addXMLField('Pezzo_t', $ogg['Pezzo']); ?>
<?= addXMLField('Anticipo_t',  $ogg['Anticipo']); ?>
<?= addXMLField('Prezzo_t', $ogg['Prezzo']); ?>
<?= addXMLField('cod_riparazione', $ogg['codice']); ?>
<?= addXMLField('invoice', site_url('downloads/order_'.$ogg['ID'].'/'.formatToTag('invoice').'.html')); ?>

</<?=formatToTag( 'o_e_r_titolo');?>>

<?php } } else { foreach ($lista_c as $ogg) { ?>
<<?=formatToTag( 'clienti');?>>
<?= addXMLField('ID_t', $ogg['id']); ?>
<?= addXMLField('nome', $ogg['nome']); ?>
<?= addXMLField('cognome', $ogg['cognome']); ?>
<?= addXMLField('indirizzo', $ogg['indirizzo']); ?>
<?= addXMLField('citta', $ogg['citta']); ?>
<?= addXMLField('email', $ogg['email']); ?>
<?= addXMLField('vat', $ogg['vat']); ?>
<?= addXMLField('cf', $ogg['cf']); ?>
<?= addXMLField('Data_t', date('d/m/Y',strtotime($ogg['data']))); ?>
<?= addXMLField('Commenti_t', $ogg['commenti']); ?>
</<?=formatToTag( 'clienti');?>>
<?php } } } 

echo '</DocumentElement>';

function formatToTag($text)
{
    return str_replace(array(' ','&'), array('_','e'), ucwords(lang($text)));  
}

function addXMLField($tag, $value)
{
    return '<'.formatToTag($tag).'>'.$value.'</'.formatToTag($tag).'>';  
}

?>