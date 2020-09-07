<form enctype="multipart/form-data" action="{{route('uacl.group.update.post', \Crypt::encrypt( $group->id ))}}" method="post">
  <div class="modal-dialog" role="document">
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
              <table class="table table-bordered table-striped dataTable" role="grid">
                  <th>Module Name</th>
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
                <tr>
                  <td>Station Management</td>
                  <td><input name="station-c" type="checkbox" @if( isset($group->access_right->station->c) && $group->access_right->station->c == true ) checked="checked" @endif></td>
                  <td><input name="station-r" type="checkbox" @if( isset($group->access_right->station->r) && $group->access_right->station->r == true ) checked="checked" @endif></td>
                  <td><input name="station-u" type="checkbox" @if( isset($group->access_right->station->u) && $group->access_right->station->u == true ) checked="checked" @endif></td>
                  <td><input name="station-d" type="checkbox" @if( isset($group->access_right->station->d) && $group->access_right->station->d == true ) checked="checked" @endif></td>
                </tr>
              </table>
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