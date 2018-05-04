<?php require 'header.php'; ?>
	<script type="text/javascript">
		window.base_url = "<?= site_url(); ?>";
	</script>

	<script type="text/javascript" src="<?= site_url('home/js/impostazioni'); ?>"></script>
    <link rel="stylesheet" href="<?= site_url('assets/bootstrap-colorpicker-master/css/bootstrap-colorpicker.min.css'); ?>" type="text/css">

	<!--main content start-->
	<section id="main-content">

		<section class="wrapper site-min-height">
			<!-- page start-->

			<div class="col-lg-12">
				<h2><?= lang('impostazioni');?></h2>

				<ul class="col-lg-12 nav nav-tabs">
					<li class="active"><a href="#generali" class="hvr-bounce-to-top"><?= lang('generali_impostazioni');?></a></li>
					<li><a href="#admin" class="hvr-bounce-to-top"><?= lang('admin_impostazioni');?></a></li>
					<li><a href="#ordini" class="hvr-bounce-to-top"><?= lang('o_e_r_titolo');?></a></li>
					<li><a href="#invoice" class="hvr-bounce-to-top"><?= lang('invoice');?></a></li>
					<li><a href="#sms" class="hvr-bounce-to-top"><?= lang('sms_titolo');?></a></li>
                    <li><a href="#email" class="hvr-bounce-to-top"><?= lang('settings_email_title');?></a></li>
				</ul>

				<div class="tab-content">
					<div id="generali" class="tab-pane fade in active">
						<h3><?= lang('general_title');?></h3>
						<div class="col-lg-12">
							<div class="form-group">
								<label>
									<?= lang('nome_sito');?>
								</label>
								<div class="iconic-input right"><i class="fa fa-quote-left"></i>
									<input id="nomesito" type="text" class="validate form-control" value="<?= $impostazioni[0]['titolo']; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>
									<?= lang('lalingua');?>
								</label>
								<select id="lingua" data-num="1" class="form-control m-bot15" style="width: 100%">
									<?php 
										foreach (glob($this->config->item('upload_path').'application/language/*', GLOB_ONLYDIR) as $dir) {
											$lingua = basename($dir);
											if ($lingua == $impostazioni[0]['lingua']) {
												$option = '<option selected="selected">';
											} else {
												$option = '<option>';
											}
											echo $option.$lingua.'</option>';
										}
									?>
								</select>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>
									<?= lang('valuta');?>
								</label>
								<select id="valuta" data-num="1" class="form-control m-bot15" style="width: 100%">
									<option <?php if($impostazioni[0][ 'valuta'] == 'EURO' ) echo 'selected'; ?>>Euro</option>
									<option <?php if($impostazioni[0][ 'valuta'] == 'GPB' ) echo 'selected'; ?>>GPB</option>
									<option <?php if($impostazioni[0][ 'valuta'] == 'USD' ) echo 'selected'; ?>>USD</option>
									<option <?php if($impostazioni[0][ 'valuta'] == 'NOK' ) echo 'selected'; ?>>NOK</option>
                                    <option value="CUSTOM" <?php if($impostazioni[0][ 'valuta'] == 'CUSTOM' ) echo 'selected'; ?>><b><?= lang('valuta_personalizzata');?></b></option>
								</select>
							</div>
                            <div class="form-group  personalizzata<?=($impostazioni[0][ 'valuta'] == 'CUSTOM' ? ' mostra' : '');?>">
								<label>
									<?= lang('valuta_personalizzata');?>
								</label>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input id="currency_symbol" type="text" class="validate form-control" placeholder="<?= lang('valuta_placeholder_simbolo');?>" value="<?= $impostazioni[0]['currency_symbol']; ?>">
                                    </div>
                                    <div class="col-md-5">
                                        <input id="currency_text" type="text" class="validate form-control" placeholder="<?= lang('valuta_placeholder_testo');?>" value="<?= $impostazioni[0]['currency_text']; ?>">
                                    </div>
                                    <div class="col-md-4">
                                        <select id="currency_position" data-num="1" class="form-control m-bot15" style="width: 100%">
                                            <option value="left" <?php if($impostazioni[0][ 'currency_position'] == 'left' ) echo 'selected'; ?>><?= lang('valuta_pos_left');?></option>
                                            <option value="right" <?php if($impostazioni[0][ 'currency_position'] == 'right' ) echo 'selected'; ?>><?= lang('valuta_pos_right');?></option>
                                        </select>
                                    </div>
                                </div>
							</div>
						</div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>
                                    <?= lang('timezones_title');?>
                                </label>
                                <select id="timezone" data-num="1" class="form-control m-bot15" style="width: 100%">
                                    <?php
                                    
                                    foreach($timezones as $key=>$zone) {
                                        echo '<option value="'.$key.'" '.($impostazioni[0][ 'timezone'] == $key ? 'selected' : '').'>'.$zone.'</option>';
                                    }
                                    
                                    ?>
                                </select>
                            </div>
						</div>
                        <div class="col-lg-6">
							<div class="form-group">
								<label>
									<?= lang('desideri_crediti');?>
								</label>
								<div class="checkbox">
									<label>
										<input type="checkbox" value="" id="showcredit" <?php if ($impostazioni[0][ 'showcredit']) { echo 'checked'; }?>>
										<?= lang('nascondi_crediti');?>
									</label>
								</div>
							</div>
						</div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>
                                    <?= lang('rtl_support_title');?>
                                </label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" id="rtl_support" <?php if ($impostazioni[0][ 'rtl_support']) { echo 'checked'; }?>>
                                        <?= lang('rtl_support_check');?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>
                                    <?= lang('transition_title');?>
                                </label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" id="transition_background" <?php if ($impostazioni[0][ 'background_transition']) { echo 'checked'; }?>>
                                        <?= lang('transition_check');?>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="col-lg-12">
                            <h3> <?= lang('color_title');?></h3>
                        </div></div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>
                                    <?= lang('colorp_title');?>
                                </label>
                                <div class="input-group colore_prim">
                                    <input type="text" value="<?= $impostazioni[0]['colore_prim']; ?>" class="form-control" id="colore_prim" data-inline="true" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <span class='label label-incorso label-mini' style="background: <?= $impostazioni[0]['colore1']; ?>;"><?= lang('incorso'); ?></span>
                                <div class="input-group colori">
                                    <input type="text" value="<?= $impostazioni[0]['colore1']; ?>" class="form-control" id="colore1" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <span class='label label-daconsegnare label-mini' style="background: <?= $impostazioni[0]['colore2']; ?>;"><?= lang('daconsegnare'); ?></span>
                                <div class="input-group colori">
                                    <input type="text" value="<?= $impostazioni[0]['colore2']; ?>" class="form-control" id="colore2" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <span class='label label-inattesa label-mini' style="background: <?= $impostazioni[0]['colore3']; ?>;"><?= lang('inattesa'); ?></span>
                                <div class="input-group colori">
                                    <input type="text" value="<?= $impostazioni[0]['colore3']; ?>" class="form-control" id="colore3"/>
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="form-group">
                                <span class='label label-completato label-mini' style="background: <?= $impostazioni[0]['colore4']; ?>;"><?= lang('completato'); ?></span>
                                <div class="input-group colori">
                                    <input type="text" value="<?= $impostazioni[0]['colore4']; ?>" class="form-control" id="colore4" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <span class='label label-nonriparato label-mini' style="background: <?= $impostazioni[0]['colore5']; ?>;"><?= lang('nonriparato'); ?></span>
                                <div class="input-group colori">
                                    <input type="text" value="<?= $impostazioni[0]['colore5']; ?>" class="form-control" id="colore5" />
                                    <span class="input-group-addon"><i></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h3> <?= lang('logop_title');?></h3>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    <img id="preview_logo" src="<?= ($impostazioni[0]['logo'] == 'default') ? 'http://fixbook.it/img/logo_nav.png' : site_url('img').'/'.$impostazioni[0]['logo']; ?>">
                                </div>
                                <div class="col-lg-12">
                                    <label id="error_message"></label>
                                    <div class="input-group logo_upload">
                                        <span>Upload</span>
                                        <form name="uploadImage" id="uploadimage" action="<?=site_url('impostazioni/upload_image');?>" method="post" enctype="multipart/form-data">	
                                            <input type="file" name="logo_upload" id="logo_upload" required />
                                            <input type="submit" value="Upload" class="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<div id="admin" class="tab-pane fade">
						<h3><?= lang('admin_title');?></h3>
						<div class="col-lg-12">
							<div class="form-group">
								<label>
									<?= lang('user_mail');?>
								</label>
								<div class="iconic-input right"><i class="fa fa-user"></i>
                                    <input id="admin_us" type="text" class="validate form-control" value="<?= $impostazioni[0]['admin_user']; ?>">
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label>
									<?= lang('password');?>
								</label>
								<div class="iconic-input right"><i class="fa fa-terminal"></i>
                                    <input id="admin_pass" type="text" class="validate form-control" value="<?= $impostazioni[0]['admin_password']; ?>">
								</div>
							</div>
						</div>
					</div>
					<div id="ordini" class="tab-pane fade">
                        <h3><?= lang('ordini_t_title');?></h3>
						<div class="col-lg-12">
							<div class="form-group">
								<label>
									<?= lang('ordini_categorie');?>
								</label>
								<select id="categorie" class="form-control m-bot15 select2-hidden-accessible" multiple="" width="100%" tabindex="-1" aria-hidden="true" style="width: 100%">
									<?php
                                    foreach(preg_split("/((\r?\n)|(\r\n?))/", $impostazioni['0']['categorie']) as $line){
                                        echo '<option data-select2-tag="true" selected value="'.$line.'">'.$line.'</option>';
                                    } 
									?>
								</select>
							</div>
						</div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>
                                    <?= lang('campi_addizionali');?>
                                </label>
                                <select id="campi_personalizzati" class="form-control m-bot15 select2-hidden-accessible" multiple="" width="100%" tabindex="-1" aria-hidden="true" style="width: 100%">
                                    <?php
