@extends('layouts.app')
@section('title', 'Presensi')
@section('page-header')
    Presensi
@endsection
@section('main')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Presensi Tanggal {{ today()->format('d M Y') }}
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Keterangan Presensi</th>
                                    <th>-</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $absensi != null ? 'Pukul ' . $absensi['jam_masuk'] . ' WIB' : '(Belum Absensi)' }}</td>
                                    <td>
                                        <button class="btn btn-primary"
                                                id="absenMasuk" {{ $absensi != null && $absensi['jam_masuk'] != null ? 'disabled' : '' }}>
                                            Presensi Masuk
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ $absensi != null && $absensi['jam_pulang'] != null ? 'Pukul ' . $absensi['jam_pulang'] . ' WIB' : '(Belum Absensi)' }}</td>
                                    <td>
                                        <button class="btn btn-warning"
                                                id="absenPulang" {{ $absensi != null && $absensi['jam_pulang'] != null ? 'disabled' : '' }}>
                                            Presensi Pulang
                                        </button>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="hidden">
                        <form action="{{ route('absensi.store') }}" method="post" id="formMasuk">
                            @csrf
                            <input type="hidden" name="type" value="masuk">
                        </form>
                        <form action="{{ route('absensi.store') }}" method="post" id="formPulang">
                            @csrf
                            <input type="hidden" name="type" value="pulang">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Riwayat Presensi
                </div>
                <div class="panel-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($historyAbsensi as $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item['tanggal'])->format('d-m-Y') }}</td>
                                <td>{{ $item['jam_masuk'] }}</td>
                                <td>{{ $item['jam_pulang'] }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">Belum ada riwayat absensi</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $historyAbsensi->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#absenMasuk').click(function () {
            swal({
                title: "Apa anda yakin?",
                text: "Akan Menyimpan Absensi masuk?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete => {
                if (willDelete) {
                    $('#formMasuk').submit();
                }
            }));
        });
        $('#absenPulang').click(function () {
            swal({
                title: "Apa anda yakin?",
                text: "Akan Menyimpan Absensi pulang?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete => {
                if (willDelete) {
                    $('#formPulang').submit();
                }
            }));
        });
    </script>
@endpush
