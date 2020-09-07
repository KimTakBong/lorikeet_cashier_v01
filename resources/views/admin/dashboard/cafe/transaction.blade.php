@extends( 'admin.layout.layout' )
@section('link')
<style type="text/css">
	td.data {
    position: relative;
    float:left;
	}
	tr.item:hover button {
	    display: inline;
	}
	tr.service:hover button {
	    display: inline;
	}
	td.data button {
	    position:absolute;
	    display:none;
	}
	td.data button.del {
	    top:0;
	    left:0;
	}
</style>

<style type="text/css">
	@media print {
	  body * {
	    visibility: hidden;
	  }
	  #print, #print * {
	    visibility: visible;
	  }
	  #print {
	    position: absolute;
	    left: 0;
	    top: 0;
	  }
	}
</style>
@endsection
@section('content')
	<section class="content">
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-5 col-lg-5">
				<form id="myForm" enctype="multipart/form-data" action="{{ route( 'product.transaction.post' ) }}" method="post">
		  		<input type="hidden" name="_token" value="{{ csrf_token() }}">
			  	<div class="box">
				    <div class="box-header">
				    	<h3 class="box-title"><label>Cart</label></h3>
				    </div>
				    <div class="box-body" id="print">
				    	<img src="{{ asset('mamakita-logo-tulisan.jpg') }}" class="img-responsive" style="height: 30px;">
				    	<div class="box-body table-responsive no-padding">
						    <table class="table table-hover" id="cart">
						      <tbody>
						      	<tr>
							        <th>Name</th>
							        <th>Qty</th>
							        <th>Price</th>
							        <th style="width: 1px;"></th>
							        <th style="width: 1px;"></th>
						      	</tr>
						    	</tbody>
						    </table>
						  </div>
						  <table class="table table-bordered grand">
				    		<tbody>
				    			<tr>
				    				<td><label>Total</label></td>
				    				<td><label>Rp. <code id="grand" val="" disc=""></code></label></td>
				    			</tr>
				    			<tr class="discount_div" style="display: none;">
				    				<td><label>Discount</label></td>
				    				<td><label>Rp. <code id="grand_discount">0</code></label></td>
				    			</tr>
				    			<tr class="discount_div" style="display: none;">
				    				<td><label>Grand Total</label></td>
				    				<td><label>Rp. <code id="grand_total"></code></label></td>
				    			</tr>
				    		</tbody>
				    	</table>
				    </div>
				    <hr>
				    <div class="box-footer grand">
			    		<div class="row">
			    			<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				    			<div>
						    		<label>Persentase Diskon</label>
						    		<input type="text" id="percent" name="diskon" class="form-control" tabindex="1" value="0">
						    	</div>
				    		</div>
				    		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form">
				    			<div>
						    		<label>Nominal Diskon</label>
						    		<input type="text" id="nominal" class="form-control">
						    	</div>
				    		</div>
				    		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 form">
				    			<div>
						    		<label>Uang Diterima</label>
						    		<input type="text" id="recieve" class="form-control" tabindex="2">
						    	</div>
				    		</div>
				    		<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
				    			<div>
						    		<label>Kembalian</label>
						    		<input type="text" id="change" class="form-control" readonly="">
						    	</div>
				    		</div>
				    	</div>
				    	<br>

			  			<div class="row">
			  				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
			  					<!-- <a class="btn btn-md btn-warning" onClick="javascript:printDiv('print')">Print JS</a> -->
			  					<a class="btn btn-md btn-success" onclick="window.print()">Proses</a> <strong><code>JANGAN DI CANCEL</code></strong>
			  				</div>
			  				<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pull-right">
			  				</div>
			  			</div>
			  		</div>
				  </div>
				</form>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-7 col-lg-7">
				<div class="box">
					<div class="nav-tabs-custom">
		        <ul class="nav nav-tabs">
		          <!-- <li><a href="#service" data-toggle="tab">Service</a></li> -->
		          <li class="active"><a href="#product" data-toggle="tab">Product</a></li>
		        </ul>
		        <div class="tab-content">
		          <div class="tab-pane active" id="product">
		          	<div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
					        <div class="row">
					          <div class="col-sm-12">
					            <table id="example1" class="table table-bordered table-striped">
					              <thead>
					                <tr role="row">
					                  <th style="width: 500px;" class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 177px;">
					                    Name
					                  </th>
					                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
					                    Price
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
					                  <td>Rp. {{ number_format($data->price) }}<code><small>({{ $data->stock }})</small></code></td>
					                  <td>
					                  	<div class="input-group margin">
						                    <input type="number" id="qty{{$i}}" class="form-control">
						                    <span class="input-group-btn">
						                      <button datatype="item" class="btn btn-info btn-flat buy" input_id="qty{{$i}}" item_id="{{$data->id}}" item_name="{{$data->name}}" item_price="{{$data->price}}" target="qty{{$i}}" type="button">Buy</button>
						                    </span>
						                  </div>
					                  </td>
					                </tr>
					              <?php $i++; ?>
					              @endforeach
					              </tbody>
					            </table>
					          </div>
					        </div>
					      </div>
		          </div><!-- /.tab-pane -->
		        </div><!-- /.tab-content -->
		      </div>
				</div>
			</div>
		</div>
	</section>
