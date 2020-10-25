<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MDAService;
use App\Services\PFAService; 
use App\MinistryDepartmentAgency;
use App\Transaction;
use Carbon\Carbon;
use App\PINGeneratedReport;
use Illuminate\Support\Facades\Session;
use DB;

class PFAController extends Controller
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
        // get all MDA's
        // upload Registered PEN by MDA's
        //
        $mdas = $this->pfaService->all();
        dd($mdas);

        return view('admin.pfa.index', compact('mdas'));
    }

    public function showDataByMDA($id)
    {
 
      $pfa_list = DB::table('p_i_n_generated_reports')->where('mda_id', $id)->get(); 
     
      return view('admin.pfa.show_pfas', compact('pfa_list'));
    }

    public function showListOFPFAByMDAForm()
    {
        $mdas = $this->pfaService->groupByMDAs();
        return view('admin.pfa.upload_pfa_by_mdas', compact('mdas'));
    }

    public function uploadRegisterdListForm($code)
    {
        $mda_id = $code;
        return view('admin.pfa.upload_file', compact('mda_id'));
    }

    public function uploadRegisterdList(Request $request)
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
                      "rsa_pin"=>$importData[0],
                      "form_ref_no"=>$importData[1],
                      "surname"=>$importData[2],
                      "firstname"=>$importData[3],
                      "othernames"=>$importData[4],
                      "gender"=>$importData[5],
                      "date_of_birth"=>$importData[6],
                      "nin"=>$importData[7],
                      "phone_no"=>$importData[8],
                      "email"=>$importData[9],
                      "institution_name"=>$importData[10],
                      "date_of_first_appt"=>$importData[11],
                      "staff_id"=>$importData[12],
                      "pin_reg_date"=>$importData[13],  
                  );
                } catch (\Throwable $th) {
                  return redirect()->back()->with('error', 'The file you are trying to upload has wrong format');
               }
                  $insertData["mda_id"] = $mdaID->abbrev;
                  $insertData["created_at"] = new Carbon();
                  PINGeneratedReport::insertData($insertData);
      
                } 
                Session::flash('message','Import Successful.');
              }else{
                Session::flash('message','File too large. File must be less than 2MB.');
             
              }
      
            }else{
               Session::flash('message','Invalid File Extension.');
          
            }
      
          } 
         return redirect()->action('PFAController@setUpMatch', ['mda_abbrev' => $mdaID->abbrev]);
    
    }
 
    public function findAllStaffByMDA($mda_id)
    {
      
      $data = DB::table('staff_eligibilities')->where('mda', $mda_id)->where('status','un-matched')->get();
      return $data;
  
    }

    public function findPFAByMDA($mda_id)
    {
      return $pfa_list = DB::table('p_i_n_generated_reports')->Where('mda_id', $mda_id)->get();
    }
  
    public function setUpMatch($mda_abbrev)
    {
     
       $mda_id = $mda_abbrev;
       
        try {
             $eligible_staff = $this->findAllStaffByMDA($mda_id); 
          
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
      
        try {
            $pfa_list = $this->findPFAByMDA($mda_abbrev);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

       
       return view('admin.pfa.setup_match', compact(['eligible_staff', 'pfa_list', 'mda_id']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        // $staffData = DB::table('p_i_n_generated_reports')->where('mda', $id)->get();
             
        // foreach($staffData as $data){
        //  $staff = StaffEligibility::find($data->id)->delete();
        // }

        DB::table("p_i_n_generated_reports")->where('id',$id)->delete();
      }
        //

        return redirect()->back();
    }
}
