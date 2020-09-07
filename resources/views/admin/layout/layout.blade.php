<?php 
  $role = json_decode(\Auth::user()->usergroup->access_right);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title> {{ $title }} </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="{{ asset( 'adminlte/bootstrap/css/bootstrap.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'adminlte/dist/css/adminlte.min.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'adminlte/dist/css/skins/_all-skins.min.css' ) }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'adminlte/plugins/daterangepicker/daterangepicker-bs3.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset( 'adminlte/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link rel="icon" href="{{asset('favicon.png')}}" type="image/x-icon">
    <!-- DataTables -->
    <link href="{{ asset( 'adminlte/plugins/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" >
    @yield('link')

  </head>
  <body class="skin-blue sidebar-mini wysihtml5-supported fixed">
    <div class="wrapper">

      <header class="main-header">
        @include('admin/layout/header')
      </header>
      <aside class="main-sidebar">
        @include('admin/layout/sidebar')
      </aside>

      <div class="content-wrapper">
        <div class="flash-message">
          @foreach (['danger', 'warning', 'success', 'info'] as $msg)
            @if(Session::has('alert-' . $msg))

            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
            @endif
          @endforeach
        </div> <!-- end .flash-message -->
        @yield('content')   
      </div>

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2015 <a href="http://bash.com">Bash.com</a>.</strong> All rights reserved.
      </footer>

      <aside class="control-sidebar control-sidebar-dark">
        @include('admin/layout/control')
      </aside>
      <div class='control-sidebar-bg'></div>
    </div>

    <!-- jQuery 3.1.4 -->
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset( 'adminlte/bootstrap/js/bootstrap.min.js' ) }}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{ asset( 'adminlte/plugins/fastclick/fastclick.min.js' ) }}"></script>
    <!-- adminlte App -->
    <script src="{{ asset( 'adminlte/dist/js/app.min.js' ) }}" type="text/javascript"></script>
    <!-- Sparkline -->
    <script src="{{ asset( 'adminlte/plugins/sparkline/jquery.sparkline.min.js' ) }}" type="text/javascript"></script>
    <!-- jvectormap -->
    <script src="{{ asset( 'adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js' ) }}" type="text/javascript"></script>
    <script src="{{ asset( 'adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js' ) }}" type="text/javascript"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="{{ asset( 'adminlte/plugins/slimScroll/jquery.slimscroll.min.js' ) }}" type="text/javascript"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="{{ asset( 'adminlte/plugins/chartjs/Chart.min.js' ) }}" type="text/javascript"></script>
    <!-- adminlte for demo purposes -->
    <script src="{{ asset( 'adminlte/dist/js/demo.js' ) }}" type="text/javascript"></script>
    <!-- InputMask -->
    <script src="{{asset('adminlte/plugins/input-mask/jquery.inputmask.js')}}" type="text/javascript"></script>
    <script src="{{asset('adminlte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}" type="text/javascript"></script>
    <script src="{{asset('adminlte/plugins/input-mask/jquery.inputmask.extensions.js')}}" type="text/javascript"></script>
    <!-- Bootstrap time Picker -->
    <link href="{{asset('adminlte/plugins/timepicker/bootstrap-timepicker.min.css')}}" rel="stylesheet"/>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js" type="text/javascript"></script>
    <script src="{{asset('adminlte/plugins/daterangepicker/daterangepicker.js')}}" type="text/javascript"></script>
    <!-- DataTables -->
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
    <!-- number_format js -->
    @yield('script')

    <script>
      $(function () {
        $("#example1").DataTable();
        $("#example2").DataTable();
        $("#example3").DataTable();
        $("#example4").DataTable();
      });
    </script>
    <div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        <?php $user = \Auth::user(); ?>
          <form role="form" action="{{route('uacl.user.update', \Crypt::encrypt($user->id))}}" method="POST" novalidate enctype="multipart/form-data">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Update {{ $user->name }}</h4>
            </div>
            <div class="modal-body">
              <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                  <li class="active"><a href="#profile_1" data-toggle="tab" aria-expanded="true">Personal Info</a></li>
                  <li class=""><a href="#profile_2" data-toggle="tab" aria-expanded="false">Change Password</a></li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane active" id="profile_1">
                    <div class="box-body">
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
                  <div class="tab-pane" id="profile_2">
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
    </div>
  </body>
</html>