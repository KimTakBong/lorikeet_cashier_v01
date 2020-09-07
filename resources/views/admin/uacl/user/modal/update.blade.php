<div class="modal-dialog">
  <div class="modal-content">
    <form role="form" action="{{route('uacl.user.update', \Crypt::encrypt($user->id))}}" method="POST" novalidate enctype="multipart/form-data">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Update {{ $user->name }}</h4>
      </div>
      <div class="modal-body">
        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#update_1" data-toggle="tab" aria-expanded="true">Personal Info</a></li>
            <li class=""><a href="#update_2" data-toggle="tab" aria-expanded="false">Change Password</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="update_1">
              <div class="box-body">
                <div class="form-group">
                  <label>Group</label>
                  <select class="form-control" name="usergroup">
                    @for( $ug = 0; $ug < $count_group; $ug++ )
                    <option value="{{$usergroup[$ug]->id}}" @if($usergroup[$ug]->id == $user->group_id) selected="selected" @endif>{{$usergroup[$ug]->name}}</option>
                    @endfor
                  </select>
                </div>
                <div class="form-group">
                  <label>Name</label>
                  <input name="name" class="form-control" placeholder="Enter User Name" value="{{$user->name}}" required>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" name="email" class="form-control" placeholder="Enter User Email" value="{{$user->email}}" required>
                </div>
                <hr>
                <div class="form-group">
                  <span class="btn btn-success btn-file">
                      Upload Avatar Image <input type="file" name="avatar">
                  </span>
                  @if( $user->avatar != null )
                    <img src="{{ asset($user->avatar) }}" border="0" width="50" class="img-circle">
                  @endif
                </div>
              </div>
            </div>
            <div class="tab-pane" id="update_2">
              <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" class="form-control" placeholder="Enter password" required>
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input name="password_confirmation" type="password" class="form-control" placeholder="Confirm password" required>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
      </div>
    </form>
  </div>
</div>