@extends( 'admin.layout.layout' )
@section('link')
<link rel="stylesheet" href="{{asset( 'bootstrap-select-1.12.4/dist/css/bootstrap-select.css' )}}">
@endsection
@section('content')

	<section class="content-header">
    <h1>
      Pengeluaran
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">Cost Management</li>
    </ol>
  </section>

	<section class="content">
  	<div class="box">
	    <div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
	        <div class="row">
	          <div class="col-md-6">
	            <a class="btn btn-primary btn-md" data-toggle="modal" data-target="#createModal">Tambah Data Baru</a>
	          </div>
	        </div>
	        <br><br>
	        <div class="row">
	          <div class="col-sm-12">
	            <table id="example1" class="table table-bordered table-striped">
	              <thead>
	                <tr role="row">
	                  <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 177px;">
	                    Date
	                  </th>
	                  <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 177px;">
	                    Name
	                  </th>
	                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
	                    Action
	                  </th>
	                </tr>
	              </thead>
	              <tbody>
	              <?php $i=0; ?>
	              @foreach( $cost as $data )
	              	<?php $date = explode('/', $data->date); ?>
	                <tr role="row" class="odd">
	                  <td>{{ $date[1]."/".date('F', mktime(0, 0, 0, $date[0], 10))."/".$date[2] }}</td>
	                  <td class="sorting_1">{{ $data->name }}</td>
	                  <td>
	                  	<button title="Detail Data" data-toggle="modal" data-target="#detailModal{{$i}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></button>
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
  <form enctype="multipart/form-data" action="{{ route( 'cost.create' ) }}" method="post">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Cost Data </h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <label>Name</label>
            <input name="name" class="form-control" required="required">
          </div>
          <div class="form-group">
            <label>Cost ( Nominal )</label>
            <div class="input-group">
              <span class="input-group-addon">Rp.</span>
              <input type="number" class="form-control" name="nominal" required="required">
              <span class="input-group-addon">.00</span>
            </div>
          </div>
          <label>Date</label>
          <div class="input-group date" data-provide="datepicker">
	          <div class="input-group-addon">
	        		<input readonly="" value="{{ date('m/d/Y') }}" name="date" type="text" id="dpd1" class="form-control">
	          </div>
	        </div>
          <div class="form-group">
            <label>Description</label>
            <textarea class="form-control" name="description"></textarea>
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

<?php $i=0; ?>
@foreach($cost as $data)
<div class="modal fade" id="detailModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail Cost <code>{{ $data->name }}</code></h4>
      </div>
      <div class="modal-body">
      	<table class="table table-bordered">
          <tbody><tr>
            <th>Date</th>
            <th>Nominal</th>
            <th>Description</th>
          </tr>
          <tr>
            <td>{{ $data->date }}</td>
            <td>Rp. {{ number_format($data->nominal) }}</td>
            <td>{{ $data->description }}</td>
          </tr>
        </tbody></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteModal{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <form enctype="multipart/form-data" action="{{ route( 'cost.delete', \Crypt::encrypt( $data->id ) ) }}" method="post">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	        <h4 class="modal-title">Apa Anda Yakin Ingin Menghapus Data Cost {{ $data->name }}</h4>
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
	          $("#stock_now").val(result);
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