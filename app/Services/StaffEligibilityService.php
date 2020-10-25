<?php

namespace App\Services;
 
use App\StaffEligibility;
use App\MinistryDepartmentAgency;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Carbon\Carbon;
use DB;
use Auth;

class StaffEligibilityService
{
	protected $model;
	
	public function __construct(StaffEligibility $staffEligibilityModel)
	{
	$this->model = new Repository($staffEligibilityModel);
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
    
    $data = DB::table('staff_eligibilities')->where('mda', $mda_id)->get();
  
    return $data;

  }

  public function findByMDAAndStaffID($mda_id, $staff_id)
  {
    return $singleRecord = DB::table('staff_eligibilities')->where('mda', $mda_id)->where('staff_id', $staff_id)->first();
  }
 



    public function checkFileSize()
    {
        # code...
    }
    
   
	 
 
}