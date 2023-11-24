function DataTablecfl() {
    Swal.fire({
        icon: "info",
        title: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });
    $.ajax({
        url: "/api/utiliy/cause-of-loss",
        method: "GET",
        timeout: 0,
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
    })
        .done(async function (response) {
            await $("#tablecfl").DataTable({
                processing: false,
                pageLength: 10,
                autoWidth: false,
                order: [],
                bDestroy: true,
                searching: true,
                scrollX: true,
                data: response.data,
                columns: [
                    { data: null, render: "id" },
                    { data: "cob_desc" },
                    { data: "description" },
                    {
                        data: "id",
                        render: function (data, type, row, meta) {
                            return `
                                <a href="/utility/cfl/update/${data}" class="btn btn-warning">
                                    <i class="fa fa-edit"> </i>
                                </a>
                                 <a href="/utility/cfl/show/${data}" class="btn btn-primary">
                                    <i class="fa fa-eye"> </i>
                                </a>
                            `;
                        },
                    },
                ],
                drawCallback: function () {
                    $("#tablecfl tr td:nth-child(4)").css(
                        "text-align",
                        "center"
                    );
                },
            });
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
            $("#tablecfl tr td:nth-child(4)").css("text-align", "center");
            Swal.close();
        })
        .fail(async function (response) {
            console.log(response);
        });
}
function getDataAsset() {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    $.ajax({
        url: `/api/utiliy/cause-of-loss/asset`,
        method: "GET",
        timeout: 0,
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
    })
        .done(function (response) {
            $("#cobid").append(
                $("<option>", {
                    value: "0",
                    text: "-- Choose type of cover --",
                })
            );

            $.each(response.data, function (i, item) {
                $("#cobid").append(
                    $("<option>", {
                        value: item.id,
                        text: item.cob_code,
                    })
                );
            });

            Swal.close();
        })
        .fail(function (response) {
            Swal.fire({
                icon: "error",
                text: response.message,
                allowOutsideClick: false,
            });
        });
}

function saveAllData() {
    Swal.fire({
        icon: "info",
        title: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });
    // console.log($("#cobid").val());
    if ($("#cobid").val() == 0) {
        Swal.fire({
            icon: "warning",
            text: "Harap pilih type of cover",
            timer: 2000,
            showConfirmButton: false,
            allowOutsideClick: false,
        });
    } else if ($("#deskripsi").val() == "") {
        Swal.fire({
            icon: "warning",
            text: "Harap isi description",
            timer: 2000,
            showConfirmButton: false,
            allowOutsideClick: false,
        });
    } else {
        const form = new FormData(document.getElementById("fcfl"));
        $.ajax({
            async: true,
            crossDomain: true,
            url: "/api/utiliy/cause-of-loss/insert",
            method: "POST",
            headers: {
                Authorization: "Bearer " + $("#token").val(),
            },
            processData: false,
            contentType: false,
            mimeType: "multipart/form-data",
            data: form,
        })
            .done(async function (response) {
                var data = JSON.parse(response);
                if (data.status == 200) {
                    Swal.fire({
                        icon: "info",
                        title: data.message,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        timer: 1000,
                    });
                } else {
                    Swal.fire({
                        icon: "warning",
                        title: data.message,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    });
                }
            })
            .fail(async function (error) {
                Swal.fire({
                    icon: "error",
                    title: error.responseJSON.message,
                    showConfirmButton: false,
                });
            });
    }
}
