@csrf
<div class="mb-3">
    <label for="name" class="form-label">{{ __('users.fields.name') }}</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
        value="{{ old('name', $user->name ?? '') }}">
    @error('name')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="email" class="form-label">{{ __('users.fields.email') }}</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email"
        aria-describedby="email" value="{{ old('email', $user->email ?? '') }}">
    @error('email')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="mb-3">
    <label for="password" class="form-label">{{ __('users.fields.password') }}</label>
    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password">
    @error('password')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="password_confirmation" class="form-label">{{ __('users.fields.password_confirm') }}</label>
    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror"
        name="password_confirmation" id="password_confirmation">
    @error('password_confirmation')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="avatar" class="form-label">{{ __('Avatar (optional)') }}</label>
    <input id="avatar" type="file" class="form-control" name="avatar">
</div>
@if (isset($user))
    <input type="hidden" name="id" value="{{ $user->id }}" />
@endif
<div class="mb-3 text-center">
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">{{ __('users.buttons.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('users.buttons.save') }}</button>
</div>
