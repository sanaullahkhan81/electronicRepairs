jQuery(document).ready(function () {
	var postJSON;
	postJSON = 'aa'

	toastr.options = {
		"closeButton": true,
		"debug": false,
		"progressBar": true,
		"positionClass": "toast-bottom-right",
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}

	jQuery(document).on("click", "#submit", function () {

		var codice = jQuery('#codice_riparazione').val();

		var url = "";
		var dataString = "";
		url = base_url + "status/ottieni_stato";
		dataString = "codice=" + codice;
		jQuery.ajax({
			type: "POST",
			url: url,
			data: dataString,
			cache: false,
			dataType: "json",
			success: function (data) {

				if(isEmpty(data)) {toastr['error']("<?= $this->lang->line('toast_errore');?>", "<?= $this->lang->line('toast_rip_non_presente');?>");}
				else {
					toastr['success']("<?= $this->lang->line('toast_rip_trovata');?>", "<?= $this->lang->line('toast_rip_testo');?>")
                    if(data.status == 0) {var stato = "<span style='background-color: <?=$impostazioni[0]['colore4'];?>;'><?= $this->lang->line('completato');?></span>"; }
                    else if(data.status == 1){ var stato = "<span style='background-color: <?=$impostazioni[0]['colore1'];?>;'><?= $this->lang->line('incorso');?></span>";}
                    else if(data.status == 3){ var stato = "<span style='background-color: <?=$impostazioni[0]['colore3'];?>;'><?= $this->lang->line('inattesa');?></span>";}
                    else if(data.status == 2){ var stato = "<span style='background-color: <?=$impostazioni[0]['colore2'];?>;'><?= $this->lang->line('daconsegnare');?></span>";}
                    else { var stato = "<span style='background-color: <?=$impostazioni[0]['colore5'];?>;'><?= $this->lang->line('nonriparato');?></span>";}

                    if(data.dataChiusura == null) {
                        jQuery('.centre_box div.col_chiuso').hide();
                    }
                    else
                    {
                        jQuery('.centre_box div.col_chiuso').fadeIn();
                        jQuery('#dataChiusura').html(data.dataChiusura)
                    }

					jQuery('#clientec').html(data.Nominativo);
					jQuery('#codicec').html(data.ID); 
					jQuery('#statoc').html(stato);
					jQuery('#dataAperturac').html(data.dataApertura);
					jQuery('#guastoc').html(data.Guasto);
                    jQuery('#categoriac').html(data.Categoria);
					jQuery('#modelloc').html(data.Modello);
					jQuery('#pezzoc').html(data.Pezzo);
					jQuery('#anticipoc').html(data.Anticipo);
                    jQuery('#prezzoc').html(data.Prezzo);
					jQuery('#telefonoc').html(data.Telefono);
					jQuery('#cod_rip').html(data.codice);
                    
					jQuery('.centre_box.status_box').fadeIn(1000);
				}
			}
		});
	});

});

function isEmpty(obj) {
	return Object.keys(obj).length === 0;
}