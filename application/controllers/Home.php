<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Home Page
 *
 *
 * @package		FixBook
 * @category	Controller
 * @author		Luigi Verzì
*/

class Home extends CI_Controller
{
    // THE CONSTRUCTOR //
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('Login_model');
        $this->load->model('Gestione_model');
        $this->load->model('Impostazioni_model');
        $this->lang->load('global', $this->Impostazioni_model->get_lingua());
        $this->load->helper('cookie');
        $this->load->helper('language');
        $this->load->helper('download');
        $this->load->library('zip');
        $this->Impostazioni_model->gen_token();
    }

    // SHOW THE HOME PAGE //
    public function index()
    {
        $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni(true);
        $data['stile'] = $this->Impostazioni_model->get_custom_style(1);
        if ($this->session->userdata('LoggedIn')) {
            $cookie= array(
                'name'   => 'waslogged',
                'value'  => TRUE,
                'expire' => '86500',
            );
            $this->input->set_cookie($cookie);
            $data['lista'] = $this->Gestione_model->lista_oggetti();
            $data['n_ordini'] = $this->Gestione_model->conta_ordini();
            $data['n_riparazioni'] = $this->Gestione_model->conta_riparazioni();
            $data['n_clienti'] = $this->Gestione_model->conta_clienti();
            $data['lista_c'] = $this->Gestione_model->lista_clienti();
            $data['stores'] = $this->Impostazioni_model->getAllStores();
            $this->load->view('home_page', $data);
        } else {
            $this->load->view('guest_page', $data);
        }
    }

    // SHOW A INVOICE TEMPLATE //
    public function invoice($id,$tipo, $return = false)
    {
        if ($this->session->userdata('LoggedIn')) {
            $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni(true);
            $data['db'] = $this->Gestione_model->trova_oggetto($id);
            $data['cliente'] = $this->Gestione_model->trova_cliente($this->Gestione_model->id_from_name($data['db']['Nominativo']));
            $data['valuta'] = $this->Impostazioni_model->get_currency();
            $data['lingua'] = $this->Impostazioni_model->get_lingua();
            $data['storedata'] = $this->Gestione_model->getStoreData();
            if($tipo == 3){
                $data['userData'] = $this->Impostazioni_model->getUserData();
            }
            $data['stile'] = $this->Impostazioni_model->get_custom_style(1);
            if($return)
            {
                if($tipo == 1) return $this->load->view('template/invoice_template', $data, true);
                elseif ($tipo == 2) return $this->load->view('template/resoconto_template', $data, true);
                else return $this->load->view('template/print_label', $data, true);
            }
            else
            {
                if($tipo == 1) $this->load->view('template/invoice_template', $data);
                elseif ($tipo == 2) return $this->load->view('template/resoconto_template', $data);
                else  return $this->load->view('template/print_label', $data);
            }
        }
    }

    // SEND A SMS DIRECT //
    public function send_sms()
    {
        if ($this->session->userdata('LoggedIn')) 
        {
            $testo = $this->input->post('testo', true);
            $numero = $this->input->post('numero', true);
            $return = $this->Gestione_model->send_sms($numero, $testo);
            $stato = false;

            if(is_array($return)) { if($return['status'] != 'failed') $stato = true; }
            else { if($return->IsError != true) $stato = true; }

            echo json_encode(array('stato' => $stato));

        } else  redirect('');
    }
    
    // EXPORT THE ORDERS AND REPARATIONS TO XML FILE //
    public function download($page, $type = 0)
    {
        if ($this->session->userdata('LoggedIn')) 
        {
            $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni(true);

            $data['lista'] = $this->Gestione_model->lista_oggetti();
            $data['lista_c'] = $this->Gestione_model->lista_clienti();
            $data['lingua'] = $this->Impostazioni_model->get_lingua();
            $data['page'] = $page;

            if($type == 0)
            {
                $data = $this->load->view('template/download_xml', $data, true);
                $name = ($page == 1 ? lang('o_e_r_titolo') : lang('clienti')) . '.xml';
                force_download($name, $data);
            }
            else $this->load->view('template/download_xml', $data);
        } else  redirect('');
    }
    
    // SAVE THE FILE XML AND DOWNLOAD IT //
    public function salva_xml($id = null, $view = 0)
    {
        if ($this->session->userdata('LoggedIn')) 
        {
            if($id == null) $id = $this->input->post('id', true);

            $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni(true);

            $data['ordine'] = $this->Gestione_model->trova_oggetto($id);
            $data['cliente'] = $this->Gestione_model->trova_cliente($data['ordine']['ID_Nominativo']);
            $data['id'] = $id;
            if($view == 1) $this->load->view('template/download_xml', $data);
            else {
                
                $data['noheader'] = true;

                $downloads_path = realpath(FCPATH . 'downloads' . DIRECTORY_SEPARATOR);
                
                if(!is_dir($downloads_path . DIRECTORY_SEPARATOR . 'ordine_' . $id . DIRECTORY_SEPARATOR)) mkdir($downloads_path . DIRECTORY_SEPARATOR . 'ordine_' . $id . DIRECTORY_SEPARATOR, 0700);

                $zip = $downloads_path . DIRECTORY_SEPARATOR . 'ordine_' . $id . DIRECTORY_SEPARATOR . lang('xml_invoice_order') . '.zip';

                $fattura = $downloads_path . DIRECTORY_SEPARATOR . 'ordine_' . $id . DIRECTORY_SEPARATOR . lang('xml_invoice') . '.html';
                $fattura_c = $this->invoice($id,1,true);
                
                $report = $downloads_path.DIRECTORY_SEPARATOR . 'ordine_' . $id . DIRECTORY_SEPARATOR . lang('xml_report') . '.html';
                $report_c = $this->invoice($id,2,true);
                
                $visita = $downloads_path . DIRECTORY_SEPARATOR . 'ordine_' . $id . DIRECTORY_SEPARATOR . lang('xml_ordine_riparazione').'.xml';
                $visita_c = $this->load->view('template/download_xml', $data, true);

                file_put_contents($fattura, $fattura_c);
                file_put_contents($report, $report_c);
                file_put_contents($visita, $visita_c);

                $this->zip->add_data(lang('xml_ordine_riparazione') . '.xml', $visita_c);
                $this->zip->add_data(lang('xml_report') . '.html', $report_c);
                $this->zip->add_data(lang('xml_invoice') . '.html', $fattura_c);

                $this->zip->archive($zip); 
                echo site_url('home/download_xml/' . $id);

            }
        } else  redirect('');
    }
    
    // DOWNLOAD THE ZIP FILES ONLY FOR LOGGED USER //
    public function download_xml($id = null)
    {
        if ($this->session->userdata('LoggedIn')) 
        {
            $downloads_path = realpath(FCPATH.'downloads'.DIRECTORY_SEPARATOR);
            $xml_file = $downloads_path.DIRECTORY_SEPARATOR.'ordine_'.$id.DIRECTORY_SEPARATOR.lang('xml_invoice_order').'.zip';
            
            echo $xml_file;
            
            if( file_exists( $xml_file ) )
            {
                header( 'Cache-Control: public' );
                header( 'Content-Description: File Transfer' );
                header( "Content-Disposition: attachment; filename=" . lang('xml_invoice_order') . '.zip' );
                header( 'Content-Type: application/mp3' );
                header( 'Content-Transfer-Encoding: binary' );
                readfile($xml_file);
                exit;
            }
            
        } else redirect('');
    }

    // GENERATE THE JAVASCRIPT DYNAMIC FILE //
    public function js($name)
    {
        $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni(true);
        $data['valuta'] = $this->Impostazioni_model->get_currency();
        if($this->input->cookie('waslogged',true) == 1) $data['admin'] = 1;
        else $data['admin'] = 0;
        
        $this->output->set_content_type('application/javascript');
        
        $this->load->view('js/'.$name.'_js', $data);
    }

    // GENERATE THE AJAX TABLE CONTENT //
    public function ajax($table, $id_nome = null)
    {
        if ($this->session->userdata('LoggedIn')) {
            $data['impostazioni'] = $this->Impostazioni_model->lista_impostazioni(true);
            if($table == 1) 
            {
                if($id_nome == null) $data['lista'] = $this->Gestione_model->lista_oggetti();
                else $data['lista'] = $this->Gestione_model->lista_oggetti($id_nome);
            }
            else $data['lista'] = $this->Gestione_model->lista_clienti();
            $data['table'] = $table;
            $this->load->view('ajax_table_page', $data);
        } else {
            $this->load->view('login_page');
        }
    }
    // OPEN NEW ORDER //
    public function apri_ordine()
    {
        if ($this->session->userdata('LoggedIn')) {
            $nominativo = $this->Gestione_model->name_from_id($this->input->post('nominativo', true));
            $idnominativo = $this->input->post('nominativo', true);
            $telefono = $this->Gestione_model->number_from_id($idnominativo);
            $categoria = $this->input->post('categoria', true);
            $modello = $this->input->post('modello', true);
            $guasto = $this->input->post('guasto', true);
            $pezzo = $this->input->post('pezzo', true);
            $anticipo = str_replace(',', '.', $this->input->post('anticipo', true));
            $prezzo = str_replace(',', '.', $this->input->post('prezzo', true));
            $tipo = $this->input->post('tipo', true);
            $sms = $this->input->post('sms', true);
            $commenti = $this->input->post('commenti', true);
            $codice = $this->input->post('codice', true);
            $status = $this->input->post('status', true);
            $custom = $this->input->post('custom', true);
            $send_email = $this->input->post('send_email', true);
            $email = $this->Gestione_model->email_from_id($idnominativo);
            $token = $this->input->post('token', true);
            $engineer_code = $this->input->post('engineer_code', true);
            $sig_image = $this->input->post('sig_image', true);
            $sig_image_collected = $this->input->post('sig_image_collected', true);
            $checklistbefore = $this->input->post('checklistbefore', true);
            $checklistafter = $this->input->post('checklistafter', true);
            $advPaymentType = $this->input->post('adv_payment_type', true);

            if($_SESSION['token'] != $token) die('CSRF Attempts');

            $this->add_new_cat($categoria); // ADD CATEGORY IF NOT EXISTS //

            $data = $this->Gestione_model->inserisci_ordine($nominativo, $idnominativo, $telefono, $categoria, $modello, $guasto, $pezzo, $anticipo, $prezzo, $tipo, $sms, $commenti, $status, $custom, $codice, $send_email, $email, $engineer_code, $sig_image, $sig_image_collected, $advPaymentType, $checklistbefore, $checklistafter);

            echo json_encode($data);
        } else {
            redirect('');
        }
    }

    // EDIT ORDER //
    public function modifica_ordine()
    {
        if ($this->session->userdata('LoggedIn')) {
            $nominativo = $this->Gestione_model->name_from_id($this->input->post('nominativo', true));
            $idnominativo = $this->input->post('nominativo', true);
            $telefono = $this->Gestione_model->number_from_id($idnominativo);
            $categoria = $this->input->post('categoria', true);
            $modello = $this->input->post('modello', true);
            $guasto = $this->input->post('guasto', true);
            $pezzo = $this->input->post('pezzo', true);
            $anticipo = str_replace(',', '.', $this->input->post('anticipo', true));
            $prezzo = str_replace(',', '.', $this->input->post('prezzo', true));
            $tipo = $this->input->post('tipo', true);
            $id = $this->input->post('id', true);
            $sms = $this->input->post('sms', true);
            $commenti = $this->input->post('commenti', true);
            $codice = $this->input->post('codice', true);
            $status = $this->input->post('status', true);
            $custom = $this->input->post('custom', true);
            $send_email = $this->input->post('send_email', true);
            $email = $this->Gestione_model->email_from_id($idnominativo);
            $engineer_code = $this->input->post('engineer_code', true);
            $sig_image = $this->input->post('sig_image', true);
            $sig_image_collected = $this->input->post('sig_image_collected', true);
            $checklistbefore = $this->input->post('checklistbefore', true);
            $checklistafter = $this->input->post('checklistafter', true);
            $advPaymentType = $this->input->post('adv_payment_type', true);
            $token = $this->input->post('token', true);

            if($_SESSION['token'] != $token) die('CSRF Attempts');

            $this->add_new_cat($categoria); // ADD CATEGORY IF NOT EXISTS //

            echo $this->Gestione_model->salva_ordine($nominativo, $idnominativo, $telefono, $categoria, $modello, $guasto, $pezzo, $anticipo, $prezzo, $tipo, $id, $sms, $commenti, $status, $custom, $codice, $send_email, $email, $engineer_code, $sig_image, $sig_image_collected, $advPaymentType, $checklistbefore, $checklistafter);
        } else {
            redirect('');
        }
    }

    // GET AN ORDER/REPARATION FOR SHOW IT //
    public function prendi_oggetto()
    {
        $id = $this->input->post('id', true);
        $data = $this->Gestione_model->trova_oggetto($id);
        $termsCondition = $this->Gestione_model->getTermsAndConditions();
        $data['terms'] = $termsCondition;
        echo json_encode($data);
    }

    // SET THE ORDER STATUS: WORK IN PROGRESS //
    public function inriparazione()
    {
        $id = $this->input->post('id', true);
        $token = $this->input->post('token', true);

        if($_SESSION['token'] != $token) die('CSRF Attempts');

        $data = $this->Gestione_model->inriparazione_oggetto($id);
        echo json_encode($data);
    }

    // SET THE ORDER STATUS: COMPLETE //
    public function completa()
    {
        $id = $this->input->post('id', true);
        $paymentType = $this->input->post('rem_payment_type', true);
        $token = $this->input->post('token', true);

        if($_SESSION['token'] != $token) die('CSRF Attempts');

        $data = $this->Gestione_model->completa_oggetto($id, $paymentType);
        echo json_encode($data);
    }

    // SET THE ORDER STATUS: APPROVED //
    public function approva()
    {
        $id = $this->input->post('id', true);
        $token = $this->input->post('token', true);

        if($_SESSION['token'] != $token) die('CSRF Attempts');

        $data = $this->Gestione_model->approva_oggetto($id);
        echo json_encode($data);
    }

    // SET THE ORDER STATUS: TO DELIVER //
    public function daconsegnare()
    {
        $id = $this->input->post('id', true);
        $token = $this->input->post('token', true);

        if($_SESSION['token'] != $token) die('CSRF Attempts');

        $data = $this->Gestione_model->daconsegnare_oggetto($id);
        echo json_encode($data);
    }

    // DELETE AN ORDER //
    public function elimina()
    {
        $id = $this->input->post('id', true);
        $token = $this->input->post('token', true);

        if($_SESSION['token'] != $token) die('CSRF Attempts');

        $data = $this->Gestione_model->elimina_oggetto($id);
        echo json_encode($data);
    }

    // ADD NEW CAT IF NOT EXISTS //
    public function add_new_cat($cat)
    {
        $impostazioni = $this->Impostazioni_model->lista_impostazioni(true);
        $exist = 0;
        foreach(preg_split("/((\r?\n)|(\r\n?))/", $impostazioni['0']['categorie']) as $line){
            if($line == $cat) $exist = 1;
        }
        if($exist == 0) echo $this->Impostazioni_model->add_category($cat);
    }
    
    public function add_comment(){
        $id = $this->input->post('id', true);
        $type = $this->input->post('type', true);
        $comment = $this->input->post('comment', true);
        $this->Gestione_model->save_comment($id, $type, $comment);
        echo json_encode(array('status'=>'success'));
    }
    
    public function save_signature(){
        $configUpload['upload_path']    = './uploads/';                 #the folder placed in the root of project
        $configUpload['allowed_types']  = '*';       #allowed types description
        $configUpload['file_name'] = 'signature_'.time().".png";
        $this->load->library('upload', $configUpload);                  #init the upload class
        
        if(!$this->upload->do_upload('signature')){
            echo 'false'; return;
            $uploadedDetails    = $this->upload->display_errors();
        }else{
            $uploadedDetails    = $this->upload->data();    
        }
        echo $uploadedDetails['file_name'];
    }
    
    public function sent_to_engineer(){
        $id = $this->input->post('id', true);
        $this->Gestione_model->sendToEngineer($id);
    }
    
    public function get_terms(){
        $termsCondition = $this->Gestione_model->getTermsAndConditions();
        echo json_encode($termsCondition);
    }
    
    public function set_store(){
        $store_id = $this->input->post('store_id', true);
        $this->session->set_userdata('admin_selected_store', $store_id);
        echo json_encode(array('status'=>'success'));
    }
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */