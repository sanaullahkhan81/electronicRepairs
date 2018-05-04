<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class skebby
{
    //--------------
    protected $_url = 'http://gateway.skebby.it/api/send/smseasy/advanced/http.php';
    protected $_username = '';
    protected $_password = '';

    protected $_recipients = array();
    protected $_sender = '';
    protected $_method = '';
    protected $_text = '';

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->model('Impostazioni_model');
        $imp = $this->get();

        $this->_username = $imp[0]['skebby_user'];
        $this->_password = $imp[0]['skebby_pass'];
        $this->_sender = $imp[0]['skebby_name'];
        $this->_method = $imp[0]['skebby_method'];
    }

    /*
     * Definisce i destinatari
     * array('393291677525') Destinatario singolo
     * array('393291677525','39346786453') Destinatari multipli
     */

    public function get()
    {
        $impostazioni = $this->CI->Impostazioni_model->lista_impostazioni(true);

        return $impostazioni;
    }

    public function set_recipients($array)
    {
        $this->_recipients = $array;
    }

    /*
     * Contenuto del messaggio
     * (string) 'Messaggio di prova'
     */
    public function set_text($string)
    {
        $this->_text = $string;
    }

    /* 
     * Opzionale:
     * (string) classic, classic_plus, basic
     */
    public function set_method($method)
    {
        $this->_method = $method;
    }

    /*
     * Opzionale:
     * Definisce il mittente (solo method classic e classic_plus)
     * (int) '3291677525' Nel caso si voglia personalizzare il nuero
     * (string) 'RM Design' Nel caso si voglia un mittente alfanumerico
     */
    public function set_sender($string)
    {
        $this->_sender = $string;
    }

    /*
     * Invio dell'sms
     */
    public function send_sms()
    {
        return $this->skebby_gateway();
    }

    /*
     * Ritorna il credito residuo e il numero di sms inviabili
     */
    public function get_credit()
    {
        $parameters = array(
            'method' => 'get_credit',
            'username' => $this->_username,
            'password' => $this->_password,
            'charset' => 'UTF-8',
        );
        parse_str($this->do_post_request(http_build_query($parameters)), $ret);

        return $ret;
    }

    protected function skebby_gateway()
    {
        $parameters = array(
            'method' => $this->_method,
            'username' => $this->_username,
            'password' => $this->_password,
            'text' => $this->_text,
            'recipients[]' => implode('&recipients[]=', $this->_recipients),
            'charset' => 'UTF-8',
        );

        if (!is_int($this->_sender)) {
            $parameters['sender_string'] = $this->_sender;
        } else {
            $parameters['sender_number'] = $this->_sender;
        }

        parse_str($this->do_post_request(http_build_query($parameters)), $ret);

        return $ret;
    }

    protected function do_post_request($data)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_USERAGENT, 'RMDesign');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_URL, $this->_url);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}

/* End of file skebby.php */
/* Location: ./application/libraries/skebby.php */
