<div>
    <form action="{{ $attributes->get('action') }}" method="post" id="card-form">
        @csrf

        <div class="row">
            <div class="col-6 form-group">
                <label for="given_name">{{ __('First Name') }}</label>
                <input type="text" name="given_name" id="given_name" class="form-control" required>
                @if ($errors->has('given_name'))
                    <span class="text-danger">{{ $errors->first('given_name') }}</span>
                @endif
            </div>
            <div class="col-6 form-group">
                <label for="family_name">{{ __('Last Name') }}</label>
                <input type="text" name="family_name" id="family_name" class="form-control" required>
                @if ($errors->has('family_name'))
                    <span class="text-danger">{{ $errors->first('family_name') }}</span>
                @endif
            </div>
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

        {{$slot}}

    </form>

    <div class="modal fade bd-example-modal-sm" data-backdrop="false" id="confirmSubscribe" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Confirmation') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ __('Are you sure to subscribe this plan?') }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
                    <button type="button" onclick="confirm_subscribe()"
                        class="btn btn-danger">{{ __('Confirm') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    let card
    const mount = async () => {
        const payments = Square.payments("{{ env('SQUARE_APPLICATION_ID') }}")
        card = await payments.card()
        await card.attach("#card-element")
    }

    mount()

    const form = document.getElementById('card-form')
    const cardButton = document.getElementById('card-button')

    form.addEventListener('submit', async (e) => {
        e.preventDefault()

        cardButton.disabled = true

        const result = await card.tokenize()
        console.log(result)

        if (result.status === "OK") {
            let token = document.createElement('input')

            token.setAttribute('type', 'hidden')
            token.setAttribute('name', 'token')
            token.setAttribute('value', result.token)

            form.appendChild(token)

            new Bootstrap.Modal(document.getElementById('confirmSubscribe')).toggle()
            cardButton.disabled = false
        } else {
            cardButton.disabled = false
        }
    })
    
    const confirm_subscribe = () => {
        console.log('erg')
        form.submit()
    }
</script>