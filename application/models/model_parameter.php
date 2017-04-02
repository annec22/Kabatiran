<?php
    if (!defined('BASEPATH')) exit('No direct script access allowed');
    
    class Model_parameter extends CI_Model {

        function __construct() {
            parent::__construct();            
        }

        // functions for getting contents
        function exportContacts(){
            $this->load->dbutil();
            $this->load->helper('file');
            $query=$this->db->query('SELECT * FROM directory;');            
            $config = array (
                  'root'    => 'contacts',
                  'element' => 'contact',
                  'newline' => "\n",
                  'tab'    => "\t"
                );
            $data = $this->dbutil->xml_from_result($query, $config); 
            if ( ! write_file('./uploads/contacts.xml', $data)) {
                 echo 'Unable to write the file';
            } else {                 
                 return true;
            }            
        }
        function fetchProbContacts(){
            $query=$this->db->query('SELECT * FROM directory 
                                        INNER JOIN agency
                                        on directory.agencyID = agency.agencyID
                                        WHERE establishmentID = 0;');
            return $query->result_array();
        }
        function fetchContacts() {
            $query=$this->db->query('SELECT * FROM directory;');            
            return $query->result_array();
        }
        function fetchAgencies() {
            $query=$this->db->query('SELECT * FROM agency ORDER BY agencyName;');
            return $query->result_array();
        }
        function fetchCategories() {
            $query=  $this->db->query('SELECT * FROM category ORDER BY category;');
            return $query->result_array();
        }
        function fetchEstTypes() {
            $query=  $this->db->query('SELECT * FROM establishment_type ORDER BY classification;');
            return $query->result_array();
        }
        function fetchBarangays() {
            $query=  $this->db->query('SELECT * FROM barangay ORDER BY name;');
            return $query->result_array();
        }
        function fetchLocations() {
            $query=  $this->db->query('SELECT * FROM location;');
            return $query->result_array();
        }
        function fetchMCities() {
            $query=  $this->db->query('SELECT * FROM municipality_city ORDER BY name;');
            return $query->result_array();
        }
        function fetchProvinces() {
            $query=  $this->db->query('SELECT * FROM province ORDER BY province;');
            return $query->result_array();
        }
        function fetchAccidentTypes() {
            $query=  $this->db->query('SELECT * FROM accident_type ORDER BY classification;');
            return $query->result_array();
        }
        function fetchMarkers() {
            $query=  $this->db->query('SELECT contactNo, specifics, establishment_office.establishmentID AS establishmentID ,establishment_office.agencyID,description, establishment_office.locationID ,establishment_type.esTypeID AS esTypeID, name,
                                            muniCityID, barangay, x, y, classification, directoryID FROM location
                                            INNER JOIN establishment_office
                                                on location.locationID = establishment_office.locationID
                                            INNER JOIN establishment_type
                                                on establishment_office.esTypeID = establishment_type.esTypeID
                                            INNER JOIN directory
                                                on establishment_office.establishmentID = directory.establishmentID');
            return $query->result_array();
        }

        //functions for adding new content
        function genCode($data){
            $this->db->insert("authentication_code", $data);
            return $this->db->insert_id();
        }
        function addAgencies($data) {            
            $this->db->insert("agency", $data);
            return $this->db->insert_id();
        }
        function addCategories($data) {
            $this->db->insert("category", $data);
            return $this->db->insert_id();
        }
        function addEstTypes($data) {
            $this->db->insert("establishment_type", $data);
            return $this->db->insert_id();
        }
        function addLocations($muniCityID, $street, $x, $y) {
            $data = array("muniCityID" => $muniCityID, "street" => $street,
                          "x" => $x, "y" => $y);
            $this->db->insert("location", $data);
        }  
        function addMCities($data) {
            $this->db->insert("municipality_city", $data);
            return $this->db->insert_id();

        }
        function addProvinces($data) {            
            $this->db->insert("province", $data);
            return $this->db->insert_id();
        }
        function addBrgy($data) {
            $this->db->insert("barangay", $data);
            return $this->db->insert_id();
        }
        function addLocation($data) {
            $this->db->insert("location", $data);
            return $this->db->insert_id();
        }
        function addEOffice($data) {
            $this->db->insert("establishment_office", $data);
            return $this->db->insert_id();
        }
        function addDirectory($data){
            $this->db->insert("directory", $data);
            return $this->db->insert_id();
        }
        function AddAccidentType($data) {
            $this->db->insert("accident_type", $data);
            return $this->db->insert_id();
        }
            

        //functions for editing a specific content                       
        function editMun($munID, $munData) {
            $this->db->where("muniCityID", $munID);
            $result = $this->db->update("municipality_city", $munData);
            return $result;
        }
        function editProv($provinceID, $provData) {
            $this->db->where("provinceID", $provinceID);
            $result = $this->db->update("province", $provData);
            return $result;
        }
        function editBrgy($idbarangay, $brgyData) {
            $this->db->where("idbarangay", $idbarangay);
            $result = $this->db->update("barangay", $brgyData);
            return $result;
        }
        function editEstab($esTypeID, $estabData) {
            $this->db->where("esTypeID", $esTypeID);
            $result = $this->db->update("establishment_type", $estabData);
            return $result;
        }
        function editCat($categoryID, $catData) {
            $this->db->where("categoryID", $categoryID);
            $result = $this->db->update("category", $catData);
            return $result;
        }
        function editAgency($agencyID, $agencyData) {
            $this->db->where("agencyID", $agencyID);
            $result = $this->db->update("agency", $agencyData);
            return $result;
        }
        function editLocation($locationID, $locationData) {
            $this->db->where("locationID", $locationID);
            $result = $this->db->update("location", $locationData);
            return $result;
        }
        function editEOffice($eOfficeID, $establishmentData) {
            $this->db->where("establishmentID", $eOfficeID);
            $result = $this->db->update("establishment_office", $establishmentData);
            return $result;
        }
        function editDirectory($directoryID, $directoryData) {
            $this->db->where("directoryID", $directoryID);
            $result = $this->db->update("directory", $directoryData);
            return $result;
        }
        function editAccidentType($typeID, $aTypeData) {
            $this->db->where("typeID", $typeID);
            $result = $this->db->update("accident_type", $aTypeData);
            return $result;
        }
        
        //functions for deleting a specific content
        
        function deleteContactLoc($id){            
            return $this->db->query('DELETE FROM location 
                              WHERE locationID = (SELECT locationID FROM establishment_office
                                                  WHERE establishmentID = (SELECT establishmentID FROM directory
								           WHERE establishmentID = '.$id.'));');
        }
        
        function deleteContactEstab($id){
            return $this->db->query('DELETE FROM establishment_office
                                                  WHERE establishmentID = (SELECT establishmentID FROM directory
								           WHERE establishmentID = '.$id.'));');
        }
        function deleteProv($id){
            $this->db->where('provinceID',$id);
            return $this->db->delete('province');
        }
        
        function deleteMun($id){
            $this->db->where('muniCityID',$id);
            return $this->db->delete('municipality_city');
        }
        
        function deleteBrgy($id){
            $this->db->where('idbarangay',$id);
            return $this->db->delete('barangay');
        }
        function deleteEstab($id){
            $this->db->where('esTypeID',$id);
            return $this->db->delete('establishment_type');
        }
        function deleteEstabOffice($id){
            $this->db->where('establishmentID',$id);
            return $this->db->delete('establishment_office');
        }
        function deleteLocation($id){
            $this->db->where('locationID',$id);
            return $this->db->delete('location');
        }
        function deleteDirectory($id){
            $this->db->where('directoryID',$id);
            return $this->db->delete('directory');
        }
        
        function deleteCategory($id){
            $this->db->where('categoryID',$id);
            return $this->db->delete('category');
        }
        
        function deleteAgency($id){
            $this->db->where('agencyID',$id);
            return $this->db->delete('agency');
        }
        function deleteAccidentType($id){
            $this->db->where('typeID',$id);
            return $this->db->delete('accident_type');
        }                
        
        //functions for getting the information of the specified row number in the table
        
        function getProvInfo($id){
            return $this->db->query("SELECT * FROM province WHERE
                                     provinceID = $id")->result_array();
        }
        
        function getMunInfo($id){
            return $this->db->query("SELECT * FROM municipality_city WHERE
                                     muniCityID = $id")->result_array();
        }
        
        function getBrgyInfo($id){
            return $this->db->query("SELECT * FROM barangay WHERE
                                     idbarangay = $id")->result_array();
        }
        
        function getEstabInfo($id){
            return $this->db->query("SELECT * FROM establishment_type WHERE
                                     esTypeID = $id")->result_array();
        }
        
        function getCatInfo($id){
            return $this->db->query("SELECT * FROM category WHERE
                                     categoryID = $id")->result_array();
        }
        
        function getAgencyInfo($id){
            return $this->db->query("SELECT * FROM agency WHERE
                                     agencyID = $id")->result_array();
        }
        
        function getEstabOInfo($id){
            return $this->db->query("SELECT classification 
                                        FROM establishment_office
                                        INNER JOIN establishment_type
                                        on establishment_type.esTypeID  = $id")->result_array();
        }
        
        function getContactInfo($id){
            return $this->db->query("SELECT * FROM directory WHERE
                                     directoryID = $id")->result_array();
        }
        
        function getAccidentTypeInfo($id){
            return $this->db->query("SELECT * FROM accident_type WHERE
                                     typeID = $id")->result_array();
        }
        function getFMun($id){
            return $this->db->query("SELECT name, muniCityID FROM municipality_city WHERE
                                     provinceID = $id")->result_array();
        }
        
        function getFBrgy($id){
            return $this->db->query("SELECT name, idbarangay FROM barangay WHERE
                                     munCityID = $id")->result_array();
        }
        
        function getFAgency($id){
            return $this->db->query("SELECT agencyID, agencyName FROM agency WHERE
                                     categoryID = $id")->result_array();
        }
        
        /*
         * gcm
         */
        
        function subscribeUser($data){
            $this->db->insert("gcm", $data);
            return $this->db->insert();
        }
    }
?>
