<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = ['firstname', 'lastname', 'company', 'email', 'phone', 'mobile', 'postcode', 'address', 'type', 'detail_type', 'sh_company', 'sh_address', 'sh_city', 'sh_state', 'sh_postcode', 'in_company', 'in_address', 'in_state', 'in_postcode'];
}
