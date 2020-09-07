<?php 
  $role   = json_decode(\Auth::user()->usergroup->access_right);
  $alias  = \Route::currentRouteName();
  // dd($alias);
?>
  
<section class="sidebar" style="height: auto;">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
    @if( \Auth::user()->avatar != null )
      <img src="{{ asset(\Auth::user()->avatar) }}" class="img-circle" alt="User Image">
    @else
      <img src="{{ asset( 'no-image.png' ) }}" class="img-circle" alt="User Image">
    @endif
    </div>
    <div class="pull-left info">
      <p>{{ \Auth::user()->name }}</p>
    </div>
  </div>
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">

    <li @if( $alias == 'system.index' ) class="active" @endif>
      <a href="{{ route('system.index') }}">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>

    @if( \Auth::user()->group_id == 1 )
    <li @if( $alias == 'uacl.group.index' || $alias == 'uacl.user.index' ) class="active treeview" @else class="treeview" @endif>
      <a href="#">
        <i class="fa fa-gears"></i> <span>UACL</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        @if( $role->group->r == true )
        <li @if( $alias == 'uacl.group.index' ) class="active" @endif><a href="{{ route( 'uacl.group.index' ) }}"><i class="fa fa-users"></i> Usergroups</a></li>
        @endif
        @if( $role->user->r == true )
        <li @if( $alias == 'uacl.user.index' ) class="active" @endif><a href="{{ route( 'uacl.user.index' ) }}"><i class="fa fa-user"></i> Users</a></li>
        @endif
      </ul>
    </li>
    @endif


    @if( \Auth::user()->group_id == 1 || \Auth::user()->group_id == 2 )
    <li @if($alias == 'product.transaction' || $alias == 'product.stock' || $alias == 'service.index' ) class="active" @endif>
      <a href="#">
        <i class="fa fa-money"></i> <span>Selling</span> <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">
        <li @if($alias == 'product.transaction') class="active" @endif><a href="{{ route( 'product.transaction' ) }}"><i class="fa fa-credit-card"></i> Transaction</a></li>
        <li @if($alias == 'product.stock') class="active" @endif><a href="{{ route( 'product.stock' ) }}"><i class="fa fa-plus"></i> Product Management</a></li>
        <!-- <li @if($alias == 'service.index') class="active" @endif><a href="{{ route( 'service.index' ) }}"><i class="fa fa-plus"></i> Service Management</a></li> -->
      </ul>
    </li>

    <!-- <li @if($alias == 'kredit.index') class="active" @endif>
      <a href="{{ route( 'kredit.index' ) }}">
        <i class="fa fa-credit-card"></i> <span>Kredit</span>
      </a>
    </li> -->

    <li @if($alias == 'cost.index') class="active" @endif>
      <a href="{{ route( 'cost.index' ) }}">
        <i class="fa fa-dollar"></i> <span>Pengeluaran</span>
      </a>
    </li>

    <li @if($alias == 'laporan.index') class="active" @endif>
      <a href="{{ route( 'laporan.index' ) }}">
        <i class="fa fa-area-chart"></i> <span>Laporan</span>
      </a>
    </li>

    @endif

  </ul>
</section>