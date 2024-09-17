<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $table = 'subscriptions';

    protected $fillable = ['first_name', 'last_name','email', 'user_id', 'subscription_id', 'plan_variation_id', 'card_id', 'next_billing_at', 'status'];
}
