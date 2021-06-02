<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
    <a class="navbar-brand brand-logo mr-5" href="#"><img src="{{ asset('template/images/logo.svg') }} " class="mr-2" alt="logo"/></a>
    <a class="navbar-brand brand-logo-mini" href="#"><img src="{{ asset('template/images/logo-mini.svg') }} " alt="logo"/></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
      <span class="icon-menu"></span>
    </button>
    <ul class="navbar-nav mr-lg-2">
      <li class="nav-item nav-search d-none d-lg-block">
        <div class="input-group">
          <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
            <span class="input-group-text" id="search">
              <i class="icon-search"></i>
            </span>
          </div>
          <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
        </div>
      </li>
    </ul>
    
    
    <ul class="navbar-nav navbar-nav-right">
    <!-- <li>
      <li class="nav-item submenu dropdown">
        <a class="dropdown-item nav-link"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">
          Logout
        </a>
        <form id="logout-form"  action="/admin/logout" method="GET" style="display: none;">
          @csrf
        </form>
      </li>
    </li> -->
    <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </li>

              <li class="nav-item dropdown">
              <?php 
                  								$id = 1;
                  								$admin = App\Admin::find(1);
                  								$notif_count = $admin->unreadNotifications->count();
                  								$notifications = DB::table('admin_notifications')->where('notifiable_id',$id)->where('read_at',NULL)->orderBy('created_at','desc')->get();
                						?>
        <a href="#" class="nav-link count-indicator dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="icon-bell mx-0"></i>
        <span class="badge badge-pill badge-danger">{{$notif_count}}</span></a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
          <p class="mb-0 font-weight-normal float-left dropdown-header">You have {{$notif_count}} new notifications</p>
              <h5 class="preview-subject font-weight-normal">@foreach($notifications as $notif)
													{!!$notif->data!!}
											  	@endforeach</h5>
												<div class="notification_bottom">
													<a class="btn btn-block" href="/admin/marknotifadmin">Mark as Read</a>
												</div> 
        </div>
  </div>
</nav>