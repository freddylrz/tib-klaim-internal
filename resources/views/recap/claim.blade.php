@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark"><b>Data Rekap Klaim</b></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Home</li>
                        <li class="breadcrumb-item active">Data Rekap Klaim</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <form id="formLoadData" role="form" method="POST">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="insured_name">COB</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="cobId"
                                        name="cobId" required>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="insured_name">Status</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="statusId"
                                        name="statusId" required>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="">Loss Adjuster</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="ladjId"
                                        name="ladjId" required>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="">Workshop</label>
                                    <select class="form-control select2bs4" style="width: 100%;" id="wsId"
                                        name="wsId" required>
                                    </select>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="">Date from</label>
                                    <input type="text" class="form-control datetimepicker-input" id="dateFrom"
                                        data-toggle="datetimepicker" data-target="#dateFrom" name="dateFrom"
                                        placeholder="Date From" required="true">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <div class="col-md-6 col-sm-6 col-12">
                                <div class="form-group">
                                    <label for="">Date End</label>
                                    <input type="text" class="form-control datetimepicker-input" id="dateEnd"
                                        data-toggle="datetimepicker" data-target="#dateEnd" name="dateEnd"
                                        placeholder="Date End" required="true">
                                </div>
                                <!-- /.form-group -->
                            </div>
                        </div>
                        <!-- /.col -->
                        <!-- /.row -->
                    </div> <!-- /.card-body -->
                    <div class="card-footer col-md-12" style="text-align: right;">
                        <button class="btn btn-primary" id="btnLoad" type="submit"><i class="fas fa-save"></i>
                            Load</button>
                        <button class="btn btn-success" id="btnExport" type="button" disabled="true"><i
                                class="fas fa-file-download"></i> Export</button>
                    </div>
                </form>
            </div>

            <div id="tabelreload" style="display: none">
                <div class="card border-dark mb-3">
                    <div class="table-responsive p-0">
                        <table id="tbRecapClaim" class="table table-hover text-nowrap">
                            <thead>
                                <tr class="bg-primary">
                                    <th>No. Claim</th>
                                    <th>No. Polis</th>
                                    <th>Insured Name</th>
                                    <th>COB</th>
                                    <th>Inception Date</th>
                                    <th>Expired date</th>
                                    <th>Date Of loss</th>
                                    <th>Location Of Loss </th>
                                    <th>Insurance Member</th>
                                    <th>Share</th>
                                    <th>Currency</th>
                                    <th>Sum Insured 100%</th>
                                    <th>Sum Insured Member</th>
                                    <th>Claim Amount</th>
                                    <th>Deductible</th>
                                    <th>Subrograsi</th>
                                    <th>Net Claim</th>
                                    <th>Claim Status</th>
                                    <th>PIC</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    <!-- /.content -->
@endsection

@push('levelPluginsJsh')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('levelPluginsJs')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- custom js --}}
    <script src="{{ asset('storage/recap/claimRecap.js') }}"></script>
@endpush
