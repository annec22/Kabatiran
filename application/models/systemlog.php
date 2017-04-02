<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * SystemLog
 *
 * @package             SEO ICE CREAM
 * @subpackage          
 * @category            ADMIN
 * @author              Luigi-John D. Canosa
 * @link                http://www.seoicecream.com
 */
class SystemLog extends CI_Controller {
    public function __construct() 
    {
        parent:: __construct();
        $this->load->model('model_logs');
    }
    
    function index(){
         if($this->session->userdata('adminAccess') && $this->session->userdata('adminAccess') == "adminMagicWebs"){
            $data['show'] = $this->sys_log_model->getAllSystemLog();

            $this->load->view('adminSystem_view', $data);
         }else{
            $data["errorAdminLogin"] = FALSE;
            $this->load->view('adminLogin_view',$data);
         }
    }
    
}
?>
