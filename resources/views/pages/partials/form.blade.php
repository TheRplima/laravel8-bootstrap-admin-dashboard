@csrf
<div class="mb-3">
    <label for="title" class="form-label">{{ __('pages.fields.title') }}</label>
    <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
        value="{{ old('title', $page->title ?? '') }}">
    @error('title')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="body" class="form-label">{{ __('pages.fields.body') }}</label>
    <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body">{{ old('body', $page->body ?? '') }}</textarea>
    @error('body')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="mb-3 text-center">
    <a href="{{ route('admin.pages.index') }}" class="btn btn-secondary">{{ __('pages.buttons.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('pages.buttons.save') }}</button>
</div>
