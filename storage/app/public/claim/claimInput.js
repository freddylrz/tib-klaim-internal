var loadPremiumInfo = 0;
var loadingIndicator = false;
var inputManual = false;
var maxShare = 100;
var claimAmount = [];
var claimAmountInputManual = [];
var insForInputManual = [];
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

    $('.share').inputmask('numeric', {
        suffix: ' %',
        allowMinus: true,
        groupSeparator: ',',
        radixPoint: '.',
        autoGroup: true,
        digits: 2, // Set to 2 to display two decimal places
        rightAlign: true,
        numericInput: true // Enable numeric input only
    });

    //Date picker
    $('.datetimepicker-input').datetimepicker({
        format: "DD-MM-YYYY",
    });

    getDataAsset()

    $('#tbsppa').on('click', 'tbody tr', function() {
        const $clickedRow = $(this);
        const $tanda = $clickedRow.closest('tr').find('.tanda');

        $('.tanda').css('display', 'none');
        $tanda.css('display', 'block');

        $('#prodNo').val($tanda.data('prod'));
        $('#draftNo').val($tanda.data('draft'));

        $('#clientInfo').slideUp();
        $('#overlayClientInfo, #overlayPremiumInfo').fadeIn();

        loadPremiumInfo = 0;
        claimAmount = [];
        dataClient = [];
    });

    $('.filter').on('change', function() {
        const dataClientVisible = $('#dataClient').is(':visible');

        if (dataClientVisible) {
            $('#dataClient, #clientInfo').slideUp();
            $('#overlayDataClient, #overlayClientInfo, #overlayPremiumInfo').fadeIn();
            $('#prodNo, #draftNo').val('');
            loadPremiumInfo = 0;
            claimAmount = [];
            dataClient = [];
        }
    });

    $('.max-share').on('keyup change', function(e) {
        if($(this).val() > maxShare){
            $(this).val('')

            if(maxShare == 0){
                return Swal.fire({
                    icon: "error",
                    text: `Share sudah habis. tidak dapat menambahkan data lagi`,
                    allowOutsideClick: false,
                });
            } else {
                return Swal.fire({
                    icon: "error",
                    text: `Share tidak dapat lebih dari ${maxShare}%`,
                    allowOutsideClick: false,
                });
            }
        }
    });

    $('#btnLoadCLient').on('click', function(e) {
        getClientInfo()
	});

    // Event listener for tab click
    $('#clientInfo .nav-link').on('click', function(e) {
        // Check if the clicked tab is the Premium Info tab
        if ($(this).attr('id') === 'premium-info-tab') {
            // Call getPremiumInfo() function when the Premium Info tab is clicked
            getPremiuminfo();
        }
    });

    $('.btnDataCLaim').on('click', function(e) {
        addDataClaim()
	});

    // Event listener for input count amount
    $('.count-amount').on('keyup', function(e) {
        getCountAmount()
    });

    $('.btnfilesupd').on('click', function(e) {
        e.preventDefault(); // Prevent default button behavior
        $('#fileInputupd').trigger('click');
	});

    $('#fileInputupd').on('change', function(e) {
		var thefiles = $('#fileInputupd').get(0).files.length;
		$('#listfilesupd').html('');
		for (var i = 0; i < thefiles; ++i) {
            var file = $(this).get(0).files.item(i);
            var name = file.name;
            var fileUrl = URL.createObjectURL(file); // Create URL for the file
			$('#listfilesupd').append(`<li><a href="${fileUrl}" target="_blank">${name}</a></li>`);
		}
	});

    $('#formSaveAll').on('submit', async function(e) {
        e.preventDefault()
        if(inputManual){
            saveAllDataManualInput()
        } else {
            saveAllData()
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

function getManualInputAsset() {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    $.ajax({
        "url": `/api/claim/input/asset-manual`,
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer " + $('#token').val()
        },
    }).done(function (response) {
        $('#insuredName').append($('<option>', {
            value: '',
            text : "-- Choose Insured Name --"
        }));

        $('#insuranceSelect').append($('<option>', {
            value: '',
            text : "-- Choose Insurance --"
        }));

        $.each(response.client, function (i, item) {
            $('#insuredName').append($('<option>', {
                value: item.clientId,
                text: item.clientName
            }));
        });

        $.each(response.insurance, function (i, item) {
            $('#insuranceSelect').append($('<option>', {
                value: item.insrId,
                text: item.insrName
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
    $('#overlayDataClient').fadeIn();

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
        if(response.data.length > 0){
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
                    { data: "insured_name" },
                    { data: "type_cover" },
                    { data: "periode" },
                    {
                        data: "prod_no",
                        render: function(data, type, row) {
                            return `
                                <span class="badge bg-primary py-2 tanda" style="display: none;" data-draft="${row.draft_no}" data-prod="${data}"><i class="fas fa-check"></i></span>
                            `;
                        },
                        orderable: false,
                    }
                ],
            });

            $('#overlayDataClient').fadeOut();
        } else {
            $('#dataClient').slideUp();

            await Swal.fire({
                icon: 'warning',
                title: 'Data client tidak ditemukan, lanjutkan ke proses input?',
                showDenyButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                denyButtonText: `Batal`,
                allowOutsideClick: false
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $('#clientInput').slideDown();
                    inputManual = true
                    getManualInputAsset()
                    return false
                } else if (result.isDenied) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Perubahan tidak disimpan',
                        showConfirmButton: true,
                    });
                    inputManual = false
                    return false
                }
            })
        }
    })

    inputManual = false;

    $('#polisNo').val('');
    $('#interestInsured').val('');
    $('#startDd').val('');
    $('#endDd').val('');
    $('#tsi').val('');
    $('#premi').val('');
    $('#polisNo').prop('readonly', false);
    $('#insuredName').prop('disabled', false);
    $('#tsi').prop('readonly', false);
    $('#premi').prop('readonly', false);
    $('#startDd').prop('readonly', false);
    $('#endDd').prop('readonly', false);
    $('#interestInsured').prop('readonly', false);

    $('#clientInfo, #dataClaim, #dataAmount, #dataAmountManualInput, #clientInput').slideUp();
    $('#prodNo, #draftNo').val('');
    $('#dataClient, #clientInfoFooter, #clientInputFooter').slideDown();

    $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();

    loadPremiumInfo = 0;
    claimAmount = [];
    dataClient = [];
}

