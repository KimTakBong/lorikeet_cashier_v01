<div class="modal-dialog">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      <h4 class="modal-title" id="myModalLabel">Anda Yakin Ingin Menghapu Group {{ $group->name }} ?</h4>
    </div>
    <div class="modal-body">
      <code>Semua pengguna yang ada di dalam group {{ $group->name }} juga akan tehapus!!</code>
    </div>
    <div class="modal-footer">
      <input type="hidden" name="_token" value="{{csrf_token()}}">
      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    </div>
  </div>
</div>