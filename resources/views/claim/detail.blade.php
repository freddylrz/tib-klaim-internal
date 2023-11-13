@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Claim No.</b> CB0097/TIB/1123/CGL</h1>
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
            text-decoration: underline;
        }
    </style>
    <input type="text" name="klaim_id" id="klaim_id" value="8423" hidden>
    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-tabs" id="c_info">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="interest-insured-tab" data-toggle="pill"
                                href="#interest-insured-tab-view" role="tab" aria-controls="interest-insured-tab-view"
                                aria-selected="true">Client Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="conditions-tab" data-toggle="pill" href="#conditions-tab-view"
                                role="tab" aria-controls="conditions-tab-view" aria-selected="false">Premium Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="main-exclusion-tab" data-toggle="pill" href="#main-exclusion-tab-view"
                                role="tab" aria-controls="main-exclusion-tab-view" aria-selected="false">D/N Info</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade show active" id="interest-insured-tab-view" role="tabpanel"
                            aria-labelledby="interest-insured-tab">
                            <div class="row">
                                <div class="col-md-6" style="border-right: 1px solid #ddd;">

                                    <div class="form-group">
                                        <label for="insured_name"><u>Policy</u></label>
                                        <p>1809082200027 &amp; 1809082200028</p>
                                        <input type="text" class="form-control" id="c_policy" name="c_policy"
                                            value="1809082200027 &amp; 1809082200028" placeholder="Policy" hidden="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="insured_name"><u>Type of Cover</u></label>
                                        <p>CGL</p>
                                        <input type="text" class="form-control" id="c_type" name="c_type"
                                            placeholder="Type of Cover" value="CGL" hidden="true">
                                    </div>
                                    <div class="form-group">
                                        <label for="insured_name"><u>Insured Name</u></label>
                                        <p>HYUNDAI MOTOR INDONESIA, PT</p>
                                        <input type="text" class="form-control" id="c_insured_name" name="c_insured_name"
                                            value="HYUNDAI MOTOR INDONESIA, PT" hidden="true">

                                    </div>
                                    <div class="form-group">
                                        <label for="insured_name"><u>Period</u></label>
                                        <p>31 December 2022 <b>TO</b> 31 December 2023</p>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="text" class="form-control" id="c_period" name="c_period"
                                                    value="2022-12-31" hidden="true">
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <input type="text" class="form-control" id="c_periodEnd"
                                                    name="c_periodEnd" value="2023-12-31" hidden="true">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="insured_name"><u>Interest/Object Claim</u></label>
                                        <p>Cover Comprehensive General Libility with Contractual Liability Insurance for
                                            All Hyundai Creta and Stargazer
                                            # Installment 4 of 4 : IDR. 5,826,881,448.00</p>
                                        <textarea class="form-control" rows="10" style="width: 100%; white-space: pre-wrap;" id="c_interest"
                                            name="c_interest" hidden="true">Cover Comprehensive General Libility with Contractual Liability Insurance for All Hyundai Creta and Stargazer
