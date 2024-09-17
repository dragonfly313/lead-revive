@extends('layouts.admin')
@section('title', __('messages.title_gmail'))
@section('content')
    <!-- Dashboard content goes here -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="mails">
                    <div class="table-box">
                        <div class="table-detail m-4">
                            <div class="p-2">
                                <div class="row w-full">
                                    <a href="{{ route('gmail.compose') }}"
                                        class="btn btn-primary btn-rounded waves-effect waves-light col-xs-3">Compose</a>

                                    <div class="list-group mail-list  ml-5">
                                        <div class="row">
                                            <a href="{{ route('gmail.inbox', 1) }}"
                                                class="list-group-item text-success  col-xs-3"><i
                                                    class="fa fa-inbox m-r-10 w-3"></i>Inbox <b></b></a>
                                            <a href="{{ route('gmail.draft') }}" class="list-group-item  col-xs-3"><i
                                                    class="fa fa-envelope-o m-r-10"></i>Draft <b></b></a>
                                            <a href="{{ route('gmail.sent') }}" class="list-group-item  col-xs-3"><i
                                                    class="fa fa-paper-plane m-r-10"></i>Sent Mail</a>
                                            <a href="{{ route('gmail.archive') }}" class="list-group-item  col-xs-3"><i
                                                    class="fa  fa-archive m-r-10 w-3"></i>Archive <b></b></a>
                                            <div class="btn-toolbar ml-7 " role="toolbar"></div>
                                            {{-- <div class="btn-toolbar ml-7 " role="toolbar">
                                                <div class="btn-group ml-5">
                                                    <button type="button"
                                                        class="btn btn-primary waves-effect waves-light ml-1 "><i
                                                            class="fa fa-inbox"></i></button>
                                                    <button type="button"
                                                        class="btn btn-primary waves-effect waves-light ml-1"><i
                                                            class="fa fa-exclamation-circle"></i></button>
                                                    <button type="button"
                                                        class="btn btn-primary waves-effect waves-light ml-1"><i
                                                            class="fa fa-trash"></i></button>
                                                </div>
                                                <div class="btn-group ml-2">
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
                                                    <button type="button"
                                                        class="btn btn-primary waves-effect waves-light  dropdown-toggle"
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
                                                    <button type="button"
                                                        class="btn btn-primary waves-effect waves-light  dropdown-toggle"
                                                        data-toggle="dropdown" aria-expanded="false">
                                                        More
                                                        <span class="caret"></span>
                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="javascript:void(0);">Dropdown link</a></li>
                                                    </ul>
                                                </div>
                                            </div> --}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-detail mail-right">
                            <div class="row">

                            </div> <!-- End row -->

                            <div class="row m-t-0 m-b-30 table-responsive">
                                <table id="datatable" class="table table-hover mails m-0">
                                    <thead class="hidden">
                                        <tr>
                                            <th>#</th>
                                            <th>Subject</th>
                                            <th>Mail</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($messages as $message)
                                            <tr>
                                                <td><input type="checkbox" id="{{ $message->id }}" name="gmail">
                                                </td>
                                                <td><a href="{{ route('gmail.detail.inbox', "$message->name") }}">{{ $message->email }}
                                                        {{-- @foreach ($message->Subject as $header)
                                                            @if ($header->name == 'Subject')
                                                                {{ $header->value }}
                                                            @endif
                                                        @endforeach --}}
                                                    </a></td>
                                                <td><a
                                                        href="{{ route('gmail.detail.inbox', "$message->name") }}">{{ $message->message }}</a>
                                                </td>
                                                <td><a
                                                        href="{{ route('gmail.detail.inbox', "$message->name") }}">{{ $message->created_at }}</a>
                                                </td>
                                                <td id="sign_{{ $message->name }}"><button class="btn btn-primary"
                                                        onclick="showGenerateModal('{{ $message->name }}')">Create
                                                        Lead</button></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{ $messages->links() }}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel"
            aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-full">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="full-width-modalLabel">Choose Recommended Lead(s)</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="leadname">Lead Name</label>
                                    <input type="text" name="leadname" id="leadname" parsley-trigger="change"
                                        placeholder="Enter lead name" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" name="firstname" id="firstname" parsley-trigger="change"
                                        placeholder="Enter first name" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
                                    <input type="text" name="lastname" id="lastname" parsley-trigger="change"
                                        placeholder="Enter last name" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" parsley-trigger="change"
                                        placeholder="Enter email" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="tel">Tel</label>
                                    <input type="text" name="tel" id="tel" parsley-trigger="change"
                                        placeholder="Enter telephone number" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile">Mobile</label>
                                    <input type="text" name="mobile" id="mobile" parsley-trigger="change"
                                        placeholder="Enter mobile number" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="postcode">PostCode</label>
                                    <input type="text" name="postcode" id="postcode" parsley-trigger="change"
                                        placeholder="Enter postcode" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="company">Company</label>
                                    <input type="text" name="company" id="company" parsley-trigger="change"
                                        placeholder="Enter company" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="signature">Signature</label>
                                    <input type="text" name="signature" id="signature" parsley-trigger="change"
                                        readonly class="form-control input-sm" value="">
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-md-12" id="mailContent">

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal"
                            onclick="createLead()">Create Lead</button>
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

    </div> <!-- container -->
