<?php

/*
|--------------------------------------------------------------------------
| Setting model file
|--------------------------------------------------------------------------
| 
*/

class Impostazioni_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

	/*------------------------------------------------------------------------
	| GET THE LANGUAGE
	| @return Language slug
	|--------------------------------------------------------------------------*/
    public function get_lingua()
    {
        $data = array();
        $query = $this->db->get('impostazioni');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        }

        return $data[0]['lingua'];
    }

	/*------------------------------------------------------------------------
	| GET SETTING LIST
	| @return Variable with setting
	|--------------------------------------------------------------------------*/
    public function lista_impostazioni($loggedin = false)
    {

        $data = array();
        if($loggedin == true){
            if($this->session->userdata('user_id')){
                $userId = $this->session->userdata('user_id');
                $this->db->where('id', $userId);
            }
        }
        $query = $this->db->get('impostazioni');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        }
        
        if($data[0]['timezone'] != '' && $data[0]['timezone'] != NULL) date_default_timezone_set($data[0]['timezone']);


        return $data;
    }
    
    public function getUserData(){
        if($this->session->userdata('user_id')){
            $userId = $this->session->userdata('user_id');
            $userType = $this->session->userdata('user_type');
            if($userType == 'employee'){
                $userId = $this->session->userdata('store_id');
            }
            $this->db->where('user_id', $userId);
            $query = $this->db->get('users_data');
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
                return $data[0];
            }
        }
        return array();
    }

	/*------------------------------------------------------------------------
	| UPDATE SETTING
	| @param title, lang, disclaimer, admin username, admin password, sms services used, skebby username, skebby password, skebby name, skebby method, showcredit [1/0],
	| currency, invoice name, invoice mail, invoice address, invoice phone, invoice VAT, invoice type [EU/US], tax amount, category
	|--------------------------------------------------------------------------*/
    public function aggiorna_impostazioni($titolo, $lingua, $disclaimer, $auser, $apass, $usesms, $skebby_user, $skebby_pass, $skebby_name, $skebby_method, $twilio_mode, $twilio_account_sid, $twilio_auth_token, $twilio_number, $prefix, $r_apertura, $r_chiusura, $email_sender, $email_subject, $email_use_smtp, $email_smtp_host, $email_smtp_user, $email_smtp_pass, $email_smtp_port, $email_smtp_open_text, $email_smtp_closed_text, $showcredit, $rtl_support, $transition_background, $valuta, $name, $mail, $address, $phone, $vat, $type, $tax, $cat, $colore1, $colore2, $colore3, $colore4, $colore5, $colore_prim, $campi, $stampadue, $printinonepage, $currency_symbol, $currency_text, $currency_position, $timezone)
    {
        $data = array(
            'titolo' => $titolo,
            'lingua' => $lingua,
            'admin_user' => $auser,
            'admin_password' => $apass,
            'disclaimer' => $disclaimer,
            'usesms' => $usesms,
            'skebby_user' => $skebby_user,
            'skebby_pass' => $skebby_pass,
            'skebby_name' => $skebby_name,
            'skebby_method' => $skebby_method,
            'twilio_mode' => $twilio_mode,
			'twilio_account_sid' => $twilio_account_sid,
			'twilio_auth_token' => $twilio_auth_token,
			'twilio_number' => $twilio_number,
			'prefix_number' => $prefix,
			'r_apertura' => $r_apertura,
			'r_chiusura' => $r_chiusura,
			'email_sender' => $email_sender,
			'email_subject' => $email_subject,
			'email_use_smtp' => $email_use_smtp,
			'email_smtp_host' => $email_smtp_host,
			'email_smtp_user' => $email_smtp_user,
			'email_smtp_pass' => $email_smtp_pass,
			'email_smtp_port' => $email_smtp_port,
			'email_smtp_open_text' => $email_smtp_open_text,
			'email_smtp_closed_text' => $email_smtp_closed_text,
            'showcredit' => $showcredit,
            'rtl_support' => $rtl_support,
            'background_transition' => $transition_background,
            'valuta' => $valuta,
            'invoice_name' => $name,
			'invoice_mail' => $mail,
            'indirizzo' => $address,
            'telefono' => $phone,
            'vat' => $vat,
            'invoice_type' => $type,
            'tax' => $tax,
			'categorie' => str_replace(",", PHP_EOL, $cat),
            'colore1' => $colore1,
            'colore2' => $colore2,
            'colore3' => $colore3,
            'colore4' => $colore4,
            'colore5' => $colore5,
            'colore_prim' => $colore_prim,
            'campi_personalizzati' =>   base64_encode(serialize(explode(",", $campi))),
            'stampadue' =>   $stampadue,
            'printinonepage' =>   $printinonepage,
            'currency_symbol' =>   $currency_symbol,
            'currency_text' =>   $currency_text,
            'currency_position' =>   $currency_position,
            'timezone' =>   $timezone
        );
        $this->db->update('impostazioni', $data);
    }
	
	/*------------------------------------------------------------------------
	| ADD THE NEW CATEGORY TO DATABASE
	-------------------------------------------------------------------------*/
	public function add_category($category)	
	{
		$imp = $this->lista_impostazioni();
		$data = array(
			'categorie' => $category.PHP_EOL.$imp[0]['categorie'],
		);
		$this->db->update('impostazioni', $data);
	}
	
	/*------------------------------------------------------------------------
	| GET THE CURRENT CURENCY
	| @return [€/$]
	-------------------------------------------------------------------------*/
	public function get_currency($withoutarray = true)
	{
		$data = array();
		$query = $this->db->get('impostazioni');
		if ($query->num_rows() > 0) {
			$data = $query->result_array();
		}
		
		if($data[0]['valuta'] == 'Euro') return '€';
		elseif($data[0]['valuta'] == 'GPB') return '£';
		elseif($data[0]['valuta'] == 'USD') return '$';
		elseif($data[0]['valuta'] == 'NOK') return 'kr';
		elseif($data[0]['valuta'] == 'CUSTOM') {
            return ($withoutarray ? $data[0]['currency_symbol'] : array($data[0]['currency_symbol']));
        }
	}
    
    /*------------------------------------------------------------------------
	| GET THE FORMATTED MONEY VALUE
	| @return VALUE WITH CURRENCY
	-------------------------------------------------------------------------*/
    public function get_money($valore, $cur_style = false, $js = false)
    {
        $valuta = $this->get_currency(false);
        
        if(is_array($valuta))
        {
            
            if($cur_style != false) $valuta[0] = "<span style='".$cur_style."'>".$valuta[0]."</span>";
            
            $data = array();
            $query = $this->db->get('impostazioni');
            if ($query->num_rows() > 0) {
                $data = $query->result_array();
            }
            
            if($js)
            {
                if($data[0]['currency_position'] == 'left') return "'".$valuta[0]." ' + ".$valore;
                else return $valore." + ' ".$valuta[0]."'";
            }
            else
            {
                if($data[0]['currency_position'] == 'left') return $valuta[0].' '.$valore;
                else return $valore.' '.$valuta[0];
            }
        }
        else
        {
            
            if($cur_style != false) $valuta = "<span style='".$cur_style."'>".$valuta."</span>";
            
            if($js)
            {
                if(strpos($valuta, '£')  !== false) return "'".$valuta." ' + ".$valore;
                else return $valore." + ' ".$valuta."'";
            }
            else
            {
                if(strpos($valuta, '£')  !== false) return $valuta.' '.$valore;
                else return $valore.' '.$valuta;
            }
       }
    }
	
	/*------------------------------------------------------------------------
	| GENERATE THE TOKEN ANTI CSRF
	-------------------------------------------------------------------------*/
	public function gen_token()
	{
		session_start();
		if( !isset( $_SESSION['token'] ) ) //Se non è stato settato nessun Token
		{
			$token = md5( rand() );
			$token = str_split( $token, 10 );
			$_SESSION['token'] = $token[0]; //Settiamo il token
		}
	}
    
    /*------------------------------------------------------------------------
	| SAVE THE LOGO IN THE DB
	-------------------------------------------------------------------------*/
    public function salva_logo($logo)	
    {
        $imp = $this->lista_impostazioni();
        $data = array(
            'logo' => $logo,
        );
        $this->db->update('impostazioni', $data);
    }
    
    /*------------------------------------------------------------------------
	| GET THE CUSTOM STYLE
	-------------------------------------------------------------------------*/
    public function get_custom_style($def, $colore = false, $alfa = false) {

        if($def || !$colore || !$alfa)
        {
            $impostazioni = $this->lista_impostazioni();
            $data['colore'] = $impostazioni[0]['colore_prim'];
            $data['alfa'] = $this->Impostazioni_model->hex2rgba($data['colore'], 0.05);
        }
        else
        {
            $data['colore'] = $colore;
            $data['alfa'] = $alfa;
        }
        return $this->load->view('js/colori_js', $data, true);
        
    }
    
    /*------------------------------------------------------------------------
	| CONVERT HEX COLOR TO RGBA (WITH ALPHA)
	-------------------------------------------------------------------------*/
    public function hex2rgba($color, $opacity = false) {

        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if(empty($color))
            return $default; 

        //Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
    }
    
    /*------------------------------------------------------------------------
	| GET AN LIST OF TIMEZONES
	-------------------------------------------------------------------------*/
    public function get_timezones_list() {
        
        static $regions = array(
            DateTimeZone::AFRICA,
            DateTimeZone::AMERICA,
            DateTimeZone::ANTARCTICA,
            DateTimeZone::ASIA,
            DateTimeZone::ATLANTIC,
            DateTimeZone::AUSTRALIA,
            DateTimeZone::EUROPE,
            DateTimeZone::INDIAN,
            DateTimeZone::PACIFIC,
        );

        $timezones = array();
        foreach( $regions as $region )
        {
            $timezones = array_merge( $timezones, DateTimeZone::listIdentifiers( $region ) );
        }

        $timezone_offsets = array();
        foreach( $timezones as $timezone )
        {
            $tz = new DateTimeZone($timezone);
            $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
        }

        // sort timezone by offset
        asort($timezone_offsets);

        $timezone_list = array();
        foreach( $timezone_offsets as $timezone => $offset )
        {
            $offset_prefix = $offset < 0 ? '-' : '+';
            $offset_formatted = gmdate( 'H:i', abs($offset) );

            $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

            $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
        }

        return $timezone_list;
    }
}
