@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><b>Klaim</b> Detail</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">Klaim Detail</li>
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
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                        <div class="form-group">
                                            <label for="insured_name">Policy</label>
                                            <input type="text" class="form-control" id="c_policy" name="c_policy"
                                                placeholder="Policy" value="1809082200027 &amp; 1809082200028" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="insured_name">Type of Cover</label>
                                            <input type="text" class="form-control" id="c_type" name="c_type"
                                                placeholder="Type of Cover" value="CGL" readonly>
                                            <input class="form-control" type="text" id="c_cob" value="21" hidden>
                                        </div>
                                        <div class="form-group">
                                            <label for="insured_name">Insured Name</label>
                                            <input type="text" class="form-control" id="c_insured_name"
                                                name="c_insured_name" value="HYUNDAI MOTOR INDONESIA, PT" readonly>

                                        </div>
                                        <div class="form-group">
                                            <label for="insured_name">Period</label>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="c_period"
                                                        name="c_period" value="2022-12-31" readonly>
                                                </div>
                                                <div class="col-lg-6">
                                                    <input type="text" class="form-control" id="c_periodEnd"
                                                        name="c_periodEnd" value="2023-12-31" readonly>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="insured_name">Interest/Object Claim</label>
                                            <textarea class="form-control" rows="10" style="width: 100%;" id="c_interest" name="c_interest" readonly>Cover Comprehensive General Libility with Contractual Liability Insurance for All Hyundai Creta and Stargazer
