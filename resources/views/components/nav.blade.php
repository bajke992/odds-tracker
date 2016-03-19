<ul id="nav" class="right hide-on-med-and-down">
    @foreach($items as $item)
        <li class="@if(Request::url() === URL::route($item['route'])) active @endif">
            <a href="{{ URL::route($item['route']) }}">{!! $item['title'] !!}</a>
        </li>
    @endforeach
</ul>
<ul id="mobile" class="side-nav">
    @foreach($items as $item)
        <li class="@if(Request::url() === URL::route($item['route'])) active @endif">
            <a href="{{ URL::route($item['route']) }}">{!! $item['title'] !!}</a>
        </li>
    @endforeach
</ul>