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
                    <a href="/request/listKlaim?cob=0&status=2">
                        <div class="small-box bg-purple shadow">
                            <div class="inner">
                                <h3>444444</h3>
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
                    <a href="/request/listKlaim?cob=0&status=2">
                        <div class="small-box bg-lightblue shadow">
                            <div class="inner">
                                <h3>444444</h3>
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
                    <a href="/request/listKlaim?cob=0&status=2">
                        <div class="small-box bg-primary shadow">
                            <div class="inner">
                                <h3>444444</h3>
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
                    <a href="/request/listKlaim?cob=0&status=2">
                        <div class="small-box bg-teal shadow">
                            <div class="inner">
                                <h3>444444</h3>
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
                    <a href="/request/listKlaim?cob=0&status=2">
                        <div class="small-box bg-olive shadow">
                            <div class="inner">
                                <h3>444444</h3>
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
                    <a href="/request/listKlaim?cob=0&status=2">
                        <div class="small-box bg-success shadow">
                            <div class="inner">
                                <h3>444444</h3>
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
                    <a href="/request/listKlaim?cob=0&status=2">
                        <div class="small-box bg-danger shadow">
                            <div class="inner">
                                <h3>444444</h3>
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
                        <div class="card-body table-responsive p-0">
                            <style type="text/css">
                                .badge {
                                    font-size: 100%;
                                }
                            </style>
                            <table class="table table-striped table-valign-middle" style="text-align: center;">
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
                                <tbody>
                                    <tr>
                                        <td>On Process</td>
                                        <td><span class="badge bg-primary">
                                                20
                                            </span></td>
                                        <td><span class="badge bg-primary">
                                                8
                                            </span></td>
                                        <td><span class="badge bg-primary">
                                                14
                                            </span></td>
                                        <td><span class="badge bg-primary">
                                                11
                                            </span></td>
                                        <td><span class="badge bg-primary">
                                                7
                                            </span></td>
                                    </tr>
                                    <tr>
                                        <td>Settled</td>
                                        <td><span class="badge bg-teal">1</span></td>
                                        <td><span class="badge bg-teal">0</span></td>
                                        <td><span class="badge bg-teal">0</span></td>
                                        <td><span class="badge bg-teal">0</span></td>
                                        <td><span class="badge bg-teal">0</span></td>
                                    </tr>
                                    <tr>
                                        <td>Proses Bayar</td>
                                        <td><span class="badge bg-olive">0</span></td>
                                        <td><span class="badge bg-olive">1</span></td>
                                        <td><span class="badge bg-olive">0</span></td>
                                        <td><span class="badge bg-olive">0</span></td>
                                        <td><span class="badge bg-olive">0</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->

                </div>

                <div class="col-lg-6 col-md-6 col-12">

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
                </div>

            </div>
            <div class="row">

                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card card-primary card-outline" id="dataKlaim">
                        <div class="card-header">
                            <h3 class="card-title"><strong>Data Status Klaim</strong></h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <style type="text/css">
                                .badge {
                                    font-size: 100%;
                                }
                            </style>
                            <table class="table table-striped table-valign-middle" style="text-align: center;">
                                <thead>
                                    <tr>
                                        <th style="padding: 0.5rem;">COB</th>
                                        <th>On Process</th>
                                        <th>Settled</th>
                                        <th>Proses Bayar</th>
                                        <th>Final</th>
                                        <th>Ditolak</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td style="padding: 0.5rem;">
                                            PAR
                                        </td>
                                        <td><span class="badge bg-primary">6</span></td>
                                        <td><span class="badge bg-teal">0</span></td>
                                        <td><span class="badge bg-olive">0</span></td>
                                        <td><span class="badge bg-success">7</span></td>
                                        <td><span class="badge bg-danger">0</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.5rem;">
                                            MCI
                                        </td>
                                        <td><span class="badge bg-primary">1</span></td>
                                        <td><span class="badge bg-teal">0</span></td>
                                        <td><span class="badge bg-olive">0</span></td>
                                        <td><span class="badge bg-success">1</span></td>
                                        <td><span class="badge bg-danger">0</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.5rem;">
                                            MVI
                                        </td>
                                        <td><span class="badge bg-primary">9</span></td>
                                        <td><span class="badge bg-teal">0</span></td>
                                        <td><span class="badge bg-olive">0</span></td>
                                        <td><span class="badge bg-success">38</span></td>
                                        <td><span class="badge bg-danger">0</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.5rem;">
                                            VA
                                        </td>
                                        <td><span class="badge bg-primary">16</span></td>
                                        <td><span class="badge bg-teal">1</span></td>
                                        <td><span class="badge bg-olive">0</span></td>
                                        <td><span class="badge bg-success">13</span></td>
                                        <td><span class="badge bg-danger">1</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.5rem;">
                                            LB
                                        </td>
                                        <td><span class="badge bg-primary">1</span></td>
                                        <td><span class="badge bg-teal">0</span></td>
                                        <td><span class="badge bg-olive">0</span></td>
                                        <td><span class="badge bg-success">0</span></td>
                                        <td><span class="badge bg-danger">0</span></td>
                                    </tr>
                                    <tr>
                                        <td style="padding: 0.5rem;">
                                            MI
                                        </td>
                                        <td><span class="badge bg-primary">10</span></td>
                                        <td><span class="badge bg-teal">0</span></td>
                                        <td><span class="badge bg-olive">1</span></td>
                                        <td><span class="badge bg-success">12</span></td>
                                        <td><span class="badge bg-danger">0</span></td>
                                    </tr>

                                </tbody>
                            </table>
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
            </div>

        </div><!-- /.container-fluid -->
    </div>
@endsection

@push('levelPluginsJs')
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    {{-- custom js --}}
    <script src="{{ asset('storage/home/dashboard.js') }}"></script>
@endpush
