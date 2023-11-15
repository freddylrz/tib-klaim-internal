var loadPremiumInfo = 0;
var loadingIndicator = false;
var claimAmount = [];
dataClient= [];
var dataClient = [];

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
    $('#dateOfLoss').datetimepicker({
        format: "DD-MM-YYYY",
    });

    getDataAsset()

    $('#tbsppa').on('click', 'tbody tr', function() {
        $('.tanda').css('display', 'none');
        $(this).closest('tr').find('.tanda').css('display', 'block');

        $('#prodNo').val($(this).closest('tr').find('.tanda').data('prod'));

        $('#clientInfo').slideUp();
        $('#overlayClientInfo').fadeIn();
        $('#overlayPremiumInfo').fadeIn();
        loadPremiumInfo = 0;
        claimAmount = [];
        dataClient= [];
    });

    $('.filter').on('change', function() {
        if ($('#dataClient').is(':visible')) {
            $('#dataClient').slideUp();
            $('#overlayDataClient').fadeIn();
            $('#prodNo').val('')
            $('#clientInfo').slideUp();
            $('#overlayClientInfo').fadeIn();
            $('#overlayPremiumInfo').fadeIn();
            loadPremiumInfo = 0;
            claimAmount = [];
            dataClient= [];
        }
    });

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
		$('#listfilesupd').html('');
		for (var i = 0; i < thefiles; ++i) {
			var name = $(this).get(0).files.item(i).name;
			$('#listfilesupd').append(`<li>${name}</li>`);
		}
	});
});

// Function to remove active class from current tab and switch to the first tab
function switchToFirstTab() {
    // Remove the 'active' class from the currently active tab link and tab pane
    $('#custom-tabs-one-tab > .nav-item > .nav-link.active').removeClass('active');
    $('#custom-tabs-one-tabContent > .tab-pane.fade.show.active').removeClass('show active');

    // Set the first tab link and tab pane to be active
    $('#client-info-tab').addClass('active');
    $('#client-info-tab-view').addClass('show active');
}


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

        Swal.close();
    }).fail(function (response){
        Swal.fire({
            icon: "error",
            text: response.message,
            allowOutsideClick: false,
        });
    });
}

function search() {
    if($('#valueParameter').val() == '') {
        Swal.fire({
            icon: "error",
            text: "Value tidak boleh kosong!",
            allowOutsideClick: false,
        });

        return false
    }

    $.ajax({
        url: `/api/claim/input/dataTable`,
        method: "GET",
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
        data: {
            type: $('#parameterId').val(),
            search: $('#valueParameter').val()
        }
    })
    .done(async function (response) {
        await $("#tbsppa").DataTable({
            processing: false,
            pageLength: 10,
            autoWidth: false,
            order: [],
            bDestroy: true,
            searching: true,
            scrollX: true,
            sScrollXInner: "100%",
            data: response.data,
            columns: [
                { data: "draft_no" },
                { data: "policy_no" },
                {
                    data: "insured_name",
                    render: function(data, type, row) {
                        return `
                            ${data} <span class="float-right badge bg-primary tanda" style="display: none;" data-prod="${row.prod_no}"><i class="fas fa-check"></i></span>
                        `;
                    }
                }
            ],
        });

        $('#overlayDataClient').fadeOut();
    })

    $('#clientInfo').slideUp();
    $('#dataClaim').slideUp();
    $('#dataAmount').slideUp();
    $('#prodNo').val('');
    $('#dataClient').slideDown();
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
    loadPremiumInfo = 0;
    claimAmount = [];
    dataClient= [];
}

