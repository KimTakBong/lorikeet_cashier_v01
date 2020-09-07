@extends( 'admin.layout.layout' )
@section( 'content' )
<?php 
 use App\Models\User;
 use App\Models\Usergroup;

?>
@if( $role->group->r == true )
<section class="content-header">
  <h1>
    User
    <small>Management</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route( 'system.index' ) }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">User</li>
  </ol>
</section>
@if( $errors->all() != null )
  <div class="row">
    <div class="col-md-3"></div>
    <div class="alert alert-danger alert-dismissable col-md-6">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa fa-ban"></i> Whoops, looks like something went wrong.</h4>
      @foreach ($errors->all() as $message)
        <li>{{ $message }}</li>
      @endforeach
    </div>  
    <div class="col-md-3"></div>
  </div>
@endif

<section class="content">
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
  <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
  <div class="box">
    <div class="box-header">
      <h3 class="box-title">User List</h3>
    </div><!-- /.box-header -->
    <div class="box-body">
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          @for( $i = 0; $i < $count_group; $i++ )
            <li @if( $i == 0 ) class="active" @endif ><a href="#tab_{{$i}}" data-toggle="tab" aria-expanded="true">{{ $usergroup[$i]->name }}</a></li>
          @endfor
        </ul>
        <div class="tab-content">
          @for( $i = 0; $i < $count_group; $i++ )
          <div @if( $i == 0 ) class=" tab-pane active" @else class="tab-pane" @endif id="tab_{{$i}}">
            <div class="box-body">
              <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
                @if($role->user->c == true)
                <div class="row">
                  <div class="col-md-6">
                    <a class="btn btn-primary btn-md spawnModal" data-toggle="modal" data-target="#createModal" href="{{route( 'uacl.user.create' )}}">Tambah Pengguna Baru</a>
                  </div>
                </div>
                @endif
                <br><br>
                <div class="row">
                  <div class="col-sm-12">
                    <table id="example2" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                      <thead>
                        <tr role="row">
                          <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Name: activate to sort column descending" style="width: 177px;">
                            Name
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
                            Email
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
                            Avatar
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Level: activate to sort column ascending" style="width: 224px;">
                            Action
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php 
                        $user       = User::where( 'group_id', $usergroup[$i]->id )->get();
                        $count_user = count($user);
                      ?>
                      @for( $a = 0; $a<$count_user; $a++ )
                        <tr role="row" class="odd">
                            <td class="sorting_1">{{ $user[$a]->name }}</td>
                            <td>{{ $user[$a]->email }}</td>
                            @if( $user[$a]->avatar != null )
                            <td><img src="{{asset($user[$a]->avatar)}}" class="img-circle" style="height:70px;width:70px;"></td>
                            @else
                            <td><img src="{{ asset( 'no-image.png' ) }}" class="img-circle" style="height:70px;width:70px;" /></td>
                            @endif
                            <td align="center">
                              @if($role->user->u == true)
                              <a href="{{ route('uacl.user.update', \Crypt::encrypt( $user[$a]->id )) }}" class="btn btn-warning btn-md spawnModal" data-toggle="modal" data-target="#updateModal">Perbaharui</a>
                              @endif
                              @if($role->user->d == true)
                              <a href="{{ route('uacl.user.delete', \Crypt::encrypt( $user[$a]->id )) }}" class="btn btn-danger btn-md spawnModal" data-toggle="modal" data-target="#deleteModal">Hapus</a>
                              @endif
                            </td>
                        </tr>
                      @endfor
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.tab-pane -->
          @endfor
        </div><!-- /.tab-content -->
      </div>
    </div><!-- /.box-body -->
  </div>
</section>
@else
<code>Maaf anda tidak diizinkan melihat halaman ini, mohon hubungi administrator jika anda ingin meminta akses</code>
@endif
@endsection

@section ( 'datatablejs' )
    <script src="{{ asset( 'AdminLTE/plugins/datatables/jquery.dataTables.min.js' ) }}" type="text/javascript"></script>
    <script src="{{ asset( 'AdminLTE/plugins/datatables/dataTables.bootstrap.min.js' ) }}" type="text/javascript"></script>
    
    <script type="text/javascript">
      $(function () {
        $('#example2').dataTable();
      });
    </script>
@endsection

@section('script')

    <script type="text/javascript">
    $(document).on( 'click', '.spawnModal', function( event ) {
      var target  = $(this).attr("data-target")
      var href    = $(this).attr("href")
      $.ajax({
        url: href,
        success: function(data){
          $(target).html(data);
        }
      });
    });
    </script>
@endsection