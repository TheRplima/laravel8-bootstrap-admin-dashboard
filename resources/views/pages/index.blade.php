@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('pages.index-title') }} {{ $parent_title }}
            </h1>
            <a href="{{ route('admin.pages.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-user-plus fa-sm text-white-50"></i> {{ __('pages.buttons.create') }}</a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    {{-- <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                    </div> --}}
                    <div class="card-body">
                        @if (request()->has('trashed'))
                            <a href="{{ route('admin.pages.index') }}" class="btn btn-info">{{ __('pages.buttons.all_pages') }}</a>
                            <a href="{{ route('admin.pages.restore-all') }}" class="btn btn-success">{{ __('pages.buttons.restore_all') }}</a>
                        @else
                            <a href="{{ route('admin.pages.index', ['trashed' => 'page']) }}"
                                class="btn btn-primary">{{ __('pages.buttons.deleted_only') }}</a>
                        @endif
                        @if (request()->has('parent_id') && request()->parent_id != 0)
                            <a href="{{ route('admin.pages.index') }}"
                                class="btn btn-primary">Voltar</a>
                        @endif
                        <div class="table-responsive mt-3">
                            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col">#Id</th>
                                        <th scope="col">{{ __('pages.fields.title') }}</th>
                                        <th class="text-center" scope="col">{{ __('pages.fields.children') }}</th>
                                        <th scope="col">{{ __('pages.fields.user') }}</th>
                                        <th class="text-center" scope="col">{{ __('pages.fields.created_at') }}</th>
                                        <th class="text-center" scope="col">{{ __('pages.fields.updated_at') }}</th>
                                        @if (request()->has('trashed'))
                                            <th class="text-center" scope="col">{{ __('pages.fields.deleted_at') }}</th>
                                        @endif
                                        <th class="text-center" scope="col">{{ __('pages.fields.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($pages as $page)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $page->id }}</th>
                                            <td>{{ $page->title }}</td>
                                            <td class="text-center">
                                                {{ count($page->children) }}
                                                @if (count($page->children) > 0)
                                                    <a href="{{ route('admin.pages.index', 'parent_id='.$page->id) }}"
                                                        title="{{ __('pages.buttons.view-sub') }}" role="button">
                                                        <i class="fas fa-diagram-next text-info"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $page->user->name }}</td>
                                            <td class="text-center">{{ $page->created_at }}</td>
                                            <td class="text-center">{{ $page->updated_at }}</td>
                                            @if (request()->has('trashed'))
                                                <td class="text-center">{{ $page->deleted_at }}</td>
                                            @endif
                                            <td class="text-center">
                                                <a href="{{ route('admin.pages.show', $page->slug) }}"
                                                    title="{{ __('pages.buttons.show') }}" role="button">
                                                    <i class="fas fa-eye text-info"></i>
                                                </a>
                                                <a href="{{ route('admin.pages.edit', $page->slug) }}"
                                                    title="{{ __('pages.buttons.edit') }}" role="button">
                                                    <i class="fas fa-pen-to-square"></i>
                                                </a>
                                                @if (request()->has('trashed'))
                                                    <a href="{{ route('admin.pages.restore', $page->slug) }}"
                                                        title="{{ __('pages.buttons.restore') }}" role="button">
                                                        <i class="fas fa-trash-arrow-up text-success"></i>
                                                    </a>
                                                @else
                                                    <a href="#" title="{{ __('pages.buttons.delete') }}" role="button" class="destroyButton"
                                                        data-toggle="modal" data-target="#destroyModal"
                                                        data-attr="{{ route('admin.pages.destroy', $page->slug) }}"
                                                        data-name="{{ $page->title }}">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $pages->links() }}
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
