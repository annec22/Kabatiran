<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_logs extends CI_Model 
{

    function __construct() 
    {
        parent::__construct();
        $this->load->helper('date');
    }

    public function getAllLogs()
    {
        $queryResult = $this->db->query("SELECT * FROM log ORDER BY DatePerformed DESC LIMIT 400;");
        if($queryResult->num_rows() > 0)
        {
            foreach($queryResult->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function addtoLog($action,$notes)
    {
        date_default_timezone_set('Etc/GMT-8');
        $date = date("Y-m-d H:i:s");
        $ip = $_SERVER["REMOTE_ADDR"];
        
        $log = array(
            'DatePerformed' => $date,
            'IPAddress' => $ip,
            'action' => $action,
            'logNotes' => $notes);

        $this->db->insert('log', $log); 
    }
    
    function deleteLog($id)
    {
        $this->db->delete('log', array('logID' => $id)); 
    }
}