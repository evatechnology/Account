<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employees';
    protected $fillable = ['name','address','email','phone','gender','position_id','salary','house_rent','medical','yearly_increment','advance'];

    // public function companyname()
    // {
    //     return $this->belongsTo(Company::class,'company_id');
    // }
    public function position()
    {
        return $this->belongsTo(Position::class,'position_id');
    }
}
