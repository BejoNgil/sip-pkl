@extends('layouts.app')
@section('title', 'Daftar Peserta')
@section('page-header')
    List Peserta
@endsection
@section('main')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="row mb-2 clearfix">
                        <div class="col-md-12">
                            <a href="{{  route('peserta.create') }}" class="float-right btn btn-primary"><i
                                    class="fa fa-plus"></i> Tambah Peserta Baru</a>
                        </div>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover data-table">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NIS</th>
                                {{-- <th>Email</th> --}}
                                <th>Sekolah</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($peserta as $item)
                                <tr>
                                    <td>{{ $item['nama'] }}</td>
                                    <td>{{ $item['nis'] }}</td>
                                    {{-- <td>{{ $item['authenticable']['email'] }}</td> --}}
                                    <td>{{ $item['sekolah']['nama'] ?? '-' }}</td>
                                    <td width="15%">
                                        <a href="{{ route('peserta.edit', $item) }}" class="btn btn-success"><i
                                                class="fa fa-pencil"></i> Ubah</a>
                                        <a href="javascript:void(0);"
                                           onclick="destroy('{{ $item['id'] }}', '{{ $item['nama'] }}')"
                                           class="btn btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                           </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <!--End Advanced Tables -->
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        function destroy(id, name) {
            swal({
                title: "Apa anda yakin?",
                text: "Akan Menghapus Peserta " + name,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete => {
                if (willDelete) {
                    let theUrl = "{{ route('peserta.destroy', ':id') }}";
                    theUrl = theUrl.replace(":id", id);
                    $.ajax({
                        type: 'POST',
                        url: theUrl,
                        data: {_method: "delete"},
                        success: function (data) {
                            window.location.href = data;
                        },
                        error: function (data) {
                            console.log(data);
                            swal("Oops", "Terdapat kesalahan pada sistem", "error");
                        }
                    });
                }
            }));
        }
    </script>
@endpush
