<div class="content-header-section">
    <!-- User Dropdown -->
    @if (Auth::user())
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user d-sm-none"></i>
                <span class="d-none d-sm-inline-block">{{ Auth::user()->surname}} {{ Auth::user()->name}}</span>
                <i class="fa fa-angle-down ml-5"></i>
            </button>
            <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="si si-logout mr-5"></i> Sign Out
                    </button>
                </form>
            </div>
        </div>
    @endif
    
    <!-- END User Dropdown -->

    <!-- Notifications
    <div class="btn-group" role="group">
        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-notifications" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-flag"></i>
            <span class="badge badge-primary badge-pill">5</span>
        </button>
        <div class="dropdown-menu dropdown-menu-right min-width-300" aria-labelledby="page-header-notifications">
            <h5 class="h6 text-center py-10 mb-0 border-b text-uppercase">Notifications</h5>
            <ul class="list-unstyled my-20">
                <li>
                    <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                        <div class="ml-5 mr-15">
                            <i class="fa fa-fw fa-check text-success"></i>
                        </div>
                        <div class="media-body pr-10">
                            <p class="mb-0">You’ve upgraded to a VIP account successfully!</p>
                            <div class="text-muted font-size-sm font-italic">15 min ago</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                        <div class="ml-5 mr-15">
                            <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                        </div>
                        <div class="media-body pr-10">
                            <p class="mb-0">Please check your payment info since we can’t validate them!</p>
                            <div class="text-muted font-size-sm font-italic">50 min ago</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                        <div class="ml-5 mr-15">
                            <i class="fa fa-fw fa-times text-danger"></i>
                        </div>
                        <div class="media-body pr-10">
                            <p class="mb-0">Web server stopped responding and it was automatically restarted!</p>
                            <div class="text-muted font-size-sm font-italic">4 hours ago</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                        <div class="ml-5 mr-15">
                            <i class="fa fa-fw fa-exclamation-triangle text-warning"></i>
                        </div>
                        <div class="media-body pr-10">
                            <p class="mb-0">Please consider upgrading your plan. You are running out of space.</p>
                            <div class="text-muted font-size-sm font-italic">16 hours ago</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="text-body-color-dark media mb-15" href="javascript:void(0)">
                        <div class="ml-5 mr-15">
                            <i class="fa fa-fw fa-plus text-primary"></i>
                        </div>
                        <div class="media-body pr-10">
                            <p class="mb-0">New purchases! +$250</p>
                            <div class="text-muted font-size-sm font-italic">1 day ago</div>
                        </div>
                    </a>
                </li>
            </ul>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-center mb-0" href="javascript:void(0)">
                <i class="fa fa-flag mr-5"></i> View All
            </a>
        </div>
    </div>
     END Notifications -->

    <!-- Toggle Side Overlay -->
    <!-- Layout API, functionality initialized in Template._uiApiLayout()
    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="side_overlay_toggle">
        <i class="fa fa-tasks"></i>
    </button>
    END Toggle Side Overlay -->
</div>