// Fungsi button "Load"
function getClientinfo() {
    if($('#prodNo').val() == '') {
        Swal.fire({
            icon: "error",
            text: "Mohon pilih client terlebih dahulu!",
            allowOutsideClick: false,
        });

        return false
    }

    switchToFirstTab()

    $.ajax({
        url: `/api/claim/input/data-client`,
        method: "GET",
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
        data: {
            prod_no: $('#prodNo').val(),
        }
    })
    .done(async function (response) {
        await $.each(response.data, function (i, item) {
            $('#draftNo').val(item.DRAFT_NO)
            $('#prodNo').val(item.PROD_NO)
            $('#insdId').val(item.insd_id)
            $('#nameWrt').val(item.name_wrt)
            $('#typeOFCover').val(item.type_of_cover)
            $('#polisNo').val(item.pol_no)
            $('#interestInsured').val(item.interest_insured)
            $('#startDd').val(item.start_dd)
            $('#endDd').val(item.end_dd)
            $('#tsi').val(`${item.curr_code} ${item.tsi}`)

            $('#txtnameWrt').html(item.name_wrt)
            $('#txttypeOFCover').html(item.type_of_cover)
            $('#txtpolisNo').html(item.pol_no)
            $('#txtinterestInsured').html(item.interest_insured)
            $('#txtperiod').html(`${item.start_dd} s.d. ${item.end_dd}`)
            $('#txttsi').html(`${item.curr_code} ${item.tsi}`)

            $('#clientName').html(`${item.name_wrt} (CLIENT)`)
        });

        dataClient = response.data

        $('#overlayClientInfo').fadeOut();
    })

    $('#dataClient').slideUp();
    $('#clientInfo').slideDown()
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

function addDataClaim() {
    $('#dataClient').slideUp();
    $('#dataClaim').slideDown();
    $('#dataAmount').slideDown();

    $.ajax({
        url: `/api/claim/input/share-insurance`,
        method: "GET",
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
        data: {
            draft_no: $('#draftNo').val()
        }
    })
    .done(async function (response) {
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
            data: response.data,
            columns: [
                { data: "crt_name" },
                { data: "share_pct" },
                {
                    data: "claimAmt",
                    render: function(data, type, row) {
                        return `<span id="claimAmount${row.insr_id}">${data}</span>`;
                    },
                    orderable: false,
                    className: 'dt-body-right'
                },
                {
                    data: "recovAmt",
                    render: function(data, type, row) {
                        return `<span id="recoveryAmount${row.insr_id}">${data}</span>`;
                    },
                    orderable: false,
                    className: 'dt-body-right'
                },
                {
                    data: "deducAmt",
                    render: function(data, type, row) {
                        return `<span id="deductionAmount${row.insr_id}">${data}</span>`;
                    },
                    orderable: false,
                    className: 'dt-body-right'
                },
                {
                    data: "netAmt",
                    render: function(data, type, row) {
                        return `<span id="netClaim${row.insr_id}">${data}</span>`;
                    },
                    orderable: false,
                    className: 'dt-body-right'
                }
            ],
        });

        $('#overlayDataAmount').fadeOut();
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
    })
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
            },
            complete: function () {
                $('.loadingIndicator').hide();
                loadingIndicator = false;
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

function saveAllData() {
    const form = new FormData();
    $.each(dataClient, function (i, item) {
        form.append("prod_no", "100041");
        form.append("location", "jln tebet barat no 10");
        form.append("caused", "73");
        form.append("lossAdj", "1");
        form.append("workshop", "1");
        form.append("estimationAmt", "15000000");
        form.append("claimAmt", "10000000");
        form.append("deducAmt", "500000");
        form.append("recoveryAmt", "200000");
        form.append("netAmt", "9300000");
    })
    form.append("insr_id[]", "3110017");
    form.append("fileUp[]", "/Users/faizalajikurniawan/Documents/2023-08-02 18.36.13.jpg");
    form.append("claimInsAmt[]", "10000000");
    form.append("deducInsAmt[]", "500000");
    form.append("recoveryInsAmt[]", "200000");
    form.append("netInsAmt[]", "9300000");
    form.append("name_wrt", "HAKO PRIMA SUKSES, PT");
    form.append("dol", "15-11-2023");
    form.append("cob_code", "APB");
    form.append("tsi", "165000000");
    form.append("premi", "525000");
    form.append("pol_no", "PST.0680/2006-00025");
    form.append("start_dd", "2006-01-03");
    form.append("end_dd", "2006-03-15");
    form.append("curr_id", "1");
    form.append("share[]", "100");
    form.append("sppaId", "10601041");
    form.append("insdId", "1056");
    form.append("interest", "With effect from inception date, this insurance cover for  Paket Pengadaan Kitchen Equipment Yayasan Sukma, Pidie, Aceh\\r\\nP.O. No.PO-0002503\\r\\nBond Value: IDR.165,000,000.00");
    form.append("cob_id", "66");
    form.append("estimationInsAmt[]", "1200000");

    $.ajax({
        async: true,
        crossDomain: true,
        url: "/api/claim/input/insert",
        method: "POST",
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
        "processData": false,
        "contentType": false,
        "mimeType": "multipart/form-data",
        "data": form
    }).done(function (response) {
        console.log(response);
    });
}
