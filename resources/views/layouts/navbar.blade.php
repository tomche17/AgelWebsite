<!--
    Helper classes

    Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
    Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
        If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

    Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
    Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
        - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
-->
<nav id="sidebar">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Side Header -->
        <div class="content-header content-header-fullrow px-15">
            <!-- Mini Mode -->
            <div class="content-header-section sidebar-mini-visible-b">
                <!-- Logo -->
                <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                    <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                </span>
                <!-- END Logo -->
            </div>
            <!-- END Mini Mode -->

            <!-- Normal Mode -->
            <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                <!-- Close Sidebar, Visible only on mobile screens -->
                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                    <i class="fa fa-times text-danger"></i>
                </button>
                <!-- END Close Sidebar -->

                <!-- Logo -->
                <div class="content-header-item">
                    <a class="link-effect font-w700" href="/">
                        <img src="{{ asset('images/agel.png') }}" style="width:75px;">
                    </a>
                </div>
                <!-- END Logo -->
            </div>
            <!-- END Normal Mode -->
        </div>
        <!-- END Side Header -->

        

        <!-- Side Navigation -->
        <div class="content-side content-side-full">
            <ul class="nav-main">
                <li>
                    <a class="{{ request()->is('dashboard') ? ' active' : '' }}" href="/home">
                        <i class="si si-cup"></i><span class="sidebar-mini-hide">E-Chapi</span>
                    </a>
                </li>

                <li class="nav-main-heading">
                    <span class="sidebar-mini-visible">VR</span><span class="sidebar-mini-hidden">Organisation</span>
                </li>
                @if (Auth::user() && Auth::user()->droit != 1)
                <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                    <a class="{{ request()->is('profile') ? ' active' : '' }}" href="/profile/{{ Auth::user()->id }}/edit"><i class="fa fa-user"></i><span class="sidebar-mini-hide">Profil</span></a>
                </li>
                @endif
                <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                    <a class="{{ request()->is('stock') ? ' active' : '' }}" href="/stock"><i class="fa fa-cubes"></i><span class="sidebar-mini-hide">Stock de la salle</span></a>
                </li>

                <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                    <a class="{{ request()->is('documents') ? ' active' : '' }}" href="/documents/index"><i class="fa fa-book"></i><span class="sidebar-mini-hide">Documents utiles</span></a>
                </li>
                <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                    <a class="{{ request()->is('contacts') ? ' active' : '' }}" href="/contacts"><i class="fa fa-phone"></i><span class="sidebar-mini-hide">Contacts</span></a>
                </li>
                @if (Auth::user() && Auth::user()->droit == 1)
                    <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                        <a class="{{ request()->is('listing') ? ' active' : '' }}" href="/admin/listing"><i class="fa fa-address-card"></i><span class="sidebar-mini-hide">Listing des CB</span></a>
                    </li>
                @else
                    <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                        <a class="{{ request()->is('listing') ? ' active' : '' }}" href="/listing"><i class="fa fa-address-card"></i><span class="sidebar-mini-hide">Listing de mon CB</span></a>
                    </li>
                @endif

                @if (Auth::user() && Auth::user()->droit == 1)
                    <li class="nav-main-heading">
                        <span class="sidebar-mini-visible">MR</span><span class="sidebar-mini-hidden">Administration</span>
                    </li>
                    <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                        <a class="nav-submenu {{ request()->is('inventaires') ? ' active' : '' }}" data-toggle="nav-submenu" href="#"><i class="fa fa-list"></i><span class="sidebar-mini-hide">Inventaires</span></a>
                        <ul>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('inventaires') ? ' active' : '' }}" href="/admin/inventaires"></i><span class="sidebar-mini-hide">Voir tous</span></a>
                        </li>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/admin/inventaires/create"></i><span class="sidebar-mini-hide">Créer</span></a>
                        </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                        <a class="nav-submenu {{ request()->is('factures') ? ' active' : '' }}" data-toggle="nav-submenu" href="#"><i class="fa fa-money"></i><span class="sidebar-mini-hide">Factures</span></a>
                        <ul>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('factures') ? ' active' : '' }}" href="/admin/factures"></i><span class="sidebar-mini-hide">Voir toutes</span></a>
                        </li>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/admin/factures/create"></i><span class="sidebar-mini-hide">Ajouter</span></a>
                        </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                        <a class="nav-submenu {{ request()->is('') ? ' active' : '' }}" data-toggle="nav-submenu" href="#"><i class="fa fa-cubes"></i><span class="sidebar-mini-hide">Stock</span></a>
                        <ul>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/stock"></i><span class="sidebar-mini-hide">Consulter</span></a>
                        </li>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/admin/stock/add"></i><span class="sidebar-mini-hide">Ajouter</span></a>
                        </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            @php
                                $nb = \App\Commande::where('is_validated', 0)->count();
                            @endphp
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-beer"></i><span class="sidebar-mini-hide">Commandes 
                            @if ($nb > 0)
                                    <span class="badge">{{$nb}}
                                    </span>
                                @endif
                        </span></a>
                        <ul>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a href="/admin/commandes/waiting"><span class="sidebar-mini-hide">
                                En attente
                                @if ($nb > 0)
                                    <span class="badge">{{$nb}}
                                    </span>
                                @endif
                            </span></a>
                        </li>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/admin/commandes/confirmed"></i><span class="sidebar-mini-hide">Confirmées</span></a>
                        </li>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/commandes/create"></i><span class="sidebar-mini-hide">Nouvelle</span></a>
                        </li>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/admin/futs"></i><span class="sidebar-mini-hide">Liste des fûts</span></a>
                        </li>
                        <!--<li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/admin/materiel"></i><span class="sidebar-mini-hide">Liste du matos</span></a>
                        </li>-->
                        </ul>
                    </li>
                    <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                    @php
                                $nb_event = \App\Event::where('is_validated', 0)->count();
                            @endphp
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-calendar"></i><span class="sidebar-mini-hide">Evénements
                        @if ($nb_event > 0)
                                    <span class="badge">{{$nb_event}}
                                    </span>
                                @endif
                        </span></a>

                        <ul>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a href="/admin/events/waiting"><span class="sidebar-mini-hide">
                                En attente
                                @if ($nb_event > 0)
                                    <span class="badge">{{$nb_event}}
                                    </span>
                                @endif
                            </span></a>
                        </li>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/events"></i><span class="sidebar-mini-hide">Confirmés</span></a>
                        </li>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/events/add"></i><span class="sidebar-mini-hide">Ajouter</span></a>
                        </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-users"></i><span class="sidebar-mini-hide">Utilisateurs</span></a>
                        <ul>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/admin/users"></i><span class="sidebar-mini-hide">Consulter</span></a>
                        </li>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/admin/user/add"></i><span class="sidebar-mini-hide">Ajouter</span></a>
                        </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-main-heading">
                        <span class="sidebar-mini-visible">MR</span><span class="sidebar-mini-hidden">Mon espace</span>
                    </li>
                    <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                        <a class="{{ request()->is('') ? ' active' : '' }}" href="/inventaires"><i class="fa fa-list"></i><span class="sidebar-mini-hide">Mes inventaires</span></a>
                    </li>
                    <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-beer"></i><span class="sidebar-mini-hide">Mes commandes</span></a>
                        <ul>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/commandes/create"></i><span class="sidebar-mini-hide">Nouvelle</span></a>
                        </li>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/commandes"></i><span class="sidebar-mini-hide">Passées</span></a>
                        </li>
                        </ul>
                    </li>
                    <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-calendar"></i><span class="sidebar-mini-hide">Mes événements</span></a>
                        <ul>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/events/add"></i><span class="sidebar-mini-hide">Ajouter</span></a>
                        </li>
                        <li class="{{ request()->is('pages/*') ? ' open' : '' }}">
                            <a class="{{ request()->is('') ? ' active' : '' }}" href="/events"></i><span class="sidebar-mini-hide">Consulter</span></a>
                        </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
        <!-- END Side Navigation -->
    </div>
    <!-- Sidebar Content -->
</nav>
