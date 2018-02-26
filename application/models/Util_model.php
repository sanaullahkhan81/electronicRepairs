<?php

//Model for utilities 
class Util_Model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function prep_password($password)
    {
        return sha1($password.$this->config->item('encryption_key'));
    }

    public function generate_random_string($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; ++$i) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }

        return $randomString;
    }

    public function create_guid($namespace = '')
    {
        static $guid = '';
        $uid = uniqid('', true);
        $data = $namespace;
        $data .= $_SERVER['REQUEST_TIME'];
        $data .= $_SERVER['HTTP_USER_AGENT'];
        $data .= $_SERVER['REMOTE_ADDR'];
        $data .= $_SERVER['REMOTE_PORT'];
        $hash = hash('ripemd128', $uid.$guid.md5($data));
        $guid =
            substr($hash, 0, 8).
            '-'.
            substr($hash, 8, 4).
            '-'.
            substr($hash, 12, 4).
            '-'.
            substr($hash, 16, 4).
            '-'.
            substr($hash, 20, 12);

        return $guid;
    }

    public function create_summary($content, $limit, $moreURL)
    {
        if (strlen($content) <= $limit) {
            return $content;
        }

        $summary = substr($content, 0, $limit);
        $end = strlen($summary) - 1;
        while ($summary[$end] != ' ' && $end >= 0) {
            --$end;
        }
        $summary = substr($summary, 0, $end);
        $summary .= '... ';
        $summary .= '<a href="'.$moreURL.'">(more)</a>';

        return $summary;
    }

    public function create_slug($string)
    {
        return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));
    }

    public function send_reset_password_email($email, $resetKey)
    {
        //use the email template in /views/emails/forgot_password.php
        $this->load->library('parser');
        $content = $this->parser->parse('emails/forgot_password', array('resetURL' => site_url('login/reset_password').'/'.$resetKey, true));

        log_message('error', 'sending email with content: '.$content);

        $this->load->library('email');
        $this->email->from('support@mammothology.com', 'Mammothology.com');
        $this->email->to($email, 'User Name');
        $this->email->subject('Forgot Password');

        $this->email->message($content);
        $this->email->send();
    }
}
