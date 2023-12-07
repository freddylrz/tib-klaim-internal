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
        e.preventDefault(); // Prevent default button behavior
        $('#fileInputupd').trigger('click');
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
        dataIns = response.Ins.map(function(ins) {
              return {
                "insName": ins.insName,
                "insId": ins.insId,
                "insShare": ins.insShare,
                "share": ins.insShare,
                "insPaidDD": ins.insPaidDD,
                "insAging": ins.insAging,
                "estAmt": ins.insEstAmt,
                "claimAmt": ins.insClaimAmt,
                "deducAmt": ins.insDeductAmt,
                "recovAmt": ins.insRecoveryAmt,
                "netAmt": ins.insNetClaim
              };
          })

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
            if (item.cob_id !== null) {
                $('#cobId').prop('disabled', true);
            } else {
                $('#cobId').prop('disabled', false);
            }
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

        if (response.dokument && response.dokument.length > 0) {
            response.dokument.forEach(function (item) {
                $('#listUpload').append(`
                    <li class="mb-1">
                        <a href="/${item.file_path}" target="_blank">${item.file_name}</a>
                        <button type="button" class="btn btn-sm btn-danger" onclick="deleteDocument(${item.id})"><i class="fa fa-trash"></i></button>
                    </li>
                `);
            });
        } else {
            $('#listUpload').append('<li>No attachments uploaded</li>');
        }

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
async function getPremiuminfo() {
    if (loadPremiumInfo === 0) {
        try {
            const response = await fetchPremiumInfo();

            displayClientPremiumInfo(response.data.client);
            displayInsPremiumInfo(response.data.ins);

            loadPremiumInfo = 1;
            hideOverlay();
        } catch (error) {
            console.error('Error fetching premium info:', error);
        }
    } else {
        console.log('Premium info has already been loaded.');
    }
}

async function fetchPremiumInfo() {
    try {
        const response = await $.ajax({
            url: `/api/claim/input/premium-info`,
            method: 'GET',
            headers: {
                Authorization: 'Bearer ' + $('#token').val(),
            },
            data: {
                prod_no: $('#prodNo').val(),
                draft_no: $('#draftNo').val(),
            },
        });
        return response;
    } catch (error) {
        throw new Error('Error fetching premium info');
    }
}

function displayClientPremiumInfo(clientData) {
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
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
}

function displayInsPremiumInfo(insData) {
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
}

function hideOverlay() {
    $('#overlayPremiumInfo').fadeOut();
}

async function getCountAmount() {
    if (!loadingIndicator) {
        const draft_no = $('#claimId').val() || 0;
        const estAmt = $('#estAmt').val() || 0;
        const claimAmt = $('#claimAmt').val() || 0;
        const deducAmt = $('#deducAmt').val() || 0;
        const recoveryAmt = $('#recoveryAmt').val() || 0;

        try {
            const response = await fetchClaimAmount(draft_no, estAmt, claimAmt, deducAmt, recoveryAmt);

            updateClaimAmountUI(response.data);
            $('#netClaimAmt').val(response.netClaimAmt);

            dataIns = response.data;
        } catch (error) {
            handleFailedResponse(error);
        }
    } else {
        return false;
    }
}

async function fetchClaimAmount(draft_no, estAmt, claimAmt, deducAmt, recoveryAmt) {
    try {
        const response = await $.ajax({
            url: `/api/claim/input/claim-amount`,
            method: 'GET',
            dataType: 'JSON',
            headers: {
                Authorization: 'Bearer ' + $("#token").val(),
            },
            data: {
                type: 2,
                draft_no,
                estAmt,
                claimAmt,
                deducAmt,
                recoveryAmt,
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
            },
        });
        return response;
    } catch (error) {
        throw new Error(error.responseJSON.message);
    }
}

function updateClaimAmountUI(data) {
    data.forEach(function (item) {
        $(`#claimAmount${item.insId}`).html(item.claimAmt);
        $(`#recoveryAmount${item.insId}`).html(item.recovAmt);
        $(`#deductionAmount${item.insId}`).html(item.deducAmt);
        $(`#netClaim${item.insId}`).html(item.netAmt);
    });
}

function handleFailedResponse(error) {
    Swal.fire({
        icon: 'error',
        text: error.message,
        allowOutsideClick: false,
    });
    loadingIndicator = false;
}

async function deleteDocument(docid) {
    if (docid === undefined) {
        Swal.fire({
            icon: 'error',
            title: 'Document tidak ditemukan!',
            showConfirmButton: true,
        });
        return;
    }

    const confirmation = await showDeleteConfirmation();
    if (!confirmation) return;

    try {
        $('#overlayClientData').fadeIn();
        const response = await deleteDocumentRequest(docid);
        handleDeleteResponse(response);
    } catch (error) {
        handleError(error);
    } finally {
        $('#overlayClientData').fadeOut();
    }
}

