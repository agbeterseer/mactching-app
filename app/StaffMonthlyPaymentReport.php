<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class StaffMonthlyPaymentReport extends Model
{
    protected $table = ['staff_monthly_payment_reports'];
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
        'status',
    ];

    public static function insertData($data){

        try {
            $value=DB::table('staff_monthly_payment_reports')->where('rsa_pin', $data['rsa_pin'])->where('mda', $data['mda'])->get();
        
            if($value->count() == 0){
            DB::table('staff_monthly_payment_reports')->insert($data);
            }
        } catch (\Exception $th) { 
           return redirect()->back()->with('error', $th->getMessage());
        
        }
    } 
}
