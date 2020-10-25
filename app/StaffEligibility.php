<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class StaffEligibility extends Model
{
    protected $table = 'staff_eligibilities';
    protected $fillable = [
        'staff_id',
        'surname',
        'firstname',
        'othernames',
        'gender',
        'date_of_birth',
        'date_of_first_appt',
        'grade_level',
        'qualification',
        'confirmation',
        'gross_pay',
        'mda',
       'status', 
    ];
   
    public static function insertData($data){
 
        try {
            $value=DB::table('staff_eligibilities')->where('staff_id', $data['staff_id'])->where('mda', $data['mda'])->get();
            if($value->count() == 0){
            DB::table('staff_eligibilities')->insert($data);
            }
        } catch (\Exception $th) { 
           return redirect()->back()->with('error', $th->getMessage());
        
        }
    } 
 

}