<?php

namespace App\Http\Controllers\Subscriptions;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Square\Models\CreateCustomerCardRequest;
use Square\SquareClient;
use Square\Models\CreateCustomerRequest;
use Square\Models\CreateSubscriptionRequest;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    private $square;
    public function __construct()
    {
        $this->middleware(['auth', 'not.subscribed']);
        $this->square = new SquareClient([
            'accessToken' => env('SQUARE_ACCESS_TOKEN'),
            'environment' => env('SQUARE_ENVIRONMENT')
        ]);
    }

    public function index(Request $request)
    {
        /**

         * @get('/subscriptions')
         * @name('subscriptions')
         * @middlewares(web, auth, not.subscribed)
         */
        return view('subscriptions.checkout', [
            'intent' => currentTeam()->createSetupIntent(),
        ]);
    }

    public function store(Request $request)
    {
        /**

         * @post('/subscriptions')
         * @name('subscriptions.store')
         * @middlewares(web, auth, not.subscribed)
         */

        $this->validate($request, [
            'given_name'    => 'required',
            'family_name'   => 'required',
            'email_address' => 'required|email',
            'token'         => 'required',
            'plan'          => 'required|exists:plans,plan_variation_id',
        ]);

        $plan = Plan::where('plan_variation_id', $request->get('plan', 'monthly'))
            ->first();


        $body = new CreateCustomerRequest();
        $body->setGivenName($request->input('given_name'));
        $body->setFamilyName($request->input('family_name'));
        $body->setEmailAddress($request->input('email_address'));

        $api_response = $this->square->getCustomersApi()->createCustomer($body);

        if (! $api_response->isSuccess()) {
            $response = [
                'success' => false,
                'message' => 'Customer creation failed',
            ];
            return $response;
        }

        $customer_id = $api_response->getResult()->getCustomer()->getId();

        $createCustomerCardRequest = new CreateCustomerCardRequest($request->input('token'));
        $api_response              = $this->square->getCustomersApi()->createCustomerCard($customer_id, $createCustomerCardRequest);

        if (! $api_response->isSuccess()) {
            $response = [
                'success' => false,
                'message' => 'Customer card creation failed',
            ];
            return $response;
        }

        $card_id = $api_response->getResult()->getCard()->getId();

        $api_response = $this->square->getLocationsApi()->retrieveLocation('main');

        if (! $api_response->isSuccess()) {
            $response = [
                'success' => false,
                'message' => 'Location retrieve failed',
            ];
            return $response;
        }

        $location_id = $api_response->getResult()->getLocation()->getId();

        $body = new CreateSubscriptionRequest($location_id, $customer_id);
        $body->setIdempotencyKey(uniqid());
        $body->setPlanVariationId($request->get('plan'));
        $body->setCardId($card_id);
        $api_response = $this->square->getSubscriptionsApi()->createSubscription($body);

        if (! $api_response->isSuccess()) {
            $response = [
                'success' => false,
                'message' => 'Subscription creation failed',
            ];
            return $response;
        }

        $subscription_id = $api_response->getResult()->getSubscription()->getId();

        $currentDate = new \DateTime();
        $currentDate->modify("+{$plan->trial_period_days} days");
        $subscription = new Subscription([
            'first_name'        => $request->input('given_name'),
            'last_name'         => $request->input('family_name'),
            'email'             => $request->input('email_address'),
            'user_id'           => Auth::user()->id,
            'plan_id'           => $plan->id,
            'subscription_id'   => $subscription_id,
            'plan_variation_id' => $request->get('plan'),
            'card_id'           => $card_id,
            'next_billing_at'   => $currentDate,
            'status'            => 'ACTIVE',
        ]);
        $subscription->save();

        notify()->success('Your subscription has been created.');

        $response = [
            'success' => true,
            'message' => 'You subscribed successfully.',
        ];
        return $response;
    }
}
