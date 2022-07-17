<a class="nav-link" href="javascript:void(0);" data-toggle="dropdown">
    <i class="ficon" data-feather="bell"></i>
    @if($count_new>0)
        <span class="badge badge-pill badge-danger badge-up">
            {{$count_new}}
    </span>
    @endif
</a>

<ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
    <li class="dropdown-menu-header">
        <div class="dropdown-header d-flex">
            <h4 class="notification-title mb-0 mr-auto">Notifications</h4>
            <div class="badge badge-pill badge-light-primary">{{$count_new}} New</div>
        </div>

        <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right show">

            <li class="scrollable-container media-list ps ps__rtl ps--active-y">
                @foreach ($notifications as $notification)
                    <a class="d-flex" href="{{ $notification->data['url'] }}?notify_id={{ $notification->id }}">
                        <div class="media d-flex align-items-start">
                            <div class="media-left">
                                <div class="avatar">
                                    @if($notification->unread())
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                             viewBox="0 0 24 24"
                                             fill="blue"
                                             stroke="blue" stroke-width="2" stroke-linecap="round"
                                             stroke-linejoin="round"
                                             class="feather mb-0  feather-circle">
                                            <circle cx="12" cy="12" r="10"></circle>
                                        </svg>
                                    @endif
                                </div>
                            </div>
                            <div class="media-body">
                                <p class="media-heading">
                                    <span
                                        class="font-weight-bolder">{{ $notification->data['title'] }}
                                    </span>
                                </p><small class="notification-text">{{ $notification->data['body'] }}</small>
                            </div>
                        </div>
                    </a>
                @endforeach
            </li>
        </ul>
    </li>
</ul>



