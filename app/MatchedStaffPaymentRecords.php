<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class MatchedStaffPaymentRecords extends Model
{
    protected $table = 'matched_staff_payment_records';
    protected $fillable = [
        'rsa_pin',
        'surname',
        'firstname',
        'othernames',
        'gender',
        'phone_no',
        'pfa_name',
        'staff_id',
        'gross_pay',
        'ten_percent',
        'eight_percent',
        'mda',

        'rsa_pin1', 
        'surname1',
        'firstname1',
        'othernames1',
        'gender1',
        'phone_no1',
        'staff_id1',
        'gross_pay1',
        'ten_percent1',
        'eight_percent1', 
        'mda1',
    ];


    public static function insertData($data){
      
    for ($i=0; $i < sizeof($data); $i++) { 
  
        try {
             
            $value=DB::table('matched_staff_payment_records')->where('rsa_pin', $data[$i]['rsa_pin'])->where('mda', $data[$i]['mda'])->get();
            if($value->count() == 0){
            DB::table('matched_staff_payment_records')->insert($data[$i]);
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
