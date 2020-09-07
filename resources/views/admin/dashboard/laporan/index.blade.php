@extends( 'admin.layout.layout' )
@section('content')

	<section class="content-header">
      <h1>
        Laporan
        <small>Version 0.1</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active">Laporan</li>
      </ol>
    </section>

	<section class="content">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Pilih Bulan Lain</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-10 col-lg-10">
            <div class="input-append date" data-provide="datepicker" id="datepicker" data-date="{{ date('m-Y') }}" data-date-format="mm-yyyy">
              <div class="input-group-addon">
                <input id="select_date" readonly="" value="{{ (isset($request_date))?$request_date:date('m-Y') }}" name="date" type="text" id="dpd1" class="form-control">
              </div>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2">
            <a href="" id="send" class="btn btn-lg btn-success">Process </a>
          </div>
        </div>
      </div>
    </div>

		<div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Laporan & Grafik</h3>
        <div class="box-tools pull-right">
          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
      </div><!-- /.box-header -->
      <div class="box-body">
        <div class="row">
          <div class="col-md-12">
            <p class="text-center">
              <strong>Income & Pengeluaran  : <code>{{ (isset($request_date))?$request_date:date('m-Y') }}</code></strong>
            </p>
            <div class="chart">
              <!-- Sales Chart Canvas -->
              <canvas id="salesChart" height="190" width="645" style="width: 645px; height: 190px;"></canvas>
            </div><!-- /.chart-responsive -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- ./box-body -->
      <div class="box-footer">
        <div class="row">
          <div class="col-sm-6 col-xs-6 col-md-4 col-lg-4">
            <div class="description-block border-right">
              <h5 class="description-header text-blue">Rp. {{ number_format(array_sum($income)) }}</h5>
              <span class="description-text text-blue">Total Income</span>
            </div><!-- /.description-block -->
          </div><!-- /.col -->
          <div class="col-sm-6 col-xs-6 col-md-4 col-lg-4">
            <div class="description-block border-right">
              <h5 class="description-header text-yellow">Rp. {{ number_format(array_sum($cost)) }}</h5>
              <span class="description-text text-yellow">Total Cost</span>
            </div><!-- /.description-block -->
          </div><!-- /.col -->
          <div class="col-sm-12 col-xs-12 col-md-4 col-lg-4">
            <div class="description-block border-right">
              @if( array_sum($income) - array_sum($cost) >= 0 )
              <h5 class="description-header text-green">Rp. {{ number_format(array_sum($income) - array_sum($cost)) }}</h5>
              <span class="description-text text-green">Total Profit</span>
              @else
              <h5 class="description-header text-red">Rp. {{ number_format(array_sum($income) - array_sum($cost)) }}</h5>
              <span class="description-text text-red">Total Loss</span>
              @endif
            </div><!-- /.description-block -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.box-footer -->
    </div>

    <div class="row">
      <div class="col-md-4">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Income per Days on <code>{{ (isset($request_date))?$request_date:date('m-Y') }}</code></h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              <canvas id="barChart" height="240" width="467" style="width: 467px; height: 240px;"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Income per Hour on <code>{{ (isset($request_date))?$request_date:date('m-Y') }}</code></h3>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div class="chart">
              <!-- Sales Chart Canvas -->
              <canvas id="salesChart1" height="190" width="645" style="width: 645px; height: 190px;"></canvas>
            </div><!-- /.chart-responsive -->
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7 col-xl-7">
        <div class="box">
          <div class="box-header with border">
            <h4>Buku Kecil</h4>
            <div class="box-tools pull-right">
              <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
          </div>
          <div class="box-body">
            <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
              <div class="row">
                <div class="col-sm-12">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr role="row">
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
                          Date
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
                          Income
                        </th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
                          Cost
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    if ( isset( $request_date ) ) {
                      $req_d = explode('-', $request_date);
                      $total_days  = cal_days_in_month(CAL_GREGORIAN, $req_d[0], $req_d[1]);
                    } else {
                      $total_days  = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
                    }
                    ?>
                    @for( $i=0; $i<$total_days; $i++ )
                      <tr style="height: 1px;" role="row" class="odd">
                        @if(isset( $request_date ))
                        <td>{{ $i+1 .'/'.date('F', mktime(0, 0, 0, $req_d[0], 10)) }}</td>
                        @else
                        <td>{{ $i+1 .'/'.date('M')}}</td>
                        @endif                    
                        <td>
                          <font color="blue">Rp. {{ number_format($income[$i]) }}</font>
                          @if($income[$i] > 0)
                            @if( isset( $request_date ) )
                            <a href="{{ route('laporan.detail').'?status=income'.'&date='.($i+1).'/'.$req_d[0].'/'.$req_d[1] }}" class="btn btn-sm btn-info pull-right spawnModal" data-toggle="modal" data-target="#detailModal"><i class="fa fa-eye"></i> Detail</a>
                            @else
                            <a href="{{ route('laporan.detail').'?status=income'.'&date='.($i+1).'/'.date('m').'/'.date('Y') }}" class="btn btn-sm btn-info pull-right spawnModal" data-toggle="modal" data-target="#detailModal"><i class="fa fa-eye"></i> Detail</a>
                            @endif
                          @endif
                        </td>
                        <td>
                          <font color="red">Rp. {{ number_format($cost[$i]) }}</font>
                          @if($cost[$i] > 0)
                            @if( isset( $request_date ) )
                            <a href="{{ route('laporan.detail').'?status=cost'.'&date='.($i+1).'/'.$req_d[0].'/'.$req_d[1] }}" class="btn btn-sm btn-info pull-right spawnModal" data-toggle="modal" data-target="#detailModal"><i class="fa fa-eye"></i> Detail</a>
                            @else
                            <a href="{{ route('laporan.detail').'?status=cost'.'&date='.($i+1).'/'.date('m').'/'.date('Y') }}" class="btn btn-sm btn-info pull-right spawnModal" data-toggle="modal" data-target="#detailModal"><i class="fa fa-eye"></i> Detail</a>
                            @endif
                          @endif
                        </td>
                      </tr>
                    @endfor
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5 col-xl-5"></div>
    </div>
    

	</section>
