<nav class="navbar navbar-expand-lg bg-body-secondary navbar-expand-md">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <x-public.navlink_link :href="route('Home_Page')" class="nav-link fw-bold"
                                       :active="request()->routeIs('Home_Page')">Home
                </x-public.navlink_link>
                <x-public.navlink_link :href="route('film.index')" class="nav-link fw-bold"
                                       :active="request()->routeIs('film.index')">Film List
                </x-public.navlink_link>
            </ul>
            <ul class="navbar-nav ms-auto mb-lg-0">
                @auth
                    <x-public.navlink_link :href="route('dashboard')" class="nav-link fw-bold"
                                           :active="request()->routeIs('dashboard')">Dashboard
                    </x-public.navlink_link>
                @else
                    <x-public.navlink_link :href="route('login')" class="nav-link fw-bold"
                                           :active="request()->routeIs('login')">Login
                    </x-public.navlink_link>
                    @if (Route::has('register'))
                        <x-public.navlink_link :href="route('register')" class="nav-link fw-bold"
                                               :active="request()->routeIs('register')">Register
                        </x-public.navlink_link>
                    @endif
                @endauth
            </ul>
        </div>
    </div>
</nav>