async function showDeleteConfirmation() {
    const result = await Swal.fire({
        icon: 'warning',
        title: 'Apakah anda yakin ingin menghapus file?',
        allowOutsideClick: false,
        showDenyButton: true,
        confirmButtonText: 'Ya, Lanjutkan',
        denyButtonText: `Tidak`,
    });
    return result.isConfirmed;
}

function deleteDocumentRequest(docid) {
    return $.ajax({
        url: '/api/claim/delete-document',
        method: 'DELETE',
        timeout: 0,
        headers: {
            Authorization: 'Bearer ' + $('#token').val(),
        },
        data: {
            fileId: docid,
        },
    });
}

function handleDeleteResponse(response) {
    Swal.fire({
        icon: 'info',
        title: response.message,
        showConfirmButton: true,
        allowOutsideClick: false,
    });

    $('#listUpload').empty();

    if (response.document && response.document.length > 0) {
        response.document.forEach((item) => {
            $('#listUpload').append(`
                <li class="mb-1">
                  <a style="margin-right:10px" href="/${item.file_path}/${item.file_name}" target="_blank">${item.file_name}</a>
                  <button type="button" class="btn btn-sm btn-danger" onclick="deleteDocument(${item.id})"><i class="fa fa-trash"></i></button>
                </li>
            `);
        });
    } else {
        $('#listUpload').append('<li>No attachment uploaded</li>');
    }
}

function handleError(error) {
    Swal.fire({
        icon: 'error',
        title: error.responseJSON.message,
        showConfirmButton: true,
        allowOutsideClick: false,
    });
}

async function saveEdit() {
    if (loadingIndicator) {
        return false;
    }

    try {
        showLoadingIndicator();
        if (!validateClientAndClaimAmount()) {
            return false;
        }

        const form = createFormData();

        await sendAjaxRequest(form);

    } catch (error) {
        handleError(error);
    } finally {
        hideLoadingIndicator();
    }
}

function showLoadingIndicator() {
    Swal.fire({
        showConfirmButton: false,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });
}

function validateClientAndClaimAmount() {
    if (dataClient.length === 0) {
        showErrorAlert('Mohon pilih client terlebih dahulu!');
        return false;
    }

    if (dataIns.length === 0) {
        showErrorAlert('Mohon isi claim amount terlebih dahulu!');
        return false;
    }

    return true;
}

function createFormData() {
    const form = new FormData();

    dataIns.forEach((item) => {
        form.append('insr_id[]', item.insr_code);
        form.append('premiIns[]', item.premi);
        form.append('estimationInsAmt[]', item.estAmt);
        form.append('claimInsAmt[]', item.claimAmt);
        form.append('deducInsAmt[]', item.deducAmt);
        form.append('recoveryInsAmt[]', item.recovAmt);
        form.append('netInsAmt[]', item.netAmt);
    });

    $('#fileInputupd').each(function () {
        const files = $(this).prop('files');

        if (files.length > 0) {
            for (let j = 0; j < files.length; j++) {
                form.append('fileUp[]', files[j]);
            }
        }
    });

    form.append("claimId", $('#claimId').val());
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

    return form;
}

async function sendAjaxRequest(form) {
    const response = await $.ajax({
        async: true,
        crossDomain: true,
        url: '/api/claim/update-claim',
        method: 'POST',
        headers: {
            Authorization: 'Bearer ' + $('#token').val(),
        },
        processData: false,
        contentType: false,
        mimeType: 'multipart/form-data',
        data: form,
        beforeSend: function () {
            loadingIndicator = true;
            $('#btnSaveAll').attr('disabled', true);
            $('#btnSaveAll').html('<i class="fas fa-spinner fa-spin"></i> Loading');
        },
        complete: function () {
            loadingIndicator = false;
            $('#btnSaveAll').attr('disabled', false);
            $('#btnSaveAll').html('<i class="fas fa-save"></i> Save Edit');
        }
    });

    handleAjaxResponse(response);
}

function handleAjaxResponse(response) {
    const data = JSON.parse(response);
    if (data.status === 200) {
        showSuccessAlertAndRedirect(data.message, data.klaimId);
    } else {
        showWarningAlert(data.message);
    }
}

function handleError(error) {
    Swal.fire({
        icon: 'error',
        title: error.responseJSON.message,
        showConfirmButton: true,
    });
}

function hideLoadingIndicator() {
    Swal.close();
}

function showErrorAlert(message) {
    Swal.fire({
        icon: 'error',
        text: message,
        allowOutsideClick: false,
    });
}

function showSuccessAlertAndRedirect(message, klaimId) {
    Swal.fire({
        icon: 'info',
        title: message,
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    return window.location.replace(`/claim/detail/${klaimId}`);
}

function showWarningAlert(message) {
    Swal.fire({
        icon: 'warning',
        title: message,
        showConfirmButton: false,
        allowOutsideClick: false,
    });
}
