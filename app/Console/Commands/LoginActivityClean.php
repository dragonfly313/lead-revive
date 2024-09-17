<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use App\Models\UserLoginActivity;

class LoginActivityClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login-activity:clean {days?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean older login activity logs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $days = (int)$this->argument('days');
        $days = $days ?: 30;

        $past = Carbon::now()->subDays($days);

        UserLoginActivity::where('created_at', '<=', $past)->delete();
        
        $this->info('Older login activity logs cleaned!');
    }
}
