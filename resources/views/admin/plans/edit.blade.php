@extends('layouts.admin')

@section('title', '| Plans')

@section('content')
<div class="u-body">
    <div class="card">
        <div class="card-header">
            <strong>{{ __('Update Plan') }}</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST"
                class="form-horizontal offset-sm-2">
                {!! csrf_field() !!}
                @method('PUT')
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">Plan name</label>
                    <div class="col-md-6">
                        <input type="text" id="name" name="name" class="form-control" value="{{ $plan->title }}"
                            placeholder="Enter Plan name..">

                        @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Plan Price') }}</label>
                    <div class="col-md-6">
                        <input type="number" id="price" name="price" step="0.01" class="form-control"
                            value="{{ $plan->price }}" disabled>

                        @if ($errors->has('price'))
                            <span class="text-danger">{{ $errors->first('price') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">Plan Trial</label>
                    <div class="col-md-6">
                        <input type="number" id="trial" name="trial" class="form-control"
                            value="{{ $plan->trial_period_days }}" disabled>

                        @if ($errors->has('trial'))
                            <span class="text-danger">{{ $errors->first('trial') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Plan interval') }}</label>
                    <div class="col-md-6">
                        <select id="interval" type="" class="form-control" name="interval" disabled>
                            <option value="">{{ __('Select interval') }}</option>
                            <option value="MONTHLY" {{ $plan->interval == 'MONTHLY' ? 'selected' : '' }}>Monthly</option>
                            <option value="ANNUAL" {{ $plan->interval == 'ANNUAL' ? 'selected' : '' }}>Annual</option>
                        </select>

                        @if ($errors->has('interval'))
                            <span class="text-danger">{{ $errors->first('interval') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Teams Plan') }}</label>
                    <div class="col-md-6">
                        <input type="number" id="teams_limit" name="teams_limit" class="form-control"
                            placeholder="Number of member allow for this Plan" value="{{ $plan->teams_limit }}">
                        @if ($errors->has('teams_limit'))
                            <span class="text-danger">{{ $errors->first('teams_limit') }}</span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="hf-name">{{ __('Active') }}</label>
                    <div class="col-md-6 d-flex justify-contents-start align-items-center">
                        @if ($plan->active)
                            <input type="checkbox" id="active" name="active" checked />
                        @else
                            <input type="checkbox" id="active" name="active" />
                        @endif
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-secondary"><i class="fa fa-dot-circle-o"></i>
                    {{ __('Edit plan') }}</button>
                <button type="reset" class="btn btn-danger"><i class="fa fa-ban"></i> {{ __('Reset') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection