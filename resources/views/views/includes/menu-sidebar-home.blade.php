<ul class="list-unstyled d-lg-block d-none menu-left-home sticky-top">
	<li>
		<a href="{{ url('/') }}" @if (request()->is('/')) class="active disabled" @endif>
			<i class="bi bi-house-fill"></i>
			<span class="ml-2">{{ trans('admin.home') }}</span>
		</a>
	</li>

	@auth
	<li>
		<a href="{{ url(auth()->user()->username) }}">
			<i class="bi bi-person-fill"></i>
			<span class="ml-2">{{ auth()->user()->verified_id == 'yes' ? trans('general.my_page') : trans('users.my_profile') }}</span>
		</a>
	</li>
	@if (auth()->user()->verified_id == 'yes')
	<li>
		<a href="{{ url('dashboard') }}">
			<i class="bi bi-speedometer2"></i>
			<span class="ml-2">{{ trans('admin.dashboard') }}</span>
		</a>
	</li>
	@endif
	<li>
		<a href="{{ url('my/purchases') }}" @if (request()->is('my/purchases')) class="active disabled" @endif>
			<i class="bi bi-bag-check"></i>
			<span class="ml-2">{{ trans('general.purchased') }}</span>
		</a>
	</li>
	<li>
		<a href="{{ url('messages') }}">
			<i class="bi bi-chat-dots-fill"></i>
			<span class="ml-2">{{ trans('general.messages') }}</span>
		</a>
	</li>
	@if (!$settings->disable_explore_section)
	<li>
		<a href="{{ url('explore') }}" @if (request()->is('explore')) class="active disabled" @endif>
			<i class="bi bi-globe"></i>
			<span class="ml-2">{{ trans('general.explore') }}</span>
		</a>
	</li>
	@endif
	<li>
		<a href="{{ url('my/subscriptions') }}">
			<i class="bi bi-person-check"></i>
			<span class="ml-2">{{ trans('admin.subscriptions') }}</span>
		</a>
	</li>
	<li>
		<a href="{{ url('my/bookmarks') }}" @if (request()->is('my/bookmarks')) class="active disabled" @endif>
			<i class="bi bi-bookmark-fill"></i>
			<span class="ml-2">{{ trans('general.bookmarks') }}</span>
		</a>
	</li>

	@else
	<li>
		<a href="{{ url('creators') }}">
			<i class="bi bi-globe"></i>
			<span class="ml-2">{{ trans('general.explore') }}</span>
		</a>
	</li>

	@if ($settings->shop)
	<li>
		<a href="{{ url('shop') }}">
			<i class="bi bi-shop"></i>
			<span class="ml-2">{{ trans('general.shop') }}</span>
		</a>
	</li>
	@endif

	@endauth
</ul>
