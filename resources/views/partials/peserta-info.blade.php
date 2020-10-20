<div class="row">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <div>
                        <span>{{ $peserta['nama'] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <div>
                        <span>{{ $peserta['authenticable']['email'] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nis">NIS (Nomer Induk Siswa)</label>
                    <div>
                        {{$peserta['nis']}}
                    </div>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div>
                        {{ $peserta['jenis_kelamin'] === 'L' ? "Laki-Laki" : "Perempuan" }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="birthday">Tanggal Lahir</label>
                    <div>
                        {{ $peserta['tanggal_lahir'] != null ? $peserta['tanggal_lahir']->format('d M Y') : '' }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <div>
                        {{ $peserta['alamat'] ?? '-' }}
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-md-offset-1">
                <img src="{{ asset($peserta['foto'] != null ? 'storage/' . $peserta['foto'] : 'assets/img/avatar-placeholder.png') }}"
                     alt="{{ $peserta['nama'] }}" class="user-image mt-1" height="60"/>
                <div class="form-group">
                    <label for="sekolah">Sekolah</label>
                    <div id="school-select-ctr">
                        <span>{{ $peserta['sekolah']['nama'] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="program-keahlian">Program Keahlian</label>
                    <div id="program-select-ctr">
                        <span>{{ $peserta['programKeahlian']['nama'] }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="telepon">Telepon</label>
                    <div>
                        {{ $peserta['telepon'] ?? '-' }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="ayah">Nama Ayah</label>
                    <div>
                        {{ $peserta['ayah'] ?? '-' }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="ibu">Nama Ibu</label>
                    <div>
                        {{ $peserta['ibu'] ?? '-' }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
