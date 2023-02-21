<?php
use App\Models\Notification;
?>
<div class="header">
    <div class="header-left">
        <div class="menu-icon dw dw-menu"></div>
        <div class="search-toggle-icon dw dw-search2" data-toggle="header_search"></div>
        {{-- <div class="header-search">
            <form>
                <div class="form-group mb-0">
                    <i class="dw dw-search2 search-icon"></i>
                    <input type="text" class="form-control search-input" placeholder="Search Here">
                    <div class="dropdown">
                        <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                            <i class="ion-arrow-down-c"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">From</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm form-control-line" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">To</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm form-control-line" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-12 col-md-2 col-form-label">Subject</label>
                                <div class="col-sm-12 col-md-10">
                                    <input class="form-control form-control-sm form-control-line" type="text">
                                </div>
                            </div>
                            <div class="text-right">
                                <button class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div> --}}
    </div>
    <div class="header-right">
        <div class="dashboard-setting user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="javascript:;" data-toggle="right-sidebar">
                    <i class="dw dw-settings2"></i>
                </a>
            </div>
        </div>
        <div class="user-notification">
            <div class="dropdown">
                <a class="dropdown-toggle no-arrow" href="#" role="button" data-toggle="dropdown">
                    <i class="dw dw-notification"></i>
                    <?php
                    if (auth()->user()->is_admin == 0) {
                        $notifications = Notification::where('user_id', auth()->user()->id)
                            ->orWhere('user_id', 0)
                            ->latest()
                            ->take(5)
                            ->get();
                    } else {
                        $notifications = Notification::where('user_id', auth()->user()->id)
                            ->latest()
                            ->take(5)
                            ->get();
                    }
                    ?>
                    @if (count($notifications) > 0)
                        <span class="badge notification-active"></span>
                    @endif
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    @if (count($notifications) > 0)
                        <div class="text-right">
                            <a href="#" class="btn btn-success btn-sm mb-3">View All</a>
                        </div>
                    @endif

                    <div class="notification-list mx-h-350 customscroll">
                        <ul>
                            @forelse ($notifications as $row)
                                <li>
                                    <a href="javascript:void(0)">
                                        <img src="https://static.thenounproject.com/png/125745-200.png" alt=""
                                            width="50" height="50">
                                        <h3 class="text-primary">{{ $row->sender_name }}</h3><span>
                                            {{ $row->created_at->diffForHumans() }}</span>
                                        <h6>{{ $row->subject }}</h6>
                                        <p>{{ $row->msg }}</p>
                                    </a>
                                </li>
                            @empty
                                <li>
                                    <a href="#" class="text-center">No Notification Found.</a>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="user-info-dropdown">
            <div class="dropdown">
                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                    <span class="user-icon">
                        <img src="{{ asset('admin/src/images') }}/{{auth()->user()->image!=null?auth()->user()->image:'avatar.png'}}" alt="">
                    </span>
                    <span class="user-name">{{ ucfirst(auth()->user()->name) }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                    @if (auth()->user()->is_admin == 1)
                        <a class="dropdown-item" href="{{ route('admin.profile') }}"><i class="dw dw-user1"></i>
                            Profile</a>
                    @else
                        <a class="dropdown-item" href="{{ route('employee.profile') }}"><i class="dw dw-user1"></i> Profile</a>
                    @endif
                    <a class="dropdown-item" href="{{ route('logout') }}"><i class="dw dw-logout"></i> Log Out</a>
                </div>
            </div>
        </div>
        {{-- <div class="github-link">
            <a href="https://github.com/dropways/deskapp" target="_blank"><img src="vendors/images/github.svg"
                    alt=""></a>
        </div> --}}
    </div>
</div>
