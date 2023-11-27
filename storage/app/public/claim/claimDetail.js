var loadPremiumInfo = 0;
var dataClientInfo = [];
var dataClient = [];
var dataIns = [];
var dataDecument = [];
var dataLog = [];

$(function() {
    getDetail()

    // Event listener for tab click
    $('#clientInfo .nav-link').on('click', function(e) {
        // Check if the clicked tab is the Premium Info tab
        if ($(this).attr('id') === 'premium-info-tab') {
            // Call getPremiuminfo() function when the Premium Info tab is clicked
            getPremiuminfo();
        }
    });
});


function getDetail() {
    if($('#claimId').val() == '') {
        Swal.fire({
            icon: "error",
            text: "Claim Id Diperlukan!",
            allowOutsideClick: false,
        });

        return false
    }

    $.ajax({
        url: `/api/claim/detail-claim`,
        method: "GET",
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
        data: {
            claimId: $('#claimId').val(),
        }
    })
    .done(async function (response) {
        dataClientInfo = response.clientInfo
        dataClient = response.clientData
        dataIns = response.Ins
        dataDecument = response.dokument
        dataLog = response.log

        response.clientInfo.forEach(function (item) {
            $('#draftNo').val(item.DRAFT_NO)
            $('#prodNo').val(item.PROD_NO)
            $('#txtnameWrt').html(item.name_wrt)
            $('#txttypeOFCover').html(item.type_of_cover)
            $('#txtpolisNo').html(item.pol_no)
            $('#txtinterestInsured').html(item.interest_insured)
            $('#txtperiod').html(item.periode)
            $('#txttsi').html(`${item.curr_code} ${item.tsi}`)
            $('#clientName').html(`${item.name_wrt} (CLIENT)`)
        });

        response.clientData.forEach(function (item) {
            $('#headClaimNo').html(item.claim_no)
            $('#claimNo').html(item.claim_no)
            $('#dateofLoss').html(item.dol)
            $('#location').html(item.location)
            $('#reportDate').html(item.report_date)
            $('#reportSource').html(item.report_source)
            $('#cobDesc').html(item.cob_desc)
            $('#causedDesc').html(item.causedDesc)
            $('#lossAdjusterDesc').html(item.lossAdjusterDesc)
            $('#workshopDesc').html(item.workshopDesc)
            $('#currDesc').html(item.currDesc)
            $('#estAmt').html(item.est_amt)
            $('#claimAmt').html(item.claim_amt)
            $('#deductAmt').html(item.deduct_amt)
            $('#recvAmt').html(item.recv_amt)
            $('#netAmt').html(item.net_amt)
        });

        response.dokument.forEach(function (item) {
            $('#uploadedAttachment').append(`<li><a href="/${item.file_path}"
            target="_blank">${item.file_name}</a></li>`)
        });

        await $("#tbclaimAmount").DataTable({
            processing: false,
            pageLength: 10,
            autoWidth: false,
            order: [[1, 'desc']],
            bDestroy: true,
            scrollX: true,
            paging: false, // Disable pagination
            searching: false, // Disable search
            info: false, // Disable table information display
            sScrollXInner: "100%",
            data: response.Ins,
            columns: [
                { data: "insName" },
                { data: "insShare" },
                {
                    data: "insClaimAmt",
                    orderable: false,
                    className: 'dt-body-right'
                },
                {
                    data: "insDeductAmt",
                    orderable: false,
                    className: 'dt-body-right'
                },
                {
                    data: "insRecoveryAmt",
                    orderable: false,
                    className: 'dt-body-right'
                },
                {
                    data: "insNetClaim",
                    orderable: false,
                    className: 'dt-body-right'
                },
                {
                    data: "insPaidDD",
                    orderable: false, },
                {
                    data: "insAging",
                    orderable: false,
                },
            ],
        });

        await $("#tblogStatus").DataTable({
            processing: false,
            pageLength: 10,
            autoWidth: false,
            bDestroy: true,
            scrollX: true,
            paging: false, // Disable pagination
            searching: false, // Disable search
            ordering: false, // Disable sorting
            info: false, // Disable table information display
            sScrollXInner: "100%",
            data: response.log,
            columns: [
                {
                    data: null,
                    render: function (data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                { data: "created_at" },
                { data: "klaimStatDesc" },
                { data: "aging" },
                { data: "klaimDesc" },
                { data: "klaimUser" },
            ],
        });

        $('#overlayClientInfo').fadeOut();
        $('#overlayClientData').fadeOut(2000);
        $('#overlayDataAmount').fadeOut(3000);
        $('#overlayLogStatus').fadeOut(4000);
    })
    .fail(async function(response){
        await Swal.fire({
            icon: "error",
            text: "Claim Id tidak ditemukan!",
            allowOutsideClick: false,
        });

        return window.location.replace(`/claim/list`);
    })

    loadPremiumInfo = 0;
}

function getPremiuminfo() {
    // Check if loadPremiumInfo is 0 before fetching premium info
    if (loadPremiumInfo === 0) {
        $.ajax({
            url: `/api/claim/input/premium-info`,
            method: "GET",
            headers: {
                Authorization: "Bearer " + $("#token").val(),
            },
            data: {
                prod_no: $('#prodNo').val(),
                draft_no: $('#draftNo').val()
            }
        })
        .done(async function (response) {
            $('#divPremiumInfo').html('');

            await $("#tbclientPremiumInfo").DataTable({
                processing: false,
                pageLength: 10,
                autoWidth: false,
                order: [],
                bDestroy: true,
                scrollX: true,
                paging: false, // Disable pagination
                searching: false, // Disable search
                ordering: false, // Disable sorting
                info: false, // Disable table information display
                sScrollXInner: "100%",
                data: response.data.client,
                columns: [
                    { data: "no_nota", className: "text-center" },
                    { data: "no_bukti", className: "text-center" },
                    { data: "tanggal", className: "text-center" },
                    { data: "jumlah", className: "text-center" },
                    { data: "pelunasan", className: "text-center" },
                    { data: "saldo", className: "text-center" },
                ],
            });

            await $.each(response.data.ins, async function (i, item) {
                await $('#divPremiumInfo').append(`
                    <div class="table-responsive p-0">
                        <table id="tbinsPremiumInfo${i}" class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th colspan="6">${item.insr_name}</th>
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
                `);

                $(`#tbinsPremiumInfo${i}`).DataTable({
                    processing: false,
                    pageLength: 10,
                    autoWidth: false,
                    order: [],
                    bDestroy: true,
                    scrollX: true,
                    paging: false, // Disable pagination
                    searching: false, // Disable search
                    ordering: false, // Disable sorting
                    info: false, // Disable table information display
                    sScrollXInner: "100%",
                    data: item.premium,
                    columns: [
                        { data: "no_nota", className: "text-center" },
                        { data: "no_bukti", className: "text-center" },
                        { data: "tanggal", className: "text-center" },
                        { data: "jumlah", className: "text-center" },
                        { data: "pelunasan", className: "text-center" },
                        { data: "saldo", className: "text-center" },
                    ],
                });
            });

            loadPremiumInfo = 1;
            $('#overlayPremiumInfo').fadeOut();
        });

        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
    } else {
        console.log('Premium info has already been loaded.');
    }
}
