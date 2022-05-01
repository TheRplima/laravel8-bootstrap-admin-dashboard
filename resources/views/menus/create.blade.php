@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">{{ __('pages.create-title') }}</h1>
            {{-- <a href="{{ route('admin.pages.create') }}"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-page-plus fa-sm text-white-50"></i> Cadastrar usuário</a> --}}
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.menus.store') }}">
                            @include('menus.partials.form', ['create' => true])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