$campi = unserialize( base64_decode($impostazioni['0']['campi_personalizzati']));
foreach($campi as $line){
    echo '<option data-select2-tag="true" selected value="'.$line.'">'.$line.'</option>';
} 
                                    ?>
                                </select>
                            </div>
                        </div>
					</div>
					<div id="invoice" class="tab-pane fade">
						<h3><?= lang('invoice_title');?></h3>
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label>
											<?= lang('invoice_name');?>
										</label>
										<div class="iconic-input right"><i class="fa fa-user"></i>
											<input id="invoice_name" type="text" class="validate form-control" value="<?= $impostazioni[0]['invoice_name']; ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-6">
									<div class="form-group">
										<label>
											<?= lang('invoice_mail');?>
										</label>
										<div class="iconic-input right"><i class="fa fa-quote-left"></i>
											<input id="invoice_mail" type="text" class="validate form-control" value="<?= $impostazioni[0]['invoice_mail']; ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label>
											<?= lang('invoice_indirizzo');?>
										</label>
										<div class="iconic-input right"><i class="fa fa-street-view"></i>
											<input id="invoice_address" type="text" class="validate form-control" value="<?= $impostazioni[0]['indirizzo']; ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label>
											<?= lang('invoice_telefono');?>
										</label>
										<div class="iconic-input right"><i class="fa fa-phone"></i>
											<input id="invoice_phone" type="text" class="validate form-control" value="<?= $impostazioni[0]['telefono']; ?>">
										</div>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label><?= lang('invoice_vat');?></label>
										<div class="iconic-input right"><i class="fa fa-certificate"></i>
											<input id="invoice_vat" type="text" class="validate form-control" value="<?= $impostazioni[0]['vat']; ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>
									<?= lang('il_disclaimer');?>
								</label>
								<textarea class="form-control" id="disclaimer" style="height: 107px" maxlength="370" rows="6"><?= $impostazioni[0]['disclaimer']; ?></textarea>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="row">
								<div class="col-lg-12">
									<div class="form-group">
										<label><?= lang('invoice_type');?></label>
										<select id="invoice_type" data-num="1" class="form-control m-bot15" style="width: 100%">
											<option <?php if($impostazioni[0][ 'invoice_type']=='EU' ) echo 'selected'; ?>>EU</option>
											<!-- <option <?php if($impostazioni[0][ 'invoice_type']=='USA' ) echo 'selected'; ?>>USA</option> -->
										</select>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="form-group">
										<label><?= lang('invoice_tax');?></label>
										<div class="iconic-input right"><i class="fa fa-money"></i>
											<input id="invoice_tax" type="text" class="validate form-control" value="<?= $impostazioni[0]['tax']; ?>">
										</div>
									</div>
								</div>
							</div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>
                                    <?= lang('desideri_due_copie');?>
                                </label>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" id="stampadue" <?php if ($impostazioni[0][ 'stampadue']) { echo 'checked'; }?>>
                                        <?= lang('stampane_due');?>
                                    </label>
                                </div>
                                <div class="checkbox printinonepage<?=($impostazioni[0][ 'stampadue'] ? ' mostra' : '');?>">
                                    <label>
                                        <input type="checkbox" value="" id="printinonepage" <?php if ($impostazioni[0][ 'printinonepage']) { echo 'checked'; }?>>
                                        <?= lang('printinonepage');?>
                                    </label>
                                </div>
                            </div>
                        </div>
					</div>
					<div id="sms" class="tab-pane fade">
						<h3><?= lang('sms_title');?></h3>
							<form action="">
                        <div class="col-lg-6 skebby-info radio-sms" <?php if($impostazioni[0]['usesms'] == 1 ) echo 'style="opacity: 1;"'; ?>>
                            <label>
                                <input type="radio" id="skebby" name="usesms" value="1" <?php if($impostazioni[0]['usesms'] == 1 ) echo 'checked'; ?> />
                                <img src="<?= site_url(); ?>/img/skebby.jpg">
                            </label>
							<div class="form-group">
								<label class="title">
									<?= lang('skebby_title');?>
								</label>
                                                                <input type="hidden" id="s_user_id" value="<?= $impostazioni[0]['id']; ?>"/>
								<input id="s_user" type="text" class="validate form-control" placeholder="<?= lang('skebby_user');?>" value="<?= $impostazioni[0]['skebby_user']; ?>">
								<input id="s_password" type="text" class="validate form-control" placeholder="<?= lang('skebby_password');?>" value="<?= $impostazioni[0]['skebby_pass']; ?>">
								<input id="s_sender" type="text" class="validate form-control" placeholder="<?= lang('skebby_sender');?>" value="<?= $impostazioni[0]['skebby_name']; ?>">
								<input id="s_method" type="text" class="validate form-control" placeholder="<?= lang('skebby_method');?>" value="<?= $impostazioni[0]['skebby_method']; ?>">
							</div>
						</div>
                        <div class="col-lg-6 twilio-info radio-sms" <?php if($impostazioni[0]['usesms'] == 2 ) echo 'style="opacity: 1;"'; ?>>
                            <label>
                                <input type="radio" id="twilio" name="usesms" value="2" <?php if($impostazioni[0]['usesms'] == 2 ) echo 'checked'; ?> />
                                <img src="<?= site_url(); ?>/img/twilio.jpg">
                            </label>
							<div class="form-group">
								<label class="title">
									<?= lang('twilio_title');?>
								</label>
								<select id="t_mode" data-num="1" class="form-control m-bot15" style="width: 100%">
									<option <?php if($impostazioni[0]['twilio_mode'] == 'sandbox' ) echo 'selected'; ?>>sandbox</option>
                                    <option <?php if($impostazioni[0]['twilio_mode'] == 'prod' ) echo 'selected'; ?>>prod</option>
								</select>
								<input id="t_account_sid" type="text" class="validate form-control" placeholder="<?= lang('twilio_account_sid');?>" value="<?= $impostazioni[0]['twilio_account_sid']; ?>">
								<input id="t_token" type="text" class="validate form-control" placeholder="<?= lang('twilio_token');?>" value="<?= $impostazioni[0]['twilio_auth_token']; ?>">
								<input id="t_number" type="text" class="validate form-control" placeholder="<?= lang('twilio_number');?>" value="<?= $impostazioni[0]['twilio_number']; ?>">
							</div>
						</div>
                        </form>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>
                                    <?= lang('prefisso_internazionale');?>
                                </label>
                                <select name="countryCode" id="prefix" style="width: 100%">
                                    <option data-countryCode="GB" value="44" Selected>UK (+44)</option>
                                    <option data-countryCode="US" value="1">USA (+1)</option>
                                    <option data-countryCode="IT" value="39">Italy (+39)</option>
                                    <option data-countryCode="ES" value="34">Spain (+34)</option>
                                    <optgroup label="Other countries">
                                        <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                        <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                        <option data-countryCode="AO" value="244">Angola (+244)</option>
                                        <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                        <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                        <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                        <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                        <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                        <option data-countryCode="AU" value="61">Australia (+61)</option>
                                        <option data-countryCode="AT" value="43">Austria (+43)</option>
                                        <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                        <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                        <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                        <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                        <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                        <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                        <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                        <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                        <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                        <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                        <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                        <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                        <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                        <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                        <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                        <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                        <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                        <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                        <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                        <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                        <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                        <option data-countryCode="CA" value="1">Canada (+1)</option>
                                        <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                        <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                        <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                                        <option data-countryCode="CL" value="56">Chile (+56)</option>
                                        <option data-countryCode="CN" value="86">China (+86)</option>
                                        <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                        <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                        <option data-countryCode="CG" value="242">Congo (+242)</option>
                                        <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                        <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                        <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                        <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                        <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                        <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                        <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                        <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                        <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                        <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                        <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                                        <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                        <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                        <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                        <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                        <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                        <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                        <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                        <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                        <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                        <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                        <option data-countryCode="FI" value="358">Finland (+358)</option>
                                        <option data-countryCode="FR" value="33">France (+33)</option>
                                        <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                        <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                        <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                        <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                        <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                        <option data-countryCode="DE" value="49">Germany (+49)</option>
                                        <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                        <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                        <option data-countryCode="GR" value="30">Greece (+30)</option>
                                        <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                        <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                        <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                        <option data-countryCode="GU" value="671">Guam (+671)</option>
                                        <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                        <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                        <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                        <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                        <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                        <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                        <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                        <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                        <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                        <option data-countryCode="IN" value="91">India (+91)</option>
                                        <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                        <option data-countryCode="IR" value="98">Iran (+98)</option>
                                        <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                        <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                        <option data-countryCode="IL" value="972">Israel (+972)</option>
                                        <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                        <option data-countryCode="JP" value="81">Japan (+81)</option>
                                        <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                        <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                        <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                        <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                        <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                        <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                        <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                        <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                        <option data-countryCode="LA" value="856">Laos (+856)</option>
                                        <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                        <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                        <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                        <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                        <option data-countryCode="LY" value="218">Libya (+218)</option>
                                        <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                        <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                        <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                        <option data-countryCode="MO" value="853">Macao (+853)</option>
                                        <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                        <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                        <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                        <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                        <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                        <option data-countryCode="ML" value="223">Mali (+223)</option>
                                        <option data-countryCode="MT" value="356">Malta (+356)</option>
                                        <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                        <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                        <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                        <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                        <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                        <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                        <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                        <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                        <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                        <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                        <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                        <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                        <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                        <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                        <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                        <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                        <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                        <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                        <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                        <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                        <option data-countryCode="NE" value="227">Niger (+227)</option>
                                        <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                                        <option data-countryCode="NU" value="683">Niue (+683)</option>
                                        <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                        <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                        <option data-countryCode="NO" value="47">Norway (+47)</option>
                                        <option data-countryCode="OM" value="968">Oman (+968)</option>
                                        <option data-countryCode="PW" value="680">Palau (+680)</option>
                                        <option data-countryCode="PA" value="507">Panama (+507)</option>
                                        <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                        <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                        <option data-countryCode="PE" value="51">Peru (+51)</option>
                                        <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                        <option data-countryCode="PL" value="48">Poland (+48)</option>
                                        <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                        <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                        <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                        <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                        <option data-countryCode="RO" value="40">Romania (+40)</option>
                                        <option data-countryCode="RU" value="7">Russia (+7)</option>
                                        <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                        <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                        <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                        <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                        <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                        <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                        <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                        <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                        <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                        <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                        <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                        <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                        <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                        <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                        <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                        <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                        <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                        <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                        <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                        <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                        <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                        <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                        <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                        <option data-countryCode="SI" value="963">Syria (+963)</option>
                                        <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                        <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                        <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                        <option data-countryCode="TG" value="228">Togo (+228)</option>
                                        <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                        <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                        <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                        <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                        <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                        <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                        <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)</option>
                                        <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                        <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                        <!-- <option data-countryCode="GB" value="44">UK (+44)</option> -->
                                        <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                        <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                        <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                        <!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
                                        <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                        <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                        <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                        <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                        <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                        <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                                        <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                                        <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                        <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                        <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                        <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                        <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h3><?= lang('reparation_text');?></h3>
                            </div>
                        </div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>
									<?= lang('reparation_apertura');?>
								</label>
								<textarea class="form-control" id="r_apertura" style="height: 107px" maxlength="370" rows="6"><?= $impostazioni[0]['r_apertura']; ?></textarea>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label>
									<?= lang('reparation_chiusura');?>
								</label>
								<textarea class="form-control" id="r_chiusura" style="height: 107px" maxlength="370" rows="6"><?= $impostazioni[0]['r_chiusura']; ?></textarea>
							</div>
						</div>
					</div>
                    <div id="email" class="tab-pane fade">
                        <h3><?= lang('settings_email_second_title');?></h3>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="title">
                                    <?= lang('settings_email_sender');?>
                                </label>
                                <input id="email_sender" type="text" class="validate form-control" placeholder="<?= lang('settings_email_sender');?>" value="<?= $impostazioni[0]['email_sender']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="title">
                                    <?= lang('settings_email_subject');?>
                                </label>
                                <input id="email_subject" type="text" class="validate form-control" placeholder="<?= lang('settings_email_subject');?>" value="<?= $impostazioni[0]['email_subject']; ?>">
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="" id="email_use_smtp" <?php if ($impostazioni[0][ 'email_use_smtp']) { echo 'checked'; }?>>
                                        <?= lang('settings_email_smtp');?>
                                    </label>
                                </div>
                            </div>
                            <div class="smtp_info skebby-info <?php if ($impostazioni[0][ 'email_use_smtp']) { echo 'mostra'; }?>">
                                <input id="email_smtp_host" type="text" class="validate form-control" placeholder="<?= lang('settings_email_smtp_host');?>" value="<?= $impostazioni[0]['email_smtp_host']; ?>">
                                <input id="email_smtp_user" type="text" class="validate form-control" placeholder="<?= lang('settings_email_smtp_user');?>" value="<?= $impostazioni[0]['email_smtp_user']; ?>">
                                <input id="email_smtp_pass" type="text" class="validate form-control" placeholder="<?= lang('settings_email_smtp_pass');?>" value="<?= $impostazioni[0]['email_smtp_pass']; ?>">
                                <input id="email_smtp_port" type="text" class="validate form-control" placeholder="<?= lang('settings_email_smtp_port');?>" value="<?= $impostazioni[0]['email_smtp_port']; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <h3><?= lang('settings_email_text_title');?></h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>
                                    <?= lang('reparation_apertura');?>
                                </label>
                                <textarea class="form-control" id="email_smtp_open_text" style="height: 107px" maxlength="370" rows="6"><?= $impostazioni[0]['email_smtp_open_text']; ?></textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>
                                    <?= lang('reparation_chiusura');?>
                                </label>
                                <textarea class="form-control" id="email_smtp_closed_text" style="height: 107px" maxlength="370" rows="6"><?= $impostazioni[0]['email_smtp_closed_text']; ?></textarea>
                            </div>
                        </div>
                    </div>
				</div>
			</div>

			<div class="col-lg-12">
				<div id="submit_save">
					<button id='submit' class='btn btn-success'><i class="fa fa-save"></i>
						<?= lang('js_save');?>
					</button>
				</div>
			</div>

			<!-- page end-->
		</section>
	</section>
	<!--main content end-->
	<link rel="stylesheet" href="<?= site_url('assets/css/toastr.min.css'); ?>">
    <script><?php include(FCPATH.'assets/js/toastr.min.js'); ?></script>
    <script><?php include(FCPATH.'assets/bootstrap-colorpicker-master/js/bootstrap-colorpicker.min.js'); ?></script>
	<?php require 'footer.php'; ?>