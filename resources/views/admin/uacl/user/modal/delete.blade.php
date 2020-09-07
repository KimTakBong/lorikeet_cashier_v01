<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-title" id="myModalLabel">Are you sure want to delete {{ $user->name }} ?</h4>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      <a href="{{ route( 'uacl.user.delete.post', \Crypt::encrypt( $user->id ) ) }}" class="btn btn-danger">Delete</a> 
    </div>
  </div>
</div>