<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Status
 *
 *
 * @package		FixBook
 * @category	Controller
 * @author		Luigi Verzì
 * @description	Get the order status to client
*/

class Status extends CI_Controller
{
	// THE CONSTRUCTOR //
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Gestione_model');
        $this->load->model('Impostazioni_model');
        $this->lang->load('global', $this->Impostazioni_model->get_lingua());
    }
    
	// SHOW THE STATUS PAGE //
    public function index()
    {
        $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni();
        $this->load->view('status_page', $data);
    }
	
	// GET THE STATUS OF ORDER //
    public function ottieni_stato()
    {
        $codice = $this->input->post('codice', true);
        $codeType = $this->input->post('code_type', true);
        $tablePrefix = $this->Gestione_model->getTablePrefixForNonLoggedIn($codice, $codeType);
        $tableName = $tablePrefix.'oggetti';
        $data = array();
        if($codeType == 'status'){
            $query = $this->db->get_where($tableName, array('codice' => $codice));
        }else{
            $query = $this->db->get_where($tableName, array('engineer_code' => $codice));
        }
        if ($query->num_rows() > 0 && strlen($codice) > 3) {
            $data = $query->row_array();
            echo json_encode($data);
        } else {
            echo 'false';
        }
    }
    
    public function add_comment(){
        $id = $this->input->post('id', true);
        $type = $this->input->post('type', true);
        $comment = $this->input->post('comment', true);
        $eng_code = $this->input->post('eng_code', true);
        $this->Gestione_model->save_comment($id, $type, $comment, false, $eng_code);
        echo json_encode(array('status'=>'success'));
    }
    
    public function mark_completed(){
        $id = $this->input->post('id', true);
        $eng_code = $this->input->post('eng_code', true);
        $tablePrefix = $this->Gestione_model->getTablePrefixForNonLoggedIn($eng_code, 'engineer');
        $tableName = $tablePrefix.'oggetti';
        $this->db->where(array('ID' => $id));
        $this->db->update($tableName, array('engineer_status'=>1));
    }
}
