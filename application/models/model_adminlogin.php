<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_adminlogin extends CI_Model {

    public function checkAdminLogin($user, $pass) {
        $query = $this->db->query("SELECT * FROM account WHERE BINARY username=".$this->db->escape($user)." AND password=".$this->db->escape(md5($pass)));
        foreach($query->result() as $row){
            return $row->firstName . " " . $row->lastName . " ";
        } 
        return false;
    }
    
    public function checkID($user, $pass) {
        $query = $this->db->query("SELECT * FROM account WHERE BINARY username=".$this->db->escape($user)." AND password=".$this->db->escape(md5($pass)));
        foreach($query->result() as $row){
            return $row->accID;
        } 
        return false;
    }
    
    public function checkType($user, $pass) {
        $query = $this->db->query("SELECT * FROM account WHERE BINARY username=".$this->db->escape($user)." AND password=".$this->db->escape(md5($pass)));
        foreach($query->result() as $row){
            return $row->accType;
        } 
        return false;
    }
    
    
}
