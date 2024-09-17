<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GmailDraft extends Model
{
    use HasFactory;

    protected $table = 'gmail_drafts';

    protected $fillable = ['to', 'subject', 'content'];
}
