<?php

namespace App\Models;

use App\Presenters\CustomerPresenter;
use App\Presenters\InvoicePresenter;
use App\Presenters\SubscriptionPresenter;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Laravel\Jetstream\Events\TeamCreated;
use Laravel\Jetstream\Events\TeamDeleted;
use Laravel\Jetstream\Events\TeamUpdated;
use Laravel\Jetstream\Team as JetstreamTeam;

class Team extends JetstreamTeam
{
    use Billable, Notifiable;

    public function plan()
    {
        return $this->hasOneThrough(
            Plan::class,
            Subscription::class,
            'team_id',
            'stripe_id',
            'id',
            'stripe_plan'
        );
    }

    public function presentSubscription()
    {
        if (!$subscription = $this->subscription('default')) {
            return;
        }
//dd($subscription->asStripeSubscription());
        return new SubscriptionPresenter($subscription->asStripeSubscription());
    }

    public function presentUpcomingInvoice()
    {
        if (!$invoice = $this->upcomingInvoice()) {
            return;
        }

        return new InvoicePresenter($invoice);
    }

    public function presentCustomer()
    {
        if (!$this->hasStripeId()) {
            return;
        }

        return new CustomerPresenter($this->asStripeCustomer());
    }

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'personal_team' => 'boolean',
        'trial_ends_at' =>  'datetime',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'personal_team',
    ];

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => TeamCreated::class,
        'updated' => TeamUpdated::class,
        'deleted' => TeamDeleted::class,
    ];

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    // Determining which teams should be mailed for trial that will expire soon
    public function onSoonExpiringTrial(): bool
    {
        if ($this->subscribed()) {
            return false;
        }

        if (!$this->onGenericTrial()) {
            return false;
        }

        return now()->addDays(2)->greaterThan($this->trial_ends_at);
    }
}
