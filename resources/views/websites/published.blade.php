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
                {{ __('My Work') }}
            </h5>
        </div>
        <div class="card-body">
            <div class="table-detail mail-right">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box m-t-20">
                            @if ($messages->isEmpty())
                                <h4 class="text-center">{{ __('You have not any Emails in your Draft.') }}</h4>
                            @else
                                <div class="table table-detail mail-right">
                                    <div class="row">
                                        <div class="row m-t-0 ml-2 m-b-30 mr-2 table-responsive">
                                            <div class="col-md-12 justify-center" id="mailContent">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- init -->
    <script>
        $(document).ready(function() {
            @foreach ($messages as $message)
            
                var data = {
                    id: {{ $message->Id }}
                }

                var url = "{{ route('websites.compose') }}";
                $.post(url, data, (res) => {
                    //console.log(res)
                    $("#mailContent").html(res.content);
                    //  $("#full-width-modal").modal('show');
                    // }
                    // $('.summernote').summernote('code', res.content);
                })
            @endforeach
        });
    </script>

</x-account-layout>