<div class="modal fade" id="detailModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
@section('script')
<script type="text/javascript">
  $(document).on( 'click', '.spawnModal', function( event ) {
    var target  = $(this).attr("data-target")
    var href    = $(this).attr("href")
    $.ajax({
      url: href,
      success: function(data){
        $(target).html(data);
      }
    });
  });
</script>
<script type="text/javascript">
  $(document).on( 'change', '#select_date', function( event ) {
    var date = $(this).val();
    $('#send').attr('href', "{{ route('laporan.index') }}/"+date);
  });
</script>
<!-- Disable pagination for cashflow datatables -->
<script type="text/javascript">
  $('#example1').dataTable({
      "bPaginate": false
  });
</script>

<!-- Datepicker -->
<!-- Bootstrap Date-Picker Plugin -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $('#datepicker').datepicker({
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
  });
</script>

<!-- kalo di php ini funsi number_format(), nah ini JSnya, nama fungsinya juga number_format() -->
<script type="text/javascript">
  function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? '.' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? ',' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
  }
</script>
<script type="text/javascript" src="{{ asset( 'adminlte/plugins/chartjs/Chart.min.js' ) }}"></script>
<script type="text/javascript">
	/* ChartJS
   * -------
   * Here we will create a few charts using ChartJS
   */

  //-----------------------
  //- MONTHLY SALES CHART -
  //-----------------------

  // Get context with jQuery - using jQuery's .get() method.
  var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
  // This will get the first returned node in the jQuery collection.
  var salesChart = new Chart(salesChartCanvas);

  var salesChartData = {
    labels: [<?php
      if ( isset( $request_date ) ) {
        $req_d = explode('-', $request_date);
        $total_days  = cal_days_in_month(CAL_GREGORIAN, $req_d[0], $req_d[1])+1;
      } else {
        $total_days  = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'))+1;
      }

      for( $i=1; $i<$total_days; $i++ ){
        echo (int)$i.',';
      }
    ?>],
    datasets: [
      {
        label: "Income",
        fillColor: "rgba(60,141,188,0.8)",
        strokeColor: "rgba(60,141,188,0.8)",
        pointColor: "#3b8bba",
        pointStrokeColor: "rgba(60,141,188,0.8)",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(60,141,188,0.8)",
        data : <?php echo json_encode($income); ?>
      },
      {
        label: "Cost",
        fillColor: "rgba(243, 156, 18, 0.8)",
        strokeColor: "rgba(243, 156, 18, 0.8)",
        pointColor: "rgba(243, 156, 18, 0.8)",
        pointStrokeColor: "#c1c7d1",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(243, 156, 18, 0.8)",
        data : <?php echo json_encode($cost); ?>
      }
    ]
  };


  var salesChartOptions = {
    //Boolean - If we should show the scale at all
    showScale: true,
    //Boolean - Whether grid lines are shown across the chart
    scaleShowGridLines: true,
    //String - Colour of the grid lines
    scaleGridLineColor: "rgba(0,0,0,.05)",
    //Number - Width of the grid lines
    scaleGridLineWidth: 1,
    //Boolean - Whether to show horizontal lines (except X axis)
    scaleShowHorizontalLines: true,
    //Boolean - Whether to show vertical lines (except Y axis)
    scaleShowVerticalLines: true,
    //Boolean - Whether the line is curved between points
    bezierCurve: true,
    //Number - Tension of the bezier curve between points
    bezierCurveTension: 0.2,
    //Boolean - Whether to show a dot for each point
    pointDot: true,
    //Number - Radius of each point dot in pixels
    pointDotRadius: 3,
    //Number - Pixel width of point dot stroke
    pointDotStrokeWidth: 1,
    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
    pointHitDetectionRadius: 20,
    //Boolean - Whether to show a stroke for datasets
    datasetStroke: true,
    //Number - Pixel width of dataset stroke
    datasetStrokeWidth: 2,
    //Boolean - Whether to fill the dataset with a color
    datasetFill: true,
    //String - A legend template
    legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
    //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
    maintainAspectRatio: false,
    //Boolean - whether to make the chart responsive to window resizing
    responsive: true
  };


  //Create the line chart
  salesChart.Line(salesChartData, salesChartOptions);
