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

class Manageemployees extends CI_Controller
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
        $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni(true);
        if ($this->session->userdata('LoggedIn')) {
            $data['total_users'] = $this->Users_model->get_total_employees();            
            $data['stile'] = $this->Impostazioni_model->get_custom_style(1);
            $this->load->view('manage_employees', $data);
        } else {
            redirect('');
        }
    }
    
    public function get_employee_list(){
        $dataUsers = $this->Users_model->get_employees_list();
        echo json_encode(array('data'=>$dataUsers));
    }
    
    public function add_new_employee(){
        $employee_name = $this->input->post('employee_name', true);
        $employee_lastname = $this->input->post('employee_lastname', true);
        $employee_logincode = $this->input->post('employee_logincode', true);
        $employee_email = $this->input->post('employee_email', true);
        $employee_phone = $this->input->post('employee_phone', true);
        $employee_address = $this->input->post('employee_address', true);
        $storeData = array(
                        'employee_name' => $employee_name,
                        'employee_lastname' => $employee_lastname,
                        'employee_logincode' => $employee_logincode,
                        'employee_email' => $employee_email,
                        'employee_phone' => $employee_phone,
                        'employee_address' => $employee_address
                     );
        $status = $this->Users_model->save_employee_data($storeData);
        echo 1;
    }
    
    public function get_employee_data(){
        $userId = $this->input->post('userId', true);
        $dataUsers = $this->Users_model->get_employee_data($userId);
        echo json_encode($dataUsers);
    }
    
    public function update_employee(){
        $employee_name = $this->input->post('employee_name', true);
        $employee_lastname = $this->input->post('employee_lastname', true);
        $employee_logincode = $this->input->post('employee_logincode', true);
        $employee_email = $this->input->post('employee_email', true);
        $employee_phone = $this->input->post('employee_phone', true);
        $employee_address = $this->input->post('employee_address', true);
        $userid = $this->input->post('store_id', true);
        $loginuserid = $this->input->post('login_id', true);
        $storeData = array(
                        'employee_name' => $employee_name,
                        'employee_lastname' => $employee_lastname,
                        'employee_logincode' => $employee_logincode,
                        'employee_email' => $employee_email,
                        'employee_phone' => $employee_phone,
                        'employee_address' => $employee_address
                     );
        $status = $this->Users_model->update_employee_data($storeData, $userid, $loginuserid);
        echo 1;
    }
    
    public function delete_employee(){
        $userid = $this->input->post('store_id', true);
        $loginuserid = $this->input->post('login_id', true);
        $status = $this->Users_model->delete_store($userid, $loginuserid);
        echo 1;
    }
    
    
}