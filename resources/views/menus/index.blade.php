@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('menus.index-title') }} {{ $parent_title }}
            </h1>
            <a href="{{ route('admin.menus.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-user-plus fa-sm text-white-50"></i> {{ __('menus.buttons.create') }}</a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        @if (request()->has('parent_id') && request()->parent_id != 0)
                            <a href="{{ route('admin.menus.index') }}"
                                class="btn btn-primary">Voltar</a>
                        @endif
                        <div class="table-responsive mt-3">
                            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col">#Id</th>
                                        <th scope="col">{{ __('menus.fields.title') }}</th>
                                        <th scope="col">{{ __('menus.fields.href') }}</th>
                                        <th scope="col">{{ __('menus.fields.target') }}</th>
                                        <th scope="col">{{ __('menus.fields.user') }}</th>
                                        <th class="text-center" scope="col">{{ __('menus.fields.children') }}</th>
                                        <th class="text-center" scope="col">{{ __('menus.fields.created_at') }}</th>
                                        <th class="text-center" scope="col">{{ __('menus.fields.updated_at') }}</th>
                                        <th class="text-center" scope="col">{{ __('menus.fields.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($menus as $menu)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $menu->id }}</th>
                                            <td>{{ $menu->title }}</td>
                                            <td>{{ $menu->href }}</td>
                                            <td>{{ $menu->target }}</td>
                                            <td>{{ $menu->user->name }}</td>
                                            <td class="text-center">
                                                {{ count($menu->childs) }}
                                                @if (count($menu->childs) > 0)
                                                    <a href="{{ route('admin.menus.index', 'parent_id='.$menu->id) }}"
                                                        title="{{ __('menus.buttons.view-sub') }}" role="button">
                                                        <i class="fas fa-diagram-next text-info"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">{{ $menu->created_at }}</td>
                                            <td class="text-center">{{ $menu->updated_at }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.menus.edit', $menu->id) }}"
                                                    title="{{ __('menus.buttons.edit') }}" role="button">
                                                    <i class="fas fa-pen-to-square"></i>
                                                </a>
                                                <a href="#" title="{{ __('menus.buttons.delete') }}" role="button" class="destroyButton"
                                                    data-toggle="modal" data-target="#destroyModal"
                                                    data-attr="{{ route('admin.menus.destroy', $menu->id) }}"
                                                    data-name="{{ $menu->title }}">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $menus->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('common.confirm-destroy-modal')
@endsection
@section('scripts')
@endsection
