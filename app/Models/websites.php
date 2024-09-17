<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class websites extends Model
{
    use HasFactory;

    protected $table = 'websites';

    protected $fillable = ['id', 'pro_name','user_id', 'content'];
}
