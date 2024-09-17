<?php

namespace App\Http\Livewire;

use App\Models\Plan;
use Livewire\Component;

class PlanList extends Component
{
    public $plans = [];
    public $month = false;
    public $show = 'MONTHLY';
    // public $title = '';
    // public $subtitle = '';

    public function mount()
    {
        // $this->plans = Plan::get();
        $this->plans = Plan::where('interval', $this->show)->where('active', true)->orderBy('price')->get();
    }

    public function changePlan()
    {
        $this->show = $this->month ? 'ANNUAL' : 'MONTHLY';
        $this->plans = Plan::where('interval', $this->show)->where('active', true)->orderBy('price')->get();
    }

    public function render()
    {
        return view('livewire.plan-list');
    }
}
