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
        $this->db->select('*');
        $this->db->from('users_data');
        $this->db->where('impostazioni.user_type', 'store');
        $this->db->join('impostazioni', 'users_data.user_id = impostazioni.id');
        return $this->db->count_all_results();
    }
    
    public function get_clients_list(){
        $data = array();
        $this->db->select('impostazioni.id as loginUserId, users_data.id as userId, users_data.*, impostazioni.*');
        $this->db->from('users_data');
        $this->db->join('impostazioni', 'users_data.user_id = impostazioni.id');
        $this->db->where('impostazioni.user_type', 'store');
        $this->db->order_by('users_data.id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        }
        
        $dataForJson = array();
        foreach($data as $row){
            $obj = array();
            $obj['storename'] = $row['name'];
            $obj['storecode'] = $row['store_code'];
            $obj['email'] = $row['email'];
            $obj['password'] = $row['admin_password'];
            $obj['phone'] = $row['phone'];
            $obj['address'] = $row['address'];
            $obj['actions'] = "<a  data-dismiss='modal' id='update_user' href='#manageUserModal' data-toggle='modal' data-loginUserId='".$row['loginUserId']."' data-userId='".$row['userId']."'>"
                            . "<button class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button></a>"
                            . "<a id='delete_user' data-loginUserId='".$row['loginUserId']."' data-userId='".$row['userId']."'><button class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button></a>";
            $dataForJson[] = $obj;
        }
        
        return $dataForJson;
    }
    
    public function save_store_data($store_data){
        $dataImpostArray = array(
                                'titolo' => $store_data['store_name'],
                                'lingua' => $store_data['store_name'],
                                'showcredit' => $store_data['store_name'],
                                'disclaimer' => '<hr>
In case your item turns out to be non repairable, then there will be service charge of £20.00
<hr>
<p align="center">
Please visit website for Term & Condition<br>
www.epbuys.co.uk/terms<br>
Thank you for your Visit
</p>',
                                'admin_user' => $store_data['store_email'],
                                'admin_password' => $store_data['store_password'],
                                'valuta' => 'GBP',
                                'indirizzo' => $store_data['store_address'],
                                'invoice_mail' => $store_data['store_email'],
                                'telefono' => $store_data['store_phone'],
                                'invoice_type' => 'EU',
                                'invoice_name' => $store_data['store_name'],
                                'categorie' => 'lenova apple watch tablet GPS phones PS4 HTC Laptop iPhone Computer Smartphone xbox',
                                'twilio_mode' => 'prod',
                                'prefix_number' => 44,
                                'usesms' => 2,
                                'r_apertura' => 'Hello %customer%, your order/repair for %model% was opened by %businessname%. Check the state of repair on %fixbookurl%. Status code: (%statuscode%)',
                                'r_chiusura' => 'Hello %customer%, your order/repair fo %model% has been completed, come to %businessname% for take it. Thanks for choosing us.',
                                'colore1' => '#3dc45b',
                                'colore2' => '#f27705',
                                'colore3' => '#a8a8a8',
                                'colore4' => '#d61a1a',
                                'colore5' => '#2b2b2b',
                                'colore_prim' => '#08a4cc',
                                'logo' => 'logo_nav.png?13',
                                'campi_personalizzati' => 'YTozOntpOjA7czo0OiJJTUVJIjtpOjE7czo2OiJDdXN0b20iO2k6MjtzOjg6InBhc3N3b3JkIjt9',
                                'currency_position' => 'left',
                                'email_smtp_open_text' => '',
                                'email_smtp_closed_text' => '',
                                'background_transition' => '0',
                                'timezone' => 'Europe/London',
                                'user_type' => 'store',
                           );
        $this->db->insert('impostazioni', $dataImpostArray);
        $user_id = $this->db->insert_id();
        
        $dataUsersArray = array(
                                'name' => $store_data['store_name'],
                                'address' => $store_data['store_address'],
                                'email' => $store_data['store_email'],
                                'store_code' => $store_data['store_code'],
                                'phone' => $store_data['store_phone'],
                                'user_id' => $user_id,
                          );
        $this->db->insert('users_data', $dataUsersArray);
        
        // creating tables in database 
        $query = "CREATE TABLE `store_".$user_id."_clienti` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cognome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `telefono` varchar(28) CHARACTER SET latin1 NOT NULL,
  `indirizzo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `citta` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) CHARACTER SET latin1 NOT NULL,
  `vat` varchar(60) CHARACTER SET latin1 NOT NULL,
  `cf` varchar(60) CHARACTER SET latin1 NOT NULL,
  `data` date NOT NULL,
  `commenti` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
        $this->db->query($query);
        
        $query1 = "CREATE TABLE `store_".$user_id."_oggetti` (
  `ID` int(255) NOT NULL AUTO_INCREMENT,
  `Nominativo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ID_Nominativo` int(11) NOT NULL,
  `Telefono` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sms` int(1) NOT NULL DEFAULT '0',
  `Tipo` int(1) NOT NULL,
  `Guasto` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `Categoria` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Modello` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Pezzo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Anticipo` int(11) NOT NULL,
  `Prezzo` int(255) NOT NULL,
  `dataApertura` datetime NOT NULL,
  `dataChiusura` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '3',
  `Commenti` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `codice` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `custom_field` longtext COLLATE utf8_unicode_ci NOT NULL,
  `send_email` int(11) NOT NULL,
  `email` text COLLATE utf8_unicode_ci NOT NULL,
  `engineer_code` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `engineer_status` int(11) DEFAULT NULL,
  `engineer_comments` longtext COLLATE utf8_unicode_ci,
  `signature_image` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `check_list_before` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `check_list_after` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
        $this->db->query($query1);
        return true;
    }
    
    public function get_user_data($userId){
        $data = array();
        $this->db->select('impostazioni.id as loginUserId, users_data.id as userId, users_data.*, impostazioni.*');
        $this->db->from('users_data');
        $this->db->join('impostazioni', 'users_data.user_id = impostazioni.id');
        $this->db->where('impostazioni.user_type', 'store');
        $this->db->where('users_data.id', $userId);
        $this->db->order_by('users_data.id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        }
        
        $dataForJson = array();
        foreach($data as $row){
            $dataForJson['storename'] = $row['name'];
            $dataForJson['storecode'] = $row['store_code'];
            $dataForJson['email'] = $row['email'];
            $dataForJson['password'] = $row['admin_password'];
            $dataForJson['phone'] = $row['phone'];
            $dataForJson['address'] = $row['address'];
        }
        
        return $dataForJson;
    }
    
    public function update_store_data($store_data, $userId, $loginId){
        $dataImpostArray = array(
                                'titolo' => $store_data['store_name'],
                                'lingua' => $store_data['store_name'],
                                'showcredit' => $store_data['store_name'],
                                'disclaimer' => '<hr>
In case your item turns out to be non repairable, then there will be service charge of £20.00
<hr>
<p align="center">
Please visit website for Term & Condition<br>
www.epbuys.co.uk/terms<br>
Thank you for your Visit
</p>',
                                'admin_user' => $store_data['store_email'],
                                'admin_password' => $store_data['store_password'],
                                'valuta' => 'GBP',
                                'indirizzo' => $store_data['store_address'],
                                'invoice_mail' => $store_data['store_email'],
                                'telefono' => $store_data['store_phone'],
                                'invoice_type' => 'EU',
                                'invoice_name' => $store_data['store_name'],
                                'categorie' => 'lenova apple watch tablet GPS phones PS4 HTC Laptop iPhone Computer Smartphone xbox',
                                'twilio_mode' => 'prod',
                                'prefix_number' => 44,
                                'usesms' => 2,
                                'r_apertura' => 'Hello %customer%, your order/repair for %model% was opened by %businessname%. Check the state of repair on %fixbookurl%. Status code: (%statuscode%)',
                                'r_chiusura' => 'Hello %customer%, your order/repair fo %model% has been completed, come to %businessname% for take it. Thanks for choosing us.',
                                'colore1' => '#3dc45b',
                                'colore2' => '#f27705',
                                'colore3' => '#a8a8a8',
                                'colore4' => '#d61a1a',
                                'colore5' => '#2b2b2b',
                                'colore_prim' => '#08a4cc',
                                'logo' => 'logo_nav.png?13',
                                'campi_personalizzati' => 'YTozOntpOjA7czo0OiJJTUVJIjtpOjE7czo2OiJDdXN0b20iO2k6MjtzOjg6InBhc3N3b3JkIjt9',
                                'currency_position' => 'left',
                                'email_smtp_open_text' => '',
                                'email_smtp_closed_text' => '',
                                'background_transition' => '0',
                                'timezone' => 'Europe/London',
                                'user_type' => 'store',
                           );
        $this->db->where('id', $loginId);
        $this->db->update('impostazioni', $dataImpostArray);
        
        $dataUsersArray = array(
                                'name' => $store_data['store_name'],
                                'address' => $store_data['store_address'],
                                'email' => $store_data['store_email'],
                                'store_code' => $store_data['store_code'],
                                'phone' => $store_data['store_phone'],
                                'user_id' => $loginId,
                          );
        $this->db->where('id', $userId);
        $this->db->update('users_data', $dataUsersArray);
    }
    
    public function delete_store($userId, $loginId){
        $this->db->where('id', $loginId);
        $this->db->delete('impostazioni');
        $this->db->where('id', $userId);
        $this->db->delete('users_data');
    }
    
    public function get_total_employees(){
        $this->db->select('*');
        $this->db->where('impostazioni.user_type', 'employee');
        $this->db->from('users_data');
        $this->db->join('impostazioni', 'users_data.user_id = impostazioni.id');
        return $this->db->count_all_results();
    }
    
    public function get_employees_list(){
        $data = array();
        $userId = $this->session->userdata('user_id');
        $this->db->select('impostazioni.id as loginUserId, users_data.id as userId, users_data.*, impostazioni.*');
        $this->db->from('users_data');
        $this->db->join('impostazioni', 'users_data.user_id = impostazioni.id');
        $this->db->where('impostazioni.user_type', 'employee');
        $this->db->where('impostazioni.store_id', $userId);
        $this->db->order_by('users_data.id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        }
        
        $dataForJson = array();
        foreach($data as $row){
            $obj = array();
            $obj['name'] = $row['name'];
            $obj['lastname'] = $row['lastname'];
            $obj['login'] = $row['employee_login_code'];
            $obj['email'] = $row['email'];
            $obj['phone'] = $row['phone'];
            $obj['address'] = $row['address'];
            $obj['actions'] = "<a  data-dismiss='modal' id='update_user' href='#manageEmployeeModal' data-toggle='modal' data-loginUserId='".$row['loginUserId']."' data-userId='".$row['userId']."'>"
                            . "<button class='btn btn-primary btn-xs'><i class='fa fa-pencil'></i></button></a>"
                            . "<a id='delete_user' data-loginUserId='".$row['loginUserId']."' data-userId='".$row['userId']."'><button class='btn btn-danger btn-xs'><i class='fa fa-trash-o'></i></button></a>";
            $dataForJson[] = $obj;
        }
        
        return $dataForJson;
    }
    
    public function getCurrentUserData(){
        $userId = $this->session->userdata('user_id');
        $this->db->where('id', $userId);
        $query = $this->db->get('impostazioni');
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        }
        return $data[0];
    }
    
    public function save_employee_data($store_data){
        $userData = $this->getCurrentUserData();
        $dataImpostArray = array(
                                'titolo' => $userData['titolo'],
                                'lingua' => $userData['lingua'],
                                'showcredit' => $userData['showcredit'],
                                'disclaimer' => '',
                                'admin_user' => $store_data['employee_email'],
                                'admin_password' => '',
                                'valuta' => 'GBP',
                                'indirizzo' => $store_data['employee_address'],
                                'invoice_mail' => $userData['invoice_mail'],
                                'telefono' => $userData['telefono'],
                                'invoice_type' => 'EU',
                                'invoice_name' => $userData['invoice_name'],
                                'categorie' => 'lenova apple watch tablet GPS phones PS4 HTC Laptop iPhone Computer Smartphone xbox',
                                'twilio_mode' => 'prod',
                                'prefix_number' => 44,
                                'usesms' => 2,
                                'r_apertura' => 'Hello %customer%, your order/repair for %model% was opened by %businessname%. Check the state of repair on %fixbookurl%. Status code: (%statuscode%)',
                                'r_chiusura' => 'Hello %customer%, your order/repair fo %model% has been completed, come to %businessname% for take it. Thanks for choosing us.',
                                'colore1' => '#3dc45b',
                                'colore2' => '#f27705',
                                'colore3' => '#a8a8a8',
                                'colore4' => '#d61a1a',
                                'colore5' => '#2b2b2b',
                                'colore_prim' => '#08a4cc',
                                'logo' => 'logo_nav.png?13',
                                'campi_personalizzati' => 'YTozOntpOjA7czo0OiJJTUVJIjtpOjE7czo2OiJDdXN0b20iO2k6MjtzOjg6InBhc3N3b3JkIjt9',
                                'currency_position' => 'left',
                                'email_smtp_open_text' => '',
                                'email_smtp_closed_text' => '',
                                'background_transition' => '0',
                                'timezone' => 'Europe/London',
                                'user_type' => 'employee',
                                'store_id' => $userData['id'],
                                'employee_login_code' => substr(number_format(time() * rand(),0,'',''),0,6)
                           );
        $this->db->insert('impostazioni', $dataImpostArray);
        $user_id = $this->db->insert_id();
        
        $dataUsersArray = array(
                                'name' => $store_data['employee_name'],
                                'lastname' => $store_data['employee_lastname'],
                                'address' => $store_data['employee_address'],
                                'email' => $store_data['employee_email'],
                                'phone' => $store_data['employee_phone'],
                                'user_id' => $user_id,
                          );
        $this->db->insert('users_data', $dataUsersArray);
        return true;
    }
    
    public function get_employee_data($userId){
        $data = array();
        $this->db->select('impostazioni.id as loginUserId, users_data.id as userId, users_data.*, impostazioni.*');
        $this->db->from('users_data');
        $this->db->join('impostazioni', 'users_data.user_id = impostazioni.id');
        $this->db->where('impostazioni.user_type', 'store');
        $this->db->where('users_data.id', $userId);
        $this->db->order_by('users_data.id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $data = $query->result_array();
        }
        
        $dataForJson = array();
        foreach($data as $row){
            $dataForJson['employee_name'] = $row['name'];
            $dataForJson['employee_lastname'] = $row['lastname'];
            $dataForJson['employee_logincode'] = $row['employee_login_code'];
            $dataForJson['employee_email'] = $row['email'];
            $dataForJson['employee_phone'] = $row['phone'];
            $dataForJson['employee_address'] = $row['address'];
        }
        
        return $dataForJson;
    }
    
    public function update_employee_data($store_data, $userId, $loginId){
        $userData = $this->getCurrentUserData();
        $dataImpostArray = array(
                                'titolo' => $userData['titolo'],
                                'lingua' => $userData['lingua'],
                                'showcredit' => $userData['showcredit'],
                                'disclaimer' => '',
                                'admin_user' => $store_data['employee_email'],
                                'admin_password' => '',
                                'valuta' => 'GBP',
                                'indirizzo' => $store_data['employee_address'],
                                'invoice_mail' => $userData['invoice_mail'],
                                'telefono' => $userData['telefono'],
                                'invoice_type' => 'EU',
                                'invoice_name' => $userData['invoice_name'],
                                'categorie' => 'lenova apple watch tablet GPS phones PS4 HTC Laptop iPhone Computer Smartphone xbox',
                                'twilio_mode' => 'prod',
                                'prefix_number' => 44,
                                'usesms' => 2,
                                'r_apertura' => 'Hello %customer%, your order/repair for %model% was opened by %businessname%. Check the state of repair on %fixbookurl%. Status code: (%statuscode%)',
                                'r_chiusura' => 'Hello %customer%, your order/repair fo %model% has been completed, come to %businessname% for take it. Thanks for choosing us.',
                                'colore1' => '#3dc45b',
                                'colore2' => '#f27705',
                                'colore3' => '#a8a8a8',
                                'colore4' => '#d61a1a',
                                'colore5' => '#2b2b2b',
                                'colore_prim' => '#08a4cc',
                                'logo' => 'logo_nav.png?13',
                                'campi_personalizzati' => 'YTozOntpOjA7czo0OiJJTUVJIjtpOjE7czo2OiJDdXN0b20iO2k6MjtzOjg6InBhc3N3b3JkIjt9',
                                'currency_position' => 'left',
                                'email_smtp_open_text' => '',
                                'email_smtp_closed_text' => '',
                                'background_transition' => '0',
                                'timezone' => 'Europe/London',
                                'user_type' => 'employee',
                                'store_id' => $userData['id'],
                           );
        $this->db->where('id', $loginId);
        $this->db->update('impostazioni', $dataImpostArray);
        
        $dataUsersArray = array(
                                'name' => $store_data['employee_name'],
                                'lastname' => $store_data['employee_lastname'],
                                'address' => $store_data['employee_address'],
                                'email' => $store_data['employee_email'],
                                'phone' => $store_data['employee_phone'],
                                'user_id' => $loginId,
                          );
        $this->db->where('id', $userId);
        $this->db->update('users_data', $dataUsersArray);
    }
    
    public function delete_employee($userId, $loginId){
        $this->db->where('id', $loginId);
        $this->db->delete('impostazioni');
        $this->db->where('id', $userId);
        $this->db->delete('users_data');
    }
}