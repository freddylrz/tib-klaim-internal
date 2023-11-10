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
                        <div class="card-header">
                            <h3 class="card-title">Data Client</h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group">
                                <div class="icheck-primary d-inline">
                                    <input type="checkbox" name="cbDesktop" id="cbDesktop" onclick="listData();">
                                    <label for="cbDesktop">Desktop</label><br>
                                </div>
                            </div>
                            <table id="tbsppa" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>D/N</th>
                                        <th>Polis</th>
                                        <th>Insured Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>544</td>
                                        <td>TIB/0222/MH/138544</td>
                                        <td>PT. WINDU KARSA <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>545</td>
                                        <td>TIB/0222/MH/138545</td>
                                        <td>TESTING OS IT-TEHNIK <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>546</td>
                                        <td>TIB/0222/MV/1322546</td>
                                        <td>LAJU TRANSPORTASI BERSAMA, CV <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>547</td>
                                        <td>TIB/0222/MV/1322547</td>
                                        <td>MODA TRANSPORT ABADI, CV <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>548</td>
                                        <td>TIB/0222/MV/1322548</td>
                                        <td>TRANSPORTASI LANCAR MAJU, CV <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>549</td>
                                        <td>TIB/0222/MH/138549</td>
                                        <td>TESTING OS IT-TEHNIK <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>550</td>
                                        <td>TIB/0222/PAR/161551</td>
                                        <td>DR. IRENA SAKURA RINI, MRS <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>551</td>
                                        <td>TIB/0222/PAR/161552</td>
                                        <td>HUSNI, MR <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>552</td>
                                        <td>TIB/0222/PAR/161553</td>
                                        <td>NUR ALAMSYAH, MR <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>553</td>
                                        <td>TIB/0222/PAR/161554</td>
                                        <td>SIVANANDA SARIPUTERA, MRS QQ BENJAMIN DWIJANTO, MR <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>554</td>
                                        <td>TIB/0222/PAR/161555</td>
                                        <td>MR. RIZUL SUDARMADI QQ MR. SUNU AYUDA <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>555</td>
                                        <td>TIB/0222/MV/1322555</td>
                                        <td>FRAGON BINA SUKSES, PT <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>556</td>
                                        <td>TIB/0222/MC/133556</td>
                                        <td>LAMINDO EKAPERDANA, PT AND/OR SELE RAYA BELIDA, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>557</td>
                                        <td>TIB/0222/CIS/39558</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK CIMB NIAGA, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>558</td>
                                        <td>TIB/0222/CIS/39559</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK CIMB NIAGA, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>559</td>
                                        <td>TIB/0222/CIT/39560</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK CIMB NIAGA, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>560</td>
                                        <td>TIB/0222/CIT/39561</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK CIMB NIAGA, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>561</td>
                                        <td>TIB/0222/CIT/39562</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK CIMB NIAGA, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>562</td>
                                        <td>TIB/0222/CIT/39563</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK CIMB NIAGA, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>563</td>
                                        <td>TIB/0222/CIT/39564</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK CIMB NIAGA, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>564</td>
                                        <td>TIB/0222/CIT/39565</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK CIMB NIAGA, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>565</td>
                                        <td>TIB/0222/PAR/161566</td>
                                        <td>TESTING OS IT-TEHNIK <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>566</td>
                                        <td>TIB/0222/PAR/161567</td>
                                        <td>ANDI FERDIANSYAH, MR <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>567</td>
                                        <td>TIB/0222/PAR/161568</td>
                                        <td>TJUT LINDA A. H. MRS <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>568</td>
                                        <td>TIB/0222/PAR/161569</td>
                                        <td>PAUL PAAIS, MR <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>569</td>
                                        <td>TIB/0222/PAR/161570</td>
                                        <td>BOB SALINDAHO, MR <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>570</td>
                                        <td>TIB/0222/MV/1322570</td>
                                        <td>DICKY DWITAMAJAYA, MR AND/OR SLAMET, MR <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>571</td>
                                        <td>TIB/0222/MV/1322571</td>
                                        <td>SUNINDO PRATAMA, PT <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>572</td>
                                        <td>TIB/0222/CIS/39573</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK DKI, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>573</td>
                                        <td>TIB/0222/CIS/39574</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK DKI (LA), PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>574</td>
                                        <td>TIB/0222/CIT/39575</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK DKI, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>575</td>
                                        <td>TIB/0222/IAR/91576</td>
                                        <td>BANK NEGARA INDONESIA (PERSERO) TBK, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>576</td>
                                        <td>TIB/0222/PAR/161577</td>
                                        <td>TESTING OS IT-TEHNIK <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>577</td>
                                        <td>TIB/0222/IAR/91578</td>
                                        <td>TESTING OS IT-TEHNIK <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>578</td>
                                        <td>TIB/0222/CIS/39579</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK PANIN, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>579</td>
                                        <td>TIB/0222/CIT/39580</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK PANIN, PT. <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>580</td>
                                        <td>TIB/0222/CIS/39581</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK INA, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>581</td>
                                        <td>TIB/0222/CIT/39582</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT QQ BANK INA, PT. <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>582</td>
                                        <td>TIB/0222/FG/67583</td>
                                        <td>TUNAS ARTHA GARDATAMA, PT <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>583</td>
                                        <td>TIB/0222/MV/1322583</td>
                                        <td>SITI NURHAYATI, MS AND/OR SUNINDO PRATAMA, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>584</td>
                                        <td>TIB/0222/PAR/161585</td>
                                        <td>TESTING OS IT-TEHNIK <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>585</td>
                                        <td>TIB/0222/PAR/161586</td>
                                        <td>TESTING OS IT-TEHNIK <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>586</td>
                                        <td>TIB/0222/ONR/1514587</td>
                                        <td>BESMINDO MATERI SEWATAMA, PT QQ ASIA PETROCOM SERVICES, PT <span
                                                class="float-right badge bg-primary tanda" style="display: none;"><i
                                                    class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>587</td>
                                        <td>TIB/0222/PAR/161588</td>
                                        <td>ATLAS PETROCHEM INDO, PT. <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>588</td>
                                        <td>TIB/0222/PAR/161589</td>
                                        <td>CIRACASINDO PERDANA, PT <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                    <tr>
                                        <td>589</td>
                                        <td>TIB/0222/PAR/161590</td>
                                        <td>CIRACASINDO PERDANA, PT <span class="float-right badge bg-primary tanda"
                                                style="display: none;"><i class="fas fa-check"></i></span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer" style="text-align: right;">
                            <input type="text" name="sppa_id" id="sppa_id" hidden>
                            <input type="text" name="polis_id" id="polis_id" hidden>
                            <button class="btn btn-primary" onclick="info();"><i class="fas fa-check mr-1"></i>
                                Load</button>
                        </div>

                    </div>
                </div>
                <div class="col-12">
                    <div class="card card-primary card-tabs" id="c_info" style="display: none;">
                        <div class="card-header p-0 pt-1">
                            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="interest-insured-tab" data-toggle="pill"
                                        href="#interest-insured-tab-view" role="tab"
                                        aria-controls="interest-insured-tab-view" aria-selected="true">Client Info</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="conditions-tab" data-toggle="pill"
                                        href="#conditions-tab-view" role="tab" aria-controls="conditions-tab-view"
                                        aria-selected="false">Premium Info</a>
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
                                            <div class="overlay" id="loader" style="display: none;">
                                                <i class="fas fa-3x fa-sync-alt fa-spin"></i><br>
                                                <br>
                                                <div class="text-bold pt-2">Loading...</div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6" style="border-right: 1px solid #ddd;">
                                                <div class="form-group">
                                                    <label for="insured_name">Policy</label>
                                                    <input type="text" class="form-control" id="c_policy"
                                                        name="c_policy" placeholder="Policy" readonly>
                                                    <input type="text" class="form-control" id="c_prodno"
                                                        name="c_prodno" placeholder="c_prodno" hidden>
                                                    <input type="text" class="form-control" id="c_tsi"
                                                        name="c_tsi" placeholder="c_tsi" hidden>
                                                </div>
                                                <div class="form-group">
                                                    <label for="insured_name">Type of Cover</label>
                                                    <input type="text" class="form-control" id="c_type"
                                                        name="c_type" placeholder="Type of Cover" required="true"
                                                        readonly>
                                                    <input type="text" class="form-control" id="kode_cob"
                                                        name="kode_cob" placeholder="Type of Cover" required="true"
                                                        hidden>
                                                    <input type="text" class="form-control" id="c_kurs"
                                                        name="c_kurs" hidden>
                                                </div>
                                                <div class="form-group">
                                                    <label for="insured_name">Insured Name</label>
                                                    <input type="text" class="form-control" id="c_insured_name"
                                                        name="c_insured_name" readonly>
                                                    <input type="text" class="form-control" id="c_insured_id"
                                                        name="c_insured_id" hidden>
                                                </div>

                                                <div class="form-group">
                                                    <label for="insured_name">Period</label>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <input type="text" class="form-control" id="c_period"
                                                                name="c_period" placeholder="Start Period" readonly>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <input type="text" class="form-control" id="c_periodEnd"
                                                                name="c_periodEnd" placeholder="End Period" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="insured_name">Interest/Object Claim</label>
                                                    <textarea class="form-control" rows="10" style="width: 100%;" id="c_interest" name="c_interest" readonly></textarea>
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
                <div class="col-12">
                    <div class="card card-primary card-outline" id="dataKlaim" style="display: none;">
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
                                        <select class="form-control select2bs4" id="ddCaused" name="ddCaused"
                                            style="width: 100%;">

                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="insured_name">Loss Adjuster</label>
                                        <select class="form-control select2bs4" id="ddLadj" name="ddLadj"
                                            style="width: 100%;">
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

                                    <div class="form-group">
                                        <label for="insured_name">Workshop</label>
                                        <select class="form-control select2bs4" id="ddWs" name="ddWs"
                                            style="width: 100%;">
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
                                            <option value="51">FRIEND&#039;S (BODY REPAIR &amp; PAINT SPECIALIST)
                                            </option>
                                            <option value="52">BENGKEL HONDA ARTA CIKUPA</option>
                                            <option value="53">NAGA MAS MOTOR</option>
                                            <option value="54">DUA SEKAWAN MOTOR</option>
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
                                                        class="fa fa-upload"></i> Pilih File</a>
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
                <div class="col-12">
                    <div class="card card-primary card-outline" id="dataAmount" style="display: none;">
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
                            <button class="btn btn-primary" onclick="submit();"><i class="fas fa-save"></i> Save All
                                Data</button>
                        </div>
                    </div>
                </div>

            </div>

    </section>
@endsection


@push('levelPluginsJsh')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@push('levelPluginsJs')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    {{-- custom js --}}
    <script src="{{ asset('storage/claim/claim.js') }}"></script>
@endpush
