<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $table = 'payrolls';
    protected $fillable = ['employee_id','amount','reason','date'];

    // public function company()
    // {
    //     return $this->belongsTo(ClientCompany::class,'company_id');
    // }
    // public function position()
    // {
    //     return $this->belongsTo(Position::class,'position_id');
    // }
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
