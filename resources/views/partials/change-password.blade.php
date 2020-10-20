@component('components.modal', ['id'=> 'changePassword'])
    @slot('title')
        Ganti Password
    @endslot
    @slot('content')
        <form action="{{ route('change.password') }}" method="POST">
            @csrf
            <div class="modal-body">
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" class="form-control" name="current_password" required>
                </div>
                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" class="form-control" name="password_baru">
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" class="form-control" name="konfirmasi_password">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    @endslot
@endcomponent
@if(session()->has('failedChangePassword'))
    @push('scripts')
        <script>
            $('#changePassword').modal('show');
        </script>
    @endpush
@endif
