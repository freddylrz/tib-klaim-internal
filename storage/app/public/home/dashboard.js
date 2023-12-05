
$(function () {
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
