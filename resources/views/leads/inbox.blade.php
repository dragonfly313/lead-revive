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
                {{ __('Leads Inbox') }}
            </h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card-box widget-box-one">
                        <i class="mdi mdi-phone widget-one-icon"></i>
                        <div class="wigdet-one-content">
                            <h3>Telephone <small><i class="mdi mdi-arrow-up text-success"></i></small></h3>
                            <p class="text-muted m-0"><b>New:</b> 25</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card-box widget-box-one">
                        <i class="mdi mdi-gmail widget-one-icon"></i>
                        <div class="wigdet-one-content">
                            <h3>Gmail <small><i class="mdi mdi-arrow-up text-danger"></i></small></h3>
                            <p class="text-muted m-0"><b>New:</b> 25</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card-box widget-box-one">
                        <i class="mdi mdi-message-text widget-one-icon"></i>
                        <div class="wigdet-one-content">
                            <h3>Chatbot <small><i class="mdi mdi-arrow-up text-success"></i></small></h3>
                            <p class="text-muted m-0"><b>New:</b> 25</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card-box widget-box-one">
                        <i class="mdi mdi-facebook widget-one-icon"></i>
                        <div class="wigdet-one-content">
                            <h3>FBM <small><i class="mdi mdi-arrow-up text-danger"></i></small></h3>
                            <p class="text-muted m-0"><b>New:</b> 25</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card-box widget-box-one">
                        <i class="mdi mdi-web widget-one-icon"></i>
                        <div class="wigdet-one-content">
                            <h3>Webform <small><i class="mdi mdi-arrow-up text-danger"></i></small></h3>
                            <p class="text-muted m-0"><b>New:</b> 25</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card-box widget-box-one">
                        <i class="mdi mdi-wechat widget-one-icon"></i>
                        <div class="wigdet-one-content">
                            <h3>Campaign <small><i class="mdi mdi-arrow-up text-success"></i></small></h3>
                            <p class="text-muted m-0"><b>New:</b> 25</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card-box widget-box-one">
                        <i class="mdi mdi-wechat widget-one-icon"></i>
                        <div class="wigdet-one-content">
                            <h3>Whatsapp <small><i class="mdi mdi-arrow-up text-success"></i></small></h3>
                            <p class="text-muted m-0"><b>New:</b> 25</p>
                        </div>
                    </div>
                </div><!-- end col -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="card-box widget-box-one">
                        <i class="mdi mdi-wechat widget-one-icon"></i>
                        <div class="wigdet-one-content">
                            <h3>SMS <small><i class="mdi mdi-arrow-up text-success"></i></small></h3>
                            <p class="text-muted m-0"><b>New:</b> 25</p>
                        </div>
                    </div>
                </div><!-- end col -->
            </div>
            <div class="row">
                <div class="col-md-2">
                    <div>
                        {{-- <div class="btn-group inline">
                            <button type="button" class="btn btn-default waves-effect"><i
                                    class="fa fa-envelope"></i></button>
                            <button type="button" class="btn btn-default waves-effect"><i
                                    class="fa fa-archive"></i></button>
                        </div> --}}
                        <span class="inline">
                            <a href="{{ route('leads.csv.print') }}">
                            <button type="button" class="btn btn-success btn-sm">CSV Print</button>
                            </a>
                        </span>
                    </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-4">

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <!-- <th>Title</th> -->
                                <th>No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Mobile Phone</th>
                                <th>Company</th>
                                <!-- <th>Postcode</th>
                                <th>Sales Person</th> -->
                                <th>Area of Interest</th>
                                <th>Lead Source</th>
                                <th>Date</th>
                                <!-- <th><i class="fa fa-cog"></i></th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leads as $index => $lead)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $lead->firstname }}</td>
                                    <td>{{ $lead->lastname }}</td>
                                    <td>{{ $lead->email }}</td>
                                    <td>{{ $lead->mobile_phone }}</td>
                                    <td>{{ $lead->company }}</td>
                                    <td>{{ $lead->area_of_interest }}</td>
                                    <td>{{ $lead->lead_source }}</td>
                                    <td>{{ $lead->created_at }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end row -->

        </div>

        {{-- @section('pageJS') --}}
        <!-- init -->

        {{-- @endsection --}}
    </div>
</x-account-layout>
