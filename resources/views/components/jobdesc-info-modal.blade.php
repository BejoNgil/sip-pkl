@component('components.modal', ['id'=> 'jobdescInfo'])
    @slot('title')
        Detail Job Desc
    @endslot
    @slot('content')
        <div class="modal-body">
            <div id="loadingJobdesc">
                <div class="loader"></div>
            </div>
            <div id="contentJobdesc"></div>
        </div>
    @endslot
@endcomponent

@push('scripts')
    <script>
        $('#jobdescInfo').on('show.bs.modal', function (e) {
            const container = $('#contentJobdesc');
            const loading = $('#loadingJobdesc');
            container.hide();
            container.children().empty();
            loading.show();

            const id = $(e.relatedTarget).data('id');
            let theUrl = "{{ route('resource.jobdesc.show', ':id') }}";
            theUrl = theUrl.replace(":id", id);

            $.ajax({
                dataType: 'html',
                url: theUrl,
                success: function (data) {
                    loading.hide();
                    container.show();
                    container.append(data);
                },
                error: function (error) {
                    loading.hide();
                    container.show();
                    console.log(error);
                }
            })
        });
    </script>
@endpush
