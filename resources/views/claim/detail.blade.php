@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Claim No.</b> <span id="headClaimNo"></span></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Claim Detail</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <style type="text/css">
        div.form-group label {
            text-transform: uppercase;
        }
    </style>
    <input type="text" name="claimId" id="claimId" value="{{ request()->claimId }}" hidden>
    <div class="content">
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
                {{-- claim data --}}
                <div class="col-12" id="clientData">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Claim Data</h3>
                        </div>
                        <div class="card-body">
                            <div class="row pt-2 bg-gray-light">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of Loss</label>
                                        <p id="dateofLoss"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Location of Loss</label>
                                        <p id="location"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Report Date</label>
                                        <p id="reportDate"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Report Source</label>
                                        <p id="reportSource"></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Claim No.</label>
                                        <p id="claimNo"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Cause of Loss</label>
                                        <p id="causedDesc"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Loss Adjuster</label>
                                        <p id="lossAdjusterDesc"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Workshop</label>
                                        <p id="workshopDesc"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Currency</label>
                                        <p id="currDesc"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Estimation Amount</label>
                                        <p id="estAmt"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Claim Amount</label>
                                        <p id="claimAmt"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Deduction Amount</label>
                                        <p id="deductAmt"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Recovery Amount</label>
                                        <p id="recvAmt"></p>
                                    </div>
                                    <div class="form-group">
                                        <label>Net Claim Amount</label>
                                        <p id="netAmt"></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Uploaded Attachment</label>
                                        <ul id="uploadedAttachment"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="overlayClientData" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                        </div>
                    </div>
                </div>
                {{-- data amount --}}
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
                                                <th>Paid Date</th>
                                                <th>Aging</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="overlayDataAmount" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                        </div>
                    </div>
                </div>
                {{-- log status --}}
                <div class="col-12" id="logStatus">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">Log Status</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <table id="tblogStatus" class="table table-bordered table-hover text-nowrap"
                                        style="width: 100%">
                                        <thead>
                                            <tr class="bg-primary">
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Aging</th>
                                                <th>Description</th>
                                                <th>User</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div id="overlayLogStatus" class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                /* Add this CSS to your stylesheet or within a style tag in the head of your HTML document */
                @keyframes shake {
                    0% {
                        transform: translateX(0);
                    }

                    20% {
                        transform: translateX(-5px) rotate(-5deg);
                    }

                    40% {
                        transform: translateX(5px) rotate(5deg);
                    }

                    60% {
                        transform: translateX(-5px) rotate(-5deg);
                    }

                    80% {
                        transform: translateX(5px) rotate(5deg);
                    }

                    100% {
                        transform: translateX(0) rotate(0);
                    }
                }

                @keyframes spin {
                    100% {
                        transform: rotate(360deg);
                    }
                }

                @keyframes spin-reverse {
                    100% {
                        transform: rotate(-360deg);
                    }
                }

                .btn i {
                    transition: transform 0.3s ease;
                    /* Adding transition effect */
                }

                .shake:hover i {
                    animation: shake 0.5s ease;
                    /* Apply shake animation on hover */
                }

                .spin:hover i {
                    animation: spin 0.8s linear;
                    /* Apply spin animation on hover */
                }

                .spin-reverse:hover i {
                    animation: spin-reverse 0.8s linear;
                    /* Apply spin-reverse animation on hover */
                }
            </style>

            <div class="card card-primary card-outline">
                <div class="card-footer text-right" id="cardForButton">

                    <button type="button" id="btnRollbackStatus" class="btn btn-danger my-1 spin-reverse"
                        style="display: none">
                        <i class="fas fa-undo-alt mr-1"></i> Rollback Status
                    </button>

                    <a href="/claim/update/{{ request()->claimId }}" id="btnEdit" class="btn btn-info my-1 shake"
                        style="display: none">
                        <i class="fas fa-edit mr-1"></i> Edit Data
                    </a>

                    <button type="button" id="btnOnProcess" class="btn btn-primary my-1 spin" data-toggle="modal"
                        data-target="#modal-onpro" style="display: none">
                        <i class="fas fa-cog mr-1"></i> On Process
                    </button>

                    <button type="button" id="btnProposeAdjustment" class="btn bg-purple my-1 shake"
                        data-toggle="modal" data-target="#modal-lod" style="display: none">
                        <i class="fas fa-sliders-h mr-1"></i> Propose Adjustment
                    </button>

                    <button type="button" id="btnSettled" class="btn bg-teal my-1 shake" data-toggle="modal"
                        data-target="#modal-settled" style="display: none">
                        <i class="fas fa-money-check-alt mr-1"></i> Settled
                    </button>

                    <button type="button" id="btnUpdatePembayaran" class="btn bg-olive my-1 shake" data-toggle="modal"
                        data-target="#modal-paid" style="display: none">
                        <i class="fas fa-edit mr-1"></i> Update Pembayaran Klaim
                    </button>

                    <button type="button" id="btnProcessFinal" class="btn btn-success my-1 shake" data-toggle="modal"
                        data-target="#modal-paidAll" style="display: none">
                        <i class="fas fa-vote-yea mr-1"></i> Process Final
                    </button>

                    <button type="button" id="btnAddRecovery" class="btn bg-maroon my-1 shake" data-toggle="modal"
                        data-target="#modal-recv" style="display: none">
                        <i class="fas fa-medkit mr-1"></i> Add Recovery
                    </button>

                    <button type="button" id="btnFinal" class="btn bg-success my-1 shake" data-toggle="modal"
                        data-target="#modal-final" style="display: none">
                        <i class="fas fa-vote-yea mr-1"></i> Final
                    </button>

                    <button type="button" id="btnKlaimDitolak" class="btn bg-danger my-1 shake" data-toggle="modal"
                        data-target="#modal-tolak" style="display: none">
                        <i class="fas fa-window-close mr-1"></i> Klaim Ditolak
                    </button>
                </div>
            </div>
        </div>
        <!-- /.box -->

        <div class="modal fade" id="modal-edit-stat">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Status</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fas fa-times text-white font-weight-bolder"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" id="log-id" name="log-id">
                            <label for="ddOnPro">Pilih</label>
                            <select class="form-control select2" id="ddStatus" name="ddStatus" style="width: 100%;">
                                <option selected disabled>-</option>
                                <option value="1">Laporan Awal Klaim</option>
                                <option value="2">Kelengkapan Dokumen</option>
                                <option value="3">Proses Klaim Asuransi</option>
                                <option value="4">Propose adjusment</option>
                                <option value="5">Settled</option>
                                <option value="6">Proses Klaim Dibayar</option>
                                <option value="7">Proses Final</option>
                                <option value="8">Final</option>
                                <option value="9">Klaim Ditolak</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="editStat();">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-onpro">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h4 class="modal-title">On Process</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fas fa-times text-white font-weight-bolder"></span>
                        </button>
                    </div>
                    <form role="form" method="post" id="formOnProcess" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="ddOnPro">Pilih</label>
                                <select class="form-control select2" id="ddOnPro" name="ddOnPro" style="width: 100%;"
                                    required>
                                    <option selected disabled value="">-</option>
                                    <option value="2">Kelengkapan Dokumen</option>
                                    <option value="3">Proses Klaim Asuransi</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="descOnPro">Description</label>
                                <textarea class="form-control" rows="3" style="width: 100%;" id="descOnPro" name="descOnPro" required></textarea>
                            </div>
                            <div class="form-group">
                                <div id="uploadform">
                                    <div class="form-group">
                                        <label for="fileInputupd">Upload File</label><br>
                                        <input type="file" id="fileInputupd" class="form-control"
                                            name="fileInputupd[]" style="padding: 4px;display:none;" multiple>
                                        <a class="btn btn-primary btn-sm btnfilesupd" style="color: #fff"><i
                                                class="fa fa-upload"></i> Pilih File</a>
                                        <small>Tekan CTRL untuk memilih beberapa file</small>
                                        <ul class="listfilesupd"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-lod">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-purple">
                        <h4 class="modal-title">Propose Adjustment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fas fa-times text-white font-weight-bolder"></span>
                        </button>
                    </div>
                    <form role="form" method="post" id="formProposeAdjustment" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="descPorposeAdjustment">Description</label>
                                <textarea class="form-control" rows="3" style="width: 100%;" id="descPorposeAdjustment"
                                    name="descPorposeAdjustment" required></textarea>
                            </div>
                            <div class="form-group">
                                <div id="uploadform">
                                    <div class="form-group">
                                        <label for="filePurposeAdjustment">Upload File</label><br>
                                        <input type="file" id="filePurposeAdjustment" class="form-control"
                                            name="fileInputupd[]" style="padding: 4px;display:none;" multiple>
                                        <a class="btn btn-primary btn-sm btnfilesupd" style="color: #fff"><i
                                                class="fa fa-upload"></i> Pilih File</a>
                                        <small>Tekan CTRL untuk memilih beberapa file</small>
                                        <ul class="listfilesupd"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-paid">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-olive">
                        <h4 class="modal-title">Pembayaran Asuransi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fas fa-times text-white font-weight-bolder"></span>
                        </button>
                    </div>
                    <form role="form" method="post" id="formPembayaranAsuransi" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group clearfix">
                                <label>Insurance</label>
                                <div id="listInsurance">

                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dateIns">Paid Date</label>
                                <input type="text" class="form-control datetimepicker-input" id="dateIns"
                                    data-toggle="datetimepicker" data-target="#dateIns" name="dateIns"
                                    placeholder="Paid Dates" required>
                            </div>
                            <div class="form-group">
                                <div id="uploadform">
                                    <div class="form-group">
                                        <label for="fileInputupd">Upload File</label><br>
                                        <input type="file" id="fileInputupd" class="form-control"
                                            name="fileInputupd[]" style="padding: 4px;display:none;" multiple>
                                        <a class="btn btn-primary btn-sm btnfilesupd" style="color: #fff"><i
                                                class="fa fa-upload"></i> Pilih File</a>
                                        <small>Tekan CTRL untuk memilih beberapa file</small>
                                        <ul class="listfilesupd"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-paidAll">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title">Proses Final</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fas fa-times text-white font-weight-bolder"></span>
                        </button>
                    </div>
                    <form role="form" method="post" id="formProsesFinal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="descProsesFinal">Description</label>
                                <textarea class="form-control" rows="3" style="width: 100%;" id="descProsesFinal" name="descProsesFinal"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-settled">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-teal">
                        <h4 class="modal-title">Settled</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fas fa-times text-white font-weight-bolder"></span>
                        </button>
                    </div>
                    <form role="form" method="post" id="formSettled" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <p>Description</p>
                                <textarea class="form-control" rows="3" style="width: 100%;" id="descSet" name="descSet" required></textarea>
                            </div>
                            <div class="form-group">
                                <div id="uploadform">
                                    <div class="form-group">
                                        <label for="fileInputupd">Upload File</label><br>
                                        <input type="file" id="fileInputupd" class="form-control"
                                            name="fileInputupd[]" style="padding: 4px;display:none;" multiple>
                                        <a class="btn btn-primary btn-sm btnfilesupd" style="color: #fff"><i
                                                class="fa fa-upload"></i> Pilih File</a>
                                        <small>Tekan CTRL untuk memilih beberapa file</small>
                                        <ul class="listfilesupd"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- /.modal -->
        <div class="modal fade" id="modal-final">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-success">
                        <h4 class="modal-title">Final</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fas fa-times text-white font-weight-bolder"></span>
                        </button>
                    </div>
                    <form role="form" method="post" id="formFinal" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <p>Description</p>
                                <textarea class="form-control" rows="3" style="width: 100%;" id="descFinal" name="descFinal" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-tolak">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-danger">
                        <h4 class="modal-title">Klaim Ditolak</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fas fa-times text-white font-weight-bolder"></span>
                        </button>
                    </div>
                    <form role="form" method="post" id="formTolak" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="modal-body">
                            <div class="form-group">
                                <p>Description</p>
                                <textarea class="form-control" rows="3" style="width: 100%;" id="descTolak" name="descTolak" required></textarea>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-recv">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-pink">
                        <h4 class="modal-title">Add Recovery Amount</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fas fa-times text-white font-weight-bolder"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Recovery Amount</p>
                            <input class="form-control money" id="in_recv" type="text"
                                placeholder="Recovery Amount">
                            <input type="hidden" id="current-stat" name="current-stat" value="2">
                        </div>
                        <div class="form-group">
                            <p>Description</p>
                            <textarea class="form-control" rows="3" style="width: 100%;" id="descRecv" name="descRecv" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="addRecv();">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-upClaim">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Update Claim Amount</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="fas fa-times text-white font-weight-bolder"></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Claim Amount</p>
                            <input class="form-control money" id="in_upClaim" type="text" placeholder="Claim Amount">
                            <input type="hidden" id="current-stat" name="current-stat" value="2">
                        </div>
                        <div class="form-group">
                            <p>Deductible Amount</p>
                            <input class="form-control money" id="in_upDeduct" type="text"
                                placeholder="Deductible Amount">
                            <input type="hidden" id="current-stat" name="current-stat" value="2">
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="updateClaim();">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->

    </div>
@endsection

@push('levelPluginsJsh')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
@endpush

@push('levelPluginsJs')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- custom js --}}
    <script src="{{ asset('storage/claim/claimDetail.js') }}"></script>
@endpush
