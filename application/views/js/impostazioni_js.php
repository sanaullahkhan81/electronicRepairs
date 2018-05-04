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

var s_user_id = jQuery('#s_user_id').val(); 
var nome = jQuery('#nomesito').val();
var lingua = jQuery('#lingua').val();
var disclaimer = jQuery('#disclaimer').val();
var usesms = jQuery("input:radio[name='usesms']:checked").val();
var s_user = jQuery('#s_user').val();
var s_pass = jQuery('#s_password').val();
var s_name = jQuery('#s_sender').val();
var s_method = jQuery('#s_method').val();
var t_mode = jQuery('#t_mode').val();
var t_account_sid = jQuery('#t_account_sid').val();
var t_token = jQuery('#t_token').val();
var t_number = jQuery('#t_number').val();
var prefix = jQuery('#prefix').val();
var r_apertura = jQuery('#r_apertura').val();
var r_chiusura = jQuery('#r_chiusura').val();
var email_sender = jQuery('#email_sender').val();
var email_subject = jQuery('#email_subject').val();
var email_smtp_host = jQuery('#email_smtp_host').val();
var email_smtp_user = jQuery('#email_smtp_user').val();
var email_smtp_pass = jQuery('#email_smtp_pass').val();
var email_smtp_port = jQuery('#email_smtp_port').val();
var email_smtp_open_text = jQuery('#email_smtp_open_text').val();
var email_smtp_closed_text = jQuery('#email_smtp_closed_text').val();
var a_us = jQuery('#admin_us').val();
var a_pass = jQuery('#admin_pass').val();
var valuta = jQuery('#valuta').val();
var currency_symbol = jQuery('#currency_symbol').val();
var currency_text = jQuery('#currency_text').val();
var currency_position = jQuery('#currency_position').val();
var timezone = jQuery('#timezone').val();
var categorie = jQuery('#categorie').val();
var campi = jQuery('#campi_personalizzati').val();
var name = jQuery('#invoice_name').val();
var mail = jQuery('#invoice_mail').val();
var address = jQuery('#invoice_address').val();
var phone = jQuery('#invoice_phone').val();
var vat = jQuery('#invoice_vat').val();
var type = jQuery('#invoice_type').val();
var tax = jQuery('#invoice_tax').val();
var colore1 = jQuery('#colore1').val();
var colore2 = jQuery('#colore2').val();
var colore3 = jQuery('#colore3').val();
var colore4 = jQuery('#colore4').val();
var colore5 = jQuery('#colore5').val();
var colore_prim = jQuery('#colore_prim').val();

if (jQuery('#showcredit').is(':checked')) { var showcredit = 1; }
else { var showcredit = 0; }

if (jQuery('#transition_background').is(':checked')) { var transition_background = 1; }
else { var transition_background = 0; }

if (jQuery('#rtl_support').is(':checked')) { var rtl_support = 1; }
else { var rtl_support = 0; }

if (jQuery('#email_use_smtp').is(':checked')) { var email_use_smtp = 1; }
else { var email_use_smtp = 0; }

if (jQuery('#stampadue').is(':checked')) { var stampadue = 1; }
else { var stampadue = 0; }

if (jQuery('#printinonepage').is(':checked')) { var printinonepage = 1; }
else { var printinonepage = 0; }

var url = "";
var dataString = "";
url = "<?= site_url('impostazioni/salva_impostazioni');?>";
dataString = "titolo=" + encodeURIComponent(nome) + "&lingua=" +encodeURIComponent(lingua) + "&auser=" + encodeURIComponent(a_us) + "&apass=" +encodeURIComponent(a_pass) + "&disclaimer=" + encodeURIComponent(disclaimer) + "&usesms=" + encodeURIComponent(usesms) + "&s_user=" + encodeURIComponent(s_user) + "&s_pass=" + encodeURIComponent(s_pass) + "&s_name=" + encodeURIComponent(s_name) + "&s_method=" + encodeURIComponent(s_method) + "&t_mode=" + encodeURIComponent(t_mode) + "&t_account_sid=" + encodeURIComponent(t_account_sid) + "&t_token=" + encodeURIComponent(t_token) + "&t_number=" + encodeURIComponent(t_number) + "&prefix=" + encodeURIComponent(prefix) + "&r_apertura=" + encodeURIComponent(r_apertura) + "&r_chiusura=" + encodeURIComponent(r_chiusura) + "&showcredit=" + encodeURIComponent(showcredit) + "&rtl_support=" + encodeURIComponent(rtl_support) + "&transition_background=" + encodeURIComponent(transition_background) + "&valuta=" + encodeURIComponent(valuta) + "&name=" + encodeURIComponent(name) + "&mail=" + encodeURIComponent(mail) + "&address=" + encodeURIComponent(address) + "&phone=" + encodeURIComponent(phone) + "&vat=" + encodeURIComponent(vat) + "&type=" + encodeURIComponent(type) + "&tax=" + encodeURIComponent(tax) + "&colore1=" + encodeURIComponent(colore1) + "&colore2=" + encodeURIComponent(colore2) + "&colore3=" + encodeURIComponent(colore3) + "&colore4=" + encodeURIComponent(colore4) + "&colore5=" + encodeURIComponent(colore5) + "&colore_prim=" + encodeURIComponent(colore_prim) + "&cat=" + encodeURIComponent(categorie) + "&campi=" + encodeURIComponent(campi) + "&stampadue=" + encodeURIComponent(stampadue) + "&printinonepage=" + encodeURIComponent(printinonepage) + "&currency_symbol=" + currency_symbol + "&currency_text=" + encodeURIComponent(currency_text) + "&currency_position=" + encodeURIComponent(currency_position) + "&timezone=" + encodeURIComponent(timezone) + "&email_sender=" + encodeURIComponent(email_sender) + "&email_subject=" + encodeURIComponent(email_subject) + "&email_use_smtp=" + encodeURIComponent(email_use_smtp) + "&email_smtp_host=" + encodeURIComponent(email_smtp_host) + "&email_smtp_user=" + encodeURIComponent(email_smtp_user) + "&email_smtp_pass=" + encodeURIComponent(email_smtp_pass) + "&email_smtp_port=" + encodeURIComponent(email_smtp_port) + "&email_smtp_open_text=" + encodeURIComponent(email_smtp_open_text) + "&email_smtp_closed_text=" + encodeURIComponent(email_smtp_closed_text) + "&s_user_id=" + encodeURIComponent(s_user_id) + "&token=<?=$_SESSION['token'];?>";
jQuery.ajax({
type: "POST",
url: url,
data: dataString,
cache: false,
success: function (data) {

toastr['success']("<?= $this->lang->line('js_agg_in_corso');?>", "<?= $this->lang->line('js_agg_impostazioni');?>");
$("#black").fadeIn(100);
location.reload();
}
});
return false;
});