// Fungsi button "Load"
function getClientInfo() {
    const prodNoValue = $('#prodNo').val();
    const draftNoValue = $('#draftNo').val();

    if (prodNoValue === '' || draftNoValue === '') {
        Swal.fire({
            icon: "error",
            text: "Mohon pilih client terlebih dahulu!",
            allowOutsideClick: false,
        });
        return false;
    }

    switchToFirstTab();

    $.ajax({
        url: `/api/claim/input/data-client`,
        method: "GET",
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
        data: {
            prod_no: prodNoValue,
            draft_no: draftNoValue,
        },
        beforeSend: function () {
            loadingIndicator = true;
            $('#btnLoadCLient').attr('disabled', true);
            $('#btnLoadCLient').html('<i class="fas fa-spinner fa-spin"></i> Loading');
        },
        complete: function () {
            loadingIndicator = false;
            $('#btnLoadCLient').attr('disabled', false);
            $('#btnLoadCLient').html('<i class="fas fa-check mr-1"></i> Load');
        }
    })
    .done(function (response) {
        if (response.data.length > 0) {
            const item = response.data[0]; // Assuming only one item is received

            $('#draftNo').val(item.DRAFT_NO);
            $('#prodNo').val(item.PROD_NO);
            $('#insdId').val(item.insd_id);
            $('#nameWrt').val(item.name_wrt);
            $('#typeOFCover').val(item.type_of_cover);
            $('#cobId').val(item.cob_id).trigger('change');
            $('#cobId').prop('disabled', item.cob_id !== null);
            $('#currId').val(item.curr_id).trigger('change');
            $('#polisNo').val(item.pol_no);
            $('#interestInsured').val(item.interest_insured);
            $('#startDd').val(item.start_dd);
            $('#endDd').val(item.end_dd);
            $('#tsi').val(`${item.curr_code} ${item.tsi}`);
            $('#txtnameWrt').html(item.name_wrt);
            $('#txttypeOFCover').html(item.type_of_cover);
            $('#txtpolisNo').html(item.pol_no);
            $('#txtinterestInsured').html(item.interest_insured);
            $('#txtperiod').html(item.periode);
            $('#txttsi').html(`${item.curr_code} ${item.tsi}`);
            $('#clientName').html(`${item.name_wrt} (CLIENT)`);
        }

        $('#currId, #cobId').on('change', function () {
            $(this).val();
        });

        dataClient = response.data;

        $('#overlayClientInfo').fadeOut();
    })
    .always(function () {
        $('#dataClient').slideUp();
        $('#clientInfo').slideDown();
        loadPremiumInfo = 0;
    });
}

