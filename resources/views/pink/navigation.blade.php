@if ($menu)
    <div class="menu classic">
        <ul id="nav" class="menu">
            @include(env('THEME'). '.customMenuItems', ['menu' => $menu])
        </ul>
    </div>
@endif
