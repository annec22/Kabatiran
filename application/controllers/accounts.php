<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accounts extends CI_Controller {
     function __construct() {
        parent::__construct();
        $this->load->model('model_account');
        $this->load->model('model_logs');
        $this->load->helper('date');

    }
    
    public function index(){
        if ($this->session->userdata('adminAccess') && $this->session->userdata('adminAccess') == "adminInformapp") {
            $data['show'] = $this->model_account->getAllAcc();
            $this->load->view('view_accounts', $data);
        } else {
            $data["errorAdminLogin"] = FALSE;
            $this->load->view('adminLogin_view', $data);
        }           
    }
    
    function getAdminID(){
        $id = $this->session->userdata('adminID');
        echo json_encode($id);
    }
    
    function checkAcc(){
        $id = $this->session->userdata('adminID');
        $res = $this->model_account->checkAccount($id);
        echo json_encode($res);
    }
    
    function destroySession(){
        $id = $this->session->userdata('adminID');
        echo json_encode($id);
    }
    
    function addAcc()
    {
        //Generates 8 random character string
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $value = '';
            for ($i = 0; $i < 8; $i++) {
             $value = $value . $characters[rand(0, strlen($characters) - 1)];
            }    
            $password = md5($value);
            $account = array(
                'accID' => $this->input->post('id'),
                'firstName' => $this->input->post('fname'),
                'middleName' => $this->input->post('init'),
                'lastName' => $this->input->post('lname'),
                'emailAdd' => $this->input->post('email'),
                'username' => $this->input->post('uname'),
                'password' =>  $password,
                'accType' => $this->input->post('type'),
            );	
           
            $id = $this->model_account->addAccount($account);
            
            date_default_timezone_set('Etc/GMT-8');
        
        
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

            $this->email->subject("Your Account's Password");
            $this->email->message('The password of ' . $this->input->post('uname') . ' has been successfully sent!' . "<br/>" .
                    'Your new password is: ' . "<b>" . $value . "</b>");
            $this->email->send();
        }
            $adminWebUser = $this->session->userdata('adminFullName');
            $loginAction = "Account adding Success.";
            $loginNote = $adminWebUser . " added an account.";
            $this->model_logs->addToLog($loginAction, $loginNote);
            echo json_encode($id);
    }
    
     
    
     /**
     * Function for the reset of a user's password and sending of email
     *
     * @access      public
     * @param       none
     * @return      none
     */
    
    function resetPw() {
        date_default_timezone_set('Etc/GMT-8');
        $id = $this->input->post('id');
        $uname = $this->input->post('user');
        $email = $this->input->post('email');
        
        
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


        //Generates 8 random character string
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $value = '';
        for ($i = 0; $i < 8; $i++) {
            $value .= $characters[rand(0, strlen($characters) - 1)];
        }
        //Send the mail to the user's email address
        if (!($email == "" || $email == null)) {
            //Sets password in database
            $this->model_account->doAccReset($id, $value, $uname);
            
            $this->email->set_newline("\r\n");
            $this->email->from('Administrator');
            $this->email->to($email);

            $this->email->subject('Password Reset');
            $this->email->message('The password of ' . $uname . ' has been successfully reset!' . "<br/>" .
                    'Your new password is: ' . "<b>" . $value . "</b>");
            $this->email->send();
        }
        
        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Password reset Success.";
        $loginNote = $adminWebUser . " reset the password of " .$uname . ".";
        $this->model_logs->addToLog($loginAction, $loginNote);
    }

    
    /**
     * Deletes a client default from the database 
     *
     * @access      public
     * @param       string
     * @return      string
     */
    function deleteAcc()
    {
        $id = $this->input->post('id');
        $user = $this->input->post('user');
        $result = $this->model_account->deleteAccount($id);
        
        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Account deletion Success.";
        $loginNote = $adminWebUser . " deleted". $user ."'s account.";
        $this->model_logs->addToLog($loginAction, $loginNote);
            
        echo json_encode($result);
        
    }
    
    /**
     * Deletes a client default from the database 
     *
     * @access      public
     * @param       
     * @return      string
     */
    function getAcc()
    {
        $id = $this->input->post('adminID');
        
        $result = $this->model_account->getAccountInformation($id);
        
        echo json_encode($result);
    }
    
    function editAcc()
    {
        $id = $this->input->post('id');
        $firstName = $this->input->post('fname');
        $middleName = $this->input->post('init');
        $lastName = $this->input->post('lname');
        $emailAdd = $this->input->post('email');
        $username = $this->input->post('uname');
        $accType = $this->input->post('type');
      
        $this->model_account->editAccount($id,$firstName, $middleName, $lastName, $emailAdd, $username, $accType);
        echo json_encode($id);
    }
    
    function changePassword()
    {
        $id = $this->input->post("cpuserid");
        $password = $this->input->post("oldPassword");
        $newPass = $this->input->post("newPassword");
        $rePass = $this->input->post("rePassword");
        
        $oldPw = $this->model_account->checkOldPw($id,$password);
        $newPw = $this->model_account->checkNewPw($newPass,$rePass);

        if($oldPw == 0){    
            echo json_encode("Old Password doesn't match with our existing record.");  
        }else if($newPw == 0){
            echo json_encode("New Password and Confirm Password do not match.");
        }else if($oldPw == 1 && $newPw == 1){
            $this->model_account->updatePw($id,$newPass);
            $adminWebUser = $this->session->userdata('adminFullName');
            
            $loginAction = "Change Password Success.";
            $loginNote = "User ID:" . $id . " has changed his or her password.";
            $this->model_logs->addToLog($loginAction, $loginNote);
            echo json_encode("Password Successfully Updated");
        }        
    }

    function ifUsernameExist(){
        $user = $this->input->post("username");
        $result = $this->model_account->checkUsername($user);
        echo json_encode($result);
    }
}

?>