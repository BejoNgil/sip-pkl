<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="board">
            <div class="panel panel-primary">
                <div class="number">
                    <h3>
                    </h3><h3>{{ $stats['peserta_count'] }}</h3>
                    <small>Total Peserta</small>
                </div>
                <div class="icon">
                    <i class="fa fa-users fa-5x red"></i>
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="board">
            <div class="panel panel-primary">
                <div class="number">
                    <h3>
                    </h3><h3>{{ $stats['masalah_count'] }}</h3>
                    <small>Total Masalah</small>

                </div>
                <div class="icon">
                    <i class="fa fa-list-alt fa-5x blue"></i>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="board">
            <div class="panel panel-primary">
                <div class="number">
                    <h3>
                    </h3><h3>{{ $stats['peserta_active_count'] }}</h3>
                    <small>Peserta Aktif</small>

                </div>
                <div class="icon">
                    <i class="fa fa-users fa-5x green"></i>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12">
        <div class="board">
            <div class="panel panel-primary">
                <div class="number">
                    <h3>{{ $stats['none_active_count'] }}</h3>
                    <small>Peserta Non Aktif</small>
                </div>
                <div class="icon">
                    <i class="fa fa-users fa-5x yellow"></i>
                </div>
            </div>
        </div>
    </div>
</div>
