@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ __('products.index-title') }}
            </h1>
            @can('product-create')
                <a href="{{ route('admin.products.create') }}"
                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                        class="fas fa-user-plus fa-sm text-white-50"></i> {{ __('products.buttons.create') }}</a>
            @endcan
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
                            <a href="{{ route('admin.products.index') }}" class="btn btn-info">{{ __('products.buttons.all_products') }}</a>
                            <a href="{{ route('admin.products.restore-all') }}" class="btn btn-success">{{ __('products.buttons.restore_all') }}</a>
                        @else
                            <a href="{{ route('admin.products.index', ['trashed' => 'product']) }}"
                                class="btn btn-primary">{{ __('products.buttons.deleted_only') }}</a>
                        @endif
                        <div class="table-responsive mt-3">
                            <table class="table table-sm table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead class="thead-light">
                                    <tr>
                                        <th class="text-center" scope="col">#Id</th>
                                        <th scope="col">{{ __('products.fields.name') }}</th>
                                        <th scope="col">{{ __('products.fields.user') }}</th>
                                        <th class="text-center" scope="col">{{ __('products.fields.created_at') }}</th>
                                        <th class="text-center" scope="col">{{ __('products.fields.updated_at') }}</th>
                                        @if (request()->has('trashed'))
                                            <th class="text-center" scope="col">{{ __('products.fields.deleted_at') }}</th>
                                        @endif
                                        <th class="text-center" scope="col">{{ __('products.fields.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody class="list">
                                    @foreach ($products as $product)
                                        <tr>
                                            <th class="text-center" scope="row">{{ $product->id }}</th>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->user->name }}</td>
                                            <td class="text-center">{{ $product->created_at }}</td>
                                            <td class="text-center">{{ $product->updated_at }}</td>
                                            @if (request()->has('trashed'))
                                                <td class="text-center">{{ $product->deleted_at }}</td>
                                            @endif
                                            <td class="text-center">
                                                <a href="{{ route('admin.products.show', $product->slug) }}"
                                                    title="{{ __('products.buttons.show') }}" role="button">
                                                    <i class="fas fa-eye text-info"></i>
                                                </a>
                                                @can('product-edit')
                                                    <a href="{{ route('admin.products.edit', $product->slug) }}"
                                                        title="{{ __('products.buttons.edit') }}" role="button">
                                                        <i class="fas fa-pen-to-square"></i>
                                                    </a>
                                                @endcan
                                                @can('product-delete')
                                                    @if (request()->has('trashed'))
                                                        <a href="{{ route('admin.products.restore', $product->slug) }}"
                                                            title="{{ __('products.buttons.restore') }}" role="button">
                                                            <i class="fas fa-trash-arrow-up text-success"></i>
                                                        </a>
                                                    @else
                                                        <a href="#" title="{{ __('products.buttons.delete') }}" role="button" class="destroyButton"
                                                            data-toggle="modal" data-target="#destroyModal"
                                                            data-attr="{{ route('admin.products.destroy', $product->slug) }}"
                                                            data-name="{{ $product->title }}">
                                                            <i class="fas fa-trash text-danger"></i>
                                                        </a>
                                                    @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $products->links() }}
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
