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
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="insured_name">COB</label>
                                <select class="form-control select2bs4" style="width: 100%;" id="cob_id" name="cob_id">
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
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="insured_name">Status</label>
                                <select class="form-control select2bs4" style="width: 100%;" id="status" name="status">
                                    <option value="0" selected="selected">Semua Status</option>
                                    <option value="1">Laporan awal klaim</option>
                                    <option value="2">Proses kelengkapan dokumen</option>
                                    <option value="3">Proses Klaim diasuransi</option>
                                    <option value="4">Propose adjusment</option>
                                    <option value="5">Settled</option>
                                    <option value="6">Proses Klaim Dibayar</option>
                                    <option value="7">Proses Final</option>
                                    <option value="8">Final</option>
                                    <option value="9">Ditolak</option>
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="">Loss Adjuster</label>
                                <select class="form-control select2bs4" style="width: 100%;" id="ladj_id" name="ladj_id">
                                    <option value="0" selected="selected">Semua Loss Adjuster</option>
                                    <option value="0">-</option>
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
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="">Workshop</label>
                                <select class="form-control select2bs4" style="width: 100%;" id="ws_id" name="ws_ids">
                                    <option value="0" selected="selected">Semua Workshop</option>
                                    <option value="0">-</option>
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
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="">Date from</label>
                                <input type="text" class="form-control datepicker" id="dateFrom" name="dateFrom"
                                    placeholder="Date From" required="true">
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <div class="form-group">
                                <label for="">Date End</label>
                                <input type="text" class="form-control datepicker" id="dateEnd" name="dateEnd"
                                    placeholder="Date End" required="true">
                            </div>
                            <!-- /.form-group -->
                        </div>
                    </div>
                    <!-- /.col -->
                    <!-- /.row -->
                </div> <!-- /.card-body -->
                <div class="card-footer col-md-12" style="text-align: right;">
                    <button class="btn btn-primary" onclick="load();"><i class="fas fa-save"></i> Load</button>
                    <button class="btn btn-success" id="bt_export" onclick="exp();" disabled="true"><i
                            class="fas fa-file-download"></i> Export</button>
                </div>
            </div>
            <!-- /.row -->
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

            <div id="tabelreload">
                <div class="card border-dark mb-3">
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable" id="table_1">
                            <thead>
                                <tr class="table-primary">
                                    <!-- <th>No.</th> -->
                                    <th>No. Claim</th>
                                    <th>No. Polis</th>
                                    <th>Insured Name</th>
                                    <th>COB</th>
                                    <th>Inception Date</th>
                                    <th>Expired date</th>
                                    <th>Date Of loss</th>
                                    <!-- <th>Cause Of Loss</th> -->
                                    <th>Location Of Loss </th>
                                    <!-- <th>Workshop</th> -->
                                    <!-- <th>Adjuster</th> -->
                                    <th>Insurance Member</th>
                                    <th>Share</th>
                                    <th>Currency</th>
                                    <!-- <th>Currency Amount</th> -->
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
