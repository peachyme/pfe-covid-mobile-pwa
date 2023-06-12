<nav class="navbar navbar-expand  sticky-top mb-0">
    <div class="mx-2 mr-0 position-absolute end-0">
        <img src="/images/logoo.png" height="20px" width="20px">
    </div>
    <div class=" text-light nav-text fw-bold mx-2">

        @switch(request()->path())

        @case('home')
        Accueil
        @break

        @case('dashboard')
        Tableau de bord
        @break

        @case('profile')
        Profile
        @break

        @case('notifications')
        Notifications
        @break

        @case('parametres')
        Paramètres du compte
        @break

        @case(str_contains(request()->path(), 'edit') && str_contains(request()->path(), 'parametres'))
        Modifier mot de passe
        @break

        @case(str_contains(request()->path(), 'protocole'))
        Protocole sanitaire
        @break

        @case('password/confirm')
        Confirmer mot de passe
        @break

        @case(str_contains(request()->path(), 'consultations'))
        Consultations
        @break

        @case('vaccination')
        Vaccinations
        @break

        @endswitch

    </div>
</nav>

<nav class="navbar navbar-expand fixed-bottom">
    <div class="container-fluid">
        <ul class="navbar-nav  nav-justified w-100" id="navbar">
            <li class="nav-item {{ 'home' == request()->path() ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fa-solid fa-house"></i>
                </a>
            </li>

            <li class="nav-item {{ 'dashboard' == request()->path() ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('dashboard.index') }}">
                    <i class="fa-solid fa-chart-simple"></i>
                </a>
            </li>

            <li class="nav-item {{ 'notifications' == request()->path() || 
                str_contains(request()->path(), 'protocole') ? 'active' : '' }}">
                <a class="nav-link " href="{{ route('notifications.index') }}">
                    <i class="fa-solid fa-bell position-relative">
                        @if(auth()->user()->unreadNotifications->count() != 0)
                        <div id="notification-number" role="status">
                            {{auth()->user()->unreadNotifications->count()}}
                        </div>
                        @endif
                    </i>

                </a>
            </li>


            <li class="nav-item {{ 'profile' == request()->path() || 'vaccination' == request()->path() 
                || str_contains(request()->path(), 'parametres') || 'password/confirm' == request()->path() 
                || str_contains(request()->path(), 'consultations') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('profile.index') }}">
                    <i class="fa-solid fa-user"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>