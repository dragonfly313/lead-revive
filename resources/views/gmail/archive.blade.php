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
                {{ __('My Archive') }}
            </h5>
            <span class="float-right">
                <div class="list-group mail-list  ml-5 mr-3">
                    <div class="row">
                        <a href="{{ route('gmail.compose') }}"
                            class="btn btn-primary btn-rounded waves-effect waves-light col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;">Compose</a>
                        <a href="{{ route('gmail.inbox', 1) }}" class="list-group-item  col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                class="fa fa-inbox m-r-10 w-3"></i>Inbox <b></b></a>
                        <a href="{{ route('gmail.draft') }}" class="list-group-item  col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                class="fa fa-envelope m-r-10"></i>Draft <b></b></a>
                        <a href="{{ route('gmail.sent') }}" class="list-group-item  col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                class="fa fa-paper-plane m-r-10"></i>Sent Mail</a>
                        <a href="{{ route('gmail.archive') }}" class="list-group-item  text-success  col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                class="fa  fa-archive m-r-10 w-3"></i>Archive <b></b></a>
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
                            <div class="btn-group ml-2">
                                <button type="button"
                                    class="btn btn-primary dropdown-toggle waves-effect waves-light ml-1"
                                    style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"
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
                                    style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"
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
                                    style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"
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
            @if (count($messages) === 0)
                <h4 class="text-center">{{ __('You have not any Emails.') }}</h4>
            @else
                <div class="table table-detail mail-right">
                    <div class="row">
                        <div class="row m-t-20 m-b-30 table-responsive">
                            <table id="datatable" class="table table-hover mails m-0">
                                <thead class="hidden">
                                    <tr>
                                        <th>#</th>
                                        <th>Subject</th>
                                        <th>Mail</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                        <tr>
                                            <td><input type="checkbox" id="{{ $message->id }}" name="gmail"></td>
                                            <td><a href="{{ route('gmail.detail.inbox', "$message->id") }}">
                                                    @foreach ($message->getPayload()->getHeaders() as $header)
                                                        @if ($header->name == 'Subject')
                                                            {{ $header->value }}
                                                        @endif
                                                    @endforeach
                                                </a></td>
                                            <td><a
                                                    href="{{ route('gmail.detail.inbox', "$message->id") }}">{{ $message->getSnippet() }}...</a>
                                            </td>
                                            <td><a
                                                    href="{{ route('gmail.detail.inbox', "$message->id") }}">{{ date('Y-m-d H:i:s', $message->getInternalDate() / 1000) }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @livewireStyles
    <link href="{{ asset('plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/dataTables.colVis.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/fixedColumns.dataTables.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('plugins/summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
    @stack('styles')

    @livewireScripts
    {{-- <script src="{{ asset('plugins/summernote/summernote.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.js') }}"></script>

    <script src="{{ asset('plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.colVis.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.fixedColumns.min.js') }}"></script>

    <!-- init -->
    <script>
        $(document).ready(function() {
            $('#datatable').dataTable({
                searching: false,
                paging: false
            });
        });
    </script>
    @stack('scripts')
</x-account-layout>
