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
<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
    <div id="print">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Detail <font color="@if($input['status']=='income') blue @else red @endif"><b>{{ucwords($input['status'])}}</b></font> on <code>{{ $input['date'] }}</code> </h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body">
          <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
            @if($input['status']=='income')
            <table id="example2" class="table table-bordered table-striped">
              <thead>
                <tr role="row">
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
                    Selling Item
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
                    Quantity
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
                    Total Price
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  $grand = 0;
                ?>
              @foreach( $income as $data )
                <tr style="height: 1px;" role="row" class="odd">
                  <td>{{ $data['name'] }}</td>
                  <td>{{ $data['quantity'] }}</td>
                  <td>Rp. {{ number_format($data['total_price']) }}</td>
                </tr>
                <?php $grand += $data['total_price']; ?>
              @endforeach
                <tr><td colspan="3"></td></tr>
                <tr>
                  <td colspan="2"><b>Total Income :</b></td>
                  <td><b><code>Rp. {{ number_format($grand) }}</code></b></td>
                </tr>
              </tbody>
            </table>
            @else
            <table id="example4" class="table table-bordered table-striped">
              <thead>
                <tr role="row">
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
                    Name
                  </th>
                  <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
                    Nominal
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php $grand=0; ?>
              @foreach( $cost as $data )
                <tr style="height: 1px;" role="row" class="odd">
                  <td>{{ $data['name'] }}</td>
                  <td>Rp. {{ number_format($data['nominal']) }}</td>
                </tr>
                <?php $grand+=$data['nominal']; ?>
              @endforeach
                <tr><td colspan="2"></td></tr>
                <tr>
                  <td><b>Total Income :</b></td>
                  <td><b><code>Rp. {{ number_format($grand) }}</code></b></td>
                </tr>
              </tbody>
            </table>
            @endif
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-success" onclick="window.print()">Print Laporan</button>
    </div>
  </div>
</div>
