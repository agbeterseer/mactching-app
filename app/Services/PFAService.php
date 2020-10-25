<?php

namespace App\Services;
 
use App\PINGeneratedReport;
use App\Transaction;
use App\MinistryDepartmentAgency;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Carbon\Carbon;
use DB;
use Auth;

class PFAService
{
	protected $model;
	
	public function __construct(PINGeneratedReport $pfaModel)
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
  
  public function groupByMDAs()
  {
    return $groupByMDA = DB::table('p_i_n_generated_reports')
    ->select('mda_id', DB::raw('COUNT(mda_id) as total'))
    ->groupBy('mda_id')
    ->get();
 
  }

  public function findPFAByMDA($mda_id)
  {
    return $pfa_list = DB::table('p_i_n_generated_reports')->Where('mda_id', $mda_id)->get();
  }

    public function uploadPFAList(Request $request)
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
             
                  $insertData["mda_id"] = $mdaID->abbrev;
                  $insertData["created_at"] = new Carbon();
                  PINGeneratedReport::insertData($insertData);
      
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
          return redirect()->back('PFAController@setUpMatch', ['mda_abbrev' => $mdaID->abbrev]);
    
    }
 
 
 
}