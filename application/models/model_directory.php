<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * MODEL DIRECTORY
 *
 * @package             SEO ICE CREAM
 * @subpackage          
 * @category            RM/PM/ADMIN
 * @author              Brian Taccayan
 * @link                http://www.seoicecream.com
 */
class Model_directory extends CI_Model 
{

    function __construct() 
    {
        parent::__construct();
    }
    
    /**
     * Gets all the data from the sys_lu_reporting_countries table 
     *
     * @access      public
     * @param       string
     * @return      string
     */
    public function getAllDir()
    {
        $queryResult = $this->db->query("SELECT * FROM directory;");
        if($queryResult->num_rows() > 0)
        {
            foreach($queryResult->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    /**
     * Adds new reporting country to the database 
     *
     * @access      public
     * @param       string
     * @return      string
     */
    function addDirectory($directory)
    {
        $this->db->insert('directory', $directory);
        return $this->db->insert_id();
    }
    
    /**
     * Edits a reporting country
     *
     * @access      public
     * @param       string
     * @return       string
     */
    function editDirectory($id, $directory)
    {
        $this->db->where("agencyID", $id);
        $result = $this->db->update("directory", $directory);
        return $result;
    }
    
    /**
     * Deletes a reporting country
     *
     * @access      public
     * @param       string
     * @return       string
     */
    function deleteDirectory($id)
    {
        $this->db->where('agencyID', $id);
        return $this->db->delete('directory'); 
    }
    
    function getDirectoryInformation($id)
    {
        return $this->db->query("SELECT * FROM directory 
                    WHERE agencyID = $id;")->result_array();
    }
    
    function getAgency()
    {
        $dirAgency = $this->db->query("SELECT * FROM agency");
        if($dirAgency->num_rows() > 0)
        {
            foreach($dirAgency->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
}
?>