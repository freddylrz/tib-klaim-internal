@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>List Klaim</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Klaim Data</a></li>
                        <li class="breadcrumb-item active">List</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insured_name">Parameter</label>
                                        <select class="form-control select2bs4 filter" style="width: 100%;" id="parameterId"
                                            name="parameter_id">
                                        </select>
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insured_name">Value Parameter</label>
                                        <input type="text" class="form-control filter" id="valueParameter"
                                            name="valueParameter" placeholder="Value">
                                    </div>
                                    <!-- /.form-group -->
                                </div>
                            </div>
                        </div>
                        <div class="card-footer col-md-12" style="text-align: right;">
                            <button class="btn btn-primary" onclick="search();">
                                <i class="fas fa-search mr-1"></i>Search
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                {{-- data client --}}
                <div class="col-12" id="dataClient" style="display: none;">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Data Client</h3>
                        </div>

                        <div class="card-body">
                            <table id="tbsppa" class="table table-bordered table-hover" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>D/N</th>
                                        <th>Polis</th>
                                        <th>Insured Name</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div id="overlayDataClient" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            <div class="text-bold pt-2">Loading...</div>
                        </div>
                        <div class="card-footer" style="text-align: right;">
                            <input type="text" name="sppa_id" id="sppa_id" hidden>
                            <input type="text" name="polis_id" id="polis_id" hidden>
                            <button class="btn btn-primary" onclick="info();"><i class="fas fa-check mr-1"></i>
                                Load</button>
                        </div>

                    </div>
                </div>
                {{-- client info --}}
                <div class="col-12" id="c_info" style="display: none;">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="interest-insured-tab" data-toggle="pill"
                                        href="#interest-insured-tab-view" role="tab"
                                        aria-controls="interest-insured-tab-view" aria-selected="true">Client Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="conditions-tab" data-toggle="pill" href="#conditions-tab-view"
                                        role="tab" aria-controls="conditions-tab-view" aria-selected="false">Premium
                                        Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="main-exclusion-tab" data-toggle="pill"
                                        href="#main-exclusion-tab-view" role="tab"
                                        aria-controls="main-exclusion-tab-view" aria-selected="false">D/N Info</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="interest-insured-tab-view" role="tabpanel"
                                    aria-labelledby="interest-insured-tab">
                                    <div class="card-body">
                                        <div class="overlay-wrapper">
                                            <div id="overlayClientInfo" class="overlay"><i
                                                    class="fas fa-3x fa-sync-alt fa-spin"></i>
                                                <div class="text-bold pt-2">Loading...</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                                <div class="form-group">
                                                    <label for="insured_name">Policy</label>
                                                    <input type="text" class="form-control" id="polisNo"
                                                        name="polisNo" placeholder="Policy" readonly>
                                                    <input type="text" class="form-control" id="tsi"
                                                        name="tsi" placeholder="tsi" hidden>
                                                </div>
                                                <div class="form-group">
                                                    <label for="insured_name">Type of Cover</label>
                                                    <input type="text" class="form-control" id="c_type"
                                                        name="c_type" placeholder="Type of Cover" required="true"
                                                        readonly>
                                                    <input type="text" class="form-control" id="kode_cob"
                                                        name="kode_cob" placeholder="Type of Cover" required="true"
                                                        hidden>
                                                    <input type="text" class="form-control" id="currCode"
                                                        name="currCode" hidden>
                                                </div>
                                                <div class="form-group">
                                                    <label for="insured_name">Insured Name</label>
                                                    <input type="text" class="form-control" id="nameWrt"
                                                        name="nameWrt" readonly>
                                                    <input type="text" class="form-control" id="insdId"
                                                        name="insdId" placeholder="insdId" hidden>
                                                </div>

                                                <div class="form-group">
                                                    <label for="insured_name">Period</label>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <input type="text" class="form-control" id="startDd"
                                                                name="startDd" placeholder="Start Period" readonly>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <input type="text" class="form-control" id="endDd"
                                                                name="endDd" placeholder="End Period" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insured_name">Interest/Object Claim</label>
                                                    <textarea class="form-control" rows="10" style="width: 100%;" id="interestInsured" name="interestInsured"
                                                        readonly></textarea>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <input type="submit" id="saveBtn" style="display: none;">
                                    <input type="text" id="c_cob" name="c_cob" style="display: none;">
                                </div>
                                <div class="tab-pane fade" id="conditions-tab-view" role="tabpanel"
                                    aria-labelledby="conditions-tab">
                                    <div class="card-body">
                                        <div class="overlay-wrapper">
                                            <div id="overlayPremiumInfo" class="overlay"><i
                                                    class="fas fa-3x fa-sync-alt fa-spin"></i>
                                                <div class="text-bold pt-2">Loading...</div>
                                            </div>
                                        </div>
                                        <table class="table" id="tablepremi">
                                            <thead>
                                                <tr
                                                    style="border-style: solid none solid none; text-align: right; font-weight: bold;">
                                                    <td>&nbsp;</td>
                                                    <td>No. Nota</td>
                                                    <td>No. Bukti</td>
                                                    <td>Tanggal</td>
                                                    <td>Jumlah</td>
                                                    <td>Pelunasan</td>
                                                    <td>Saldo</td>
                                                </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="main-exclusion-tab-view" role="tabpanel"
                                    aria-labelledby="main-exclusion-tab">

                                </div>
                            </div>
                        </div>
                        <div class="card-footer col-md-12" style="text-align: right;">
                            <button class="btn btn-primary" onclick="dataKlaim();"><i class="fas fa-save"></i> Add Data
                                Claim</button>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="col-12" id="dataKlaim" style="display: none;">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Claim Data</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                    <div class="form-group">
                                        <label for="insured_name">Date of Loss</label>
                                        <input type="text" class="form-control datepicker" id="date"
                                            name="date" placeholder="Date of Loss" required="true">
                                        <input type="text" class="form-control" id="dateInput" name="dateInput"
                                            value="10-11-2023" hidden>
                                    </div>

                                    <div class="form-group">
                                        <label for="insured_name">Location of Loss</label>
                                        <textarea class="form-control" rows="3" style="width: 100%;" id="location" name="location" required></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="insured_name">Cause of Loss</label>
                                        <select class="form-control select2bs4" id="causeId" name="causeId"
                                            style="width: 100%;">

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="insured_name">Loss Adjuster</label>
                                        <select class="form-control select2bs4" id="lossAdjId" name="lossAdjId"
                                            style="width: 100%;">
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="insured_name">Workshop</label>
                                        <select class="form-control select2bs4" id="workshopId" name="workshopId"
                                            style="width: 100%;">
                                        </select>
                                    </div>


                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insured_name">Estimation Amount</label>
                                        <input type="tel" class="form-control uang" id="c_amount" name="c_amount"
                                            placeholder="Estimation Amount" required="true" onkeyup="amount();">
                                    </div>
                                    <div class="form-group">
                                        <label for="insured_name">Claim Amount</label>
                                        <input type="tel" class="form-control uang" id="c_claim" name="c_claim"
                                            placeholder="Claim Amount" required="true" onkeyup="amount();">
                                    </div>
                                    <div class="form-group">
                                        <label for="insured_name">Deduction Amount</label>
                                        <input type="tel" class="form-control uang" id="c_deduct" name="c_deduct"
                                            placeholder="Deduction Amount" required="true" onkeyup="amount();">
                                    </div>
                                    <div class="form-group">
                                        <label for="insured_name">Recovery Amount</label>
                                        <input type="tel" class="form-control uang" id="c_recv" name="c_recv"
                                            placeholder="Recovery Amount" required="true" onkeyup="amount();">
                                    </div>
                                    <div class="form-group">
                                        <label for="insured_name">Net Claim Amount</label>
                                        <input type="tel" class="form-control uang" id="c_net" name="c_net"
                                            placeholder="Net Amount" onkeyup="amount();" readonly>
                                    </div>

                                    <div id="uploadform">
                                        <form role="form" method="post" id="formupd"
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="_token"
                                                value="eusOl4d3Wubzy8GJzPmiFrMNvSi0xib1WvB60icy">
                                            <div class="form-group">
                                                <label for="client">Upload File</label><br>
                                                <input type="file" id="fileInputupd" class="form-control"
                                                    name="fileInputupd[]" style="padding: 4px;display:none;" multiple>
                                                <input type="hidden" id="dataid" name="dataid">
                                                <input type="hidden" id="cob" name="cob">
                                                <div id="opt"></div>
                                                <a class="btn btn-primary btn-sm btnfilesupd" style="color: #fff"><i
                                                        class="fa fa-upload"></i> Pilih
                                                    File</a>
                                                <small>Tekan CTRL untuk memilih beberapa file</small>
                                                <ul id="listfilesupd"></ul>
                                            </div>
                                            <input type="submit" id="uploadupdbtn" style="display: none;">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-12" id="dataAmount" style="display: none;">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Claim Amount</h3>
                        </div>

                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
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

                                    <table class="table table-bordered table-striped table-hover dataTable"
                                        id="tableklaim">
                                        <thead>
                                            <tr>
                                                <th>Insurance Name</th>
                                                <th>Share (%)</th>
                                                <th>Claim Amount</th>
                                                <th>Recovery Amount</th>
                                                <th>Deduction Amount</th>
                                                <th>Net Claim</th>
                                                <!-- <th>&nbsp;</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>


                                </div>
                            </div>
                        </div>

                        <div class="card-footer" style="text-align: right;">
                            <button class="btn btn-primary" onclick="submit();"><i class="fas fa-save"></i>
                                Save All
                                Data</button>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="prodNo" id="prodNo">
            </div>

    </section>
@endsection


@push('levelPluginsJsh')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('levelPluginsJs')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- custom js --}}
    <script src="{{ asset('storage/claim/claim.js') }}"></script>
@endpush
