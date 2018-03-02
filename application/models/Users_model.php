<?php

/*
|--------------------------------------------------------------------------
| General model file
|--------------------------------------------------------------------------
| 
*/

class Users_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Impostazioni_model');
        $this->load->library('skebby');
        $this->load->library('twilio');
        $this->load->library('email');
    }
    
    public function get_total_clients(){
        $this->db->from('customer_login');
        return $this->db->count_all_results();
    }
    
    public function get_clients_list(){
        $data = array();
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('customer_login');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        }
        
        $dataForJson = array();
        foreach($data as $row){
            $dataForJson['name'] = $row['name'];
            $dataForJson['lastname'] = $row['name'];
            $dataForJson['address'] = $row['address'];
            $dataForJson['email'] = $row['email'];
            $dataForJson['password'] = $row['password'];
            $dataForJson['userType'] = $row['userType'];
            $dataForJson['phone'] = $row['phone'];
            $dataForJson['actions'] = 'testing';
        }
        
        return $dataForJson;
    }
}