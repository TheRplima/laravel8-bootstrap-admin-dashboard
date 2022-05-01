@csrf
<div class="mb-3">
    <label for="title" class="form-label">{{ __('menus.fields.title') }}</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
        value="{{ old('title', $menu->title ?? '') }}">
    @error('title')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="href" class="form-label">{{ __('menus.fields.href') }}</label>
    <input type="text" class="form-control @error('href') is-invalid @enderror" name="href" id="href"
        value="{{ old('href', $menu->href ?? '') }}">
    @error('href')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="parent_id" class="form-label">{{ __('menus.fields.parent_id') }}</label>
    <select class="form-control" name="parent_id" id="parent_id">
        <option value="0">{{ __('menus.fields.select_parent_id') }}</option>
        @foreach ($allMenus as $key => $value)
            <option value="{{ $key }}"@if(isset($menu) && $menu->parent_id == $key) selected @endif>{{ $value }}</option>
        @endforeach
    </select>
    @error('parent_id')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3 text-center">
    <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">{{ __('menus.buttons.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('menus.buttons.save') }}</button>
</div>
