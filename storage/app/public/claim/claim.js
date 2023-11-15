var base_url = window.location.origin;

$(function() {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    getDataAsset()

    // List data dari webapps
    $('#tbsppa').on('click', 'tbody tr', function() {
        // tampilin checklis tanda di select
        $('.tanda').css('display', 'none');
        $(this).closest('tr').find('.tanda').css('display', 'block');

        // simpan prod no
        $('#prodNo').val($(this).closest('tr').find('.tanda').data('prod'));

        // reload dan hide client info
        $('#c_info').slideUp();
        $('#dataKlaim').slideUp();
        $('#dataAmount').slideUp();
        document.getElementById('c_amount').value = "";
        $("#c_info").load(" #c_info > *");
    });

    $('.filter').on('change', function() {
        if ($('#dataClient').is(':visible')) {
            $('#dataClient').slideUp();
            $('#overlayDataClient').fadeIn();
        }
    });
});

function getDataAsset() {
    $.ajax({
        "url": base_url.concat('/api/claim/input/asset'),
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
    });
}

function search() {
    $.ajax({
        url: "/api/claim/input/dataTable",
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

    $('#dataClient').slideDown()
    $($.fn.dataTable.tables(true)).DataTable()
       .columns.adjust();
}

// Fungsi button "Load"
function info() {

    $.ajax({
        url: "/api/claim/input/data-client",
        method: "GET",
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
        data: {
            prod_no: $('#prodNo').val(),
        }
    })
    .done(async function (response) {
        $.each(response.data, function (i, item) {
            $('#draftNo').val(item.DRAFT_NO)
            $('#prodNo').val(item.PROD_NO)
            $('#insdId').val(item.insd_id)
            $('#nameWrt').val(item.name_wrt)
            $('#polisNo').val(item.pol_no)
            $('#interestInsured').val(item.interest_insured)
            $('#startDd').val(item.start_dd)
            $('#endDd').val(item.end_dd)
            $('#currCode').val(item.curr_code)
            $('#tsi').val(item.tsi)
        });

        $('#overlayClientInfo').fadeOut();
    })

    $('#c_info').slideDown()
}


function dataKlaim() {
    document.getElementById('dataKlaim').style.display = "block";
    document.getElementById('dataAmount').style.display = "block";
}