</script>
<script type="text/javascript">
  $(function () {
    var areaChartData = {
      labels: [<?php
        for( $i=0; $i<24; $i++ ){
          if (strlen( $i ) == 1) {
            echo '"0'.$i.':00 - 0'.$i.':59" ,';
          } else {
            echo '"'.$i.':00 - '.$i.':59" ,';
          }
        }
      ?>],
      datasets: [
        {
          label: "INCOME",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: <?php echo json_encode($hour_per_day); ?>
        }
      ]
    };
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    var barChartCanvas = $("#salesChart1").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[0].fillColor = "#3c8dbc";
    barChartData.datasets[0].strokeColor = "#3c8dbc";
    barChartData.datasets[0].pointColor = "#3c8dbc";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: false
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>
<script type="text/javascript">
  $(function () {
    var areaChartData = {
      labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
      datasets: [
        {
          label: "INCOME",
          fillColor: "rgba(210, 214, 222, 1)",
          strokeColor: "rgba(210, 214, 222, 1)",
          pointColor: "rgba(210, 214, 222, 1)",
          pointStrokeColor: "#c1c7d1",
          pointHighlightFill: "#fff",
          pointHighlightStroke: "rgba(220,220,220,1)",
          data: <?php echo json_encode($days_data); ?>
        }
      ]
    };
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    var barChartCanvas = $("#barChart").get(0).getContext("2d");
    var barChart = new Chart(barChartCanvas);
    var barChartData = areaChartData;
    barChartData.datasets[0].fillColor = "#3c8dbc";
    barChartData.datasets[0].strokeColor = "#3c8dbc";
    barChartData.datasets[0].pointColor = "#3c8dbc";
    var barChartOptions = {
      //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
      scaleBeginAtZero: true,
      //Boolean - Whether grid lines are shown across the chart
      scaleShowGridLines: true,
      //String - Colour of the grid lines
      scaleGridLineColor: "rgba(0,0,0,.05)",
      //Number - Width of the grid lines
      scaleGridLineWidth: 1,
      //Boolean - Whether to show horizontal lines (except X axis)
      scaleShowHorizontalLines: true,
      //Boolean - Whether to show vertical lines (except Y axis)
      scaleShowVerticalLines: true,
      //Boolean - If there is a stroke on each bar
      barShowStroke: true,
      //Number - Pixel width of the bar stroke
      barStrokeWidth: 2,
      //Number - Spacing between each of the X value sets
      barValueSpacing: 5,
      //Number - Spacing between data sets within X values
      barDatasetSpacing: 1,
      //String - A legend template
      legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
      //Boolean - whether to make the chart responsive
      responsive: true,
      maintainAspectRatio: false
    };

    barChartOptions.datasetFill = false;
    barChart.Bar(barChartData, barChartOptions);
  });
</script>
@endsection
@endsection