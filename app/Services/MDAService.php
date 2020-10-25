<?php

namespace App\Services;
 
use App\MinistryDepartmentAgency;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Carbon\Carbon;
use DB;
use Auth;

class MDAService
{
	protected $model;
	
	public function __construct(MinistryDepartmentAgency $pfaModel)
	{
	$this->model = new Repository($pfaModel);
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

 

    public function uploadMDAFile(Request $request)
    {
 
            $file = $request->file('file');
      
            // File Details 
            $filename = time(). "." . $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $tempPath = $file->getRealPath();
            $fileSize = $file->getSize();
            $mimeType = $file->getMimeType();
            //dd($filename);
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
                // return redirect()->action('MatchController@index');/
              return redirect()->back()->with(['importData_arr' => $importData_arr]);
                // foreach($importData_arr as $importData){
   
                //   $insertData = array(
                //       "rsa_pin"=>$importData[0],
                //       "form_ref_no"=>$importData[1],
                //       "surname"=>$importData[2],
                //       "firstname"=>$importData[3],
                //       "othernames"=>$importData[4],
                //       "gender"=>$importData[5],
                //       "date_of_birth"=>$importData[6],
                //       "nin"=>$importData[7],
                //       "email"=>$importData[8],
                //       "institution_name"=>$importData[9],
                //       "date_of_first_appt"=>$importData[10],
                //       "staff_id"=>$importData[11],
                //       "pin_reg_date"=>$importData[12], 

                //   );
                //   StaffList::insertData($insertData);
      
                // } 
                // return back();
              }else{
                dd('message');
                Session::flash('message','File too large. File must be less than 2MB.');
                return back();
              }
      
            }else{
              dd('Invalid');
               Session::flash('message','Invalid File Extension.');
               return back();
            }
      
          
            return redirect()->back()->with(['importData_arr' => $importData_arr]);
    
    }


    public function checkFileSize()
    {
        # code...
    }
    
   
	 
 
}