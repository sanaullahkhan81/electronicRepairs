jQuery(document).ready(function () {
	var postJSON;
	postJSON = 'aa'


    jQuery(".add_user").on("click", function (e) {
        $('#manageUserModal').modal('show');
		clearTips(jQuery('.tips'));

		jQuery('#store_name').val('');
		jQuery('#store_code').val('');
		jQuery('#store_username').val('');
		jQuery('#store_password').val('');
		jQuery('#store_phone').val('');
		jQuery('#store_address').val('');
		jQuery('#titleUser').html('Add New User');

        jQuery('#footerManageUser').html("<div class=\"btn-group btn-group-justified left\"><button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> Go back</button></div><div class=\"btn-group btn-group-justified right\"><button id='submit' class='btn btn-success' data-modo='apri'><i class='fa fa-user'></i> Add user</a></div>");
	});

	jQuery(document).on("click", "#submit", function () {
		var modo = jQuery(this).data("modo");
		var loginuserid = jQuery(this).data("loginuserid");
                var userid = jQuery(this).data("userid");

		var data = {store_name : jQuery('#store_name').val(),
                        store_code : jQuery('#store_code').val(),
                        store_email : jQuery('#store_username').val(),
                        store_password : jQuery('#store_password').val(),
                        store_phone : jQuery('#store_phone').val(),
                        store_address : jQuery('#store_address').val(),
                };
        
		clearTips(jQuery('.tips'));
		//validate
		var valid = validLongName(jQuery('#store_name'), "Store Name", jQuery('.tips')) && validLongName(jQuery('#store_code'), "Store code", jQuery('.tips'));

		if (valid) {
			var url = "";
			var dataString = "";

			if (modo == "apri") {
				url = base_url + "manageusers/add_new_store";
//dataString = "nome=" + encodeURIComponent(nome) + "&cognome=" + encodeURIComponent(cognome)  + "&indirizzo=" + encodeURIComponent(indirizzo)  + "&citta=" + encodeURIComponent(citta)  + "&telefono=" + encodeURIComponent(telefono)  + "&email=" + encodeURIComponent(email)  + "&commenti=" + encodeURIComponent(commenti)  + "&vat=" + encodeURIComponent(vat)  + "&cf=" + encodeURIComponent(cf)  + "&token=950ccb0cee";
				jQuery.ajax({
					type: "POST",
					url: url,
					data: data,
					cache: false,
					success: function (data) {
						toastr['success']("Saving", "Store added to database");
						setTimeout(function () {
                            $('#manageUserModal').modal('hide');
                            
                            $('#dynamic-table').DataTable().ajax.reload();
                            /*jQuery('#nominativo1').append('<option value="'+data+'">'+nome+' '+cognome+'</option>');
                            if(!$("#obj").hasClass('in'))
                            {
                                $('#visualizza_clienti').modal('show');
                            }
                            else
                            {
                                jQuery('#nominativo1 option[value="'+data+'"]').attr("selected", "selected");
                                $("#nominativo1").select2();
                            }*/
						}, 500);
					}
				});
			} else {
                url = base_url + "manageusers/update_store";
                var data = {store_name : jQuery('#store_name').val(),
                        store_code : jQuery('#store_code').val(),
                        store_email : jQuery('#store_username').val(),
                        store_password : jQuery('#store_password').val(),
                        store_phone : jQuery('#store_phone').val(),
                        store_address : jQuery('#store_address').val(),
                        store_id: userid,
                        login_id: loginuserid,
                };
				jQuery.ajax({
					type: "POST",
					url: url,
					data: data,
					cache: false,
					success: function (data) {
						toastr['success']("Saving", "Store updated");
						setTimeout(function () {
                            $('#manageUserModal').modal('hide');
                            
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

	jQuery(document).on("click", "#update_user", function () {
		jQuery('#titleUser').html('Edit Store');
		clearTips(jQuery('.tips'));
		var loginUserId = jQuery(this).data("loginuserid");
                var userId = jQuery(this).data("userid");


		jQuery.ajax({
			type: "POST",
			url: base_url + "manageusers/get_user_data",
			data: "userId=" + encodeURIComponent(userId),
			cache: false,
			dataType: "json",
			success: function (data) {
                                jQuery('#store_name').val(data.storename);
                                jQuery('#store_code').val(data.storecode);
                                jQuery('#store_username').val(data.email);
                                jQuery('#store_password').val(data.password);
                                jQuery('#store_phone').val(data.phone);
                                jQuery('#store_address').val(data.address);

jQuery('#footerManageUser').html("<div class=\"btn-group btn-group-justified left\"><button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> Go back</button></div><div class=\"btn-group btn-group-justified right\"><button id='submit' class='btn btn-success' data-modo='modifica' data-loginuserid=" + encodeURIComponent(loginUserId) + "  data-userid=" + encodeURIComponent(userId) + "><i class=\"fa fa-save\"></i> Save</button></div>")
			}
		});
	});


	jQuery(document).on("click", "#delete_user", function () {
		var loginUserId = jQuery(this).data("loginuserid");
                var userId = jQuery(this).data("userid");
		jQuery.ajax({
			type: "POST",
			url: base_url + "manageusers/delete_store",
			data: "store_id=" + encodeURIComponent(userId) + "&login_id=" + encodeURIComponent(loginUserId),
			cache: false,
			dataType: "json",
			success: function (data) {
				toastr['success']("Deleted", "Store deleted from database.");
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