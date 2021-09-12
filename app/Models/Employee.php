<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = ['employee_id','name','address','email','phone','company_id','gender','position_id','salary'];

    public function companyname()
    {
        return $this->belongsTo(Company::class,'company_id');
    }
    public function position()
    {
        return $this->belongsTo(Position::class,'position_id');
    }
}
