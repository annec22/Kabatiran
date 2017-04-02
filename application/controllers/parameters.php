<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Parameters extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('model_parameter');
        $this->load->model('model_logs');
        $this->load->helper('date');
        $this->load->helper('url');
    }
    function do_upload() {
        $config['upload_path'] = './images/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);
                $this->upload->overwrite = true;
		if ( ! $this->upload->do_upload())
		{
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
		}
    }
    function genCode() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $value = '';
        for ($i = 0; $i < 8; $i++) {
            $value .= $characters[rand(0, strlen($characters) - 1)];
        }
        $authentication = array(
            'authenticationCode' => $value,
            'agencyID' => $this->input->post('agencyID'),
            'authenticationID' => $this->input->post('id')
        );
        $result = $this->model_parameter->genCode($authentication);
        
         //email data declaration
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com';
        $config['smtp_port'] = 465;
        $config['smtp_user'] = 'kabatiranapp@gmail.com';
        $config['smtp_pass'] = 'PapapiZZaNaYan345';
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;

        $CI = & get_instance();
        $CI->load->library('email');
        $CI->email->initialize($config);

        //Send the mail to the user's email address
        if (!($this->input->post('email') == "" || $this->input->post('email') == null)) {
            
            $this->email->set_newline("\r\n");
            $this->email->from('Administrator');
            $this->email->to($this->input->post('email'));

            $this->email->subject("Your Authentication Code");
            $this->email->message('Your new authentication code is ' . $value);
            $this->email->send();
        }
        
        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Generating authentication code success.";
        $loginNote = $adminWebUser . " generated an authentication code.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function pAddProv() {
        $province = array(
            'provinceID' => $this->input->post('id'),
            'province' => $this->input->post('provinceName'),
        );
        if ($this->input->post('provinceName') != 0 || $this->input->post('provinceName') != "") {
            $result = $this->model_parameter->addProvinces($province);
            $adminWebUser = $this->session->userdata('adminFullName');
            $loginAction = "Province adding Success.";
            $loginNote = $adminWebUser . " added a province.";
            $this->model_logs->addToLog($loginAction, $loginNote);
            echo json_encode($result);
        } else {
            echo 'Empty string is not allowed for the province name';
        }
    }

    function pAddMun() {
        $munCity = array(
            'muniCityID' => $this->input->post('id'),
            'name' => $this->input->post('cityMunName'),
            'provinceID' => $this->input->post('munProvID'),
        );

        $result = $this->model_parameter->addMCities($munCity);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Municipality adding Success.";
        $loginNote = $adminWebUser . " added a municipality.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function pAddBrgy() {
        $barangay = array(
            'idbarangay' => $this->input->post('id'),
            'munCityID' => $this->input->post('munCity'),
            'x' => $this->input->post('xCoordinate'),
            'y' => $this->input->post('yCoordinate'),
            'name' => $this->input->post('brgyName'),
        );

        $result = $this->model_parameter->addBrgy($barangay);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Barangay adding Success.";
        $loginNote = $adminWebUser . " added a barangay.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function pAddCat() {
        $category = array(
            'categoryID' => $this->input->post('id'),
            'category' => $this->input->post('category'),
        );

        $result = $this->model_parameter->addCategories($category);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Category adding Success.";
        $loginNote = $adminWebUser . " added a category.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function pAddEType() {
        $eType = array(
            'esTypeID' => $this->input->post('id'),
            'classification' => $this->input->post('eType'),
        );

        $result = $this->model_parameter->addEstTypes($eType);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Establishment type adding Success.";
        $loginNote = $adminWebUser . " added an Establishment Type.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function pAddAgency() {
        $agency = array(
            'address' => $this->input->post('address'),
            'agencyID' => $this->input->post('id'),
            'agencyName' => $this->input->post('agencyName'),
            'categoryID' => $this->input->post('category'),
            'council_member' => $this->input->post('cMember'),
            'emailAdd' => $this->input->post('email'),
            'municipality' => $this->input->post('munCity'),
            'province' => $this->input->post('province'),
            'barangay' => $this->input->post('barangay')
        );

        $result = $this->model_parameter->addAgencies($agency);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Agency adding Success.";
        $loginNote = $adminWebUser . " added an Agency.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function pAddLocation() {
        $location = array(
            'locationID' => $this->input->post('locationID'),
            'muniCityID' => $this->input->post('muniCityID'),
            'barangay' => $this->input->post('brgy'),
            'x' => $this->input->post('xCoordinate'),
            'y' => $this->input->post('yCoordinate')
        );

        $result = $this->model_parameter->addLocation($location);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Location adding Success.";
        $loginNote = $adminWebUser . " added a Location.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function pAddEOffice() {
        $estabOffice = array(
            'agencyID' => $this->input->post('agencyID'),
            'description' => $this->input->post('description'),
            'establishmentID' => $this->input->post('establishmentID'),
            'esTypeID' => $this->input->post('esTypeID'),
            'locationID' => $this->input->post('locationID'),
            'name' => $this->input->post('name'),
        );

        $result = $this->model_parameter->addEOffice($estabOffice);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Establishment Office adding Success.";
        $loginNote = $adminWebUser . " added an Establishment Office.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function pAddDirectory() {
        $directory = array(
            'establishmentID' => $this->input->post('estabID'),
            'contactNo' => $this->input->post('contact'),
            'specifics' => $this->input->post('specifics'),
            'agencyID' => $this->input->post('agencyID'),
        );

        $result = $this->model_parameter->addDirectory($directory);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Directory adding Success.";
        $loginNote = $adminWebUser . " added a Directory.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function pAddAccidentType() {
        $accidentType = array(
            'typeID' => $this->input->post('id'),
            'classification' => $this->input->post('accidentType'),
        );

        $result = $this->model_parameter->AddAccidentType($accidentType);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Accident type adding Success.";
        $loginNote = $adminWebUser . " added an accident type.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    /*
     * Controller functions for deleting data in the database
     */
    function deleteContactLoc(){
        $id = $this->input->post('id');
        $result = $this->model_parameter->deleteContactLoc($id);
        echo json_encode($result);
    }
    function deleteContactEstab(){
        $id = $this->input->post('id');
        $result = $this->model_parameter->deleteContactLoc($id);
        echo json_encode($result);
    }
    function deleteProv() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->deleteProv($id);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Province deleting Success.";
        $loginNote = $adminWebUser . " deleted a Province.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function deleteMun() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->deleteMun($id);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Municipality deleting Success.";
        $loginNote = $adminWebUser . " deleted a Municipality.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function deleteBrgy() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->deleteBrgy($id);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Barangay Deletion Success.";
        $loginNote = $adminWebUser . " deleted a Barangay.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function deleteLocation() {
        $id = $this->input->post('locationID');
        $result = $this->model_parameter->deleteLocation($id);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Location deletion Success.";
        $loginNote = $adminWebUser . " deleted a Location.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function deleteEstabOffice() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->deleteEstabOffice($id);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Establishment deletion Success.";
        $loginNote = $adminWebUser . " deleted an Establishment.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function deleteEstab() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->deleteEstab($id);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Establishment deletion Success.";
        $loginNote = $adminWebUser . " deleted an Establishment.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function deleteDirectory() {
        $id = $this->input->post('directoryID');
        $result = $this->model_parameter->deleteDirectory($id);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Directory deletion Success.";
        $loginNote = $adminWebUser . " deleted a directory.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function deleteCategory() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->deleteCategory($id);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Category deletion Success.";
        $loginNote = $adminWebUser . " deleted a Category.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function deleteAgency() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->deleteAgency($id);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Agency deletion Success.";
        $loginNote = $adminWebUser . " deleted an Agency.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }

    function deleteAccidentType() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->deleteAccidentType($id);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Accident type deleting Success.";
        $loginNote = $adminWebUser . " deleted an Accident type.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($result);
    }        

    function getProv() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->getProvInfo($id);
        echo json_encode($result);
    }

    function getMun() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->getMunInfo($id);
        echo json_encode($result);
    }

    function getBrgy() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->getBrgyInfo($id);
        echo json_encode($result);
    }

    function getEstab() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->getEstabInfo($id);
        echo json_encode($result);
    }

    function getCat() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->getCatInfo($id);
        echo json_encode($result);
    }

    function getAgency() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->getAgencyInfo($id);
        echo json_encode($result);
    }
    
    function getEstabO() {
        $id = $this->input->post('estabID');
        $result = $this->model_parameter->getEstabOInfo($id);
        echo json_encode($result);
    }

    function getContact() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->getContactInfo($id);
        echo json_encode($result);
    }

    function getAccidentType() {
        $id = $this->input->post('id');
        $result = $this->model_parameter->getAccidentTypeInfo($id);
        echo json_encode($result);
    }

    function editProv() {
        $id = $this->input->post('id');
        $province = array(
            'provinceID' => $id,
            'province' => $this->input->post('province')
        );
        $data = $this->model_parameter->editProv($id, $province);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Province editing Success.";
        $loginNote = $adminWebUser . " edited a Province.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($data);
    }

    function editMun() {
        $id = $this->input->post('id');
        $municipality = array(
            'muniCityID' => $id,
            'name' => $this->input->post('name')
        );
        $data = $this->model_parameter->editMun($id, $municipality);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Municipality Editing Success.";
        $loginNote = $adminWebUser . " edited a Municipality.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($data);
    }

    function editBrgy() {
        $id = $this->input->post('id');
        $barangay = array(
            'idbarangay' => $id,
            'name' => $this->input->post('name'),
            'x' => $this->input->post('x'),
            'y' => $this->input->post('y')
        );
        $data = $this->model_parameter->editBrgy($id, $barangay);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Barangay Editing Success.";
        $loginNote = $adminWebUser . " edited a Barangay.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($data);
    }

    function editEstab() {
        $id = $this->input->post('id');
        $estabType = array(
            'esTypeID' => $id,
            'classification' => $this->input->post('classification')
        );
        $data = $this->model_parameter->editEstab($id, $estabType);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Establishment Editing Success.";
        $loginNote = $adminWebUser . " edited an Establishment.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($data);
    }

    function editCat() {
        $id = $this->input->post('id');
        $category = array(
            'categoryID' => $id,
            'category' => $this->input->post('category')
        );
        $data = $this->model_parameter->editCat($id, $category);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Category Editing Success.";
        $loginNote = $adminWebUser . " edited a Category.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($data);
    }

    function editAgency() {
        $id = $this->input->post('agencyID');
        $agency = array(
            'agencyID' => $id,
            'agencyName' => $this->input->post('agencyName'),
            'address' => $this->input->post('address'),
            'categoryID' => $this->input->post('categoryID'),
            'council_member' => $this->input->post('council_member'),
            'emailAdd' => $this->input->post('emailAdd'),
            'municipality' => $this->input->post('municipality'),
            'province' => $this->input->post('province'),
            'barangay' => $this->input->post('barangay'),
        );
        $data = $this->model_parameter->editAgency($id, $agency);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Agency Editing Success.";
        $loginNote = $adminWebUser . " edited an Agency.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($data);
    }

    function editLocation() {
        $id = $this->input->post('locationID');
        $location = array(
            'locationID' => $id,
            'barangay' => $this->input->post('brgy'),
            'muniCityID' => $this->input->post('muniCityID'),
            'x' => $this->input->post('xCoordinate'),
            'y' => $this->input->post('yCoordinate'),
        );
        $data = $this->model_parameter->editLocation($id, $location);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Location Editing Success.";
        $loginNote = $adminWebUser . " edited a Location.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($data);
    }

    function editEOffice() {
        $id = $this->input->post('establishmentID');
        $eOffice = array(
            'agencyID' => $this->input->post('agencyID'),
            'description' => $this->input->post('description'),
            'establishmentID' => $id,
            'esTypeID' => $this->input->post('esTypeID'),
            'locationID' => $this->input->post('locationID'),
            'name' => $this->input->post('name'),
        );
        $data = $this->model_parameter->editEOffice($id, $eOffice);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Establishment Office Editing Success.";
        $loginNote = $adminWebUser . " edited an Establishment Office.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($data);
    }

    function editDirectory() {
        $id = $this->input->post('directoryID');
        $directory = array(
            'directoryID' => $id,
            'contactNo' => $this->input->post('contactNo'),
            'establishmentID' => $this->input->post('establishmentID'),
            'specifics' => $this->input->post('specifics'),
        );
        $data = $this->model_parameter->editDirectory($id, $directory);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Directory Editing Success.";
        $loginNote = $adminWebUser . " edited a Directory.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($data);
    }

    function editAccidentType() {
        $id = $this->input->post('id');
        $accidentType = array(
            'typeID' => $id,
            'classification' => $this->input->post('accidentType'),
            'color' => $this->input->post('color'),
            'userfile' => $this->input->post('userfile')
        );
        $data = $this->model_parameter->editAccidentType($id, $accidentType);

        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Accident type editing Success.";
        $loginNote = $adminWebUser . " edited an Accident type.";
        $this->model_logs->addToLog($loginAction, $loginNote);

        echo json_encode($data);
    }
    function exportContacts(){
        $data = $this->model_parameter->exportContacts();       
        echo true;
    }
    function getProbContacts(){
        $data = $this->model_parameter->fetchProbContacts();
        echo json_encode($data);
    }    
    function getFMun() {
        $provinceID = $this->input->post("provinceID");
        $data = $this->model_parameter->getFMun($provinceID);
        echo json_encode($data);
    }

    function getFBrgy() {
        $munCityID = $this->input->post("munCityID");
        $data = $this->model_parameter->getFBrgy($munCityID);
        echo json_encode($data);
    }
    
    function getFAgency() {
        $categoryID = $this->input->post("categoryID");
        $data = $this->model_parameter->getFAgency($categoryID);
        echo json_encode($data);
    }

    /*
     * gcm
     */

    function subscribeUser() {
        $userSub = array(
            "regID" => $this->input->post("regId"),
            "newsSub" => 2,
            "provFilter" => $this->input->post("name"),
            "munFilter" => $this->input->post("email"),
        );
        $this->model_parameter->subscribeUser($userSub);
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $this->input->post("regId"),
            'data' => "Subscription successful"
        );
        $headers = array(
            'Authorization: key="AIzaSyDCMHNl0VzAUm7i0mkLvUymQMNxA8kC270"',
            'Content-Type: application/json'
        );
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
    }

    function sendNotification() {
        $regID = $this->input->post("regID");
        $message = $this->input->post("message");
        $url = 'https://android.googleapis.com/gcm/send';
        $fields = array(
            'registration_ids' => $regID,
            'data' => $message
        );
        $headers = array(
            'Authorization: key="AIzaSyDCMHNl0VzAUm7i0mkLvUymQMNxA8kC270"',
            'Content-Type: application/json'
        );
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }
        // Close connection
        curl_close($ch);
    }

}

?>
