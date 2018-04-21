jQuery(document).ready(function() {
    jQuery('#store_dropdown').change(function(e) {
        jQuery.ajax({
            type: "POST",
            url: base_url + "home/set_store",
            data: {store_id:jQuery(this).val()},
            cache: false,
            dataType: "json",
            success: function(data) {
                location.reload();
            }
        });
    });
    
    jQuery(document).ajaxStart(function(){
        jQuery('#ajax_loader').show();
        var topPosition = jQuery(document).scrollTop();
        jQuery('#ajax_loader').css({top:topPosition+'px'});
    });

    jQuery(document).ajaxStop(function(){
        jQuery('#ajax_loader').hide();
    });
});