<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Setting
 *
 *
 * @package		FixBook
 * @category	Controller
 * @author		Luigi Verzì
*/

class Impostazioni extends CI_Controller
{
	// THE CONSTRUCTOR //
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Impostazioni_model');
        $this->lang->load('global', $this->Impostazioni_model->get_lingua());
        $this->load->helper('language');
		$this->Impostazioni_model->gen_token();
    }

	// SHOW THE SETTINGS PAGE //
    public function index()
    {
        $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni();
        $data['timezones'] = $this->Impostazioni_model->get_timezones_list();
        $data['stile'] = $this->Impostazioni_model->get_custom_style(1);
        echo  $this->session->userdata('LoggedIn')."========================";
        if ($this->session->userdata('LoggedIn')) {
            
            $this->load->view('impostazioni_page', $data);
        } else {
            redirect('');
        }
    }
    
    // GENERATE THE CUSTOM COLOR FILE //
    public function stile()
    {
        $data['colore'] = $this->input->post('colore', true);
        $data['alfa'] = $this->Impostazioni_model->hex2rgba($this->input->post('colore', true), 0.1);
        echo $this->load->view('js/colori_js', $data, true);
    }
    
    // AJAX LOGO UPLOAD //
    public function upload_image()
    {
        $status = "";
        $msg = "";
        $file_element_name = 'logo_upload';
        if ($status != "error")
        {
            $config['file_name']='logo_nav';
            $config['upload_path'] = FCPATH.'img/';
            $config['allowed_types'] = 'png|jpg|gif';
            $config['max_size'] = 190 * 53;
            $config['encrypt_name'] = FALSE;
            $config['overwrite'] = TRUE;

            @chmod(FCPATH.'img/', intval('777', 8));

            $this->load->library('upload', $config);

            if (!@$this->upload->do_upload($file_element_name))
            {
                $status = 'error';
                $msg = $this->upload->display_errors('', '');
                echo 'false';
            }
            else
            {
                $data = $this->upload->data();
                if($data)
                {
                    $nome = 'logo_nav.'.end(explode(".", $_FILES[$file_element_name]['name'])).'?'.rand(5, 15);
                    $this->Impostazioni_model->salva_logo($nome);
                    echo $nome;
                }
                else
                {
                    unlink($data['full_path']);
                    echo 'false';
                }
            } 
            @unlink($_FILES[$file_element_name]);
        }
    }


	// SAVE THE SETTING //
    public function salva_impostazioni()
    {
        $titolo = $this->input->post('titolo', true);
        $lingua = $this->input->post('lingua', true);
        $auser = $this->input->post('auser', true);
        $apass = $this->input->post('apass', true);
        $disclaimer = $this->input->post('disclaimer', true);
        $cat = $this->input->post('cat', true);
        $campi = $this->input->post('campi', true);
        $usesms = $this->input->post('usesms', true);
        $s_user = $this->input->post('s_user', true);
        $s_pass = $this->input->post('s_pass', true);
        $s_name = $this->input->post('s_name', true);
        $s_method = $this->input->post('s_method', true);
        $t_mode = $this->input->post('t_mode', true);
        $t_account_sid = $this->input->post('t_account_sid', true);
		$t_auth_token = $this->input->post('t_token', true);
		$t_number = $this->input->post('t_number', true);
		$prefix= $this->input->post('prefix', true);
		$r_apertura = $this->input->post('r_apertura', true);
		$r_chiusura = $this->input->post('r_chiusura', true);
        
        
        $email_sender = $this->input->post('email_sender', true);
		$email_subject = $this->input->post('email_subject', true);
		$email_use_smtp = $this->input->post('email_use_smtp', true);
		$email_smtp_host = $this->input->post('email_smtp_host', true);
		$email_smtp_user = $this->input->post('email_smtp_user', true);
		$email_smtp_pass = $this->input->post('email_smtp_pass', true);
		$email_smtp_port = $this->input->post('email_smtp_port', true);
        $email_smtp_open_text = $this->input->post('email_smtp_open_text', true);
        $email_smtp_closed_text = $this->input->post('email_smtp_closed_text', true);
        
        
		$showcredit = $this->input->post('showcredit', true);
		$rtl_support = $this->input->post('rtl_support', true);
        $transition_background = $this->input->post('transition_background', true);
		$valuta = $this->input->post('valuta', true);
        $currency_symbol = $this->input->post('currency_symbol', true);
        $currency_text = $this->input->post('currency_text', true);
        $currency_position = $this->input->post('currency_position', true);
        $timezone = $this->input->post('timezone', true);
		$token = $this->input->post('token', true);
		$name = $this->input->post('name', true);
		$mail = $this->input->post('mail', true);
		$address = $this->input->post('address', true);
		$phone = $this->input->post('phone', true);
		$vat = $this->input->post('vat', true);
		$type = $this->input->post('type', true);
		$tax = $this->input->post('tax', true);
		$colore1 = $this->input->post('colore1', true);
		$colore2 = $this->input->post('colore2', true);
		$colore3 = $this->input->post('colore3', true);
		$colore4 = $this->input->post('colore4', true);
		$colore5 = $this->input->post('colore5', true);
		$colore_prim = $this->input->post('colore_prim', true);
		$stampadue = $this->input->post('stampadue', true);
        $printinonepage = $this->input->post('printinonepage', true);

		if($_SESSION['token'] != $token) die('CSRF Attempts');

        $data = $this->Impostazioni_model->aggiorna_impostazioni($titolo, $lingua, $disclaimer, $auser, $apass, $usesms, $s_user, $s_pass, $s_name, $s_method, $t_mode,$t_account_sid,$t_auth_token,$t_number, $prefix, $r_apertura, $r_chiusura, $email_sender, $email_subject, $email_use_smtp, $email_smtp_host, $email_smtp_user, $email_smtp_pass, $email_smtp_port, $email_smtp_open_text, $email_smtp_closed_text, $showcredit, $rtl_support, $transition_background, $valuta, $name, $mail, $address, $phone, $vat, $type, $tax, $cat, $colore1, $colore2, $colore3, $colore4, $colore5, $colore_prim, $campi, $stampadue, $printinonepage, $currency_symbol,  $currency_text, $currency_position, $timezone);
        echo json_encode($data);
    }
}

/* End of file impostazioni.php */
/* Location: ./system/application/controllers/impostazioni.php */