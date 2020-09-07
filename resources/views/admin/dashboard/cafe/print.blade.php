<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{asset('print.css')}}">
</head>
<body>
	<table border="0" id="page">
		<thead>
			<tr class="header">
				<td><img src="{{asset('logo.png')}}" height="30"></td>
			</tr>
			<tr>
				<td>Tanggal</td>
				<td>: {{ date( 'd/m/Y' ) }}</td>
			</tr>
			<tr>
				<td>Operator</td>
				<td>: {{ \Auth::user()->name }}</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th colspan="4"><hr></th>
			</tr>
			<tr>
				<th>Name</th>
				<th>Qty</th>
				<th colspan="2">Price</th>
			</tr>

            
			<tr>
				<td colspan="4">
					-------------------------------------------
				</td>
			</tr>
			<tr>
				<td colspan="3">Total</td>
				<td>Rp. </td><br>
			</tr>
			<tr>
				<td colspan="4">
					===========================================
				</td>
			</tr>
		</tbody>
	</table>
	
<div style="page-break-after: always;"></div>
</body>
</html>