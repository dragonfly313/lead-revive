<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\MaintenanceMode;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GoogleClientController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Ticket\TicketsController;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Ticket\CommentsController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Subscriptions\PlanController;
use App\Http\Controllers\Admin\StripeBalanceController;
use App\Http\Controllers\Admin\DownloadBackupController;
use App\Http\Controllers\Admin\PlanController as StripePlan;
use JoelButcher\Socialstream\Http\Controllers\OAuthController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionCardController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionSwapController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionCancelController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionCouponController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionResumeController;
use App\Http\Controllers\Account\Subscriptions\SubscriptionInvoiceController;
use App\Http\Controllers\PageManageController;
use App\Http\Controllers\MenuManageController;
use App\Http\Controllers\SeoManageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('resetdb', function () {
    // php artisan migrate:refresh --seed
    \Artisan::call('migrate:refresh --seed');
    dd("Data base has been reset");
});

Route::group(['middleware' => 'language'], function () {
    Route::get('oauth/{provider}', [OAuthController::class, 'redirectToProvider'])->name('oauth.redirect');

    Route::get('auth/{provider}/callback', [OAuthController::class, 'handleProviderCallback'])->name('oauth.callback');

    Route::get('/', function () {
        return view('welcome');
    })->name('home');

    Route::get('/admin', function () {
        return view('welcome');
    })->name('home');

    Route::get('/contact', function () {
        return view('contact');
    })->name('contact');

    Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // account
    Route::group(['prefix' => 'account', 'as' => 'account.', 'middleware' => ['auth:sanctum', 'verified']], function () {
        Route::view('security', 'account.security')->name('security');
        Route::view('password', 'account.password')->name('password');
        Route::view('social', 'profile.social')->name('social');
        Route::get('plan', function () {
            $team = Auth::user()->personalTeam();
            return view('account.plan', ['team' => $team]);
        })->name('plan');
    });

    // billing
    Route::group(['namespace' => 'Subscriptions', 'middleware' => 'auth'], function () {
        Route::get('plans', [PlanController::class, 'index'])->name('subscription.plans')->middleware('not.subscribed');
        Route::get('/subscriptions', ['App\Http\Controllers\Subscriptions\SubscriptionController', 'index'])->name('subscriptions');
        Route::post('/subscriptions', ['App\Http\Controllers\Subscriptions\SubscriptionController', 'store'])->name('subscriptions.store');
    });

    Route::get('/test', function () {
        $beautymail = app()->make(Snowfire\Beautymail\Beautymail::class);
        $beautymail->send('emails.welcome', [], function ($message) {
            $message
                ->from('info@fastmesaj.com')
                ->to('dukenst2006@gmail.com', 'John Smith')
                ->subject('Welcome!');
        });
    });

    Route::get('profile/google-sync/{type}', [ProfileController::class, 'setGmailSync'])->name('syncGmailPage');

    Route::group(['middleware' => 'auth:sanctum',/* 'verified' <-- */ 'namespace' => 'Account', 'prefix' => 'account'], function () {
        Route::get('/', [AccountController::class, 'index'])->name('account');
        Route::get('/preference', [AccountController::class, 'preference'])->name('account.preference');
        Route::get('/activity', [AccountController::class, 'activity'])->name('account.activity');

        Route::group(['namespace' => 'Subscriptions', ['middleware' => 'subscribed'], 'prefix' => 'subscriptions'], function () {
            Route::get('/', [SubscriptionController::class, 'index'])->name('account.subscriptions');

            Route::get('/cancel', [SubscriptionCancelController::class, 'index'])->name('account.subscriptions.cancel');
            Route::post('/cancel', [SubscriptionCancelController::class, 'store']);

            Route::get('/resume', [SubscriptionResumeController::class, 'index'])->name('account.subscriptions.resume');
            Route::post('/resume', [SubscriptionResumeController::class, 'store']);

            Route::get('/swap', [SubscriptionSwapController::class, 'index'])->name('account.subscriptions.swap');
            Route::post('/swap', [SubscriptionSwapController::class, 'store']);

            Route::get('/card', [SubscriptionCardController::class, 'index'])->name('account.subscriptions.card');
            Route::post('/card', [SubscriptionCardController::class, 'store']);
            Route::post('/newcard', [SubscriptionCardController::class, 'newPaymentMethod'])->name('account.subscriptions.newcard');

            Route::get('/coupon', [SubscriptionCouponController::class, 'index'])->name('account.subscriptions.coupon');
            Route::post('/coupon', [SubscriptionCouponController::class, 'store']);

            Route::get('/invoices', [SubscriptionInvoiceController::class, 'index'])->name('account.subscriptions.invoices');
            Route::get('/invoices/{id}', [SubscriptionInvoiceController::class, 'show'])->name('account.subscriptions.invoice');
        });
    });

    Route::group(['middleware' => ['auth', 'subscribed']], function () {
        // ticket
        Route::group(['middleware' => 'verified', 'prefix' => 'account', 'as' => 'ticket.'], function () {
            Route::get('new-ticket', [TicketsController::class, 'create'])->name('create');
    
            Route::post('new-ticket', [TicketsController::class, 'store']);
    
            Route::get('my_tickets', [TicketsController::class, 'userTickets'])->name('index');
    
            Route::get('tickets/{ticket_id}', [TicketsController::class, 'show'])->name('show');
    
            Route::post('comment', [CommentsController::class, 'postComment'])->name('comment');
            Route::post('close_ticket', [TicketsController::class, 'close_by_user'])->name('close_by_user');
        });

        // leads
        Route::get('leads/inbox', [LeadController::class, 'showInbox'])->name('leads.inbox');
        Route::post('leads/create-gm', [LeadController::class, 'createAction'])->name('leads.create');
        Route::post('leads/create-wf', [LeadController::class, 'createViaWF'])->name('leads.create.wf');
        Route::post('leads/create-cn', [LeadController::class, 'createViaCN'])->name('leads.create.cn');
        Route::post('leads/create-tawk', [LeadController::class, 'createViaTawk'])->name('leads.create.tawk');
        Route::get('googleauth/callback', [GoogleClientController::class, 'googleAuthCallback']);
        Route::get('leads/action', [LeadController::class, 'action'])->name('leads.action');
    
        Route::post('leads/get-all', [GoogleClientController::class, 'getAllLeadAction'])->name('leads.api.get');
        Route::get('/generate-csv', [GoogleClientController::class, 'generateCSV'])->name('leads.csv.print');
    
        Route::group(['prefix' => 'account', 'as' => 'gmail.'], function () {
            Route::get('leads/gmail/inbox/{page}', [GoogleClientController::class, 'showGmailInbox'])->name('inbox');
            Route::get('leads/gmail/draft', [GoogleClientController::class, 'showGmailDraft'])->name('draft');
            Route::post('leads/gmail/draft', [GoogleClientController::class, 'showGmailDraftItem'])->name('draft.item');
            Route::get('leads/gmail/sent', [GoogleClientController::class, 'showGmailSent'])->name('sent');
            Route::get('leads/gmail/compose', [GoogleClientController::class, 'showGmailCompose'])->name('compose');
            Route::get('leads/gmail/detail/{messageId}/inbox', [GoogleClientController::class, 'showGmailDetailInbox'])->name('detail.inbox');
            Route::get('leads/gmail/detail/{messageId}/sent', [GoogleClientController::class, 'showGmailDetailSent'])->name('detail.sent');
            Route::get('leads/gmail/archive', [GoogleClientController::class, 'showGmailArchive'])->name('archive');
            Route::post('leads/gmail/store', [GoogleClientController::class, 'sendGmailAction'])->name('api.send');
            Route::post('leads/gmail/trash', [GoogleClientController::class, 'deleteGmailAction'])->name('api.delete');
            Route::post('leads/gmail/archive', [GoogleClientController::class, 'archiveGmailAction'])->name('api.archive');
    
            // new
            Route::post('leads/gmail/recommend', [GoogleClientController::class, 'getRecommendAction'])->name('api.recommend');
            Route::get('leads/gmail/getLeads/{page}', [GoogleClientController::class, 'getLeads'])->name('api.getLeads');
        });
    });

    //websites
    Route::group(['middleware' => ['auth:sanctum', 'role:Owner'], 'prefix' => 'account', 'as' => 'websites.'], function () {
        Route::get('websites/compose', [PageManageController::class, 'index'])->name('compose');
        Route::post('websites/compose', [PageManageController::class, 'upsert'])->name('compose.upsert');
        Route::post('websites/compose/upload', [PageManageController::class, 'upload'])->name('compose.upload');

        Route::get('websites/menu', [MenuManageController::class, 'index'])->name('menu');
        Route::post('websites/menu/add', [MenuManageController::class, 'add'])->name('menu.add');
        Route::put('websites/menu/{id}', [MenuManageController::class, 'update'])->name('menu.update');
        Route::delete('websites/menu/{id}', [MenuManageController::class, 'remove'])->name('menu.remove');

        Route::get('websites/seo', [SeoManageController::class, 'index'])->name('seo');
        Route::put('websites/seo/update', [SeoManageController::class, 'update'])->name('seo.update');
    });

    Route::get('logout', [ProfileController::class, 'setGmailUnSync'])->name('unsyncGmailPage');

    Route::impersonate();

    // admin panel
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth:sanctum', 'role:Owner']], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::resource('/users', UserController::class);
        Route::get('activity', [UserController::class, 'activity'])->name('activity');

        Route::resource('/permissions', PermissionController::class);

        Route::resource('/roles', RoleController::class);

        /* Plans Resource Routes */
        Route::resource('/plans', StripePlan::class);
        Route::resource('/coupons', CouponController::class);

        // Admin Ticket system
        Route::get('tickets', [TicketsController::class, 'index'])->name('tickets');

        Route::post('close_ticket/{ticket_id}', [TicketsController::class, 'close']);
        Route::get('tickets/{ticket_id}', [TicketsController::class, 'adminshow']);

        Route::view('backups', 'admin.backup.index')->name('backup.index');
        Route::get('download-backup', DownloadBackupController::class);
        Route::get('maintenance', MaintenanceMode::class)->name('maintenance');
        Route::get('subscriptions-cancel', ['App\Http\Controllers\Admin\SubscriptionController', 'cancelSubscription'])->name('subscription.cancel');
        Route::get('subscriptions', ['App\Http\Controllers\Admin\SubscriptionController', 'subscription'])->name('subscriptions');

        Route::get('/stripe/charges', [StripeBalanceController::class, 'index']);
        Route::get('/stripe/charges/{id}', [StripeBalanceController::class, 'show']);
        Route::get('/stripe/balance', [StripeBalanceController::class, 'index']);

        Route::view('notifications', 'admin.notifications')->name('notifications');
    });
});
