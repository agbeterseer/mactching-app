<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MDAService;
use App\Services\PFAService;  
use App\StaffEligibility;
use App\MatchedRecord;
use App\MatchedStaffPaymentRecords;
use App\StaffPaymentReport;
use Session;
use DB;
use Carbon\Carbon;
class MatchController extends Controller
{
 
    protected $mdaService;
    protected $pfaService; 

    public function __construct(MDAService $mdaService, PFAService $pfaService)
	{
        $this->mdaService = $mdaService;
        $this->pfaService = $pfaService; 
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
      
    }

    public function showData($mda_abbrev)
    {
       try {
            $computedList = MatchedRecord::where('mda_id', $mda_abbrev)->get();
       } catch (\Throwable $th) {
           return redirect()->back()->with('error', $th->getMessage());
       }

       try {
            $unmatched = StaffEligibility::where('mda', $mda_abbrev)->where('status', 'un-matched')->get();
       } catch (\Throwable $th) {
        return redirect()->back()->with('error', $th->getMessage());
       }
 
        return view('admin.match.index', compact('computedList', 'unmatched'));
    }

    public function showData2($mda_abbrev)
    {
        //dd($mda_abbrev);
       try {
            $computedList = MatchedStaffPaymentRecords::where('mda', $mda_abbrev)->get();
       } catch (\Throwable $th) {
        return redirect()->back()->with(['error' => $th->getMessage()]);
       }

       try {
          
            $unmatched = DB::table('staff_payment_reports')->Where('mda', $mda_abbrev)->where('status', 'un-matched')->get();
          
       } catch (\Throwable $th) {
        return redirect()->back()->with(['error' => $th->getMessage()]);
       }
 
        return view('admin.match.matched_results', compact('computedList', 'unmatched'));
    }

    public function getUnmatched($mda_abbrev)
    {
        $unmatched = DB::table('staff_payment_reports')->Where('mda', $mda_abbrev)->where('status', 'un-matched')->get();
    }

    public function uploadMDAFile(Request $request)
    {
        try {
            
        $data = $this->mdaService->uploadMDAFile($request);
 
        } catch (\Exception $th) {  
            return redirect()->back()->with(['error' => $th->getMessage()]);
        } 

        return redirect()->back();
    }
  
    public function findByMDAAndStaffID($mda_id, $staff_id)
    {
        $singleRecord = DB::table('staff_eligibilities')->where('mda', $mda_id)->where('staff_id', $staff_id)->first();
        return $singleRecord;
    }

    public function findByMDAAndDateOfBirth($mda_id, $date_of_birth)
    {
        $singleRecord = DB::table('staff_eligibilities')->where('mda', $mda_id)
        ->where('date_of_birth', $date_of_birth) 
        ->first();
     
        return $singleRecord;
    }

    public function findByMDAAndSurnameAndFirstnameAndOthernames($mda_id, $surname, $firstname, $othernames)
    {
        $singleRecord = DB::table('staff_eligibilities')
        ->where('mda', $mda_id)
        ->where('surname', $surname)
        ->orwhere('firstname', $firstname)
        ->orwhere('othernames', $othernames)
        ->orwhere('surname', $firstname)
        ->first();
        return $singleRecord;
    }
    // public function scopeSearch($query, $s)
    // {
    //  return $query->where('firstname', 'like', '%' .$s. '%')
    //      ->orWhere('middelname', 'like', '%' .$s. '%')
    //      ->orWhere('lastname', 'like', '%' .$s. '%');
    // }

    public function findByMDA($mda_id)
    {
        $singleRecord = DB::table('staff_eligibilities')->where('mda', $mda_id)
        ->first();
        return $singleRecord;
    }

    public function findByMDAANDPIN($mda_id, $rsa_pin)
    {
        $singleRecord = DB::table('staff_payment_reports')
        ->Where('mda', $mda_id)
        ->where('rsa_pin', $rsa_pin) 
        ->first(); 
        return $singleRecord;
    }
 
