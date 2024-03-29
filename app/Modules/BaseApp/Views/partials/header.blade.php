<!-- BEGIN: Header-->
<nav id="header" class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
    <div class="navbar-container d-flex content">
        <div class="bookmark-wrapper d-flex align-items-center">
            <ul class="nav navbar-nav d-xl-none">
                <li class="nav-item">
                    <a class="nav-link menu-toggle" href="javascript:void(0);">
                        <i class="ficon" data-feather="menu"></i>
                    </a>
                </li>
            </ul>
            <ul class="nav navbar-nav bookmark-icons">
                <li class="nav-item d-none d-lg-block">
                    <a class="nav-link nav-link-style">
                        <i class="ficon" data-feather="moon"></i>
                    </a>
                </li>
                <search-component :user="{{ auth()->user() }}"></search-component>
            </ul>
        </div>
        <ul class="nav navbar-nav align-items-center ml-auto">
            @include('BaseApp::partials.langSwitch')
            @if(is_user())
            <li class="nav-item dropdown-money mr-25">
                <a class="nav-link" data-toggle="dropdown" href="">
                    <i class="ficon" data-feather="dollar-sign"></i><span
                        class="badge badge-pill badge-primary badge-up cart-item-count">{{auth()->user()->available_balance}}</span></a>
            </li>
            <cart-component :user="{{ auth()->user() }}"></cart-component>
            @endif
            <notification-component :user="{{ auth()->user() }}"></notification-component>
            <li class="nav-item dropdown dropdown-user">
                <a aria-expanded="false"
                   aria-haspopup="true"
                   class="nav-link dropdown-toggle dropdown-user-link"
                   data-toggle="dropdown" href="javascript:void(0);"
                   id="dropdown-user">
                    <div class="user-nav d-sm-flex d-none">
                        <span class="user-name font-weight-bolder">{{auth()->user()->name}}</span>
                        <span class="user-status">{{trans('user.'.auth()->user()->type)}}</span>
                    </div>
                    <span class="avatar">
                    <img alt="avatar" class="round" height="40"
                         src="{{profile_picture()}}" width="40">
                    <span class="avatar-status-online"></span>
                </span>
                </a>
                <div aria-labelledby="dropdown-user" class="dropdown-menu dropdown-menu-right">
                    @if(is_user())
                    <a class="dropdown-item" href="{{route('profile.index')}}">
                        <i class="mr-50" data-feather="user"></i> {{trans('app.profile')}}</a>
                    @endif
                        <a class="dropdown-item" href="/profile/edit">
                            <i class="mr-50" data-feather="settings"></i> {{trans('navigation.account settings')}}
                        </a>
                        <a class="dropdown-item" href="{{route('logout')}}">
                        <i class="mr-50" data-feather="power"></i> {{trans('app.logout')}}
                        </a>
                </div>
            </li>
        </ul>
    </div>
</nav>
<ul class="main-search-list-defaultlist d-none">
    <li class="d-flex align-items-center"><a href="javascript:void(0);">
            <h6 class="section-label mt-75 mb-0">Files</h6></a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                                   href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75"><img alt="png" height="32" src="/images/icons/xls.png"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing
                        Manager</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;17kb</small></a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                                   href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75"><img alt="png" height="32" src="/images/icons/jpg.png"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd
                        Developer</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;11kb</small></a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                                   href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75"><img alt="png" height="32" src="/images/icons/pdf.png"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing
                        Manager</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;150kb</small></a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between w-100"
                                   href="app-file-manager.html">
            <div class="d-flex">
                <div class="mr-75"><img alt="png" height="32" src="/images/icons/doc.png"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
                </div>
            </div>
            <small class="search-data-size mr-50 text-muted">&apos;256kb</small></a></li>
    <li class="d-flex align-items-center"><a href="javascript:void(0);">
            <h6 class="section-label mt-75 mb-0">Members</h6></a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
                                   href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75"><img alt="png" height="32" src="/images/portrait/small/avatar-s-8.jpg"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
                                   href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75"><img alt="png" height="32" src="/images/portrait/small/avatar-s-1.jpg"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
                                   href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75"><img alt="png" height="32" src="/images/portrait/small/avatar-s-14.jpg"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing
                        Manager</small>
                </div>
            </div>
        </a></li>
    <li class="auto-suggestion"><a class="d-flex align-items-center justify-content-between py-50 w-100"
                                   href="app-user-view.html">
            <div class="d-flex align-items-center">
                <div class="avatar mr-75"><img alt="png" height="32" src="/images/portrait/small/avatar-s-6.jpg"></div>
                <div class="search-data">
                    <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                </div>
            </div>
        </a></li>
</ul>
<ul class="main-search-list-defaultlist-other-list d-none">
    <li class="auto-suggestion justify-content-between"><a
            class="d-flex align-items-center justify-content-between w-100 py-50">
            <div class="d-flex justify-content-start"><span class="mr-75" data-feather="alert-circle"></span><span>No results found.</span>
            </div>
        </a></li>
</ul>
<!-- END: Header-->
