<section id="pricing">
  <!--begin container -->
  <h3 class="text-center section-title" id="pricingTitle" contenteditable="{{ Request::is('account/websites/compose') ? 'true' : 'false' }}">{{ __('Find the right plan for your business') }}</h3>
  <div class="container">
    <!--begin row -->
    <div class="row">
      <div class="pricing">
        <div class="switch align-self-center">
          <label>{{ __('Monthly') }}</label>
          <input type="checkbox" wire:model="month" wire:change="changePlan" class="switch" id="switch-id" checked>
          <label for="switch-id">{{ __('Annual') }}</label><span class="mb-2 ml-2 badge badge-primary">{{ __('Save up to 16.7%') }}</span>
        </div>
      </div>
      <!--begin col-md-12 -->
      <div class="text-center col-md-12 padding-bottom-40">

      </div>
      <!--end col-md-12 -->
      <!--begin col-md-4-->
      @foreach ($plans as $index => $plan)
      <div class="col-md-4">
        <div class="price-box">
          @if ($index === 1)
          <div class="ribbon blue"><span>{{ __('Feature') }}</span></div>
          @endif
          <ul class="pricing-list">

            <li class="price-title">{{$plan->title}}</li>

            <li class="price-value">${{$plan->price}}</li>
            @if ($show == 'MONTHLY')
            <li class="price-subtitle">{{ __('Per User Per Month') }}</li>
            @else
            <li class="price-subtitle">{{ __('Per User Per Year') }}</li>
            @endif

            <li class="price-text"><i class="fas fa-check blue"></i>Access to all APIs</li>

            <li class="price-text"><i class="fas fa-check blue"></i><b>{{ __('Number of team ') }} {{$plan->teams_limit}}</b></li>

            @if ($plan->trial_period_days)
            <li class="price-text"><i class="fas fa-tag blue"></i>Free trial {{$plan->trial_period_days}} days</li>
            @endif

            <li class="price-tag-line"><a href="javascript:void(0)" onclick="subscribe('{{ $plan->plan_variation_id }}')">{{ __('Subscribe') }}</a></li>
          </ul>
        </div>
      </div>
      @endforeach
      
      <div id="subscriptioinModal" class="modal fade text-dark" tabindex="-1" role="dialog" aria-labelledby="subscriptioinModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-full">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="subscriptioinModalLabel">Subscribe</h4>
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
            </div>
            <div class="modal-body">
              <form id="card-form">
                @csrf
                <input type="hidden" name="plan" id="plan" />
                <div class="form-group">
                  <label for="given_name">{{ __('First Name') }}</label>
                  <input type="text" name="given_name" id="given_name" class="form-control" required>
                  @if ($errors->has('given_name'))
                    <span class="text-danger">{{ $errors->first('given_name') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="family_name">{{ __('Last Name') }}</label>
                  <input type="text" name="family_name" id="family_name" class="form-control" required>
                  @if ($errors->has('family_name'))
                    <span class="text-danger">{{ $errors->first('family_name') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="email_address">{{ __('Email Address') }}</label>
                  <input type="email" name="email_address" id="email_address" class="form-control" required>
                  @if ($errors->has('email_address'))
                    <span class="text-danger">{{ $errors->first('email_address') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label for="">{{ __('Card details') }}</label>
                  <div id="card-element"></div>
                </div>
                <div class="modal-footer">
                  <button type="submit" id="card-button" class="btn btn-primary waves-effect">Submit</button>
                  <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!--end row -->

  </div>
  <!--end container -->

</section>
<!--end pricing section -->
@push('styles')
<link href="{{ asset('saas/home/css/style.css')}}" rel="stylesheet">
<link href="{{ asset('assets/css/plan-list.css')}}" rel="stylesheet">
@endpush

@push('scripts')
<script type="text/javascript" src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
  let card
  const mount = async () => {
    const payments = Square.payments("{{ env('SQUARE_APPLICATION_ID') }}")
    card = await payments.card()
    await card.attach("#card-element")
  }

  mount()

  window.Laravel = {!! json_encode([
            'isLoggedIn' => Auth::check(),
        ]) !!};

  function subscribe (plan_variation_id) {
    if (window.Laravel.isLoggedIn) {
      $('#plan').val(plan_variation_id)
      $('#subscriptioinModal').modal('show')
    } else {
      window.location.href = '/login'
    }
  }

  const form = document.getElementById('card-form')
  const cardButton = document.getElementById('card-button')

  form.addEventListener('submit', async (e) => {
    e.preventDefault()

    cardButton.disabled = true

    const result = await card.tokenize()

    if (result.status === "OK") {
      let token = document.createElement('input')

      token.setAttribute('type', 'hidden')
      token.setAttribute('name', 'token')
      token.setAttribute('value', result.token)

      form.appendChild(token)

      let formData = new FormData(form)
      axios.post('{{ route('subscriptions.store') }}', formData)
        .then(res => {
          if (res.data.success) {
            toastr.success(res.data.message);
            $('#subscriptioinModal').modal('hide')
          } else {
            toastr.warning(res.data.message);
          }
        })
      cardButton.disabled = false
    } else {
      cardButton.disabled = false
    }
  })
</script>
@endpush