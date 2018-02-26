<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Financial
 *
 *
 * @package		FixBook
 * @category	Controller
 * @author		Luigi Verzì
*/

class Finanze extends CI_Controller
{
	// THE CONSTRUCTOR //
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Gestione_model');
        $this->load->model('Impostazioni_model');
        $this->load->helper('language');
        $this->lang->load('global', $this->Impostazioni_model->get_lingua());
    }

	// PRINT A FINANCIAL PAGE //
    public function index()
    {
        $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni();
        $data['valuta'] = $this->Impostazioni_model->get_currency();
        $data['stile'] = $this->Impostazioni_model->get_custom_style(1);
        if ($this->session->userdata('LoggedIn')) {
            $data['lista'] = $this->Gestione_model->lista_guadagni(date('m'), date('Y'));
            $this->load->view('finanze_page', $data);
        } else {
            redirect('');
        }
    }

	// PRINT A FINANCIAL GRAPH FOR MONTHS AND YEARS //
    public function data($mese, $anno)
    {
        $data['valuta'] = $this->Impostazioni_model->get_currency();
        $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni();
        $data['stile'] = $this->Impostazioni_model->get_custom_style(1);
        if ($this->session->userdata('LoggedIn')) {
            if (isset($mese) && isset($anno)) {
                $data['lista'] = $this->Gestione_model->lista_guadagni($mese, $anno);
            } else {
                $data['lista'] = $this->Gestione_model->lista_guadagni(date('m'), date('Y'));
            }
            $this->load->view('finanze_page', $data);
        } else {
            redirect('');
        }
    }
}

/* End of file finanze.php */
/* Location: ./system/application/controllers/finanze.php */
