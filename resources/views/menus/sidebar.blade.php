<!-- Nav Item - Dynamic created menu items -->
<li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse{{ $menu->menuId() }}"
        aria-expanded="true" aria-controls="collapse{{ $menu->menuId() }}">
        <i class="fas fa-fw fa-{{ $menu->icon }}"></i>
        <span>{{ $menu->title }}</span>
    </a>
    <div id="collapse{{ $menu->menuId() }}" class="collapse" aria-labelledby="heading{{ $menu->menuId() }}"
        data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @php
            $level = 1
            @endphp
            @foreach ($menu->childs as $menu)
                <a class="collapse-item" href="{{ $menu->href }}" target="{{ $menu->target }}">{{ $menu->title }}</a>
                    @if (count($menu->childs))
                        @include('menus.partials.manageChild', [
                            'childs' => $menu->childs,
                        ])
                    @endif
            @endforeach
        </div>
    </div>
</li>
