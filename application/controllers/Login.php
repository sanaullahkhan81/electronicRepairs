<?php

/**
 * Login
 *
 *
 * @package		FixBook
 * @category	Controller
 * @author		Luigi Verzì
*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends CI_Controller
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
            redirect('profile');
        } else {
            $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni();
            $this->load->view('login_page', $data);
        }
    }

	// DO THE LOGIN //
    public function log_in()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        $isValid = $this->Login_model->controlla_login($email, $password);
        if ($isValid) {
            $this->session->set_userdata('LoggedIn', true);
            $this->session->set_userdata('email', $email);
            $userData = $this->Login_model->getUserData($email, $password);
            $this->session->set_userdata('user_type', $userData['user_type']);
            $this->session->set_userdata('user_id', $userData['user_id']);
            if($userData['user_type'] == 'employee'){
                $this->session->set_userdata('table_prefix', 'store_'.$userData['store_id'].'_');
            }else{
                $this->session->set_userdata('table_prefix', 'store_'.$userData['user_id'].'_');
            }
            echo true;
        } else {
            echo false;
        }
    }

	// SEND THE FORGOTTEN PASSWORD //
    public function forgot_password()
    {
        $email = $this->input->post('email', true);
        $controllo = $this->Login_model->controlla_email($email);
        if ($controllo) {
            $this->Login_model->invia_password($email);
            echo $email;
        } else {
            echo 'false';
        }
    }

	// DO THE ADMIN LOGOUT //
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}

/* End of file login.php */
/* Location: ./system/application/controllers/login.php */
