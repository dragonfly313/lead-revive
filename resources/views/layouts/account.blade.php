<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{ $seo->keywords }}">
    <meta name="description" content="{{ $seo->description }}">
    <!-- Title -->
    <title>{{ $seo->title }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('saas/img/favicon.png') }}">
    {{--
    <link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css"> --}}
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600&amp;display=swap" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('css/core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/components.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" type="text/css" />
    <!-- CSS font-awesome Plugins -->
    <link rel="stylesheet" href="{{ asset('saas/admin/vendor/font-awesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('saas/vendor/select2/dist/css/select2.min.css') }}">

    <!-- CSS Front Template -->
    <link rel="stylesheet" href="{{ asset('assets/css/argon.mine209.css?v=1.0.0') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}" type="text/css">
    <link href="{{ asset('plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/dataTables.colVis.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/datatables/fixedColumns.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('plugins/summernote/summernote.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('saas/css/toastr.min.css') }}">
    <link href="{{ asset('saas/home/css/style.css') }}" rel="stylesheet">
    @livewireStyles
    @stack('styles')
</head>

<body>
    <!-- Sidenav -->
    @include('partials.read-only')
    @include('partials.account.login_as')
    @include('partials.account.sidebar')
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        @include('partials.account.topnav')
        <div class="pb-1 header">
            <div class="container-fluid">
                <div class="header-body">
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt-0" style="padding-top: 6px;border=1">
            {{ $slot }}
        </div>

    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <x-livewire-alert::scripts />
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/lavalamp/js/jquery.lavalamp.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('plugins/toastr/toastr.min.js') }}"></script>
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
    <script>
        var msg = "{{ Session::get('alert') }}";
        var exist = "{{ Session::has('alert') }}";
        if (exist) {
            alert(msg);
        }

        let lead_source;
        let scan_algorithm;
        let leadPageIndex = 0;
        let leads = [];
        let leadIndex = -1;
        let messageId;
        // let selectedLeads = [];

        const delGmail = () => {
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

        const showGenerateModal = (id) => {
            messageId = id

            $("#firstname").val("");
            $("#lastname").val("");
            $("#email").val("");
            $("#mobile_phone").val("");
            $("#company").val("");
            $("#area_of_interest").val("");
            $("#mailContent").html("");

            var url = "{{ route('gmail.api.recommend') }}";
            $.post(url, {
                messageId: messageId
            }, (res) => {

                if (res == "gmail_not_connected")
                    return;

                $("#firstname").val(res.firstname);
                $("#lastname").val(res.lastname);
                $("#email").val(res.email);
                $("#mobile_phone").val(res.mobile_phone);
                $("#company").val(res.company);
                $("#area_of_interest").val(res.area_of_interest);
                $("#mailContent").html(res.req);
            });
            $("#full-width-modal").modal('show');
        }

        const getLeads = () => {
            lead_source = $('#lead_source').val()
            scan_algorithm = $('#scan_algorithm').val()

            if (!lead_source || !scan_algorithm) {
                toastr.options.closeButton = true;
                toastr.warning('Please choose lead source and scan algorithm.');
            } else {
                const leadsBoxDom = document.getElementById('leads-box')
                const btnDom = document.getElementById('scan-btn')
                btnDom.disabled = true
                btnDom.innerHTML += "<i class='fa fa-spinner fa-spin ml-2'></i>"

                var url = `/account/leads/gmail/getLeads/${++leadPageIndex}`;
                $.get(url, (res) => {
                    console.log(res)
                    btnDom.disabled = false
                    btnDom.innerHTML = "Scan 10 leads"

                    if (res.status == "error") {
                        toastr.options.closeButton = true;
                        toastr.warning(res.msg);
                        return;
                    }

                    res.leads.forEach((lead, index) => {
                        leads.push({
                            firstname: lead.firstname ?? '',
                            lastname: lead.lastname ?? '',
                            email: lead.email ?? '',
                            mobile_phone: lead.mobile_phone ?? '',
                            company: lead.company ?? '',
                            area_of_interest: lead.area_of_interest ?? '',
                            mailContent: lead.req ?? '',
                        })
                        leadsBoxDom.innerHTML += `
                            <tr id='lost-lead-${(leadPageIndex - 1) * 10 + index}'>
                                <td>${lead.firstname ?? ''}</td>
                                <td>${lead.lastname ?? ''}</td>
                                <td>${lead.email ?? ''}</td>
                                <td>${lead.mobile_phone ?? ''}</td>
                                <td>${lead.company ?? ''}</td>
                                <td>${lead.area_of_interest ?? ''}</td>
                                <td style="width: 30px;">
                                    <i class='fa fa-edit text-warning cursor-pointer action-icon' onclick='viewLead(${(leadPageIndex - 1) * 10 + index})'></i>
                                </td>
                            </tr>
                        `
                    });
                });
            }
        }

        // const toggleLead = (index) => {
        //     let position = selectedLeads.indexOf(index)

        //     if (position < 0) {
        //         selectedLeads.push(index)
        //     } else {
        //         selectedLeads.splice(position, 1)
        //     }
        // }

        const viewLead = (index) => {
            leadIndex = index
            $("#firstname").val(leads[index].firstname ?? '');
            $("#lastname").val(leads[index].lastname ?? '');
            $("#email").val(leads[index].email ?? '');
            $("#mobile_phone").val(leads[index].mobile_phone ?? '');
            $("#company").val(leads[index].company ?? '');
            $("#area_of_interest").val(leads[index].area_of_interest ?? '');
            $("#mailContent").html(leads[index].mailContent ?? '');

            $("#full-width-modal").modal('show');
        }

        // const tr_click = (e, index) => {
        //     if (e.target.classList.contains('check')) {
        //         toggleLead(index)
        //     } else if (e.target.classList.contains('fa-edit')) {
        //         viewEmail(index)
        //     } else {
        //         $(`#lost-lead-check-${index}`).click()
        //     }
        // }

        const createLead = () => {
            let data = {
                firstname: $("#firstname").val(),
                lastname: $("#lastname").val(),
                email: $("#email").val(),
                mobile_phone: $("#mobile_phone").val(),
                company: $("#company").val(),
                area_of_interest: $("#area_of_interest").val(),
            }

            // leads[leadIndex] = {
            //     ...leads[leadIndex],
            //     ...data
            // }

            let url = "{{ route('leads.create') }}";

            $.post(url, data, (res) => {
                if (leadIndex == -1) {
                    $(`#sign_${messageId}`).html(`<button class="btn btn-orange">Completed</button>`);
                } else {
                    $(`#lost-lead-${leadIndex}`).html(`
                        <td>${data.firstname}</td>
                        <td>${data.lastname}</td>
                        <td>${data.email}</td>
                        <td>${data.mobile_phone}</td>
                        <td>${data.company}</td>
                        <td>${data.area_of_interest}</td>
                        <td style="width: 30px;">
                            <i class='fa fa-check text-success'></i>
                        </td>
                    `)
                }

                toastr.options.closeButton = true;
                toastr.success("Lead created successfully");
            })
        }

        // const saveLeads = () => {
        //     let temp = []

        //     selectedLeads.forEach(selectedLeadIndex => {
        //         temp.push(leads[selectedLeadIndex])
        //     });

        //     console.log(temp)
        // }

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

        // const createLead = () => {
        //     var url = "{{ route('leads.create') }}";
        //     var email = $("#email").val();
        //     var mailContent = $("#mailContent").html();
        //     var messageId = $("#signature").val();
        //     var leadname = $("#leadname").val();
        //     var firstname = $("#firstname").val();
        //     var lastname = $("#lastname").val();
        //     var company = $("#company").val();
        //     var tel = $("#tel").val();
        //     var mobile = $("#mobile").val();
        //     var postcode = $("#postcode").val();

        //     var data = {
        //         email: email,
        //         mailContent: mailContent,
        //         messageId: messageId,
        //         leadname: leadname,
        //         firstname: firstname,
        //         lastname: lastname,
        //         company: company,
        //         tel: tel,
        //         mobile: mobile,
        //         postcode: postcode,
        //     }

        //     $.post(url, data, (res) => {
        //         toastr.options.closeButton = true;
        //         toastr.success("Lead created successfully");
        //         $(`#sign_${messageId}`).html(`<button class="btn btn-orange">Completed</button>`);
        //     })
        // }

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
    <!-- Optional JS -->
    <!-- Argon JS -->
    <script src="{{ asset('assets/js/argon.mine209.js?v=1.0.0') }}"></script>
    @stack('scripts')
    <!--Start of Tawk.to Script-->
    {{-- @if (config('saas.demo_mode'))
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function () {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/5fbb1a42a1d54c18d8ec4a68/default';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    @endif --}}
    <!--End of Tawk.to Script-->
</body>

</html>