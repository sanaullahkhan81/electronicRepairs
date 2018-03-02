jQuery(document).ready(function () {
	var postJSON;
	postJSON = 'aa'


    jQuery(".add_user").on("click", function (e) {
        $('#manageUserModal').modal('show');
		clearTips(jQuery('.tips'));

		jQuery('#name').val('');
		jQuery('#lastname').val('');
		jQuery('#address').val('');
		jQuery('#email').val('');
		jQuery('#password').val('');
		jQuery('#userType').val('');
		jQuery('#phone').val('');
		jQuery('#titclienti').html('Add New User');

        jQuery('#footerClienti1').html("<div class=\"btn-group btn-group-justified left\"><button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> Go back</button></div><div class=\"btn-group btn-group-justified right\"><button id='submit' class='btn btn-success' data-modo='apri'><i class='fa fa-user'></i> Add user</a></div>");
	});

	jQuery(document).on("click", "#submit", function () {
		var modo = jQuery(this).data("modo");
		var id = jQuery(this).data("num");

		var data = {name : jQuery('#name').val(),
                        lastname : jQuery('#lastname').val(),
                        address : jQuery('#address').val(),
                        email : jQuery('#email').val(),
                        password : jQuery('#password').val(),
                        userType : jQuery('#userType').val(),
                        phone : jQuery('#phone').val(),
                };
        
		clearTips(jQuery('.tips'));
		//validate
		var valid = validLongName(jQuery('#nome1'), "Name", jQuery('.tips')) && validLongName(jQuery('#cognome1'), "Surname", jQuery('.tips')) && validNumeric(jQuery('#telefono1'), jQuery('.tips'), "Insert correct number");

		if (valid) {
			var url = "";
			var dataString = "";

			if (modo == "apri") {
				url = base_url + "manageuser/add_new";
//dataString = "nome=" + encodeURIComponent(nome) + "&cognome=" + encodeURIComponent(cognome)  + "&indirizzo=" + encodeURIComponent(indirizzo)  + "&citta=" + encodeURIComponent(citta)  + "&telefono=" + encodeURIComponent(telefono)  + "&email=" + encodeURIComponent(email)  + "&commenti=" + encodeURIComponent(commenti)  + "&vat=" + encodeURIComponent(vat)  + "&cf=" + encodeURIComponent(cf)  + "&token=950ccb0cee";
				jQuery.ajax({
					type: "POST",
					url: url,
					data: data,
					cache: false,
					success: function (data) {
						toastr['success']("Saving", "Customer " + nome + " " + cognome + " added to database");
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
                dataString = "nome=" + encodeURIComponent(nome)  + "&cognome=" + encodeURIComponent(cognome)  + "&indirizzo=" + encodeURIComponent(indirizzo)  + "&citta=" + encodeURIComponent(citta)  + "&telefono=" + encodeURIComponent(telefono)  + "&id=" + encodeURIComponent(id)  + "&email=" + encodeURIComponent(email)  + "&commenti=" + encodeURIComponent(commenti)  + "&vat=" + encodeURIComponent(vat)  + "&cf=" + encodeURIComponent(cf)  + "&token=950ccb0cee";
				jQuery.ajax({
					type: "POST",
					url: url,
					data: dataString,
					cache: false,
					success: function (data) {
						toastr['success']("Saving", "Customer " + nome + " " + cognome + " updated");
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
			data: "id=" + encodeURIComponent(num) + "&token=950ccb0cee",
			cache: false,
			dataType: "json",
			success: function (data) {
				if (typeof data.nome === 'undefined') {
					$('#visualizza_clienti').modal('hide');
					toastr['error']('Customer not found', '');
				} else {
					jQuery('#titoloclienti').html('Customer: ' + data.nome);
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

                    var string = "<div class=\"btn-group btn-group-justified left\"><button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> Go back</button></div><div class=\"btn-group btn-group-justified right\"><button id=\"elimina_c\" data-dismiss=\"modal\" data-num=\"" + encodeURIComponent(num) + "\" class=\"btn btn-danger\" type=\"button\"><i class=\"fa fa-trash-o \"></i> Delete</button><button data-dismiss=\"modal\" id=\"modifica_c\" href=\"#clientimodal\" data-toggle=\"modal\" data-num=\"" + encodeURIComponent(num) + "\" class=\"btn btn-success\"><i class=\"fa fa-pencil\"></i> Modify</button></div>";

					jQuery('#footerClienti').html(string);
				}
			}
		});
	}

	jQuery(document).on("click", "#modifica_c", function () {
		jQuery('#titclienti').html('Edit customer');
		clearTips(jQuery('.tips'));
		var num = jQuery(this).data("num");



		jQuery.ajax({
			type: "POST",
			url: base_url + "clienti/prendi_cliente",
			data: "id=" + encodeURIComponent(num) + "&token=950ccb0cee",
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

jQuery('#footerClienti1').html("<div class=\"btn-group btn-group-justified left\"><button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> Go back</button></div><div class=\"btn-group btn-group-justified right\"><button id='submit' class='btn btn-success' data-modo='modifica' data-num=" + encodeURIComponent(num) + "><i class=\"fa fa-save\"></i> Save</button></div>")
			}
		});
	});


	jQuery(document).on("click", "#elimina_c", function () {
		var num = jQuery(this).data("num");
		jQuery.ajax({
			type: "POST",
			url: base_url + "clienti/elimina",
			data: "id=" + encodeURIComponent(num) + "&token=950ccb0cee",
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
				toastr['success']("Deleted", "The customers was definitively deleted from database");
                $('#dynamic-table').DataTable().ajax.reload();
			}
		});
	});
    
    tableAjax = jQuery('#clienti_table').dataTable(getAjaxUrl(''));

});

function getAjaxUrl(id)
{
    var data = {
        "ajax": "http://repairs.epbuys.co.uk/home/ajax/1"+id,
        "order": [[ 0, "desc" ]],
        "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
        "language": {
            "lengthMenu": "_MENU_ records per page",
            "zeroRecords": "0 rows found",
            "info": "Showing page _PAGE_ of _PAGES_",
            "infoEmpty": "No rows found",
            "search":    "Search:",
            "infoFiltered": "(Filtered from _MAX_ total records)",
            "paginate": {
                "first":      "First",
                "last":       "Last",
                "next":       "Next",
                "previous":   "Previous"
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