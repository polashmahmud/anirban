<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div>
                @if( ! \Illuminate\Support\Facades\Auth::user()->getFirstMediaUrl('avatar', 'small'))
                    <img src="/img/blank-profile.jpg" alt="" />
                @else
                    <img src="{{ asset(\Illuminate\Support\Facades\Auth::user()->getFirstMediaUrl('avatar', 'small')) }}" alt="" width="45px" />
                @endif
            </div>
            <div class="admin-info">
                <div class="font-strong">{{ \Illuminate\Support\Facades\Auth::user()->name }}</div><small>TK: 1575</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{ route('dashboard') }}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">ডেসবোর্ড</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>
            <li>
                <a class="active" href="{{ route('user.index') }}"><i class="sidebar-item-icon fa fa-users"></i>
                    <span class="nav-label">সদস্য সমূহ</span>
                </a>
            </li>
            <li>
                <a class="active" href="money.html"><i class="sidebar-item-icon fa fa-money"></i>
                    <span class="nav-label">জমা</span>
                </a>
            </li>
            <li>
                <a class="active" href="package.html"><i class="sidebar-item-icon fa fa-cubes"></i>
                    <span class="nav-label">প্যাকেজ</span>
                </a>
            </li>
            <li>
                <a class="active" href="debit-credit.html"><i class="sidebar-item-icon fa fa-bookmark-o"></i>
                    <span class="nav-label">জমা/খরচ</span>
                </a>
            </li>
        </ul>
    </div>
</nav>