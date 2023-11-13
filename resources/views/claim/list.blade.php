@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Klaim</b> List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Klaim List</li>
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
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insured_name">COB</label>
                                        <select class="form-control select2bs4" style="width: 100%;" id="cob_id"
                                            name="cob_id">
                                            <option value="0" selected="selected">Semua COB</option>
                                            <option value="1">PAR</option>
                                            <option value="3">MV</option>
                                            <option value="2">MCI</option>
                                            <option value="4">MH</option>
                                            <option value="7">ENG</option>
                                            <option value="5">VA</option>
                                            <option value="6">LB</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insured_name">Status</label>
                                        <select class="form-control select2bs4" style="width: 100%;" id="status"
                                            name="status">
                                            <option value="0" selected="selected">Semua Status</option>
                                            <option value="1">Laporan awal klaim</option>
                                            <option value="2">On Process</option>
                                            <option value="5">Settled</option>
                                            <option value="6">Proses Klaim Dibayar</option>
                                            <option value="7">Proses Final</option>
                                            <option value="8">Final</option>
                                            <option value="9">Ditolak</option>
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                            <!-- /.col -->
                            <!-- /.row -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer col-md-12" style="text-align: right;">
                            <!-- <a class="btn btn-primary" id="b_load" onclick="load();"> Load</a> -->
                            <button class="btn btn-primary" onclick="load();"><i class="fas fa-save"></i> Load</button>
                        </div>
                    </div>
                </div>
            </div>
            <style type="text/css">
                table.table-bordered {
                    border: 1px solid #ddd;
                    margin-top: 20px;
                }

                table.table-bordered>thead>tr>th {
                    border: 1px solid #ddd;
                }

                table.table-bordered>tbody>tr>td {
                    border: 1px solid #ddd;
                }
            </style>

            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <table class="table table-bordered table-striped table-hover dataTable" id="table_1">
                                <thead>
                                    <tr class="table-primary">
                                        <th>Claim No</th>
                                        <th>Input Date</th>
                                        <th>Insured Name</th>
                                        <th>D O L</th>
                                        <th>COB</th>
                                        <th>User</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr role="row" class="odd">
                                        <td>CB0097/TIB/1123/CGL</td>
                                        <td>2023-11-01 14:59</td>
                                        <td>HYUNDAI MOTOR INDONESIA, PT</td>
                                        <td>2023-10-25</td>
                                        <td>CGL</td>
                                        <td>DOFAN -</td>
                                        <td> <a class="btn btn-primary btn-block" href="/claim/detail/8423">Proses
                                                kelengkapan dokumen(12 Hari)
                                            </a> &nbsp;</td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <td>CB0096/TIB/1123/CGL</td>
                                        <td>2023-11-01 14:50</td>
                                        <td>HYUNDAI MOTOR INDONESIA, PT</td>
                                        <td>2023-11-01</td>
                                        <td>CGL</td>
                                        <td>DOFAN -</td>
                                        <td> <a class="btn btn-primary btn-block" href="/claim/detail/8422">Proses
                                                kelengkapan dokumen(12 Hari)
                                            </a> &nbsp;</td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <td>CA0035/TIB/1122/CIB</td>
                                        <td>2022-11-28 12:00</td>
                                        <td>PROSEGUR CASH INDONESIA, PT</td>
                                        <td>2022-10-14</td>
                                        <td>CIB</td>
                                        <td>DOFAN -</td>
                                        <td> <a class="btn btn-primary btn-block" href="/claim/detail/8313">Proses Klaim
                                                diasuransi(350 Hari)
                                            </a> &nbsp;</td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td>CA0034/TIB/1122/CIB</td>
                                        <td>2022-11-28 11:57</td>
                                        <td>PROSEGUR CASH INDONESIA, PT</td>
                                        <td>2022-10-10</td>
                                        <td>CIB</td>
                                        <td>DOFAN -</td>
                                        <td> <a class="btn btn-primary btn-block" href="/claim/detail/8312">Final </a>
                                            &nbsp;</td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <td>CA0033/TIB/1122/CIB</td>
                                        <td>2022-11-28 11:48</td>
                                        <td>PROSEGUR CASH INDONESIA, PT</td>
                                        <td>2022-10-10</td>
                                        <td>CIB</td>
                                        <td>DOFAN -</td>
                                        <td> <a class="btn btn-primary btn-block" href="/claim/detail/8311">Final </a>
                                            &nbsp;</td>
                                    </tr>
                                    <tr role="row" class="odd">
                                        <td>CA0030/TIB/1122/CIB</td>
                                        <td>2022-11-28 11:34</td>
                                        <td>PROSEGUR CASH INDONESIA, PT</td>
                                        <td>2022-10-07</td>
                                        <td>CIB</td>
                                        <td>DOFAN -</td>
                                        <td> <a class="btn btn-primary btn-block" href="/claim/detail/8308">Final </a>
                                            &nbsp;</td>
                                    </tr>
                                    <tr role="row" class="even">
                                        <td>CA0029/TIB/1122/CIB</td>
                                        <td>2022-11-28 11:29</td>
                                        <td>PROSEGUR CASH INDONESIA, PT</td>
                                        <td>2022-10-05</td>
                                        <td>CIB</td>
                                        <td>DOFAN -</td>
                                        <td> <a class="btn btn-primary btn-block" href="/claim/detail/8307">Final </a>
                                            &nbsp;</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection


@push('levelPluginsJsh')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('levelPluginsJs')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script>
        $(function() {
            $('#table_1').DataTable({
                "paging": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
                "scrollX": true
            });
        });
    </script>
@endpush
