<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $table = 'leads';

    protected $fillable = ['id', 'firstname', 'lastname', 'email', 'mobile_phone', 'company', 'area_of_interest', 'lead_source', 'user_id'];
}
