<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('Plans') }}
            </h1>
        </div>
    </x-slot>

    <div class="card mb-3 mb-lg-5" x-data="{ 'month': false }">
        <!-- Header -->
        <div class="card-header">
            <h5 class="card-header-title">{{ __('Our plans') }}</h5>
        </div>
        <!-- End Header -->

        <!-- Body -->
        <div class="card-body">
            <div class="row">
                <!-- Pricing Section -->
                <div class="overflow-hidden">
                    <div class="container pb-1">
                        <!-- Title -->
                        <div class="w-md-10 w-lg-10 text-center mx-md-auto mb-9">
                            <h3 class="h3">{{ __('Flexible and transparent pricing') }}</h3>
                            <p>{{ __('Whatever your status, our offers evolve according to your needs.') }}</p>
                        </div>
                        <!-- End Title -->

                        <!-- Toggle Switch -->
                        <div class="d-flex justify-content-center align-items-center mb-5">
                            <span class="font-size-1 text-muted">{{ __('Monthly') }}</span>
                            <label class="toggle-switch mx-2" for="customSwitchExample1">
                                <input type="checkbox" x-model="month" class="js-toggle-switch toggle-switch-input"
                                    id="customSwitchExample1" data-hs-toggle-switch-options='{
                   "targetSelector": "#pricingCount1Example1, #pricingCount2Example1, #pricingCount3Example1"
                 }'>
                                <span class="toggle-switch-label">
                                    <span class="toggle-switch-indicator"></span>
                                </span>
                            </label>
                            <div class="position-relative">
                                <span class="font-size-1 text-muted">{{ __('Annual') }}</span>

                                <!-- Arrow -->
                                <figure class="position-absolute top-0 text-nowrap mt-n5 ml-3 ml-md-7">
                                    <svg class="d-block position-absolute mt-n2 ml-n4"
                                        xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 99.3 57"
                                        width="48">
                                        <path fill="none" stroke="#bdc5d1" stroke-width="4" stroke-linecap="round"
                                            stroke-miterlimit="10" d="M2,39.5l7.7,14.8c0.4,0.7,1.3,0.9,2,0.4L27.9,42" />
                                        <path fill="none" stroke="#bdc5d1" stroke-width="4" stroke-linecap="round"
                                            stroke-miterlimit="10" d="M11,54.3c0,0,10.3-65.2,86.3-50" />
                                    </svg>
                                    <span class="badge badge-primary badge-pill py-sm-2 px-sm-3">{{ __('Save up to 10%') }}</span>
                                </figure>
                                <!-- End Arrow -->
                            </div>
                        </div>
                        <!-- End Toggle Switch -->
                        <!-- Pricing Section -->
                        <div class="container">
                            <!-- Pricing -->
                            <form action="{{ route('account.subscriptions.swap') }}" method="post">
                                @csrf
                            <div
                                class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon w-100">
                                <input type="radio" id="pricingRadio1" name="pricingRadio1"
                                    class="custom-control-input checkbox-outline-input checkbox-icon-input" checked>
                                <label class="checkbox-outline-label checkbox-icon-label w-100 rounded p-4"
                                    for="pricingRadio1">
                                    <span class="row">
                                        <span class="col-sm-3 order-sm-2 text-sm-right mb-3 mb-sm-0">
                                            <span class="d-block mb-2">
                                                <span class="text-primary font-weight-bold align-top">$</span>
                                                <span class="font-size-3 text-primary font-weight-bold">25</span>
                                                <span class="font-size-1">/ mo</span>
                                            </span>
                                        </span>
                                        <span class="col-sm-9 order-sm-1">
                                            <span class="d-block h3 mb-1">{{ __('Launch') }}</span>
                                            <span class="d-block">{{ __('99GB storage in launch accounts') }}</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <!-- End Pricing -->

                            <!-- Pricing -->
                            <div
                                class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon w-100">
                                <input type="radio" id="pricingRadio2" name="pricingRadio1"
                                    class="custom-control-input checkbox-outline-input checkbox-icon-input">
                                <label class="checkbox-outline-label checkbox-icon-label w-100 rounded p-4"
                                    for="pricingRadio2">
                                    <span class="row">
                                        <span class="col-sm-3 order-sm-2 text-sm-right mb-3 mb-sm-0">
                                            <span class="d-block mb-2">
                                                <span class="text-primary font-weight-bold align-top">$</span>
                                                <span class="font-size-3 text-primary font-weight-bold">44</span>
                                                <span class="font-size-1">/ {{ __('mo') }}</span>
                                            </span>
                                        </span>
                                        <span class="col-sm-9 order-sm-1">
                                            <span class="d-block h3 mb-1">{{ __('Growth') }}</span>
                                            <span class="d-block">{{ __('500GB storage in growth accounts') }}</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <!-- End Pricing -->

                            <!-- Pricing -->
                            <div
                                class="custom-control custom-radio custom-control-inline checkbox-outline checkbox-icon w-100">
                                <input type="radio" id="pricingRadio3" name="pricingRadio1"
                                    class="custom-control-input checkbox-outline-input checkbox-icon-input">
                                <label class="checkbox-outline-label checkbox-icon-label w-100 rounded p-4"
                                    for="pricingRadio3">
                                    <span class="row">
                                        <span class="col-sm-3 order-sm-2 text-sm-right mb-3 mb-sm-0">
                                            <span class="d-block mb-2">
                                                <span class="text-primary font-weight-bold align-top">$</span>
                                                <span class="font-size-3 text-primary font-weight-bold">99</span>
                                                <span class="font-size-1">/ mo</span>
                                            </span>
                                        </span>
                                        <span class="col-sm-9 order-sm-1">
                                            <span class="d-block h3 mb-1">{{ __('Enterprise') }}</span>
                                            <span class="d-block">{{ __('100TB storage in enterprise accounts') }}</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <!-- End Pricing -->
                            <button type="submit" class="btn btn-primary">{{ __('Swap plan') }}</button>
                            </form>
                            <div class="text-center mt-5">
                                <div class="mb-5">
                                    <p class="font-size-1">{{ __('Need 100TB+ storage?') }} <a class="font-weight-bold"
                                            href="#">{{ __('Contact us for custom pricing') }}</a></p>
                                </div>
                            </div>
                        </div>
                        <!-- End Pricing Section -->
                    </div>
                </div>
            </div>
</x-account-layout>
@push('scripts')
<!-- JS Implementing Plugins -->
<script src="{{ asset('saas/vendor/hs-toggle-switch/dist/hs-toggle-switch.min.js') }}"></script>

<!-- JS Plugins Init. -->
<script>
    $(document).on('ready', function () {
        // initialization of toggle switch
        $('.js-toggle-switch').each(function () {
            var toggleSwitch = new HSToggleSwitch($(this)).init();
        });
    });

</script>
@endpush
