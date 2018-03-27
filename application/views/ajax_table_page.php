<?php if($table == 1)
{
?>
{
"data": [

<?php 
    $qnt = count($lista);
    $i = 0;

    foreach ($lista as $ogg) :

    $search = array('"');
    $replace = array('Qiao');
    $subject = 'Hello {user}, welcome to {site}.';

    $ogg = array_map(function($v) {return str_replace('"', '\"', $v); }, $ogg);

    $i += 1;
    if ($ogg['status'] == 1) {
        $style = $impostazioni[0]['colore1'];
        $stato_text = lang('incorso');
    } elseif ($ogg['status'] == 2) {
        $style = $impostazioni[0]['colore2'];
        $stato_text = lang('daconsegnare');
    } elseif ($ogg['status'] == 3) {
        $style = $impostazioni[0]['colore3'];
        $stato_text = lang('inattesa');
    } elseif ($ogg['status'] == 0) {
        $style = $impostazioni[0]['colore4'];
        $stato_text = lang('completato');
    } else {
        $style = $impostazioni[0]['colore5'];
        $stato_text = lang('nonriparato');
    }
    
    if ($ogg['engineer_status'] == 0) {
        $styleEng = '#dddddd';
        $status_text_eng = 'Not Sent';
    } elseif ($ogg['engineer_status'] == 1) {
        $styleEng = '#41cac0';
        $status_text_eng = 'In Progress';
    } elseif ($ogg['engineer_status'] == 2){
        $styleEng = '#78CD51';
        $status_text_eng = 'Completed';
    } else {
        $styleEng = '';
        $status_text_eng = '';
    }
?>

{
"id": <?= $ogg['ID']; ?>,
"stato": "<span class='label label-mini' style='background: <?= $style; ?>;'><?= $stato_text; ?></span>",
"status_eng": "<span class='label label-mini' style='background: <?= $styleEng; ?>;'><?= $status_text_eng; ?></span>",
"cliente": "<a class='visualizza' data-dismiss='modal' href='#visualizza_clienti' data-toggle='modal' data-num='<?=  $ogg['ID_Nominativo']; ?>'><?=  $ogg['Nominativo']; ?></a>",
"tipo": "<?php if ($ogg['Tipo'] == 1) {
        echo lang('js_tipo_ordine_pezzo');
    } else {
        echo lang('js_tipo_riparazione');
    } ?>",
"modello": "<?= $ogg['Modello']; ?>",
"guasto": "<?= $ogg['Guasto']; ?>",
"data": "<?= date('d/m/Y', strtotime($ogg['dataApertura'])); ?>",
"telefono": "<?= $ogg['Telefono']; ?>",
"code": "<?= $ogg['codice']; ?>",
"azioni": "<?="<a data-dismiss='modal' class='visualizza_or' href='#visualizza_ordini' data-toggle='modal' data-num='".$ogg['ID']."'><button class='btn btn-success btn-xs'><i class='fa fa-check'></i></button></a><a  data-dismiss='modal' id='modifica' href='#obj' data-toggle='modal' data-num='".$ogg['ID']."'><button class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button></a>".(($this->session->userdata('user_type') != 'employee')?"<a id='elimina' data-num='".$ogg['ID']."' data-tipo='".$ogg['Tipo']."'><button class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button></a>":'')?>"
}<?php if ($i < $qnt) {
        echo ',';
    } ?>
<?php endforeach; ?>
]
}
<?php } else {  
    // INIZIO TABELLA CLIENTI //?>

{
"data": [

<?php 
    $qnt = count($lista);
    $i = 0;
    foreach ($lista as $ogg) :
    $ogg = array_map(function($v) {return str_replace('"', '\"', $v); }, $ogg);
    $i += 1;
?>

{
"nome": "<?=$ogg['nome']; ?>",
"cognome": "<?=$ogg['cognome']; ?>",
"indirizzo": "<?=$ogg['indirizzo']; ?>",
"email": "<?= $ogg['email']; ?>",
"telefono": "<?= $ogg['telefono']; ?>",
"azioni": "<?= "<a  data-dismiss='modal' class='visualizza' href='#visualizza_clienti' data-toggle='modal' data-num='".$ogg['id']."'><button class='btn btn-success btn-xs'><i class='fa fa-check'></i></button></a><a  data-dismiss='modal' id='modifica_c' href='#clientimodal' data-toggle='modal' data-num='".$ogg['id']."'><button class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button></a>".(($this->session->userdata('user_type') != 'employee')?"<a id='elimina_c' data-num='".$ogg['id']."'><button class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button></a>":'');?>"
}<?php if ($i < $qnt) {
        echo ',';
    } ?>
<?php endforeach; ?>
]
}




<?php } ?>