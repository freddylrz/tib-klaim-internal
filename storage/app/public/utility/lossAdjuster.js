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
                    { data: "adj_phone" },
                    { data: "adj_email" },
                    { data: "adj_pic" },

                    {
                        data: "id",
                        render: function (data, type, row, meta) {
                            return `   <a href="/utility/lar/update/${data}" class="btn btn-warning">
                                    <i class="fa fa-edit"> </i>
                                </a>
                                 <a href="/utility/lar/show/${data}" class="btn btn-primary">
                                    <i class="fa fa-eye"> </i>
                                </a>
                                `;
                        },
                    },
                ],
                drawCallback: function () {
                    $("#tableLar tr td:nth-child(6)").css(
                        "text-align",
                        "center"
                    );
                },
            });
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust().draw();
            Swal.close();
            $("#tableLar tr td:nth-child(6)").css("text-align", "center");
        })
        .fail(async function (response) {
            console.log(response);
        });
}
function saveAlllar() {
    Swal.fire({
        icon: "info",
        title: "Loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    var name = $("#name").val();
    var address = $("#address").val();
    var postCode = $("#post_code").val();
    // var faxNo = $("#fax_no").val();
    var phoneNo = $("#phone_no").val();
    var email = $("#email").val();
    var npwp = $("#npwp").val();
    var pic = $("#pic").val();
    var picNo = $("#pic_no").val();

    if (
        name === "" ||
        address === "" ||
        postCode === "" ||
        // faxNo === "" ||
        phoneNo === "" ||
        email === "" ||
        npwp === "" ||
        pic === "" ||
        picNo === ""
    ) {
        Swal.fire({
            icon: "warning",
            title: "Harap isi semua kolom yang wajib diisi",
            timer: 2000,
            showConfirmButton: true,
            allowOutsideClick: false,
        });
    } else {
        const form = new FormData(document.getElementById("inlar"));
        $.ajax({
            async: true,
            crossDomain: true,
            url: "/api/utiliy/loss-adjuster/insert",
            method: "POST",
            headers: {
                Authorization: "Bearer " + $("#token").val(),
            },
            processData: false,
            contentType: false,
            mimeType: "multipart/form-data",
            data: form,
        })
            .done(function (response) {
                var data = JSON.parse(response);
                if (data.status == 200) {
                    Swal.fire({
                        icon: "info",
                        title: data.message,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    });
                    setTimeout(function () {
                        window.location.replace(
                            `/utility/lar/show/${data.lossAdjId}`
                        );
                    }, 1000);
                } else {
                    Swal.fire({
                        icon: "error", // Use an error icon for consistency
                        title: data.message,
                        showConfirmButton: false,
                        allowOutsideClick: false,
                    });
                }
            })
            .fail(function (error) {
                Swal.fire({
                    icon: "error",
                    title: error.responseJSON.message,
                    showConfirmButton: false,
                });
            });
    }
}

function getlarDetail() {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    $.ajax({
        url: `/api/utiliy/loss-adjuster/detail`,
        method: "GET",
        timeout: 0,
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
        data: {
            lossAdjId: $("#inlar").val(),
        },
    })
        .done(function (response) {
            $.each(response.data, function (i, item) {
                $("#name").html(item.name);
                $("#address").html(item.address);
                $("#postcode").html(item.post_code);
                $("#phone_no").html(item.phone_no);
                $("#fax_no").html(item.fax_no);
                $("#email").html(item.email);
                $("#npwp").html(item.npwp);
                $("#pic").html(item.pic);
                $("#pic_no").html(item.pic_no);
                $("#pic_email").html(item.pic_email);
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
function getlarUpdate() {
    Swal.fire({
        icon: "info",
        text: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    $.ajax({
        url: `/api/utiliy/loss-adjuster/detail`,
        method: "GET",
        timeout: 0,
        headers: {
            Authorization: "Bearer " + $("#token").val(),
        },
        data: {
            lossAdjId: $("#idlar").val(),
        },
    })
        .done(function (response) {
            $.each(response.data, function (i, item) {
                $("#name").val(item.name);
                $("#address").val(item.address);
                $("#post_code").val(item.post_code);
                $("#phone_no").val(item.phone_no);
                $("#fax_no").val(item.fax_no);
                $("#email").val(item.email);
                $("#npwp").val(item.npwp);
                $("#pic").val(item.pic);
                $("#pic_no").val(item.pic_no);
                $("#pic_email").val(item.pic_email);
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
function SavelarUpdate() {
    Swal.fire({
        icon: "info",
        title: "loading",
        showConfirmButton: false,
        allowOutsideClick: false,
    });

    var name = $("#name").val();
    var address = $("#address").val();
    var postCode = $("#post_code").val();
    var faxNo = $("#fax_no").val();
    var phoneNo = $("#phone_no").val();
    var email = $("#email").val();
    var npwp = $("#npwp").val();
    var pic = $("#pic").val();
    var picNo = $("#pic_no").val();

    if (
        name === "" ||
        address === "" ||
        postCode === "" ||
        faxNo === "" ||
        phoneNo === "" ||
        email === "" ||
        npwp === "" ||
        pic === "" ||
        picNo === ""
    ) {
        Swal.fire({
            icon: "warning",
            title: "Harap isi semua kolom yang wajib diisi",
            timer: 2000,
            showConfirmButton: true,
            allowOutsideClick: false,
        });
    } else {
        const form = new FormData(document.getElementById("Updatelar"));
        $.ajax({
            async: true,
            crossDomain: true,
            url: "/api/utiliy/loss-adjuster/update",
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
                data.status == 200;
                Swal.fire({
                    icon: "info",
                    title: data.message,
                    showConfirmButton: false,
                    allowOutsideClick: false,
                });
                setInterval(function () {
                    return window.location.replace(
                        `/utility/lar/show/` + $("#idlar").val()
                    );
                }, 3000);
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