# Installment 4 of 4 : IDR. 5,826,881,448.00</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="conditions-tab-view" role="tabpanel"
                            aria-labelledby="conditions-tab">
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
                    <h3 class="card-title">Claim Data</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6" style="border-right: 1px solid #ddd;">
                            <div class="form-group">
                                <label for="insured_name">Date of Loss</label>
                                <input type="text" class="form-control datepicker" id="date" name="date"
                                    placeholder="Date of Loss" required="true">
                                <input type="text" id="dol" value="2023-10-25" hidden>
                                <input type="text" class="form-control" id="dateInput" name="dateInput"
                                    value="13-11-2023" hidden>
                            </div>
                            <div class="form-group">
                                <label for="insured_name">Location of Loss</label>
                                <textarea class="form-control" rows="3" style="width: 100%;" id="location" name="location" required>Tol Jagorawi Km 6</textarea>
                            </div>
                            <div class="form-group">
                                <label for="insured_name">Cause of Loss</label>
                                <input type="text" id="caused" value="0" hidden>
                                <select class="form-control select2bs4" id="ddCaused" name="ddCaused"
                                    style="width: 100%;">
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputContact1">Loss Adjustment</label>
                                <select class="form-control select2bs4" id="ddLadj" name="ddLadj"
                                    style="width: 100%;">
                                    <option value="0" selected>-</option>
                                    <option value="1">PT. RADITA HUTAMA INTERNUSA</option>
                                    <option value="2">MATTHEWS DANIEL INTERNATIONAL, PTE.LTD</option>
                                    <option value="3">PT. MCLARENS INDONESIA</option>
                                    <option value="4">PT. SATRIA DHARMA PUSAKA CRAWFORD THG</option>
                                    <option value="5">PT. UTAMA NILAI SENTOSA</option>
                                    <option value="6">PT. AXIS INTERNATIONAL</option>
                                    <option value="7">PT. CUNNINGHAM LINDSAY</option>
                                    <option value="8">PT. PANDU HALIM PERKASA</option>
                                    <option value="9">PT. NIPPON KAIJI KYOKAI INDONESIA (NK3I)</option>
                                    <option value="10">PERSADA ADJUSTERS (PT. BAHTERA ARUNG PERSADA)</option>
                                    <option value="11">PT. ASUKA BAHARI NUSANTARA</option>
                                    <option value="12">PRIMA ADJUSTER</option>
                                    <option value="13">PT. GENERAL ADJUSTER INDONESIA</option>
                                    <option value="14">PT. GLOBAL INTERNUSA ADJUSTING</option>
                                    <option value="15">PT. RISWAN BRAHMANA MANDIRI SURVEI</option>
                                    <option value="16">UNIVERSAL NILAITAMA</option>
                                    <option value="17">PT ROYAL CONOCEAN INTERNATIONAL</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputContact1">Workshop</label>
                                <select class="form-control select2bs4" id="ddWs" name="ddWs"
                                    style="width: 100%;">
                                    <option value="0" selected>-</option>
                                    <option value="1">SUBUR OTO</option>
                                    <option value="2">NEW BERINGIN MOTOR</option>
                                    <option value="3">CITRA SIMA</option>
                                    <option value="4">METRO 55</option>
                                    <option value="5">CV. KARYA MURNI INDAH</option>
                                    <option value="6">CAR PRO</option>
                                    <option value="7">MUSTIKA MOBILINDO</option>
                                    <option value="8">KARINDA MOTOR</option>
                                    <option value="9">PIRASA KENCANA MOTOR</option>
                                    <option value="10">HONDA IKJ PONDOK PINANG</option>
                                    <option value="11">TARA MOTOR</option>
                                    <option value="12">MULIA MOTOR (LESTARI MULIA ABADI)</option>
                                    <option value="13">SUN MOTOR</option>
                                    <option value="14">GUNADAYA MOTOR</option>
                                    <option value="15">MULTIGUNA CEMERLANG</option>
                                    <option value="16">CAHAYA UTAMA MOTOR</option>
                                    <option value="17">ANTONA MOTOR</option>
                                    <option value="18">BAVARIA MERCINDO MOTOR</option>
                                    <option value="19">PANCA BUANA MOTOR</option>
                                    <option value="20">PRIMA MOBIL</option>
                                    <option value="21">CITRA CEMERLANG</option>
                                    <option value="22">PITSTOP</option>
                                    <option value="23">NEW AUTO BLITZ</option>
                                    <option value="24">TRIPANCAR JAYA</option>
                                    <option value="25">SMARINA</option>
                                    <option value="26">AUTO PRIMA</option>
                                    <option value="27">LIEF&#039;S ENGINEERING</option>
                                    <option value="28">AUTOCARE SPECIALIST</option>
                                    <option value="29">CITRA CEMERLANG SURABAYA</option>
                                    <option value="30">BINTANG JAYA</option>
                                    <option value="31">HANDAL MITRA PRAKARSA</option>
                                    <option value="32">CITRA AUTO MAKMUR SENTOSA</option>
                                    <option value="33">FONTANA INDAH MOTOR</option>
                                    <option value="34">MUTIARA JAYA MAKMUR</option>
                                    <option value="35">NV MASS</option>
                                    <option value="36">MANDIRI BUANA SENTOSA (MBS)</option>
                                    <option value="37">HONDA IKJ WR. BUNCIT</option>
                                    <option value="38">DHARMA MOTOR</option>
                                    <option value="39">ARMADA INTERNATIONAL MOTOR (DAIHATSU)</option>
                                    <option value="40">MERCINDO AUTORAMA</option>
                                    <option value="41">AUTO BLITZ (PEKANBARU)</option>
                                    <option value="42">METRO AUTO CARE</option>
                                    <option value="43">B2M MOTOR</option>
                                    <option value="44">BINTANG UTAMA</option>
                                    <option value="45">MAHKOTA BUANA</option>
                                    <option value="46">FASHION MOTOR</option>
                                    <option value="47">PARAMA SUTERA AUTOTREN (HONDA ALAM SUTERA)</option>
                                    <option value="48">BUMEN REJA ABADI (MITSUBISHI MOTOR)</option>
                                    <option value="49">GARUDA MOTOR BENGKEL</option>
                                    <option value="50">NICO BODY REPAIR</option>
                                    <option value="51">FRIEND&#039;S (BODY REPAIR &amp; PAINT SPECIALIST)</option>
                                    <option value="52">BENGKEL HONDA ARTA CIKUPA</option>
                                    <option value="53">NAGA MAS MOTOR</option>
                                    <option value="54">DUA SEKAWAN MOTOR</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="insured_name">Estimation Amount</label>
                                <input class="form-control uang" id="c_amount" data-amt="310000000.0000000"
                                    type="text" placeholder="" value="310,000,000" required="true"
                                    onkeyup="amount();">
                            </div>
                            <div class="form-group">
                                <label for="insured_name">Claim Amount</label>
                                <input class="form-control uang" id="c_claim" data-amt="310000000.0000000"
                                    type="text" placeholder="" value="310,000,000" onkeyup="amount();">
                            </div>
                            <div class="form-group">
                                <label for="insured_name">Deduction Amount</label>
                                <input class="form-control uang" id="c_deduct" data-amt="" type="text"
                                    placeholder="" value="0" onkeyup="amount();">
                            </div>
                            <div class="form-group">
                                <label for="insured_name">Recovery Amount</label>
                                <input class="form-control uang" id="c_recv" data-amt="" type="text"
                                    placeholder="" value="0" onkeyup="amount();">
                            </div>
                            <div class="form-group">
                                <label for="insured_name">Net Claim Amount</label>
                                <input class="form-control uang" id="c_net" data-amt="310000000.0000000"
                                    type="text" placeholder="" value="310,000,000" onkeyup="amount();">
                            </div>
                        </div>
                    </div>
                </div>
                <form>
                    <input type="text" value="8423" id="klaimId" style="display: none;">

                </form>

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

                            <table class="table table-bordered table-striped table-hover dataTable" id="tableklaim">
                                <thead>
                                    <tr>
                                        <th>Insurance Name</th>
                                        <th>Share (%)</th>
                                        <th>Claim Amount</th>
                                        <th>Deduction</th>
                                        <th>Recovery</th>
                                        <th>Net Amount</th>
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
                                    </tr>

                                </tbody>
                            </table>


                        </div>
                    </div>
                </div>

                <div class="card-footer" style="text-align: right;">
                    <button class="btn btn-primary" onclick="submit();"><i class="fas fa-edit"></i> Save Edit</button>
                </div>

            </div>
        </div>
        <!-- /.box -->
    </div>
@endsection
