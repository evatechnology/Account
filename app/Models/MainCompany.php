<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCompany extends Model
{
    use HasFactory;
    protected $table = 'maincompany';
    protected $fillable = ['companyname','logo','balance'];
}
