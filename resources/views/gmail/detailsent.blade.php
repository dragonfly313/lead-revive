<x-account-layout>
    <x-slot name="header">
        <div class="d-none d-lg-block">
            <h1 class="h2 text-white">{{ __('My tickets') }}</h1>
        </div>
    </x-slot>
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <!-- Title -->
            <h5 class="h3 mb-0">
                {{ __('My Sent Box') }}
            </h5>
            <span class="float-right">
                <div class="list-group mail-list  ml-5">
                    <div class="row">
                        <a href="{{ route('gmail.compose') }}"
                            class="btn btn-primary btn-rounded waves-effect waves-light col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;">Compose</a>
                        <a href="{{ route('gmail.inbox', 1) }}" class="list-group-item col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                class="fa fa-inbox m-r-10 w-3"></i>Inbox <b></b></a>
                        <a href="{{ route('gmail.draft') }}" class="list-group-item  col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                class="fa fa-envelope m-r-10"></i>Draft <b></b></a>
                        <a href="{{ route('gmail.sent') }}" class="list-group-item text-success col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                class="fa fa-paper-plane m-r-10"></i>Sent Mail</a>
                        <a href="{{ route('gmail.archive') }}" class="list-group-item col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                class="fa  fa-archive m-r-10 w-3"></i>Archive <b></b></a>
                        <div class="btn-toolbar ml-7 " role="toolbar"></div>
                        <div class="btn-toolbar ml-7 " role="toolbar">
                            <div class="btn-group ml-5">
                                <button type="button" class="btn btn-primary waves-effect waves-light ml-1 "
                                    style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                        class="fa fa-inbox"></i></button>
                                <button type="button" class="btn btn-primary waves-effect waves-light ml-1"
                                    style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                        class="fa fa-exclamation-circle"></i></button>
                                <button type="button" class="btn btn-primary waves-effect waves-light ml-1"
                                    style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                        class="fa fa-trash"></i></button>
                            </div>
                            <div class="btn-group ml-2"
                                style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;">
                                <button type="button"
                                    class="btn btn-primary dropdown-toggle waves-effect waves-light ml-1"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-folder"></i>
                                    <b class="caret"></b>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="javascript:void(0);">Separated link</a></li>
                                </ul>
                            </div>
                            <div class="btn-group ml-2">
                                <button type="button" class="btn btn-primary waves-effect waves-light  dropdown-toggle"
                                    data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-tag"></i>
                                    <b class="caret"></b>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="javascript:void(0);">Action</a></li>
                                    <li><a href="javascript:void(0);">Another action</a></li>
                                    <li><a href="javascript:void(0);">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="javascript:void(0);">Separated link</a></li>
                                </ul>
                            </div>

                            <div class="btn-group ml-1">
                                <button type="button" class="btn btn-primary waves-effect waves-light  dropdown-toggle"
                                    data-toggle="dropdown" aria-expanded="false">
                                    More
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="javascript:void(0);">Dropdown link</a></li>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </span>
        </div>
        <div class="card-body">
            {{-- @if ($messages->isEmpty())
                <h4 class="text-center">{{ __('You have not any Gmails.') }}</h4>
            @else --}}
                <div class="table-detail mail-right">
                    <!-- End row -->

                    <div class="row m-t-0 m-b-30">
                        <div class="col-sm-12">
                            <div class="card-box m-t-20">
                                <h4 class="m-t-0"><b>
                                        @foreach ($message->getPayload()->getHeaders() as $header)
                                            @if ($header->name == 'Subject')
                                                {{ $header->value }}
                                            @endif
                                        @endforeach
                                    </b></h4>

                                <hr />

                                <div class="media m-b-30 ">
                                    <a href="#" class="pull-left">
                                        <img alt="" src="{{ asset('images/profile.png') }}"
                                            class="media-object thumb-sm img-circle">
                                    </a>
                                    <div class="media-body">
                                        <span
                                            class="media-meta pull-right">{{ date('Y-m-d H:i:s', $message->getInternalDate() / 1000) }}</span>
                                        <h4 class="text-primary m-0">
                                            @foreach ($message->getPayload()->getHeaders() as $header)
                                                @if ($header->name == 'To')
                                                    @php
                                                        preg_match('/([^<]*)<([^>]*)>/', $header['value'], $matches);
                                                        if (count($matches) === 3) {
                                                            $fromName = trim($matches[1]);
                                                            $fromAddress = trim($matches[2]);
                                                        } else {
                                                            $fromAddress = trim($header['value']);
                                                        }
                                                    @endphp
                                                    @isset($fromName)
                                                        {{ $fromName }}
                                                    @endisset
                                                @endif
                                            @endforeach
                                        </h4>
                                        <small class="text-muted">To:
                                            @foreach ($message->getPayload()->getHeaders() as $header)
                                                @if ($header->name == 'To')
                                                    @php
                                                        preg_match('/([^<]*)<([^>]*)>/', $header['value'], $matches);
                                                        if (count($matches) === 3) {
                                                            $fromName = trim($matches[1]);
                                                            $fromAddress = trim($matches[2]);
                                                        } else {
                                                            $fromAddress = trim($header['value']);
                                                        }
                                                    @endphp
                                                    {{ $fromAddress }}
                                                @endif
                                            @endforeach
                                        </small>
                                    </div>
                                </div> <!-- media -->
                                {!! base64_decode(str_replace(['-', '_'], ['+', '/'], $message->getPayload()->getBody()->getData())) !!}
                            </div>
                            <!-- card-box -->
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <div class="row m-t-20 m-b-30">
                        <div class="col-sm-12">
                            <div class="text-right">
                                <button onclick="replyMessage()"
                                    class="btn btn-primary waves-effect waves-light w-md m-b-30"><i
                                        class="mdi mdi-reply m-r-10"></i>Reply</button>
                            </div>
                        </div>
                    </div>
                </div>
            {{-- @endif --}}
        </div>
    </div>
    @livewireScripts
    <script>
        const replyMessage = () => {
            var email = "{{ $fromAddress }}";
            localStorage.setItem("reply", email);
            location.href = "{{ route('gmail.compose') }}";
        }
    </script>
    @stack('scripts')
    {{-- @section('pageJS') --}}
    <!-- init -->

    {{-- @endsection --}}
</x-account-layout>
