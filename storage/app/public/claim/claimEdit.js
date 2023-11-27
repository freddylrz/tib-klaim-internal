var loadPremiumInfo = 0;
var loadingIndicator = false;
var dataClientInfo = [];
var dataClient = [];
var dataIns = [];
var dataDecument = [];
var dataLog = [];

$(function() {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    // money mask
    $('.money').inputmask('currency', {
        prefix: '',
        allowMinus: true,
        groupSeparator: ',',
        radixPoint: '.',
        autoGroup: true,
        digits: 0, // Set to 0 to avoid showing decimal digits
        rightAlign: true,
        numericInput: true // Enable numeric input only
    });

    //Date picker
    $('.datetimepicker-input').datetimepicker({
        format: "DD-MM-YYYY",
    });

    getDataAsset()

    getDetail()

    // Event listener for tab click
    $('#clientInfo .nav-link').on('click', function(e) {
        // Check if the clicked tab is the Premium Info tab
        if ($(this).attr('id') === 'premium-info-tab') {
            // Call getPremiuminfo() function when the Premium Info tab is clicked
            getPremiuminfo();
        }
    });

    // Event listener for input count amount
    $('.count-amount').on('keyup', function(e) {
        getCountAmount()
    });

    $('.btnfilesupd').on('click', function(e) {
		$('#fileInputupd').click();
	});

    $('#fileInputupd').on('change', function(e) {
		var thefiles = $('#fileInputupd').get(0).files.length;
		for (var i = 0; i < thefiles; ++i) {
            var file = $(this).get(0).files.item(i);
            var name = file.name;
            var fileUrl = URL.createObjectURL(file); // Create URL for the file
			$('#listfilesupd').append(`<li><a href="${fileUrl}" target="_blank">${name}</a></li>`);
		}
	});

    $('#formEdit').on('submit', async function(e) {
        e.preventDefault()

        saveEdit()
	});
});


