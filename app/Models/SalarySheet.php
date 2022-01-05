<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalarySheet extends Model
{
    use HasFactory;
    private $table = 'salarysheets';
    private $fillable = ['sheet_name',
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
}
