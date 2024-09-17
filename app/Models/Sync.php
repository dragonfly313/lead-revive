<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sync extends Model
{
    use HasFactory;

    protected $table = 'sync';

    protected $fillable = ['user_id', 'type', 'mail', 'name'];
}
