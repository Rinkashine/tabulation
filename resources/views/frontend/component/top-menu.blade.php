<div class="top-bar-boxed border-b border-white/[0.08] -mt-7 md:mt-0 -mx-3 sm:-mx-8 md:mx-0 px-4 sm:px-8 md:px-6 mb-14 md:mb-8">
    <div class="h-full flex items-center">
        <!-- BEGIN: Logo -->
        <div href="" class="-intro-x hidden md:flex w-auto">
            <img alt="Go Dental Logo" class="w-12" src="{{asset('dist/images/MainLogo.png')}}" data-action="zoom">
        </div>

        <!-- END: Logo -->
        <nav aria-label="breadcrumb" class="-intro-x h-full mr-auto">
            <ol class="breadcrumb breadcrumb-light">
                <li class="breadcrumb-item w-20 "><p>Sportfest</p></li>
                <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
            </ol>
        </nav>
        <!-- BEGIN: Breadcrumb -->
        <nav class=" top-nav h-full mr-auto mt-2 w-1/2 sm:invisible xl:visible  ">
            <ul>
                <li>
                    <a href="{{ Route('home') }}" class="top-menu {{ (request()->is('/')) ? 'top-menu--active' : '' }}">
                        <div class="top-menu__title"> Overall</div>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('EventScore.show') }}" class="top-menu {{ (request()->is('EventScore')) ? 'top-menu--active' : '' }}">
                        <div class="top-menu__title"> Ranking By Event</div>
                    </a>
                </li>
                <li>
                    <a href="{{ Route('Schedules.show') }}" class="top-menu {{ (request()->is('Schedules')) ? 'top-menu--active' : '' }}">
                        <div class="top-menu__title"> Schedule</div>
                    </a>
                </li>


            </ul>
        </nav>
        <!-- END: Breadcrumb -->
    </div>
</div>
