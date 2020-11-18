<html lang="id">
<head>
    <title>Surat Keterangan Selesai PKL</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            line-height: 1.5;
        }

        #watermark {
            position: fixed;
            top: 25%;
            width: 100%;
            text-align: center;
            z-index: -1000;
        }

        .container {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px
        }

        .col {
            flex-basis: 0;
            flex-grow: 1;
            min-width: 0;
            max-width: 100%
        }

        .text-center {
            text-align: center;
        }

        .text-justify {
            text-align: justify;
        }

        .w-100 {
            width: 100% !important
        }

        .justify-content-end {
            justify-content: flex-end !important
        }

        .ttd {
            position: fixed;
            bottom: 250px;
        }
    </style>
</head>
<body>
<div class="container">
    <br>
    <div id="watermark"><img src="{{ public_path('/assets/img/km.png') }}" alt="Watermark" style="width: 400px"/></div>
    <div class="row">
        <div class="col">
            <div class="text-center">
                <h3><u><strong>LAPORAN KEGIATAN PKL</strong></u></h3>
            </div>
            <br>
            <br>
            <table class="w-100 table" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th style="border: 1px solid #000000;">No</th>
                        <th style="border: 1px solid #000000;">Nama Peserta</th>
                        <th style="border: 1px solid #000000;">Nama Pembimbing</th>
                        <th style="border: 1px solid #000000;">Divisi</th>
                        <th style="border: 1px solid #000000;">Tgl Mulai</th>
                        <th style="border: 1px solid #000000;">Tgl Selesai</th>
                        <th style="border: 1px solid #000000;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['pkl'] as $item)
                        <tr>
                            <td style="border: 1px solid #000000; text-align: center;">{{ $loop->iteration }}</td>
                            <td style="border: 1px solid #000000;">{{ $item->peserta->nama }}</td>
                            <td style="border: 1px solid #000000;">{{ $item->pembimbing->nama }}</td>
                            <td style="border: 1px solid #000000;">{{ $item->posisi->nama }}</td>
                            <td style="border: 1px solid #000000;">{{ $item->tanggal_mulai->format('d-m-Y') }}</td>
                            <td style="border: 1px solid #000000;">{{ $item->tanggal_selesai->format('d-m-Y') }}</td>
                            <td style="border: 1px solid #000000;">
                                @if ($item->nilai->count() > 0)
                                    {!! '<span class="text-danger">Non Aktif</span>' !!}
                                @else
                                    {!! '<span class="text-success">Aktif</span>' !!}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
