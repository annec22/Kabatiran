<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_bulletin extends CI_Model 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->helper('date');
    }

    public function getAllPosts()
    {
        $query = $this->db->query('SELECT * FROM bulletin ORDER BY postdate DESC;');
        if($query->first_row()!=null){
            return $query->result();
        }else{
            return null;
        }
    }

    function addBulletinPost($post)
    {
        $this->db->insert('bulletin', $post);
        return $this->db->insert_id();
    }
    
    function deleteBulletin($id)
    {
        $this->db->delete('bulletin', array('bulletinID' => $id)); 
    }
}
?>
