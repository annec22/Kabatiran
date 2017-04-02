<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bulletin extends CI_Controller {
     function __construct() {
        parent::__construct();
        $this->load->model('model_bulletin');
        $this->load->model('model_logs');
        $this->load->helper('date');
    }
    
    public function index(){
        if ($this->session->userdata('adminAccess') && $this->session->userdata('adminAccess') == "adminInformapp") {
            $data['show'] = $this->model_bulletin->getAllPosts();
            $this->load->view('view_facebook', $data);
        } else {
            $data["errorAdminLogin"] = FALSE;
            $this->load->view('adminLogin_view', $data);
        }        
    }
    
    public function getServerDateTime(){
        date_default_timezone_set('Etc/GMT-8');
        $date = date("Y-m-d H:i:s");
        echo json_encode($date);
    }
    
    function addPost()
    {
        $post = array(
            'bulletinID' => 0,
            'postMsg' => $this->input->post('bullTxt'),
            'postdate' => $this->input->post('date'),
            'province' => $this->input->post('province'),
        );	

        $id = $this->model_bulletin->addBulletinPost($post);
        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Post adding Success.";
        $loginNote = $adminWebUser . " added a Post.";
        $this->model_logs->addToLog($loginAction, $loginNote);
        echo json_encode($id);
    
    }
    
    function deleteBulletin()
    {
        $merged = $this->input->post('mergedDeleteID');
        $splitDelete = explode(",", $merged);
        foreach($splitDelete as $deleteID) {
            $deleteID = trim($deleteID);
            $this->model_bulletin->deleteBulletin($deleteID);
        }
        
        $adminWebUser = $this->session->userdata('adminFullName');
        $loginAction = "Bulletin post Deleting Success.";
        $loginNote = $adminWebUser . " Deleted a Bulletin Post.ID: " . $merged;
        $this->model_logs->addToLog($loginAction, $loginNote);
        
        echo json_encode("Delete Successful");
        redirect(base_url(), 'refresh');
        
    }
    
    function tweetPost(){
	require_once('twitteroauth.php');
	$consumerKey = 'jwYFo7heUZS33aRAaFdeA';
	$consumerSecret = 'fuXtXxWPaLRCSYh6NDWAaOm8NkL46twUSweXqiwZOHc';
	$accessToken = '2174285682-4CjNCxIG0mVxYIocYpEhIOnW5hVwNEYnel8vDwP';
	$accessTokenSecret = 'virLsIgdKFjt9xQMrvaF100V5NTN5cKEH0WpC683GWHi6';
        $tweet = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);
	if (isset($_POST['bullTxt']))    
	{
            $bullTxt=$_POST['bullTxt']; 
            $tweetMessage = $bullTxt;
            if(strlen($tweetMessage) <= 140)
            {
                $tweet->post('statuses/update', array('status' => $tweetMessage));
            }
            echo "Tweet Posted";
        }else{
            echo "Tweet Failed";
        }
    }
    public function getbulletinUpdate() {
        if ($this->input->post() == null) {
            die;
        }
        $raw = $this->input->post();
        $this->data = json_decode($raw['json']);

        $apikey = $this->data->apikey;

        $data = $this->model_bulletin->getAllPosts();
        $text = "none";
        if($data!=null){
            foreach ($data as $x) {
                $text = $text . $x->postMsg . "," . $x->postdate . "|";
            }
        }
        echo $text;
    }
    
}

?>
