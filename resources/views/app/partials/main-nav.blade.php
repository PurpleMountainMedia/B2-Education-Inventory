<div class="main_menu_wrap" id="main_menu">
    <div class="main_menu_left">
        <main-menu>

            <template slot="logo" slot-scope="props">
                <div class="main_menu_logo">
                    <img src="/img/combined_logo.png">
                </div>
            </template>

            <template slot="links" slot-scope="props">
                <ul :class="props.showNav ? 'main_menu_nav' : 'main_menu_nav --hide'">
                    <li class="main_nav_link @if(Request::url() === route('web.dashboard.index'))--active @endif">
                        <a href="{{ route('web.dashboard.index') }}"><i class="fal fa-tachometer-alt fa-fw"></i> <span>Dashboard</span></a>
                    </li>

                    {{-- Buildings  --}}
                    @can ('list', App\Building::class)
                      <li class="main_nav_link @if(Request::url() === route('web.buildings.index'))--active @endif">
                        <a href="{{ route('web.buildings.index') }}"><i class="fal fa-building fa-fw"></i> <span>Buildings</span></a>
                      </li>
                    @endcan

                    {{-- Rooms  --}}
                    @can ('list', App\Room::class)
                      <li class="main_nav_link @if(Request::url() === route('web.rooms.index'))--active @endif">
                        <a href="{{ route('web.rooms.index') }}"><i class="fal fa-door-open fa-fw"></i> <span>Rooms</span></a>
                      </li>
                    @endcan

                    {{-- Items  --}}
                    @can ('list', App\Item::class)
                      <li class="main_nav_link @if(Request::url() === route('web.items.index'))--active @endif">
                        <a href="{{ route('web.items.index') }}"><i class="fal fa-laptop fa-fw"></i> <span>Items</span></a>
                      </li>
                    @endcan

                    {{-- Reports  --}}
                    @can ('list', App\Report::class)
                      <li class="main_nav_link @if(Request::url() === route('web.reports.index'))--active @endif">
                        <a href="{{ route('web.reports.index') }}"><i class="fal fa-chart-pie fa-fw"></i> <span>Reports</span></a>
                      </li>
                    @endcan
                </ul>
            </template>

            <template slot="user" slot-scope="props">
                <div :class="props.showNav ? 'main_menu_account' : 'main_menu_account --hide'">
                    <img src="http://via.placeholder.com/350x350" alt="{{ Auth::user()->name }}" class="account_img">
                    <a class="account_link" href="#">{{ Auth::user()->name }}</a>

                    <a class="account_logout" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        <i class="far fa-power-off"></i> {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>

                    <school-selecter :data='@json(Auth::User()->organisationsWithSchools())'
                                     csrf-token='{{ csrf_token() }}'
                                     selecter-placeholder='Switch Schools'
                                     selecter-size="small"
                                     form-url='{{ route('web.session') }}'>
                    </school-selecter>

                </div>
            </template>

            <template slot="button" slot-scope="props">
                <div class="mobile_nav_burger">
                    <i class="far fa-bars" @click="props.openMenu"></i>
                </div>
            </template>

        </main-menu>
    </div>
</div>
