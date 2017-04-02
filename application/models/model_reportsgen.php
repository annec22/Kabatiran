<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Model_reportsGen extends CI_Model {
    
    public function getNumber($item, $city){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE classification = '".$item."' AND name = '".$city."'");
        return $query->num_rows();
    }
    public function getNumberDate($item, $city, $from, $to){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE classification = '".$item."' AND name = '".$city."' AND incidentDate BETWEEN '".$from."' AND '".$to."'");
        return $query->num_rows();
    }
    public function getNumberDateReg($item, $from, $to){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE classification = '".$item."' AND incidentDate BETWEEN '".$from."' AND '".$to."'");
        return $query->num_rows();
    }
    public function getNumberDateProv($item, $prov, $from, $to){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE classification = '".$item."' AND provinceID = '".$prov."' AND incidentDate BETWEEN '".$from."' AND '".$to."'");
        return $query->num_rows();
    }
    public function getCityNumber($city){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE name = '".$city."'");
        return $query->num_rows();
    }
    public function getAccNumber($item){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE classification = '".$item."'");
        return $query->num_rows();
    }
    public function getAccNumberDate($item, $from, $to){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE classification = '".$item."' AND incidentDate BETWEEN '".$from."' AND '".$to."'");
        return $query->num_rows();
    }
    
    public function getCategoryNumbers($item){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE classification = '".$item."'");
        return $query->num_rows();
    }
    
    public  function getProvinces(){
        $query = $this->db->query("SELECT * FROM province");
        return $query->result();
    }
    
    public function getMuniCity($id){
        $query = $this->db->query("SELECT * FROM municipality_city WHERE provinceID = ".$id);
        return $query->result();
    }
    
    public function getAllMuniCity(){
        $query = $this->db->query("SELECT DISTINCT name FROM municipality_city ORDER BY name");
        return $query->result();
    }
    
    
    public function getAccidents(){
        $query = $this->db->query("SELECT * FROM accident_type");
        return $query->result();
    }
    
    public function getYear(){
        $this->db->distinct();
        $this->db->select("YEAR(incidentDate) as date");
        $q = $this->db->get("event");
        return $q->result();
    }
    
    public function getRecordsMonthly($month, $year, $city, $acc){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND MONTH(incidentDate) = '".$month."' AND YEAR(incidentDate) = 
                '".$year."' AND name = '".$city."' ORDER BY eventID");
        return $query->num_rows();
    }
    public function getRecordsMonthlyRegion($month, $year, $acc){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND MONTH(incidentDate) = '".$month."' AND YEAR(incidentDate) = 
                '".$year."' ORDER BY eventID");
        return $query->num_rows();
    }
    public function getRecordsMonthlyProv($month, $year, $prov, $acc){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND MONTH(incidentDate) = '".$month."' AND YEAR(incidentDate) = 
                '".$year."' AND provinceID = '".$prov."' ORDER BY eventID");
        return $query->num_rows();
    }
    
    public function getAccidentID($item)
    {
        $query = $this->db->query("SELECT * FROM accident_type WHERE classification = '".$item."'");
        return $query->row()->typeID;
    }
    
    public function getDetails($year, $city, $acc){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND YEAR(incidentDate) = 
                '".$year."' AND name = '".$city."'");
        if($query->num_rows() > 0)
        {
            $string="";
            foreach($query->result() as $row)
            {
                $string = $string . "<tr><td> ".$row->incidentname ."</td><td> ".
                        $row->incidentDate."".$row->incidentTime."</td><td>".
                        $row->description."</td><td>".$row->name."</td></tr>|";
            }
            return $string;
        }
    }
    public function getDetailsRegionYear($year, $acc){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND YEAR(incidentDate) = 
                '".$year."'");
        if($query->num_rows() > 0)
        {
            $string="";
            foreach($query->result() as $row)
            {
                $string = $string . "<tr><td> ".$row->incidentname ."</td><td> ".
                        $row->incidentDate.$row->incidentTime."</td><td>".
                        $row->description."</td><td>".$row->name."</td></tr>|";
            }
            return $string;
        }
    }
    public function getDetailsMon($year, $city, $acc, $month){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND YEAR(incidentDate) = 
                '".$year."' AND MONTH(incidentDate) = '".$month."' AND name = '".$city."'");
        if($query->num_rows() > 0)
        {
            $string="";
            foreach($query->result() as $row)
            {
                $string = $string . "<tr><td> ".$row->incidentname ."</td><td> ".
                        $row->incidentDate.$row->incidentTime."</td><td>".
                        $row->description."</td><td>".$row->name."</td></tr>|";
            }
            return $string;
        }
    }
    public function getDetailsRegionMon($year,  $acc, $month){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND YEAR(incidentDate) = 
                '".$year."' AND MONTH(incidentDate) = '".$month."'");
        if($query->num_rows() > 0)
        {
            $string="";
            foreach($query->result() as $row)
            {
                $string = $string . "<tr><td> ".$row->incidentname ."</td><td> ".
                        $row->incidentDate.$row->incidentTime."</td><td>".
                        $row->description."</td><td>".$row->name."</td></tr>|";
            }
            return $string;
        }
    }
    public function getDetailsMonProv($year, $prov, $acc, $month){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND YEAR(incidentDate) = 
                '".$year."' AND MONTH(incidentDate) = '".$month."' AND provinceID = '".$prov."'");
        if($query->num_rows() > 0)
        {
            $string="";
            foreach($query->result() as $row)
            {
                $string = $string . "<tr><td> ".$row->incidentname ."</td><td> ".
                        $row->incidentDate.$row->incidentTime."</td><td>".
                        $row->description."</td><td>".$row->name."</td></tr>|";
            }
            return $string;
        }
    }
    public function getDetailsDate($first, $city, $acc, $last){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND name = 
                '".$city."' AND incidentDate BETWEEN '".$first."' AND '".$last."'");
        if($query->num_rows() > 0)
        {
            $string="";
            foreach($query->result() as $row)
            {
                $string = $string . "<tr><td> ".$row->incidentname ."</td><td> ".
                        $row->incidentDate.$row->incidentTime."</td><td>".
                        $row->description."</td><td>".$row->name."</td></tr>|";
            }
            return $string;
        }
    }
    public function getDetailsRegionDate($first, $acc, $last){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND incidentDate BETWEEN '".$first."' AND '".$last."'");
        if($query->num_rows() > 0)
        {
            $string="";
            foreach($query->result() as $row)
            {
                $string = $string . "<tr><td> ".$row->incidentname ."</td><td> ".
                        $row->incidentDate.$row->incidentTime."</td><td>".
                        $row->description."</td><td>".$row->name."</td></tr>|";
            }
            return $string;
        }
    }
    public function getDetailsDateProv($first, $city, $acc, $last){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND provinceID = 
                '".$city."' AND incidentDate BETWEEN '".$first."' AND '".$last."'");
        if($query->num_rows() > 0)
        {
            $string="";
            foreach($query->result() as $row)
            {
                $string = $string . "<tr><td> ".$row->incidentname ."</td><td> ".
                        $row->incidentDate.$row->incidentTime."</td><td>".
                        $row->description."</td><td>".$row->name."</td></tr>|";
            }
            return $string;
        }
    }
    public function getDetailsProv($year, $prov, $acc){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND YEAR(incidentDate) = 
                '".$year."' AND provinceID = '".$prov."'");
        if($query->num_rows() > 0)
        {
            $string="";
            foreach($query->result() as $row)
            {
                $string = $string . "<tr><td> ".$row->incidentname ."</td><td> ".
                        $row->incidentDate.$row->incidentTime."</td><td>".
                        $row->description."</td><td>".$row->name."</td></tr>|";
            }
            return $string;
        }
    }
    
    public function getBetweenDates(){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN 
            accident_type WHERE classification = '".$acc."' AND MONTH(incidentDate) = '".$month."' AND YEAR(incidentDate) = 
                '".$year."' AND name = '".$city."' ORDER BY eventID");
        return $query->num_rows();
    }
    
    public function getProvID($item)
    {
        $query = $this->db->query("SELECT * FROM province WHERE province = '".$item."'");
        return $query->row()->provinceID;
    }
   
    
}

?>