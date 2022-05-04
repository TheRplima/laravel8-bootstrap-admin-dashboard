@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('roles.index-name') }}
            </h1>
            <a href="{{ route('admin.roles.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-user-plus fa-sm text-white-50"></i> {{ __('roles.buttons.create') }}</a>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    {{-- <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                    </div> --}}
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col">#Id</th>
                                        <th scope="col">{{ __('roles.fields.name') }}</th>
                                        <th class="text-center" scope="col">{{ __('roles.fields.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($roles as $role)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $role->id }}</th>
                                            <td>{{ $role->name }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('admin.roles.show', $role->id) }}"
                                                    name="{{ __('roles.buttons.show') }}" role="button">
                                                    <i class="fas fa-eye text-info"></i>
                                                </a>
                                                @can('role-edit')
                                                <a href="{{ route('admin.roles.edit', $role->id) }}"
                                                    name="{{ __('roles.buttons.edit') }}" role="button">
                                                    <i class="fas fa-pen-to-square"></i>
                                                </a>
                                                @endcan
                                                @can('role-delete')
                                                    <a href="#" name="{{ __('roles.buttons.delete') }}" role="button" class="destroyButton"
                                                    data-toggle="modal" data-target="#destroyModal"
                                                    data-attr="{{ route('admin.roles.destroy', $role->id) }}"
                                                    data-name="{{ $role->name }}">
                                                        <i class="fas fa-trash text-danger"></i>
                                                    </a>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $roles->links() }}
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
