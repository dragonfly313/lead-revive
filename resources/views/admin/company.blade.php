@extends('layouts.admin')
@section('title', __('messages.title_company'))

@section('content')
    <!-- Dashboard content goes here -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Company Settings </h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="#">GROGU</a>
                        </li>
                        <li>
                            <a href="#">Settings</a>
                        </li>
                        <li class="active">
                            Company Settings
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                @foreach ($companies as $company)
                    <div class="property-card property-horizontal">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="property-image"
                                    style="background: url('{{asset('images/company.png')}}') center center  no-repeat;">
                                    <span class="property-label label label-success">Company</span>
                                </div>
                            </div>
                            <!-- /col 4 -->
                            <div class="col-sm-8">
                                <div class="property-content">
                                    <div class="listingInfo">
                                        <div class="">
                                            <h3><a href="#" class="text-dark">{{ $company->company_name }}</a></h3>
                                            <p class="text-muted">
                                                <i class="mdi mdi-map-marker-radius m-r-5"></i>
                                                <b>Billing:</b>&nbsp;&nbsp;{{ $company->bill_street }}. {{ $company->bill_town }}.
                                                {{ $company->bill_postcode }}
                                                <br>
                                                <i class="mdi mdi-map-marker-radius m-r-5"></i>
                                                <b>Shipping:</b>&nbsp;&nbsp;{{ $company->ship_street }}. {{ $company->ship_town }}.
                                                {{ $company->ship_postcode }}
                                                <br>
                                                <i class="mdi mdi-phone"></i>
                                                {{ $company->phone1 }}
                                                <i class="mdi mdi-phone"></i>
                                                {{ $company->phone2 }}
                                                <br>
                                                <i class=" mdi mdi-numeric-1-box"></i>
                                                {{ $company->abn }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="property-action">
                                        <a data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Total 0 user(s)"><i
                                                class=" mdi mdi-account-multiple"></i><span>0</span></a>
                                        <a data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Added 0 user(s)"><i
                                                class="  mdi mdi-account-plus"></i><span>0</span></a>
                                        <a data-toggle="tooltip" data-placement="top" title=""
                                            data-original-title="Removed 0 user(s)"><i
                                                class=" mdi mdi-account-minus"></i><span>0</span></a>
    
                                        <div class="pull-right">
                                            <button class="btn btn-default" onclick="setEditCompany({{$company->id}})"><i
                                                    class="fa fa-cog"></i><span> Settings</span></button>
                                        </div>
                                    </div>
                                    <!-- end. Card actions -->
                                </div>
                            </div>
                            <!-- /col 8 -->
                        </div>
                        <!-- /inner row -->
                    </div>
                @endforeach
                <!-- End property item -->
            </div>
            <!--END MAIN COL-8 -->

            <div class="col-md-4">
                <div class="p-20 p-t-0">
                    <div class="">
                        <h4 class="text-uppercase">Register Company</h4>
                        <div class="border m-b-20"></div>

                        <form action="{{ route('registerCompanyAction') }}" method="POST" id="createForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            <input type="hidden" name="company_id" id="company_id" value="0" />
                            <div class="form-group">
                                <input type="text" name="company_name" id="company_name" class="form-control"
                                    placeholder="Company Name">
                            </div>

                            <div class="form-group">
                                <input type="text" name="bill_street" id="bill_street" class="form-control"
                                    placeholder="Address - Street - Billing">
                            </div>

                            <div class="form-group">
                                <input type="text" name="bill_town" id="bill_town" class="form-control"
                                    placeholder="Address - Town - Billing">
                            </div>

                            <div class="form-group">
                                <input type="text" name="bill_postcode" id="bill_postcode" class="form-control"
                                    placeholder="Address - Postcode - Billing">
                            </div>

                            <div class="form-group">
                                <input type="text" name="phone1" id="phone1" class="form-control"
                                    placeholder="Phone 1">
                            </div>
                            <div class="form-group">
                                <input type="text" name="phone2" id="phone2" class="form-control"
                                    placeholder="Phone 2">
                            </div>
                            <div class="form-group">
                                <input type="text" name="abn" id="abn" class="form-control"
                                    placeholder="ABN">
                            </div>
                            <div class="form-group">
                                <input type="text" name="ship_street" id="ship_street" class="form-control"
                                    placeholder="Address - Street - Shipping">
                            </div>
                            <div class="form-group">
                                <input type="text" name="ship_town" id="ship_town" class="form-control"
                                    placeholder="Address - Town - Shipping">
                            </div>
                            <div class="form-group">
                                <input type="text" name="ship_postcode" id="ship_postcode" class="form-control"
                                    placeholder="Address - Postcode - Shipping">
                            </div>

                            <button type="submit" id="btn-register" class="btn btn-purple waves-effect waves-light"><i
                                    class="mdi mdi-magnify m-r-5"></i>Register</button>
                            <button type="submit" id="btn-update" class="btn btn-primary waves-effect waves-light hidden"><i
                                class="mdi mdi-check m-r-5"></i>Update</button>
                            <button type="button" id="btn-cancel" class="btn btn-warning waves-effect waves-light hidden"><i
                                class="mdi mdi-close m-r-5"></i>Cancel</button>
                            <a href="" id="btn-delete" class="btn btn-danger waves-effect waves-light hidden"><i
                                class="mdi mdi-delete m-r-5"></i>Delete</a>
                        </form>
                    </div> <!-- end search-->
                </div> <!-- end p-20 -->
            </div>
        </div>
        <input type="hidden" id="getCompany" value="{{route('getCompanyAction')}}">
        <input type="hidden" id="createURL" value="{{route('registerCompanyAction')}}">
        <input type="hidden" id="updateURL" value="{{route('updateCompanyAction')}}">
        <!-- end row -->
    </div> <!-- container -->
@endsection
@section('pageJS')
<script>
    const setEditCompany = (id) => {
        var url = $("#getCompany").val();
        $.post(url, {id: id}, (res) => {
            if(res.length > 0) {
                $("#company_name").val(res[0].company_name);
                $("#bill_street").val(res[0].bill_street);
                $("#bill_town").val(res[0].bill_town);
                $("#bill_postcode").val(res[0].bill_postcode);
                $("#ship_street").val(res[0].ship_street);
                $("#ship_town").val(res[0].ship_town);
                $("#ship_postcode").val(res[0].ship_postcode);
                $("#phone1").val(res[0].phone1);
                $("#phone2").val(res[0].phone2);
                $("#abn").val(res[0].abn);
                $("#company_id").val(res[0].id);
                $("#createForm").attr('action', $("#updateURL").val());
                $("#btn-delete").attr('href', 'delete/' + res[0].id);

                $("#btn-register").addClass("hidden");
                $("#btn-delete").removeClass("hidden");
                $("#btn-update").removeClass("hidden");
                $("#btn-cancel").removeClass("hidden");
            }
        });
    }

    $("#btn-cancel").click(() => {
        $("#company_name").val("");
        $("#bill_street").val("");
        $("#bill_town").val("");
        $("#bill_postcode").val("");
        $("#ship_street").val("");
        $("#ship_town").val("");
        $("#ship_postcode").val("");
        $("#phone1").val("");
        $("#phone2").val("");
        $("#abn").val("");

        $("#createForm").attr('action', $("#createURL").val());
        $("#btn-register").removeClass("hidden");
        $("#btn-update").addClass("hidden");
        $("#btn-cancel").addClass("hidden");
        $("#btn-delete").addClass("hidden");
    })
</script>
@endsection
