@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Input Klaim</h1>
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
                            <table id="tbsppa" class="table table-bordered table-hover text-nowrap" style="width: 100%">
                                <thead>
                                    <tr class="bg-primary">
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
                            <button class="btn btn-primary" onclick="getClientinfo();"><i class="fas fa-check mr-1"></i>
                                Load</button>
                        </div>

                    </div>
                </div>
                {{-- client info --}}
                <div class="col-12" id="clientInfo" style="display: none;">
                    <div class="card card-primary card-tabs">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="client-info-tab" data-toggle="pill"
                                        href="#client-info-tab-view" role="tab" aria-controls="client-info-tab-view"
                                        aria-selected="true">Client Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="premium-info-tab" data-toggle="pill"
                                        href="#premium-info-tab-view" role="tab" aria-controls="premium-info-tab-view"
                                        aria-selected="false">Premium
                                        Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="debit-note-tab" data-toggle="pill" href="#debit-note-tab-view"
                                        role="tab" aria-controls="debit-note-tab-view" aria-selected="false">D/N
                                        Info</a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="custom-tabs-one-tabContent">
                                <div class="tab-pane fade show active" id="client-info-tab-view" role="tabpanel"
                                    aria-labelledby="client-info-tab">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <div id="overlayClientInfo" class="overlay"><i
                                                    class="fas fa-3x fa-sync-alt fa-spin"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insured_name">Policy</label>
                                                    <input type="text" class="form-control" id="polisNo"
                                                        name="polisNo" placeholder="Policy" readonly>
                                                    <input type="text" class="form-control" id="draftNo"
                                                        name="draftNo" placeholder="Draft Number" required="true" hidden>
                                                </div>
                                                <div class="form-group">
                                                    <label for="insured_name">Type of Cover</label>
                                                    <input type="text" class="form-control" id="typeOFCover"
                                                        name="typeOFCover" placeholder="Type of Cover" required="true"
                                                        readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="insured_name">Insured Name</label>
                                                    <input type="text" class="form-control" id="nameWrt"
                                                        name="nameWrt" readonly>
                                                    <input type="text" class="form-control" id="insdId"
                                                        name="insdId" placeholder="insdId" hidden>
                                                </div>
                                                <div class="form-group">
                                                    <label for="insured_name">Total Sum Insured</label>
                                                    <input type="text" class="form-control" id="tsi"
                                                        name="tsi" placeholder="tsi" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insured_name">Period</label>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-1">
                                                            <input type="text" class="form-control" id="startDd"
                                                                name="startDd" placeholder="Start Period" readonly>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 mb-1">
                                                            <input type="text" class="form-control" id="endDd"
                                                                name="endDd" placeholder="End Period" readonly>
                                                        </div>
                                                    </div>
                                                </div>
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
                                <div class="tab-pane fade" id="premium-info-tab-view" role="tabpanel"
                                    aria-labelledby="premium-info-tab">
                                    <div class="card-body p-0">
                                        <div class="overlay-wrapper">
                                            <div id="overlayPremiumInfo" class="overlay"><i
                                                    class="fas fa-3x fa-sync-alt fa-spin"></i>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive p-0">
                                                    <table id="tbclientPremiumInfo" class="table table-hover text-nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th id="clientName" colspan="6"></th>
                                                            </tr>
                                                            <tr class="bg-primary">
                                                                <th>No. Nota</th>
                                                                <th>No. Bukti</th>
                                                                <th>Tanggal</th>
                                                                <th>Jumlah</th>
                                                                <th>Pelunasan</th>
                                                                <th>Saldo</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-md-12" id="divPremiumInfo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="debit-note-tab-view" role="tabpanel"
                                    aria-labelledby="debit-note-tab">

                                </div>
                            </div>
                        </div>
                        <div class="card-footer col-md-12" style="text-align: right;">
                            <button class="btn btn-primary" onclick="addDataClaim();"><i class="fas fa-save mr-1"></i>
                                Add Data Claim
                            </button>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <div class="col-12" id="dataClaim" style="display: none;">
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
                                    <table id="tbclaimAmount" class="table table-bordered table-hover text-nowrap"
                                        style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>Insurance Name</th>
                                                <th>Share (%)</th>
                                                <th>Claim Amount</th>
                                                <th>Recovery Amount</th>
                                                <th>Deduction Amount</th>
                                                <th>Net Claim</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="overlayDataAmount" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            <div class="text-bold pt-2">Loading...</div>
                        </div>
                        <div class="card-footer" style="text-align: right;">
                            <button class="btn btn-primary" onclick="submit();"><i class="fas fa-save"></i>
                                Save All Data
                            </button>
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
