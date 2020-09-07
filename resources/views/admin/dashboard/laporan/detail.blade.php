<div class="modal-dialog modal-lg" role="document">
  <div class="modal-content">
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
            @foreach( $income as $data )
              <tr style="height: 1px;" role="row" class="odd">
                <td>{{ $data['name'] }}</td>
                <td>{{ $data['quantity'] }}</td>
                <td>Rp. {{ number_format($data['total_price']) }}</td>
              </tr>
            @endforeach
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
            @foreach( $cost as $data )
              <tr style="height: 1px;" role="row" class="odd">
                <td>{{ $data['name'] }}</td>
                <td>Rp. {{ number_format($data['nominal']) }}</td>
              </tr>
            @endforeach
            </tbody>
          </table>
          @endif
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>
