<form enctype="multipart/form-data" action="{{route('uacl.group.create.post')}}" method="post">
  <div class="modal-dialog modal-lg" role="document">
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
              <!-- Dashboard & Report -->
              <table class="table table-bordered table-striped dataTable" role="grid">
                <th>Dashboard & Report</th>
                <th>Read</th>
                <tr>
                  <td>Dashboard</td>
                  <td><input name="dashboard-r" type="checkbox"></td>
                </tr>
                <tr>
                  <td>Laporan</td>
                  <td><input name="report-r" type="checkbox"></td>
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
                  <td><input name="transaction-c" type="checkbox"></td>
                  <td><input name="transaction-r" type="checkbox"></td>
                  <td><input name="transaction-u" type="checkbox"></td>
                  <td><input name="transaction-d" type="checkbox"></td>
                </tr>
                <tr>
                  <td>Product Management</td>
                  <td><input name="item-c" type="checkbox"></td>
                  <td><input name="item-r" type="checkbox"></td>
                  <td><input name="item-u" type="checkbox"></td>
                  <td><input name="item-d" type="checkbox"></td>
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
                  <td><input name="cost-c" type="checkbox"></td>
                  <td><input name="cost-r" type="checkbox"></td>
                  <td><input name="cost-u" type="checkbox"></td>
                  <td><input name="cost-d" type="checkbox"></td>
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