function Wsdatatabel() {
    Swal.fire({
        icon: "info",
        title: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });
    $.ajax({
        url: "/api/utiliy/workshop",
        method: "GET",
        timeout: 0,
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
    })
        .done(async function (response) {
            await $("#tableWs").DataTable({
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
                    { data: "ws_name" },
                    { data: "ws_pic" },
                    { data: "ws_email" },
                    { data: "ws_phone" },
                    {
                        data: "id",
                        render: function (data, type, row, meta) {
                            return `<a href="/admin/settings/branch/update/${data}" class="btn btn-warning">
                                    <i class="fa fa-edit"> </i>
                                </a>
                                <button class="btn btn-primary " onclick="onDelete(${data})">
                                    <i class="fa fa-eye"> </i>
                                </button>
                           <a> `;
                        },
                    },
                ],
                drawCallback: function (settings) {
                    $("#tablecfl tr td:nth-child(6)").css(
                        "text-align",
                        "center"
                    );
                },
            });
            Swal.close();
            $("#tablecfl tr td:nth-child(6)").css("text-align", "center");
        })
        .fail(async function (response) {
            console.log(response);
        });
}
