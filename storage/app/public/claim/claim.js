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

// fungsi button "search"
function search()
{
    document.getElementById('dataClient').style.display = "block";
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

    var cobId = document.getElementById('c_cob').value
    // alert('ye'+cob_id+'hore');
    $.ajax({
        url: "/request/get_caused?cobId="+cobId,
        type: "GET",
        dataType: "json",
        success: function (response) {
            console.log(response['data']);
            $("#ddCaused").empty();
            $("#ddCaused").append('<option value="0">-</option>');

            var len = 0;
            if (response['data'] != null) {
              len = response['data'].length;
            }

            if (len > 0) {
              for (var i = 0; i < len; i++) {
                var id = response['data'][i].id;
                var desc = response['data'][i].description;

                var opt = "<option value="+id+">"+desc+"</option>";

                $("#ddCaused").append(opt);
                }
            }

      }
    });
}
