<!-- Logo -->
<a href="" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><img src="{{ asset('icon.png') }}" class="img-responsive"></span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><img src="{{ asset('logo-color.png') }}" class="img-responsive"></span>
</a>

<nav class="navbar navbar-static-top" role="navigation">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- User Account: style can be found in dropdown.less -->
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          @if( \Auth::user()->avatar != null )
          <img src="{{ asset(\Auth::user()->avatar) }}" class="user-image" alt="User Image">
          @else
          <img src="{{ asset( 'no-image.png' ) }}" class="user-image" alt="User Image">
          @endif
          <span class="hidden-xs">{{ \Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            @if( \Auth::user()->avatar != null )
            <img src="{{ asset(\Auth::user()->avatar) }}" class="img-circle" alt="User Image">
            @else
            <img src="{{ asset( 'no-image.png' ) }}" class="img-circle" alt="User Image">
            @endif
            <p>
              {{ \Auth::user()->name }}
              <?php 
                $since = explode('-', \Auth::user()->created_at);
                switch ($since[1]) {
                  case "01":
                    $month = "Jan";
                    break;
                  case "02":
                    $month = "Feb";
                    break;
                  case "03":
                    $month = "Mar";
                    break;
                  case "04":
                    $month = "Apr";
                    break;
                  case "05":
                    $month = "May";
                    break;
                  case "06":
                    $month = "Jun";
                    break;
                  case "07":
                    $month = "Jul";
                    break;
                  case "08":
                    $month = "Aug";
                    break;
                  case "09":
                    $month = "Sep";
                    break;
                  case "10":
                    $month = "Oct";
                    break;
                  case "11":
                    $month = "Nov";
                    break;
                  case "12":
                    $month = "Dec";
                    break;
                  default:
                    $month = "";
                    break;
                } 
              ?>
              <small>Member since {{ $month.'. '.$since[0] }}</small>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="{{ url('auth/logout') }}" class="btn btn-default btn-flat">Sign out</a>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->
      <li>
        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
      </li>
    </ul>
  </div>

</nav>