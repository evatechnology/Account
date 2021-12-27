<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyBalance extends Model
{
    use HasFactory;
    protected $table = 'companyaccounts';
    protected $fillable = ['type',
    'maincompany_id',
    'company_id',
    'account_head',
    'amount',
    'document',
    // 'temp_balance',
    'date'
];
    // public function setFilenamesAttribute($value)
    // {
    //     $this->attributes['document'] = json_encode($value);
    // }

    public function maincompany()
    {
        return $this->belongsTo(MainCompany::class,'maincompany_id');
    }
    public function company()
    {
        return $this->belongsTo(ClientCompany::class,'company_id');
    }


}
