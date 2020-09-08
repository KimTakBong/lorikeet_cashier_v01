<?php 
  $role   = json_decode(\Auth::user()->usergroup->access_right);
?>
@extends( 'admin.layout.layout' )
@section('link')
<link rel="stylesheet" href="{{asset( 'bootstrap-select-1.12.4/dist/css/bootstrap-select.css' )}}">
@endsection
@section('content')

	<section class="content-header">
    <h1>
      Item Manager
      <small>Stock Management</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">Stock Management</li>
    </ol>
  </section>

	<section class="content">
  	<div class="box">
	    <div class="box-header">
	    	<h4><b>Stock Management</b></h4>
	    </div>
	    <div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
	        <div class="row">
	          <div class="col-md-6">
        		@if( $role->item->c == true )
	            <a class="btn btn-primary btn-md" data-toggle="modal" data-target="#createModal">Tambah Data Baru</a>
				@endif        				
        		@if( $role->item->u == true )
	            <a class="btn btn-success btn-md" data-toggle="modal" data-target="#restockModal">Restock Item</a>
				@endif        				
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
	                    Stock
	                  </th>
	                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
	                    Action
	                  </th>
	                </tr>
	              </thead>
	              <tbody>
	              <?php $i=0; ?>
	              @foreach( $item as $data )
	                <tr role="row" class="odd">
	                  <td class="sorting_1">{{ $data->name }}</td>
	                  <td>Rp. {{ number_format($data->price) }}</td>
	                  <td>{{ $data->stock }}</td>
	                  <td>
	                  	@if( !empty($data->history->toArray()) )
	                  	<button title="History Perubahan Stock" data-toggle="modal" data-target="#historyModal{{$i}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
	                  	@endif
    
        				@if( $role->item->u == true )
	                  	<button title="Perbaharui Data" data-toggle="modal" data-target="#updateModal{{$i}}" class="btn btn-sm btn-warning"><i class="fa fa-pencil"></i></button>
        				@endif
        				@if( $role->item->d == true )
	                  	<button title="Hapus Data" data-toggle="modal" data-target="#deleteModal{{$i}}" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></button>
        				@endif
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
  <form enctype="multipart/form-data" action="{{ route( 'product.add' ) }}" method="post">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Item </h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <label>Name</label>
            <input name="name" class="form-control" placeholder="Enter Product Name" required="required">
          </div>
          <div class="form-group">
            <label>Harga Jual</label>
            <div class="input-group">
              <span class="input-group-addon">Rp.</span>
              <input type="number" class="form-control" name="price">
              <span class="input-group-addon">.00</span>
            </div>
          </div>
          <div class="form-group">
            <label>Stock</label>
            <input type="number" name="stock" class="form-control" placeholder="Stock ( Silakan dikosongkan jika ini adalah barang jual tanpa stock )" >
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
        <h4 class="modal-title">Kembalikan Item Yang Pernah Dihapus</h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body table-responsive no-padding">
			    <table class="table table-hover">
			      <tbody><tr>
			        <th>Name</th>
			        <th>Price</th>
			        <th>Stock</th>
			        <th>Action</th>
			      </tr>
			      @foreach( $bin as $data )
			      <tr>
			        <td>{{ $data->name }}</td>
			        <td>{{ $data->price }}</td>
			        <td>{{ $data->stock }}</td>
			        <td><a href="{{route('product.restore', \Crypt::encrypt( $data->id ))}}" class="btn btn-sm btn-info">Kembalikan</a></td>
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
@foreach($item as $data)
<div class="modal fade" id="historyModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">History Perubahan Stock Item <code>{{ $data->name }}</code></h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body table-responsive no-padding">
			    <table class="table table-hover">
			      <tbody><tr>
			        <th>Date</th>
			        <th>User</th>
			        <th>Status</th>
			        @if( \Auth::user()->group_id == 1 )
			        <th>Action</th>
			        @endif
			      </tr>
			      <?php 
			      	$month = [ '01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Agu', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec' ];
			      ?>
			      @foreach( $data->history as $his )
			      <tr>
			      	<?php 
			      		$buy_date = explode('/', $his->buying_date);
			      	?>
			        <td>{{ $buy_date[1].'/'.$month[$buy_date[0]].'/'.$buy_date[2] }}</td>
			        @if($his->user_id)
			        <td>{{ App\Models\User::find( $his->user_id )->name }}</td>
			        @else
			        <td><span class="label label-success">Penjualan</span></td>
			        @endif
			        <td>
			        	@if($his->quantity >= 0 )
			        	<span class="label label-info">{{ $his->quantity }}</span>
			        	@else
			        	<span class="label label-warning">{{ $his->quantity }}</span>
			        	@endif
			        </td>
        			@if( $role->item->d == true )
			        	<td><a href="{{ route( 'history.delete', \Crypt::encrypt( $his->id ) ) }}" class="btn btn-xs btn-danger">Hapus</a></td>
			        @endif
			      </tr>
			      @endforeach
			    </tbody></table>
			  </div>
      </div>
      <div class="modal-footer">
        @if( $role->item->d == true )
      	<a href="{{ route( 'history.clear', \Crypt::encrypt( $data->id ) ) }}" class="btn btn-danger btn-md">Clear History </a>
		@endif
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="updateModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form enctype="multipart/form-data" action="{{ route( 'product.update', \Crypt::encrypt( $data->id ) ) }}" method="post">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Update Item </h4>
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
  <form enctype="multipart/form-data" action="{{ route( 'product.delete', \Crypt::encrypt( $data->id ) ) }}" method="post">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Apa Anda Yakin Ingin Menghapus Item {{ $data->name }}</h4>
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

<div class="modal fade" id="restockModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form enctype="multipart/form-data" action="{{ route( 'product.restock' ) }}" method="post">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Restock Item </h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body">
          <div class="form-group">
          	<select class="form-control selectpicker" name="item" data-live-search="true" id="pilihan_item">
          		<option></option>
          		@foreach( $item as $data )
          		<option value="{{ \Crypt::encrypt( $data->id ) }}">{{ $data->name }}</option>
          		@endforeach
          	</select>
          </div>
          <div class="tambah_stock">
          	<div class="row">
          		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          			<div class="form-group">
			            <label>Jumlah Stock Lama</label>
			            <input type="number" disabled="" name="old" class="form-control" placeholder="Stock" id="stock_now" >
			          </div>
          		</div>
          		<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
          			<div class="form-group">
			            <label>Jumlah Stock Sekarang</label>
			            <input type="number" name="stock" class="form-control" placeholder="Stock">
			          </div>
          		</div>
          	</div>
          	<div class="row">
          		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          			<div class="form-group">
			            <label>Harga Jual</label>
			            <input type="number" disabled="" name="sell_price" class="form-control" placeholder="Stock" id="sell_price" >
			          </div>
          		</div>
          		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          			<div class="form-group">
			            <label>Harga Beli / Barang</label>
			            <input type="number" id="buy_price" name="buying_price" class="form-control" placeholder="Buy Price">
			          </div>
          		</div>
          	</div>
          	<div class="form-group">
	            <label>Keuntungan</label>
	            <input type="number" disabled="" name="sell_price" class="form-control" placeholder="Keuntungan per jual barang" id="revenue" >
	          </div>
          	<label>Tanggal Pembelian</label>
	          <div class="input-group date" data-provide="datepicker">
		          <div class="input-group-addon">
		        		<input readonly="" value="{{ date('m/d/Y') }}" name="date" type="text" id="dpd1" class="form-control">
		          </div>
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

@section('script')
<script type="text/javascript">
	var tambah 	= $(".tambah_stock");
	tambah.hide();
  $(document).on( 'change', '#pilihan_item', function( event ) {
		value = $(this).val();
		if ( value != "" ) {
			$.ajax({
	      type: "GET",
	      url: "{{ route('product.check') }}",
	      data: "item_id=" + value,
	      success: function(result) {
	      	$('#revenue').val('');
	        $("#stock_now").val(result.stock);
	        $("#sell_price").val(number_format(result.price));
	        $(document).on( 'keyup', '#buy_price', function( event ) {
	        	$("#revenue").val(number_format(result.price - $(this).val()));
					});
	      }
		  });
			tambah.show();
		} else {
			tambah.hide();
		}
	});
</script>
<!-- JS buat select box ada field searchnya -->
<script src="{{ asset( 'bootstrap-select-1.12.4/js/bootstrap-select.js' ) }}"></script>

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