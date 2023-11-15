var base_url = window.location.origin;
var loadPremiumInfo = 0;

$(function() {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    getDataAsset()

    $('#tbsppa').on('click', 'tbody tr', function() {
        $('.tanda').css('display', 'none');
        $(this).closest('tr').find('.tanda').css('display', 'block');

        $('#prodNo').val($(this).closest('tr').find('.tanda').data('prod'));

        $('#clientInfo').slideUp();
        $('#overlayClientInfo').fadeIn();
        $('#overlayPremiumInfo').fadeIn();
        loadPremiumInfo = 0;
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
        }
    });

    // Event listener for tab click
    $('#clientInfo .nav-link').on('click', function(e) {
        e.preventDefault(); // Prevent the default behavior of the anchor link

        // Check if the clicked tab is the Premium Info tab
        if ($(this).attr('id') === 'premium-info-tab') {
            // Call getPremiuminfo() function when the Premium Info tab is clicked
            getPremiuminfo();
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
        "url": `${base_url}/api/claim/input/asset`,
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
        url: `${base_url}/api/claim/input/dataTable`,
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
        url: `${base_url}/api/claim/input/data-client`,
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
            $('#clientName').html(item.name_wrt)
            $('#typeOFCover').val(item.type_of_cover)
            $('#polisNo').val(item.pol_no)
            $('#interestInsured').val(item.interest_insured)
            $('#startDd').val(item.start_dd)
            $('#endDd').val(item.end_dd)
            $('#tsi').val(`${item.curr_code} ${item.tsi}`)
        });

        $('#overlayClientInfo').fadeOut();
    })

    $('#clientInfo').slideDown()
    loadPremiumInfo = 0;
}

function getPremiuminfo() {
    // Check if loadPremiumInfo is 0 before fetching premium info
    if (loadPremiumInfo === 0) {
        $.ajax({
            url: `${base_url}/api/claim/input/premium-info`,
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

        $('#dataClient').slideDown();
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
        url: `${base_url}/api/claim/input/share-insurance`,
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
            order: [],
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
                    data: "insr_id",
                    render: function(data, type, row) {
                        return `<span id="claimAmount${data}"></span>`;
                    },
                    orderable: false
                },
                {
                    data: "insr_id",
                    render: function(data, type, row) {
                        return `<span id="recoveryAmount${data}"></span>`;
                    },
                    orderable: false
                },
                {
                    data: "insr_id",
                    render: function(data, type, row) {
                        return `<span id="deductionAmount${data}"></span>`;
                    },
                    orderable: false
                },
                {
                    data: "insr_id",
                    render: function(data, type, row) {
                        return `<span id="netClaim${data}"></span>`;
                    },
                    orderable: false
                }
            ],
        });

        $('#overlayDataAmount').fadeOut();
        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
    })
}
