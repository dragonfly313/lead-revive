<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SeoManage extends Model
{
    use HasFactory;

    protected $table = 'seo_manages';

    protected $fillable = ['page', 'title','description', 'keywords'];
}
