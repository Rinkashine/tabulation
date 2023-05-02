<div class="mobile-menu md:hidden">
    <div class="mobile-menu-bar">
        <div  class="flex mr-auto">
            <img alt="Go Dental Logo" class="w-12" src="{{asset('dist/images/MainLogo.png')}}" data-action="zoom">
        </div>
        <a href="javascript:;" id="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
    </div>
    <ul class="border-t border-white/[0.08] py-5 hidden">
        <!-- -->
        <li>
            <a href="{{ route('dashboard.index') }}" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-house"></i> </div>
                <div class="menu__title"> Dashboard  </div>
            </a>
        </li>
        <li>
            <a href="{{ Route('teams.index') }}" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-user-group"></i> </div>
                <div class="menu__title"> Teams  </div>
            </a>
        </li>
        <li>
            <a href="{{ Route('events.index') }}" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-calendar-week"></i> </div>
                <div class="menu__title"> Events  </div>
            </a>
        </li>
        <li>
            <a href="{{ Route('schedule.index') }}" class="menu">
                <div class="menu__icon"> <i class="fa-regular fa-calendar   "></i>  </div>
                <div class="menu__title"> Schedule  </div>
            </a>
        </li>
        <li>
            <a href="{{ Route('classification.index') }}" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-table"></i> </div>
                <div class="menu__title"> Points  </div>
            </a>
        </li>
        <li>
            <a href="{{ Route('tabulation.index') }}" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-list"></i> </div>
                <div class="menu__title"> Tabulation  </div>
            </a>
        </li>
        <li>
            <a href="{{ Route('overall.index') }}" class="menu">
                <div class="menu__icon"> <i class="fa-solid fa-earth-asia"></i> </div>
                <div class="menu__title"> Overall  </div>
            </a>
        </li>


    </ul>
</div>
