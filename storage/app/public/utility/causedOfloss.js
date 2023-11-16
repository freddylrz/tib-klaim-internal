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
                                <a href="/admin/settings/branch/update/${data}" class="btn btn-warning">
                                    <i class="fa fa-edit"> </i>
                                </a>
                                <button class="btn btn-primary " onclick="onDelete(${data})">
                                    <i class="fa fa-eye"> </i>
                                </button>
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
            $("#tablecfl tr td:nth-child(4)").css("text-align", "center");
            Swal.close();
        })
        .fail(async function (response) {
            console.log(response);
        });
}
