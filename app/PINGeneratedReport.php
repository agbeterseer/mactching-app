<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class PINGeneratedReport extends Model
{
    //
    protected $table = ['p_i_n_generated_reports'];
    protected $fillable = [
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
        //dd($data);
        try {
            $value=DB::table('p_i_n_generated_reports')->where('staff_id', $data['staff_id'])->where('mda_id', $data['mda_id'])->get();
            if($value->count() == 0){
            DB::table('p_i_n_generated_reports')->insert($data);
            }
        } catch (\Exception $th) { 
            return redirect()->back()->with('error', $th->getMessage());
        }
   
    }

}