<form enctype="multipart/form-data" action="{{route('uacl.group.create.post')}}" method="post">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Usergroup </h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="box-body">
          <div class="form-group">
            <label>Name</label>
            <input name="name" class="form-control" placeholder="Enter Usergroup Name" required="required">
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
                  <td><input name="group-c" type="checkbox"></td>
                  <td><input name="group-r" type="checkbox"></td>
                  <td><input name="group-u" type="checkbox"></td>
                  <td><input name="group-d" type="checkbox"></td>
                </tr>
                <tr>
                  <td>User</td>
                  <td><input name="user-c" type="checkbox"></td>
                  <td><input name="user-r" type="checkbox"></td>
                  <td><input name="user-u" type="checkbox"></td>
                  <td><input name="user-d" type="checkbox"></td>
                </tr>
                <tr>
                  <td>Station Management</td>
                  <td><input name="station-c" type="checkbox"></td>
                  <td><input name="station-r" type="checkbox"></td>
                  <td><input name="station-u" type="checkbox"></td>
                  <td><input name="station-d" type="checkbox"></td>
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