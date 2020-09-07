@extends( 'admin.layout.layout' )
@section('content')

	<section class="content-header">
      <h1>
        Dashboard
        <small>Version 0.1</small>
      </h1>
      <ol class="breadcrumb">
        <li class="active">Dashboard</li>
      </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-aqua"><i class="fa fa-dollar"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Today Revenue</span>
            <span class="info-box-number">Rp. {{ number_format($today_revenue) }}</span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div><!-- /.col -->
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-yellow"><i class="ion ion-ios-cart-outline"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Item Sold</span>
            <span class="info-box-number">{{ number_format( $today_item_sold ) }}</span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div><!-- /.col -->

      <!-- fix for small devices only -->
      <div class="clearfix visible-sm-block"></div>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="info-box">
          <span class="info-box-icon bg-red"><i class="fa fa-money"></i></span>
          <div class="info-box-content">
            <span class="info-box-text">Today Cost</span>
            <span class="info-box-number">Rp. {{ number_format( $today_cost ) }}</span>
          </div><!-- /.info-box-content -->
        </div><!-- /.info-box -->
      </div><!-- /.col -->
    </div>
    <div class="row">
      
    </div>
  </section>

@endsection