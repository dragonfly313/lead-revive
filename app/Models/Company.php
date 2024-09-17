<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = ['company_name', 'bill_street', 'bill_town', 'bill_postcode', 'phone1', 'phone2', 'abn', 'ship_street', 'ship_town', 'ship_postcode'];
    
}
