<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;
use Square\SquareClient;
use Square\Models\CatalogObject;
use Square\Models\CatalogSubscriptionPlan;
use Square\Models\Money;
use Square\Models\UpsertCatalogObjectRequest;
use Square\Models\SubscriptionPricing;
use Square\Models\SubscriptionPhase;
use Square\Models\CatalogSubscriptionPlanVariation;

class PlanController extends Controller
{
    private $square;
    public function __construct()
    {
        $this->square = new SquareClient([
            'accessToken' => env('SQUARE_ACCESS_TOKEN'),
            'environment' => env('SQUARE_ENVIRONMENT')
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        /**

         * @get('/admin/plans')
         * @name('admin.plans.index')
         * @middlewares(web, auth:sanctum, verified)
         */
        // $this->authorize('create', Plan::class);

        $plans = Plan::paginate(10);

        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /**

         * @get('/admin/plans/create')
         * @name('admin.plans.create')
         * @middlewares(web, auth:sanctum, verified)
         */

        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**

         * @post('/admin/plans')
         * @name('admin.plans.store')
         * @middlewares(web, auth:sanctum, verified)
         */
        $this->demoMode();

        $this->validate($request, [
            'name'        => 'required',
            'price'       => 'required',
            'interval'    => 'required',
            'teams_limit' => 'required',
        ]);

        // create subscription plan
        $subscription_plan_data = new CatalogSubscriptionPlan($request->input('name'));

        $object = new CatalogObject('SUBSCRIPTION_PLAN', '#' . uniqid());
        $object->setSubscriptionPlanData($subscription_plan_data);

        $body = new UpsertCatalogObjectRequest(uniqid(), $object);

        $api_response = $this->square->getCatalogApi()->upsertCatalogObject($body);

        if (! $api_response->isSuccess()) {
            notify()->error('Failed');
            return back();
        }

        $subscription_plan_id = json_decode(json_encode($api_response->getResult()))->catalog_object->id;

        $price = (float) $request->input('price') * 100;
        $trial = ! empty($request->input('trial')) ? $request->input('trial') : 0;

        // create subscription plan variation
        // initiate phase array
        $phases = [];

        // trial phase
        if ($trial) {
            $pricing = new SubscriptionPricing();
            $pricing->setType('STATIC');
            $money = new Money();
            $money->setAmount(0);
            $money->setCurrency('USD');
            $pricing->setPriceMoney($money);

            $subscription_phase = new SubscriptionPhase($request->input('interval'));
            $subscription_phase->setPeriods($trial);
            $subscription_phase->setOrdinal(0);
            $subscription_phase->setPricing($pricing);

            array_push($phases, $subscription_phase);
        }

        // billing phase
        $pricing1 = new SubscriptionPricing();
        $pricing1->setType('STATIC');
        $money1 = new Money();
        $money1->setAmount($price);
        $money1->setCurrency('USD');
        $pricing1->setPriceMoney($money1);

        $subscription_phase1 = new SubscriptionPhase('DAILY');
        $subscription_phase1->setOrdinal(1);
        $subscription_phase1->setPricing($pricing1);

        array_push($phases, $subscription_phase1);

        $subscription_plan_variation_data = new CatalogSubscriptionPlanVariation($request->input('name') . '_variation', $phases);
        $subscription_plan_variation_data->setSubscriptionPlanId($subscription_plan_id);

        $object1 = new CatalogObject('SUBSCRIPTION_PLAN_VARIATION', '#' . uniqid());
        $object1->setSubscriptionPlanVariationData($subscription_plan_variation_data);

        $body = new UpsertCatalogObjectRequest(uniqid(), $object1);

        $api_response = $this->square->getCatalogApi()->upsertCatalogObject($body);

        if (! $api_response->isSuccess()) {
            notify()->error('Failed');
            return back();
        }

        $subscription_plan_variation_id = json_decode(json_encode($api_response->getResult()))->catalog_object->id;

        // save into plan table
        $plan = new Plan([
            'title'             => $request->input('name'),
            'plan_id'           => $subscription_plan_id,
            'plan_variation_id' => $subscription_plan_variation_id,
            'interval'          => $request->input('interval'),
            'price'             => $request->input('price'),
            'active'            => true,
            'teams_limit'       => $request->input('teams_limit'),
            'trial_period_days' => $trial,
        ]);

        $plan->save();

        notify()->success('Your plan has been created.');

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        /**

         * @get('/admin/plans/{plan}')
         * @name('admin.plans.show')
         * @middlewares(web, auth:sanctum, verified)
         */
        // $this->authorize('view', $plan);

        return view('admin.plans.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /**

         * @get('/admin/plans/{plan}/edit')
         * @name('admin.plans.edit')
         * @middlewares(web, auth:sanctum, verified)
         */
        // $this->authorize('update', Plan::class);

        $plan = Plan::findOrFail($id);

        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /**

         * @methods(PUT, PATCH)
         * @uri('/admin/plans/{plan}')
         * @name('admin.plans.update')
         * @middlewares(web, auth:sanctum, verified)
         */

        $this->demoMode();

        $this->validate($request, [
            'name'        => 'required',
            'teams_limit' => 'required',
        ]);

        $plan   = Plan::findOrFail($id);
        $active = $request->input('active') === 'on';

        $plan->title       = $request->input('name');
        $plan->teams_limit = $request->input('teams_limit');
        $plan->active      = $active;
        $plan->save();

        return redirect()->back()->with('status', 'Your plan has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Plan $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // /**

        //  * @delete('/admin/plans/{plan}')
        //  * @name('admin.plans.destroy')
        //  * @middlewares(web, auth:sanctum, verified)
        //  */
        // $this->demoMode();
        // $plan = Plan::findOrFail($id);

        // $this->stripe->plans->delete($plan->stripe_id, []);

        // // Delete the plan on the database
        // $plan->delete();

        return redirect()->back()->with('status', 'Your plan has been deleted.');
    }

    public function demoMode()
    {
        abort_if(config('saas.demo_mode'), 403, 'Unauthorized action on demo mode! Please Buy Saasify to test that feature');
    }
}
