<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WAContact extends Model
{
    use HasFactory;
    protected $fillable = ['fullname', 'whatsapp'];
    protected $table = 'wa_contacts';
}
