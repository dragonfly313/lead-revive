<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'title',
        'plan_id',
        'plan_variation_id',
        'price',
        'active',
        'teams_limit',
        'trial_period_days',
        'interval',
    ];
}