async function fetchPremiumInfo() {
    try {
        const response = await $.ajax({
            url: `/api/claim/input/premium-info`,
            method: "GET",
            headers: {
                Authorization: "Bearer " + $("#token").val(),
            },
            data: {
                prod_no: $('#prodNo').val(),
                draft_no: $('#draftNo').val()
            }
        });

        return response.data;
    } catch (error) {
        console.error("Error fetching premium info:", error);
        throw error;
    }
}

async function displayPremiumInfo(clientData, insData) {
    $('#divPremiumInfo').html('');

    const clientTable = $("#tbclientPremiumInfo").DataTable({
        processing: false,
        pageLength: 10,
        autoWidth: false,
        order: [],
        bDestroy: true,
        scrollX: true,
        paging: false,
        searching: false,
        ordering: false,
        info: false,
        sScrollXInner: "100%",
        data: clientData,
        columns: [
            { data: "no_nota", className: "text-center" },
            { data: "no_bukti", className: "text-center" },
            { data: "tanggal", className: "text-center" },
            { data: "jumlah", className: "text-center" },
            { data: "pelunasan", className: "text-center" },
            { data: "saldo", className: "text-center" },
        ],
    });

    insData.forEach((item, i) => {
        $('#divPremiumInfo').append(`
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
            paging: false,
            searching: false,
            ordering: false,
            info: false,
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

    $('#overlayPremiumInfo').fadeOut();
    return clientTable;
}

async function getPremiuminfo() {
    if (loadPremiumInfo === 0) {
        try {
            $('#overlayPremiumInfo').fadeIn();
            const { client, ins } = await fetchPremiumInfo();

            const clientTable = await displayPremiumInfo(client, ins);
            loadPremiumInfo = 1;

            clientTable.columns.adjust().draw();
        } catch (error) {
            // Handle errors if needed
        }
    } else {
        console.log('Premium info has already been loaded.');
    }
}

function initializeDataTable(dataTableConfig) {
    return renderDataTable('#tbclaimAmount', dataTableConfig);
}

function adjustColumns() {
    $('#overlayDataAmount').fadeOut();
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
}

// Function to add data to claimAmountInputManual array
function addData() {
    var insuranceId = $('#insuranceSelect').val();
    var insuranceName = $("#insuranceSelect option:selected").text();
    var shareValue = parseFloat($('#share').val());

    if(insuranceId == ''){
        Swal.fire({
            icon: "error",
            text: "Pilih asuransi terlebih dahulu!",
            allowOutsideClick: false,
        });

        return false
    }

    if(shareValue > maxShare){
        if(maxShare == 0){
            Swal.fire({
                icon: "error",
                text: `Share sudah habis. tidak dapat menambahkan data lagi`,
                allowOutsideClick: false,
            });
        } else {
            Swal.fire({
                icon: "error",
                text: `Share tidak dapat lebih dari ${maxShare}%`,
                allowOutsideClick: false,
            });
        }

        return false
    }

    var premi = $('#premi').val();
    var premiValue = (Number(premi.replace(/[^0-9.-]+/g,"")) * shareValue) / 100;

    var data = {
        "insr_id": insuranceId,
        "crt_name": insuranceName,
        "share_pct": shareValue,
        "premi": premiValue,
        "estAmt": 0,
        "claimAmt": 0,
        "deducAmt": 0,
        "recovAmt": 0,
        "netAmt": 0
    };

    $('#insuranceSelect').val('').trigger('change');
    $('#share').val('');

    maxShare -= shareValue;
    claimAmountInputManual.push(data);
    $('#modal-manualInput').modal('toggle');
    getCountAmount()
    return refreshTable();
}

// Function to delete data from claimAmountInputManual array by index
async function deleteData(index, recoveryShare) {
    await Swal.fire({
        icon: 'warning',
        title: 'Apakah anda yakin ingin menghapus data?',
        showDenyButton: true,
        confirmButtonText: 'Ya',
        denyButtonText: `Batal`,
        allowOutsideClick: false
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
            maxShare += recoveryShare;
            claimAmountInputManual.splice(index, 1);
            return refreshTable();
        } else if (result.isDenied) {
            Swal.fire({
                icon: 'error',
                title: 'Perubahan tidak disimpan',
                showConfirmButton: true,
            });

            return false
        }
    })
}

// Function to refresh the data table with updated data
function refreshTable() {
    const table = $('#tbclaimAmountManualInput').DataTable();
    table.clear().rows.add(claimAmountInputManual).draw();
}

function handleManualInput() {
    const dataTableConfig = {
        processing: false,
        pageLength: 10,
        autoWidth: false,
        order: [[1, 'desc']],
        bDestroy: true,
        responsive: true, // Adding responsiveness
        scrollX: true,
        paging: false,
        searching: false,
        info: false,
        sScrollXInner: '100%',
        data: claimAmountInputManual,
        columns: [
            { data: 'crt_name' },
            { data: 'share_pct' },
            { data: 'claimAmt', render: renderAmount('claimAmount') },
            { data: 'deducAmt', render: renderAmount('deductionAmount') },
            { data: 'recovAmt', render: renderAmount('recoveryAmount') },
            { data: 'netAmt', render: renderAmount('netClaim') },
            {
              // Add a delete button in the last column
              data: null,
              render: function(data, type, row, meta) {
                return `<button type="button" onclick="deleteData(${meta.row}, ${row.share_pct})" class="btn btn-danger btn-block"><i class="fas fa-trash mr-1"></i></button>`;
              }
            }
        ],
    };

    renderDataTable('#tbclaimAmountManualInput', dataTableConfig);
    $('#overlayDataAmountManualInput').fadeOut();

    return adjustColumns();
}

function handleAjaxInput() {
    $.ajax({
        url: '/api/claim/input/share-insurance',
        method: 'GET',
        headers: {
            Authorization: 'Bearer ' + $('#token').val(),
        },
        data: {
            draft_no: $('#draftNo').val(),
        },
    })
        .done(async function (response) {
            const dataTableConfig = {
                processing: false,
                pageLength: 10,
                autoWidth: false,
                order: [[1, 'desc']],
                bDestroy: true,
                scrollX: true,
                paging: false,
                searching: false,
                info: false,
                sScrollXInner: '100%',
                data: response.data,
                columns: [
                    { data: 'crt_name' },
                    { data: 'share_pct' },
                    { data: 'claimAmt', render: renderAmount('claimAmount') },
                    { data: 'deducAmt', render: renderAmount('deductionAmount') },
                    { data: 'recovAmt', render: renderAmount('recoveryAmount') },
                    { data: 'netAmt', render: renderAmount('netClaim') },
                ],
            };

            const dataTable = await initializeDataTable(dataTableConfig);

            adjustColumns();
        })
        .fail(function (jqXHR, textStatus, errorThrown) {
            console.error('Error fetching share-insurance data:', errorThrown);
            // Optionally handle the error (e.g., show an error message)
        });
}

function validateInput(fieldId, errorMessage) {
    if ($(fieldId).val() === '') {
        Swal.fire({
            icon: "error",
            text: errorMessage,
            allowOutsideClick: false,
        });
        return false;
    }
    return true;
}

function addDataClaim() {
    if (inputManual) {
        if (!validateInput('#polisNo', 'Masukan nomor polis terlebih dahulu!')) return false;
        if (!validateInput('#insuredName', 'Pilih insured name terlebih dahulu!')) return false;
        if (!validateInput('#tsi', 'Masukan total sum insured terlebih dahulu!')) return false;
        if (!validateInput('#startDd', 'Masukan periode awal terlebih dahulu!')) return false;
        if (!validateInput('#endDd', 'Masukan periode akhir terlebih dahulu!')) return false;
        if (!validateInput('#interestInsured', 'Isi interest/object claim terlebih dahulu!')) return false;

        $('#cobId').val('').trigger('change');
        $('#cobId').prop('readonly', false);
        $('#polisNo').prop('readonly', true);
        $('#insuredName').prop('disabled', true);
        $('#tsi').prop('readonly', true);
        $('#premi').prop('readonly', true);
        $('#startDd').prop('readonly', true);
        $('#endDd').prop('readonly', true);
        $('#interestInsured').prop('readonly', true);

        $('#dataClient, #clientInputFooter').slideUp();
        $('#dataClaim').slideDown();

        $('#dataAmount').slideUp();
        $('#dataAmountManualInput').slideDown();
        handleManualInput();
    } else {
        $('#clientInfoFooter, #dataClient').slideUp();
        $('#dataClaim').slideDown();

        $('#dataAmountManualInput').slideUp();
        $('#dataAmount').slideDown();
        handleAjaxInput();
    }
}


// Function to render amount fields in DataTable
function renderAmount(elementIdPrefix) {
    return function(data, type, row) {
        return `<span id="${elementIdPrefix}${row.insr_id}">${data}</span>`;
    };
}

// Function to render DataTable
async function renderDataTable(tableId, dataTableConfig) {
    await $(tableId).DataTable(dataTableConfig);
}

async function getCountAmount() {
    if (!loadingIndicator) {
        const draft_no = $('#draftNo').val() || 0;
        const estAmt = $('#estAmt').val() || 0;
        const claimAmt = $('#claimAmt').val() || 0;
        const deducAmt = $('#deducAmt').val() || 0;
        const recoveryAmt = $('#recoveryAmt').val() || 0;

        if(inputManual) {
            if(claimAmountInputManual.length > 0){
                // Transform the original object
                const insClaimAmount = claimAmountInputManual.map((item, index) => {
                    return {
                        "insId": item.insr_id,
                        "share": item.share_pct
                    };
                });
            try {
                const response = await $.ajax({
                    url: `/api/claim/input/claim-amount-manual`,
                    method: "GET",
                    dataType: "JSON",
                    headers: {
                        Authorization: "Bearer " + $("#token").val(),
                    },
                    data: {
                        estAmt,
                        claimAmt,
                        deducAmt,
                        recoveryAmt,
                        ins: insClaimAmount
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
                });

                await updateClaimAmountsInputManual(response.data);
                $('#netClaimAmt').val(response.netClaimAmt);

                claimAmountInputManual.forEach((originalObj, i) => {
                    const dataObj = response.data[i];

                    // Check if insr_id already exists in the array
                    const existingIndex = insForInputManual.findIndex(item => item.insr_id === originalObj.insr_id);

                    if (existingIndex !== -1) {
                        // If insr_id exists, replace the existing object
                        insForInputManual[existingIndex] = {
                            insr_id: originalObj.insr_id,
                            crt_name: originalObj.crt_name,
                            share_pct: originalObj.share_pct,
                            premi: originalObj.premi,
                            insShare: dataObj.insShare,
                            share: dataObj.share,
                            estAmt: dataObj.estAmt,
                            claimAmt: dataObj.claimAmt,
                            deducAmt: dataObj.deducAmt,
                            recovAmt: dataObj.recovAmt,
                            netAmt: dataObj.netAmt
                        };
                    } else {
                        // If insr_id doesn't exist, add a new object to the array
                        insForInputManual.push({
                            insr_id: originalObj.insr_id,
                            crt_name: originalObj.crt_name,
                            share_pct: originalObj.share_pct,
                            premi: originalObj.premi,
                            insShare: dataObj.insShare,
                            share: dataObj.share,
                            estAmt: dataObj.estAmt,
                            claimAmt: dataObj.claimAmt,
                            deducAmt: dataObj.deducAmt,
                            recovAmt: dataObj.recovAmt,
                            netAmt: dataObj.netAmt
                        });
                    }
                });

            } catch (error) {
                Swal.fire({
                    icon: "error",
                    text: error.responseJSON?.message || "An error occurred.",
                    allowOutsideClick: false,
                });
                loadingIndicator = false;
                return false;
            }
            } else {
                return false
            }
        } else {
            try {
                const response = await $.ajax({
                    url: `/api/claim/input/claim-amount`,
                    method: "GET",
                    dataType: "JSON",
                    headers: {
                        Authorization: "Bearer " + $("#token").val(),
                    },
                    data: {
                        type: 1,
                        draft_no,
                        estAmt,
                        claimAmt,
                        deducAmt,
                        recoveryAmt
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
                });

                await updateClaimAmounts(response.data);
                $('#netClaimAmt').val(response.netClaimAmt);
                claimAmount = response.data;

            } catch (error) {
                Swal.fire({
                    icon: "error",
                    text: error.responseJSON?.message || "An error occurred.",
                    allowOutsideClick: false,
                });
                loadingIndicator = false;
                return false;
            }
        }

        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();

    } else {
        return false;
    }
}

async function updateClaimAmounts(data) {
    await Promise.all(data.map(async (item) => {
        $(`#claimAmount${item.insr_id}`).html(item.claimAmt);
        $(`#recoveryAmount${item.insr_id}`).html(item.recovAmt);
        $(`#deductionAmount${item.insr_id}`).html(item.deducAmt);
        $(`#netClaim${item.insr_id}`).html(item.netAmt);
    }));
}

