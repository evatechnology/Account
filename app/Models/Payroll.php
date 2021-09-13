<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $table = 'payrolls';
    protected $fillable = ['position_id','company_id','employee_id','bonous','reason','date'];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function position()
    {
        return $this->belongsTo(Position::class,'position_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
