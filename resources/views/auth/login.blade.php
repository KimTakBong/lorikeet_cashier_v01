<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Lorikeet</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{ asset( 'adminlte/bootstrap/css/bootstrap.min.css' ) }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset( 'adminlte/dist/css/adminlte.min.css' ) }}" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="{{ asset( 'adminlte/plugins/iCheck/square/blue.css' ) }}" rel="stylesheet" type="text/css" />
  </head>

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
  <body class="bg-img" background="{{ asset('bg.jpg') }}">
    <div class="login-box">
      <div class="login-logo">
        <a href=""><b>Lori</b>keet</a>
      </div>
      <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <form action="{{ url('/auth/login') }}" method="post">
          <div class="form-group has-feedback">
            <input name="email" type="email" class="form-control" placeholder="Email">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input name="password" type="password" class="form-control" placeholder="Password">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </form>
      </div>
    </div>

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../../bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- iCheck -->
    <script src="../../plugins/iCheck/icheck.min.js" type="text/javascript"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  
</body>
</html>