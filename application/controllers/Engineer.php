<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Engineer extends CI_Controller
{
	// THE CONSTRUCTOR //
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Gestione_model');
        $this->load->model('Impostazioni_model');
        $this->lang->load('global', $this->Impostazioni_model->get_lingua());
        //$this->load->library('session');
    }

	// SHOW THE LOGIN PAGE //
    public function index()
    {
        if ($this->session->userdata('LoggedIn')) {
            redirect('');
        } else {
            $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni();
            $this->load->view('engineer_login', $data);
        }
    }
}