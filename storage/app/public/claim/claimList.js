var loadingIndicator = false;
let timer;

$(function() {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    getDataAsset()

    $('#btnLoad').on('click', function(e) {
        clearTimeout(timer);
        timer = setTimeout(fetchData, 500); // Debounce time (500ms)
	});

    $("#tbClaim").DataTable({
        processing: false,
        pageLength: 10,
        autoWidth: false,
        order: [],
        bDestroy: true,
        searching: true,
        scrollX: true,
        sScrollXInner: "100%",
        columns: [
            { data: "claim_no" },
            { data: "created_at" },
            { data: "name_wrt" },
            { data: "dol" },
            { data: "cob_code" },
            { data: "username" },
            {
                data: "statDesc",
                render: function(data, type, row) {
                    let classForAnchor = '';

                    // Assign different classes based on row.statId
                    switch (row.statId) {
                        case 1:
                            classForAnchor = 'bg-lightblue';
                            break;
                        case 2:
                            classForAnchor = 'bg-primary';
                            break;
                        case 3:
                            classForAnchor = 'bg-info';
                            break;
                        case 4:
                            classForAnchor = 'bg-purple';
                            break;
                        case 5:
                            classForAnchor = 'bg-teal';
                            break;
                        case 6:
                            classForAnchor = 'bg-olive';
                            break;
                        case 7:
                            classForAnchor = 'bg-success';
                            break;
                        case 8:
                            classForAnchor = 'bg-success';
                            break;
                        case 9:
                            classForAnchor = 'bg-danger';
                            break;
                        default:
                            classForAnchor = 'bg-gray-dark'; // Default class
                            break;
                    }

                    return `
                        <a href="/claim/detail/${row.id}" class="btn btn-block ${classForAnchor}">${data}</a>
                    `;
                }
            }
        ],
    });
})

function getDataAsset() {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    $.ajax({
        "url": `/api/claim/asset-datatable`,
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer " + $('#token').val()
        },
    }).done(function (response) {
        response.listStatus.forEach(function (item) {
            $('#statusId').append($('<option>', {
                value: item.type,
                text: item.filterDesc
            }));
        });
        response.listCOB.forEach(function (item) {
            $('#cobId').append($('<option>', {
                value: item.id,
                text: item.cob_desc
            }));
        });

        Swal.close();

        return fetchData()
    }).fail(function (response){
        Swal.fire({
            icon: "error",
            text: response.message,
            allowOutsideClick: false,
        });
    });
}

function fetchData() {
    if(loadingIndicator == false){
        if($('#valueParameter').val() == '') {
            Swal.fire({
                icon: "error",
                text: "Value tidak boleh kosong!",
                allowOutsideClick: false,
            });

            return false
        }

        $.ajax({
            url: `/api/claim/list-claim`,
            method: "GET",
            headers: {
                Authorization: "Bearer " + $("#token").val(),
            },
            data: {
                typeStatus: $('#statusId').val(),
                typeCOB: $('#cobId').val()
            },
            beforeSend: function () {
                loadingIndicator = true;
                $('#overlayDataClaim').fadeIn();
                $('#btnLoad').attr('disabled', true);
                $('#btnLoad').html('<i class="fas fa-spinner fa-spin"></i> Loading');
            },
            complete: function () {
                loadingIndicator = false;
                $('#overlayDataClaim').fadeOut();
                $('#btnLoad').attr('disabled', false);
                $('#btnLoad').html('<i class="fas fa-save"></i> Load');
            }
        })
        .done(async function (response) {
            updateDataTable(response.list);
        })

        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
    } else {
        return false
    }
}

// Function to update DataTable with new data
function updateDataTable(data) {
    // Clear existing table data
    $('#tbClaim').DataTable().clear().rows.add(data).draw();
}
