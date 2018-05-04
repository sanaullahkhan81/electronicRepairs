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
        $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni(true);
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
        echo json_encode(array('data'=>$dataUsers));
    }
    
    public function add_new_store(){
        $store_name = $this->input->post('store_name', true);
        $store_code = $this->input->post('store_code', true);
        $store_email = $this->input->post('store_email', true);
        $store_password = $this->input->post('store_password', true);
        $store_phone = $this->input->post('store_phone', true);
        $store_address = $this->input->post('store_address', true);
        $storeData = array(
                        'store_name' => $store_name,
                        'store_code' => $store_code,
                        'store_email' => $store_email,
                        'store_password' => $store_password,
                        'store_phone' => $store_phone,
                        'store_address' => $store_address
                     );
        $status = $dataUsers = $this->Users_model->save_store_data($storeData);
        echo 1;
    }
    
    public function get_user_data(){
        $userId = $this->input->post('userId', true);
        $dataUsers = $this->Users_model->get_user_data($userId);
        echo json_encode($dataUsers);
    }
    
    public function update_store(){
        $store_name = $this->input->post('store_name', true);
        $store_code = $this->input->post('store_code', true);
        $store_email = $this->input->post('store_email', true);
        $store_password = $this->input->post('store_password', true);
        $store_phone = $this->input->post('store_phone', true);
        $store_address = $this->input->post('store_address', true);
        $userid = $this->input->post('store_id', true);
        $loginuserid = $this->input->post('login_id', true);
        $storeData = array(
                        'store_name' => $store_name,
                        'store_code' => $store_code,
                        'store_email' => $store_email,
                        'store_password' => $store_password,
                        'store_phone' => $store_phone,
                        'store_address' => $store_address
                     );
        $status = $this->Users_model->update_store_data($storeData, $userid, $loginuserid);
        echo 1;
    }
    
    public function delete_store(){
        $userid = $this->input->post('store_id', true);
        $loginuserid = $this->input->post('login_id', true);
        $status = $this->Users_model->delete_store($userid, $loginuserid);
        echo 1;
    }
    
    
}