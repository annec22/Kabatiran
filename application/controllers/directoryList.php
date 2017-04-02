<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DirectoryList extends CI_Controller {
     function __construct() {
        parent::__construct();
        $this->load->model('model_directory');
    }
    
    public function index(){
        $data['show'] = $this->model_directory->getAllDir();
        $this->load->view('view_directory', $data);
    }
    
    function addDir()
    {
        
        $directory = array(
            'agencyID' => $this->input->post('id'),
            'contactNo' => $this->input->post('contact'),
            'specifics' => $this->input->post('specifics'),

        );	

        $id = $this->model_directory->addDirectory($directory);
        echo json_encode($id);

    }
    
    /**
     * Edits the data in the database according to the credentials entered
     *
     * @access      public
     * @param       string
     * @return       string
     */
    function editDir()
    {
           $id = $this->input->post('id');
           
           $directory = array(
               'agencyID' => $id,
               'contactNo' => $this->input->post('contact'),
               'specifics' => $this->input->post('specific'),
               
           );

           $data = $this->model_directory->editDirectory($id, $directory);
           echo json_encode($data);
    }
    
    /**
     * Deletes a client default from the database 
     *
     * @access      public
     * @param       string
     * @return      string
     */
    function deleteDir()
    {
        $id = $this->input->post('id');
        
        $result = $this->model_directory->deleteDirectory($id);
        echo json_encode($result);
    }
    
    /**
     * Deletes a client default from the database 
     *
     * @access      public
     * @param       
     * @return      string
     */
    function getDir()
    {
        $id = $this->input->post('id');
        
        $result = $this->model_directory->getDirectoryInformation($id);
        
        echo json_encode($result);
    }
    
    function getAgcy()
    {
        $result = $this->model_directory->getAgency();
        
        echo json_encode($result);
    }

}

?>