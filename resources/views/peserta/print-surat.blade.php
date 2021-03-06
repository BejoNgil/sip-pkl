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
<div class="container" style="padding-left: 10%;padding-right: 10%">
    <br>
    <div id="watermark"><img src="{{ public_path('/assets/img/km.png') }}" alt="Watermark" style="width: 400px"/></div>
    <div class="row">
        <div class="col"><br><br>
            <div class="text-center">
                <h3><u><strong>SURAT KETERANGAN SELESAI PKL</strong></u></h3>
            </div>
            <br>
            <br>
            <p>Dengan ini, kami yang bertandatangan dibawah ini:</p>
            <table class="w-100">
                <tr>
                    <td width="12.5%">Nama</td>
                    <td width="1.5%">:</td>
                    <td>Eko Sulistyono</td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td>Public Relation & Kominfo</td>
                </tr>
            </table>
            <br>
            <p>Menerangkan bahwa :</p>
            <br>
            <table class="w-100">
                <tr>
                    <td width="12.5%">Nama</td>
                    <td width="1.5%">:</td>
                    <td>{{ $data['nama'] }}</td>
                </tr>
                <tr>
                    <td>NIS</td>
                    <td>:</td>
                    <td>{{ $data['nis'] }}</td>
                </tr>
                <tr>
                    <td>Sekolah</td>
                    <td>:</td>
                    <td>{{ $data['sekolah'] }}</td>
                </tr>
            </table>
            <br>
            <p class="text-justify">Telah menyelesaikan Kegiatan Praktek Kerja Lapangan (PKL) pada Kampung Marketer, Jl.
                Raya Tamansari,
                Kompleks Karangwuni, Desa Tamansari, Karangmoncol, Kab. Purbalingga, Jawa Tengah 53355. Dari
                tanggal {{ $data['tglMulai'] }} sampai dengan {{ $data['tglSelesai'] }}. Selama melaksanakan tugasnya di kampung
                marketer ini, siswa
                yang bersangkutan telah menjalankan tugasnya dengan baik.
            </p>
            <p class="text-justify"> Demikian surat keterangan PKL ini kami buat untuk dapat digunakan sebagaimana
                mestinya
            </p>
        </div>
    </div>
    <br><br>
    <div style="text-align: right">
        <div>
            <p>Purbalingga, {{ $data['tanggal'] }}</p>
            <br>
            <img src="{{ storage_path('app/public/qrcodes/'.'qrcode'.'.svg') }}" alt="">
            <br>
            <p>Eko Sulistyono</p>
        </div>
    </div>
</div>
<div style="page-break-before: always;">
    <div class="container" style="padding-left: 10%;padding-right: 10%">
        <br>
        <div id="watermark"><img src="{{ public_path('/assets/img/km.png') }}" alt="Watermark" style="width: 400px"/></div>
        <div class="row">
            <div class="col"><br><br>
                <div class="text-center">
                    <h3><strong>FORM NILAI PRAKTIK KERJA LAPANGAN <br> KAMPUNG MARKETER</strong></h3>
                </div>
                <br>
                <br>
                <table class="w-100">
                    <tr>
                        <td width="12.5%">Nama</td>
                        <td width="1.5%">:</td>
                        <td>{{ $data['nama'] }}</td>
                    </tr>
                    <tr>
                        <td>NIS</td>
                        <td>:</td>
                        <td>{{ $data['nis'] }}</td>
                    </tr>
                    <tr>
                        <td>Sekolah</td>
                        <td>:</td>
                        <td>{{ $data['sekolah'] }}</td>
                    </tr>
                </table>
                <br>
                <br>
                <p>Dengan penilaian sebagai berikut :</p>
                <table class="w-100" style="border-collapse: collapse;">
                    <thead>
                        <tr>
                            <th style="border: 1px solid #000000;">Kategori</th>
                            <th style="border: 1px solid #000000;">Nilai</th>
                            <th style="border: 1px solid #000000;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['nilai'] as $item)
                        <tr>
                            <td style="border: 1px solid #000000; text-align: center;">{{ $item->kategori->nama }}</td>
                            <td style="border: 1px solid #000000; text-align: center;">{{ $item->nilai }}</td>
                            <td style="border: 1px solid #000000; text-align: center;">{{ $item->keterangan }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="border: 1px solid #000000; text-align: center;">Nilai Akhir</td>
                            <td style="border: 1px solid #000000; text-align: center;" colspan="2">{{ $data['total'] }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div style="text-align: right" class="ttd">
            <div>
                <p>Purbalingga, {{ $data['tanggal'] }}</p>
                <br>
                <img src="{{ storage_path('app/public/qrcodes/'.'qrcode'.'.svg') }}" alt="">
                <br>
                <p>Eko Sulistyono</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>
