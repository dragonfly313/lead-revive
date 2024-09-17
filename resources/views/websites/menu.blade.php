<x-account-layout>
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <!-- Title -->
            <h5 class="h3 mb-2">
                {{ __('Menu Manage') }}
            </h5>
        </div>
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col-3">Text</div>
                <div class="col-5">Link</div>
                <div class="col-4">Actions</div>
            </div>
            <div class="row align-items-center mb-3">
                <div class="col-3">
                    <input id="text" class="form-control" placeholder="Input menu text" />
                </div>
                <div class="col-5">
                    <select id="link" class="form-control">
                        <option value="" disabled selected>Select menu link</option>
                        <option value="#home">#home</option>
                        <option value="#aboutUs">#aboutUs</option>
                        <option value="#contactUs">#contactUs</option>
                        <option value="#reviews">#reviews</option>
                        <option value="#pricing">#pricing</option>
                    </select>
                </div>
                <div class="col-4">
                    <i class="fa fa-paper-plane text-primary fa-lg cursor-pointer" onclick="submit()"></i>
                </div>
            </div>
            @foreach ($menu as $item)
            <div class="row mb-3 align-items-center">
                <div class="col-3">{{ $item->text }}</div>
                <div class="col-5">{{ $item->link }}</div>
                <div class="col-4">
                    <i id="edit-{{ $item->id }}" class="fa fa-edit fa-lg cursor-pointer text-warning mr-2" onclick='edit(<?php echo $item; ?>)'></i>
                    <i class="fa fa-trash-alt fa-lg text-danger cursor-pointer" onclick='remove(<?php echo $item->id; ?>)'></i>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @push('scripts')
    <script type="text/javascript">
        let id = 0

        const edit = (item) => {
            if (id === item.id) {
                id = 0
                $('#text').val('')
                $('#link').val('')
                $('#edit-' + item.id).removeClass("fa-cog fa-spin")
                $('#edit-' + item.id).addClass("fa-edit")
            } else {
                if (id) {
                    $('#edit-' + id).removeClass("fa-cog fa-spin")
                    $('#edit-' + id).addClass("fa-edit")
                }
                id = item.id
                $('#text').val(item.text)
                $('#link').val(item.link)

                $('#edit-' + id).removeClass("fa-edit")
                $('#edit-' + id).addClass("fa-cog fa-spin")
            }
        }

        const submit = () => {
            let text = $('#text').val(),
                link = $('#link').val()

            if (!text) {
                toastr.warning('Text field is required.')
            } else if (!link) {
                toastr.warning('Link field is required.')
            } else {
                if (id) {
                    $.ajax({
                        url: '/account/websites/menu/' + id,
                        method: 'PUT',
                        data: {
                            data: {
                                text,
                                link
                            }
                        }
                    }).then(res => {
                        if (res.result === 'success') {
                            window.location.reload()
                        }
                    })
                } else {
                    $.post('/account/websites/menu/add', {
                        data: {
                            text,
                            link
                        }
                    }).then(res => {
                        if (res.result === 'success') {
                            window.location.reload()
                        }
                    })
                }
            }
        }

        const remove = (id) => {
            $.ajax({
                url: '/account/websites/menu/' + id,
                method: 'DELETE'
            }).then(res => {
                if (res.result === 'success') {
                    window.location.reload()
                }
            })
        }
    </script>
    @endpush
</x-account-layout>