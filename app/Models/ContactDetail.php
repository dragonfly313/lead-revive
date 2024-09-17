<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{
    use HasFactory;

    protected $table = 'contact_details';

    protected $fillable = ['contact_id', 'type', 'name', 'address', 'city', 'state', 'postcode', 'contact_name', 'contact_email', 'contact_number'];
}
