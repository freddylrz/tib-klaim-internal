var loadingIndicator = false;

$(function() {
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    getDataAsset()

    $('#btnLoad').on('click', function(e) {

        load()
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

        return load()
    }).fail(function (response){
        Swal.fire({
            icon: "error",
            text: response.message,
            allowOutsideClick: false,
        });
    });
}

function load() {
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
            await $("#tbClaim").DataTable({
                processing: false,
                pageLength: 10,
                autoWidth: false,
                order: [],
                bDestroy: true,
                searching: true,
                scrollX: true,
                sScrollXInner: "100%",
                data: response.list,
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
                            return `
                                <a href="/claim/detail/${row.id}" class="btn btn-primary btn-block">${data}</a>
                            `;
                        }
                    }
                ],
            });
        })

        $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
    } else {
        return false
    }
}
