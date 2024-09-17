<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WAMessage extends Model
{
    use HasFactory;
    protected $table = 'wa_messages';
    protected $fillable = ['to', 'from', 'profile', 'message'];
}