    public function findEligibleStaffListByMDA($mda_id)
    {
      return $pfa_list = DB::table('staff_eligibilities')->Where('mda', $mda_id)->get();
    }

    public function findPFAByMDA($mda_id)
    {
      return $pfa_list = DB::table('p_i_n_generated_reports')->Where('mda_id', $mda_id)->get();
    }

    public function findMonthlyReportByMDA($mda_id)
    {
      return $pfa_list = DB::table('staff_monthly_payment_reports')->Where('mda', $mda_id)->get();
    }

    public function findPFAByMDASingleRecord($mda_id, $staff_id)
    {
        try {
            
            $pfa_list = DB::table('p_i_n_generated_reports')->where('mda_id', $mda_id)->where('staff_id', $staff_id)->exist();
          
        } catch (\Throwable $th) {
            //throw $th;
        }
  
       return $pfa_list;
    }
 
    public function matchRecords(Request $request)
    {
    
        $mda_abbrev = $request->match;
        $match_option = $request->match_option;
        $resultsArray = [];  // to hold the final array
        $eligibilities = [];
        $registeredPFA = [];

        // view all Pin Generated List // Get the Staff_id
        try {

            $pfa_list = $this->findPFAByMDA($mda_abbrev);
         
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
      

        if ($match_option === "match_by_name") {
            //dd('here');
            $this->matchRecordsByName($pfa_list, $mda_abbrev);
            return redirect()->action('MatchController@showData', ['mda_abbrev' => $mda_abbrev]);
        }elseif($match_option === "match_by_staff_id"){
            //dd('here');
            $this->matchRecordsByStaffID($pfa_list, $mda_abbrev);
            return redirect()->action('MatchController@showData', ['mda_abbrev' => $mda_abbrev]);
        }
        // add to the new array 
        return redirect()->back();
    }

    public function matchRecordsByName($pfa_list, $mda_abbrev)
    {
        // Load Registered PFAs
        // $registeredPFA[] = $pfa_list; 
        $computedData = [];
        // $newArray = [];
        // $PFARepartList = [];
        $computedDataNullValuse = [];
       
        try {
          
            // goto staffList and find a match
            // return the record from staffList and Pin Generated List
                    // $resultsArray[] = $this->findByMDA($mda_abbrev); 
                    $resultsArray = $this->findEligibleStaffListByMDA($mda_abbrev); // PFA List 
                    
                for ($i=0; $i < sizeof($pfa_list); $i++) {  
                    // $resultsArray[] = $this->findByMDAAndSurnameAndFirstnameAndOthernames($pfa_list[$i]->mda_id, $pfa_list[$i]->surname, $pfa_list[$i]->firstname, $pfa_list[$i]->othernames);
                 
                    for ($j=0; $j < sizeof($resultsArray); $j++) { 

                        if ($pfa_list[$i]->surname == $resultsArray[$j]->surname) {
                 $staff_records = DB::table('staff_eligibilities')->where('staff_id', $resultsArray[$j]->staff_id)
                            ->update(['status'=>'matched']);
                            $computedData[] = array( 
                                'staff_id1'=>$resultsArray[$j]->staff_id,
                                'surname1'=>$resultsArray[$j]->surname,
                                'firstname1'=>$resultsArray[$j]->firstname,
                                'othernames1'=>$resultsArray[$j]->othernames,
                                'gender1'=>$resultsArray[$j]->gender,
                                'date_of_birth1'=>$resultsArray[$j]->date_of_birth,
                                'date_of_first_appt1'=>$resultsArray[$j]->date_of_first_appt,
                                'grade_level1'=>$resultsArray[$j]->grade_level,
                                'qualification1'=>$resultsArray[$j]->qualification,
                                'confirmation1'=>$resultsArray[$j]->confirmation,
                                'gross_pay1'=>$resultsArray[$j]->gross_pay,

                                'rsa_pin' =>$pfa_list[$i]->rsa_pin,
                                'form_ref_no'=>$pfa_list[$i]->form_ref_no,
                                'surname'=>$pfa_list[$i]->surname,
                                'firstname'=>$pfa_list[$i]->firstname,
                                'othernames'=>$pfa_list[$i]->othernames,
                                'gender'=>$pfa_list[$i]->gender,
                                'date_of_birth'=>$pfa_list[$i]->date_of_birth,
                                'nin'=>$pfa_list[$i]->nin,
                                'phone_no'=>$pfa_list[$i]->phone_no,
                                'email'=>$pfa_list[$i]->email,
                                'institution_name'=>$pfa_list[$i]->institution_name,
                                'date_of_first_appt'=>$pfa_list[$i]->date_of_first_appt,
                                'staff_id'=>$pfa_list[$i]->staff_id,
                                'pin_reg_date'=>$pfa_list[$i]->pin_reg_date,
                                'mda_id'=>$pfa_list[$i]->mda_id,
                           );
                        }
           

                    }
                               
                        
                }  // outer loop

              //  dd($computedData); 
            } catch (\Throwable $th) {
                // MatchedRecord::insertData($computedData);
               return redirect()->back()->with('error', $th->getMessage()); //dd($resultsArray);
            }
           
    
            MatchedRecord::insertData($computedData);

            return redirect()->action('MatchController@showData', ['mda_abbrev' => $mda_abbrev]);
    }

    public function matchRecordsByStaffID($pfa_list, $mda_abbrev)
    {
        dd('staffID');
      //  
        $mda_abbrev = $request->match;
        $resultsArray = [];  // to hold the final array
        $eligibilities = [];
        $registeredPFA = [];

        // view all Pin Generated List // Get the Staff_id
        try {

            $pfa_list = $this->findPFAByMDA($mda_abbrev);
            
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

 
        // Load Registered PFAs
        $registeredPFA[] = $pfa_list; 
        $computedData = [];
        $newArray = [];
        $PFARepartList = [];
        $computedDataNullValuse = [];

        try {
            // goto staffList and find a match
            // return the record from staffList and Pin Generated List
         
                for ($i=0; $i < sizeof($pfa_list); $i++) {
                                  
                    $resultsArray[] = $this->findByMDAAndStaffID($pfa_list[$i]->mda_id, $pfa_list[$i]->staff_id);
               
                        for ($j=0; $j < sizeof($resultsArray) ; $j++) {  
                             
                            if ($pfa_list[$i]->surname == $resultsArray[$j]->surname) {  
                              
                            $staff_records = DB::table('staff_eligibilities')->where('staff_id', $resultsArray[$j]->staff_id)
                              ->update(['status'=>'matched']);
                                                  
                                $computedData[] = array(
                                    'staff_id1'=>$resultsArray[$j]->staff_id,
                                    'surname1'=>$resultsArray[$j]->surname,
                                    'firstname1'=>$resultsArray[$j]->firstname,
                                    'othernames1'=>$resultsArray[$j]->othernames,
                                    'gender1'=>$resultsArray[$j]->gender,
                                    'date_of_birth1'=>$resultsArray[$j]->date_of_birth,
                                    'date_of_first_appt1'=>$resultsArray[$j]->date_of_first_appt,
                                    'grade_level1'=>$resultsArray[$j]->grade_level,
                                    'qualification1'=>$resultsArray[$j]->qualification,
                                    'confirmation1'=>$resultsArray[$j]->confirmation,
                                    'gross_pay1'=>$resultsArray[$j]->gross_pay,

                                    'rsa_pin' =>$pfa_list[$i]->rsa_pin,
                                    'form_ref_no'=>$pfa_list[$i]->form_ref_no,
                                    'surname'=>$pfa_list[$i]->surname,
                                    'firstname'=>$pfa_list[$i]->firstname,
                                    'othernames'=>$pfa_list[$i]->othernames,
                                    'gender'=>$pfa_list[$i]->gender,
                                    'date_of_birth'=>$pfa_list[$i]->date_of_birth,
                                    'nin'=>$pfa_list[$i]->nin,
                                    'phone_no'=>$pfa_list[$i]->phone_no,
                                    'email'=>$pfa_list[$i]->email,
                                    'institution_name'=>$pfa_list[$i]->institution_name,
                                    'date_of_first_appt'=>$pfa_list[$i]->date_of_first_appt,
                                    'staff_id'=>$pfa_list[$i]->staff_id,
                                    'pin_reg_date'=>$pfa_list[$i]->pin_reg_date,
                                    'mda_id'=>$pfa_list[$i]->mda_id,
                                   
                                    'created_at' => new Carbon(),
                                ); 
                            }else{
                               
                                $computedDataNullValuse[] = array(
                                    'staff_id1'=>'',
                                    'surname1'=>'',
                                    'firstname1'=>'',
                                    'othernames1'=>'',
                                    'gender1'=>'',
                                    'date_of_birth1'=>'',
                                    'date_of_first_appt1'=>'',
                                    'grade_level'=>'',
                                    'qualification1'=>'',
                                    'confirmation1'=>'',
                                    'gross_pay1'=>'',

                                    'rsa_pin' =>'',
                                    'form_ref_no'=>'',
                                    'surname'=>'',
                                    'firstname'=>'',
                                    'othernames'=>'',
                                    'gender'=>'',
                                    'date_of_birth'=>'',
                                    'nin'=>'',
                                    'phone_no'=>'',
                                    'email'=>'',
                                    'institution_name'=>'',
                                    'date_of_first_appt'=>'',
                                    'staff_id'=>'',
                                    'pin_reg_date'=>'',
                                    'mda_id'=>'', 
                                    'created_at' =>'',
                                ); 
                            }
                          
                        }
                        
                }  // outer loop
            } catch (\Throwable $th) {
                MatchedRecord::insertData($computedData);
                //return redirect()->back()->with('error', $th->getMessage());
            }
          
         
            MatchedRecord::insertData($computedData);
           // $this->showData($computedData);  
        // add to the new array 
        return redirect()->action('MatchController@showData', ['mda_abbrev' => $mda_abbrev]);
    }

    

    public function mergeStaffEligibilityAndPFAList($resultsArray, $pfa_list)
    {
        $testarray = [];
        for ($i=0; $i < sizeof($pfa_list); $i++) {
           
            for ($j=0; $j < sizeof($resultsArray) ; $j++) { 
              
                dd($resultsArray[$j]->firstname); 
                    if($pfa_list[$i]->firstname == $resultsArray[$j]->firstname){
                        
                        $testarray = array(
                            'staff_id1'=>$resultsArray[$j]->staff_id,
                            'surname1'=>$resultsArray[$j]->surname,
                            'firstname1'=>$resultsArray[$j]->firstname,
                            'othernames1'=>$resultsArray[$j]->othernames,
                            'gender1'=>$resultsArray[$j]->gender,
                            'date_of_birth1'=>$resultsArray[$j]->date_of_birth,
                            'date_of_first_appt1'=>$resultsArray[$j]->date_of_first_appt,
                            'grade_level1'=>$resultsArray[$j]->grade_level,
                            'qualification1'=>$resultsArray[$j]->qualification,
                            'confirmation1'=>$resultsArray[$j]->confirmation,
                            'gross_pay1'=>$resultsArray[$j]->gross_pay,
                        );
                       
                    }
                  
            }
           
        }

      
        $computedData = [];
        for ($j=0; $j < sizeof($resultsArray) ; $j++) { 
        //      $staff_records = DB::table('staff_eligibilities')->where('staff_id', $resultsArray[$j]->staff_id)
        //                     ->update(['status'=>'matched']);
             
                        $computedData = array(
                                    'staff_id1'=>$resultsArray[$j]->staff_id,
                                    'surname1'=>$resultsArray[$j]->surname,
                                    'firstname1'=>$resultsArray[$j]->firstname,
                                    'othernames1'=>$resultsArray[$j]->othernames,
                                    'gender1'=>$resultsArray[$j]->gender,
                                    'date_of_birth1'=>$resultsArray[$j]->date_of_birth,
                                    'date_of_first_appt1'=>$resultsArray[$j]->date_of_first_appt,
                                    'grade_level1'=>$resultsArray[$j]->grade_level,
                                    'qualification1'=>$resultsArray[$j]->qualification,
                                    'confirmation1'=>$resultsArray[$j]->confirmation,
                                    'gross_pay1'=>$resultsArray[$j]->gross_pay,

                        //             'rsa_pin' =>$pfa_list[$i]->rsa_pin,
                        //             'form_ref_no'=>$pfa_list[$i]->form_ref_no,
                        //             'surname'=>$pfa_list[$i]->surname,
                        //             'firstname'=>$pfa_list[$i]->firstname,
                        //             'othernames'=>$pfa_list[$i]->othernames,
                        //             'gender'=>$pfa_list[$i]->gender,
                        //             'date_of_birth'=>$pfa_list[$i]->date_of_birth,
                        //             'nin'=>$pfa_list[$i]->nin,
                        //             'phone_no'=>$pfa_list[$i]->phone_no,
                        //             'email'=>$pfa_list[$i]->email,
                        //             'institution_name'=>$pfa_list[$i]->institution_name,
                        //             'date_of_first_appt'=>$pfa_list[$i]->date_of_first_appt,
                        //             'staff_id'=>$pfa_list[$i]->staff_id,
                        //             'pin_reg_date'=>$pfa_list[$i]->pin_reg_date,
                        //             'mda_id'=>$pfa_list[$i]->mda_id,
                                   
                        //             'created_at' => new Carbon(),
                        );
        }
        return $computedData;
    }


    public function matchMonthlyRecords(Request $request)
    {
      //  
   
        $mda_abbrev = $request->match;
        $resultsArray = [];  // to hold the final array
        $eligibilities = [];
        $registeredPFA = [];

        // view all Pin Generated List // Get the Staff_id
        try {

            $pfa_list = $this->findMonthlyReportByMDA($mda_abbrev); 
            // $staffPaymentReports = DB::table('staff_payment_reports')->where($mda_abbrev)->get();
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

      
        // Load Registered PFAs
        $registeredPFA[] = $pfa_list; 
        $computedData = [];
        $newArray = [];
        $PFARepartList = [];
        $computedDataNullValuse = [];

        try {
            // goto staffList and find a match
            // return the record from staffList and Pin Generated List
         
                for ($i=0; $i < sizeof($pfa_list); $i++) {  
                
                    // $resultsArray[] = $this->findByMDAAndStaffID($mda_abbrev, $pfa_list[$i]->staff_id); //$mda_id, $staff_id, $date_of_birth
                    $resultsArray[] = $this->findByMDAANDPIN($mda_abbrev, $pfa_list[$i]->rsa_pin); 

                    // $newArray['0'] = $resultsArray;
                        for ($j=0; $j < sizeof($resultsArray); $j++) {  

                            if ($resultsArray[$j]->gross_pay === $pfa_list[$i]->gross_pay) {
                             $staff_records = DB::table('staff_payment_reports')->where('rsa_pin', $resultsArray[$j]->rsa_pin)
                              ->update(['status'=>'matched']);
                                    $computedData[] = array(
                                    'rsa_pin'=>$resultsArray[$j]->rsa_pin,
                                    'surname'=>$resultsArray[$j]->surname,
                                    'firstname'=>$resultsArray[$j]->firstname,
                                    'othernames'=>$resultsArray[$j]->othernames,
                                    'gender'=>$resultsArray[$j]->gender,
                                    'phone_no'=>$resultsArray[$j]->phone_no,
                                    'pfa_name'=>$resultsArray[$j]->pfa_name,
                                    'staff_id'=>$resultsArray[$j]->staff_id,
                                    'gross_pay'=>$resultsArray[$j]->gross_pay,
                                    'ten_percent'=>$resultsArray[$j]->ten_percent,
                                    'eight_percent'=>$resultsArray[$j]->eight_percent,
                                    'mda'=>$resultsArray[$j]->mda, 
 
                                    'rsa_pin1' =>$pfa_list[$i]->rsa_pin, 
                                    'surname1'=>$pfa_list[$i]->surname,
                                    'firstname1'=>$pfa_list[$i]->firstname,
                                    'othernames1'=>$pfa_list[$i]->othernames,
                                    'gender1'=>$pfa_list[$i]->gender,
                                    'phone_no1'=>$pfa_list[$i]->phone_no, 
                                    'pfa_name1'=>$pfa_list[$i]->pfa_name,
                                    'staff_id1'=>$pfa_list[$i]->staff_id,
                                    'gross_pay1'=>$pfa_list[$i]->gross_pay,
                                    'ten_percent1'=>$pfa_list[$i]->ten_percent,
                                    'mda1'=>$pfa_list[$i]->mda, 
                                    'created_at' => new Carbon(),
                                );
                            }
                          
                                // $computedData[] = array(
                                //     'rsa_pin'=>$resultsArray[$j]->rsa_pin,
                                //     'surname'=>$resultsArray[$j]->surname,
                                //     'firstname'=>$resultsArray[$j]->firstname,
                                //     'othernames'=>$resultsArray[$j]->othernames,
                                //     'gender'=>$resultsArray[$j]->gender,
                                //     'phone_no'=>$resultsArray[$j]->phone_no,
                                //     'pfa_name'=>$resultsArray[$j]->pfa_name,
                                //     'staff_id'=>$resultsArray[$j]->staff_id,
                                //     'gross_pay'=>$resultsArray[$j]->gross_pay,
                                //     'ten_percent'=>$resultsArray[$j]->ten_percent,
                                //     'eight_percent'=>$resultsArray[$j]->eight_percent,
                                //     'mda'=>$resultsArray[$j]->mda, 

                                    // 'rsa_pin1' =>$pfa_list[$i]->rsa_pin, 
                                    // 'surname1'=>$pfa_list[$i]->surname,
                                    // 'firstname1'=>$pfa_list[$i]->firstname,
                                    // 'othernames1'=>$pfa_list[$i]->othernames,
                                    // 'gender1'=>$pfa_list[$i]->gender,
                                    // 'phone_no1'=>$pfa_list[$i]->phone_no, 
                                    // 'pfa_name1'=>$pfa_list[$i]->pfa_name,
                                    // 'staff_id1'=>$pfa_list[$i]->staff_id,
                                    // 'gross_pay1'=>$pfa_list[$i]->gross_pay,
                                    // 'ten_percent1'=>$pfa_list[$i]->ten_percent,
                                    // 'eight_percent1'=>$pfa_list[$i]->eight_percent, 
                                    // 'mda1'=>$pfa_list[$i]->mda_id, 
                                    // 'created_at' => new Carbon(),
                                // );

                          
                          
                                }
                       
                   
                }  // outer loop

             
            } catch (\Throwable $th) {
                MatchedStaffPaymentRecords::insertData($computedData);
                //return redirect()->back()->with('error', $th->getMessage());
            }
   
                MatchedStaffPaymentRecords::insertData($computedData);

                // get un-machted 

              
               
           // $this->showData($computedData); 
 
        // add to the new array
     
        return redirect()->action('MatchController@showData2', ['mda_abbrev' => $mda_abbrev]);
    }

    public function compareSalaries($gross_pay, $gross_pay1)
    {

        if ($gross_pay == $gross_pay1) {
            # code...
        }

        return $gross_pay;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        return view('admin.match.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
