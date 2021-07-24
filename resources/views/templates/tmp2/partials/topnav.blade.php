<!--Start topbar header-->
<header class="topbar-nav">
    <nav class="navbar navbar-expand fixed-top">
     <ul class="navbar-nav mr-auto align-items-center">
       <li class="nav-item">
         <a class="nav-link toggle-menu" href="javascript:void();">
          <i class="icon-menu menu-icon"></i>
        </a>
       </li>
       <li class="nav-item">
         <form class="search-bar" onsubmit="return false;">
           <input type="search" name="navbar_search" id="navbar_search" class="form-control" placeholder="Enter keywords">
            <a href="javascript:void();"><i class="icon-magnifier"></i></a>
            <div id="navbar_search_result_area">
              <ul class="navbar_search_result"></ul>
          </div>
         </form>
       </li>
     </ul>
        
     <ul class="navbar-nav align-items-center right-nav-link">
       <li class="nav-item">
        @php 
                
        $image="";
        
        if(Auth::user()->image) {
        $image= Auth::user()->image;
        
        }
        @endphp
         <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
           <span class="user-profile"><img src="{{ get_image(config('constants.user.profile.path') .'/'.$image) }}" class="img-circle" alt="user avatar"></span>
         </a>
         <ul class="dropdown-menu dropdown-menu-right">
          <li class="dropdown-item user-details">
           <a href="javaScript:void();">
              <div class="media">
                <div class="avatar"><img class="align-self-start mr-3" src="{{ get_image(config('constants.user.profile.path') .'/'.$image) }}" alt="user avatar"></div>
               <div class="media-body">
               <h6 class="mt-2 user-title">{{ Auth::user()->name }}</h6>
               <p class="user-subtitle">{{ Auth::user()->email }}</p>
               </div>
              </div>
             </a>
           </li>
           <li class="dropdown-divider"></li>
           <a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fa fa-user"></i> @lang('Profile')</a>
           <li class="dropdown-divider"></li>
           <li class="dropdown-item"><a href="{{ route('user.logout') }}"><i class="icon-power mr-2"></i>@lang('Logout')</a></li>
         </ul>
       </li>
     </ul>
   </nav>
   </header>
   <!--End topbar header-->