<?php

namespace App\Http\Controllers\Admin;

use Stripe;
use App\Models\Team;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Ticket;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
{
    public function index()
    {
        $user_count = User::all()->count();
        $team_count = Team::all()->count();
        $websites = 
        $newTicket = Ticket::where('status', 'Open')->count();
        $total_subscription = DB::table('subscriptions')->get()->count();
        $chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart_options);
        return view('admin.index', compact('user_count', 'newTicket', 'total_subscription', 'team_count', 'chart1'));
    }
}
