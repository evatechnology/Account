<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySheet extends Model
{
    use HasFactory;
    protected $table = 'salarysheets';
    protected $fillable = ['sheet_name',
    'position_id',
    'employee_id',
    'basic',
    'yearly_increment',
    'month',
    'year',
    'working_day',
    'present',
    'leave',
    'absent',
    'advance'];
    public function position()
    {
        return $this->belongsTo(Position::class,'position_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
