<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class StaffList extends Model
{
    protected $table = 'staff_lists';
    protected $fillable = [
        'pfn',
        'staff_id',
        'staff_name',
        'date_of_birth',
        'date_of_first_appt',
        'rank_sgl',
        'gross',
        'account_number',
        'bank',
        'present_station',
        'mda',
    ];

    public static function insertData($data){
 
    try {
        $value=DB::table('staff_lists')->where('staff_name', $data['staff_name'])->where('mda', $data['mda'])->get();
        if($value->count() == 0){
        DB::table('staff_lists')->insert($data);
        }
    } catch (\Exception $th) { 
        //throw $th;
    } 
        // if($value->count() == 0){
        //    DB::table('staff_lists')->insert($data);
        // }
     }


     public function getStaffIDAttribute($value)
     {
         if ($value) {
            return $this->staff_id($value);
         }
         return null;
     }


}
