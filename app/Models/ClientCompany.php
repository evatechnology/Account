<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientCompany extends Model
{
    use HasFactory;
    protected $table = 'clientcompany';
    protected $fillable = ['name','email','phone_no','website','work_order','received_payment','spending','start_date','end_date','status'];
}
