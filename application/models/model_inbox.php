<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_inbox extends CI_Model 
{

    function __construct() 
    {
        parent::__construct();
    }
    
    public function getAllReports()
    {
        $queryResult = $this->db->query("SELECT incident_report.reportID, incident_report.reportDescription, incident_report.firstName, 
                                            incident_report.middleInitial, incident_report.lastName,
                                            incident_report.attachments, barangay.name AS barangay, 
                                            municipality_city.name AS municity,	province.province, 
                                            incident_report.reportDate, incident_report.reportTime,
                                            incident_report.incidentDate, incident_report.incidentTime,
                                            incident_report.reportStatus, incident_report.macAddress, 
                                            incident_report.reporter, accident_type.classification, incident_report.readStatus
                                            FROM incident_report
                                            LEFT JOIN barangay on incident_report.barangay = barangay.idbarangay
                                            LEFT JOIN municipality_city on incident_report.municipality = municipality_city.muniCityID
                                            LEFT JOIN province on incident_report.province = province.provinceID
                                            LEFT JOIN accident_type on incident_report.typeID = accident_type.typeID
                                            WHERE (incident_report.reportStatus = 'Pending')
                                            ORDER BY  incident_report.incidentDate DESC, incident_report.reporter DESC,
                                            incident_report.incidentTime DESC, accident_type.classification ASC;");
        if($queryResult->num_rows() > 0)
        {
            foreach($queryResult->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
     
    public function getAllConfirmed()
    {
        $queryResult = $this->db->query("SELECT incident_report.reportID, incident_report.reportDescription, incident_report.firstName, 
                                            incident_report.middleInitial, incident_report.lastName,
                                            incident_report.attachments, barangay.name AS barangay, 
                                            municipality_city.name AS municity,	province.province, 
                                            incident_report.reportDate, incident_report.reportTime,
                                            incident_report.incidentDate, incident_report.incidentTime,
                                            incident_report.reportStatus, incident_report.macAddress, 
                                            incident_report.reporter, accident_type.classification, incident_report.readStatus
                                            FROM incident_report
                                            LEFT JOIN barangay on incident_report.barangay = barangay.idbarangay
                                            LEFT JOIN municipality_city on incident_report.municipality = municipality_city.muniCityID
                                            LEFT JOIN province on incident_report.province = province.provinceID
                                            LEFT JOIN accident_type on incident_report.typeID = accident_type.typeID
                                            WHERE (incident_report.reportStatus = 'Confirmed')
                                            ORDER BY  incident_report.incidentDate DESC, incident_report.reporter DESC,
                                            incident_report.incidentTime DESC, accident_type.classification ASC;");
        if($queryResult->num_rows() > 0)
        {
            foreach($queryResult->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getAllTrash()
    {
        $queryResult = $this->db->query("SELECT incident_report.reportID, incident_report.reportDescription, incident_report.firstName, 
                                            incident_report.middleInitial, incident_report.lastName,
                                            incident_report.attachments, barangay.name AS barangay, 
                                            municipality_city.name AS municity,	province.province, 
                                            incident_report.reportDate, incident_report.reportTime,
                                            incident_report.incidentDate, incident_report.incidentTime,
                                            incident_report.reportStatus, incident_report.macAddress, 
                                            incident_report.reporter, accident_type.classification, incident_report.readStatus
                                            FROM incident_report
                                            LEFT JOIN barangay on incident_report.barangay = barangay.idbarangay
                                            LEFT JOIN municipality_city on incident_report.municipality = municipality_city.muniCityID
                                            LEFT JOIN province on incident_report.province = province.provinceID
                                            LEFT JOIN accident_type on incident_report.typeID = accident_type.typeID
                                            WHERE (incident_report.reportStatus = 'Trash')
                                            ORDER BY  incident_report.incidentDate DESC, incident_report.reporter DESC,
                                            incident_report.incidentTime DESC, accident_type.classification ASC;");
        if($queryResult->num_rows() > 0)
        {
            foreach($queryResult->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    public function getAllSpam()
    {
        $queryResult = $this->db->query("SELECT incident_report.reportID, incident_report.reportDescription, incident_report.firstName, 
                                            incident_report.middleInitial, incident_report.lastName,
                                            incident_report.attachments, barangay.name AS barangay, 
                                            municipality_city.name AS municity,	province.province, 
                                            incident_report.reportDate, incident_report.reportTime,
                                            incident_report.incidentDate, incident_report.incidentTime,
                                            incident_report.reportStatus, incident_report.macAddress, 
                                            incident_report.reporter, accident_type.classification, incident_report.readStatus
                                            FROM incident_report
                                            LEFT JOIN barangay on incident_report.barangay = barangay.idbarangay
                                            LEFT JOIN municipality_city on incident_report.municipality = municipality_city.muniCityID
                                            LEFT JOIN province on incident_report.province = province.provinceID
                                            LEFT JOIN accident_type on incident_report.typeID = accident_type.typeID
                                            WHERE (incident_report.reportStatus = 'Spam')
                                            ORDER BY  incident_report.incidentDate DESC, incident_report.reporter DESC,
                                            incident_report.incidentTime DESC, accident_type.classification ASC;");
        if($queryResult->num_rows() > 0)
        {
            foreach($queryResult->result() as $row)
            {
                $data[] = $row;
            }
            return $data;
        }
    }
    
    function checkIfConfirmed($id){
        $queryResult = $this->db->query("SELECT incident_report.reportStatus FROM incident_report WHERE reportID='$id' AND reportStatus = 'Confirmed';");
        
        if($queryResult->num_rows() > 0)
        {
            return "C".$id;
        }else{
            return "N".$id;
        }
    }
    
    function checkReportContained($date, $type, $province, $municity, $barangay){
        if($barangay == "" || $barangay == NULL){
            $queryResult = $this->db->query("SELECT * FROM incident_report WHERE incidentDate='$date' 
                                            AND typeID = '$type' AND province = '$province' 
                                            AND municipality = '$municity' AND reportStatus = 'Confirmed';");       
        }else{
            $queryResult = $this->db->query("SELECT * FROM incident_report WHERE incidentDate='$date' 
                                            AND typeID = '$type' AND province = '$province' 
                                            AND municipality = '$municity' AND barangay = '$barangay' AND reportStatus = 'Confirmed';");
        }
        
        if($queryResult->num_rows() > 0)
        {
            return "P";
        }else{
            return "N";
        }
    }

    function markAsTrash($id, $stat)
    {
        $this->db->query("UPDATE incident_report SET reportStatus='Trash' , trashMarker='$stat' WHERE reportID='$id';");
    }
    
    function restoreReport($id, $stat)
    {
        $this->db->query("UPDATE incident_report SET reportStatus='$stat' , trashMarker=NULL WHERE reportID='$id';");
    }
    
    function markAsConfirmed($id)
    {
        $this->db->query("UPDATE incident_report SET reportStatus='Confirmed' WHERE reportID='$id';");
    }
    
    function markAsSpam($id)
    {
        $this->db->query("UPDATE incident_report SET reportStatus='Spam' WHERE reportID='$id';");
    }
    
    function markAsRead($id){
        $this->db->query("UPDATE incident_report SET readStatus='#D8D8D8' WHERE reportID='$id';");
    }
    
    function getReportInformation($id)
    {
        
        $qry = $this->db->query("SELECT incident_report.reportDescription, incident_report.firstName, 
                                incident_report.middleInitial, incident_report.lastName,
                                incident_report.attachments,  barangay.name AS barangay, 
                                municipality_city.name AS municity, province.province, 
                                incident_report.reportDate, incident_report.reportTime,
                                incident_report.incidentDate, incident_report.incidentTime,
                                incident_report.reportStatus, incident_report.macAddress, 
                                incident_report.reporter, accident_type.classification
                                FROM incident_report
                                LEFT JOIN barangay on incident_report.barangay = barangay.idbarangay
                                LEFT JOIN municipality_city on incident_report.municipality = municipality_city.muniCityID
                                LEFT JOIN province on incident_report.province = province.provinceID
                                LEFT JOIN accident_type on incident_report.typeID = accident_type.typeID
                                WHERE incident_report.reportID = $id;")->row();
        
        return $qry->firstName."|". 
               $qry->middleInitial."|".
               $qry->lastName."|".
               $qry->incidentDate."|".
               $qry->incidentTime."|".
               date_format(date_create($qry->reportDate), 'M. d, Y')."|".
               date_format(date_create($qry->reportTime), 'g:ia')."|".
               $qry->province."|".
               $qry->municity."|".
               $qry->barangay."|".
               $qry->classification."|".  
               $qry->reportDescription."|".  
               $qry->macAddress."|".
               $qry->attachments."|";
    }
    
    function deleteReport($id)
    {
        $this->db->delete('incident_report', array('reportID' => $id)); 
    }
    
    function getReportStatus($id)
    {
        $qry = $this->db->query("SELECT reportStatus FROM incident_report WHERE reportID = $id;")->row();
        return $qry->reportStatus;
    }
    
    function getTrashMarker($id)
    {
        $qry = $this->db->query("SELECT trashMarker FROM incident_report WHERE reportID = $id;")->row();
        return $qry->trashMarker;
    }
    
    public function storeReport($data){
        $this->db->insert("incident_report",$data);
    }
    
    public function getDisaster($data){
        $query = $this->db->query("SELECT * FROM accident_type WHERE classification = '$data'");
        if($query->first_row()!=null){
            return $query->first_row()->typeID;
        }else{
            return null;
        }
    }
    
    public function getProvince($data){
        $query = $this->db->query("SELECT * FROM province WHERE province = '$data'");
         if($query->first_row()!=null){
            return $query->first_row()->provinceID;
         }else{
             return null;
         }
    }
    
    public function getMunicipality($data){
        $query = $this->db->query("SELECT * FROM municipality_city WHERE name = '$data'");
        if($query->first_row()!=null){
            return $query->first_row()->muniCityID;
        }else{
            return null;
        }
    }
    
    public function getBarangay($data){
        $query = $this->db->query("SELECT * FROM barangay WHERE name = '$data'");
        if($query->first_row()!=null){
            return $query->first_row()->idbarangay;
        }else{
            return null;
        }
    }
    
    
    
    public function updateAttachment($data,$id){
        $this->db->update("incident_report",$data,$id);
    }
    
    public function checkAuth($data){
         $query = $this->db->query("SELECT * FROM authentication_code WHERE authenticationCode = '$data'");
         if($query->first_row()!=null){
            return $query->first_row();
         }else{
             return null;
         }
    }
    
}
?>