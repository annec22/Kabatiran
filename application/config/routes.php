<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "adminSystem";
$route['404_override'] = '';
$route['dirMap'] = "publicDirMap/getMap";
$route['main'] = "adminSystem/main";
$route['home'] = "adminSystem/home";
$route['logout'] = "adminSystem/logout";
$route['fbLogout'] = "adminSystem/fbLogout";
$route['periodicReports'] = "adminSystem/periodicRep";
$route['addMapLocation'] = "adminSystem/addLocation";
$route['getContents'] = "adminSystem/getContents";
$route['getMapBrgy'] = "adminSystem/getBrgy";
$route['getEditContents'] = "adminSystem/getEditContents";
$route['editMarker'] = "adminSystem/editMarker";
$route['delMarker'] = "adminSystem/delMarker";
$route['searchLocation'] = "adminSystem/searchLocation";
$route['public_map'] = "adminSystem/public_map";
$route['seeMore'] = "adminSystem/seeMore";
$route['regionReportDate'] = "adminSystem/regionReportDate";
$route['regionReportYear'] = "adminSystem/regionReportYear";
$route['regionReportMonth'] = "adminSystem/regionReportMonth";
$route['getReportDetails'] = "adminSystem/getReportDetails";
$route['getReportDetailsProv'] = "adminSystem/getReportDetailsProv";
$route['getReportDetailsYrMon'] = "adminSystem/getReportDetailsYrMon";
$route['getReportDetailsYrMonProv'] = "adminSystem/getReportDetailsYrMonProv";
$route['getReportDetailsDate'] = "adminSystem/getReportDetailsDate";
$route['getReportDetailsDateProv'] = "adminSystem/getReportDetailsDateProv";
$route['yearlyReports'] = "adminSystem/yearlyReports";
$route['generateReports'] = "adminSystem/generateReports";
$route['getCount'] = "adminSystem/getCount";
$route['seeMore'] = "adminSystem/seeMore";

$route['addAcc'] = "accounts/addAcc/";
$route['deleteAcc'] = "accounts/deleteAcc/";
$route['resetPw'] = "accounts/resetPw";
$route['changePassword'] = "accounts/changePassword";
$route['getadminID'] = "accounts/getadminID/";
$route['getAcc'] = "accounts/getAcc/";
$route['editAcc'] = "accounts/editAcc/";
$route['checkAcc'] = "accounts/checkAcc/";
$route['ifUsernameExist'] = "accounts/ifUsernameExist/";

$route['getDir'] = "directoryList/getDir/";
$route['editDir'] = "directoryList/editDir";

$route['getServerDateTime'] = "bulletin/getServerDateTime/";
$route['addPost'] = "bulletin/addPost/";
$route['tweetPost'] = "bulletin/tweetPost";
$route['deleteBulletin'] = "bulletin/deleteBulletin/";
$route['getbulletinUpdate'] = "bulletin/getbulletinUpdate/";

$route['deleteLog'] = "logs/deleteLog/";

$route['getFMun'] = "parameters/getFMun/";
$route['getFBrgy'] = "parameters/getFBrgy/";
$route['getFAgency'] = "parameters/getFAgency/";
$route['getProbContacts'] = "parameters/getProbContacts/";
$route['getAllAgencies'] = "parameters/getAllAgencies";
$route['pAddBrgy'] = "parameters/pAddBrgy/";
$route['pAddDirectory'] = "parameters/pAddDirectory/";
$route['pAddEType'] = "parameters/pAddEType/";
$route['pAddCat'] = "parameters/pAddCat/";
$route['pAddMun'] = "parameters/pAddMun/";
$route['pAddProv'] = "parameters/pAddProv/";
$route['pAddAgency'] = "parameters/pAddAgency/";
$route['editAgency'] = "parameters/editAgency/";
$route['pAddLocation'] = "parameters/pAddLocation/";
$route['pAddEOffice'] = "parameters/pAddEOffice/";
$route['getEstabO'] = "parameters/getEstabO/";
$route['deleteDirectory'] = "parameters/deleteDirectory/";
$route['deleteEstabOffice'] = "parameters/deleteEstabOffice/";
$route['deleteLocation'] = "parameters/deleteLocation/";
$route['editLocation'] = "parameters/editLocation/";
$route['editEOffice'] = "parameters/editEOffice/";
$route['editDirectory'] = "parameters/editDirectory/";
$route['pAddAccidentType'] = "parameters/pAddAccidentType/";
$route['deleteProv'] = "parameters/deleteProv/";
$route['deleteMun'] = "parameters/deleteMun/";
$route['deleteBrgy'] = "parameters/deleteBrgy/";
$route['deleteEstab'] = "parameters/deleteEstab/";
$route['deleteCategory'] = "parameters/deleteCategory/";
$route['deleteAgency'] = "parameters/deleteAgency/";
$route['deleteAccidentType'] = "parameters/deleteAccidentType/";
$route['deleteContacts'] = "parameters/deleteContacts/";
$route['deleteContactLoc'] = "parameters/deleteContactLoc/";
$route['deleteContactEstab'] = "parameters/deleteContactEstab/";
$route['exportContacts'] = "parameters/exportContacts/";
$route['genCode'] = "parameters/genCode/";
$route['getContact'] = "parameters/getContact/";
$route['getProv'] = "parameters/getProv/";
$route['getMun'] = "parameters/getMun/";
$route['getBrgy'] = "parameters/getBrgy/";
$route['getEstab'] = "parameters/getEstab/";
$route['getCat'] = "parameters/getCat/";
$route['getAgency'] = "parameters/getAgency/";
$route['getAccidentType'] = "parameters/getAccidentType/";
$route['editProv'] = "parameters/editProv/";
$route['editMun'] = "parameters/editMun/";
$route['editBrgy'] = "parameters/editBrgy/";
$route['editEstab'] = "parameters/editEstab/";
$route['editCat'] = "parameters/editCat/";
$route['editAccidentType'] = "parameters/editAccidentType/";
$route['getFAgency'] = "parameters/getFAgency/";
$route['do_upload'] = "parameters/do_upload/";

$route['getReport'] = "reportInbox/getReport";
$route['readReport'] = "reportInbox/readReport";
$route['reportIndex'] = "reportInbox/index/";
$route['deleteReport'] = "reportInbox/deleteReport/";
$route['trashReport'] = "reportInbox/trashReport/";
$route['confirmReport'] = "reportInbox/confirmReport/";
$route['spamReport'] = "reportInbox/spamReport/";
$route['getStatus'] = "reportInbox/getStatus/";
$route['restoreReport'] = "reportInbox/restoreReport/";
$route['checkIfConfirmed'] = "reportInbox/checkIfConfirmed/";
$route['checkIfConfirmed'] = "reportInbox/checkIfConfirmed/";
$route['uploadReport'] = "reportInbox/uploadReport/";
$route['uploadImage'] = "reportInbox/uploadImage/";


$route['getBrgyLoc'] = "adminSystem/getBrgyLoc";

//$route['(:any)'] = 'error_mess';
/* End of file routes.php */
/* Location: ./application/config/routes.php */