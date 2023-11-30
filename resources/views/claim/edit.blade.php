@extends('layouts.app')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit <span id="headClaimNo"></span></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Claim Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <style type="text/css">
        div.form-group label {
            text-transform: uppercase;
        }
    </style>
    <input type="text" name="claimId" id="claimId" value="{{ request()->claimId }}" hidden>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- client info --}}
                <div class="col-12" id="clientInfo">
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
                                                    <label>Policy</label>
                                                    <p id="txtpolisNo"></p>
                                                    <input type="text" class="form-control" id="draftNo" name="draftNo"
                                                        placeholder="Draft Number" required hidden>
                                                    <input type="text" class="form-control" name="prodNo" id="prodNo"
                                                        hidden>
                                                </div>
                                                <div class="form-group">
                                                    <label>Type of Cover</label>
                                                    <p id="txttypeOFCover"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Insured Name</label>
                                                    <p id="txtnameWrt"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Total Sum Insured</label>
                                                    <p id="txttsi"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Period</label>
                                                    <p id="txtperiod"></p>
                                                </div>
                                                <div class="form-group">
                                                    <label>Interest/Object Claim</label>
                                                    <p id="txtinterestInsured"></p>
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
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <form id="formEdit" role="form" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-12" id="dataClaim">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Claim Data</h3>
                            </div>
                            <div class="card-body">
                                <div class="row pt-2 bg-gray-light">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="insured_name">Date of Loss</label>
                                            <input type="text" class="form-control datetimepicker-input"
                                                id="dateOfLoss" data-toggle="datetimepicker" data-target="#dateOfLoss"
                                                name="dateOfLoss" placeholder="Date of Loss" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="insured_name">Location of Loss</label>
                                            <textarea class="form-control" rows="3" style="width: 100%;" id="locationOfLoss" name="locationOfLoss"
                                                placeholder="Location of Loss" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="insured_name">Report Date</label>
                                            <input type="text" class="form-control datetimepicker-input"
                                                id="reportDate" data-toggle="datetimepicker" data-target="#reportDate"
                                                name="reportDate" placeholder="Report Date" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="insured_name">Report Source</label>
                                            <textarea class="form-control" rows="3" style="width: 100%;" id="reportSource" name="reportSource"
                                                placeholder="Report Source" required></textarea>
                                        </div>

                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="insured_name">Type of Cover</label>
                                            <select class="form-control select2bs4" id="cobId" name="cobId"
                                                style="width: 100%;" required>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="insured_name">Cause of Loss</label>
                                            <select class="form-control select2bs4" id="causeId" name="causeId"
                                                style="width: 100%;" required>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="insured_name">Loss Adjuster</label>
                                            <select class="form-control select2bs4" id="lossAdjId" name="lossAdjId"
                                                style="width: 100%;" required>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="insured_name">Workshop</label>
                                            <select class="form-control select2bs4" id="workshopId" name="workshopId"
                                                style="width: 100%;" required>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="insured_name">Currency</label>
                                            <select class="form-control select2bs4" id="currId" name="currId"
                                                style="width: 100%;" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="insured_name">Estimation Amount</label>
                                            <input type="text" class="form-control money count-amount" id="estAmt"
                                                name="estAmt" placeholder="Estimation Amount" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="insured_name">Claim Amount</label>
                                            <input type="text" class="form-control money count-amount" id="claimAmt"
                                                name="claimAmt" placeholder="Claim Amount" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="insured_name">Deduction Amount</label>
                                            <input type="text" class="form-control money count-amount" id="deducAmt"
                                                name="deducAmt" placeholder="Deduction Amount" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="insured_name">Recovery Amount</label>
                                            <input type="text" class="form-control money count-amount"
                                                id="recoveryAmt" name="recoveryAmt" placeholder="Recovery Amount"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="insured_name">Net Claim Amount</label>
                                            <div class="input-group">
                                                <div class="input-group-append">
                                                    <span class="input-group-text border-right-0">
                                                        <i class="fas fa-sync-alt fa-spin font-weight-bold text-black loadingIndicator"
                                                            style="display: none;font-size:18px"></i>
                                                    </span>
                                                </div>
                                                <input type="text"
                                                    class="form-control money count-amount border-left-0" id="netClaimAmt"
                                                    name="netClaimAmt" placeholder="Net Amount" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="uploadform">
                                            <div class="form-group">
                                                <label for="client">upload document</label><br>
                                                <input type="file" id="fileInputupd" class="form-control files"
                                                    name="fileInputupd[]" style="padding: 4px;display:none;" multiple>
                                                <div id="opt"></div>
                                                <a class="btn btn-primary btn-sm btnfilesupd" style="color: #fff"><i
                                                        class="fa fa-upload mr-1"></i> Choose Document</a>
                                                <small>Press CTRL to select multiple documents</small>
                                            </div>
                                            <ul id="listfilesupd"></ul>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="insured_name" class="mb-1">uploaded attachments</label>
                                            <ul id="listUpload"></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="overlayClientData" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                                <div class="text-bold pt-2">Loading...</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12" id="dataAmount">
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
                                                <tr class="bg-primary">
                                                    <th>Insurance Name</th>
                                                    <th>Share (%)</th>
                                                    <th>Claim Amount</th>
                                                    <th>Deduction Amount</th>
                                                    <th>Recovery Amount</th>
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
                                <button id="btnSaveAll" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Save Edit
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
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
    <script src="{{ asset('storage/claim/claimEdit.js') }}"></script>
@endpush
