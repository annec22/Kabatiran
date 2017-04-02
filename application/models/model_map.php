<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Model_map extends CI_Model
{

    public function addLocation($location)
    {
        $this->db->insert('location', $location);
        
    }
    
    public function addMuniCity($cm)
    {
        $this->db->insert('municipality_city', $cm);
    }
    public function editMarker($table, $set, $key, $where)
    {
        $this->db->where($key, $where)->update($table, $set);
        
    }


    public function addEvent($event)
    {
        $this->db->insert('event', $event);
        
    }
    
    public function addReport($report)
    {
        $this->db->insert('incident_report', $report);
        
    }
    
    public function getMuniCity($id){
        $query = $this->db->query("SELECT * FROM municipality_city WHERE provinceID = ".$id);
        return $query->row()->muniCityID;
    }
    
    public function getMuniCityOption($id){
        $queryResult = $this->db->query("SELECT * FROM municipality_city WHERE provinceID = ".$id);
        if($queryResult->num_rows() > 0)
        {
            $string="";
            foreach($queryResult->result() as $row)
            {
                $string = $string . $row->name ."|";
            }
            return $string;
        }
    }
    public function getBrgyOption($id){
        $queryResult = $this->db->query("SELECT * FROM barangay WHERE munCityID = ".$id);
        if($queryResult->num_rows() > 0)
        {
            $string="";
            foreach($queryResult->result() as $row)
            {
                $string = $string . $row->name ."|";
            }
            return $string;
        }
    }
    
    public function delMarker($table, $key, $where){
        $this->db->where($key, $where)->delete($table);
        
    }
    
    public  function getProvinces(){
        $query = $this->db->query("SELECT * FROM province");
        return $query->result();
    }
    
    public  function getSpecProvinces($id){
        $locationQuery = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE incidentDate BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() AND locationID = '".$id."'");
        $query = $this->db->query("SELECT * FROM province WHERE provinceID = (SELECT muniCityID FROM municipality_city WHERE muniCityID =".$locationQuery->row()->muniCityID." )");
        return $query->result();
    }
    
    public  function getSpecProvincesDel($id){
        $locationQuery = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE locationID = '".$id."'");
        $query = $this->db->query("SELECT * FROM province WHERE provinceID = (SELECT muniCityID FROM municipality_city WHERE muniCityID =".$locationQuery->row()->muniCityID." )");
        return $query->result();
    }

    public function getBrgyLocation($id){
        $query = $this->db->query("SELECT * FROM barangay WHERE idbarangay = '".$id."'");
        $result = $query->row()->x."|".$query->row()->y;
        return $result;
    }
    public function getLocations()
    {
        $query = $this->db->query("SELECT event.description, accident_type.classification, location.locationID AS 'locationID',
                                    event.incidentname, municipality_city.name, 
                                    barangay.name AS 'barangay', event.incidentDate, event.incidentTime,
                                    event.typeID AS 'typeID', event.eventID, location.muniCityID AS 'muniCityID', 
                                    location.x AS 'x', location.y AS 'y' 
                                    FROM event, accident_type, location, barangay, municipality_city
                                    WHERE event.typeID = accident_type.typeID
                                    AND event.locationID = location.locationID
                                    AND location.muniCityID = municipality_city.muniCityID
                                    AND barangay.idbarangay = location.barangay;");
        return $query->result();
    }
    
    public function getLocationFromList($item)
    {
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE incidentDate BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() AND locationID = '".$item."'");
        return $query->result();
    }
    
    public function getLocationEdit($item)
    {
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE locationID = '".$item."'");
        return $query->result();
    }
    
    
    public function getLocationsPublic()
    {
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE incidentDate BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE()");
        return $query->result();
    }
    public function getPublicEvents()
    {
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE incidentDate BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() ORDER BY incidentname");
        return $query->result();
    }
    public function getLocationInfo($item)
    {
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE locationID = '".$item."'");
        return $query->row()->name.",".$query->row()->incidentname.",".$query->row()->incidentDate.",".$query->row()->incidentTime.",".$query->row()->classification.",".$query->row()->description;
    }
    
    public function getAccidentID($item)
    {
        $query = $this->db->query("SELECT * FROM accident_type WHERE classification = '".$item."'");
        return $query->row()->typeID;
    }
    
    public function getEventID($item)
    {
        $query = $this->db->query("SELECT * FROM event WHERE description = '".$item."'");
        return $query->row()->eventID;
    }
    
    public function getProvID($item)
    {
        $query = $this->db->query("SELECT * FROM province WHERE province = '".$item."'");
        return $query->row()->provinceID;
    }
    
    public function getMuniID($item)
    {
        $query = $this->db->query("SELECT * FROM municipality_city WHERE name = '".$item."'");
        return $query->row()->muniCityID;
    }
    public function getBrgyID($item)
    {
        $query = $this->db->query("SELECT * FROM barangay WHERE name = '".$item."'");
        return $query->row()->idbarangay;
    }
    
    public function getLocID($item, $item2)
    {
        $query = $this->db->query("SELECT * FROM location WHERE x = '".$item."' AND y = '".$item2."'");
        return $query->row()->locationID;
    }
    
   public function getEditLocation($item){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE locationID = '".$item."'");
        return $query->result();
    }
    
    public function getSpecLocTitle($item){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE incidentDate BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() AND incidentname = '".$item."'");
        return $query->result();
    }
    public function getSpecLocType($item){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE incidentDate BETWEEN DATE_SUB(CURDATE(), INTERVAL 30 DAY) AND CURDATE() AND classification = '".$item."'");
        return $query->result();
    }
    public function getSpecLocDate($item){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE incidentDate = '".$item."'");
        return $query->result();
    }
    public function getSpecLoc($prov, $city){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE provinceID = '".$prov."' AND muniCityID = '".$city."'");
        return $query->result();
    }
    public function getSpecLocProv($prov){
        $query = $this->db->query("SELECT * FROM municipality_city NATURAL JOIN location NATURAL JOIN event NATURAL JOIN accident_type WHERE provinceID = '".$prov."'");
        return $query->result();
    }
    
    public function getSpecProvince($item){
        $query = $this->db->query("SELECT province.province FROM province, municipality_city
WHERE municipality_city.name = '".$item."'
AND province.provinceID = municipality_city.provinceID;");
        if($query->num_rows() > 0)
        {
            $string="";
            foreach($query->result() as $row)
            {
                $string = $row->province;
            }
            return $string;
        }
    }
    
    public function getBrgyName($item){
        $query = $this->db->query("SELECT * FROM barangay WHERE idbarangay = '".$item."'");
        return $query->result();
    }
    
    public function getAcc(){
        $query = $this->db->query("SELECT * FROM accident_type");
        return $query->result();
    }
}
?>
