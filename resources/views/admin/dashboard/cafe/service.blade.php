@extends( 'admin.layout.layout' )
@section('link')
<link rel="stylesheet" href="{{asset( 'bootstrap-select-1.12.4/dist/css/bootstrap-select.css' )}}">
@endsection
@section('content')

	<section class="content-header">
    <h1>
      Service
      <small>Manager</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">Service Manager</li>
    </ol>
  </section>

	<section class="content">
  	<div class="box">
	    <div class="box-header">
	    	<h4><b>Service Management</b></h4>
	    </div>
	    <div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
	        <div class="row">
	          <div class="col-md-6">
	            <a class="btn btn-primary btn-md" data-toggle="modal" data-target="#createModal">Tambah Data Baru</a>
	            @if( !empty( $bin->toArray() ) )
	            <a class="btn btn-warning btn-md" data-toggle="modal" data-target="#recycleModal">Recycle Bin</a>
	            @endif
	          </div>
	        </div>
	        <br><br>
	        <div class="row">
	          <div class="col-sm-12">
	            <table id="example1" class="table table-bordered table-striped">
	              <thead>
	                <tr role="row">
	                  <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 177px;">
	                    Name
	                  </th>
	                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
	                    Price
	                  </th>
	                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
	                    Komisi
	                  </th>
	                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
	                    Action
	                  </th>
	                </tr>
	              </thead>
	              <tbody>
	              <?php $i=0; ?>
	              @foreach( $service as $data )
	                <tr role="row" class="odd">
	                  <td class="sorting_1">{{ $data->name }}</td>
	                  <td>Rp. {{ number_format($data->price) }}</td>
	                  <td>Rp. {{ number_format($data->price) }}</td>
	                  <td>
	                  	<button title="Perbaharui Data" data-toggle="modal" data-target="#updateModal{{$i}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>
	                  	<button title="Hapus Data" data-toggle="modal" data-target="#deleteModal{{$i}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
	                  </td>
	                </tr>
	              <?php $i++; ?>
	              @endforeach
	              </tbody>
	            </table>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</section>

<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form enctype="multipart/form-data" action="{{ route( 'service.add' ) }}" method="post">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Service </h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <label>Name</label>
            <input name="name" class="form-control" placeholder="Enter Product Name" required="required">
          </div>
          <div class="form-group">
            <label>Harga Dasar</label>
            <div class="input-group">
              <span class="input-group-addon">Rp.</span>
              <input type="number" class="form-control" id="price" name="price">
              <span class="input-group-addon">.00</span>
            </div>
          </div>
          <div class="form-group">
            <label>Komisi</label>
            <div class="row">
            	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            		<input id="service_per" class="form-control" placeholder="Persentase Komisi" required="required">
            	</div>
            	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            		<div class="input-group">
		              <span class="input-group-addon">Rp.</span>
		              <input tabindex="1" type="number" class="form-control" id="service_res" name="service">
		              <span class="input-group-addon">.00</span>
		            </div>
            	</div>
            </div>
          </div>
          <div class="form-group">
            <label>Tax</label>
            <div class="row">
            	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            		<input id="tax_per" class="form-control" placeholder="Persentase Tax" required="required">
            	</div>
            	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
            		<div class="input-group">
		              <span class="input-group-addon">Rp.</span>
		              <input tabindex="2" type="number" class="form-control" id="tax_res" name="tax">
		              <span class="input-group-addon">.00</span>
		            </div>
            	</div>
            </div>
          </div>
          <div class="form-group">
            <label>Harga Jual</label>
            <div class="input-group">
              <span class="input-group-addon">Rp.</span>
              <input type="number" class="form-control" id="grand" disabled="disabled">
              <span class="input-group-addon">.00</span>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
  </form>
</div>
<div class="modal fade" id="recycleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Kembalikan Service Yang Pernah Dihapus</h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body table-responsive no-padding">
			    <table class="table table-hover">
			      <tbody><tr>
			        <th>Name</th>
			        <th>Price</th>
			        <th>Action</th>
			      </tr>
			      @foreach( $bin as $data )
			      <tr>
			        <td>{{ $data->name }}</td>
			        <td>{{ $data->price }}</td>
			        <td><a href="{{route('service.restore', \Crypt::encrypt( $data->id ))}}" class="btn btn-sm btn-info">Kembalikan</a></td>
			      </tr>
			      @endforeach
			    </tbody></table>
			  </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>

<?php $i=0; ?>
@foreach($service as $data)
<div class="modal fade" id="updateModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form enctype="multipart/form-data" action="{{ route( 'service.update', \Crypt::encrypt( $data->id ) ) }}" method="post">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>
	      <div id="modal" class="modal-body">
	        <div class="box-body">
	          <div class="form-group">
	            <label>Name</label>
	            <input value="{{ $data->name }}" name="name" class="form-control" placeholder="Enter Product Name" required="required">
	          </div>
	          <div class="form-group">
	            <label>Harga Jual</label>
	            <div class="input-group">
	              <span class="input-group-addon">Rp.</span>
	              <input value="{{ $data->price }}" type="number" class="form-control" name="price">
	              <span class="input-group-addon">.00</span>
	            </div>
	          </div>
	        </div>
	      </div>
	      <div class="modal-footer">
	        <input type="hidden" name="_token" value="{{csrf_token()}}">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Save</button>
	      </div>
	    </div>
	  </div>
  </form>
</div>
<div class="modal fade" id="deleteModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form enctype="multipart/form-data" action="{{ route( 'service.delete', \Crypt::encrypt( $data->id ) ) }}" method="post">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Apa Anda Yakin Ingin Menghapus Service {{ $data->name }}</h4>
	      </div>
	      <div class="modal-footer">
	        <input type="hidden" name="_token" value="{{csrf_token()}}">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-danger">Ya, Hapus !</button>
	      </div>
	    </div>
	  </div>
  </form>
</div>
<?php $i++; ?>
@endforeach

@section('script')
<script type="text/javascript">
	$(document).on( 'keyup', '#price', function( event ) {
		var value = $(this).val();

		$('#grand').val( value );
	});
	$(document).on( 'keyup', '#service_per', function( event ) {
		var price 	= $('#price').val();
		var tax 		= $('#tax_res').val();
		var percent = $(this).val();
		var result 	= price * percent / 100;
		var grand 	= $('#grand').val();
		console.log( price );

		$('#service_res').val( result );
		$('#grand').val( +price + +result + +tax );
	});
	$(document).on( 'keyup', '#tax_per', function( event ) {
		var price 	= $('#price').val();
		var service	= $('#service_res').val();
		var percent = $(this).val();
		var result 	= price * percent / 100;
		var grand 	= $('#grand').val();
		console.log( price );

		$('#tax_res').val( result );
		$('#grand').val( +grand + +result + +service );
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

<!-- Datepicker -->
<!-- Bootstrap Date-Picker Plugin -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
  $('.datepicker').datepicker();
</script>
<!-- Timepicker -->
<!-- Bootstrap Time-Picker Plugin -->
<script src="{{ asset( 'AdminLTE/plugins/timepicker/bootstrap-timepicker.min.js' ) }}" type="text/javascript"></script>
<script>
  $(function () {
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
@endsection
@endsection