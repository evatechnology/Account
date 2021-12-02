<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBalance extends Model
{
    use HasFactory;
    protected $table = 'companyaccounts';
    protected $fillable = ['type',
    'company_id',
    'source',
    'amount',
    'document',
    'temp_balance',
    'date'
];
    public function setFilenamesAttribute($value)
    {
        $this->attributes['document'] = json_encode($value);
    }

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }


}
