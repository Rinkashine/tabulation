<nav class="side-nav">
    <div class="intro-x flex items-center pl-5 pt-4 mt-3">
        <img alt="Go Dental" class="w-10" src="{{asset('dist/images/MainLogo.png')}}" data-action="zoom">
        <span class="hidden xl:block text-white text-lg ml-3"> Sportfest 2023 </span>
    </div>
    <div class="side-nav__devider my-6"></div>
    <ul>
        <!--Begin: Dashboard-->
        <li>
            <a href="{{ route('dashboard.index') }}" class="side-menu {{ (request()->is('admin/dashboard')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-house p-1 fa-lg"></i> </div>
                <div class="side-menu__title"> Dashboard </div>
            </a>
        </li>
        <!-- End: Dashboard -->
        <!-- Begin: Teams -->
        <li>
            <a href="{{ route('teams.index') }}" class="side-menu {{ (request()->is('admin/teams')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-user-group p-1 fa-lg"></i></div>
                <div class="side-menu__title"> Teams </div>
            </a>
        </li>
        <!-- End: Teams -->

        <!-- Begin: Events -->
        <li>
            <a href="{{ route('events.index') }}" class="side-menu {{ (request()->is('admin/events')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-solid fa-calendar-week p-1 fa-lg"></i>  </div>
                <div class="side-menu__title"> Events </div>
            </a>
        </li>
        <!-- End: Events -->
        <!-- Begin: Events -->
        <li>
            <a href="{{ route('schedule.index') }}" class="side-menu {{ (request()->is('admin/schedule')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"> <i class="fa-regular fa-calendar p-1 fa-lg"></i> </div>
                <div class="side-menu__title"> Schedule </div>
            </a>
        </li>
        <!-- End: Events -->
        <!-- Begin: Pointing -->
        <li>
            <a href="{{ route('classification.index') }}" class="side-menu {{ (request()->is('admin/classification')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i class="fa-solid fa-table p-1 fa-lg"></i></div>
                <div class="side-menu__title"> Points </div>
            </a>
        </li>
        <!-- End: Pointing -->
         <!-- Begin: Tabulation -->
        <li>
            <a href="{{ route('tabulation.index') }}" class="side-menu {{ (request()->is('admin/tabulation')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i class="fa-solid fa-list p-1 fa-lg"></i></div>
                <div class="side-menu__title"> Tabulation </div>
            </a>
        </li>
        <!-- End: Tabulation -->
          <!-- Begin: Tabulation -->
          <li>
            <a href="{{ route('overall.index') }}" class="side-menu {{ (request()->is('admin/overall')) ? 'side-menu--active' : '' }}">
                <div class="side-menu__icon"><i class="fa-solid fa-earth-asia p-1 fa-lg"></i></div>
                <div class="side-menu__title"> Overall </div>
            </a>
        </li>
        <!-- End: Tabulation -->
    </ul>
</nav>
