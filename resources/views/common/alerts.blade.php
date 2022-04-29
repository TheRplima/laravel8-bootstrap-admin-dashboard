@if (session('success'))
<div class="container-fluid">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
</div>
@endif

@if($errors->any())
<div class="container-fluid">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p><strong>{{ __('common.errors-info') }}</strong></p>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
</div>
@endif

@if (session('error'))
<div class="container-fluid">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
</div>
@endif

@if (session('status'))
<div class="container-fluid">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('status') }}
        <button class="close" type="button" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
</div>
@endif