@endsection

@section('pageJS')


    <!-- init -->
    <script>
        $(document).ready(function() {
            checkActivity();
        });

        const deleteGmail = () => {
            var data = {
                count: 0,
            }
            var cnt = 0;
            for (var i = 0; i < $('input[name="gmail"]').length; i++) {
                if ($('input[name="gmail"]')[i].checked) {
                    data[`messageId${cnt}`] = $('input[name="gmail"]')[i].id;
                    cnt++;
                }
            }
            data.count = cnt;
            var url = "{{ route('gmail.api.delete') }}";

            $.post(url, data, () => {
                location.reload();
            })
        }

        const archiveGmail = () => {
            var data = {
                count: 0,
            }
            var cnt = 0;
            for (var i = 0; i < $('input[name="gmail"]').length; i++) {
                if ($('input[name="gmail"]')[i].checked) {
                    data[`messageId${cnt}`] = $('input[name="gmail"]')[i].id;
                    cnt++;
                }
            }
            data.count = cnt;
            var url = "{{ route('gmail.api.archive') }}";

            $.post(url, data, (res) => {
                console.log(res);
                // location.reload();
            })
        }
        const showGenerateModal = (messageId) => {

            $("#email").val("");
            $("#mailContent").html("");
            $("#signature").val("");

            $("#leadname").val("");
            $("#firstname").val("");
            $("#lastname").val("");
            $("#company").val("");
            $("#tel").val("");
            $("#mobile").val("");
            $("#postcode").val("");

            var url = "{{ route('gmail.api.recommend') }}";
            $.post(url, {
                messageId: messageId
            }, (res) => {
                if (res == "gmail_not_connected")
                    return;

                $("#email").val(res.email);
                $("#mailContent").html(res.req);
                $("#signature").val(messageId);

                // $("#leadname").val("leadname");
                $("#firstname").val(res.firstname);
                $("#lastname").val(res.lastname);
                $("#company").val(res.company);
                $("#tel").val(res.telephone);
                $("#mobile").val(res.mobile);
                $("#postcode").val(res.postcode);
            });
            $("#full-width-modal").modal('show');
        }

        const checkActivity = () => {
            const url = "{{ route('leads.api.get') }}";
            $.post(url, (res) => {
                var signList = [];
                for (var i = 0; i < $("[name=gmail]").length; i++) {
                    const id = $("[name=gmail]")[i].id;
                    signList.push(id);
                }

                var lstFetch = [];

                for (var i = 0; i < res.length; i++) {
                    if (signList.indexOf(res[i].signature) != -1) {

                        $(`#sign_${res[i].signature}`).html(
                            `<button class="btn btn-orange">Completed</button>`);
                        lstFetch.push(res[i].signature);
                    }
                }

                for (var i = 0; i < lstFetch.length; i++) {
                    const idx = signList.indexOf(lstFetch[i]);
                    if (idx != -1) {
                        signList.splice(idx, 1);
                    }
                }

                $('#datatable').dataTable({
                    searching: false,
                });

                // fetchRecommendedLeads(signList);
            })
        }

        const createLead = () => {
            var url = "{{ route('leads.create') }}";

            var email = $("#email").val();
            var mailContent = $("#mailContent").html();
            var messageId = $("#signature").val();
            var leadname = $("#leadname").val();
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            var company = $("#company").val();
            var tel = $("#tel").val();
            var mobile = $("#mobile").val();
            var postcode = $("#postcode").val();

            var data = {
                email: email,
                mailContent: mailContent,
                messageId: messageId,
                leadname: leadname,
                firstname: firstname,
                lastname: lastname,
                company: company,
                tel: tel,
                mobile: mobile,
                postcode: postcode,
            }

            $.post(url, data, (res) => {
                toastr.options.closeButton = true;
                toastr.success("Lead created successfully");
                $(`#sign_${messageId}`).html(`<button class="btn btn-orange">Completed</button>`);
            })
        }

        const fetchRecommendedLeads = (lst) => {
            var url = "{{ route('gmail.api.recommend') }}";
            $.post(url, {
                listMsgId: lst
            }, (res) => {
                if (res == "gmail_not_connected")
                    return;
            });
        }
    </script>

@endsection
