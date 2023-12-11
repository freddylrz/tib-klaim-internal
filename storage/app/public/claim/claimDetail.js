var loadPremiumInfo = 0;
var dataClientInfo = [];
var dataClient = [];
var dataIns = [];
var dataDecument = [];
var dataLog = [];
var inputStatusId = 0;
var cobId = 0;
var desc = '-';
var paidDate = 0;

const showButtons = {
    '#btnOnProcess': [1, 2, 3],
    '#btnProposeAdjustment': [1, 2, 3],
    '#btnEdit': [1, 2, 3],
    '#btnSettled': [4],
    '#btnProcessFinal': [5, 6],
    '#btnUpdatePembayaran': [5],
    '#btnTolak': [1, 2, 3, 4],
    '#btnRollbackStatus': [1, 2, 3, 4, 5, 6, 7],
    '#btnAddRecovery': [5, 6, 7],
    '#btnFinal': [7]
};

$(function() {
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

    getDetail()

    // Event listener for tab click
    $('#clientInfo .nav-link').on('click', function(e) {
        // Check if the clicked tab is the Premium Info tab
        if ($(this).attr('id') === 'premium-info-tab') {
            // Call getPremiuminfo() function when the Premium Info tab is clicked
            getPremiuminfo();
        }
    });

    $('.btnfilesupd').on('click', function() {
        $('#fileInputupd').trigger('click');
	});

    $('#fileInputupd').on('change', function(e) {
		var thefiles = $('#fileInputupd').get(0).files.length;
		$('.listfilesupd').html('');
		for (var i = 0; i < thefiles; ++i) {
            var file = $(this).get(0).files.item(i);
            var name = file.name;
            var fileUrl = URL.createObjectURL(file); // Create URL for the file
			$('.listfilesupd').append(`<li><a href="${fileUrl}" target="_blank">${name}</a></li>`);
		}
	});

    $('#btnRollbackStatus').on('click', async function() {
        try {
            const confirmationResult = await Swal.fire({
                icon: 'warning',
                title: 'Apakah anda yakin?',
                allowOutsideClick: false,
                showDenyButton: true,
                confirmButtonText: 'Ya, Lanjutkan',
                denyButtonText: `Tidak`,
            });

            if (confirmationResult.isConfirmed) {
                const response = await $.ajax({
                    url: `/api/claim/rollback`,
                    method: 'POST',
                    dataType: 'JSON',
                    headers: {
                        Authorization: 'Bearer ' + $("#token").val(),
                    },
                    data: {
                        klaimId: $('#claimId').val(),
                    },
                    beforeSend: function () {
                        Swal.fire({
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            },
                        });
                    },
                });

                await Swal.fire({
                    icon: 'success',
                    timer: 3000,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });

                return window.location.reload();
            } else if (confirmationResult.isDenied) {
                Swal.fire({
                    icon: 'error',
                    title: 'Perubahan tidak disimpan',
                    showConfirmButton: true,
                    allowOutsideClick: false,
                });
            }
        } catch (error) {
            Swal.fire({
                icon: 'error',
                text: error.responseJSON ? error.responseJSON.message : 'Terjadi kesalahan',
                allowOutsideClick: false,
            });
        }
    });

    $('#formOnProcess').on('submit', function(e){
        e.preventDefault()

        const files = $('#fileInputupd').prop('files');

        if (!files || files.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Please select file(s)',
                showConfirmButton: true,
            });
            return false; // Stop further execution
        }
        inputStatusId = $("#ddOnPro").val()
        desc = $("#descOnPro").val()

        submitClaimValidation()
    })

    $('#formProposeAdjustment').on('submit', async function(e){
        e.preventDefault()

        const confirmationResult = await Swal.fire({
            icon: 'warning',
            title: 'Apakah anda yakin?',
            allowOutsideClick: false,
            showDenyButton: true,
            confirmButtonText: 'Ya, Lanjutkan',
            denyButtonText: `Tidak`,
        });

        if (confirmationResult.isConfirmed) {
            const files = $('#fileInputupd').prop('files');

            if (!files || files.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Please select file(s)',
                    showConfirmButton: true,
                });
                return false; // Stop further execution
            }
            inputStatusId = 4
            desc = $("#descPorposeAdjustment").val()

            submitClaimValidation()
        } else if (confirmationResult.isDenied) {
            Swal.fire({
                icon: 'error',
                title: 'Perubahan tidak disimpan',
                showConfirmButton: true,
                allowOutsideClick: false,
            });
        }
    })

    $('#formSettled').on('submit', async function(e){
        e.preventDefault()

        const confirmationResult = await Swal.fire({
            icon: 'warning',
            title: 'Apakah anda yakin?',
            allowOutsideClick: false,
            showDenyButton: true,
            confirmButtonText: 'Ya, Lanjutkan',
            denyButtonText: `Tidak`,
        });

        if (confirmationResult.isConfirmed) {
            const files = $('#fileInputupd').prop('files');

            if (!files || files.length === 0) {
                Swal.fire({
                    icon: 'error',
                    title: 'Please select file(s)',
                    showConfirmButton: true,
                });
                return false; // Stop further execution
            }
            inputStatusId = 5
            desc = $("#descSet").val()

            submitClaimValidation()
        } else if (confirmationResult.isDenied) {
            Swal.fire({
                icon: 'error',
                title: 'Perubahan tidak disimpan',
                showConfirmButton: true,
                allowOutsideClick: false,
            });
        }
    })

    $('#formPembayaranAsuransi').on('submit', async function(e){
        e.preventDefault();

        const files = $('#fileInputupd').prop('files');
        const insuranceCheckboxes = $('#listInsurance input[type="checkbox"]'); // Select all insurance checkboxes

        if (!files || files.length === 0) {
            Swal.fire({
                icon: 'error',
                title: 'Please select file(s)',
                showConfirmButton: true,
            });
            return false; // Stop further execution
        }

        // Check if no insurance checkbox is checked
        if (!insuranceCheckboxes.is(':checked')) {
            Swal.fire({
                icon: 'error',
                title: 'Please select at least one insurance',
                showConfirmButton: true,
            });
            return false; // Stop further execution
        }

        inputStatusId = 6;
        paidDate = $("#dateIns").val();

        submitClaimValidation();
    });

    $('#formProsesFinal').on('submit', async function(e){
        e.preventDefault();

        const confirmationResult = await Swal.fire({
            icon: 'warning',
            title: 'Apakah anda yakin?',
            allowOutsideClick: false,
            showDenyButton: true,
            confirmButtonText: 'Ya, Lanjutkan',
            denyButtonText: `Tidak`,
        });

        if (confirmationResult.isConfirmed) {
            e.preventDefault()

            inputStatusId = 7
            desc = $("#descProsesFinal").val()

            submitClaimValidation()
        } else if (confirmationResult.isDenied) {
            Swal.fire({
                icon: 'error',
                title: 'Perubahan tidak disimpan',
                showConfirmButton: true,
                allowOutsideClick: false,
            });
        }
    })

    $('#formFinal').on('submit', async function(e){
        e.preventDefault()

        const confirmationResult = await Swal.fire({
            icon: 'warning',
            title: 'Apakah anda yakin?',
            allowOutsideClick: false,
            showDenyButton: true,
            confirmButtonText: 'Ya, Lanjutkan',
            denyButtonText: `Tidak`,
        });

        if (confirmationResult.isConfirmed) {
            inputStatusId = 8
            desc = $("#descProsesFinal").val()

            submitClaimValidation()
        } else if (confirmationResult.isDenied) {
            Swal.fire({
                icon: 'error',
                title: 'Perubahan tidak disimpan',
                showConfirmButton: true,
                allowOutsideClick: false,
            });
        }
    })

    $('#formTolak').on('submit', async function(e){
        e.preventDefault()

        const confirmationResult = await Swal.fire({
            icon: 'warning',
            title: 'Apakah anda yakin?',
            allowOutsideClick: false,
            showDenyButton: true,
            confirmButtonText: 'Ya, Lanjutkan',
            denyButtonText: `Tidak`,
        });

        if (confirmationResult.isConfirmed) {
            inputStatusId = 8
            desc = $("#descTolak").val()

            submitClaimValidation()
        } else if (confirmationResult.isDenied) {
            Swal.fire({
                icon: 'error',
                title: 'Perubahan tidak disimpan',
                showConfirmButton: true,
                allowOutsideClick: false,
            });
        }
    })
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

            for (const [button, statuses] of Object.entries(showButtons)) {
                if (statuses.includes(item.statId)) {
                    $(button).show();
                } else {
                    $(button).hide();
                }
            }

            // Handling btnRollbackStatus separately
            if (![1, 8, 9].includes(item.statId)) {
                $('#btnRollbackStatus').show();
            } else {
                $('#btnRollbackStatus').hide();
            }
        });

        if (response.dokument && response.dokument.length > 0) {
            response.dokument.forEach(function (item) {
                $('#uploadedAttachment').append(`
                    <li class="mb-1">
                        <a href="/${item.file_path}" target="_blank">${item.file_name}</a>
                    </li>
                `);
            });
        } else {
            $('#uploadedAttachment').append('<li>No attachments uploaded</li>');
        }

        response.Ins.forEach(item => {
            const insuranceElement = `
                <div class="icheck-primary">
                    <input type="checkbox" id="insCheckbox${item.insId}">
                    <label for="insCheckbox${item.insId}">
                        ${item.insName}
                    </label>
                </div>
            `;
            $('#listInsurance').append(insuranceElement);
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
    .fail(async function(){
        await Swal.fire({
            icon: "error",
            text: "Claim Id tidak ditemukan!",
            allowOutsideClick: false,
        });

        return window.location.replace(`/claim/list`);
    })

    loadPremiumInfo = 0;
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

async function submitClaimValidation() {
    if (inputStatusId !== 0) {
        const form = createFormData();

        try {
            const response = await sendValidationRequest(form);
            handleValidationSuccess(response);
        } catch (error) {
            handleValidationError(error);
        }
    } else {
        return false;
    }
}

function createFormData() {
    const form = new FormData();
    form.append("klaimId", $('#claimId').val());
    form.append("statusId", inputStatusId);
    form.append("description", desc);

    dataClient.forEach(function (item) {
        form.append("cobId", item.cob_id);
    });

    $('#fileInputupd').each(function () {
        const files = $(this).prop('files');

        if (files.length > 0) {
            for (let j = 0; j < files.length; j++) {
                form.append('fileUpd[]', files[j]);
            }
        }
    });

    if (inputStatusId === 6) {
        dataIns.forEach(item => {
            const checkbox = $(`#insCheckbox${item.insId}`);
            const isChecked = checkbox.is(':checked');

            if (isChecked) {
                form.append("ins[]", item.insId);
            }
        });
        form.append("paid_date", paidDate);
    }

    return form;
}

async function sendValidationRequest(form) {
    try {
        const response = await $.ajax({
            async: true,
            crossDomain: true,
            url: "/api/claim/validation",
            method: "POST",
            headers: {
                Authorization: "Bearer " + $("#token").val(),
            },
            processData: false,
            contentType: false,
            mimeType: "multipart/form-data",
            data: form,
            beforeSend: function () {
                showLoadingPopup();
            },
        });
        return response;
    } catch (error) {
        throw error;
    }
}

function showLoadingPopup() {
    Swal.fire({
        showConfirmButton: false,
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        },
    });
}

function handleValidationSuccess(response) {
    Swal.fire({
        icon: 'success',
        timer: 3000,
        showConfirmButton: false,
        allowOutsideClick: false,
    }).then(() => {
        window.location.reload();
    });
}

function handleValidationError(error) {
    Swal.fire({
        icon: 'error',
        title: error.responseJSON ? error.responseJSON.message : 'Terjadi kesalahan',
        showConfirmButton: true,
    });
}
