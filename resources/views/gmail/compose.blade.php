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
                {{ __('My Compose') }}
            </h5>
            <span class="float-right">
                <div class="list-group mail-list  ml-3 mr-3">
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
                        <a href="{{ route('gmail.sent') }}" class="list-group-item  col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                class="fa fa-paper-plane m-r-10"></i>Sent Mail</a>
                        <a href="{{ route('gmail.archive') }}" class="list-group-item  col-xs-3"
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
            <div class="table-detail mail-right">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box m-t-20">
                            <div class="">
                                <form role="form" method="POST" action="{{ route('gmail.api.send') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                    <input type="hidden" name="mail_content" id="mail_content" />
                                    <input type="hidden" name="mail_type" id="mail_type" value="send" />
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="To" name="mail_to"
                                            id="mail_to">
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="email" class="form-control" placeholder="Cc"
                                                    name="mail_cc" id="mail_cc">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="email" class="form-control" placeholder="Bcc"
                                                    name="mail_bcc" id="mail_bcc">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Subject"
                                            id="mail_subject" name="mail_subject">
                                    </div>
                                    <div class="form-group">
                                        <div class="summernote">
                                        </div>
                                    </div>

                                    <div class="btn-toolbar form-group m-b-0">
                                        <div class="pull-right">
                                            <button type="submit" title="save in Draft"
                                                class="btn btn-success waves-effect waves-light m-r-5"
                                                onclick="sendDraft(event)">
                                                <i class="fa fa-floppy-o"></i><span>Save</span></button>
                                            <button type="button" title="delete"
                                                class="btn btn-success waves-effect waves-light m-r-5"
                                                onclick="deleteGmail()">
                                                <i class="fa fa-trash"></i><span>Clear</span></button>
                                            <button type="submit" class="btn btn-primary waves-effect waves-light"
                                                onclick="sendGmail(event)">
                                                <span>Send</span> <i class="fa fa-send m-l-1"></i> </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
    <!-- init -->
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
    <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>

    <!-- init -->
    <script>
        $(document).ready(function() {
            if (localStorage.getItem("reply") != null) {
                $("#mail_to").val(localStorage.getItem("reply"));
                localStorage.setItem("reply", '');
            }
            $('.summernote').summernote({
                height: 250, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });

        });

        const sendGmail = (event) => {
            var mail_content = $('.summernote').summernote('code');
            $("#mail_type").val("send");
            $("#mail_content").val(mail_content);
            toastr.options.closeButton = true;
            toastr.success("E-mail sent successfully");
        }

        const sendDraft = (event) => {
            var mail_content = $('.summernote').summernote('code');
            $("#mail_content").val(mail_content);
            $("#mail_type").val("draft");
            toastr.options.closeButton = true;
            toastr.success("E-mail saved in Draft successfully");
        }

        const deleteGmail = () => {
            $("#mail_type").val("send");
            $("#mail_content").val("");
            $('.summernote').summernote('code', '');
            $("#mail_to").val("");
            $("#mail_cc").val("");
            $("#mail_bcc").val("");
            $("#mail_subject").val("");
        }
    </script>
    @stack('scripts')
</x-account-layout>
