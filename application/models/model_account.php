<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_account extends CI_Model 
{

    function __construct() 
    {
        parent::__construct();
    }
    
    public function getAllAcc()
    {
        $queryResult = $this->db->query("SELECT * FROM account;");
        if($queryResult->num_rows() > 0)
        {
            foreach($queryResult->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    function addAccount($data)
    {
        $this->db->insert('account', $data);
        return $this->db->insert_id();
    }
    
    function doAccReset($id, $val, $username) {
        $this->db->query('UPDATE account SET password="' . md5($val) . '" WHERE accID="' . $id . '";');
    }
    
    function editAccount($id,$fName, $mName, $lName, $eAdd, $uName, $accType)
    {
        $this->db->query('UPDATE account SET firstName="' . $fName . '", middleName ="'.$mName.'", lastName="'.$lName.'", 
                        emailAdd="'.$eAdd.'", username="'.$uName.'", accType="'.$accType.'" WHERE accID="' . $id . '";');
    }
    
    function deleteAccount($id)
    {
        $this->db->where('accID', $id);
        return $this->db->delete('account'); 
    }
    
    function getAccountInformation($id)
    {
        $qry  = $this->db->query("SELECT * FROM account 
                    WHERE accID = $id;")->row();
        return $qry->firstName ."|".
               $qry->middleName ."|".
               $qry->lastName ."|".
               $qry->emailAdd ."|".
               $qry->username ."|".
               $qry->accType ."|";
    }
    
    public function checkAccountUser($data){
        return $this->db->query("Select username from account WHERE BINARY username='".$data."';")->result();
    }
    
    public function getAccountID($data){
        return $this->db->query("Select username from account WHERE BINARY accID='".$data."';")->row()->username;
    }
    
    public function getAccountPassword($data){
        return $this->db->query("Select password from account WHERE BINARY accID='".$data."';")->row()->password;
    }
    
    public function checkOldPw($id, $pass){
        $oldPw = $this->db->query("SELECT password FROM account WHERE BINARY accId='".$id."';" )->row()->password;
        if($oldPw == MD5($pass)){
            return 1;
        }   
        return 0;
    }
    
    public function checkUsername($user){
        $qry = $this->db->query("SELECT username FROM account WHERE BINARY username='".$user."';" );
        if($qry->num_rows() > 0)
        {
            return "Y";
        }else{
            return "N";
        }
    }
    
    public function checkNewPw($nPass, $rPass){
        if($nPass == $rPass){
            return 1;
        }
        return 0;
    }
    
    public function checkAccount($id){
        $qry = $this->db->query("SELECT accID FROM account WHERE BINARY accID='".$id."';" );
        if($qry->num_rows() > 0)
        {
            return 1;
        }else{
            return 0;
        }
    }
    
    public function updatePw($id, $pass){
         $this->db->query("UPDATE account SET password= MD5('".$pass."') WHERE accId='".$id."';");
    }
}
?>