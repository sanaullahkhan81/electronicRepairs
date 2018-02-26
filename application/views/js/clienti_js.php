jQuery(document).ready(function () {
	var postJSON;
	postJSON = 'aa'


    jQuery(".add_c").on("click", function (e) {
        $('#clientimodal').modal('show');
		clearTips(jQuery('.tips'));

		jQuery('#nome1').val('');
		jQuery('#cognome1').val('');
		jQuery('#indirizzo1').val('');
		jQuery('#citta1').val('');
		jQuery('#telefono1').val('');
		jQuery('#email1').val('');
		jQuery('#commentiu1').val('');
		jQuery('#titclienti').html('<?= $this->lang->line('js_reg_c');?>');

        jQuery('#footerClienti1').html("<div class=\"btn-group btn-group-justified left\"><button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> <?= $this->lang->line('js_torna_indietro');?></button></div><div class=\"btn-group btn-group-justified right\"><button id='submit' class='btn btn-success' data-modo='apri'><i class='fa fa-user'></i> <?= $this->lang->line('js_aggiungi_c');?></a></div>");
	});

	jQuery(document).on("click", "#submit", function () {
		var modo = jQuery(this).data("modo");
		var id = jQuery(this).data("num");

		var nome = jQuery('#nome1').val();
		var cognome = jQuery('#cognome1').val();
		var indirizzo = jQuery('#indirizzo1').val();
		var citta = jQuery('#citta1').val();
		var telefono = jQuery('#telefono1').val();
		var email = jQuery('#email1').val();
		var commenti = jQuery('#commentiu1').val();
		var vat = jQuery('#vat1').val();
		var cf = jQuery('#cf1').val();
        
		clearTips(jQuery('.tips'));
		//validate
		var valid = validLongName(jQuery('#nome1'), "<?= $this->lang->line('nome');?>", jQuery('.tips')) && validLongName(jQuery('#cognome1'), "<?= $this->lang->line('cognome');?>", jQuery('.tips')) && validNumeric(jQuery('#telefono1'), jQuery('.tips'), "<?=$this->lang->line('nr_tel_corretto');?>");

		if (valid) {
			var url = "";
			var dataString = "";

			if (modo == "apri") {
				url = base_url + "clienti/aggiungi_cliente";
dataString = "nome=" + encodeURIComponent(nome) + "&cognome=" + encodeURIComponent(cognome)  + "&indirizzo=" + encodeURIComponent(indirizzo)  + "&citta=" + encodeURIComponent(citta)  + "&telefono=" + encodeURIComponent(telefono)  + "&email=" + encodeURIComponent(email)  + "&commenti=" + encodeURIComponent(commenti)  + "&vat=" + encodeURIComponent(vat)  + "&cf=" + encodeURIComponent(cf)  + "&token=<?=$_SESSION['token'];?>";
				jQuery.ajax({
					type: "POST",
					url: url,
					data: dataString,
					cache: false,
					success: function (data) {
						toastr['success']("<?= $this->lang->line('js_salva_in_corso');?>", "<?= $this->lang->line('Cliente_t');?> " + nome + " " + cognome + " <?= $this->lang->line('aggiunto_al_db');?>");
						setTimeout(function () {
                            $('#clientimodal').modal('hide');
                            find(data);
                            $('#dynamic-table').DataTable().ajax.reload();
                            jQuery('#nominativo1').append('<option value="'+data+'">'+nome+' '+cognome+'</option>');
                            if(!$("#obj").hasClass('in'))
                            {
                                $('#visualizza_clienti').modal('show');
                            }
                            else
                            {
                                jQuery('#nominativo1 option[value="'+data+'"]').attr("selected", "selected");
                                $("#nominativo1").select2();
                            }
						}, 500);
					}
				});
			} else {
                url = base_url + "clienti/modifica_cliente";
                dataString = "nome=" + encodeURIComponent(nome)  + "&cognome=" + encodeURIComponent(cognome)  + "&indirizzo=" + encodeURIComponent(indirizzo)  + "&citta=" + encodeURIComponent(citta)  + "&telefono=" + encodeURIComponent(telefono)  + "&id=" + encodeURIComponent(id)  + "&email=" + encodeURIComponent(email)  + "&commenti=" + encodeURIComponent(commenti)  + "&vat=" + encodeURIComponent(vat)  + "&cf=" + encodeURIComponent(cf)  + "&token=<?=$_SESSION['token'];?>";
				jQuery.ajax({
					type: "POST",
					url: url,
					data: dataString,
					cache: false,
					success: function (data) {
						toastr['success']("<?= $this->lang->line('js_salva_in_corso');?>", "<?= $this->lang->line('Cliente_t');?> " + nome + " " + cognome + " <?= $this->lang->line('aggiornato');?>");
						setTimeout(function () {
                            $('#clientimodal').modal('hide');
                            find(id);
                            $('#visualizza_clienti').modal('show');
                            $('#dynamic-table').DataTable().ajax.reload();
						}, 500);
					}
				});
			}
		}
		return false;
	});

    jQuery(document).on("click", ".lista", function () {
        var titolo =  'Lista ordini di '+ jQuery( ".flatb.add" ).data("nome");
        $('#tit_ordini_cliente').html(titolo);
        tableAjax.api().ajax.url( base_url + 'home/ajax/1/'+jQuery( ".flatb.add" ).data( "id_nome") ).load();
    });

    jQuery(document).on("click", ".visualizza", function () {
		var num = jQuery(this).data("num");
		find(num);

	});

	if (getUrlVars()["id"]) {
		find(getUrlVars()["id"]);
		$('#visualizza_clienti').modal('show');
	}


	function find(num) {
		jQuery.ajax({
			type: "POST",
			url: base_url + "clienti/prendi_cliente",
			data: "id=" + encodeURIComponent(num) + "&token=<?=$_SESSION['token'];?>",
			cache: false,
			dataType: "json",
			success: function (data) {
				if (typeof data.nome === 'undefined') {
					$('#visualizza_clienti').modal('hide');
					toastr['error']('<?= $this->lang->line('cod_in');?>', '');
				} else {
					jQuery('#titoloclienti').html('<?= $this->lang->line('Cliente_t');?>: ' + data.nome);
                    jQuery( ".flatb.add" ).data( "nome", data.nome+' '+data.cognome);
                    jQuery( ".flatb.add" ).data( "id_nome", data.id);
                    jQuery( ".flatb.lista" ).data( "nome", data.nome+' '+data.cognome);
					jQuery('#nomec').html(data.nome);
					jQuery('#cognomec').html(data.cognome);
					jQuery('#indirizzoc').html(data.indirizzo);
					jQuery('#cittac').html(data.citta)
					jQuery('#telefonocc').html(data.telefono);
					jQuery('#emailc').html(data.email)
					jQuery('#commentiu').html(data.commenti);
					jQuery('#vatc').html(data.vat);
					jQuery('#cfc').html(data.cf);

                    var string = "<div class=\"btn-group btn-group-justified left\"><button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> <?= $this->lang->line('js_torna_indietro');?></button></div><div class=\"btn-group btn-group-justified right\"><button id=\"elimina_c\" data-dismiss=\"modal\" data-num=\"" + encodeURIComponent(num) + "\" class=\"btn btn-danger\" type=\"button\"><i class=\"fa fa-trash-o \"></i> <?= $this->lang->line('js_elimina');?></button><button data-dismiss=\"modal\" id=\"modifica_c\" href=\"#clientimodal\" data-toggle=\"modal\" data-num=\"" + encodeURIComponent(num) + "\" class=\"btn btn-success\"><i class=\"fa fa-pencil\"></i> <?= $this->lang->line('modifica');?></button></div>";

					jQuery('#footerClienti').html(string);
				}
			}
		});
	}

	jQuery(document).on("click", "#modifica_c", function () {
		jQuery('#titclienti').html('<?= $this->lang->line('edit_c');?>');
		clearTips(jQuery('.tips'));
		var num = jQuery(this).data("num");



		jQuery.ajax({
			type: "POST",
			url: base_url + "clienti/prendi_cliente",
			data: "id=" + encodeURIComponent(num) + "&token=<?=$_SESSION['token'];?>",
			cache: false,
			dataType: "json",
			success: function (data) {
				jQuery('#nome1').val(data.nome);
				jQuery('#cognome1').val(data.cognome);
				jQuery('#indirizzo1').val(data.indirizzo);
				jQuery('#citta1').val(data.citta)
				jQuery('#telefono1').val(data.telefono);
				jQuery('#email1').val(data.email)
				jQuery('#commentiu1').val(data.commenti);
				jQuery('#vat1').val(data.vat);
				jQuery('#cf1').val(data.cf);

jQuery('#footerClienti1').html("<div class=\"btn-group btn-group-justified left\"><button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> <?= $this->lang->line('js_torna_indietro');?></button></div><div class=\"btn-group btn-group-justified right\"><button id='submit' class='btn btn-success' data-modo='modifica' data-num=" + encodeURIComponent(num) + "><i class=\"fa fa-save\"></i> <?= $this->lang->line('js_save');?></button></div>")
			}
		});
	});


	jQuery(document).on("click", "#elimina_c", function () {
		var num = jQuery(this).data("num");
		jQuery.ajax({
			type: "POST",
			url: base_url + "clienti/elimina",
			data: "id=" + encodeURIComponent(num) + "&token=<?=$_SESSION['token'];?>",
			cache: false,
			dataType: "json",
			success: function (data) {
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
				toastr['success']("<?= $this->lang->line('el_cliente');?>", "<?= $this->lang->line('cliente_eliminato');?>");
                $('#dynamic-table').DataTable().ajax.reload();
			}
		});
	});
    
    tableAjax = jQuery('#clienti_table').dataTable(getAjaxUrl(''));

});

function getAjaxUrl(id)
{
    var data = {
        "ajax": "<?= site_url('home/ajax/1'); ?>"+id,
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
    }
    return data;
}

function getUrlVars() {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (m, key, value) {
		vars[key] = value;
	});
	return vars;
}