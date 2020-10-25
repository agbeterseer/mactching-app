<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

 
Route::get('/', 'UserController@welcome');

Auth::routes();
Route::group(array('before' => 'auth', 'after' => 'no-cache'),  function (){
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/uploadFile/list', 'StaffEligibilityController@index'); // localhost:8000/
Route::post('/uploadFile', 'StaffEligibilityController@uploadStaffList');

//////////////// UPLOAD PAYMENT REPORT ////////////////////////////////////////

Route::get('/staffreport/list', 'StaffPaymentReportController@index'); // localhost:8000/
Route::post('/staffreport/uploadFile', 'StaffPaymentReportController@uploadStaffListPaymentReport')->name('uploadFile');
Route::get('/staffreport/monthly_report_form', 'StaffPaymentReportController@showListOFPFAByMDAForm')->name('showpfa_upload_form');

Route::get('/staffreport/uploadRegisterdListForm2/{mda_id}', 'StaffPaymentReportController@uploadRegisterdListForm2')->name('upload_form2');
Route::post('/uploadRegisterdList2', 'StaffPaymentReportController@uploadRegisterdList2')->name('upload.reg_list2');
Route::post('/match-monthly-reports', 'MatchController@matchMonthlyRecords')->name('match_monthly_records');
Route::get('/staffreport/setup_match2/mda_id/{mda_id}', 'StaffPaymentReportController@setUpMatch2')->name('setup_match2');

Route::get('/staffreport/match-results/{mda_id}', 'MatchController@showData2')->name('show_results2');
//////////////// upload Registered PFA//////////////////
Route::get('/show_pfa_upload_form', 'PFAController@showListOFPFAByMDAForm')->name('showpfa_upload_form');
Route::post('/uploadRegisterdList', 'PFAController@uploadRegisterdList')->name('upload.reg_list');
Route::get('/uploadRegisterdListForm/{mda_id}', 'PFAController@uploadRegisterdListForm')->name('upload_form');
Route::get('/setup_match/mda_id/{mda_id}', 'PFAController@setUpMatch')->name('setup_match');
Route::post('/matchRecords', 'MatchController@matchRecords')->name('matchrecords');
Route::get('/show-match-results/{mda_id}', 'MatchController@showData')->name('show_results');
Route::get('/show-pfa-list/{mda_id}','PFAController@showDataByMDA')->name('show_pfas');


//// /////////////// march two ///////////////////////
// Route::post('/setup_match/uploadRegisterdList', 'PFAController@uploadStaffListPaymentReport')->name('upload.reg_list');



///////////////////////////// STAFF ELIGIBILITY ////////////////////////////
Route::get('/staff-result/{mda_id}', 'StaffEligibilityController@showStaffList')->name('stafflist');


Route::resource('pfa', 'PFAController');
Route::resource('staff', 'StaffEligibilityController');
Route::resource('match', 'MatchController');
Route::resource('staffpayment', 'StaffPaymentReportController');

});