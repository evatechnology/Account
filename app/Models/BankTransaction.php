<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankTransaction extends Model
{
    use HasFactory;
    protected $table = 'banktransactions';
    protected $fillable = ['account_number','transection_id','ref','amount','type','date','reason'];

    public function bank(){
        return $this->belongsTo(Bank::class,'account_number');
    }
}
