@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ $menu->title }}
            </h1>
            <a href="{{ route('admin.menus.edit', $menu->id) }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-pen-to-square fa-sm text-white-50"></i> {{ __('menus.buttons.edit') }}</a>
        </div>

        <ul id="tree1">
            <li>{{ $menu->title }}
                <ul>
                    @foreach ($menu->childs as $menu)
                        <li>
                            @if (count($menu->childs))
                                {{ $menu->title }}
                                @include('menus.partials.manageChild', [
                                    'childs' => $menu->childs,
                                ])
                            @else
                                <a href="{{ $menu->href }}" target="{{ $menu->target }}">{{ $menu->title }}</a>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
@endsection
@section('scripts')
    <script>
        $.fn.extend({
            treed: function(o) {

                var openedClass = 'fas fa-minus';
                var closedClass = 'fas fa-plus';

                if (typeof o != 'undefined') {
                    if (typeof o.openedClass != 'undefined') {
                        openedClass = o.openedClass;
                    }
                    if (typeof o.closedClass != 'undefined') {
                        closedClass = o.closedClass;
                    }
                };

                /* initialize each of the top levels */
                var tree = $(this);
                tree.addClass("tree");
                tree.find('li').has("ul").each(function() {
                    var branch = $(this);
                    branch.prepend("");
                    branch.addClass('branch');
                    branch.on('click', function(e) {
                        if (this == e.target) {
                            var icon = $(this).children('i:first');
                            icon.toggleClass(openedClass + " " + closedClass);
                            $(this).children().children().toggle();
                        }
                    })
                    branch.children().children().toggle();
                });
                /* fire event from the dynamically added icon */
                tree.find('.branch .indicator').each(function() {
                    $(this).on('click', function() {
                        $(this).closest('li').click();
                    });
                });
                /* fire event to open branch if the li contains an anchor instead of text */
                tree.find('.branch>a').each(function() {
                    $(this).on('click', function(e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
                /* fire event to open branch if the li contains a button instead of text */
                tree.find('.branch>button').each(function() {
                    $(this).on('click', function(e) {
                        $(this).closest('li').click();
                        e.preventDefault();
                    });
                });
            }
        });
        /* Initialization of treeviews */
        $('#tree1').treed();
    </script>
@endsection
