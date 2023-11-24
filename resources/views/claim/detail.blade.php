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
                                                <th>Estimate Amount</th>
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
                                                <td>#</td>
                                                <td>Tanggal</td>
                                                <td>Status</td>
                                                <td>Aging</td>
                                                <td>Deskripsi</td>
                                                <td>User</td>
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

            <div class="card card-primary card-outline">
                <div class="card-footer col-md-12" style="text-align: right;">

                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lod">
                        Propose Adjustment
                    </button>
                    <button class="btn btn-primary" onclick="location.href='/claim/update/4232'"><i
                            class="fas fa-edit"></i> Edit Data</button>

                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-onpro">
                        On Process
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
                            <span aria-hidden="true">&times;</span>
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
                    <div class="modal-header">
                        <h4 class="modal-title">On Process</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="ddOnPro">Pilih</label>
                            <select class="form-control select2" id="ddOnPro" name="ddOnPro" style="width: 100%;">
                                <option selected disabled>-</option>
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
                                <form role="form" method="post" id="formupd" enctype="multipart/form-data">
                                    <input type="hidden" name="_token"
                                        value="yatXjyMg2tbO2qrUlxtmAmeVpA0VP65drKzFn5EY">
                                    <div class="form-group">
                                        <label for="client">Upload File</label><br>
                                        <input type="file" id="fileInputupd" class="form-control"
                                            name="fileInputupd[]" style="padding: 4px;display:none;" multiple>
                                        <div id="opt"></div>
                                        <input type="hidden" id="dataid" name="dataid" value="8423">
                                        <input type="hidden" id="cob" name="cob" value="CGL">
                                        <input type="hidden" id="stat" name="stat" value="2">
                                        <a class="btn btn-primary btn-sm btnfilesupd" style="color: #fff"><i
                                                class="fa fa-upload"></i> Pilih File</a>
                                        <small>Tekan CTRL untuk memilih beberapa file</small>
                                        <ul id="listfilesupd"></ul>
                                    </div>
                                    <input type="submit" id="uploadupdbtn" style="display: none;">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="proses(1);">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-lod">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Propose Adjustment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="deduction">Description</label>
                            <textarea class="form-control" rows="3" style="width: 100%;" id="descLod" name="descLod" required></textarea>
                        </div>

                        <div class="form-group">
                            <div id="uploadform">
                                <form role="form" method="post" id="formupd" enctype="multipart/form-data">
                                    <input type="hidden" name="_token"
                                        value="yatXjyMg2tbO2qrUlxtmAmeVpA0VP65drKzFn5EY">
                                    <div class="form-group">
                                        <label for="client">Upload File</label><br>
                                        <input type="file" id="fileInputupd" class="form-control"
                                            name="fileInputupd[]" style="padding: 4px;display:none;" multiple>
                                        <div id="opt"></div>
                                        <input type="hidden" id="dataid" name="dataid" value="8423">
                                        <input type="hidden" id="cob" name="cob" value="CGL">
                                        <input type="hidden" id="stat" name="stat" value="4">
                                        <a class="btn btn-primary btn-sm btnfilesupd" style="color: #fff"><i
                                                class="fa fa-upload"></i> Pilih File</a>
                                        <small>Tekan CTRL untuk memilih beberapa file</small>
                                        <ul id="listfilesupd"></ul>
                                    </div>
                                    <input type="submit" id="uploadupdbtn" style="display: none;">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="proses(4);">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-paid">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Pembayaran Asuransi</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group clearfix">
                            <label for="deduction">Insurance</label><br>
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" name="cbIns" class="cekbok" id="cbIns16476"
                                    data-crtName="LIPPO GENERAL INSURANCE TBK, PT" value="16476">
                                <label for="cbIns">LIPPO GENERAL INSURANCE TBK, PT</label><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="descIns">Paid Date</label>
                            <input type="text" class="form-control datepicker" id="dateIns" name="dateIns"
                                placeholder="Paid Date" required="true">
                        </div>
                        <div class="form-group">
                            <div id="uploadform">
                                <form role="form" method="post" id="formupd" enctype="multipart/form-data">
                                    <input type="hidden" name="_token"
                                        value="yatXjyMg2tbO2qrUlxtmAmeVpA0VP65drKzFn5EY">
                                    <div class="form-group">
                                        <label for="client">Upload File</label><br>
                                        <input type="file" id="fileInputupd" class="form-control"
                                            name="fileInputupd[]" style="padding: 4px;display:none;" multiple>
                                        <div id="opt"></div>
                                        <input type="hidden" id="dataid" name="dataid" value="8423">
                                        <input type="hidden" id="cob" name="cob" value="CGL">
                                        <input type="hidden" id="stat" name="stat" value="6">
                                        <a class="btn btn-primary btn-sm btnfilesupd" style="color: #fff"><i
                                                class="fa fa-upload"></i> Pilih File</a>
                                        <small>Tekan CTRL untuk memilih beberapa file</small>
                                        <ul id="listfilesupd"></ul>
                                    </div>
                                    <input type="submit" id="uploadupdbtn" style="display: none;">
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="proses(6);">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-paidAll">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Proses Final</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="descPaidAll">Description</label>
                            <textarea class="form-control" rows="3" style="width: 100%;" id="descPaidAll" name="descPaidAll" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="proses(7);">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->
        <div class="modal fade" id="modal-settled">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Settled</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Description</p>
                            <textarea class="form-control" rows="3" style="width: 100%;" id="descSet" name="descSet" required></textarea>
                        </div>
                        <div class="form-group">
                            <div id="uploadform">
                                <form role="form" method="post" id="formupd" enctype="multipart/form-data">
                                    <input type="hidden" name="_token"
                                        value="yatXjyMg2tbO2qrUlxtmAmeVpA0VP65drKzFn5EY">
                                    <div class="form-group">
                                        <label for="client">Upload File</label><br>
                                        <input type="file" id="fileInputupd" class="form-control"
                                            name="fileInputupd[]" style="padding: 4px;display:none;" multiple>
                                        <div id="opt"></div>
                                        <input type="hidden" id="dataid" name="dataid" value="8423">
                                        <input type="hidden" id="cob" name="cob" value="CGL">
                                        <input type="hidden" id="stat" name="stat" value="5">
                                        <a class="btn btn-primary btn-sm btnfilesupd" style="color: #fff"><i
                                                class="fa fa-upload"></i> Pilih File</a>
                                        <small>Tekan CTRL untuk memilih beberapa file</small>
                                        <ul id="listfilesupd"></ul>
                                    </div>
                                    <input type="submit" id="uploadupdbtn" style="display: none;">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="proses(5);">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- /.modal -->
        <div class="modal fade" id="modal-final">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Final</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Description</p>
                            <textarea class="form-control" rows="3" style="width: 100%;" id="descFinal" name="descFinal" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="proses(8);">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-tolak">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Klaim Ditolak</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Description</p>
                            <textarea class="form-control" rows="3" style="width: 100%;" id="descTolak" name="descTolak" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="proses(9);">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-recv">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Recovery Amount</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Recovery Amount</p>
                            <input class="form-control uang" id="in_recv" type="text"
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
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <p>Claim Amount</p>
                            <input class="form-control uang" id="in_upClaim" type="text" placeholder="Claim Amount">
                            <input type="hidden" id="current-stat" name="current-stat" value="2">
                        </div>
                        <div class="form-group">
                            <p>Deductible Amount</p>
                            <input class="form-control uang" id="in_upDeduct" type="text"
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
@endpush

@push('levelPluginsJs')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    {{-- custom js --}}
    <script src="{{ asset('storage/claim/claimDetail.js') }}"></script>
@endpush
