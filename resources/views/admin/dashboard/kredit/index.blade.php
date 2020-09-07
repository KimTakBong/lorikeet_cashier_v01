@extends( 'admin.layout.layout' )
@section('link')
<link rel="stylesheet" href="{{asset( 'bootstrap-select-1.12.4/dist/css/bootstrap-select.css' )}}">
@endsection
@section('content')

	<section class="content-header">
    <h1>
      Kredit
      <small>Management</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">Credit Management</li>
    </ol>
  </section>

	<section class="content">
  	<div class="box">
	    <div class="box-body">
				<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
	        <div class="row">
	          <div class="col-md-6">
	            <a class="btn btn-primary btn-md" data-toggle="modal" data-target="#createModal">Tambah Data Baru</a>
	            <a class="btn btn-warning btn-md" data-toggle="modal" data-target="#simulasiModal">Simulasi Kredit</a>
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
	                    Id Card Code
	                  </th>
	                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
	                    Action
	                  </th>
	                </tr>
	              </thead>
	              <tbody>
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
              <input type="number" class="form-control" name="nominal">
              <span class="input-group-addon">.00</span>
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

<div class="modal fade" id="simulasiModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Simulasi Kredit </h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body">
          <div class="row">
          	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          		<div class="form-group">
		            <label>Pilih Dari Menu</label>
		          	<select class="form-control selectpicker" name="item" data-live-search="true" id="pilihan_item">
		          		<option value="null"></option>
		          		@foreach( $menu as $data )
		          		<option value="{{ $data->id }}">{{ $data->name }}</option>
		          		@endforeach
		          	</select>
		          </div>
          	</div>
  					<form class="form">
          	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
          		<div class="form-group">
		            <label>Tentukan Harga</label>
		            <input type="text" class="form-control" placeholder="Normal Price" id="sell_price">
		          </div>
          	</div>
          	</form>
          </div>
          <div class="row">
          	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
          		<div class="form-group">
		            <label>Bunga <small class="pull-right"> ( Persentase )</small></label>
		            <input type="text" id="bunga_pecent" class="form-control" placeholder="Bunga">
		          </div>
          	</div>
  					<form class="form">
          	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
          		<div class="form-group">
		            <label>Harga Jual <small class="pull-right"> ( Nominal )</small></label>
		            <input type="text" id="total_harga_normal" class="form-control" placeholder="Total Harga Jual">
		          </div>
          	</div>
          	</form>
          	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
          		<div class="form-group">
		            <label>DP <small class="pull-right"> ( Persentase )</small></label>
		            <input type="text" id="dp_percent" class="form-control" placeholder="Persentase DP">
		          </div>
          	</div>
  					<form class="form">
          	<div class="col-xs-6 col-sm-6 col-md-6 col-lg-3">
          		<div class="form-group">
		            <label>DP <small class="pull-right"> ( Nominal )</small></label>
		            <input type="text" id="dp_nominal" class="form-control" placeholder="Nominal DP">
		          </div>
          	</div>
          	</form>
          </div>
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group">
                <label>Type Cicilan</label>
                <select class="form-control" id="type_cicilan">
                  <option></option>
                  <option value="hari">Harian</option>
                  <option value="minggu">Mingguan</option>
                  <option value="bulan">Bulanan</option>
                  <option value="tahun">Tahunan</option>
                </select>
              </div>
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group">
                <label>Panjang Cicilan</label>
                <input type="number" class="form-control" placeholder="Panjang Cicilan" id="panjang_cicilan" readonly="">
              </div>
            </div>
          </div>
          <div id="date">
            <label>Tanggal Mulai Kredit</label>
            <div class="input-group date" data-provide="datepicker">
              <div class="input-group-addon">
                <input readonly="" value="{{ date('m/d/Y') }}" name="date" type="text" id="begin_date" class="form-control">
              </div>
            </div> 
          </div>
          <hr>
          <div class="row">
            <div class="col-md-6 col-lg-6">
              <div id="nominal_data">
                <table class="table">
                  <tr>
                    <td>Total Tagihan</td>
                    <td id="print_price"></td>
                  </tr>
                  <tr>
                    <td>Uang Muka</td>
                    <td id="print_dp"></td>
                  </tr>
                  <tr>
                    <td>Sisa Tagihan</td>
                    <td id="print_sisa"></td>
                  </tr>
                  <tr>
                    <td>Type Cicilan</td>
                    <td id="print_type"></td>
                  </tr>
                  <tr>
                    <td>Panjang Cicilan</td>
                    <td id="print_tenor"></td>
                  </tr>
                </table>
              </div>
            </div>
            <div class="col-md-6 col-lg-6">
              <table class="table table-condensed" id="cicilan_table">
              </table>
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
  $(document).on( 'change', '#pilihan_item', function( event ) {
		value = $(this).val().split("__");
		$.ajax({
      type: "GET",
      url: "{{ route('kredit.check') }}",
      data: value[0] + "_id=" + value[1],
      success: function(result) {
      	$('#revenue').val('');
        $("#sell_price").val(number_format(result.price));
  			if ( $("#bunga_pecent").val() == '' ) {
          $("#total_harga_normal").val(number_format( result.price ));
  				$("#print_price").html(number_format( result.price ));
  			} else {
  				var harga_normal 	= result.price
  				var bunga 				= $("#bunga_pecent").val().replace(/\,/g, "")
  				var bunga_nominal = harga_normal * bunga / 100
  				var total 				= +harga_normal + +bunga_nominal
  				$("#total_harga_normal").val(number_format( total ));
          $("#print_price").html(number_format( total ));
      	}
      	if ( $("#dp_pecent").val() == '' ) {
  				$("#dp_nominal").val(number_format( $("#dp_nominal").val() ));
          $("#print_dp").html(number_format( $("#dp_nominal").val() ));
          $("#print_sisa").html(number_format( $("#sell_price").val() - $("#dp_nominal").val() ));
  			} else {
  				var persen 				= $("#dp_percent").val().replace(/\,/g, "")
		  		var total_dp 			= total * persen / 100 
		  		$("#dp_nominal").val(number_format( total_dp ));
          $("#print_dp").html(number_format( total_dp ));
          $("#print_sisa").html(number_format( $("#sell_price").val() - total_dp ));
      	}
      }
	  });
	});

	$(document).on( 'keyup', '#sell_price', function( event ) {
  	$("#pilihan_item").val("null");
  	$('.selectpicker').selectpicker('refresh')
  	if ( $("#bunga_pecent").val() == '' ) {
  		$("#total_harga_normal").val(number_format( $(this).val() ));
      $("#print_price").html(number_format( $(this).val() ));
      $("#print_sisa").html(number_format( $(this).val().replace(/\,/g, "") - $("#dp_nominal").val() ));
  	} else {
  		var harga_normal 	= $(this).val().replace(/\,/g, "")
  		var bunga 				= $("#bunga_pecent").val().replace(/\,/g, "")
  		var total_harga 	= +harga_normal + +( harga_normal * bunga / 100 )
  		$("#total_harga_normal").val(number_format( total_harga ));
      $("#print_price").html(number_format( total_harga ));
      $("#print_sisa").html(number_format( $(this).val().replace(/\,/g, "") - $("#dp_nominal").val() ));
  	}

  	if ( $("#dp_percent").val() == '' ) {
  		$("#dp_nominal").val(number_format( $("#dp_nominal").val() ));
      $("#print_sisa").html(number_format( $(this).val().replace(/\,/g, "") - $("#dp_nominal").val() ));
  	} else {
  		var total_harga 	= $("#total_harga_normal").val().replace(/\,/g, "")
  		var persen 				= $("#dp_percent").val().replace(/\,/g, "")
  		var total_dp 			= total_harga * persen / 100 
  		$("#dp_nominal").val(number_format( total_dp ));
      $("#print_sisa").html(number_format( $(this).val().replace(/\,/g, "") - total_dp ));
  	}
	});

	$(document).on( 'keyup', '#bunga_pecent', function( event ) {
		var harga_normal 	= $("#sell_price").val().replace(/\,/g, "");
		var bunga 				= harga_normal * $(this).val().replace(/\,/g, "") / 100;
		var total 				= +harga_normal + +bunga;
  	$("#total_harga_normal").val(number_format( total ));
    $("#print_price").html(number_format( total ));
  	if ( $("#dp_percent").val() == '' ) {
  		$("#dp_nominal").val(number_format( $("#dp_nominal").val() ));
  	} else {
  		var persen 				= $("#dp_percent").val().replace(/\,/g, "")
  		var total_dp 			= total * persen / 100 
  		$("#dp_nominal").val(number_format( total_dp ));
  	}
	});

	$(document).on( 'keyup', '#total_harga_normal', function( event ) {
		var harga_normal 	= $("#sell_price").val().replace(/\,/g, "");
		var total 				= $(this).val().replace(/\,/g, "");
		var selisih 			= total - harga_normal;
		var bunga 				= selisih / harga_normal * 100
  	$("#bunga_pecent").val( bunga );
    $("#print_price").html( $(this).val() );

  	if ( $("#dp_percent").val() == '' ) {
  		$("#dp_nominal").val(number_format( $("#dp_nominal").val() ));
  	} else {
  		var persen 				= $("#dp_percent").val().replace(/\,/g, "")
  		var total_dp 			= total * persen / 100 
  		$("#dp_nominal").val(number_format( total_dp ));
  	}
	});

	$(document).on( 'keyup', '#dp_percent', function( event ) {
		var harga 	= $("#total_harga_normal").val().replace(/\,/g, "");
		var nominal = harga * $(this).val().replace(/\,/g, "") / 100
  	$("#dp_nominal").val( number_format(nominal) );
    $("#print_dp").html( number_format(nominal) );
    $("#print_sisa").html( number_format( harga - nominal ) );
	});

	$(document).on( 'keyup', '#dp_nominal', function( event ) {
		var harga 	   = $("#total_harga_normal").val().replace(/\,/g, "");
		var dp_nominal = $(this).val().replace(/\,/g, "");
		var persen 		 = dp_nominal / harga * 100
  	$("#dp_percent").val( persen );
    $("#print_dp").html( number_format(dp_nominal) );
    $("#print_sisa").html( number_format( harga - dp_nominal ) );
	});

  $("#date").hide();
  $(document).on( 'change', '#type_cicilan', function( event ) {
    var value = $(this).val()
    $("#print_type").html( $("#type_cicilan option:selected").text() );
    
    if ( value != "" ) {
      $("#panjang_cicilan").removeAttr('readonly');
      $("#date").show();
    } else {
      $("#panjang_cicilan").attr('readonly', 'readonly').val('');
      $("#date").hide();
      $("#date").val('');
    }

    var tenor = $("#panjang_cicilan").val();
    if ( tenor == "" ) {
      $("#print_tenor").html("");
    } else {
      $("#print_tenor").html( tenor+" "+$("#type_cicilan option:selected").val() );
    }
  });

  var bulan = {
    '01':"Jan",'02':"Feb",'03':"Mar",'04':"Apr",'05':"May",'06':"Jun",'07':"Jul",'08':"Agu",'09':"Sep",'10':"Oct",'11':"Nov",'12':"Dec"
  }

  $(document).on( 'keyup', '#panjang_cicilan', function( event ) {
    var value = $(this).val()
    if ( value == "" ) {
      $("#print_tenor").html( "" );
    } else {
      $("#print_tenor").html( $(this).val()+" "+$("#type_cicilan option:selected").val() );
    }

    $('#cicilan_table tr').remove();
    var start = $('#begin_date').val()
    start_date = start.split('/')
    for( var i = 1; i <= value; i++ ){
      if (i==1) {
        tr = $('<tr/>');
        tr.append("<td>" + start_date[1]+'/'+bulan[start_date[0]]+'/'+start_date[2]  + " <code>(DP)</code></td>");
        tr.append("<td id='print_dp_table'>" + $("#print_dp").html() + "</td>");
        $('#cicilan_table').append(tr);
      }
      tr = $('<tr/>');
      var m = (+start_date[0] + +1);
      if ( m > 12) {
        start_date[0] = '0'+1;
        start_date[2] = +start_date[2] + +1;
      } else {
        start_date[0] = (+start_date[0] + +1);
        if ( start_date[0].toString().length == 1 ) {
          start_date[0] = '0'+start_date[0]
        }
      }
      var sisa = 
      tr = $('<tr/>');
      tr.append("<td>" + start_date[1]+'/'+bulan[start_date[0]]+'/'+start_date[2]  + "</td>");
      tr.append("<td id='print_dp_table'>" + $("#print_dp").html() + "</td>");
      $('#cicilan_table').append(tr);
    }
  });

  $(document).on( 'change', '#begin_date', function( event ) {
    var value = $(this).val();
    console.log( value );
  });
