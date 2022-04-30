@extends('layouts.master')

@section('content')
    <div class="container-fluid">
         <!-- Page Heading -->
         <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">
                {{ $page->title }}
            </h1>
            <a href="{{ route('admin.pages.edit', $page->slug) }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-pen-to-square fa-sm text-white-50"></i> {{ __('pages.buttons.edit') }}</a>
        </div>

        {!! $page->body !!}
    </div>
    @include('common.confirm-destroy-modal')
@endsection
@section('scripts')
@endsection
