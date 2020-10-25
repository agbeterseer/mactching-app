<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class MinistryDepartmentAgency extends Model
{
    protected $table = 'ministry_department_agencies';
    protected $fillable = [
       'fullname',
        'abbrev',
        'description',
        'location',
        'path_document',
        'contact_person',
    ];

    public static function insertMDAData($mdg, $abbrev, $filename){
        $value=DB::table('ministry_department_agencies')->where('abbrev', $abbrev)->get();
        if($value->count() == 0){
            DB::table('ministry_department_agencies')->insert(['fullname' => $mdg, 'abbrev' => $abbrev, 'path_document' => $filename, 'created_at' => new Carbon()]);
        }   
 
    }

    public static function findByID($id)
    {
        $code = DB::table('ministry_department_agencies')->where('abbrev', $id)->first();
  
       return $code;
    }



}
