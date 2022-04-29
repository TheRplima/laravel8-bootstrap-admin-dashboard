@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('users.index-title') }}</h1>
            <a href="{{ route('admin.users.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-user-plus fa-sm text-white-50"></i> {{ __('users.buttons.create') }}</a>
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
                            <a href="{{ route('admin.users.index') }}" class="btn btn-info">{{ __('users.buttons.all_users') }}</a>
                            <a href="{{ route('admin.users.restore-all') }}" class="btn btn-success">{{ __('users.buttons.restore_all') }}</a>
                        @else
                            <a href="{{ route('admin.users.index', ['trashed' => 'user']) }}"
                                class="btn btn-primary">{{ __('users.buttons.deleted_only') }}</a>
                        @endif
                        <div class="table-responsive mt-3">
                            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col">#Id</th>
                                        <th scope="col">{{ __('users.fields.name') }}</th>
                                        <th scope="col">{{ __('users.fields.email') }}</th>
                                        <th class="text-center" scope="col">{{ __('users.fields.created_at') }}</th>
                                        <th class="text-center" scope="col">{{ __('users.fields.updated_at') }}</th>
                                        @if (request()->has('trashed'))
                                            <th class="text-center" scope="col">{{ __('users.fields.deleted_at') }}</th>
                                        @endif
                                        <th class="text-center" scope="col">{{ __('users.fields.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($users as $user)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $user->id }}</th>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center">{{ $user->created_at }}</td>
                                            <td class="text-center">{{ $user->updated_at }}</td>
                                            @if (request()->has('trashed'))
                                                <td class="text-center">{{ $user->deleted_at }}</td>
                                            @endif
                                            <td class="text-center">
                                                <a href="{{ route('admin.users.edit', $user->id) }}"
                                                    title="{{ __('users.buttons.edit') }}" role="button">
                                                    <i class="fas fa-user-pen"></i>
                                                </a>
                                                @if (request()->has('trashed'))
                                                    <a href="{{ route('admin.users.restore', $user->id) }}"
                                                        title="{{ __('users.buttons.restore') }}" role="button">
                                                        <i class="fas fa-trash-arrow-up text-success"></i>
                                                    </a>
                                                @else
                                                    <a href="#" title="{{ __('users.buttons.delete') }}" role="button" class="destroyButton"
                                                        data-toggle="modal" data-target="#destroyModal"
                                                        data-attr="{{ route('admin.users.destroy', $user->id) }}"
                                                        data-name="{{ $user->name }}">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $users->links() }}
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
