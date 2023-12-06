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
                                        <select class="form-control select2bs4" style="width: 100%;" id="cobId"
                                            name="cob_id">
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insured_name">Status</label>
                                        <select class="form-control select2bs4" style="width: 100%;" id="statusId"
                                            name="status">
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer text-right">
                            <button class="btn btn-primary" id="btnLoad"><i class="fas fa-save"></i> Load</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">

                        <div class="card-body">
                            <table id="tbClaim" class="table table-bordered table-hover text-nowrap" style="width: 100%">
                                <thead>
                                    <tr class="bg-primary">
                                        <th>Claim No</th>
                                        <th>Input Date</th>
                                        <th>Insured Name</th>
                                        <th>Date of Loss</th>
                                        <th>COB</th>
                                        <th>User</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div id="overlayDataClaim" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            <div class="text-bold pt-2">Loading...</div>
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
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endpush

@push('levelPluginsJs')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- custom js --}}
    <script src="{{ asset('storage/claim/claimList.js') }}"></script>
@endpush
