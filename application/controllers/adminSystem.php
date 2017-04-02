<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AdminSystem extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('cookie');

        $this->load->model('model_adminlogin');
        $this->load->model('model_account');
        $this->load->model('model_directory');
        $this->load->model('model_bulletin');
        $this->load->model('model_inbox');
        $this->load->model('model_map');
        $this->load->model('model_logs');
        $this->load->model('model_parameter');
        $this->load->model('model_reportsGen');
    }

    public function home() {
        $this->index();
    }

    public function index() {

        if ($this->session->userdata('adminAccess') && $this->session->userdata('adminAccess') == "adminInformapp") {
            $data['accRes'] = $this->model_account->getAllAcc();
            $data['dirRes'] = $this->model_directory->getAllDir();
            $data['dirAgency'] = $this->model_directory->getAgency();
            $data['bulletinRes'] = $this->model_bulletin->getAllPosts();
            $data['inboxRes'] = $this->model_inbox->getAllReports();
            $data['trashRes'] = $this->model_inbox->getAllTrash();
            $data['spamRes'] = $this->model_inbox->getAllSpam();
            $data['confRes'] = $this->model_inbox->getAllConfirmed();
            $data['logRes'] = $this->model_logs->getAllLogs();
            $data['location'] = $this->model_map->getLocations();
            $data['province'] = $this->model_map->getProvinces();
            $data['adminFullName'] = $this->session->userdata("adminFullName");
            $data['adminID'] = $this->session->userdata("adminID");


            $data['agencyList'] = $this->model_parameter->fetchAgencies();
            $data['categoryList'] = $this->model_parameter->fetchCategories();
            $data['estTypes'] = $this->model_parameter->fetchEstTypes();
            $data['barangays'] = $this->model_parameter->fetchBarangays();
            $data['mCities'] = $this->model_parameter->fetchMCities();
            $data['provinceList'] = $this->model_parameter->fetchProvinces();
            $data['markers'] = $this->model_parameter->fetchMarkers();
            $data['accidentTypeList'] = $this->model_parameter->fetchAccidentTypes();
            $data['contacts'] = $this->model_parameter->fetchContacts();
            $data['probContacts'] = $this->model_parameter->fetchProbContacts();
            //bamba
            $data['cities'] = $this->model_reportsGen->getAllMuniCity();
            $data['accident_type'] = $this->model_reportsGen->getAccidents();
            $data['count'] = null;
            $data['name'] = null;
            $data['month'] = null;
            $data['list'] = null;
            $data['Earthquake'] = $this->model_reportsGen->getCategoryNumbers("Earthquake");
            $data['Landslide'] = $this->model_reportsGen->getCategoryNumbers("Landslide");
            $data['Fire'] = $this->model_reportsGen->getCategoryNumbers("Fire");
            $data['Insurgence'] = $this->model_reportsGen->getCategoryNumbers("Insurgence");
            $data['VehicularAccident'] = $this->model_reportsGen->getCategoryNumbers("Vehicular Accident");
            $data['RockFall'] = $this->model_reportsGen->getCategoryNumbers("Rock Fall");
            $data['DrowningIncident'] = $this->model_reportsGen->getCategoryNumbers("Drowning Incident");
            $data['RoadBlock'] = $this->model_reportsGen->getCategoryNumbers("Road Block");
            $data['color'] = array('#F38630', '#E0E4CC', '#69D2E7', '#000000', '#FF0000', '#00FF00', '#0000FF', '#FFFF00');
            $data['year'] = $this->model_reportsGen->getYear();
            $data['cities'] = $this->model_reportsGen->getAllMuniCity();
            $data['records'] = null;
            $data['months'] = null;
            $data['accidents'] = $this->model_reportsGen->getAccidents();
            $data['accident'] = $this->model_map->getAcc();

            $data['key'] = ' ';

            //=========FACEBOOK=======
            $fb_config = array(
                'appId' => '1387979881428922',
                'secret' => '5868eaa44c91bb1190926c44ec27fb6a',
                'permissions' => 'manage_pages, publish_stream',
                'cookie' => true,
            );

            $this->load->library('facebook', $fb_config);

            $user = $this->facebook->getUser();

            if ($user) {
                try {
                    $data['user_profile'] = $this->facebook->api('/me', 'GET');
                } catch (FacebookApiException $e) {
                    $user = null;
                }
            }

            if ($user) {
                if (isset($_POST['msg']) and $_POST['msg'] != '') {
                    try {
                        $message = array(
                            'message' => $_POST['msg']
                        );
                        $posturl = '/' . $_POST['pageid'] . '/feed';
                        $result = $this->facebook->api($posturl, 'POST', $message);
                        if ($result) {
                            redirect(base_url() . 'home');
                        }
                    } catch (FacebookApiException $e) {
                        echo $e->getMessage();
                    }
                }

                try {
                    $qry = 'select page_id, name from page where page_id in (select page_id from page_admin where page_id =382887808505099)';
                    $pages = $this->facebook->api(array('method' => 'fql.query', 'query' => $qry));
                    //checks if the user is the admin of the informapp page
                    if (empty($pages)) {
                        $data['fbusertype'] = 'nonAdmin';
                    } else {
                        $data['fbusertype'] = 'admin';
                    }
                } catch (FacebookApiException $e) {
                    echo $e->getMessage();
                }

                $data['logout_url'] = $this->facebook->getLogoutUrl(array('next' => base_url('fbLogout')));
            } else {
                $data['login_url'] = $this->facebook->getLoginUrl();
            }
            //=====END OF FACEBOOK=====

            $this->load->view('adminSystem_view', $data);
        } else {
            $data["errorAdminLogin"] = FALSE;
            $this->load->view('adminLogin_view', $data);
        }
    }

    public function main() {
        $this->form_validation->set_rules('adminUsername', 'Username', 'required|trim|xss_clean|strip_tags');
        $this->form_validation->set_rules('adminPassword', 'Password', 'required|trim|xss_clean|strip_tags');
        
        if ($this->form_validation->run() == TRUE) {
            $username = $this->input->post("adminUsername");
            $password = $this->input->post("adminPassword");
            $result = $this->model_adminlogin->checkAdminLogin($username, $password);
            $adminID = $this->model_adminlogin->checkID($username, $password);
            $type = $this->model_adminlogin->checkType($username, $password);

            if ($result && $adminID) {
                $this->session->set_userdata(array(
                    'adminAccess' => 'adminInformapp',
                    'adminFullName' => "$result",
                    'type' => "$type",
                    'adminID' => "$adminID"));
                redirect(base_url() . "home");

                $loginAction = "Login Success.";
                $loginNote = $result . " has logged in.";
                $this->model_logs->addToLog($loginAction, $loginNote);
            } else {
                $data["errorAdminLogin"] = TRUE;
                $this->load->view("adminLogin_view", $data);

                $loginAction = "Login Failed.";
                $loginNote = $result . " can't login.";
                $this->model_logs->addToLog($loginAction, $loginNote);
            }
        } else {
            $data["errorAdminLogin"] = FALSE;
            $this->load->view("adminLogin_view", $data);
        }
    }

    public function fbLogout() {
        $fb_config = array(
            'appId' => '1387979881428922',
            'secret' => '5868eaa44c91bb1190926c44ec27fb6a',
            'permissions' => 'manage_pages, publish_stream',
            'cookie' => true,
        );
        $this->load->library('facebook', $fb_config);
        setcookie('PHPSESSID', '', time() - 3600, "/");
        $this->facebook->destroySession();
        redirect(base_url() . 'home');
    }

    public function logout() {
        $this->session->unset_userdata(array('adminAccess' => 'adminInformapp'));
        $data["errorAdminLogin"] = FALSE;
        $this->load->view("adminLogin_view", $data);
    }

    public function adminMap() {
        $data['location'] = $this->model_map->getLocations();
        $data['province'] = $this->model_map->getProvinces();
        $data['accident'] = $this->model_map->getAcc();
        $this->load->view('adminMap_script', $data);
    }

    public function editDeleteUpdate() {
        $id = $this->input->get('action');
        switch ($id) {
            case "1":
                $result ['locInfo'] = $this->model_map->getLocationEdit($this->input->get('tempMarkerID'));
                $result['province'] = $this->model_map->getProvinces();
                $this->load->view('editMarker', $result);
                break;
            case "2":
                $result ['locInfo'] = $this->model_map->getLocationEdit($this->input->get('tempo'));
                $result['province'] = $this->model_map->getSpecProvincesDel($this->input->get('tempo'));
                $this->load->view('confirmDel', $result);
                break;
            default:
                $result['location'] = $this->model_map->getLocations();
                $result['province'] = $this->model_map->getProvinces();
                $this->load->view('onlineMap_view', $result);
                break;
        }
    }

    public function seeMore() {
        $locationID = $this->input->post('locationID');
        $result = $this->model_map->getLocationInfo($locationID);
        echo json_encode($result);
    }

    public function public_map() {
        $result['location'] = $this->model_map->getLocationsPublic();
        $result['events'] = $this->model_map->getPublicEvents();
        $result['accident_type'] = $this->model_reportsGen->getAccidents();
        $result['provinces'] = $this->model_map->getProvinces();
        $this->load->view('onlineMapPublic_view', $result);
    }

    public function isolation($locationID) {
        $result['location'] = $this->model_map->getLocationFromList($locationID);
        $this->load->view('onlineMapPublic_view', $result);
    }

    public function addLocation() {
        $date = date_format(date_create($this->input->post('date')), 'Y-m-d');
        date_default_timezone_set('Etc/GMT-8');
        $plotDate = date("Y-m-d");
        $plotTime = date("H:i:s");
        $desc = $this->input->post('description');
        $acc = $this->input->post('temp');
        $province = $this->input->post('prov');
        $cm = $this->input->post('cm');
        $brgy = $this->input->post('brgy');
        $brgyID = $this->model_map->getBrgyID($brgy);
        $x = $this->input->post('latitude');
        $y = $this->input->post('longitude');
        $hr = $this->input->post('hr');
        $min = $this->input->post('min');
        $time = $hr . ':' . $min . ':00';
        
        
        $provid = $this->model_map->getProvID($province);
        $accID = $this->model_map->getAccidentID($acc);
        $cmID = $this->model_map->getMuniID($cm);
        $loc = array(
            'locationID' => '0',
            'barangay' => $brgyID,
            'x' => $x,
            'y' => $y,
            'muniCityID' => $cmID
        );
        $this->model_map->addLocation($loc);
        $locID = $this->model_map->getLocID($x, $y);
        $event = array(
            'eventID' => '0',
            'incidentname' => $this->input->post('title'),
            'incidentTime' => $time,
            'incidentDate' => $date,
            'description' => $desc,
            'plotDate' => $plotDate,
            'plotTime' => $plotTime,
            'typeID' => $accID,
            'locationID' => $locID
        );
        $this->model_map->addEvent($event);
        $result['location'] = $this->model_map->getLocations();
        $result['province'] = $this->model_map->getProvinces();
        echo json_encode("success");
        redirect(base_url(), 'refresh');
    }

    public function editMarker() {
        $desc = $this->input->get('description');
        $acc = $this->input->get('temp');
        $cm = $this->input->get('cm');
        $brgyName = $this->input->get('brgy');
        $brgy = $this->model_map->getBrgyID($brgyName);
        $x = $this->input->get('latitude');
        $y = $this->input->get('longitude');
        $hr = $this->input->get('hr');
        $min = $this->input->get('min');
        $time = $hr . ':' . $min . ':00';
        $date = date_format(date_create($this->input->get('date')), 'Y-m-d');
        $accID = $this->model_map->getAccidentID($acc);
        $cmID = $this->model_map->getMuniID($cm);

        $locID = $this->input->get('tempMarkerID');
        $loc = array(
            'barangay' => $brgy,
            'x' => $x,
            'y' => $y,
            'muniCityID' => $cmID
        );
        $this->model_map->editMarker('location', $loc, 'locationID', $locID);
        $eventID = $this->input->get('event');
        $event = array(
            'incidentname' => $this->input->get('title'),
            'incidentTime' => $time,
            'incidentDate' => $date,
            'description' => $desc,
            'typeID' => $accID,
            'locationID' => $locID
        );
        $this->model_map->editMarker('event', $event, 'eventID', $eventID);
        $result['location'] = $this->model_map->getLocations();
        $result['province'] = $this->model_map->getProvinces();
        //$this->load->view('adminSystem_view', $result);
        redirect(base_url(), 'refresh');
    }

    public function delMarker() {

        $loc = $this->input->get('loc');
        $locDetails = array(
            'x' => null,
            'y' => null
        );
        $this->model_map->editMarker('location', $locDetails, 'locationID', $loc);
        $result['location'] = $this->model_map->getLocations();
        $result['province'] = $this->model_map->getProvinces();
        //$this->load->view('index.php/adminSystem', $result);
        redirect(base_url(), 'refresh');
    }

    

    public function getBrgyLoc() {
        $brgyID = $this->model_map->getBrgyID($this->input->post("brgy"));
        $brgy = $this->model_map->getBrgyLocation($brgyID);
        echo json_encode($brgy);
    }

    public function searchLocation() {
        $option = $this->input->get('option');
        switch ($option) {
            case '1':
                $provID = $this->model_map->getProvID($this->input->get('prov'));
                $cityID = $this->model_map->getMuniID($this->input->get('city'));
                $result['location'] = $this->model_map->getSpecLoc($provID, $cityID);
                $result['events'] = $this->model_map->getPublicEvents();
                $result['accident_type'] = $this->model_reportsGen->getAccidents();
                $result['provinces'] = $this->model_map->getProvinces();
                $this->load->view('onlineMapPublic_view', $result);
                break;
            case '2':
                $provID = $this->model_map->getProvID($this->input->get('prov'));
                $result['location'] = $this->model_map->getSpecLocProv($provID);
                $result['events'] = $this->model_map->getPublicEvents();
                $result['accident_type'] = $this->model_reportsGen->getAccidents();
                $result['provinces'] = $this->model_map->getProvinces();
                $this->load->view('onlineMapPublic_view', $result);
                break;
            case '3':
                $result['location'] = $this->model_map->getSpecLocTitle($this->input->get('eventTitle'));
                $result['events'] = $this->model_map->getPublicEvents();
                $result['accident_type'] = $this->model_reportsGen->getAccidents();
                $result['provinces'] = $this->model_map->getProvinces();
                $this->load->view('onlineMapPublic_view', $result);
                //redirect(base_url().'index.php/adminSystem/public_map', 'refresh');
                break;
            case '4':
                $result['location'] = $this->model_map->getSpecLocType($this->input->get('incType'));
                $result['events'] = $this->model_map->getPublicEvents();
                $result['accident_type'] = $this->model_reportsGen->getAccidents();
                $result['provinces'] = $this->model_map->getProvinces();
                $this->load->view('onlineMapPublic_view', $result);
                //redirect(base_url().'index.php/adminSystem/public_map', 'refresh');
                break;
            case '5':
                $result['location'] = $this->model_map->getSpecLocDate($this->input->get('incDate'));
                $result['events'] = $this->model_map->getPublicEvents();
                $result['accident_type'] = $this->model_reportsGen->getAccidents();
                $result['provinces'] = $this->model_map->getProvinces();
                $this->load->view('onlineMapPublic_view', $result);
                //redirect(base_url().'index.php/adminSystem/public_map', 'refresh');
                break;
        }
    }

    public function periodicRep() {
        if ($this->session->userdata('adminAccess') && $this->session->userdata('adminAccess') == "adminInformapp") {
            $result['year'] = $this->model_reportsGen->getYear();
            $result['cities'] = $this->model_reportsGen->getAllMuniCity();
            $result['records'] = null;
            $result['months'] = null;
            $result['month'] = null;
            $result['list'] = null;
            $result['yearf'] = null;
            $result['province'] = null;
            $result['first'] = null;
            $result['last'] = null;
            $result['city'] = null;
            $result['monthQuery'] = null;
            $result['regionMonth'] = null;
            $result['regionYear'] = null;
            $result['regionDate'] = null;
            $result['max'] = null;
            $result['prov'] = $this->model_reportsGen->getProvinces();
            $result['accidents'] = $this->model_reportsGen->getAccidents();
            $result['color'] = array('#F38630', '#E0E4CC', '#69D2E7', '#000000', '#FF0000', '#00FF00', '#0000FF', '#FFFF00');
            $this->load->view('periodicReports', $result);
        } else {
            $data["errorAdminLogin"] = FALSE;
            $this->load->view('adminLogin_view', $data);
        }
    }

    public function yearlyReports() {
        $result['months'] = "result";
        $result['color'] = array('#F38630', '#E0E4CC', '#69D2E7', '#000000', '#FF0000', '#00FF00', '#0000FF', '#FFFF00');
        $year = $this->input->get("year");
        $city = $this->input->get("city");
        $prov = $this->input->get("prov");
        $first = $this->input->get("first");
        $last = $this->input->get("last");
        $filter = $this->input->get("filterType");
        $month = $this->input->get("month");
        if ($city == null)
            $result['province'] = $prov;
        else
            $result['city'] = $city;
        $result['yearf'] = $year;
        $accTemp = $filter;
        $result['list'] = $filter;

        if ($month != null && $city != null) {
            $monthName = date("F", mktime(0, 0, 0, $month, 10));

            foreach ($accTemp as $acc) {
                $temp [] = $this->model_reportsGen->getRecordsMonthly($month, $year, $city, $acc);
            }
            $result['monthCount'] = $temp;
            $result['month'] = $monthName;
            $result['monthQuery'] = $monthName;
            $result['city'] = $city;
            $result['first'] = null;
            $result['last'] = null;
            $result['province'] = null;
            $result['regionMonth'] = null;
            $result['regionYear'] = null;
            $result['regionDate'] = null;
            $result['max'] = null;
        } elseif ($month != null && $prov != null) {
            $monthName = date("F", mktime(0, 0, 0, $month, 10));
            $provID = $this->model_reportsGen->getProvID($prov);
            foreach ($accTemp as $acc) {
                $temp [] = $this->model_reportsGen->getRecordsMonthlyProv($month, $year, $provID, $acc);
            }
            $result['monthCount'] = $temp;
            $result['month'] = $monthName;
            $result['monthQuery'] = $monthName;
            $result['city'] = null;
            $result['first'] = null;
            $result['last'] = null;
            $result['regionMonth'] = null;
            $result['regionYear'] = null;
            $result['regionDate'] = null;
            $result['max'] = null;
        } elseif ($month == null && $prov != null && $first == null && $last == null) {
            $provID = $this->model_reportsGen->getProvID($prov);
            
            foreach($accTemp as $acc){
                for($i = 1; $i < 13; $i++){
                    $tempMax [] = $this->model_reportsGen->getRecordsMonthlyProv($i, $year, $provID, $acc);
                }
            }
            rsort($tempMax);
            foreach ($accTemp as $acc) {
                $temp1 [] = $this->model_reportsGen->getRecordsMonthlyProv(1, $year, $provID, $acc);
            }
            $result['Jan'] = $temp1;
            foreach ($accTemp as $acc) {

                $temp2 [] = $this->model_reportsGen->getRecordsMonthlyProv(2, $year, $provID, $acc);
            }
            $result['Feb'] = $temp2;
            foreach ($accTemp as $acc) {

                $temp3 [] = $this->model_reportsGen->getRecordsMonthlyProv(3, $year, $provID, $acc);
            }
            $result['Mar'] = $temp3;
            foreach ($accTemp as $acc) {

                $temp4 [] = $this->model_reportsGen->getRecordsMonthlyProv(4, $year, $provID, $acc);
            }
            $result['April'] = $temp4;
            foreach ($accTemp as $acc) {

                $temp5 [] = $this->model_reportsGen->getRecordsMonthlyProv(5, $year, $provID, $acc);
            }
            $result['May'] = $temp5;
            foreach ($accTemp as $acc) {

                $temp6 [] = $this->model_reportsGen->getRecordsMonthlyProv(6, $year, $provID, $acc);
            }
            $result['June'] = $temp6;
            foreach ($accTemp as $acc) {

                $temp7 [] = $this->model_reportsGen->getRecordsMonthlyProv(7, $year, $provID, $acc);
            }
            $result['July'] = $temp7;
            foreach ($accTemp as $acc) {

                $temp8 [] = $this->model_reportsGen->getRecordsMonthlyProv(8, $year, $provID, $acc);
            }
            $result['Aug'] = $temp8;
            foreach ($accTemp as $acc) {

                $temp9 [] = $this->model_reportsGen->getRecordsMonthlyProv(9, $year, $provID, $acc);
            }
            $result['Sept'] = $temp9;
            foreach ($accTemp as $acc) {

                $tempa [] = $this->model_reportsGen->getRecordsMonthlyProv(10, $year, $provID, $acc);
            }
            $result['Oct'] = $tempa;
            foreach ($accTemp as $acc) {

                $tempb [] = $this->model_reportsGen->getRecordsMonthlyProv(11, $year, $provID, $acc);
            }
            $result['Nov'] = $tempb;
            foreach ($accTemp as $acc) {

                $tempc [] = $this->model_reportsGen->getRecordsMonthlyProv(12, $year, $provID, $acc);
            }
            $result['Dec'] = $tempc;
            $result['max'] = $tempMax[0];
            $result['month'] = null;
            $result['city'] = null;
            $result['first'] = null;
            $result['last'] = null;
            $result['monthQuery'] = null;
            $result['regionMonth'] = null;
            $result['regionYear'] = null;
            $result['regionDate'] = null;
        } elseif ($month == null && $city != null && $first == null && $last == null) {
            foreach($accTemp as $acc){
                for($i = 1; $i < 13; $i++){
                    $tempMax [] = $this->model_reportsGen->getRecordsMonthly($i, $year, $city, $acc);
                }
            }
            rsort($tempMax);
            foreach ($accTemp as $acc) {
                $temp1 [] = $this->model_reportsGen->getRecordsMonthly(1, $year, $city, $acc);
            }
            $result['Jan'] = $temp1;
            foreach ($accTemp as $acc) {

                $temp2 [] = $this->model_reportsGen->getRecordsMonthly(2, $year, $city, $acc);
            }
            $result['Feb'] = $temp2;
            foreach ($accTemp as $acc) {

                $temp3 [] = $this->model_reportsGen->getRecordsMonthly(3, $year, $city, $acc);
            }
            $result['Mar'] = $temp3;
            foreach ($accTemp as $acc) {

                $temp4 [] = $this->model_reportsGen->getRecordsMonthly(4, $year, $city, $acc);
            }
            $result['April'] = $temp4;
            foreach ($accTemp as $acc) {

                $temp5 [] = $this->model_reportsGen->getRecordsMonthly(5, $year, $city, $acc);
            }
            $result['May'] = $temp5;
            foreach ($accTemp as $acc) {

                $temp6 [] = $this->model_reportsGen->getRecordsMonthly(6, $year, $city, $acc);
            }
            $result['June'] = $temp6;
            foreach ($accTemp as $acc) {

                $temp7 [] = $this->model_reportsGen->getRecordsMonthly(7, $year, $city, $acc);
            }
            $result['July'] = $temp7;
            foreach ($accTemp as $acc) {

                $temp8 [] = $this->model_reportsGen->getRecordsMonthly(8, $year, $city, $acc);
            }
            $result['Aug'] = $temp8;
            foreach ($accTemp as $acc) {

                $temp9 [] = $this->model_reportsGen->getRecordsMonthly(9, $year, $city, $acc);
            }
            $result['Sept'] = $temp9;
            foreach ($accTemp as $acc) {

                $tempa [] = $this->model_reportsGen->getRecordsMonthly(10, $year, $city, $acc);
            }
            $result['Oct'] = $tempa;
            foreach ($accTemp as $acc) {

                $tempb [] = $this->model_reportsGen->getRecordsMonthly(11, $year, $city, $acc);
            }
            $result['Nov'] = $tempb;
            foreach ($accTemp as $acc) {

                $tempc [] = $this->model_reportsGen->getRecordsMonthly(12, $year, $city, $acc);
            }
            $result['Dec'] = $tempc;
            $result['max'] = $tempMax[0];
            $result['month'] = null;
            $result['city'] = $city;
            $result['first'] = null;
            $result['last'] = null;
            $result['monthQuery'] = null;
            $result['province'] = null;
            $result['regionMonth'] = null;
            $result['regionYear'] = null;
            $result['regionDate'] = null;
        } elseif ($first != null && $last != null && $city != null) {
            foreach ($accTemp as $ac) {
                $tempDate [] = $this->model_reportsGen->getNumberDate($ac, $city, $first, $last);
            }

            $result['monthCount'] = $tempDate;
            $result['month'] = $first . " ~ " . $last;
            $result['first'] = $first;
            $result['last'] = $last;
            $result['monthQuery'] = null;
            $result['province'] = null;
            $result['regionMonth'] = null;
            $result['regionYear'] = null;
            $result['regionDate'] = null;
            $result['max'] = null;
        } elseif ($first != null && $last != null && $prov != null) {
            $provID = $this->model_reportsGen->getProvID($prov);
            foreach ($accTemp as $ac) {
                $tempDate [] = $this->model_reportsGen->getNumberDateProv($ac, $provID, $first, $last);
            }

            $result['monthCount'] = $tempDate;
            $result['month'] = $first . " ~ " . $last;
            $result['first'] = $first;
            $result['last'] = $last;
            $result['monthQuery'] = null;
            $result['city'] = null;
            $result['regionMonth'] = null;
            $result['regionYear'] = null;
            $result['regionDate'] = null;
            $result['max'] = null;
        } elseif ($city == null && $prov == null) {
            if ($first != null && $last != null) {
                foreach ($accTemp as $ac) {
                    $tempDate [] = $this->model_reportsGen->getNumberDateReg($ac, $first, $last);
                }

                $result['monthCount'] = $tempDate;
                $result['month'] = $first . " ~ " . $last;
                $result['first'] = $first;
                $result['last'] = $last;
                $result['monthQuery'] = null;
                $result['province'] = null;
                $result['city'] = null;
                $result['regionDate'] = "all";
                $result['regionMonth'] = null;
                $result['regionYear'] = null;
                $result['max'] = null;
            } elseif ($month == null && $first == null && $last == null) {
                foreach ($accTemp as $acc){
                    for($i = 1; $i < 13; $i++){
                        $tempMax [] = $this->model_reportsGen->getRecordsMonthlyRegion($i, $year, $acc);
                    }
                    
                }
                rsort($tempMax);
                foreach ($accTemp as $acc) {
                    $temp1 [] = $this->model_reportsGen->getRecordsMonthlyRegion(1, $year, $acc);
                }
                $result['Jan'] = $temp1;
                foreach ($accTemp as $acc) {

                    $temp2 [] = $this->model_reportsGen->getRecordsMonthlyRegion(2, $year, $acc);
                }
                $result['Feb'] = $temp2;
                foreach ($accTemp as $acc) {

                    $temp3 [] = $this->model_reportsGen->getRecordsMonthlyRegion(3, $year, $acc);
                }
                $result['Mar'] = $temp3;
                foreach ($accTemp as $acc) {

                    $temp4 [] = $this->model_reportsGen->getRecordsMonthlyRegion(4, $year, $acc);
                }
                $result['April'] = $temp4;
                foreach ($accTemp as $acc) {

                    $temp5 [] = $this->model_reportsGen->getRecordsMonthlyRegion(5, $year, $acc);
                }
                $result['May'] = $temp5;
                foreach ($accTemp as $acc) {

                    $temp6 [] = $this->model_reportsGen->getRecordsMonthlyRegion(6, $year, $acc);
                }
                $result['June'] = $temp6;
                foreach ($accTemp as $acc) {

                    $temp7 [] = $this->model_reportsGen->getRecordsMonthlyRegion(7, $year, $acc);
                }
                $result['July'] = $temp7;
                foreach ($accTemp as $acc) {

                    $temp8 [] = $this->model_reportsGen->getRecordsMonthlyRegion(8, $year, $acc);
                }
                $result['Aug'] = $temp8;
                foreach ($accTemp as $acc) {

                    $temp9 [] = $this->model_reportsGen->getRecordsMonthlyRegion(9, $year, $acc);
                }
                $result['Sept'] = $temp9;
                foreach ($accTemp as $acc) {

                    $tempa [] = $this->model_reportsGen->getRecordsMonthlyRegion(10, $year, $acc);
                }
                $result['Oct'] = $tempa;
                foreach ($accTemp as $acc) {

                    $tempb [] = $this->model_reportsGen->getRecordsMonthlyRegion(11, $year, $acc);
                }
                $result['Nov'] = $tempb;
                foreach ($accTemp as $acc) {

                    $tempc [] = $this->model_reportsGen->getRecordsMonthlyRegion(12, $year, $acc);
                }
                $result['Dec'] = $tempc;
                $result['month'] = null;
                $result['city'] = null;
                $result['first'] = null;
                $result['last'] = null;
                $result['monthQuery'] = null;
                $result['province'] = null;
                $result['regionYear'] = "all";
                $result['regionMonth'] = null;
                $result['regionDate'] = null;
                $result['max'] = $tempMax[0];
            } elseif ($month != null && $first == null && $last == null) {
                $monthName = date("F", mktime(0, 0, 0, $month, 10));

                foreach ($accTemp as $acc) {
                    $temp [] = $this->model_reportsGen->getRecordsMonthlyRegion($month, $year, $acc);
                }
                $result['monthCount'] = $temp;
                $result['month'] = $monthName;
                $result['monthQuery'] = $monthName;
                $result['city'] = $city;
                $result['first'] = null;
                $result['last'] = null;
                $result['province'] = null;
                $result['regionMonth'] = "all";
                $result['regionYear'] = null;
                $result['regionDate'] = null;
                $result['max'] = null;
            }
        }

        $result['accidents'] = $this->model_reportsGen->getAccidents();
        $result['year'] = $this->model_reportsGen->getYear();
        $result['cities'] = $this->model_reportsGen->getAllMuniCity();
        $result['prov'] = $this->model_reportsGen->getProvinces();

        $this->load->view('periodicReports', $result);
    }

    public function getContents() {
        $item = $this->input->post("prov");
        $provid = $this->model_map->getProvID($item);
        $city = $this->model_map->getMuniCityOption($provid);
        echo json_encode($city);
    }

    public function getBrgy() {
        $item = $this->input->post("muni");
        $muniID = $this->model_map->getMuniID($item);
        $brgy = $this->model_map->getBrgyOption($muniID);
        echo json_encode($brgy);
    }

    public function getBrgyName() {
        $item = $this->input->post("brgy");
        $brgy = $this->model_map->getBrgyName($item);
        echo json_encode($brgy);
    }

    public function getEditContents() {
        $item = $this->input->post("city");
        $prov = $this->model_map->getSpecProvince($item);
        echo json_encode($prov);
    }

    public function getEditCity() {
        $item = $this->input->post("city");
        $prov = $this->model_map->getSpecProvince($item);
        echo json_encode($prov);
    }

    public function getReportDetails() {
        $accident = $this->input->post("type");
        $year = $this->input->post("year");
        $city = $this->input->post("city");
        $detail = $this->model_reportsGen->getDetails($year, $city, $accident);
        echo json_encode($detail);
    }

    public function getReportDetailsProv() {
        $prov = $this->input->post("prov");
        $accident = $this->input->post("type");

        $provID = $this->model_reportsGen->getProvID($prov);
        $year = $this->input->post("year");
        $detail = $this->model_reportsGen->getDetailsProv($year, $provID, $accident);

        echo json_encode($detail);
    }

    public function getReportDetailsYrMon() {
        $accident = $this->input->post("type");
        $year = $this->input->post("year");
        $monthQuery = $this->input->post("month");
        $month = date("m", strtotime($monthQuery));
        $city = $this->input->post("city");
        $detail = $this->model_reportsGen->getDetailsMon($year, $city, $accident, $month);

        echo json_encode($detail);
    }

    public function getReportDetailsYrMonProv() {
        $accident = $this->input->post("type");
        $year = $this->input->post("year");
        $monthQuery = $this->input->post("month");
        $month = date("m", strtotime($monthQuery));
        $provID = $this->model_reportsGen->getProvID($this->input->post("prov"));
        $detail = $this->model_reportsGen->getDetailsMonProv($year, $provID, $accident, $month);

        echo json_encode($detail);
    }

    public function getReportDetailsDate() {
        $accident = $this->input->post("type");
        $first = $this->input->post("first");
        $last = $this->input->post("last");
        $city = $this->input->post("city");
        $detail = $this->model_reportsGen->getDetailsDate($first, $city, $accident, $last);

        echo json_encode($detail);
    }

    public function getReportDetailsDateProv() {
        $accident = $this->input->post("type");
        $first = $this->input->post("first");
        $last = $this->input->post("last");
        $provID = $this->model_reportsGen->getProvID($this->input->post("prov"));
        $detail = $this->model_reportsGen->getDetailsDateProv($first, $provID, $accident, $last);

        echo json_encode($detail);
    }

    public function regionReportDate() {
        $accident = $this->input->post("type");
        $first = $this->input->post("first");
        $last = $this->input->post("last");
        $details = $this->model_reportsGen->getDetailsRegionDate($first, $accident, $last);

        echo json_encode($details);
    }

    public function regionReportMonth() {
        $accident = $this->input->post("type");
        $monthQuery = $this->input->post("month");
        $year = $this->input->post("year");
        $month = date("m", strtotime($monthQuery));
        $detail = $this->model_reportsGen->getDetailsRegionMon($year, $accident, $month);

        echo json_encode($detail);
    }

    public function regionReportYear() {
        $accident = $this->input->post("type");
        $year = $this->input->post("year");

        $detail = $this->model_reportsGen->getDetailsRegionYear($year, $accident);

        echo json_encode($detail);
    }

}