jQuery(document).on("click", "#skebby", function () {

jQuery(".skebby-info").fadeTo( 120 , 1);
jQuery(".twilio-info").fadeTo( 120 , 0.3);

});

jQuery(document).on("click", "#twilio", function () {

jQuery(".twilio-info").fadeTo( 120 , 1);
jQuery(".skebby-info").fadeTo( 120 , 0.3);

});


$("#t_mode").select2({placeholder: "<?=$this->lang->line('twilio_mode');?>"});

$(".nav-tabs a").click(function() {
$(this).tab('show');
});

$('.colori').colorpicker();
$('.colore_prim').colorpicker();

$('.colori').colorpicker().on('changeColor.colorpicker', function(event){
$(this).parent().find('span.label').css( "background-color", event.color.toHex() );
});

$( "#valuta" ).change(function() {
if($( "#valuta" ).val() == 'CUSTOM') $( ".form-group.personalizzata" ).fadeIn();
else  $( ".form-group.personalizzata" ).fadeOut();
});

$('.colore_prim').colorpicker().on('changeColor.colorpicker', function(event){

$.ajax({ 
type: "POST",   
url: "<?= site_url('impostazioni/stile/'); ?>",   
async: false,
data: "colore=" + event.color.toHex(),
cache: false,
success : function(data)
{
$( "#colori" ).remove();
$("head").append("<style id=\"colori\">" + data + "</style>");
}
});

});

$('#prefix option[value="<?= $impostazioni[0]['prefix_number']; ?>"]').attr("selected",true);
$("#prefix").select2();

if(window.location.hash) {
$('.nav-tabs a[href="'+window.location.hash+'"]').tab('show') // Select tab by name
}

$('#stampadue').change(function() {
if($('#stampadue').is(':checked')) {
$('.printinonepage').fadeIn();
} else {
$('.printinonepage').fadeOut();
}
});

$('#email_use_smtp').change(function() {
if($('#email_use_smtp').is(':checked')) {
$('.smtp_info').fadeIn();
} else {
$('.smtp_info').fadeOut();
}
});

$("#logo_upload").change(function() {
$("#error_message").empty(); // To remove the previous error message
var file = this.files[0];
var imagefile = file.type;
var match= ["image/jpeg","image/png","image/jpg"];
if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2])))
{
$('#preview_logo').attr('src','<?=site_url('img').'/'.$impostazioni[0]['logo'];?>');
toastr['error']("<?= $this->lang->line('img_not_correct');?>", "<?= $this->lang->line('img_error');?>");
return false;
}
else
{
toastr['info']("<?= $this->lang->line('logo_agg_in_corso');?>", "");
var reader = new FileReader();
reader.onload = imageIsLoaded;
reader.readAsDataURL(this.files[0]);
$( "#uploadimage .submit" ).trigger( "click" );
}
});


$('#uploadimage').submit(function(event){
event.preventDefault();
var formData = new FormData($(this)[0]);            

var request = $.ajax({
type: 'POST',
url: '<?= site_url("impostazioni/upload_image");?>',
data: formData,
contentType: false,
processData: false,
success: function(data){   
if(data != 'true')
{
toastr['success']("<?= $this->lang->line('logo_aggiornato');?>", "");
$("#sidebar li.nav_title img").attr("src","<?= site_url('img'); ?>/logo_nav.png?" + Math.random());
}
else
{
toastr['error']("<?= $this->lang->line('logo_nonaggiornato');?>", "");
}
}
});             
});

function imageIsLoaded(e) {
$('#preview_logo').attr('src', e.target.result);
};

$.fn.realVal = function(){
var $obj = $(this);
var val = $obj.val();
var type = $obj.attr('type');
if (type && type==='checkbox') {
var un_val = $obj.attr('data-unchecked');
if (typeof un_val==='undefined') un_val = '';
return $obj.prop('checked') ? val : un_val;
} else {
return val;
}
};

var addRule = function(sheet, selector, styles) {
if (sheet.insertRule) return sheet.insertRule(selector + " {" + styles + "}", sheet.cssRules.length);
if (sheet.addRule) return sheet.addRule(selector, styles);
};
});
