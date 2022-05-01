<ul>
    @foreach ($childs as $child)
        <li>
            @if (count($child->childs))
                {{ $child->title }}
                @include('menus.partials.manageChild', ['childs' => $child->childs])
            @else
                <a href="{{ $child->href }}" target="{{ $child->target }}">{{ $child->title }}</a>
            @endif
        </li>
    @endforeach
</ul>
