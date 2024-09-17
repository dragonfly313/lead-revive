<x-account-layout>
    <div class="card">
        <!-- Card header -->
        <div class="card-header">
            <!-- Title -->
            <h5 class="h3 mb-2">
                {{ __('SEO Manage') }}
            </h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label style="font-size: 15px;">Page select</label>
                <select class="form-control" onchange="selectPage(event)">
                    <option value="" selected disabled></option>
                    @foreach ($seo as $page)
                    <option value='{{ $page->page }}'>{{ $page->page }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label style="font-size: 15px;">Page title</label>
                <input id="title" class="form-control" />
            </div>
            <div class="form-group">
                <label style="font-size: 15px;">Page description</label>
                <input id="description" class="form-control" />
            </div>
            <div class="form-group">
                <label style="font-size: 15px;">Page keywords(Enter keywords separated by spaces ' ')</label>
                <input id="keywords" class="form-control" />
            </div>
            <button class="btn btn-primary" onclick="save()">Save</button>
        </div>
    </div>
    @push('scripts')
    <script type="text/javascript">
        let defaultSeo = <?php echo json_encode($seo); ?>;
        let page = '';

        const selectPage = (e) => {
            page = e.target.value

            let pageData = defaultSeo.find(obj => obj.page === page)

            $('#title').val(pageData.title)
            $('#description').val(pageData.description)
            $('#keywords').val(pageData.keywords)
        }

        const save = () => {
            if (page === '') {
                toastr.warning('Please select page')
                return
            }

            let title = $('#title').val(),
                description = $('#description').val(),
                keywords = $('#keywords').val()

            let index = defaultSeo.findIndex(obj => obj.page === page)

            defaultSeo[index] = {
                page,
                title,
                description,
                keywords
            }

            $.ajax({
                url: '/account/websites/seo/update',
                method: 'PUT',
                data: {
                    page,
                    seo: {
                        title,
                        description,
                        keywords
                    }
                }
            }).then(res => {
                if (res.result === 'success') {
                    toastr.success('Save success')
                }
            })
        }
    </script>
    @endpush
</x-account-layout>
