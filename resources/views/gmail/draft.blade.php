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
                {{ __('My Sent Mail') }}
            </h5>
            <span class="float-right">
                <div class="list-group mail-list  ml-5  mr-3">
                    <div class="row">
                        <a href="{{ route('gmail.compose') }}"
                            class="btn btn-primary btn-rounded waves-effect waves-light col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;">Compose</a>
                        <a href="{{ route('gmail.inbox', 1) }}" class="list-group-item col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;"><i
                                class="fa fa-inbox m-r-10 w-3"></i>Inbox <b></b></a>
                        <a href="{{ route('gmail.draft') }}" class="list-group-item text-success col-xs-3"
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
            @if ($messages->isEmpty())
                <h4 class="text-center">{{ __('You have not any Emails in your Draft.') }}</h4>
            @else
                <div class="table table-detail mail-right">
                    <div class="row">
                        <div class="row m-t-0 ml-2 m-b-30 mr-2 table-responsive">
                            <table id="datatable" class="table-hover mails P-2 table-responsive">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width:2%">#</th>
                                        <th style="width:30%">To</th>
                                        <th style="width:39%">Subject</th>
                                        <th style="width:100%">Content</th>
                                        <th style="width:15%">Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($messages as $message)
                                        <tr onclick="showDraftBox({{ $message->id }})">
                                            <td><input type="checkbox" id="{{ $message->id }}" name="gmail"></td>
                                            <td>{{ $message->to }}</td>
                                            <td>{{ $message->subject }}</td>
                                            <td>{{ substr($message->content, 30) }}...</td>
                                            <td>{{ $message->updated_at }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                {{-- {{ $messages->links() }} --}}
                            </table>
                        </div>
                    </div>

                </div>
            @endif
        </div>
        <form action="{{ route('gmail.api.send') }}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="mail_content" id="mail_content" />
            <input type="hidden" name="mail_type" id="mail_type" value="send" />
            <input type="hidden" name="draft_id" id="draft_id" value="" />

            <div id="con-close-modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog"
                aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Draft Box</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mail_to" class="control-label">To</label>
                                        <input type="email" class="form-control" id="mail_to" name="mail_to"
                                            required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="mail_subject" class="control-label">Subject</label>
                                        <input type="text" class="form-control" id="mail_subject"
                                            name="mail_subject" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="summernote">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-info waves-effect waves-light"
                                onclick="sendMail()">Send Mail</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @livewireStyles

    {{-- <link href="{{ asset('plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/dataTables.colVis.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/fixedColumns.dataTables.min.css') }}" rel="stylesheet"
        type="text/css" /> --}}
    <link href="{{ asset('plugins/summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css">
    @stack('styles')

    @livewireScripts
    {{-- <script src="{{ asset('plugins/summernote/summernote.js') }}"></script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
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
    <script src="{{ asset('plugins/datatables/dataTables.fixedColumns.min.js') }}"></script> --}}
    <script src="{{ asset('plugins/summernote/summernote.min.js') }}"></script>

    <!-- init -->
    <script>
        var draftId;
        $(document).ready(function() {
            $('#datatable').dataTable({
                searching: false,
                paging: false
            });

            $('.summernote').summernote({
                height: 250, // set editor height
                minHeight: null, // set minimum height of editor
                maxHeight: null, // set maximum height of editor
                focus: false // set focus to editable area after initializing summernote
            });
        });

        const showDraftBox = (id) => {
            $("#con-close-modal").modal('show');
            draftId = id;

            var data = {
                id: draftId
            }

            var url = "{{ route('gmail.draft.item') }}";
            $.post(url, data, (res) => {
                //console.log(res)
                $("#mail_subject").val(res.subject);
                $("#mail_to").val(res.to);
                $('.summernote').summernote('code', res.content);
            })
        }

        const sendMail = () => {
            var mail_content = $('.summernote').summernote('code');
            $("#mail_type").val("send");
            $("#mail_content").val(mail_content);
            $("#draft_id").val(draftId);
            toastr.options.closeButton = true;
            toastr.success("E-mail sent successfully.");
        }
    </script>
    @stack('scripts')

</x-account-layout>
