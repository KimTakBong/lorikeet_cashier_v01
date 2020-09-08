<form enctype="multipart/form-data" action="{{route('uacl.group.update.post', \Crypt::encrypt( $group->id ))}}" method="post">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Usergroup {{ $group->name }} </h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <label>Name</label>
            <input name="name" class="form-control" placeholder="Enter Usergroup Name" required="required" value="{{$group->name}}">
          </div>
          <div class="form-group">
            <label>Hak Akses</label><br>
              <!-- Dashboard & Report -->
              <table class="table table-bordered table-striped dataTable" role="grid">
                <th>Dashboard & Report</th>
                <th>Read</th>
                <tr>
                  <td>Dashboard</td>
                  <td><input name="dashboard-r" type="checkbox" @if( isset($group->access_right->dashboard->r) && $group->access_right->dashboard->r == true ) checked="checked" @endif></td>
                </tr>
                <tr>
                  <td>Laporan</td>
                  <td><input name="report-r" type="checkbox" @if( isset($group->access_right->report->r) && $group->access_right->report->r == true ) checked="checked" @endif></td>
                </tr>
              </table>
              <hr>
              <!-- END Dashboard & Report -->
              <!-- Transaction & Product Management -->
              <table class="table table-bordered table-striped dataTable" role="grid">
                <th>Selling</th>
                <th>Create</th>
                <th>Read</th>
                <th>Update</th>
                <th>Delete</th>
                <tr>
                  <td>Transaction</td>
                  <td><input name="transaction-c" type="checkbox" @if( isset($group->access_right->transaction->c) && $group->access_right->transaction->c == true ) checked="checked" @endif></td>
                  <td><input name="transaction-r" type="checkbox" @if( isset($group->access_right->transaction->r) && $group->access_right->transaction->r == true ) checked="checked" @endif></td>
                  <td><input name="transaction-u" type="checkbox" @if( isset($group->access_right->transaction->u) && $group->access_right->transaction->u == true ) checked="checked" @endif></td>
                  <td><input name="transaction-d" type="checkbox" @if( isset($group->access_right->transaction->d) && $group->access_right->transaction->d == true ) checked="checked" @endif></td>
                </tr>
                <tr>
                  <td>Product Management</td>
                  <td><input name="item-c" type="checkbox" @if( isset($group->access_right->item->c) && $group->access_right->item->c == true ) checked="checked" @endif></td>
                  <td><input name="item-r" type="checkbox" @if( isset($group->access_right->item->r) && $group->access_right->item->r == true ) checked="checked" @endif></td>
                  <td><input name="item-u" type="checkbox" @if( isset($group->access_right->item->u) && $group->access_right->item->u == true ) checked="checked" @endif></td>
                  <td><input name="item-d" type="checkbox" @if( isset($group->access_right->item->d) && $group->access_right->item->d == true ) checked="checked" @endif></td>
                </tr>
              </table>
              <hr>
              <!-- END Transaction & Product Management -->
              <!-- Cost -->
              <table class="table table-bordered table-striped dataTable" role="grid">
                <th>Pengeluaran</th>
                <th>Create</th>
                <th>Read</th>
                <th>Update</th>
                <th>Delete</th>
                <tr>
                  <td>Pengeluaran</td>
                  <td><input name="cost-c" type="checkbox" @if( isset($group->access_right->cost->c) && $group->access_right->cost->c == true ) checked="checked" @endif></td>
                  <td><input name="cost-r" type="checkbox" @if( isset($group->access_right->cost->r) && $group->access_right->cost->r == true ) checked="checked" @endif></td>
                  <td><input name="cost-u" type="checkbox" @if( isset($group->access_right->cost->u) && $group->access_right->cost->u == true ) checked="checked" @endif></td>
                  <td><input name="cost-d" type="checkbox" @if( isset($group->access_right->cost->d) && $group->access_right->cost->d == true ) checked="checked" @endif></td>
                </tr>
              </table>
              <hr>
              <!-- END Cost -->
              <!-- UACL -->
              <table class="table table-bordered table-striped dataTable" role="grid">
                <th>UACL</th>
                <th>Create</th>
                <th>Read</th>
                <th>Update</th>
                <th>Delete</th>
                <tr>
                  <td>Group</td>
                  <td><input name="group-c" type="checkbox" @if( isset($group->access_right->group->c) && $group->access_right->group->c == true ) checked="checked" @endif></td>
                  <td><input name="group-r" type="checkbox" @if( isset($group->access_right->group->r) && $group->access_right->group->r == true ) checked="checked" @endif></td>
                  <td><input name="group-u" type="checkbox" @if( isset($group->access_right->group->u) && $group->access_right->group->u == true ) checked="checked" @endif></td>
                  <td><input name="group-d" type="checkbox" @if( isset($group->access_right->group->d) && $group->access_right->group->d == true ) checked="checked" @endif></td>
                </tr>
                <tr>
                  <td>User</td>
                  <td><input name="user-c" type="checkbox" @if( isset($group->access_right->user->c) && $group->access_right->user->c == true ) checked="checked" @endif></td>
                  <td><input name="user-r" type="checkbox" @if( isset($group->access_right->user->r) && $group->access_right->user->r == true ) checked="checked" @endif></td>
                  <td><input name="user-u" type="checkbox" @if( isset($group->access_right->user->u) && $group->access_right->user->u == true ) checked="checked" @endif></td>
                  <td><input name="user-d" type="checkbox" @if( isset($group->access_right->user->d) && $group->access_right->user->d == true ) checked="checked" @endif></td>
                </tr>
              </table>
              <!-- End UACL -->
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