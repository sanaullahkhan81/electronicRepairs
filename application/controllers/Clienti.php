<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Customers
 *
 *
 * @package		FixBook
 * @category	Controller
 * @author		Luigi Verzì
*/

// Includes all customers controller

class Clienti extends CI_Controller
{
	// THE CONSTRUCTOR //
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Login_model');
        $this->load->model('Gestione_model');
        $this->load->model('Impostazioni_model');
        $this->lang->load('global', $this->Impostazioni_model->get_lingua());
		$this->Impostazioni_model->gen_token();
    }

	// PRINT A CUSTOMERS PAGE //
    public function index()
    {
        $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni(true);
        if ($this->session->userdata('LoggedIn')) {
            $data['lista'] = $this->Gestione_model->lista_clienti();
            $data['n_clienti'] = $this->Gestione_model->conta_clienti();
            $data['lista_c'] = $this->Gestione_model->lista_clienti();
            $data['stile'] = $this->Impostazioni_model->get_custom_style(1);
            $data['stores'] = $this->Impostazioni_model->getAllStores();
            $this->load->view('clienti_page', $data);
        } else {
            redirect('');
        }
    }
	
	
	// ADD A CUSTOMER //
    public function aggiungi_cliente()
    {
        if ($this->session->userdata('LoggedIn')) {
            $nome = $this->input->post('nome', true);
            $cognome = $this->input->post('cognome', true);
            $indirizzo = $this->input->post('indirizzo', true);
            $citta = $this->input->post('citta', true);
            $telefono = $this->input->post('telefono', true);
            $email = $this->input->post('email', true);
            $commenti = $this->input->post('commenti', true);
            $vat = $this->input->post('vat', true);
            $cf = $this->input->post('cf', true);
			$token = $this->input->post('token', true);
			
			if($_SESSION['token'] != $token) die('CSRF Attempts');

           echo $this->Gestione_model->inserisci_cliente($nome, $cognome, $indirizzo, $citta, $telefono, $email, $commenti, $vat, $cf);
        } else {
            redirect('');
        }
    }

	// EDIT CUSTOMER //
    public function modifica_cliente()
    {
        if ($this->session->userdata('LoggedIn')) {
            $nome = $this->input->post('nome', true);
            $cognome = $this->input->post('cognome', true);
            $indirizzo = $this->input->post('indirizzo', true);
            $citta = $this->input->post('citta', true);
            $telefono = $this->input->post('telefono', true);
            $id = $this->input->post('id', true);
            $email = $this->input->post('email', true);
            $commenti = $this->input->post('commenti', true);
            $vat = $this->input->post('vat', true);
            $cf = $this->input->post('cf', true);
			$token = $this->input->post('token', true);

			if($_SESSION['token'] != $token) die('CSRF Attempts');
			
            echo $this->Gestione_model->salva_cliente($nome, $cognome, $indirizzo, $citta, $telefono, $id, $email, $commenti, $vat, $cf);
        } else {
            redirect('');
        }
    }

	// DELETE CUSTOMER //
    public function elimina()
    {
		$id = $this->input->post('id', true);
		$token = $this->input->post('token', true);

		if($_SESSION['token'] != $token) die('CSRF Attempts');
		
        $data = $this->Gestione_model->elimina_cliente($id);
        echo json_encode($data);
    }

	// GET CUSTOMER AND SEND TO AJAX FOR SHOW IT //
    public function prendi_cliente()
    {
        $id = $this->input->post('id', true);
		$data = $this->Gestione_model->trova_cliente($id);
		$token = $this->input->post('token', true);

		if($_SESSION['token'] != $token) die('CSRF Attempts');
        echo json_encode($data);
    }
}

/* End of file clienti.php */
/* Location: ./system/application/controllers/clienti.php */
