@foreach ($childs as $menu)
    <a class="collapse-item" href="{{ $menu->href }}" target="{{ $menu->target }}">
        @for ($i = 0; $i <= $level-1; $i++)
            -
        @endfor
        {{ $menu->title }}
    </a>
    @if (count($menu->childs))
        @php $level++ @endphp
        @include('menus.partials.manageChild', [
            'childs' => $menu->childs,
        ])
    @endif
@endforeach
