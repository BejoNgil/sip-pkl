@component('components.modal', ['id'=> 'pesertaInfo'])
    @slot('title')
        Detail Peserta
    @endslot
    @slot('content')
        <div class="modal-body">
            <div id="loading">
                <div class="loader"></div>
            </div>
            <div id="contentContainer"></div>
        </div>
    @endslot
@endcomponent

@push('scripts')
    <script>
        $('#pesertaInfo').on('show.bs.modal', function (e) {
            const container = $('#contentContainer');
            const loading = $('#loading');
            container.hide();
            container.children().empty();
            loading.show();

            const id = $(e.relatedTarget).data('id');
            let theUrl = "{{ route('resource.peserta.show', ':id') }}";
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
