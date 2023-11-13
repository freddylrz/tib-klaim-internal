var base_url = window.location.origin;

$(function() {
    $('#tbsppa').DataTable({
        "paging": true,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "scrollX": true
    });

    // List data dari webapps
    $('#tbsppa').on('click', 'tbody tr', function() {
        // tampilin checklis tanda di select
        $('.tanda').css('display', 'none');
        $(this).closest('tr').find('.tanda').css('display', 'block');

        // ambil data satu row
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        // reload dan hide client info
        document.getElementById('c_info').style.display = "none";
        document.getElementById('dataKlaim').style.display = "none";
        document.getElementById('dataAmount').style.display = "none";
        document.getElementById('c_amount').value = "";
        $("#c_info").load(" #c_info > *");

        // simpan id data klaim
        document.getElementById('sppa_id').value = data[0];
        typeNo = 1;
        // sppa(1);
    });

    // List data dari foxprodb (sistem pak boy)
    $('#tbclient').on('click', 'tbody tr', function() {
        // tampilin checklis tanda di select
        $('.tanda').css('display', 'none');
        $(this).closest('tr').find('.tanda').css('display', 'block');

        // ambil data satu row
        $tr = $(this).closest('tr');
        var data = $tr.children("td").map(function() {
            return $(this).text();
        }).get();

        // reload dan hide client info
        document.getElementById('c_info').style.display = "none";
        document.getElementById('dataKlaim').style.display = "none";
        document.getElementById('dataAmount').style.display = "none";
        document.getElementById('c_amount').value = "";
        $("#c_info").load(" #c_info > *");

        // simpan id data klaim
        document.getElementById('polis_id').value = data[0];
        typeNo = 2;
        // sppa(2);
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


// fungsi button "search"
function search()
{
    $('#dataClient').slideDown()
}

// Fungsi button "Load"
function info()
{
    document.getElementById('c_info').style.display = "block";
}


function dataKlaim()
{
    document.getElementById('dataKlaim').style.display = "block";
    document.getElementById('dataAmount').style.display = "block";
}
