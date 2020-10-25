<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable = [
        'mda_code',
        'file_name',
        'status',
        'transaction_type'
    ];

    public static function insertData($data){
 
        try {
            
            DB::table('transactions')->insert($data);
        
        } catch (\Exception $th) {
            
            //throw $th;
        } 
     
         }
}