@section('script')
<!-- PRINT BON -->
<script language="javascript" type="text/javascript">
  function printDiv(divID) {
	  //Get the HTML of div
	  var divElements = document.getElementById(divID).innerHTML;
	  //Get the HTML of whole page
	  var oldPage = document.body.innerHTML;
	  //Reset the page's HTML with div's HTML only
	  document.body.innerHTML = 
	    "<html><head><title></title></head><body>" + divElements + "</body>";
	  //Print Page
	  window.print();
	  //Restore orignal HTML
	  document.body.innerHTML = oldPage;
  }
</script>

<!-- DISKON SCRIPT -->
<script type="text/javascript">
	$(document).on( 'keyup', '#percent', function (event) {
		var total 	= $("#grand").attr('val');
		var percent	= $(this).val().replace(/\,/g, "");

		var dis = total * percent / 100;
		$("#nominal").val( number_format( dis ) );
		setInput( total, dis );
	});

	$(document).on( 'keyup', '#nominal', function (event) {
		var total 	= $("#grand").attr('val');
		var nominal	= $(this).val().replace(/\,/g, "");

		var dis = nominal * 100 / total;
		$("#percent").val(  dis  );
		setInput( total, nominal );
	});

	function setInput( total, parameter ){
		
		$("#grand_discount").html( number_format( parameter ) );
		$("#grand_total").html( number_format( total - parameter ) );
		$(".discount_div").attr( 'style', '' );
		kembalian( total - parameter, false );
	}
</script>

<!-- KEMBALIAN SCRIPT -->
<script type="text/javascript">
	$(document).on( 'keyup', '#recieve', function (event) {
		var total 	= $("#grand_total").html().replace(/\./g, "");
		if ( total == 0 ) {
			total 		= $("#grand").attr('val');
		}
		var uang 		= $(this).val().replace(/\,/g, "");

		kembalian( total, uang );
	});

	function kembalian(total, uang) {
		if ( uang == false ) {
			uang = $("#recieve").val().replace(/\,/g, "");
		}
		var kembalian = uang - total;
		$("#change").val( number_format( kembalian ) );
	}
</script>

<!-- Script ubah id karyawan di button buy -->
<script type="text/javascript">
	$(document).on( 'change', '.staff_select', function (event) {
		var id 						= $(this).children(":selected").attr("value");
		var name 					= $(this).children(":selected").attr("staff");
		var button_target = $(this).children(":selected").attr("button_target")
		$('#service_buy_'+button_target).attr( 'staff_id', id );
		$('#service_buy_'+button_target).attr( 'staff_name', name );
	});
