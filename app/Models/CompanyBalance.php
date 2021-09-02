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
    'company_balance',
    'date'
];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

}
