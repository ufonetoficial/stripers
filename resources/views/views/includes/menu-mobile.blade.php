<div class="menuMobile w-100 bg-white shadow-lg p-3 border-top">
    <ul class="list-inline d-flex bd-highlight m-0 text-center">

        <li class="flex-fill bd-highlight">
            <a class="p-3 btn-mobile" href="{{ url('/') }}" title="{{ trans('admin.home') }}">
                <i class="feather icon-home icon-navbar"></i>
            </a>
        </li>

        @if (!$settings->disable_creators_section)
        <li class="flex-fill bd-highlight">
            <a class="p-3 btn-mobile" href="{{ url('creators') }}" title="{{ trans('general.explore') }}">
                <!-- Icono modificado: mapamundi moderno -->
                <i class="fas fa-globe icon-navbar"></i>
            </a>
        </li>
        @endif

        @if ($settings->shop)
        <li class="flex-fill bd-highlight">
            <a class="p-3 btn-mobile" href="{{ url('shop') }}" title="{{ trans('general.shop') }}">
                <i class="feather icon-shopping-bag icon-navbar"></i>
            </a>
        </li>
        @endif

        <!-- Botón Live en el centro -->
        <li class="flex-fill bd-highlight">
            <a class="p-3 btn-mobile" href="{{ url('explore/creators/live') }}" title="{{ trans('general.live') }}">
                <i class="feather icon-video icon-navbar"></i>
            </a>
        </li>

        <li class="flex-fill bd-highlight">
            <a href="{{ url('messages') }}" class="p-3 btn-mobile position-relative" title="{{ trans('general.messages') }}">
                <span class="noti_msg notify @if (auth()->user()->messagesInbox() != 0) d-block @endif">
                    {{ auth()->user()->messagesInbox() }}
                </span>
                <!-- Icono modificado: globo de mensaje moderno -->
                <i class="fas fa-comment-dots icon-navbar"></i>
            </a>
        </li>

        <li class="flex-fill bd-highlight">
            <a href="{{ url('notifications') }}" class="p-3 btn-mobile position-relative" title="{{ trans('general.notifications') }}">
                <span class="noti_notifications notify @if (auth()->user()->unseenNotifications()) d-block @endif">
                    {{ auth()->user()->unseenNotifications() }}
                </span>
                <i class="far fa-bell icon-navbar"></i>
            </a>
        </li>
    </ul>
</div>
