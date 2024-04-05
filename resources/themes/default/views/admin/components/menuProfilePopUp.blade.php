<div class="nk-sidebar-profile nk-sidebar-profile-fixed">
    <a href="#" class="toggle" data-target="profileDD">
        <div class="user-avatar">
            <span>{{ substr(auth()->user()->name, 0, 2) }}</span>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-md m-1 nk-sidebar-profile-dropdown" data-content="profileDD">
        <div class="dropdown-inner user-card-wrap d-none d-md-block">
            <div class="user-card">
                <div class="user-avatar">
                    <span>AB</span>
                </div>
                <div class="user-info">
                    <span class="lead-text">{{ auth()->user()->name }}</span>
                    <span class="sub-text text-soft">{{ auth()->user()->email }}</span>
                </div>
            </div>
        </div>
        <div class="dropdown-inner">
            <ul class="link-list">
                {{--
                <li><a href="html/user-profile-regular.html"><em class="icon ni ni-user-alt"></em><span>View Profile</span></a></li>
                <li><a href="html/user-profile-setting.html"><em class="icon ni ni-setting-alt"></em><span>Account Setting</span></a></li>
                <li><a href="html/user-profile-activity.html"><em class="icon ni ni-activity-alt"></em><span>Login Activity</span></a></li>
                --}}
            </ul>
        </div>
        <div class="dropdown-inner">
            <ul class="link-list">
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-primary" type="submit"><em class="icon ni ni-signout"></em><span>Sign out</span></button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>