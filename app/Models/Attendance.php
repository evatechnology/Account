<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $fillable = ['date','employee_id', 'present', 'leave', 'absent', 'mounth', 'year', 'current_date'];
    public function employee()
    {
        return $this->belongsTo(Employee::class,'employee_id');
    }
}
