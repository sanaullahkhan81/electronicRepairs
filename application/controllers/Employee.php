<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Employee extends CI_Controller
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
            $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni(true);
            $this->load->view('employee_login', $data);
        }
    }

	// DO THE LOGIN //
    public function log_in()
    {
        $employee_code = $this->input->post('employee_login_code', true);

        $isValid = $this->Login_model->emplyee_login($employee_code);
        if ($isValid) {
            $this->session->set_userdata('LoggedIn', true);
            $userData = $this->Login_model->getUserData($employee_code, null, true);
            $this->session->set_userdata('email', $userData['email']);
            $this->session->set_userdata('user_type', $userData['user_type']);
            $this->session->set_userdata('user_id', $userData['user_id']);
            $this->session->set_userdata('store_id', $userData['store_id']);
            if($userData['user_type'] == 'admin'){
                $this->session->set_userdata('admin_selected_store', 'my');
            }
            if($userData['user_type'] == 'employee'){
                $employeeUserData = $this->Impostazioni_model->getUserData(true);
                $this->session->set_userdata('user_name', $employeeUserData['name'].' '.$employeeUserData['lastname']);
                $this->session->set_userdata('table_prefix', 'store_'.$userData['store_id'].'_');
            }else{
                $this->session->set_userdata('table_prefix', 'store_'.$userData['user_id'].'_');
            }
            redirect('');
        } else {
            redirect('employee');
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
