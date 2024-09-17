<div class="card-body">
    <form  wire:submit.prevent="store" class="form-horizontal offset-sm-2">
            {!! csrf_field() !!}
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="hf-name">{{ __('Select Users') }}</label>
            <div class="col-md-6" wire:ignore>
                <select id="category-dropdown" class="form-control" multiple wire:model="selectusers">
                    @foreach($users as $user)
                        <option value="{{$user->id}}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="hf-name">{{ __('Subject') }}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" wire:model="subject"/>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="hf-name">{{ __('Message') }}</label>
            <div class="col-md-6">
                <textarea class="form-control" rows="4" wire:model="body"></textarea>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-md-3 col-form-label" for="hf-name">{{ __('Link') }}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" wire:model="link"/>
            </div>
        </div>
            <hr>
        <button type="submit" class="btn btn-secondary"><i class="fa fa-dot-circle-o"></i> {{ __('Send announcement') }}</button>
    </form>
</div>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function () {
            $('#category-dropdown').select2();
            $('#category-dropdown').on('change', function (e) {
                let data = $(this).val();
                 @this.set('selectusers', data);
            });
            window.livewire.on('productStore', () => {
                $('#category-dropdown').select2();
            });
        });  
    </script>
@endpush