</script>

<script type="text/javascript">
	var grand = $('.grand');
	grand.hide();
	var cart  = [];
  var i = 0;
  var grand_total = 0;

	$(document).on( 'click', '.buy', function( event ) {
		if (typeof $(this).attr("item_id") !== 'undefined') {
			var item_id 	 		= $(this).attr("item_id")
		  var item_name	 		= $(this).attr("item_name")
		  var item_price 		= $(this).attr("item_price")
		} else {
			var service_id 	 	= $(this).attr("service_id")
		  var service_name	= $(this).attr("service_name")
		  var service_price = $(this).attr("service_price")
		  var staff_id 			= $(this).attr("staff_id")
		  var staff_name		= $(this).attr("staff_name")
		}
		var data_type 		= $(this).attr("datatype")

	  var target 		 		= $(this).attr("target")
	  if ($("#"+target).val() < 0) {
	  	return false;
	  }
	  if ($("#"+target).val() == "") {
	  	var qty    	 = 1
	  } else {
	  	var qty    	 = $("#"+target).val()
	  }

		if (typeof $(this).attr("item_id") !== 'undefined') {
  		var total_price_per_item = item_price * qty;
  	} else {
	  	var total_price_per_service = service_price * qty;
  	}

	  var loop = false;
	  for (var a = cart.length - 1; a >= 0; a--) {
	  	if ( cart[a][0] == item_id && cart[a][5] == "item" ) {
	  		cart[a][3] = +cart[a][3] + +qty;
	  		cart[a][4] = +cart[a][4] + +total_price_per_item;
	  		loop = true;
	  	}
	  	if ( cart[a][0] == service_id && cart[a][6] == staff_id && cart[a][5] == "service" ) {
	  		cart[a][3] = +cart[a][3] + +qty;
	  		cart[a][4] = +cart[a][4] + +total_price_per_service;
	  		loop = true;
	  	}
	  }

		if (typeof item_id !== 'undefined') {
		  cart.push( [ item_id, item_name, item_price, qty, total_price_per_item, data_type ] );
		  if (loop == false) {
			  tr = $('<tr class="item" id="item_tr_'+ i +'" />');
		    tr.append("<td><small>" + item_name + "</small></td>");
		    tr.append("<td id='item_"+item_id+"_qty'>" + qty + "</td>");
		    tr.append("<td id='item_"+item_id+"_price' data='"+total_price_per_item+"'><small>" + number_format(total_price_per_item ) + "</small></td>");
		    tr.append("<td class='data'><button id='item_del_"+item_id+"' target='"+i+"' item_id='"+item_id+"' class='btn btn-xs btn-danger del' price='"+total_price_per_item+"'><i class='fa fa-times'></i></button></td>");
		    tr.append("<td style='display:none'><input type='hidden' name='item_id["+i+"]' value='"+item_id+"'><input type='hidden' id='total_price_per_item_"+item_id+"' name='total_price_item["+i+"]' value='"+total_price_per_item+"'><input type='hidden' id='quantity_item_"+item_id+"' name='quantity_item["+i+"]' value='"+qty+"'></td>");
		    $('#cart').append(tr);
		  	i+=1;
		  } else{
		  	var tr = $('#item_del_'+item_id).closest('tr');
		  	if (!tr.is(":visible")) {
		  		tr.css("background-color","#ffffff");
		  		tr.show();
		  		$("#item_"+item_id+"_qty").html(qty);
		  		$("#item_"+item_id+"_price").html(total_price_per_item);
			  	$('#item_'+item_id+'_price').attr("data", item_price);
			  	$('#item_del_'+item_id).attr("price", item_price);
			  	$('#quantity_item_'+item_id).val(+$('#quantity_item_'+item_id).val() + +qty);
		  	} else {
		  		$('#item_'+item_id+'_qty').html(+$('#item_'+item_id+'_qty').html() + +qty);
			  	$('#quantity_item_'+item_id).val(+$('#quantity_item_'+item_id).val() + +qty);
			  	var sum = +$('#item_'+item_id+'_price').attr("data") + +total_price_per_item;
			  	$('#item_'+item_id+'_price').attr("data", sum);
			  	$('#item_'+item_id+'_price').html(number_format(sum));
			  	$('#total_price_per_item_'+item_id).val(sum);
			  	$('#item_del_'+item_id).attr('price',sum);
		  	}
		  }
		}else{
		  cart.push( [ service_id, service_name, service_price, qty, total_price_per_service, data_type, staff_id  ] );
			if (loop == false) {
			  tr = $('<tr class="service" id="service_tr_'+ i +'" />');
			  console.log( staff_name )
			  if ( staff_name ) {
			    tr.append("<td><small>" + service_name + "<br><code>" + staff_name + "</code>" + "</small></td>");
			  }else{
			    tr.append("<td><small>" + service_name + "</small></td>");
			  }
		    
		    tr.append("<td id='service_"+service_id+"_qty'>" + qty + "</td>");
		    tr.append("<td id='service_"+service_id+"_price' data='"+total_price_per_service+"'><small>" + number_format(total_price_per_service ) + "</small></td>");
		    // tr.append("<td><a data-toggle='modal' data-target='#disc-peritem' id='dis_"+item_id+"' target='"+i+"' item_id='"+item_id+"' class='btn btn-sm btn-default dis' price='"+total_price_per_item+"'><i class='fa fa-ticket'></i></a></td>");
		    tr.append("<td class='data'><button id='service_del_"+service_id+"' target='"+i+"' service_id='"+service_id+"' class='btn btn-xs btn-danger del' price='"+total_price_per_service+"'><i class='fa fa-times'></i></button></td>");
		    
		    // data aslinya kayak bgini sblm gw belah
		    // tr.append("<td style='display:none'><input type='hidden' name='staff_id["+i+"]' value='"+staff_id+"'><input type='hidden' name='service_id["+i+"]' value='"+service_id+"'><input type='hidden' id='total_price_per_service_"+service_id+"' name='total_price_service["+i+"]' value='"+total_price_per_service+"'><input type='hidden' id='quantity_service_"+service_id+"' name='quantity_service["+i+"]' value='"+qty+"'></td>");

		    // ini gua coba belah
		    tr.append("<td style='display:none'><input type='hidden' name='staff_id["+i+"]' value='"+staff_id+"'></td>");
		    tr.append("<td style='display:none'><input type='hidden' name='service_id["+i+"]' value='"+service_id+"'></td>");
		    tr.append("<td style='display:none'><input type='hidden' id='total_price_per_service_"+service_id+"' name='total_price_service["+i+"]' value='"+total_price_per_service+"'></td>");
		    tr.append("<td style='display:none'><input type='hidden' id='quantity_service_"+service_id+"' name='quantity_service["+i+"]' value='"+qty+"'></td>");

		    $('#cart').append(tr);
		  	i+=1;
		  } else{
		  	var tr = $('#service_del_'+service_id).closest('tr');
		  	if (!tr.is(":visible")) {
		  		tr.css("background-color","#ffffff");
		  		tr.show();
		  		$("#service_"+service_id+"_qty").html(qty);
		  		$("#service_"+service_id+"_price").html(total_price_per_service);
			  	$('#service_'+service_id+'_price').attr("data", service_price);
			  	$('#service_del_'+service_id).attr("price", service_price);
			  	$('#quantity_service_'+service_id).val(+$('#quantity_service_'+service_id).val() + +qty);
		  	} else {
		  		$('#service_'+service_id+'_qty').html(+$('#service_'+service_id+'_qty').html() + +qty);
			  	$('#quantity_service_'+service_id).val(+$('#quantity_service_'+service_id).val() + +qty);
			  	var sum = +$('#service_'+service_id+'_price').attr("data") + +total_price_per_service;
			  	$('#service_'+service_id+'_price').attr("data", sum);
			  	$('#service_'+service_id+'_price').html(number_format(sum));
			  	$('#total_price_per_service_'+service_id).val(sum);
			  	$('#service_del_'+service_id).attr('price',sum);
		  	}
		  }
		}

		if (typeof $(this).attr("item_id") !== 'undefined' && typeof $(this).attr("service_id") !== 'undefined') {
    	grand_total = grand_total + total_price_per_item + total_price_per_service
		}
		if (typeof $(this).attr("service_id") === 'undefined') {
    	grand_total = grand_total + total_price_per_item
		}
		if (typeof $(this).attr("item_id") === 'undefined') {
    	grand_total = grand_total + total_price_per_service
		}
		$('#grand').html( number_format(grand_total) );
		$('#grand').attr( "val",grand_total );
		$('#total_harga').val( number_format(grand_total) );
		$('#total_harga').attr( "price", grand_total );
    grand.show();
    $('#recieve').val('');
    $('#change').val('');
    $('#percent').val('');
    $('#nominal').val('');
    $('.discount_div').hide();
    document.getElementById($(this).attr("input_id")).value = '';
    console.log(cart);
	});

	$(document).on( 'click', '.del', function( event ) {
		//delete cart where item id 

	  if (typeof $(this).attr("item_id") !== 'undefined') {
	  	var total_price_per_item = $(this).attr('price');
	  } else {
	  	var total_price_per_service = $(this).attr('price');
	  }
	  var tr = $(this).closest('tr');
	  var target = $(this).attr( 'target' );
	  
	  if (typeof $(this).attr("item_id") !== 'undefined') {
		  var item_id= $(this).attr( 'item_id' );

		  $('#quantity_item_'+item_id).val(0);
		  $("#"+item_id+"_qty").val(0);
			$("#"+item_id+"_price").val(0);
		} else {
			var service_id= $(this).attr( 'service_id' );

		  $('#quantity_service_'+service_id).val(0);
		  $("#"+service_id+"_qty").val(0);
			$("#"+service_id+"_price").val(0);
		}
	  tr.css("background-color","#dd4b39");
    tr.fadeOut(500, function(){
        tr.hide();
    });

    if (typeof $(this).attr("item_id") !== 'undefined' && typeof $(this).attr("service_id") !== 'undefined') {
    	grand_total = grand_total - total_price_per_item - total_price_per_service
		}
		if (typeof $(this).attr("service_id") === 'undefined') {
    	grand_total = grand_total - total_price_per_item
		}
		if (typeof $(this).attr("item_id") === 'undefined') {
    	grand_total = grand_total - total_price_per_service
		}

		if (grand_total == 0) {
			$('.grand').hide();
		}
	  $(this).attr('price', 0);
		$('#grand').html( number_format(grand_total) );
		$('#grand').attr( "val",grand_total );
		$('#total_harga').val( number_format(grand_total) );
		$('#total_harga').attr( "price", grand_total );
    $('#recieve').val('');
    $('#change').val('');
    $('#percent').val('');
    $('#nominal').val('');
		$('.discount_div').hide();
		cart = cart.filter(function(elem) {  
		  return elem[0] !== item_id; 
		});
    return false;
	});
</script>

<!-- number_format on php SCRIPT -->
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


<script type="text/javascript">
	(function() {
	    var beforePrint = function() {
	        console.log('Functionality to run before printing.');
	    };
	    var afterPrint = function() {
	    		$("#myForm").submit();
	        // console.log('Functionality to run after printing');
	    };

	    if (window.matchMedia) {
	        var mediaQueryList = window.matchMedia('print');
	        mediaQueryList.addListener(function(mql) {
	            if (mql.matches) {
	                beforePrint();
	            } else {
	                afterPrint();
	            }
	        });
	    }

	    window.onbeforeprint = beforePrint;
	    window.onafterprint = afterPrint;
	}());
</script>
@endsection
@endsection