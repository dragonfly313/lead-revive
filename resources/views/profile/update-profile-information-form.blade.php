<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __(' ') }}
    </x-slot>

    <x-slot name="form">
        <!-- Tabs -->
        <div class="row">
            <!-- Profile Photo -->
            <div class="col-lg-2 col-md-3">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="pt-6 pl-4" x-data="{ photoName: null, photoPreview: null }">
                        <!-- Profile Photo File Input -->
                        <input type="file" hidden wire:model="photo" x-ref="photo"
                            x-on:change="
                                                                                                                                  photoName = $refs.photo.files[0].name;
                                                                                                                                  const reader = new FileReader();
                                                                                                                                  reader.onload = (e) => {
                                                                                                                                      photoPreview = e.target.result;
                                                                                                                                  };
                                                                                                                                  reader.readAsDataURL($refs.photo.files[0]);
                                                                                                                          " />

                        <x-jet-label for="photo" value="{{ __('Photo') }}" />

                        <!-- Current Profile Photo -->
                        <div class="mt-5 pl-5" x-show="! photoPreview">
                            <img src="{{ $this->user->profile_photo_url }}" class="rounded-circle" height="80px"
                                width="80px">
                        </div>

                        <!-- New Profile Photo Preview -->
                        <div class="mt-2" x-show="photoPreview">
                            <img x-bind:src="photoPreview" class="rounded-circle" width="80px" height="80px">
                        </div>

                        <x-jet-secondary-button class="mt-5" type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Select A New Photo') }}
                        </x-jet-secondary-button>

                        @if ($this->user->profile_photo_path)
                            <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                                {{ __('Remove Photo') }}
                            </x-jet-secondary-button>
                        @endif

                        <x-jet-input-error for="photo" class="mt-2" />
                    </div>
                @endif
            </div>
            <div class="tab-content col-md-9 col-lg-9">
                <ul class="nav nav-tabs tabs-bordered m-4">
                    <li class="active m-2">
                        <a href="#profile" data-toggle="tab" aria-expanded="false">
                            <span class="visible-xs"><i class="fa fa-home"></i></span>
                            <span class="hidden-xs">Profile</span>
                        </a>
                    </li>
                    <li class="m-2">
                        <a href="#company" data-toggle="tab" aria-expanded="true">
                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                            <span class="hidden-xs">Company</span>
                        </a>
                    </li>
                    @if(subscribed())
                    <li class="m-2">
                        <a href="#email_sync" data-toggle="tab" aria-expanded="true">
                            <span class="visible-xs"><i class="fa fa-envelope"></i></span>
                            <span class="hidden-xs">Email Sync</span>
                        </a>
                    </li>
                    <li class="m-2">
                        <a href="#social_sync" data-toggle="tab" aria-expanded="true">
                            <span class="visible-xs"><i class="fa fa-envelope"></i></span>
                            <span class="hidden-xs">Social Sync</span>
                        </a>
                    </li>
                    @endif
                </ul>
                <div class="tab-pane active" id="profile">
                    <div class="pr-5 pl-5 ">
                        <!-- Name -->
                        <div class="mb-3 ">
                            <x-jet-label for="name" value="{{ __('Name') }}" />
                            <x-jet-input id="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }}"
                                wire:model.defer="state.name" autocomplete="name" />
                            <x-jet-input-error for="name" />
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <x-jet-label for="email" value="{{ __('Email') }}" />
                            <x-jet-input id="email" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                                wire:model.defer="state.email" />
                            <x-jet-input-error for="email" />
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <x-jet-label for="mobile" value="{{ __('Phone') }}" />
                            <x-jet-input id="mobile" type="text"
                                class="{{ $errors->has('mobile') ? 'is-invalid' : '' }}" wire:model.defer="state.mobile"
                                autocomplete="mobile" />
                            <x-jet-input-error for="mobile" />
                        </div>
                        <!-- Gender -->
                        <x-jet-label for="mobile" value="{{ __('Gender') }}" />
                        <div class="row form-group mb-3">
                            <div class="col-sm-12">
                                <div class="input-group input-group-md-down-break">
                                    <!-- Custom Radio -->
                                    <div class="form-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input"
                                                wire:model.defer="state.gender" value="male" name="genderTypeRadio"
                                                id="genderTypeRadio1">
                                            <label class="custom-control-label"
                                                for="genderTypeRadio1">{{ __('Male') }}</label>
                                        </div>
                                    </div>
                                    <!-- End Custom Radio -->

                                    <!-- Custom Radio -->
                                    <div class="form-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input"
                                                wire:model.defer="state.gender" value="female" name="genderTypeRadio"
                                                id="genderTypeRadio2" checked="">
                                            <label class="custom-control-label"
                                                for="genderTypeRadio2">{{ __('Female') }}</label>
                                        </div>
                                    </div>
                                    <!-- End Custom Radio -->

                                    <!-- Custom Radio -->
                                    <div class="form-control">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input"
                                                wire:model.defer="state.gender" value="other" name="genderTypeRadio"
                                                id="genderTypeRadio3">
                                            <label class="custom-control-label"
                                                for="genderTypeRadio3">{{ __('Other') }}</label>
                                        </div>
                                    </div>
                                    <!-- End Custom Radio -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane pr-5 pl-5 " id="company">
                    <h4 class="m-t-0 header-title"><b>Choose Company:</b></h4>
                    <p class="text-muted m-b-30 font-13">
                        Please insert your company.
                    </p>
                    <div class="form-horizontal">
                        <div class="form-group has-feedback">
                            <label class="col-sm-3 control-label">Company</label>
                            <div class="col-sm-6">
                                <div class="mb-3">
                                    {{-- <x-jet-label for="company" value="{{ __('Company') }}" /> --}}
                                    <x-jet-input id="company" type="text"
                                        class="{{ $errors->has('company') ? 'is-invalid' : '' }}"
                                        wire:model.defer="state.company" autocomplete="company" />
                                    <x-jet-input-error for="company" />
                                </div>
                                {{-- <select name="company" id="company" class="form-control" contenteditable="true"
                                    onchange="showSelectedCompany(event)">
                                    <option value="0">Company not selected</option>
                                    @foreach ($Company as $company_1)
                                    <option value="{{ $company_1->id }}">{{ $company_1->company_name }}
                                    </option>
                                    @endforeach
                                </select> --}}
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-10">
                                <div class="form-group has-feedback" id="companyPanel">
                                </div>
                            </div>
                            <div class="col-md-1"></div>
                        </div> --}}
                    </div>
                </div>
                @if(subscribed())
                <div class="tab-pane pr-5 pl-5 " id="email_sync">
                    <div class="row">
                        <div class="col-lg-5 col-md-4 ml-5 mr-3  pl-5">
                            <a href="{{ route('syncGmailPage', 'Outlook') }}">
                                <div class="card-box widget-box-two widget-two-success">
                                    <span class="widget-two-icon d-flex justify-content-center align-items-center">
                                        <img src="{{ asset('saas/svg/outlook.svg') }}" style="width: 40px;" alt="" />
                                    </span>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                            title="Statistics">
                                            Sync with</p>
                                        <h2><span>Outlook</span></h2>
                                        @php
                                            $exist = false;
                                        @endphp
                                        @foreach (Auth::user()->getSyncStatus as $sync)
                                                                            @if ($sync->type == 'Outlook')
                                                                                                                <p class="text-body m-0">
                                                                                                                    <span class="label label-success">{{ $sync->mail }}</span>
                                                                                                                </p>
                                                                                                                @php
                                                                                                                    $exist = true;
                                                                                                                    break;
                                                                                                                @endphp
                                                                            @endif
                                        @endforeach
                                        @if ($exist == false)
                                            <p class="text-muted m-0"><b>Status:</b> Not Synced</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div><!-- end col -->

                        <div class="col-lg-5 col-md-4 ml-3 mr-3  pl-5">
                            <a href="{{ route('syncGmailPage', 'Gmail') }}">
                                <div class="card-box widget-box-two widget-two-danger">
                                    <i class="mdi mdi-gmail widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                            title="Statistics">
                                            Sync with</p>
                                        <h2><span>Gmail</span></h2>
                                        @php
                                            $exist = false;
                                        @endphp
                                        @foreach (Auth::user()->getSyncStatus as $sync)
                                                                            @if ($sync->type == 'Gmail')
                                                                                                                <p class="text-body m-0">
                                                                                                                    <span class="label label-success">{{ $sync->mail }}</span>
                                                                                                                </p>
                                                                                                                @php
                                                                                                                    $exist = true;
                                                                                                                    break;
                                                                                                                @endphp
                                                                            @endif
                                        @endforeach
                                        @if ($exist == false)
                                            <p class="text-muted m-0"><b>Status:</b> Not Synced</p>
                                        @endif

                                    </div>
                                </div>
                            </a>
                        </div><!-- end col -->

                        <div class="col-lg-5 col-md-4 ml-5 mr-3  pl-5">
                            <a href="{{ route('syncGmailPage', 'Your Own Mail') }}">
                                <div class="card-box widget-box-two widget-two-primary">
                                    <i class="fa fa-envelope widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                            title="Statistics">
                                            Sync with</p>
                                        <h2><span>Your Own Mail</span></h2>
                                        @php
                                            $exist = false;
                                        @endphp
                                        @foreach (Auth::user()->getSyncStatus as $sync)
                                                                            @if ($sync->type == 'Your Own Mail')
                                                                                                                <p class="text-body m-0">
                                                                                                                    <span class="label label-success">{{ $sync->mail }}</span>
                                                                                                                </p>
                                                                                                                @php
                                                                                                                    $exist = true;
                                                                                                                    break;
                                                                                                                @endphp
                                                                            @endif
                                        @endforeach
                                        @if ($exist == false)
                                            <p class="text-muted m-0"><b>Status:</b> Not Synced</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div><!-- end col -->

                        <div class="col-lg-5 col-md-4 ml-3 mr-3  pl-5">
                            <a href="{{ route('syncGmailPage', 'Apple Mail') }}">
                                <div class="card-box widget-box-two widget-two-teal">
                                    <i class="fab fa-apple widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflo
                                        w" title="Statistics">
                                            Sync with</p>
                                        <h2><span>Apple Mail</span></h2>
                                        @php
                                            $exist = false;
                                        @endphp
                                        @foreach (Auth::user()->getSyncStatus as $sync)
                                                                            @if ($sync->type == 'Apple Mail')
                                                                                                                <p class="text-body m-0">
                                                                                                                    <span class="label label-success">{{ $sync->mail }}</span>
                                                                                                                </p>
                                                                                                                @php
                                                                                                                    $exist = true;
                                                                                                                    break;
                                                                                                                @endphp
                                                                            @endif
                                        @endforeach
                                        @if ($exist == false)
                                            <p class="text-muted m-0"><b>Status:</b> Not Synced</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div><!-- end col -->

                    </div>
                </div>
                <div class="tab-pane pr-5 pl-5 " id="social_sync">
                    <div class="row">
                        <div class="col-lg-5 col-md-4 ml-5 mr-3  pl-5">
                            <a href="{{ route('syncGmailPage', 'Facebook') }}">
                                <div class="card-box widget-box-two widget-two-success">
                                    <i class="mdi mdi-phone widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                            title="Statistics">
                                            Sync with</p>
                                        <h2><span>Facebook</span></h2>
                                        @php
                                            $exist = false;
                                        @endphp
                                        @foreach (Auth::user()->getSyncStatus as $sync)
                                                                            @if ($sync->type == 'Facebook')
                                                                                                                <p class="text-body m-0">
                                                                                                                    <span class="label label-success">{{ $sync->mail }}</span>
                                                                                                                </p>
                                                                                                                @php
                                                                                                                    $exist = true;
                                                                                                                    break;
                                                                                                                @endphp
                                                                            @endif
                                        @endforeach
                                        @if ($exist == false)
                                            <p class="text-muted m-0"><b>Status:</b> Not Synced</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div><!-- end col -->

                        <div class="col-lg-5 col-md-4 ml-3 mr-3  pl-5">
                            <a href="{{ route('syncGmailPage', 'Instagram') }}">
                                <div class="card-box widget-box-two widget-two-danger">
                                    <i class="mdi mdi-gmail widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                            title="Statistics">
                                            Sync with</p>
                                        <h2><span>Instagram</span></h2>
                                        @php
                                            $exist = false;
                                        @endphp
                                        @foreach (Auth::user()->getSyncStatus as $sync)
                                                                            @if ($sync->type == 'Instagram')
                                                                                                                <p class="text-body m-0">
                                                                                                                    <span class="label label-success">{{ $sync->mail }}</span>
                                                                                                                </p>
                                                                                                                @php
                                                                                                                    $exist = true;
                                                                                                                    break;
                                                                                                                @endphp
                                                                            @endif
                                        @endforeach
                                        @if ($exist == false)
                                            <p class="text-muted m-0"><b>Status:</b> Not Synced</p>
                                        @endif

                                    </div>
                                </div>
                            </a>
                        </div><!-- end col -->

                        <div class="col-lg-5 col-md-4 ml-5 mr-3  pl-5">
                            <a href="{{ route('syncGmailPage', 'Twitter') }}">
                                <div class="card-box widget-box-two widget-two-primary">
                                    <i class="fa fa-envelope widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                            title="Statistics">
                                            Sync with</p>
                                        <h2><span>Twitter</span></h2>
                                        @php
                                            $exist = false;
                                        @endphp
                                        @foreach (Auth::user()->getSyncStatus as $sync)
                                                                            @if ($sync->type == 'Twitter')
                                                                                                                <p class="text-body m-0">
                                                                                                                    <span class="label label-success">{{ $sync->mail }}</span>
                                                                                                                </p>
                                                                                                                @php
                                                                                                                    $exist = true;
                                                                                                                    break;
                                                                                                                @endphp
                                                                            @endif
                                        @endforeach
                                        @if ($exist == false)
                                            <p class="text-muted m-0"><b>Status:</b> Not Synced</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div><!-- end col -->

                        <div class="col-lg-5 col-md-4 ml-3 mr-3  pl-5">
                            <a href="{{ route('syncGmailPage', 'Tiktok') }}">
                                <div class="card-box widget-box-two widget-two-teal">
                                    <i class="mdi mdi-wechat widget-two-icon"></i>
                                    <div class="wigdet-two-content">
                                        <p class="m-0 text-uppercase font-600 font-secondary text-overflow"
                                            title="Statistics">
                                            Sync with</p>
                                        <h2><span>Tiktok</span></h2>
                                        @php
                                            $exist = false;
                                        @endphp
                                        @foreach (Auth::user()->getSyncStatus as $sync)
                                                                            @if ($sync->type == 'Tiktok')
                                                                                                                <p class="text-body m-0">
                                                                                                                    <span class="label label-success">{{ $sync->mail }}</span>
                                                                                                                </p>
                                                                                                                @php
                                                                                                                    $exist = true;
                                                                                                                    break;
                                                                                                                @endphp
                                                                            @endif
                                        @endforeach
                                        @if ($exist == false)
                                            <p class="text-muted m-0"><b>Status:</b> Not Synced</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div><!-- end col -->

                    </div>
                </div>
                @endif
    </x-slot>

    <x-slot name="actions">
        <div class="d-flex align-items-baseline">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Profile saved.') }}
            </x-jet-action-message>

            <x-jet-button>
                {{ __('Save') }}
            </x-jet-button>
        </div>
    </x-slot>
</x-jet-form-section>