async function updateClaimAmountsInputManual(data) {
    await Promise.all(data.map(async (item) => {
        $(`#claimAmount${item.insId}`).html(item.claimAmt);
        $(`#recoveryAmount${item.insId}`).html(item.recovAmt);
        $(`#deductionAmount${item.insId}`).html(item.deducAmt);
        $(`#netClaim${item.insId}`).html(item.netAmt);
    }));
}

function saveAllData() {
    if(loadingIndicator == false){
        Swal.fire({
            icon: "info",
            text: "loading",
            showConfirmButton: false,
            allowOutsideClick: false,
        });

        if(dataClient.length == 0) {
            Swal.fire({
                icon: "error",
                text: "Mohon pilih client terlebih dahulu!",
                allowOutsideClick: false,
            });

            return search()
        }

        if(claimAmount.length == 0) {
            Swal.fire({
                icon: "error",
                text: "Mohon isi data claim terlebih dahulu!",
                allowOutsideClick: false,
            });

            return search()
        }

        const form = new FormData();

        $.each(dataClient, function (i, item) {
            form.append("sppaId", item.DRAFT_NO);
            form.append("prod_no", item.PROD_NO);
            form.append("name_wrt", item.name_wrt);
            form.append("cob_code", item.cob_code);
            form.append("tsi", item.tsi);
            form.append("pol_no", item.pol_no);
            form.append("start_dd", item.start_dd);
            form.append("end_dd", item.end_dd);
            form.append("insdId", item.insd_id);
            form.append("interest", item.interest_insured);
            form.append("cob_id", item.cob_id);
            form.append("premi", item.premi);
        })

        $.each(claimAmount, function (i, item) {
            form.append("insr_id[]", item.insr_code);
            form.append("share[]", item.share_pct);
            form.append("premiIns[]", item.premi);
            form.append("estimationInsAmt[]", item.estAmt);
            form.append("claimInsAmt[]", item.claimAmt);
            form.append("deducInsAmt[]", item.deducAmt);
            form.append("recoveryInsAmt[]", item.recovAmt);
            form.append("netInsAmt[]", item.netAmt);
        })

        $('#fileInputupd').each(function () {
            const files = $(this).prop('files');

            if (files.length > 0) {
                for (let j = 0; j < files.length; j++) {
                    form.append('fileUp[]', files[j]);
                }
            }
        });

        form.append("dol", $('#dateOfLoss').val());
        form.append("location", $('#locationOfLoss').val());
        form.append("caused", $('#causeId').val());
        form.append("lossAdj", $('#lossAdjId').val());
        form.append("workshop", $('#workshopId').val());
        form.append("curr_id", $('#currId').val());
        form.append("cob_id", $('#cobId').val());
        form.append("reportDate", $('#reportDate').val());
        form.append("reportSource", $('#reportSource').val());
        form.append("estimationAmt", $('#estAmt').val());
        form.append("claimAmt", $('#claimAmt').val());
        form.append("deducAmt", $('#deducAmt').val());
        form.append("recoveryAmt", $('#recoveryAmt').val());
        form.append("netAmt", $('#netClaimAmt').val());

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
        }).done(async function (response) {
            var data = JSON.parse(response);
            if(data.status == 200){
                await Swal.fire({
                    icon: 'success',
                    title: data.message,
                    timer: 3000,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });

                return window.location.replace(`/claim/detail/${data.klaimId}`);
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: data.message,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });
            }

        }).fail(async function(error){
            Swal.fire({
                icon: 'error',
                title: error.responseJSON.message,
                showConfirmButton: true,
            });
        });
    } else {
        return false
    }
}

