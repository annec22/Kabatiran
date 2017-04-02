<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ReportInbox extends CI_Controller {
     function __construct() {
        parent::__construct();
        $this->load->model('model_inbox');
        $this->load->model('model_logs');
    }
    
    public function index(){
        $data['inboxRes'] = $this->model_inbox->getAllReports();
        $data['trashRes'] = $this->model_inbox->getAllTrash();
        $data['spamRes'] = $this->model_inbox->getAllSpam();
        $data['confRes'] = $this->model_inbox->getAllConfirmed();
        $this->load->view('view_reports', $data);
    }
    
    function getTrash()
    {
        $string = $this->model_inbox->toStringQueryTrash();
        echo json_encode($string);
    }
    
    function getSpam()
    {
        $string = $this->model_inbox->toStringQuerySpam();
        echo json_encode($string);
    }
    
    function trashReport()
    {
        $merged = $this->input->post('mergedTrashID');
        $splitTrash = explode(",", $merged);
        foreach($splitTrash as $trashID) {
            if($trashID != NULL){
                $trashID = trim($trashID);
                $status = $this->model_inbox->getReportStatus($trashID);
                $this->model_inbox->markAsTrash($trashID, $status);
            }
        }
        
        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Report Trashing Success.";
        $loginNote = $adminWebUser . " Trashed a Report.ID: " . $merged;
        $this->model_logs->addToLog($loginAction, $loginNote);
        
        echo json_encode("Trashing Successful");
        redirect(base_url(), 'refresh');
    }
    
    function restoreReport(){
        $merged = $this->input->post('mergedRestoreID');
        $splitRestore = explode(",", $merged);

        foreach($splitRestore as $restoreID) {
            if($restoreID != NULL){
                $restoreID = trim($restoreID);
                $status = $this->model_inbox->getTrashMarker($restoreID);
                $this->model_inbox->restoreReport($restoreID, $status);
            } 
        }
        
        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Report Restoring Success.";
        $loginNote = $adminWebUser . " Restored Report/s.ID: " . $merged;
        $this->model_logs->addToLog($loginAction, $loginNote);
        
        echo json_encode("Restore Successful");
        redirect(base_url(), 'refresh');
    }
    
    function checkIfConfirmed(){
        $merged = $this->input->post('mergedConfirmedID');
        $splitConfirmed = explode(",", $merged);
        $details = "";
        foreach($splitConfirmed as $confirmedID) {
            if($confirmedID != NULL){
                $confirmedID = trim($confirmedID);
                $details .= $this->model_inbox->checkIfConfirmed($confirmedID) . "|";   
            }
        }

        echo json_encode($details);
    }
    
    function confirmReport()
    {
        $merged = $this->input->post('mergedConfirmedID');
        $id = $this->input->post('id');
        $splitConfirmed = explode(",", $merged);
        $details = "";
        foreach($splitConfirmed as $confirmedID) {
            if($confirmedID != NULL){
                $confirmedID = trim($confirmedID);
                $this->model_inbox->markAsConfirmed($confirmedID);
                $details = $this->model_inbox->getReportInformation($id);   
                
                $adminWebUser = $this->session->userdata('adminFullName');
                $loginAction = "Report confirming Success.";
                $loginNote = $adminWebUser . " confirmed a Report.ID: " . $confirmedID;
                $this->model_logs->addToLog($loginAction, $loginNote);   
            }
        }

        echo json_encode($details);
    }
    
    function spamReport()
    {
        $merged = $this->input->post('mergedSpamID');
        $splitSpam = explode(",", $merged);
        foreach($splitSpam as $spamID) {
            if($spamID != NULL){
                $spamID = trim($spamID);
                $this->model_inbox->markAsSpam($spamID);
            }
        }
     
        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Report Spam Success.";
        $loginNote = $adminWebUser . " Spamed a Report.ID: " . $merged;
        $this->model_logs->addToLog($loginAction, $loginNote);
        
        echo json_encode("Mark as Spam Successful");
        redirect(base_url(), 'refresh');
        
    }
    
    function deleteReport()
    {
        $merged = $this->input->post('mergedDeleteID');
        $splitDelete = explode(",", $merged);
        foreach($splitDelete as $deleteID) {
            if($deleteID != NULL){
                $deleteID = trim($deleteID);
                $this->model_inbox->deleteReport($deleteID);
            }
        }
        
        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Report Deleting Success.";
        $loginNote = $adminWebUser . " Deleted Report/s.";
        $this->model_logs->addToLog($loginAction, $loginNote);
        
        echo json_encode("Delete Successful");
        redirect(base_url(), 'refresh');
        
    }

    function getReport()
    {
        $id = $this->input->post('reportIndex');
        
        $getReportResult = $this->model_inbox->getReportInformation($id);
        
        echo json_encode($getReportResult);
    }
    
    
    function readReport()
    {
        $id = $this->input->post('reportIndex');
        
        $this->model_inbox->markAsRead($id);
        echo json_encode($id);
    }
    
    public function uploadReport(){
            $this->load->model("model_inbox");

            if($this->input->post()==null){
                    die;
            }

            $raw = $this->input->post();
            $this->data = json_decode($raw['json']);
            
            $apikey = $this->data->apikey;
            $inputfirstName = $this->data->inputfirstName;
            $inputmiddleName = $this->data->inputmiddleName;
            $inputlastName = $this->data->inputlastName;
            $inputProvince = $this->data->inputProvince;
            $inputMunicipality = $this->data->inputMunicipality;
            $inputBarangay = $this->data->inputBarangay;
            $inputDisaster = $this->data->inputDisaster;
            $inputDate = $this->data->inputDate;
            $inputTime = $this->data->inputTime;
            $inputDescription = $this->data->inputDescription;
            $inputAuth = $this->data->inputAuth;
            $inputMac = $this->data->inputIp;
            $inputAttach = $this->data->inputAttachment;
            date_default_timezone_set('Etc/GMT-8');
            $date = date("Y-m-d");
            $time = date("H:i:s");
            $datetime = date("Y-m-d-H-i-s");
            
            $dis = $this->model_inbox->getDisaster($inputDisaster);
            $muni = $this->model_inbox->getMunicipality($inputMunicipality);
            $prov = $this->model_inbox->getProvince($inputProvince);
            $code = $this->model_inbox->checkAuth($inputAuth);
            $bar = $this->model_inbox->getBarangay($inputBarangay);
            
            $checkResult = $this->model_inbox->checkReportContained($inputDate, $dis, $prov, $muni, $bar);
          
            if($apikey=="informapp2013"){
                if($checkResult == "P"){
                     if($inputAuth==null){
                        $data = array( "reporter"=>0,
                                       "firstName"=>$inputfirstName,
                                       "middleInitial"=>$inputmiddleName,
                                       "lastName"=>$inputlastName,
                                       "reportStatus"=>"Pending",
                                       "reportDate"=>$date,
                                       "reportTime"=>$time,
                                       "macAddress"=>$inputMac,
                                       "attachments"=>$inputAttach,
                                       "province"=>$prov,
                                       "municipality"=>$muni,
                                       "typeID"=>$dis,
                                       "incidentDate"=>$inputDate,
                                       "incidentTime"=>$inputTime,
                                       "reportDescription"=>$inputDescription,
                                       "barangay"=>$bar,
                                       "readStatus"=>"#FFFFFF",
                            );
                       }else{
                           if($code){
                           $data = array( "reporter"=>1,
                                       "firstName"=>$inputfirstName,
                                       "middleInitial"=>$inputmiddleName,
                                       "lastName"=>$inputlastName,
                                       "reportStatus"=>"Pending",
                                       "reportDate"=>$date,
                                       "reportTime"=>$time,
                                       "macAddress"=>$inputMac,
                                       "attachments"=>$inputAttach,
                                       "province"=>$prov,
                                       "municipality"=>$muni,
                                       "typeID"=>$dis,
                                       "incidentDate"=>$inputDate,
                                       "incidentTime"=>$inputTime,
                                       "reportDescription"=>$inputDescription,
                                       "authenticationCode"=>$inputAuth,
                                       "barangay"=>$bar,
                                       "readStatus"=>"#FFFFFF",
                            );
                           }else{
                               $data = array( "reporter"=>0,
                                       "firstName"=>$inputfirstName,
                                       "middleInitial"=>$inputmiddleName,
                                       "lastName"=>$inputlastName,
                                       "reportStatus"=>"Pending",
                                       "reportDate"=>$date,
                                       "reportTime"=>$time,
                                       "macAddress"=>$inputMac,
                                       "attachments"=>$inputAttach,
                                       "province"=>$prov,
                                       "municipality"=>$muni,
                                       "typeID"=>$dis,
                                       "incidentDate"=>$inputDate,
                                       "incidentTime"=>$inputTime,
                                       "reportDescription"=>$inputDescription,
                                       "barangay"=>$bar,
                                       "readStatus"=>"#FFFFFF",
                            );
                           }
                       }
                }else{
                    if($inputAuth==null){
                        $data = array( "reporter"=>0,
                                       "firstName"=>$inputfirstName,
                                       "middleInitial"=>$inputmiddleName,
                                       "lastName"=>$inputlastName,
                                       "reportStatus"=>"Pending",
                                       "reportDate"=>$date,
                                       "reportTime"=>$time,
                                       "macAddress"=>$inputMac,
                                       "attachments"=>$inputAttach,
                                       "province"=>$prov,
                                       "municipality"=>$muni,
                                       "typeID"=>$dis,
                                       "incidentDate"=>$inputDate,
                                       "incidentTime"=>$inputTime,
                                       "reportDescription"=>$inputDescription,
                                       "barangay"=>$bar,
                                       "readStatus"=>"#FFFFFF",
                            );
                       }else{
                           if($code){
                           $data = array( "reporter"=>1,
                                       "firstName"=>$inputfirstName,
                                       "middleInitial"=>$inputmiddleName,
                                       "lastName"=>$inputlastName,
                                       "reportStatus"=>"Pending",
                                       "reportDate"=>$date,
                                       "reportTime"=>$time,
                                       "macAddress"=>$inputMac,
                                       "attachments"=>$inputAttach,
                                       "province"=>$prov,
                                       "municipality"=>$muni,
                                       "typeID"=>$dis,
                                       "incidentDate"=>$inputDate,
                                       "incidentTime"=>$inputTime,
                                       "reportDescription"=>$inputDescription,
                                       "authenticationCode"=>$inputAuth,
                                       "barangay"=>$bar,
                                       "readStatus"=>"#FFFFFF",
                            );
                           }else{
                               $data = array( "reporter"=>0,
                                       "firstName"=>$inputfirstName,
                                       "middleInitial"=>$inputmiddleName,
                                       "lastName"=>$inputlastName,
                                       "reportStatus"=>"Pending",
                                       "reportDate"=>$date,
                                       "reportTime"=>$time,
                                       "macAddress"=>$inputMac,
                                       "attachments"=>$inputAttach,
                                       "province"=>$prov,
                                       "municipality"=>$muni,
                                       "typeID"=>$dis,
                                       "incidentDate"=>$inputDate,
                                       "incidentTime"=>$inputTime,
                                       "reportDescription"=>$inputDescription,
                                       "barangay"=>$bar,
                                       "readStatus"=>"#FFFFFF",
                            );
                           }
                       }
                }
                $this->model_inbox->storeReport($data);
            }
            
            echo $apikey.",".$inputfirstName.",".$inputmiddleName.",".$inputlastName.",".$inputProvince.",".
                    $inputMunicipality.",".$inputBarangay.",".$inputDisaster.",".$inputDate
                    .",".$inputTime.",".$inputDescription.",".$inputAuth;
        }

        
        public function uploadImage() {
            date_default_timezone_set('Etc/GMT-8');
            $datetime = date("Y-m-d-H-i-s");
            $file_path = "uploads/images/";
            
            $file_path = $file_path .basename( $_FILES['uploaded_file']['name'] );
            if(move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $file_path)) {
                echo "success";
            }else{
                echo "fail";
            }
	}
        
       

}

?>