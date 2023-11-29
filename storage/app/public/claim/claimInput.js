var loadPremiumInfo = 0;
var loadingIndicator = false;
var claimAmount = [];
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
    $('.datetimepicker-input').datetimepicker({
        format: "DD-MM-YYYY",
    });

    getDataAsset()

    $('#tbsppa').on('click', 'tbody tr', function() {
        $('.tanda').css('display', 'none');
        $(this).closest('tr').find('.tanda').css('display', 'block');

        $('#prodNo').val($(this).closest('tr').find('.tanda').data('prod'));
        $('#draftNo').val($(this).closest('tr').find('.tanda').data('draft'));

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
            $('#draftNo').val('')
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

    $('#btnDataCLaim').on('click', function(e) {
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

        saveAllData()
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
    })

    $('#clientInfo').slideUp();
    $('#dataClaim').slideUp();
    $('#dataAmount').slideUp();
    $('#prodNo').val('');
    $('#draftNo').val('');
    $('#dataClient').slideDown();
    $('#clientInfoFooter').slideDown();
    $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
    loadPremiumInfo = 0;
    claimAmount = [];
    dataClient= [];
}

// Fungsi button "Load"
function getClientinfo() {
    if($('#prodNo').val() == '' || $('#draftNo').val() == '') {
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
            draft_no: $('#draftNo').val(),
        }
    })
    .done(function (response) {
        response.data.forEach(function (item) {
            $('#draftNo').val(item.DRAFT_NO)
            $('#prodNo').val(item.PROD_NO)
            $('#insdId').val(item.insd_id)
            $('#nameWrt').val(item.name_wrt)
            $('#typeOFCover').val(item.type_of_cover)

            $('#cobId').val(item.cob_id)
            $('#cobId').trigger('change');

            if (item.cob_id !== null) {
                $('#cobId').prop('disabled', true);
            } else {
                $('#cobId').prop('disabled', false);
            }

            $('#currId').val(item.curr_id)
            $('#currId').trigger('change');

            $('#polisNo').val(item.pol_no)
            $('#interestInsured').val(item.interest_insured)
            $('#startDd').val(item.start_dd)
            $('#endDd').val(item.end_dd)
            $('#tsi').val(`${item.curr_code} ${item.tsi}`)

            $('#txtnameWrt').html(item.name_wrt)
            $('#txttypeOFCover').html(item.type_of_cover)
            $('#txtpolisNo').html(item.pol_no)
            $('#txtinterestInsured').html(item.interest_insured)
            $('#txtperiod').html(item.periode)
            $('#txttsi').html(`${item.curr_code} ${item.tsi}`)

            $('#clientName').html(`${item.name_wrt} (CLIENT)`)
        });

        $('#currId').on('change', function () {
            $(this).val();
        });

        $('#cobId').on('change', function () {
            $(this).val();
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
    $('#clientInfoFooter').slideUp();
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
                    data: "deducAmt",
                    render: function(data, type, row) {
                        return `<span id="deductionAmount${row.insr_id}">${data}</span>`;
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
                type: 1,
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
            form.append("insr_id[]", item.insr_code);;
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
                Swal.fire({
                    icon: 'info',
                    title: data.message,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });

                setInterval(function () {
                    return window.location.replace(`/claim/detail/${data.klaimId}`);
                }, 3000);
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
