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
        
        jQuery(document).on("click", "#btn_send_comment", function() {
            if(jQuery('#text_comment').val() == ''){   
                alert('Please enter comment before save');
                return false;
            }
            var num = jQuery('#comment_id_num').val();
            jQuery.ajax({
                type: "POST",
                url: base_url + "status/add_comment",
                data: "id=" + num + "&type=eng" + "&comment=" + jQuery('#text_comment').val() + "&eng_code=" + jQuery('#comment_code_eng').val(),
                cache: false,
                dataType: "json",
                success: function(data) {
                    var commentHtml = '<div style="width:70%; border: 1px solid #000; border-radius: 10px; float: left; margin: 10px; padding: 5px;"><b>Store Comment</b><br/>'+jQuery('#text_comment').val()+'</div>';
                    jQuery('#conmments_section').append(commentHtml);
                    jQuery('#text_comment').val('');
                }
            });
        });

        jQuery(document).on("click", "#engineer_mark_completed", function() {
            var num = jQuery('#comment_id_num').val();
            jQuery.ajax({
                type: "POST",
                url: base_url + "status/mark_completed",
                data: "id=" + num + "&status=1" + "&eng_code=" + jQuery('#comment_code_eng').val(),
                cache: false,
                dataType: "json",
                success: function(data) {
                    $('#div_engineer_status').html('');
                }
            });
        });
        
        
	jQuery(document).on("click", "#submit", function () {

		var codice = jQuery('#codice_riparazione').val();
                var codeType = jQuery('#code_login_type').val();
		var url = "";
		var dataString = "";
		url = base_url + "status/ottieni_stato";
		dataString = "codice=" + codice + "&code_type=" + codeType;
		jQuery.ajax({
			type: "POST",
			url: url,
			data: dataString,
			cache: false,
			dataType: "json",
			success: function (data) {

				if(isEmpty(data)) {toastr['error']("<?= $this->lang->line('toast_errore');?>", "<?= $this->lang->line('toast_rip_non_presente');?>");}
				else {
					toastr['success']("Repair found in the database", "You can check the comments about repair and also change status")
                    if(codeType == 'engineer'){
                        if(data.engineer_status == 1) {var stato = "<span style='background-color: #78CD51;'>Completed</span>"; }
                        else { var stato = "<span style='background-color: #41cac0;'>In progress</span>";}
                        if(data.engineer_status != 1){
                            $('#div_engineer_status').html('<a href="javascript:void(0)" id="engineer_mark_completed"><span class="label label-mini" style="background: #78CD51; width: auto;">Click To Mark As Completed</span></a>');
                        }
                    }else{
                        if(data.status == 0) {var stato = "<span style='background-color: #d61a1a;'>Delivered</span>"; }
                        else if(data.status == 1){ var stato = "<span style='background-color: #3dc45b;'>In progress</span>";}
                        else if(data.status == 3){ var stato = "<span style='background-color: #a8a8a8;'>To be approved</span>";}
                        else if(data.status == 2){ var stato = "<span style='background-color: #f27705;'>To be deliver</span>";}
                        else { var stato = "<span style='background-color: #2b2b2b;'>Cancelled</span>";}
                    }
                    
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
                                    if(codeType == 'engineer' && data.engineer_comments != ''){
                                        var commentHtml = '';
                                        var engineer_comments = $.parseJSON(data.engineer_comments);

                                        for(i = 0; i < engineer_comments.length; i++){
                                            var obj = engineer_comments[i];
                                            commentHtml += '<div style="width:70%; border: 1px solid #000; border-radius: 10px; float: '+((obj.type == 'eng')?'left':'right')+'; margin: 10px; padding: 5px;"><b>'+((obj.type == 'eng')?'Engineer Comment':'Store Comment')+'</b><br/>'+obj.comment+'</div>';
                                        }
                                        jQuery('#conmments_section').html(commentHtml);
                                        jQuery('#comment_id_num').val(data.ID);
                                        jQuery('#comment_code_eng').val(data.engineer_code);
                                    }
				}
			}
		});
	});

});

function isEmpty(obj) {
	return Object.keys(obj).length === 0;
}