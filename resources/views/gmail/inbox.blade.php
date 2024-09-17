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
            <h2>
                {{ __('My Inbox') }}
            </h2>
            <div class="d-flex justify-content-between">
                <div class="list-group mail-list">
                    <div class="d-flex">
                        <a href="{{ route('gmail.compose') }}"
                            class="btn btn-primary btn-rounded waves-effect waves-light col-xs-3"
                            style="align-items: center;display: flex;padding: 0.5rem 1.25rem;height: 50px;">Compose</a>
                        <a href="{{ route('gmail.inbox', 1) }}" class="list-group-item text-success  col-xs-3"
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
                                    onclick="delGmail()" title="Delete checked rows"
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
                <div class="d-flex align-items-center">
                    <span class="px-3 py-2 mr-2">
                        {{ ($page - 1) * 10 + 1 }}-{{ $page * 10}} of {{ $count }}
                    </span>

                    @if ($page <= 1)
                        <span class="navigation-btn disabled mr-2">
                            <i class="fa fa-angle-left"></i>
                        </span>
                    @else
                        <a href="{{ route('gmail.inbox', $page - 1) }}" class="navigation-btn mr-2">
                            <i class="fa fa-angle-left"></i>
                        </a>
                    @endif

                    @if ($page * 10 >= $count)
                        <span class="navigation-btn disabled">
                            <i class="fa fa-angle-right"></i>
                        </span>
                    @else
                        <a href="{{ route('gmail.inbox', $page + 1) }}" class="navigation-btn">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($count === 0)
                <h4 class="text-center">{{ __('You have not any Emails.') }}</h4>
            @else
                <div class="table table-detail mail-right">
                    <div class="row">
                        <div class="row m-t-0 ml-2 m-b-30 mr-2 table-responsive">
                            <table id="datatable" class="table-hover mails P-2 table-responsive">
                                <thead class="thead-light">
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
                                            <td id="sign_{{ $message->id }}"><button class="btn btn-primary"
                                                    onclick="showGenerateModal('{{ $message->id }}')">Create
                                                    Lead</button></td>
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
        <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-full">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="full-width-modalLabel">Create Lead</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" id="email" parsley-trigger="change"
                                        placeholder="Enter email" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="mobile_phone">Mobile Phone</label>
                                    <input type="text" name="mobile_phone" id="mobile_phone" parsley-trigger="change"
                                        placeholder="Enter phone number" class="form-control input-sm">
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
                                    <label for="area_of_interest">Area of Interest</label>
                                    <input type="text" name="area_of_interest" id="area_of_interest"
                                        parsley-trigger="change" placeholder="Enter area of interest"
                                        class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal"
                                onclick="createLead()">Create Lead</button>
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 justify-center" id="mailContent">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div id="full-width-modal" class="modal fade" tabindex="-1" role="dialog"
            aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-full">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="full-width-modalLabel">Choose Recommended Lead(s)</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> × </button>
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
                                    <input type="text" name="signature" id="signature" parsley-trigger="change" readonly
                                        class="form-control input-sm" value="">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary waves-effect" data-dismiss="modal"
                                onclick="createLead()">Create Lead</button>
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 justify-center" id="mailContent">
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
</x-account-layout>