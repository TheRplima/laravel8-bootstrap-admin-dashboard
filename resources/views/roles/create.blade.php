@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('roles.create-title') }}</h1>
            {{-- <a href="{{ route('admin.roles.create') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-role-plus fa-sm text-white-50"></i> Cadastrar usuário</a> --}}
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    {{-- <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
                    </div> --}}
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.roles.store') }}">
                            @include('roles.partials.form', ['create' => true])
                            <input type="hidden" name="parent_id" value="0" />
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
