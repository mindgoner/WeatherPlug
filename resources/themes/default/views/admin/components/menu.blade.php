<div class="nk-sidebar" data-content="sidebarMenu">
    <div class="nk-sidebar-bar">
        <div class="nk-apps-brand">
            <a href="html/index.html" class="logo-link">
                <img class="logo-light logo-img" src="/themes/{{ env('APP_THEME') }}/assets/images/logo-small.png" srcset="/themes/{{ env('APP_THEME') }}/assets/images/logo-small2x.png 2x" alt="logo">
                <img class="logo-dark logo-img" src="/themes/{{ env('APP_THEME') }}/assets/images/logo-dark-small.png" srcset="/themes/{{ env('APP_THEME') }}/assets/images/logo-dark-small2x.png 2x" alt="logo-dark">
            </a>
        </div>
        <div class="nk-sidebar-element">
            <div class="nk-sidebar-body">
                <div class="nk-sidebar-content" data-simplebar>
                    <div class="nk-sidebar-menu">
                        <!-- Menu -->
                        <ul class="nk-menu apps-menu">

                            @php
                                $menus = config('menu');
                            @endphp

                            @foreach($menus as $key => $menu)
                                <li class="nk-menu-item">
                                    <a href="#" class="nk-menu-link nk-menu-switch" data-target="nav{{ $key }}">
                                        <span class="nk-menu-icon">{!! $menu['icon'] !!}</span>
                                    </a>
                                </li>
                            @endforeach
                            {{--
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-switch" data-target="navPharmacy">
                                    <span class="nk-menu-icon"><em class="icon ni ni-capsule"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-switch" data-target="navHospital">
                                    <span class="nk-menu-icon"><em class="icon ni ni-plus-medi"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item active">
                                <a href="#" class="nk-menu-link nk-menu-switch" data-target="navDashboards">
                                    <span class="nk-menu-icon"><em class="icon ni ni-dashboard"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-switch" data-target="navApps">
                                    <span class="nk-menu-icon"><em class="icon ni ni-menu-circled"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-switch" data-target="navPages">
                                    <span class="nk-menu-icon"><em class="icon ni ni-files"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-switch" data-target="navMisc">
                                    <span class="nk-menu-icon"><em class="icon ni ni-server"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-switch" data-target="navError">
                                    <span class="nk-menu-icon"><em class="icon ni ni-alert-c"></em></span>
                                </a>
                            </li>
                            <li class="nk-menu-hr"></li>
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link nk-menu-switch" data-target="navComponents">
                                    <span class="nk-menu-icon"><em class="icon ni ni-layers"></em></span>
                                </a>
                            </li>
                            --}}
                        </ul>
                    </div>
                    <div class="nk-sidebar-footer">
                        <ul class="nk-menu nk-menu-md apps-menu">
                            <li class="nk-menu-item">
                                <a href="#" class="nk-menu-link" title="Settings">
                                    <span class="nk-menu-icon"><em class="icon ni ni-setting"></em></span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                @include('admin.components.menuProfilePopUp')
            </div>
        </div>
    </div>
    <div class="nk-sidebar-main is-light">
        <div class="nk-sidebar-inner" data-simplebar>
            
            @foreach($menus as $key => $menu)
                <div class="nk-menu-content" data-content="nav{{ $key }}">
                    <h5 class="title">{{ $menu['title'] }}</h5>
                    <ul class="nk-menu">

                        @foreach($menu['children'] as $submenu)
                            @if($submenu['type'] == "item")
                                <li class="nk-menu-item">
                                    <a href="{{ route($submenu['route']) }}" class="nk-menu-link">
                                        <span class="nk-menu-icon">{!! $submenu['icon'] !!}</span>
                                        <span class="nk-menu-text">{{ $submenu['title'] }}</span>
                                    </a>
                                </li>
                            @elseif($submenu['type'] == "group")
                                <li class="nk-menu-item has-sub">
                                    <a href="#" class="nk-menu-link nk-menu-toggle">
                                        <span class="nk-menu-icon">{!! $submenu['icon'] !!}</span>
                                        <span class="nk-menu-text">{{ $submenu['title'] }}</span>
                                    </a>
                                    <ul class="nk-menu-sub">
                                        @foreach($submenu['group'] as $child)
                                            <li class="nk-menu-item">
                                                <a href="{{ route($child['route']) }}" class="nk-menu-link"><span class="nk-menu-text">{{ $child['title'] }}</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endforeach
                        <!-- .nk-menu-item -->

                    </ul><!-- .nk-menu -->
                </div>
            @endforeach

        </div>
    </div>
</div>