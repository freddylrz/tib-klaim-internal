
$(function () {
    getDataDashbaord()

    var areaChartData =
    {
      labels  :
          [
                                          'PAR'
                            ,
                                        'MC'
                            ,
                                        'MCI'
                            ,
                                        'VA'
                            ,
                                        'LB'
                            ,
                                        'MI'
                            ,
                    ],
      datasets: [
        {
          label               : 'On Process',
          backgroundColor     : '#007bff',
          borderColor         : '#007bff',
          pointRadius          : false,
          pointColor          : '#007bff',
          pointStrokeColor    : '#007bff',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: '#007bff',
          data                : [  6,  1,  9,  16,  1,  10,  ]
        },
        {
          label               : 'Settled',
          backgroundColor     : '#20c997',
          borderColor         : '#20c997',
          pointRadius         : false,
          pointColor          : '#20c997',
          pointStrokeColor    : '#20c997',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: '#20c997',
          data                :  [  0,  0,  0,  1,  0,  0,  ]
        },
        {
          label               : 'Proses Bayar',
          backgroundColor     : '#3d9970',
          borderColor         : '#3d9970',
          pointRadius         : false,
          pointColor          : '#3d9970',
          pointStrokeColor    : '#3d9970',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: '#3d9970',
          data                :  [  0,  0,  0,  0,  0,  1,  ]
        },

        {
          label               : 'Ditolak',
          backgroundColor     : '#dc3545',
          borderColor         : '#dc3545',
          pointRadius         : false,
          pointColor          : '#dc3545',
          pointStrokeColor    : '#dc3545',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: '#dc3545',
          data                :  [  0,  0,  0,  1,  0,  0,  ]
        },

      ]
    }

    //-------------
    //- BAR CHART COB -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)

    var barChartOptions =
    {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var barChart = new Chart(barChartCanvas,
    {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })


    var areaChartDataLoss =
    {
        labels  :
        [
                        ],
        datasets:
        [{
            label               : 'Loss (%)',
            backgroundColor     : '#007bff',
            borderColor         : '#007bff',
            pointRadius          : false,
            pointColor          : '#007bff',
            pointStrokeColor    : '#007bff',
            pointHighlightFill  : '#fff',
            pointHighlightStroke: '#007bff',
            data                : [  ]
        },]
    }


    //-------------
    //- BAR CHART LOSS -
    //-------------
    var lossChartCanvas = $('#barChartLoss').get(0).getContext('2d')
    var lossChartData = $.extend(true, {}, areaChartDataLoss)

    var lossChartOptions =
    {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    var lossChart = new Chart(lossChartCanvas,
    {
      type: 'bar',
      data: lossChartData,
      options: lossChartOptions
    })
});


function getDataDashbaord() {
    $.ajax({
        "url": `/api/dashboard`,
        "method": "GET",
        "timeout": 0,
        "headers": {
            "Authorization": "Bearer " + $('#token').val()
        },
    }).done(async function (response) {
        await response.data1.forEach(function (item) {
            $('#total').html(item.total)
            $('#tot_laporan_awal').html(item.tot_laporan_awal)
            $('#tot_onprocess').html(item.tot_onprocess)
            $('#tot_settled').html(item.tot_settled)
            $('#tot_bayar').html(item.tot_bayar)
            $('#tot_final').html(item.tot_final)
            $('#tot_tolak').html(item.tot_tolak)
        })

        await $("#tbKlaimBerjalan").DataTable({
            processing: false,
            pageLength: 10,
            autoWidth: false,
            bDestroy: true,
            scrollX: true,
            paging: false, // Disable pagination
            searching: false, // Disable search
            ordering: false, // Disable sorting
            info: false, // Disable table information display
            sScrollXInner: "100%",
            data: response.data2,
            columns: [
                { data: "statusDesc"},
                {
                    data: "value1",
                    render: function(data, type, row) {
                        let statusClass = getStatusClass(row.statusDesc);
                        return `
                            <span class="btn-sm btn-block text-center font-weight-bold ${statusClass}">${data}</span>
                        `;
                    },
                    className: 'dt-head-center',
                },
                {
                    data: "value2",
                    render: function(data, type, row) {
                        let statusClass = getStatusClass(row.statusDesc);
                        return `
                            <span class="btn-sm btn-block text-center font-weight-bold ${statusClass}">${data}</span>
                        `;
                    },
                    className: 'dt-head-center',
                },
                {
                    data: "value3",
                    render: function(data, type, row) {
                        let statusClass = getStatusClass(row.statusDesc);
                        return `
                            <span class="btn-sm btn-block text-center font-weight-bold ${statusClass}">${data}</span>
                        `;
                    },
                    className: 'dt-head-center',
                },
                {
                    data: "value4",
                    render: function(data, type, row) {
                        let statusClass = getStatusClass(row.statusDesc);
                        return `
                            <span class="btn-sm btn-block text-center font-weight-bold ${statusClass}">${data}</span>
                        `;
                    },
                    className: 'dt-head-center',
                },
                {
                    data: "value5",
                    render: function(data, type, row) {
                        let statusClass = getStatusClass(row.statusDesc);
                        return `
                            <span class="btn-sm btn-block text-center font-weight-bold ${statusClass}">${data}</span>
                        `;
                    },
                    className: 'dt-head-center',
                },
            ],
        });

        await $("#tbStatusKlaim").DataTable({
            processing: false,
            pageLength: 10,
            autoWidth: false,
            bDestroy: true,
            scrollX: true,
            paging: false, // Disable pagination
            searching: false, // Disable search
            ordering: false, // Disable sorting
            info: false, // Disable table information display
            sScrollXInner: "100%",
            data: response.data3,
            columns: [
                { data: "cobDesc"},
                {
                    data: "tot_laporan_awal",
                    render: function(data, type, row) {
                        return `
                            <span class="btn-sm btn-block bg-lightblue text-center font-weight-bold">${data}</span>
                        `;
                    },
                    className: 'dt-head-center',
                },
                {
                    data: "tot_onprocess",
                    render: function(data, type, row) {
                        return `
                            <span class="btn-sm btn-block bg-primary text-center font-weight-bold">${data}</span>
                        `;
                    },
                    className: 'dt-head-center',
                },
                {
                    data: "tot_settled",
                    render: function(data, type, row) {
                        return `
                            <span class="btn-sm btn-block bg-teal text-center font-weight-bold">${data}</span>
                        `;
                    },
                    className: 'dt-head-center',
                },
                {
                    data: "tot_bayar",
                    render: function(data, type, row) {
                        return `
                            <span class="btn-sm btn-block bg-olive text-center font-weight-bold">${data}</span>
                        `;
                    },
                    className: 'dt-head-center',
                },
                {
                    data: "tot_final",
                    render: function(data, type, row) {
                        return `
                            <span class="btn-sm btn-block bg-success text-center font-weight-bold">${data}</span>
                        `;
                    },
                    className: 'dt-head-center',
                },
                {
                    data: "tot_tolak",
                    render: function(data, type, row) {
                        return `
                            <span class="btn-sm btn-block bg-danger text-center font-weight-bold">${data}</span>
                        `;
                    },
                    className: 'dt-head-center',
                },
                {
                    data: "total",
                    render: function(data, type, row) {
                        return `
                            <span class="btn-sm btn-block bg-purple text-center font-weight-bold">${data}</span>
                        `;
                    },
                    className: 'dt-head-center',
                },
            ],
        });
        $('.overlay').fadeOut();

        Swal.close();
    }).fail(function (response){
        Swal.fire({
            icon: "error",
            text: response.message,
            allowOutsideClick: false,
        });
    });
}

function getStatusClass(statusDesc) {
    let statusClass = '';

    // Set the class based on the statusDesc value
    switch(statusDesc) {
        case 'Laporan Awal':
            statusClass = 'bg-lightblue';
            break;
        case 'On Process':
            statusClass = 'bg-primary';
            break;
        case 'Settled':
            statusClass = 'bg-teal';
            break;
        case 'Proses Bayar':
            statusClass = 'bg-olive';
            break;
        case 'Final':
            statusClass = 'bg-success';
            break;
        case 'Ditolak':
            statusClass = 'bg-danger';
            break;
        case 'TOTAL':
            statusClass = 'bg-purple';
            break;
        default:
            // Set a default class if needed
            statusClass = 'bg-grey';
            break;
    }

    return statusClass;
}
