<form enctype="multipart/form-data" action="{{route('uacl.user.create.post')}}" method="post">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Buat Pengguna Baru </h4>
      </div>
      <div id="modal" class="modal-body">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#create_1" data-toggle="tab" aria-expanded="true">Personal Info</a></li>
            <li class=""><a href="#create_2" data-toggle="tab" aria-expanded="false">Input Password</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="create_1">
              <div class="box-body">
                <div class="form-group">
                  <label>Group</label>
                  <select class="form-control" name="usergroup">
                    <option></option>
                    @for( $ug = 0; $ug < $count_group; $ug++ )
                    <option value="{{$usergroup[$ug]->id}}">{{$usergroup[$ug]->name}}</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input name="name" class="form-control" placeholder="Enter User Name" required="required">
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter User Email" required="required">
                </div>
                <hr>
                <div class="form-group">
                  <span class="btn btn-success btn-file">
                      Upload Avatar Image <input type="file" name="avatar">
                  </span>
                </div>
              </div>
            </div>
            <div class="tab-pane" id="create_2">
              <div class="form-group">
                <label>Password</label>
                <input name="password" id="password" type="password" class="form-control" placeholder="Enter password" required="required">
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm password" required="required">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="save">Save</button>
      </div>
    </div>
  </div>
</form>
<script type="text/javascript">
  $( '#save' ).hide();
  $(document).on( 'change', '#password', function( event ) {
  $( '#save' ).show();
  });
</script>