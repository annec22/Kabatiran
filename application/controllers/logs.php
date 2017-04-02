<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Logs extends CI_Controller {
    public function __construct() 
    {
        parent:: __construct();
        $this->load->model('model_logs');
    }
    
    function index(){
         if($this->session->userdata('adminAccess') && $this->session->userdata('adminAccess') == "adminInformapp"){
            $data['show'] = $this->sys_log_model->getAllLogs();
            $this->load->view('view_logs', $data);
         }else{
            $data["errorAdminLogin"] = FALSE;
            $this->load->view('adminLogin_view',$data);
         }
    }
    
    function deleteLog()
    {
        $merged = $this->input->post('mergedDeleteID');
        $splitDelete = explode(",", $merged);
        foreach($splitDelete as $deleteID) {
            $deleteID = trim($deleteID);
            $this->model_logs->deleteLog($deleteID);
        }
        
        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Log Deleting Success.";
        $loginNote = $adminWebUser . " Deleted a Log.ID: " . $merged;
        $this->model_logs->addToLog($loginAction, $loginNote);
        
        echo json_encode("Delete Successful");
        redirect(base_url(), 'refresh');
        
    }
}
?>
