<?php

namespace App\Http\Controllers;
use App\Services\StaffPaymentReportService;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth;
use DB;
use App\StaffPaymentReport;
use App\StaffMonthlyPaymentReport;
use App\MinistryDepartmentAgency;
use App\Transaction;

class StaffPaymentReportController extends Controller
{

    protected $staffPaymentReportService;

    public function __construct(StaffPaymentReportService $staffPaymentReportService)
	{
    $this->staffPaymentReportService = $staffPaymentReportService;
    $this->middleware('auth');
	}
 

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function index()
    { 
      try {
        $groupByMDA = DB::table('staff_payment_reports')
        ->select('mda', DB::raw('COUNT(mda) as total'))
        ->groupBy('mda') 
        ->get();
      } catch (\Throwable $th) {
        return redirect()->back()->with('error', 'The file you are trying to upload has wrong format');
      }
   
         
        return view('admin.staffpayment.index', compact('groupByMDA'));
    }

    
    public function uploadStaffListPaymentReport(Request $request)
    { 
       dd($request->all());
      $file = $request->file('file');

        if ($file){
          $filename = time(). "." . $file->getClientOriginalName(); 
            // File Details 
            // $filename = time(). "." . $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
           
            // Valid File Extensions
            $valid_extension = array("csv", "xlsx");
      
            // 2MB in Bytes
            $maxFileSize = 2097152; 
           
            // Check file extension
      
            if(in_array(strtolower($extension),$valid_extension)){
              
              // Check file size
              if($fileSize <= $maxFileSize){
               
                // File upload location
                $location = 'uploads';
               
                // Upload file
                $file->move($location,$filename);
      
                // Import CSV to Database
                $filepath = public_path($location."/".$filename);

                // save to ministry_department_agencies table 

                $mdg = $request->mda; // MDA 
                $abbrev = $request->abbrev;
                try {
                    MinistryDepartmentAgency::insertMDAData($mdg, $abbrev, $filename);
                } catch (\Throwable $th) {
                    return redirect()->back()->with('error', $th->getMessage());
                }
                
             
                // Reading file
                $file = fopen($filepath,"r");
      
                $importData_arr = array();
                $i = 0;
      
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                   $num = count($filedata );
                   
                   // Skip first row (Remove below comment if you want to skip the first row)
                   if($i == 0){
                      $i++;
                      continue; 
                   }
                   for ($c=0; $c < $num; $c++) {
                      $importData_arr[$i][] = $filedata [$c];
                   }
                   $i++;
                }
                fclose($file);
      
                // Insert to MySQL database
                foreach($importData_arr as $importData){
                        try {
               
                            $insertData = array( 
                                'rsa_pin'=>$importData[0],
                                'surname'=>$importData[1], 
                                'firstname'=>$importData[2],
                                'othernames'=>$importData[3],
                                'gender'=>$importData[4],
                                'phone_no'=>$importData[5],
                                'pfa_name'=>$importData[6],
                                'staff_id'=>$importData[7],
                                'gross_pay' => $importData[8],
                                'ten_percent' =>$importData[9],
                                'eight_percent' =>$importData[10],
                                'created_at' => new Carbon(),
                            );
                        } catch (\Throwable $th) {
                           return redirect()->back()->with('error', 'The file you are trying to upload has wrong format');
                        }
    
                  $insertData["mda"] = $abbrev;
                  $insertData["status"] = 'un-matched';
                
                  StaffPaymentReport::insertData($insertData);
        
                } 
              
              }else{
                Session::flash('message','File too large. File must be less than 2MB.');
              
              }
      
            }else{
               Session::flash('message','Invalid File Extension.');
        
            }
      
          }
          return redirect()->action('StaffPaymentReportController@index');
    
    }

    public function uploadRegisterdListForm2($code)
    {
        $mda_id = $code;
        return view('admin.pfa.upload_file2', compact('mda_id'));
    }

    public function uploadRegisterdList2(Request $request)
    {


 
      // get the MinistryDepartmentAgency record by mda_id
      // and return abbrev
        $mda_id = $request->mda_id;
        $mdaID = MinistryDepartmentAgency::findByID($mda_id);
       
        $file = $request->file('file');
        if ($file){ 
      
            // File Details 
            $filename = time(). "." .$file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
      
            // Valid File Extensions
            $valid_extension = array("csv", "xlsx");
      
            // 2MB in Bytes
            $maxFileSize = 2097152; 
           
            // Check file extension
      
            if(in_array(strtolower($extension),$valid_extension)){
              
              // Check file size
              if($fileSize <= $maxFileSize){
               
                // File upload location
                $location = 'uploads';
      
                // Upload file
                $file->move($location,$filename);
      
                // Import CSV to Database
                $filepath = public_path($location."/".$filename);

                // save to ministry_department_agencies table 
                $mdg = $request->mda; // MDA 
                $abbrev = $request->abbrev;
                $data = array(
                  'mda_code' =>$request->mda_id,
                  'file_name' =>$filename,
                  'status' =>'ACTIVE',
                  'transaction_type' => 'pfa',
                  'created_at' => new Carbon(),
                );

                Transaction::insertData($data);
                 
                // Reading file
                $file = fopen($filepath,"r");
      
                $importData_arr = array();
                $i = 0;
      
                while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                   $num = count($filedata );
                   
                   // Skip first row (Remove below comment if you want to skip the first row)
                   if($i == 0){
                      $i++;
                      continue; 
                   }
                   for ($c=0; $c < $num; $c++) {
                      $importData_arr[$i][] = $filedata [$c];
                   }
                   $i++;
                }
                fclose($file);
      
                // Insert to MySQL database
                foreach($importData_arr as $importData){
            try{
                  $insertData = array(
                    'rsa_pin'=>$importData[0],
                    'surname'=>$importData[1], 
                    'firstname'=>$importData[2],
                    'othernames'=>$importData[3],
                    'gender'=>$importData[4],
                    'phone_no'=>$importData[5],
                    'pfa_name'=>$importData[6],
                    'staff_id'=>$importData[7],
                    'gross_pay' => $importData[8],
                    'ten_percent' =>$importData[9],
                    'eight_percent' =>$importData[10],
                    'created_at' => new Carbon(),

                  );
                } catch (\Throwable $th) {
                  return redirect()->back()->with('error', 'The file you are trying to upload has wrong format');
               }
                  $insertData["mda"] = $mdaID->abbrev;
                  $insertData["created_at"] = new Carbon();
                
                  StaffMonthlyPaymentReport::insertData($insertData);
      
                } 
                Session::flash('message','Import Successful.');
              }else{
                Session::flash('message','File too large. File must be less than 2MB.');
             
              }
      
            }else{
               Session::flash('message','Invalid File Extension.');
          
            }
      
          } 
         return redirect()->action('StaffPaymentReportController@setUpMatch2', ['mda_abbrev' => $mdaID->abbrev]);
    
    }

    public function findAllStaffPaymentReportByMDA($mda_id)
    {
      try {
        $data = DB::table('staff_payment_reports')->where('mda', $mda_id)->where('status', 'un-matched')->get();
      } catch (\Throwable $th) {
        return redirect()->back()->with('error', $th->getMessage());
      } 
      return $data;
  
    }

    public function findMonthlyReportByMDA($mda_id)
    {
      try {
        $pfa_list = DB::table('staff_monthly_payment_reports')->where('mda', $mda_id)->get();
      } catch (\Throwable $th) {
        return redirect()->back()->with('error', $th->getMessage());
      }
      return $pfa_list;
    }

 

    public function setUpMatch2($mda_abbrev)
    {
      
     
       $mda_id = $mda_abbrev;
       
        try {
             $staff_payment_list = $this->findAllStaffPaymentReportByMDA($mda_id); 
          
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
      
        try {
            $monthly_report_list = $this->findMonthlyReportByMDA($mda_abbrev);
         
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
        
       return view('admin.match.setup_match2', compact(['staff_payment_list', 'monthly_report_list', 'mda_id']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staffpayment.create', array('user' => Auth::user()));
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
