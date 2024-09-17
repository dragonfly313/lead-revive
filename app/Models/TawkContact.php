<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TawkContact extends Model
{
    use HasFactory;

    protected $fillable = ['fullname', 'email', 'ip'];

    protected $table = 'tawk_contacts';
}
