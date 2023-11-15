function datatabelLar() {
    Swal.fire({
        icon: "info",
        title: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });
    $.ajax({
        url: "/api/utiliy/loss-adjuster",
        method: "GET",
        timeout: 0,
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
    })
        .done(async function (response) {
            await $("#tableLar").DataTable({
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
                    { data: "adj_name" },
                    { data: "adj_pic" },
                    { data: "adj_email" },
                    { data: "adj_phone" },
                    {
                        data: "id",
                        render: function (data, type, row, meta) {
                            return ` <a
                                    href="/admin/settings/branch/update/ + data + "
                                    class="btn btn-primary btn-block"
                                >
                                    <i class="fa fa-edit"></i>
                                </a>`;
                        },
                    },
                ],
            });
            Swal.close();
        })
        .fail(async function (response) {
            console.log(response);
        });
}
