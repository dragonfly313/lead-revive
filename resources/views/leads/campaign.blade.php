@extends('layouts.admin')
@section('title', __('messages.title_campaign'))

@section('content')
    <!-- Dashboard content goes here -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="page-title-box">
                    <h4 class="page-title">Leads Campaign</h4>
                    <ol class="breadcrumb p-0 m-0">
                        <li>
                            <a href="#">GROGU</a>
                        </li>
                        <li>
                            <a href="#">Leads</a>
                        </li>
                        <li class="active">
                            Campaign
                        </li>
                    </ol>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-2">
                <div>
                    <div class="btn-group inline">
                        <button type="button" class="btn btn-default waves-effect"><i class="fa fa-envelope"></i></button>
                        <button type="button" class="btn btn-default waves-effect"><i class="fa fa-archive"></i></button>
                    </div>
                    <span class="inline">
                        {{-- <button type="button" class="btn btn-success btn-sm">+ Lead</button> --}}
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
                            <th>Title</th>
                            <th>Next Activity</th>
                            <th>Levels</th>
                            <th>Source</th>
                            <th>Lead created</th>
                            <th>Owner</th>
                            <th><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Greenapps lead</td>
                            <td><span class="label label-warning">No activity</span></td>
                            <td></td>
                            <td>Campaign</td>
                            <td>Dec 5,2023,7:06PM</td>
                            <td>Mike</td>
                            <td><span class="label label-success">...</span></td>
                        </tr>
                        <tr>
                            <td>Greenapps lead</td>
                            <td><span class="label label-warning">No activity</span></td>
                            <td></td>
                            <td>Campaign</td>
                            <td>Dec 5,2023,7:06PM</td>
                            <td>Mike</td>
                            <td><span class="label label-success">...</span></td>
                        </tr>
                        <tr>
                            <td>Greenapps lead</td>
                            <td><span class="label label-warning">No activity</span></td>
                            <td></td>
                            <td>Campaign</td>
                            <td>Dec 5,2023,7:06PM</td>
                            <td>Mike</td>
                            <td><span class="label label-success">...</span></td>
                        </tr>
                        <tr>
                            <td>Greenapps lead</td>
                            <td><span class="label label-warning">No activity</span></td>
                            <td></td>
                            <td>Campaign</td>
                            <td>Dec 5,2023,7:06PM</td>
                            <td>Mike</td>
                            <td><span class="label label-success">...</span></td>
                        </tr>
                        <tr>
                            <td>Greenapps lead</td>
                            <td><span class="label label-warning">No activity</span></td>
                            <td></td>
                            <td>Campaign</td>
                            <td>Dec 5,2023,7:06PM</td>
                            <td>Mike</td>
                            <td><span class="label label-success">...</span></td>
                        </tr>
                        <tr>
                            <td>Greenapps lead</td>
                            <td><span class="label label-warning">No activity</span></td>
                            <td></td>
                            <td>Campaign</td>
                            <td>Dec 5,2023,7:06PM</td>
                            <td>Mike</td>
                            <td><span class="label label-success">...</span></td>
                        </tr>
                        <tr>
                            <td>Greenapps lead</td>
                            <td><span class="label label-warning">No activity</span></td>
                            <td></td>
                            <td>Campaign</td>
                            <td>Dec 5,2023,7:06PM</td>
                            <td>Mike</td>
                            <td><span class="label label-success">...</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container -->
@endsection

@section('pageJS')
    <!-- init -->
    <script>
        $(document).ready(function() {
            $('#datatable').dataTable({
                searching: false,
                paging: false
            });
        });
    </script>
@endsection
