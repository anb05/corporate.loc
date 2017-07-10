@foreach($menu as $item)
    <li {{--{{ (URL::current() == url($item['path'])) ? "class = active" : ''}}--}}>
        <a href="{{ url($item['path']) }}">{{ $item['title'] }}</a>
        @if(!empty($item['child']))
            <ul class="sub-menu">
                @include(env('THEME'). '.customMenuItems', ['menu' => $item['child']])
            </ul>
        @endif
    </li>
@endforeach
