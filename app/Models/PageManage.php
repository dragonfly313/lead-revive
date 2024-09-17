<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageManage extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'type', 'value'];

    protected $table = 'page_manage';
}