# Installment 4 of 4 : IDR. 5,826,881,448.00</textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="conditions-tab-view" role="tabpanel"
                            aria-labelledby="conditions-tab">
                            <table class="table">
                                <thead>
                                    <tr style="border-style: solid none solid none; text-align: right;">
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
                                    <tr>
                                        <td colspan="7"><b>HYUNDAI MOTOR INDONESIA, PT</b></td>
                                    </tr>
                                    <tr style="text-align: right;">
                                        <td>&nbsp;</td>
                                        <td>12306004.01</td>
                                        <td>&nbsp;</td>
                                        <td>2023-07-31</td>
                                        <td>5,826,881,448.00</td>
                                        <td> - </td>
                                        <td>5,826,881,448.00</td>
                                    </tr>
                                    <tr style="text-align: right;">
                                        <td>&nbsp;</td>
                                        <td>12306004.01</td>
                                        <td>MEP231149</td>
                                        <td>2023-07-07</td>
                                        <td> - </td>
                                        <td>5,826,881,448.00</td>
                                        <td>0.00</td>
                                    </tr>


                                    <tr style="text-align: right; border-bottom: solid; border-bottom-color: #808080">
                                        <td colspan="4">&nbsp;</td>
                                        <td>5,826,881,448.00</td>
                                        <td>5,826,881,448.00</td>
                                        <td>0.00</td>
                                    </tr>


                                    <tr>
                                        <td colspan="7"></td>
                                    </tr>
                                    <tr style="border-top: solid; border-top-color: #808080">
                                        <td colspan="7"><b>LIPPO GENERAL INSURANCE TBK, PT</b></td>
                                    </tr>
                                    <tr style="text-align: right;">
                                        <td>&nbsp;</td>
                                        <td>12306004.01</td>
                                        <td>&nbsp;</td>
                                        <td>2023-01-31 00:00:00</td>
                                        <td>5,098,521,267.00</td>
                                        <td> - </td>
                                        <td>5,098,521,267.00</td>
                                    </tr>

                                    <tr style="text-align: right;">
                                        <td>&nbsp;</td>
                                        <td>12306004.01</td>
                                        <td>PV231332</td>
                                        <td>2023-07-13</td>
                                        <td> - </td>
                                        <td>5,098,521,267.00</td>
                                        <td>0.00</td>
                                    </tr>



                                    <tr style="text-align: right; border-bottom: solid; border-bottom-color: #808080">
                                        <td colspan="4">&nbsp;</td>
                                        <td>5,098,521,267.00</td>
                                        <td>5,098,521,267.00</td>
                                        <td>0.00</td>
                                    </tr>










                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="main-exclusion-tab-view" role="tabpanel"
                            aria-labelledby="main-exclusion-tab">
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>

            <div class="card card-primary card-outline" id="dataKlaim">
                <div class="card-header">
                    <h3 class="card-title"><b>Claim </b>Data</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" style="border-right: 1px solid #ddd;">
                            <div class="form-group">
                                <label for="insured_name">Claim No.</label>
                                <p>CB0097/TIB/1123/CGL</p>
                            </div>
                            <div class="form-group">
                                <label for="insured_name"><u>Date of Loss</u></label>
                                <p>2023-10-25</p>
                                <input class="form-control" id="inputContact1" type="text" placeholder=""
                                    value="2023-10-25" hidden="true">
                            </div>
                            <div class="form-group">
                                <label for="insured_name"><u>Location of Loss</u></label>
                                <p>Tol Jagorawi Km 6</p>
                                <input class="form-control" id="inputContact1" type="text" placeholder=""
                                    value="Tol Jagorawi Km 6" hidden="true">
                            </div>
                            <div class="form-group">
                                <label for="insured_name"><u>Cause of Loss</u></label>
                                <p>-</p>
                                <input class="form-control" id="inputContact1" type="text" placeholder=""
                                    value="-" hidden="true">
                            </div>
                            <div class="form-group">
                                <label for="insured_name"><u>Loss Adjuster</u></label>
                                <p>-</p>
                                <input class="form-control" id="inputContact1" type="text" placeholder=""
                                    value="-" hidden="true">
                            </div>
                            <div class="form-group">
                                <label for="insured_name"><u>Workshop</u></label>
                                <p>-</p>
                                <input class="form-control" id="inputContact1" type="text" placeholder=""
                                    value="-" hidden="true">
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="insured_name"><u>Estimation Amount</u></label>
                                <p>IDR 310,000,000</p>
                                <input class="form-control" id="est_amt" type="text" placeholder=""
                                    value="310,000,000" hidden="true">
                            </div>
                            <div class="form-group">
                                <label for="insured_name"><u>Claim Amount</u></label>
                                <p>IDR 310,000,000</p>
                                <input class="form-control" id="claim_amt" type="text" placeholder=""
                                    value="310,000,000" hidden="true">
                            </div>
                            <div class="form-group">
                                <label for="insured_name"><u>Deduction Amount</u></label>
                                <p>IDR 0</p>
                                <input class="form-control" id="deduct_amt" type="text" placeholder=""
                                    value="0" hidden="true">
                            </div>
                            <div class="form-group">
                                <label for="insured_name"><u>Recovery Amount</u></label>
                                <p>IDR 0</p>
                                <input class="form-control" id="inputContact1" type="text" placeholder=""
                                    value="0" hidden="true">
                            </div>
                            <div class="form-group">
                                <label for="insured_name"><u>Net Claim Amount</u></label>
                                <p>IDR 310,000,000</p>
                                <input class="form-control" id="net_amt" type="text" placeholder=""
                                    value="310,000,000" hidden="true">
                            </div>
                            <div class="form-group">
                                <label for="txtRequestNotes"><u>Uploaded Attachment</u></label><br>
                                <p><a href="https://klaimapp.tib.co.id/upload/CGL/8423/Data stargazer.pdf"
                                        target="_blank">1. Data stargazer.pdf</a></p>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div id="uploadform">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card card-primary card-outline" id="dataAmount">
                <div class="card-header">
                    <h3 class="card-title"><b>Claim</b> Amount</h3>
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

                            <table class="table table-bordered table-striped table-hover dataTable" id="tableklaim">
                                <thead>
                                    <tr>
                                        <th>Insurance Name</th>
                                        <th>Share (%)</th>
                                        <th>Claim Amount</th>
                                        <th>Deduction</th>
                                        <th>Recovery</th>
                                        <th>Net Amount</th>
                                        <th>Payment Date</th>
                                        <th>Aging</th>
                                        <!-- <th>&nbsp;</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>LIPPO GENERAL INSURANCE TBK, PT</td>
                                        <td style="text-align: right;">100</td>
                                        <td style="text-align: right;">310,000,000</td>
                                        <td style="text-align: right;">0</td>
                                        <td style="text-align: right;">0</td>
                                        <td style="text-align: right;">310,000,000</td>
                                        <td style="text-align: right;"></td>
                                        <td style="text-align: right;">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box -->
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title"><b>Log</b> Status</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <td>Tanggal</td>
                                <td>Status</td>
                                <td>Aging</td>
                                <td>Deskripsi</td>
                                <td>User</td>
                                <td>&nbsp;</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td hidden="true">33877</td>
                                <td>2023-11-01 14:59</td>
                                <td>Laporan awal klaim</td>
                                <td>12</td>
                                <td></td>
                                <td>DOFAN -</td>
                                <td>
                                </td>
                            </tr>
                            <tr>
                                <td hidden="true">33878</td>
                                <td>2023-11-01 15:00</td>
                                <td>Proses kelengkapan dokumen</td>
                                <td>12</td>
                                <td>B 1521 RKZ- Baru laporan awal, masih menunggu kelengkapan dokumen lainnya</td>
                                <td>DOFAN -</td>
                                <td>
                                </td>
                            </tr>
                        </tbody>
                    </table>

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