function saveAllDataManualInput() {
    if(loadingIndicator == false){
        Swal.fire({
            icon: "info",
            text: "loading",
            showConfirmButton: false,
            allowOutsideClick: false,
        });

        const form = new FormData();

        form.append("sppaId", 0);
        form.append("prod_no", 0);
        form.append("name_wrt", $("#insuredName option:selected").text());
        form.append("cob_code", $('#cobId').val());
        form.append("tsi", $('#tsi').val());
        form.append("pol_no", $('#polisNo').val());
        form.append("start_dd", $('#startDd').val());
        form.append("end_dd", $('#endDd').val());
        form.append("insdId", $('#insuredName').val());
        form.append("interest", $('#interestInsured').val());
        form.append("premi", $('#premi').val());

        $.each(insForInputManual, function (i, item) {
            form.append("insr_id[]", item.insr_id);
            form.append("share[]", item.share_pct);
            form.append("premiIns[]", item.premi);
            form.append("estimationInsAmt[]", item.estAmt);
            form.append("claimInsAmt[]", item.claimAmt);
            form.append("deducInsAmt[]", item.deducAmt);
            form.append("recoveryInsAmt[]", item.recovAmt);
            form.append("netInsAmt[]", item.netAmt);
        })

        $('#fileInputupd').each(function () {
            const files = $(this).prop('files');

            if (files.length > 0) {
                for (let j = 0; j < files.length; j++) {
                    form.append('fileUp[]', files[j]);
                }
            }
        });

        form.append("dol", $('#dateOfLoss').val());
        form.append("location", $('#locationOfLoss').val());
        form.append("caused", $('#causeId').val());
        form.append("lossAdj", $('#lossAdjId').val());
        form.append("workshop", $('#workshopId').val());
        form.append("curr_id", $('#currId').val());
        form.append("cob_id", $('#cobId').val());
        form.append("reportDate", $('#reportDate').val());
        form.append("reportSource", $('#reportSource').val());
        form.append("estimationAmt", $('#estAmt').val());
        form.append("claimAmt", $('#claimAmt').val());
        form.append("deducAmt", $('#deducAmt').val());
        form.append("recoveryAmt", $('#recoveryAmt').val());
        form.append("netAmt", $('#netClaimAmt').val());

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
        }).done(async function (response) {
            var data = JSON.parse(response);
            if(data.status == 200){
                await Swal.fire({
                    icon: 'success',
                    title: data.message,
                    timer: 3000,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });

                return window.location.replace(`/claim/detail/${data.klaimId}`);
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: data.message,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });
            }
        }).fail(async function(error){
            var data = JSON.parse(error.responseJSON);
            Swal.fire({
                icon: 'error',
                title: data.message,
                showConfirmButton: true,
            });
        });
    } else {
        return false
    }
}
