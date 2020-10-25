<?php

namespace App\Services;
 
use App\StaffList;
use App\MinistryDepartmentAgency;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Carbon\Carbon;
use DB;
use Auth;

class StaffListService
{
	protected $model;
	
	public function __construct(StaffList $staffListModel)
	{
	$this->model = new Repository($staffListModel);
	}
 
	public function all()
	{
	return $this->model->all();
	}
 
	public function create(Request $request)
	{
	$attributes = $request->all();

	return $this->model->create($attributes);
	}

	public function show($id)
	{
     return $this->model->show($id);
	}
 
 	public function read($id)
	{
     return $this->model->find($id);
	}
 
	public function update(Request $request, $id)
	{
	  $attributes = $request->all();
	  
      return $this->model->update($id, $attributes);
  }
  
  public function findAllStaffByMDA($mda_id)
  {
    
    $data = DB::table('staff_lists')->where('mda', $mda_id)->get();
  
    return $data;

  }

  public function findByMDAAndStaffID($mda_id, $staff_id)
  {
    return $singleRecord = DB::table('staff_lists')->where('mda', $mda_id)->where('staff_id', $staff_id)->first();
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
     
      
                  $insertData = array(
                      "psn"=>$importData[0],
                      "staff_id" => $importData[1],
                      "staff_name"=>$importData[2],
                      "date_of_birth"=>$importData[3],
                      "date_of_first_appt"=>$importData[4],
                      "rank_sgl"=>$importData[5],
                      "gross"=>$importData[6],
                      "account_number"=>$importData[7],
                      "bank"=>$importData[8],
                      "present_station"=>$importData[9],
                     
                  );

                  //array_push($insertData[10], $abbrev);
                  $insertData["mda"] = $abbrev;
             
                  StaffList::insertData($insertData);
      
                } 
                return back();
              }else{
                Session::flash('message','File too large. File must be less than 2MB.');
                return back();
              }
      
            }else{
               Session::flash('message','Invalid File Extension.');
               return back();
            }
      
          }
          return back();
    
    }


    public function checkFileSize()
    {
        # code...
    }
    
   
	 
 
}