</script>

<!-- Auto Number Format pas diketik -->
<script type="text/javascript">
  (function($, undefined) {
    "use strict";
    // When ready.
    $(function() {
      var $form = $( ".form" );
      var $input = $form.find( "input" );
      $input.on( "keyup", function( event ) {
        // When user select text in the document, also abort.
        var selection = window.getSelection().toString();
        if ( selection !== '' ) {
          return;
        }
        // When the arrow keys are pressed, abort.
        if ( $.inArray( event.keyCode, [38,40,37,39] ) !== -1 ) {
          return;
        }
        var $this = $( this );
        // Get the value.
        var input = $this.val();
        var input = input.replace(/[\D\s\._\-]+/g, "");
          input = input ? parseInt( input, 10 ) : 0;
          $this.val( function() {
              return ( input === 0 ) ? "" : input.toLocaleString( "en-US" );
          });
      });
      /**
       * ==================================
       * When Form Submitted
       * ==================================
       */
      $form.on( "submit", function( event ) {
        var $this = $( this );
        var arr = $this.serializeArray();
        for (var i = 0; i < arr.length; i++) {
          arr[i].value = arr[i].value.replace(/[($)\s\._\-]+/g, ''); // Sanitize the values.
        };
        event.preventDefault();
      });
    });
  })(jQuery);
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
	      sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
	      dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
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
@endsection
@endsection