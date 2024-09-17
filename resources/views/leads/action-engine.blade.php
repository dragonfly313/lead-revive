<x-account-layout>
    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex">
                <div class="mr-4">
                    <label for="lead_source">Lead Source</label>
                    <select class="form-control form-control-sm" id="lead_source" name="email-type">
                        <option value="" disabled selected>* Select lead source</option>
                        <option value="gmail">Gmail</option>
                        <option value="outlook">Outlook</option>
                        <option value="own-mail">Own Mail</option>
                        <option value="apple-mail">Apple Mail</option>
                    </select>
                </div>
                <div>
                    <label for="scan_algorithm">Scan Algorithm</label>
                    <select class="form-control form-control-sm" id="scan_algorithm" name="scan-algorithm">
                        <option value="" disabled selected>* Select algorithm</option>
                        <option value="default">Default</option>
                        <option value="custom">Custom</option>
                    </select>
                </div>
            </div>
        </div>
        <h4>Lost Leads</h4>
        <div class="row mb-4">
            <div class="col-sm-12">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Mobile Phone</th>
                            <th>Company</th>
                            <th>Area of Interest</th>
                            <th style="width: 30px;">
                                <i class="fa fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody id="leads-box">
                    </tbody>
                </table>
            </div>
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
        <div class="d-flex justify-content-center">
            <button id="scan-btn" class="btn btn-primary" onclick="getLeads()">Scan 10 leads</button>
        </div>
    </div>
</x-account-layout>