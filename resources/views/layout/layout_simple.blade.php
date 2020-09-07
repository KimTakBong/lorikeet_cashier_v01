<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ $title }}</title>
  <!-- Bootstrap Core CSS -->
  <link href="{{asset('simple/css/bootstrap.css')}}" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="{{asset('simple/css/style.css')}}" rel="stylesheet">
  <style>
     #map {height: 600px;width: 100%;}
  </style>
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ route('public.index') }}">Lorikeet</a>
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="pull-right collapse navbar-collapse" id="bs-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a href="{{ route( 'public.homepage' ) }}">Website</a></li>
          <li><a href="{{ route( 'public.index' ) }}">Top Menu</a></li>
          <li><a href="{{ route( 'public.near' ) }}">Near Me!</a></li>
        </ul>
      </div>
      <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
  </nav>

  <div id="fb-root"></div>
  <script>
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.10&appId=262938984219431";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'),
  function(response){
      if(response && response.post_id) {
        self.location.href = 'SUCCESS_URL'
      }
    }
  );

  
  </script>

  <div class="fb-share-button" data-href="https://sultanahammam.com" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fsultanahammam.com%2F&amp;src=sdkpreparse">Share</a></div>

  @yield( 'content' )

  <div class="container">
      <hr>
      <!-- Footer -->
      <footer>
        <div class="row">
          <div class="col-lg-12">
              <p>Copyright &copy; Your Website 2014</p>
          </div>
        </div>
      </footer>
  </div>
  <!-- /.container -->

  <!-- jQuery -->
  <script src="{{asset('js/jquery.js')}}"></script>
  <!-- Bootstrap Core JavaScript -->
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <!-- Swipe on slider -->
  <script type="text/javascript">
  $(".carousel").on("touchstart", function(event){
          var xClick = event.originalEvent.touches[0].pageX;
      $(this).one("touchmove", function(event){
          var xMove = event.originalEvent.touches[0].pageX;
          if( Math.floor(xClick - xMove) > 5 ){
              $(this).carousel('next');
          }
          else if( Math.floor(xClick - xMove) < -5 ){
              $(this).carousel('prev');
          }
      });
      $(this).on("touchend", function(){
              $(this).off("touchmove");
      });
  });
  </script>

  @yield('script')
</body>

</html>


