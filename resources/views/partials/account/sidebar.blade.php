<nav class="bg-white sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light" id="sidenav-main" style="z-index: 1001;">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header d-flex align-items-center">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('saas/img/logo_1.png') }}" class="navbar-brand-img" alt="knine"
                    style="max-height: 4rem;padding-left: 0px;">
            </a>
            <div class="ml-auto">
                <!-- Sidenav toggler -->
                <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ return_if(on_page('/dashboard'), ' active') }}" href="/dashboard">
                            <i class="fas fa-tachometer-alt"></i>
                            <span class="nav-link-text">{{ __('Dashboard') }}</span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ return_if(on_page('profile.show') or on_page('account.security') or on_page('account.preference') or on_page('account.social') or on_page('account.activity'), ' active') }}"
                            href="#navbar-components" data-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="navbar-components">
                            <i class="fas fa-user-shield" aria-hidden="true"></i>
                            <span class="nav-link-text">{{ __('Account') }}</span>
                        </a>
                        <!-- Subscription Links -->
                        <div class="collapse" id="navbar-components">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('profile.show'), ' active') }}"
                                        href="{{ route('profile.show') }}"><i
                                            class="fas fa-user u-sidebar-nav-menu__item-icon"></i>
                                        {{ __('Account') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('account.security'), ' active') }}"
                                        href="{{ route('account.security') }}"><i
                                            class="fas fa-user-lock u-sidebar-nav-menu__item-icon"></i>
                                        {{ __('Security') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('account.preference'), ' active') }}"
                                        href="{{ route('account.preference') }}"><i
                                            class="fas fa-user-cog u-sidebar-nav-menu__item-icon"></i>
                                        {{ __('Preferences') }}
                                    </a>
                                </li>
                                @if (JoelButcher\Socialstream\Socialstream::show())
                                    <li class="nav-item">
                                        <a class="nav-link{{ return_if(on_page('account.social'), ' active') }}"
                                            href="{{ route('account.social') }}"><i
                                                class="fas fa-user-secret u-sidebar-nav-menu__item-icon"></i>
                                            {{ __('Social account') }}
                                        </a>
                                    </li>
                                @endif
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('account.activity'), ' active') }}"
                                        href="{{ route('account.activity') }}"><i
                                            class="fas fa-user-times u-sidebar-nav-menu__item-icon"></i>
                                        {{ __('Activity') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ return_if(on_page('account.subscriptions') or on_page('account.subscriptions.card') or on_page('account.subscriptions.invoices') or on_page('subscription.plans'), ' active') }}"
                            href="#navbar-plans" data-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="navbar-forms">
                            <i class="fas fa-money-check-alt u-sidebar-nav-menu__item-icon"></i>
                            <span class="nav-link-text">{{ __('Billing') }}</span>
                        </a>
                        <div class="collapse" id="navbar-plans">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ return_if(on_page('account.subscriptions'), ' active') }}"
                                        href="{{ route('account.subscriptions') }}"><i class="fas fa-bell nav-icon"></i>
                                        {{ __('Subscriptions') }}
                                    </a>
                                </li>
                                @if (subscribed())
                                    <li class="nav-item">
                                        <a class="nav-link {{ return_if(on_page('account.subscriptions.card'), ' active') }}"
                                            href="{{ route('account.subscriptions.card') }}">
                                            <i class="fab fab fa-amazon-pay u-sidebar-nav-menu__item-icon"></i>
                                            {{ __('Payment') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('account.subscriptions.invoices') }}"
                                            class="nav-link {{ return_if(on_page('account.subscriptions.invoices'), ' active') }}">
                                            <i class="fas fa-broadcast-tower u-sidebar-nav-menu__item-icon"></i>
                                            {{ __('Invoices') }}
                                        </a>
                                    </li>
                                @endif
                                @if (! subscribed())
                                    <li class="nav-item">
                                        <a href="{{ route('subscription.plans') }}"
                                            class="nav-link {{ return_if(on_page('subscription.plans'), ' active') }}">
                                            <i class="fas fa-chart-line u-sidebar-nav-menu__item-icon"></i>
                                            {{ __('Plans') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>

                    @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                        <li class="nav-item">
                            <a class="nav-link {{ return_if(on_page('teams.show') or on_page('teams.create'), ' active') }}"
                                href="#navbar-teams" data-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="navbar-forms">
                                <i class="fas far fa-handshake nav-icon"></i>
                                <span class="nav-link-text">{{ __('Team Management') }}</span>
                            </a>
                            <div class="collapse" id="navbar-teams">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link {{ return_if(on_page('teams.show'), ' active') }}"
                                            href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                            <i class="fas fa-user-friends nav-icon"></i>
                                            {{ __('Team Settings') }}
                                        </a>
                                    </li>
                                    @if(subscribed())
                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <li class="nav-item">
                                            <a class="nav-link {{ return_if(on_page('teams.create'), ' active') }}"
                                                href="{{ route('teams.create') }}">
                                                <i class="fas fa-user-plus nav-icon"></i>
                                                {{ __('Create New Team') }}
                                            </a>
                                        </li>
                                    @endcan
                                    @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                    <!-- End List -->

                    @if(subscribed())
                    <li class="nav-item">
                        <a class="nav-link{{ return_if(on_page('ticket.index') or on_page('ticket.create'), ' active') }}"
                            href="#navbar-tickets" data-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="navbar-forms">
                            <i class="far fa-file-alt"></i>
                            <span class="nav-link-text">{{ __('Ticket') }}</span>
                        </a>
                        <div class="collapse" id="navbar-tickets">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('ticket.index'), ' active') }}"
                                        href="{{ route('ticket.index') }}">
                                        <i class="fas fa-hand-holding-usd"></i>
                                        {{ __('Support') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('ticket.create'), ' active') }}"
                                        href="{{ route('ticket.create') }}">
                                        <i class="far fa-plus-square"></i>
                                        {{ __('New ticket') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link{{ return_if(on_page('gmail.inbox') or on_page('leads.inbox'), ' active') }}"
                            href="#navbar-leads" data-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="navbar-forms">
                            <i class="far fa-address-card"></i>
                            <span class="nav-link-text">{{ __('Leads') }}</span>
                        </a>
                        <div class="collapse" id="navbar-leads">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('leads.inbox'), ' active') }}"
                                        href="{{ route('leads.inbox') }}">
                                        <i class="fas fa-desktop"></i>
                                        {{ __('Leads List') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('gmail.inbox'), ' active') }}"
                                        href="{{ route('gmail.inbox', 1) }}">
                                        <i class="fas fa-envelope"></i>
                                        {{ __('Gmail Inbox') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('leads.inbox'), ' active') }}"
                                        href="{{ route('leads.inbox') }}">
                                        <i class="fas fa-cog"></i>
                                        {{ __('Lead Scan Settings') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('leads.action'), ' active') }}"
                                        href="{{ route('leads.action') }}">
                                        <i class="fas fa-list"></i>
                                        {{ __('Lead Action Engine') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endif

                    @role('Owner')
                    <li class="nav-item">
                        <a class="nav-link{{ return_if(on_page('websites.compose') or on_page('leads.inbox'), ' active') }}"
                            href="#navbar-websites" data-toggle="collapse" role="button" aria-expanded="false"
                            aria-controls="navbar-forms">
                            <i class="far fa-images"></i>
                            <span class="nav-link-text">{{ __('WebSites') }}</span>
                        </a>
                        <div class="collapse" id="navbar-websites">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('websites.compose'), ' active') }}"
                                        href="{{ route('websites.compose') }}">
                                        <i class="far fa-share-square"></i>
                                        {{ __('Page Manage') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('websites.menu'), ' active') }}"
                                        href="{{ route('websites.menu') }}">
                                        <i class="fa fa-bars"></i>
                                        {{ __('Menu Manage') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link{{ return_if(on_page('websites.seo'), ' active') }}"
                                        href="{{ route('websites.seo') }}">
                                        <i class="fa fa-search"></i>
                                        {{ __('SEO Manage') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @endrole

                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="https://Saasify.creatydev.com/docs/1.0/overview">
                            <i class="far fa-newspaper"></i>
                            <span class="nav-link-text">{{ __('Help') }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>