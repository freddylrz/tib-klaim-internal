@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><b>Dashboard</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline" id="dataKlaim">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Data Klaim</strong></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/claim/list">
                        <div class="small-box bg-purple shadow">
                            <div class="overlay dark">
                                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            </div>
                            <div class="inner">
                                <h3 id="total">
                                    0
                                </h3>
                                <p class="text-uppercase">Total Klaim</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-folder-open text-white-50"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /.info-box-content -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/claim/list/2">
                        <div class="small-box bg-lightblue shadow">
                            <div class="overlay dark">
                                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            </div>
                            <div class="inner">
                                <h3 id="tot_laporan_awal">
                                    0
                                </h3>
                                <p class="text-uppercase">Laporan Awal</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-file text-white-50"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /.info-box-content -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/claim/list/3">
                        <div class="small-box bg-primary shadow">
                            <div class="overlay dark">
                                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            </div>
                            <div class="inner">
                                <h3 id="tot_onprocess">
                                    0
                                </h3>
                                <p class="text-uppercase">On Process</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-sync-alt text-white-50"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /.info-box-content -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/claim/list/4">
                        <div class="small-box bg-teal shadow">
                            <div class="overlay dark">
                                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            </div>
                            <div class="inner">
                                <h3 id="tot_settled">
                                    0
                                </h3>
                                <p class="text-uppercase">Settled</p>
                            </div>
                            <div class="icon">
                                <i class="far fa-file-alt text-white-50"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /.info-box-content -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/claim/list/5">
                        <div class="small-box bg-olive shadow">
                            <div class="overlay dark">
                                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            </div>
                            <div class="inner">
                                <h3 id="tot_bayar">
                                    0
                                </h3>
                                <p class="text-uppercase">Proses Bayar</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-file-invoice-dollar text-white-50"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /.info-box-content -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/claim/list/7">
                        <div class="small-box bg-success shadow">
                            <div class="overlay dark">
                                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            </div>
                            <div class="inner">
                                <h3 id="tot_final">
                                    0
                                </h3>
                                <p class="text-uppercase">Final</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-vote-yea text-white-50"></i>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /.info-box-content -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/claim/list/8">
                        <div class="small-box bg-danger shadow">
                            <div class="overlay dark">
                                <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            </div>
                            <div class="inner">
                                <h3 id="tot_tolak">
                                    0
                                </h3>
                                <p class="text-uppercase">Ditolak</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-exclamation-triangle text-white-50"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-primary card-outline" id="dataKlaim">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Resiko</strong></h3>
                        </div>
                    </div>
                </div>
                <!-- /.info-box-content -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/request/listKlaim?cob=0&status=0" style="color: #000;">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fas fa-exclamation"></i></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Low </strong>Risk</span>
                                <span class="info-box-number"><i>0</i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /.info-box-content -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/request/listKlaim?cob=0&status=0" style="color: #000;">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fas fa-exclamation"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Medium </strong>Risk</span>
                                <span class="info-box-number"><i>0</i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /.info-box-content -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/request/listKlaim?cob=0&status=0" style="color: #000;">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fas fa-exclamation"
                                    style="color: #fff"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>High </strong>Risk</span>
                                <span class="info-box-number"><i>0</i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <!-- /.info-box-content -->
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="/request/listKlaim?cob=0&status=0" style="color: #000;">
                        <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="fas fa-exclamation"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text"><strong>Complicated </strong>Risk</span>
                                <span class="info-box-number"><i>0</i></span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card card-primary card-outline" id="dataKlaim">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Data Klaim Berjalan</strong></h3>
                        </div>
                        <div class="card-body p-0">
                            <table id="tbKlaimBerjalan" class="table table-hover text-nowrap" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>Status</th>
                                        <th>&lt;3 Bulan</th>
                                        <th>&gt;3 Bulan</th>
                                        <th>&gt;6 Bulan</th>
                                        <th>&gt;9 Bulan</th>
                                        <th>&gt;12 Bulan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div id="overlayKlaimBerjalan" class="overlay">
                            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <div class="col-lg-6 col-md-6 col-12">

                    <!-- BAR CHART -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Data Status Klaim</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

                {{-- <div class="col-lg-6 col-md-6 col-12">

                    <!-- BAR CHART -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Data Lost Ratio</strong></h3>
                        </div>
                        <div class="card-body">
                            <div class="chart">
                                <canvas id="barChartLoss"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div> --}}

            </div>
            <div class="row">

                <div class="col-lg-12 col-md-12 col-12">
                    <div class="card card-primary card-outline" id="dataKlaim">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Data Status Klaim</strong></h3>
                        </div>
                        <div class="card-body p-0">
                            <table id="tbStatusKlaim" class="table table-hover text-nowrap" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>COB</th>
                                        <th>Laporan Awal</th>
                                        <th>On Process</th>
                                        <th>Settled</th>
                                        <th>Proses Bayar</th>
                                        <th>Final</th>
                                        <th>Ditolak</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div id="overlayKlaimBerjalan" class="overlay">
                            <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>

            </div>

        </div><!-- /.container-fluid -->
    </div>
@endsection


@push('levelPluginsJsh')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('levelPluginsJs')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    {{-- custom js --}}
    <script src="{{ asset('storage/home/dashboard.js') }}"></script>
@endpush