function getDataAsset() {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    $.ajax({
        "url": `/api/claim/input/asset`,
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer " + $('#token').val()
        },
    }).done(function (response) {
        $('#causeId').append($('<option>', {
            value: '',
            text : "-- Choose Cause of Loss --"
        }));
        $('#causeId').append($('<option>', {
            value: 0,
            text : "-"
        }));
        $('#lossAdjId').append($('<option>', {
            value: '',
            text : "-- Choose Loss Adjuster --"
        }));
        $('#lossAdjId').append($('<option>', {
            value: 0,
            text : "-"
        }));
        $('#workshopId').append($('<option>', {
            value: '',
            text : "-- Choose Workshop --"
        }));
        $('#workshopId').append($('<option>', {
            value: 0,
            text : "-"
        }));
        $('#currId').append($('<option>', {
            value: '',
            text : "-- Choose Currency --"
        }));
        $('#cobId').append($('<option>', {
            value: '',
            text : "-- Choose Type of Cover --"
        }));


        $.each(response.filter, function (i, item) {
            $('#parameterId').append($('<option>', {
                value: item.filterId,
                text: item.filterDesc
            }));
        });
        $.each(response.cause, function (i, item) {
            $('#causeId').append($('<option>', {
                value: item.causeId,
                text: item.description
            }));
        });
        $.each(response.lossAdj, function (i, item) {
            $('#lossAdjId').append($('<option>', {
                value: item.lossAdjId,
                text: item.adj_name
            }));
        });
        $.each(response.workshop, function (i, item) {
            $('#workshopId').append($('<option>', {
                value: item.workshopId,
                text: item.ws_name
            }));
        });
        $.each(response.curr, function (i, item) {
            $('#currId').append($('<option>', {
                value: item.id,
                text: `${item.curr_code} | ${item.curr_name}`
            }));
        });
        $.each(response.cob, function (i, item) {
            $('#cobId').append($('<option>', {
                value: item.id,
                text: item.cob_desc
            }));
        });

        Swal.close();
    }).fail(function (response){
        Swal.fire({
            icon: "error",
            text: response.message,
            allowOutsideClick: false,
        });
    });
}

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
            $('#claimNo').val(item.claim_no)
            $('#dateOfLoss').val(item.dol)
            $('#locationOfLoss').val(item.location)
            $('#reportDate').val(item.report_date)
            $('#reportSource').val(item.report_source)
            $('#cobId').val(item.cob_id)
            $('#cobId').trigger('change');
            $('#causeId').val(item.causedId)
            $('#causeId').trigger('change');
            $('#lossAdjId').val(item.lossAdjusterId)
            $('#lossAdjId').trigger('change');
            $('#workshopId').val(item.workshopId)
            $('#workshopId').trigger('change');
            $('#currId').val(item.currId)
            $('#currId').trigger('change');
            $('#estAmt').val(item.est_amt)
            $('#claimAmt').val(item.claim_amt)
            $('#deducAmt').val(item.deduct_amt)
            $('#recoveryAmt').val(item.recv_amt)
            $('#netClaimAmt').val(item.net_amt)
        });

        response.dokument.forEach(function (item) {
            $('#listfilesupd').append(`<li><a href="/${item.file_path}"
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
                    render: function(data, type, row) {
                        return `<span id="claimAmount${row.insId}">${data}</span>`;
                    },
                    orderable: false,
                    className: 'dt-body-right'
                },
                {
                    data: "insDeductAmt",
                    render: function(data, type, row) {
                        return `<span id="deductionAmount${row.insId}">${data}</span>`;
                    },
                    orderable: false,
                    className: 'dt-body-right'
                },
                {
                    data: "insRecoveryAmt",
                    render: function(data, type, row) {
                        return `<span id="recoveryAmount${row.insId}">${data}</span>`;
                    },
                    orderable: false,
                    className: 'dt-body-right'
                },
                {
                    data: "insNetClaim",
                    render: function(data, type, row) {
                        return `<span id="netClaim${row.insId}">${data}</span>`;
                    },
                    orderable: false,
                    className: 'dt-body-right'
                },
            ],
        });

        $('#overlayClientInfo').fadeOut();
        $('#overlayClientData').fadeOut();
        $('#overlayDataAmount').fadeOut();
        $('#overlayLogStatus').fadeOut();
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

function getCountAmount() {
    if(loadingIndicator == false){
        var draft_no = $('#draftNo').val() == '' ? 0 : $('#draftNo').val()
        var estAmt = $('#estAmt').val() == '' ? 0 : $('#estAmt').val()
        var claimAmt = $('#claimAmt').val() == '' ? 0 : $('#claimAmt').val()
        var deducAmt = $('#deducAmt').val() == '' ? 0 : $('#deducAmt').val()
        var recoveryAmt = $('#recoveryAmt').val() == '' ? 0 : $('#recoveryAmt').val()

        $.ajax({
            url: `/api/claim/input/claim-amount`,
            method: "GET",
            dataType: "JSON",
            headers: {
                Authorization: "Bearer " + $("#token").val(),
            },
            data: {
                draft_no: draft_no,
                estAmt: estAmt,
                claimAmt: claimAmt,
                deducAmt: deducAmt,
                recoveryAmt: recoveryAmt
            },
            beforeSend: function () {
                $('.loadingIndicator').show();
                loadingIndicator = true;
                $('#btnSaveAll').attr('disabled', true);
            },
            complete: function () {
                $('.loadingIndicator').hide();
                loadingIndicator = false;
                $('#btnSaveAll').attr('disabled', false);
            }
        }).done(async function (response) {
            await $.each(response.data, function (i, item) {
                $(`#claimAmount${item.insr_id}`).html(item.claimAmt)
                $(`#recoveryAmount${item.insr_id}`).html(item.recovAmt)
                $(`#deductionAmount${item.insr_id}`).html(item.deducAmt)
                $(`#netClaim${item.insr_id}`).html(item.netAmt)
            });
            $('#netClaimAmt').val(response.netClaimAmt)

            claimAmount = response.data;
        }).fail(async function(response){
            Swal.fire({
                icon: "error",
                text: response.responseJSON.message,
                allowOutsideClick: false,
            });
            // make loading false
            return loadingIndicator = false;
        })

        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
    } else {
        return false
    }
}
