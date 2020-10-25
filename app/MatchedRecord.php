<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class MatchedRecord extends Model
{
 
    protected $fillable = [
        'staff_id1',
        'surname1',
        'firstname1',
        'othernames1',
        'gender1',
        'date_of_birth1',
        'date_of_first_appt1',
        'grade_level1',
        'qualification1',
        'confirmation1',
        'gross_pay1',

        'rsa_pin',
        'form_ref_no',
        'surname',
        'firstname',
        'othernames',
        'gender',
        'date_of_birth',
        'nin',
        'phone_no',
        'email',
        'institution_name',
        'date_of_first_appt',
        'staff_id',
        'pin_reg_date',
        'mda_id', 
    ];


    public static function insertData($data){
      
    for ($i=0; $i < sizeof($data); $i++) { 
  
        try {
             
            $value=DB::table('matched_records')->where('staff_id1', $data[$i]['staff_id1'])->where('mda_id', $data[$i]['mda_id'])->get();
            if($value->count() == 0){
            DB::table('matched_records')->insert($data[$i]);
            }
        } catch (\thrown $th) { 
            return redirect()->back()->with('error', $th->getMessage());
        } 
            // if($value->count() == 0){
            //    DB::table('staff_lists')->insert($data);
            // }
         }
    }

}
