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
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
	        <div class="info-box-content">
	          <span class="info-box-text">Public Member</span>
	          <span class="info-box-number"></span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div><!-- /.col -->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>
	        <div class="info-box-content">
	          <span class="info-box-text">Article's</span>
	          <span class="info-box-number"></span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div><!-- /.col -->

	    <!-- fix for small devices only -->
	    <div class="clearfix visible-sm-block"></div>

	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>
	        <div class="info-box-content">
	          <span class="info-box-text">Travel Categories</span>
	          <span class="info-box-number"></span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div><!-- /.col -->
	    <div class="col-md-3 col-sm-6 col-xs-12">
	      <div class="info-box">
	        <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
	        <div class="info-box-content">
	          <span class="info-box-text">Travel Pakage's</span>
	          <span class="info-box-number"></span>
	        </div><!-- /.info-box-content -->
	      </div><!-- /.info-box -->
	    </div><!-- /.col -->
	  </div>
	</section>

@endsection