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

class Manageusers extends CI_Controller
{
	// THE CONSTRUCTOR //
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Users_model');
        $this->load->model('Impostazioni_model');
        $this->lang->load('global', $this->Impostazioni_model->get_lingua());
	$this->Impostazioni_model->gen_token();
    }

	// SHOW THE SETTINGS PAGE //
    public function index()
    {
        $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni();
        if ($this->session->userdata('LoggedIn')) {
            $data['total_users'] = $this->Users_model->get_total_clients();            
            $data['stile'] = $this->Impostazioni_model->get_custom_style(1);
            $this->load->view('manage_users', $data);
        } else {
            redirect('');
        }
    }
    
    public function get_users_list(){
        $dataUsers = $this->Users_model->get_clients_list();
        echo json_encode($dataUsers);
    }
}