jQuery(document).ready(function() {
    var postJSON;
    postJSON = 'aa';

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

    jQuery('.add').click(function(e) {
        clearTips(jQuery('.tips'));
        var tipo = jQuery(this).data('tipo');

        jQuery('#nominativo1').val('');
        jQuery(".default_sel").remove();
        jQuery('#nominativo1 option[value="'+jQuery(this).data('id_nome')+'"]').attr("selected", "selected");
        $("#nominativo1").select2();
        jQuery('.select_cat').show();
        jQuery('.inp_cat').hide();
        jQuery('#categoria1').val('');
        jQuery('#categoria_s').val('');
        $("#categoria_s").select2({
            placeholder: "<?= lang('seleziona_categoria'); ?>",
            allowClear: true
        });
        jQuery('#modello1').val('');
        jQuery('#guasto1').val('');
        jQuery('#pezzo1').val('');
        jQuery('#anticipo1').val('');
        jQuery('#prezzo1').val('');
        jQuery('#commenti1').val('');
        jQuery('#sms').prop('checked', false);
        jQuery('#send_email').prop('checked', false);
        
        $(".modal-content .custom").each(function() {
            $(this).val('');
        });

        if (tipo == 2) {
            jQuery('#tit').html('<?= lang('js_nuova_rip'); ?>');
            jQuery('#pezzo1').attr("disabled", true);
        } else {
            jQuery('#tit').html('<?= lang('js_nuovo_ord'); ?>');
            jQuery('#pezzo1').attr("disabled", false);
        }
        
        jQuery('#signature_image').hide();
        jQuery('#signature-pad').show();
                
        jQuery('#footerOR1').html("<div class=\"btn-group btn-group-justified left\"> <select id=\"status_edit\" class=\"form-control m-bot15\"><option value=\"1\"><?= lang('incorso'); ?></option><option value=\"3\"><?= lang('inattesa'); ?></option><option value=\"2\"><?= lang('daconsegnare'); ?></option><option value=\"0\"><?= lang('completato'); ?></option><option value=\"5\"><?= lang('nonriparato'); ?></option></select> <input id=\"codice\" type=\"text\" class=\"validate form-control\" value=\"" +  randomString(8) + "\" placeholder=\"<?= lang('codice'); ?>\"><label style=\"float:left;\">Engineer code</label><input id=\"engineer_code\" type=\"text\" class=\"validate form-control\" value=\"" +  randomString(10) + "\" placeholder=\"Secret code (For Engineer check)\"></div><div class=\"btn-group btn-group-justified right\"><button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> <?= lang('js_torna_indietro'); ?></button><button id='submitOR' class='btn btn-success' data-tipo=" + tipo + " data-modo='apri'><i class=\"fa fa-plus-circle\"></i> <?= lang('js_aggiungi'); ?></a></div>");
    });

    jQuery(document).on("click", "#submitOR", function() {
        var modo = jQuery(this).data("modo");
        var id = jQuery(this).data("num");

        var nominativo = jQuery('#nominativo1').val();
        var categoria = jQuery('#categoria1').val();
        var modello = jQuery('#modello1').val();
        var guasto = jQuery('#guasto1').val();
        var pezzo = jQuery('#pezzo1').val();
        var anticipo = jQuery('#anticipo1').val();
        var prezzo = jQuery('#prezzo1').val();
        var commenti = jQuery('#commenti1').val();
        var codice = jQuery('#codice').val();
        var status = jQuery('#status_edit').val();
        var engineer_code = jQuery('#engineer_code').val();
        var sig_image = jQuery('#sig_img_name').val();
        var custom = {};

        $(".modal-content .custom").each(function() {
            custom[$(this).attr( "id").substring(2)] = this.value;
        });

        if (jQuery('#sms').prop('checked')) {
            var sms = 1;
        } else {
            var sms = 0;
        }
        if (jQuery('#send_email').prop('checked')) {
            var send_email = 1;
        } else {
            var send_email = 0;
        }
        clearTips(jQuery('.tips'));
        //validate
        var tipo = jQuery(this).data('tipo');
        if (tipo == 1) {
            var valid = validLongName(jQuery('#categoria1'), "<?=lang('Categoria_t'); ?>", jQuery('.tips')) && validLongName(jQuery('#modello1'), "<?=lang('Modello_t'); ?>", jQuery('.tips')) && validLongName(jQuery('#pezzo1'), "<?=lang('Pezzo_t'); ?>", jQuery('.tips')) && validNumeric(jQuery('#prezzo1'), jQuery('.tips'), "<?=lang('Prezzo_t'); ?>");
        } else {
            var valid = validLongName(jQuery('#categoria1'), "<?= lang('Categoria_t'); ?>", jQuery('.tips')) && validLongName(jQuery('#modello1'), "<?= lang('Modello_t'); ?>", jQuery('.tips')) && validNumeric(jQuery('#anticipo1'), jQuery('.tips'), "<?= lang('js_err_anticipo'); ?>") && validNumeric(jQuery('#prezzo1'), jQuery('.tips'), "<?= lang('js_err_prezzo'); ?>");
        }

        if (valid) {
            var url = "";
            var dataString = "";

            if (modo == "apri") {
                url = base_url + "home/apri_ordine";
                dataString = "nominativo=" + encodeURIComponent(nominativo) + "&categoria=" + encodeURIComponent(categoria) + "&modello=" + encodeURIComponent(modello) + "&guasto=" + encodeURIComponent(guasto) + "&pezzo=" + encodeURIComponent(pezzo) + "&anticipo=" + encodeURIComponent(anticipo) + "&prezzo=" + encodeURIComponent(prezzo) + "&tipo=" + encodeURIComponent(tipo) + "&sms=" + encodeURIComponent(sms) + "&send_email=" + encodeURIComponent(send_email) + "&commenti=" + encodeURIComponent(commenti) + "&codice=" + encodeURIComponent(codice) + "&status=" + encodeURIComponent(status) + "&custom=" + encodeURIComponent(JSON.stringify(custom)) + "&sig_image=" + encodeURIComponent(sig_image) + "&engineer_code=" + encodeURIComponent(engineer_code) + "&token=<?=$_SESSION['token'];?>";
                jQuery.ajax({
                    type: "POST",
                    url: url,
                    data: dataString,
                    cache: false,
                    success: function(data) {
                        if (tipo == 1)
                            toastr['success']("<?= lang('js_salva_in_corso'); ?>", "<?= lang('js_nuovo_ordine_a'); ?>")
                            else
                                toastr['success']("<?= lang('js_salva_in_corso'); ?>", "<?= lang('js_nuova_riparazione_a'); ?>")

                                find(data);
                        $('#obj').modal('hide');
                        $('#visualizza_ordini').modal('show');
                        $('#dynamic-table').DataTable().ajax.reload();
                    }
                });
            } else {
                url = base_url + "home/modifica_ordine";
                dataString = "nominativo=" + encodeURIComponent(nominativo) + "&categoria=" + encodeURIComponent(categoria) + "&modello=" + encodeURIComponent(modello) + "&guasto=" + encodeURIComponent(guasto) + "&pezzo=" + encodeURIComponent(pezzo) + "&anticipo=" + encodeURIComponent(anticipo) + "&prezzo=" + encodeURIComponent(prezzo) + "&tipo=" + encodeURIComponent(tipo) + "&id=" + encodeURIComponent(id) + "&sms=" + encodeURIComponent(sms) + "&send_email=" + encodeURIComponent(send_email) + "&commenti=" + encodeURIComponent(commenti) + "&codice=" + encodeURIComponent(codice) + "&status=" + encodeURIComponent(status) + "&custom=" + encodeURIComponent(JSON.stringify(custom)) + "&sig_image=" + encodeURIComponent(sig_image) + "&engineer_code=" + encodeURIComponent(engineer_code) + "&token=<?=$_SESSION['token'];?>";
                jQuery.ajax({
                    type: "POST",
                    url: url,
                    data: dataString,
                    cache: false,
                    success: function(data) {
                        if (tipo == 1) {
                            toastr['success']("<?= lang('js_salva_in_corso'); ?>", "<?= lang('js_agg_ordine_a'); ?>");

                        } else {
                            toastr['success']("<?= lang('js_salva_in_corso'); ?>", "<?= lang('js_agg_riparazione_a'); ?>");
                        }
                        $('#obj').modal('hide');
                        find(id);
                        $('#visualizza_ordini').modal('show');
                        $('#dynamic-table').DataTable().ajax.reload();
                    }
                });
            }
        }
        return false;
    });

    jQuery(document).on("click", "#btn_send_comment", function() {
        if(jQuery('#text_comment').val() == ''){   
            alert('Please enter comment before save');
            return false;
        }
        var num = jQuery('#comment_id_num').val();
        jQuery.ajax({
            type: "POST",
            url: base_url + "home/add_comment",
            data: "id=" + num + "&type=my" + "&comment=" + jQuery('#text_comment').val(),
            cache: false,
            dataType: "json",
            success: function(data) {
                var commentHtml = '<div style="width:70%; border: 1px solid #000; border-radius: 10px; float: right; margin: 10px; padding: 5px;"><b>My Comment</b><br/>'+jQuery('#text_comment').val()+'</div>';
                jQuery('#conmments_section').append(commentHtml);
                jQuery('#text_comment').val('');
            }
        });
    });
    
    jQuery('.no_cliente').click(function(e) {
        toastr['error']('<?= lang('js_no_cliente'); ?>', '');

    });

    if (getUrlVars()["id"]) {
        find(getUrlVars()["id"]);
        $('#visualizza_ordini').modal('show');
    }


    function find(num) {
        jQuery.ajax({
            type: "POST",
            url: base_url + "home/prendi_oggetto",
            data: "id=" + num,
            cache: false,
            dataType: "json",
            success: function(data) {
                if (typeof data.Nominativo === 'undefined') {
                    alert('Codice inesistente');
                } else {

                    if (data.Tipo == 1)
                        var t = "<?= lang('js_tipo_ordine_pezzo'); ?>"
                        else
                            var t = "<?= lang('js_tipo_riparazione'); ?>"

                            jQuery('#titoloOE').html(t + " " + data.Modello + " <span>");
                    jQuery('#clientec').html("<a data-dismiss='modal' class='visualizza' href='#visualizza_clienti' data-toggle='modal' data-num='"+data.ID_Nominativo+"'>"+data.Nominativo+"</a>");
                    jQuery('#codicec').html(data.ID);
                    jQuery('#telefonoc').html(data.Telefono);
                    jQuery('#dataAperturac').html(data.dataApertura);
                    jQuery('#guastoc').html(data.Guasto);
                    jQuery('#categoriac').html(data.Categoria);
                    jQuery('#modelloc').html(data.Modello);
                    jQuery('#commentic').html(data.Commenti);
                    jQuery('#cod_rip').html(data.codice);
                    jQuery('#btn_send_comment').data('num', num);
                    jQuery('.show_custom').html('');

                    var IS_JSON = true;
                    try
                    {
                        var json = $.parseJSON(data.custom_field);
                    }
                    catch(err)
                    {
                        IS_JSON = false;
                    }                

                    if(IS_JSON) 
                    {

                        $.each(json, function(id_field, val_field) {
                            jQuery('#v'+id_field).html(val_field);
                        });
                    }
                    
                    var commentHtml = '';
                    var engineer_comments = $.parseJSON(data.engineer_comments);
                    
                    for(i = 0; i < engineer_comments.length; i++){
                        var obj = engineer_comments[i];
                        commentHtml += '<div style="width:70%; border: 1px solid #000; border-radius: 10px; float: '+((obj.type == 'eng')?'left':'right')+'; margin: 10px; padding: 5px;"><b>'+((obj.type == 'eng')?'Engineer Comment':'Store Comment')+'</b><br/>'+obj.comment+'</div>';
                    }
                    jQuery('#conmments_section').html(commentHtml);
                    jQuery('#comment_id_num').val(num);
                    
                    if(data.engineer_status == 1){
                        $('#div_engineer_status').html('Engineer Status: <span class="label label-mini" style="background: #78CD51; width: auto;">Completed</span>');
                    }else{
                        $('#div_engineer_status').html('Engineer Status: <span class="label label-mini" style="background: #41cac0; width: auto;">Im progress</span>');
                    }
                    
                    if (data.Tipo == 1)
                        jQuery('#pezzoc').html(data.Pezzo);
                    else
                        jQuery('#pezzoc').html("No");
                    jQuery('#anticipoc').html(<?=$this->Impostazioni_model->get_money('data.Anticipo', false, true);?>);
                    jQuery('#prezzoc').html(<?=$this->Impostazioni_model->get_money('data.Prezzo', false, true);?>);
                    var string = "<div class=\"right col-sm-12 col-lg-6 btn-group\"><button type=\"button\" data-num=\"" + data.ID + "\" id=\"salva_xml\" class=\"btn btn-default\"><i class=\"fa fa-download\"></i> <?= lang('salva_xml'); ?></button><button type=\"button\" data-tipo=\"2\" data-num=\"" + data.ID + "\" id=\"stampa\" class=\"btn btn-default\"><i class=\"fa fa-print\"></i> <?= lang('resoconto'); ?></button><button type=\"button\" data-tipo=\"1\" data-num=\"" + data.ID + "\" id=\"stampa\" class=\"btn btn-default\"><i class=\"fa fa-print\"></i> <?= lang('invoice'); ?></button><button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> <?= lang('js_torna_indietro'); ?></button></div><div class=\"col-sm-12 col-lg-6  btn-group left\"><button data-dismiss=\"modal\" id=\"elimina\" data-num=\"" + data.ID + "\" data-tipo=\"" + data.Tipo + "\" class=\"btn btn-danger\" type=\"button\"><i class=\"fa fa-trash-o \"></i> <?= lang('js_elimina'); ?></button>";

                    if ((data.Tipo == 1) && (data.status) == 1)
                        string = string + "<button id=\"inriparazione\" data-num=\"" + data.ID + "\" class=\"btn btn-info\" type=\"button\"><i class=\"fa fa-wrench \"></i> <?= lang('js_converti_inr'); ?></button>";
                    if (data.status == 1) {
                        string = string + "<button id=\"modifica\" data-dismiss=\"modal\" href=\"#obj\" data-toggle=\"modal\" data-num=\"" + data.ID + "\" class=\"btn btn-success\"><i class=\"fa fa-pencil\"></i> <?= lang('modifica'); ?></button><button type=\"button\" id=\"daconsegnare\" class=\"btn btn-primary\" data-num=\"" + data.ID + "\" data-tipo=\"" + data.Tipo + "\"><i class=\"fa fa-check\"></i> <?= lang('daconsegnare'); ?></button>";
                    }
                    if (data.status == 2) {
                        string = string + "<button id=\"modifica\" data-dismiss=\"modal\" href=\"#obj\" data-toggle=\"modal\" data-num=\"" + data.ID + "\" class=\"btn btn-success\"><i class=\"fa fa-pencil\"></i> <?= lang('modifica'); ?></button><button type=\"button\" id=\"completa\" class=\"btn btn-primary\" data-num=\"" + data.ID + "\" data-tipo=\"" + data.Tipo + "\"><i class=\"fa fa-check\"></i> <?= lang('completato'); ?></button>";
                    }

                    if (data.status == 3) {
                        string = string + "<button id=\"modifica\" data-dismiss=\"modal\" href=\"#obj\" data-toggle=\"modal\" data-num=\"" + data.ID + "\" class=\"btn btn-success\"><i class=\"fa fa-pencil\"></i> <?= lang('modifica'); ?></button><button type=\"button\" id=\"approva\" class=\"btn btn-primary\" data-num=\"" + data.ID + "\" data-tipo=\"" + data.Tipo + "\"><i class=\"fa fa-check\"></i> <?= lang('approva'); ?></button>";
                    }

                    string = string + "</div>";
                    if (data.status == 1) {
                        jQuery('#statoc').html('<?= lang('incorso'); ?>');
                        jQuery('#statoc').css('color','<?= $impostazioni[0]['colore1']; ?>');
                    } else if (data.status == 0) {
                        jQuery('#statoc').html('<?= lang('completato'); ?>');
                        jQuery('#statoc').css('color', '<?= $impostazioni[0]['colore4']; ?>');
                    } else if (data.status == 3) {
                        jQuery('#statoc').html('<?= lang('inattesa'); ?>');
                        jQuery('#statoc').css('color', '<?= $impostazioni[0]['colore3']; ?>');
                    }
                    else if (data.status == 2) {
                        jQuery('#statoc').html('<?= lang('daconsegnare'); ?>');
                        jQuery('#statoc').css('color', '<?= $impostazioni[0]['colore2']; ?>');
                    }
                    else {
                        jQuery('#statoc').html('<?= lang('nonriparato'); ?>');
                        jQuery('#statoc').css('color', '<?= $impostazioni[0]['colore5']; ?>');
                    }

                    jQuery('#footerOR').html(string);
                }
            }
        });
    }

    jQuery(document).on("click", "a.visualizza_or", function() {
        var numero = jQuery(this).data("num");
        find(numero);

    });

    jQuery(document).on("click", "#sendsmsfast", function() {
        var txt = jQuery('#fastsms').val();
        var numero = jQuery('#telefonoc').html();
        jQuery.ajax({
            type: "POST",
            url: base_url + "home/send_sms",
            data: "testo=" + txt + "&numero=" + numero + "&token=<?=$_SESSION['token'];?>",
            cache: false,
            dataType: "json",
            success: function(data) {

                if(data.stato == true) toastr['success']("<?= lang('Fastsms_t'); ?>", '<?= lang('Fastsms_inviato'); ?>');
                else toastr['error']("<?= lang('Fastsms_t'); ?>", '<?= lang('Fastsms_noninviato'); ?>');
            }
        });
    });

    jQuery(document).on("click", "#modifica", function() {
        jQuery('#tit').html('<?= lang('modifica'); ?>');
        clearTips(jQuery('.tips'));
        var num = jQuery(this).data("num");

        jQuery.ajax({
            type: "POST",
            url: base_url + "home/prendi_oggetto",
            data: "id=" + encodeURIComponent(num),
            cache: false,
            dataType: "json",
            success: function(data) {
                jQuery('#nominativo1 option[value="'+data.ID_Nominativo+'"]').attr("selected", "selected");
                jQuery("#nominativo1").select2();
                jQuery('.inp_cat').hide();
                jQuery('.select_cat').show();
                if ( jQuery('#categoria_s option[value="'+data.Categoria+'"]').length ) {

                    jQuery('#categoria_s option[value="'+data.Categoria+'"]').attr("selected", "selected")

                }
                else
                {
                    jQuery("#categoria_s").prepend("<option selected=\"selected\" value=\"" + data.Categoria + "\">" + data.Categoria + "</option>");
                }

                jQuery("#categoria_s").select2();
                jQuery('#categoria1').val(jQuery("#categoria_s").val());
                jQuery('#modello1').val(data.Modello);
                jQuery('#guasto1').val(data.Guasto);
                if (data.Tipo == 1) {
                    jQuery('#pezzo1').val(data.Pezzo);
                } else {
                    jQuery('#pezzo1').val('');
                }

                jQuery('#anticipo1').val(data.Anticipo);
                jQuery('#prezzo1').val(data.Prezzo);
                jQuery('#commenti1').val(data.Commenti);

                $(".modal-content .custom").val('');

                var IS_JSON = true;
                try
                {
                    var json = $.parseJSON(data.custom_field);
                }
                catch(err)
                {
                    IS_JSON = false;
                }                

                if(IS_JSON) 
                {

                    $.each(json, function(id_field, val_field) {
                        jQuery('#mo'+id_field).val(val_field);
                    });
                }
                
                if(data.signature_image == '' || data.signature_image == 'null'){
                    jQuery('#sig_img_name').val(data.signature_image);
                    jQuery('#signature_image').hide();
                    jQuery('#signature-pad').show();
                }else{
                    jQuery('#signature_image').attr('src', '/uploads/'+data.signature_image);
                    jQuery('#sig_img_name').val(data.signature_image);
                    jQuery('#signature_image').show();
                    jQuery('#signature-pad').hide();
                }
                if (data.sms == 1)
                    jQuery('#sms').prop('checked', true);
                else
                    jQuery('#sms').prop('checked', false);
                
                if (data.send_email == 1)
                    jQuery('#send_email').prop('checked', true);
                else
                    jQuery('#send_email').prop('checked', false);

                jQuery('#footerOR1').html("<div class=\"btn-group btn-group-justified left\"><select id=\"status_edit\" class=\"form-control m-bot15\"><option value=\"1\"><?= lang('incorso'); ?></option><option value=\"3\"><?= lang('inattesa'); ?></option><option value=\"2\"><?= lang('daconsegnare'); ?></option><option value=\"0\"><?= lang('completato'); ?></option><option value=\"5\"><?= lang('nonriparato'); ?></option></select> <div class=\"iconic-input nolabel\"><i class=\"fa fa-eye\"></i><input id=\"codice\" type=\"text\" class=\"validate form-control\" value=\"" + data.codice + "\" placeholder=\"<?= lang('codice'); ?>\"><label style=\"float:left;\">Engineer code</label><input id=\"engineer_code\" type=\"text\" class=\"validate form-control\" value=\"" +  data. engineer_code + "\" placeholder=\"Secret code (For Engineer check)\"></div></div><div class=\"btn-group btn-group-justified right\"><button data-dismiss=\"modal\" class=\"btn btn-default\" type=\"button\"><i class=\"fa fa-reply\"></i> <?= lang('js_torna_indietro'); ?></button> <button id='submitOR' class='btn btn-success' data-tipo=" + data.Tipo + " data-modo='modifica' data-num=" + data.ID + "><i class=\"fa fa-save\"></i> <?= lang('js_save'); ?></button></div>")
                jQuery('#status_edit option[value="'+data.status+'"]').attr("selected", "selected");
            }
        });
    });

    jQuery(document).on("click", "#inriparazione", function() {
        var num = jQuery(this).data("num");
        jQuery.ajax({
            type: "POST",
            url: base_url + "home/inriparazione",
            data: "id=" + encodeURIComponent(num) + "&token=<?=$_SESSION['token'];?>",
            cache: false,
            dataType: "json",
            success: function(data) {
                toastr['success']("<?= lang('js_ordine'); ?>", "<?= lang('js_convertito'); ?>");
                find(num);
                $('#dynamic-table').DataTable().ajax.reload();
            }
        });
    });

    jQuery(document).on("click", "#approva", function() {
        var num = jQuery(this).data("num");
        var tipo = jQuery(this).data("tipo");
        jQuery.ajax({
            type: "POST",
            url: base_url + "home/approva",
            data: "id=" + encodeURIComponent(num) + "&token=<?=$_SESSION['token'];?>",
            cache: false,
            dataType: "json",
            success: function(data) {
                if (tipo == 1) {
                    toastr['success']("<?= lang('js_ordine'); ?>", "<?= lang('js_or_approvato_c'); ?>");
                } else {
                    toastr['success']("<?= lang('js_riparazione'); ?>", "<?= lang('js_ri_approvata_c'); ?>");
                }
                $('#dynamic-table').DataTable().ajax.reload();
                find(num);
            }
        });
    });


    jQuery(document).on("click", "#completa", function() {
        var num = jQuery(this).data("num");
        var tipo = jQuery(this).data("tipo");
        jQuery.ajax({
            type: "POST",
            url: base_url + "home/completa",
            data: "id=" + encodeURIComponent(num) + "&token=<?=$_SESSION['token'];?>",
            cache: false,
            dataType: "json",
            success: function(data) {
                if (tipo == 1) {
                    toastr['success']("<?= lang('js_ordine'); ?>", "<?= lang('js_or_completato_c'); ?>");
                } else {
                    toastr['success']("<?= lang('js_riparazione'); ?>", "<?= lang('js_ri_completata_c'); ?>");
                }
                $('#dynamic-table').DataTable().ajax.reload();
                find(num);
            }
        });
    });

    jQuery(document).on("click", "#daconsegnare", function() {
        var num = jQuery(this).data("num");
        var tipo = jQuery(this).data("tipo");
        jQuery.ajax({
            type: "POST",
            url: base_url + "home/daconsegnare",
            data: "id=" + encodeURIComponent(num) + "&token=<?=$_SESSION['token'];?>",
            cache: false,
            dataType: "json",
            success: function(data) {
                if (tipo == 1) {
                    toastr['success']("<?= lang('js_ordine'); ?>", "<?= lang('js_ordine_segnato_consegnare'); ?>");
                } else {
                    toastr['success']("<?= lang('js_riparazione'); ?>", "<?= lang('js_riparazione_segnata_consegnare'); ?>");
                }
                $('#dynamic-table').DataTable().ajax.reload();
                find(num);

            }
        });
    });



    jQuery(document).on("click", "#stampa", function() {
        var num = jQuery(this).data("num");
        var tipo = jQuery(this).data("tipo");
        toastr['success']("<?= lang('js_stampa_in_corso'); ?>");
        var thePopup = window.open( base_url + "home/invoice/" + encodeURIComponent(num) + "/" + tipo, '_blank', "width=890, height=700");
    });


    jQuery(document).on("click", "#elimina", function() {
        var num = jQuery(this).data("num");
        var tipo = jQuery(this).data("tipo");
        jQuery.ajax({
            type: "POST",
            url: base_url + "home/elimina",
            data: "id=" + encodeURIComponent(num) + "&token=<?=$_SESSION['token'];?>",
            cache: false,
            dataType: "json",
            success: function(data) {
                if (tipo == 1) {
                    toastr['success']("<?= lang('js_ordine'); ?>", "<?= lang('js_ordine_eliminato'); ?>");

                } else {
                    toastr['success']("<?= lang('js_riparazione'); ?>", "<?= lang('js_riparazione_eliminata'); ?>");
                }
                $('#dynamic-table').DataTable().ajax.reload();
            }
        });
    });
    
    jQuery(document).on("click", "#salva_xml", function() {
        var num = jQuery(this).data("num");
        jQuery.ajax({
            type: "POST",
            url: base_url + "home/salva_xml",
            data: "id=" + num,
            cache: false,
            success: function(data) {
                toastr['success']("", "<?= lang('xml_salvato'); ?>");
                window.location.href = data;
            }
        });
    });

    jQuery("#categoria_s").on("select2:select", function (e) {
        var selezionata = jQuery("#categoria_s").val();
        if(selezionata === 'other') {
            jQuery('.select_cat').hide();
            jQuery('.inp_cat').show();
            jQuery('#categoria1').val('');
        }
        else
        {
            jQuery('#categoria1').val(selezionata);
        }
    });

    jQuery("#scrolldash").hover(
        function() {
            var div = document.getElementById('scrolldash'); // need real DOM Node, not jQuery wrapper
            var cursor = div.scrollWidth>div.clientWidth;
            if(cursor == true) {
                $("#scrolldash").addClass("dragged");
            }
            else
            {
                $("#scrolldash").removeClass("dragged");
            }
        }
    );


});

function randomString(len, charSet) {
    charSet = charSet || 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var randomString = '';
    for (var i = 0; i < len; i++) {
        var randomPoz = Math.floor(Math.random() * charSet.length);
        randomString += charSet.substring(randomPoz,randomPoz+1);
    }
    return randomString;
}


function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
    return vars;
}