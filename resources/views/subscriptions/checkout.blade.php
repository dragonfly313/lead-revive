<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Checkout')  }}</h1>
        </div>
    </x-slot>

    <div class="card">
        <div class="card-body">

                <x:card-form :action="route('subscriptions.store')">
                    <input type="hidden" name="plan" id="plan" value="{{ request('plan') }}" />

                    <!-- <div class="form-group">
                        <label for="coupon">{{ __('Coupon') }} (optional)</label>
                        <input type="text" name="coupan" id="coupon" class="form-control" />
                    </div> -->
                    
                    <button type="submit" class="btn btn-primary " id="card-button" data-secret="{{ $intent->client_secret }}"> {{ __('Subscribe') }} </button>
                </x:card-form>

        </div>

    </div>
    @push('styles')
    <!-- <script src="https://js.stripe.com/v3/"></script> -->
    <script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
    @endpush
</x-account-layout>
