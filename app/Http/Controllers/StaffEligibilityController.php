<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StaffEligibility;
use Illuminate\Support\Facades\Session;
use App\Services\StaffEligibilityService;
use App\MinistryDepartmentAgency;
use Carbon\Carbon;
use Auth;
use DB;
class StaffEligibilityController extends Controller
{
    protected $staffEligibilityService;

    public function __construct(StaffEligibilityService $staffEligibilityService)
	{
    $this->staffEligibilityService = $staffEligibilityService;
    $this->middleware('auth');
	}
 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
      
      $groupByMDA = DB::table('staff_eligibilities')
                ->select('mda', DB::raw('COUNT(mda) as total'))
                ->groupBy('mda') 
                ->get();
    //   $staff_list 
   
 
        return view('admin.staffmanagement.index', compact('groupByMDA'));
    }

    public function showStaffList($mda_id)
    { 

         
        $staff_list = StaffEligibility::where('mda', $mda_id)->get();
     
        return view('admin.staffmanagement.show_staff_list', compact('staff_list'));
    }

   
    public function uploadStaffList(Request $request)
    { 
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
                MinistryDepartmentAgency::insertMDAData($mdg, $abbrev, $filename);
             
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
                                'staff_id'=>$importData[0],
                                'surname'=>$importData[1],
                                'firstname'=>$importData[2],
                                'othernames'=>$importData[3],
                                'gender'=>$importData[4],
                                'date_of_birth'=>$importData[5],
                                'date_of_first_appt'=>$importData[6],
                                'grade_level'=>$importData[7],
                                'qualification' => $importData[8],
                                'confirmation' =>$importData[9],
                                'gross_pay' =>$importData[10],
                                'created_at' => new Carbon(),
                            );
                        } catch (\Throwable $th) {
                           return redirect()->back()->with('error', 'The file you are trying to upload has wrong format');
                        }
    
                  $insertData["mda"] = $abbrev;
                  $insertData["status"] = 'un-matched';
                
                StaffEligibility::insertData($insertData);
        
                } 
              
              }else{
                Session::flash('message','File too large. File must be less than 2MB.');
              
              }
      
            }else{
               Session::flash('message','Invalid File Extension.');
        
            }
      
          }
          return redirect()->action('StaffEligibilityController@index');
    
    }
 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.staffmanagement.create', array('user' => Auth::user()));
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
 
        if($id){
              try {

                $staffData = DB::table('staff_eligibilities')->where('mda', $id)->get();
             
                foreach($staffData as $data){
                 $staff = StaffEligibility::find($data->id)->delete();
                }
             
                // Deleting from MDA's
                $code = DB::table('ministry_department_agencies')->where('abbrev', $id)->first(); 
                $code_delete = MinistryDepartmentAgency::find($code->id)->delete(); 
               

              } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getMessage());
              }
 

        }

        return redirect()->back();
    }
}
