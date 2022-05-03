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
    {{-- <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body_texarea">{{ old('body', $page->body ?? '') }}</textarea> --}}
    <div id="body">{{ old('body', $page->body ?? '') }}</div>
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

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
            .create( document.querySelector( '#body' ), {
                fullPage: true,
                // extraPlugins: 'docprops',
                // Disable content filtering because if you use full page mode, you probably
                // want to  freely enter any HTML content in source mode without any limitations.
                allowedContent: true,
                minHeight: 500,
                removeButtons: 'PasteFromWord'
            } )
            .then( editor => {
                    // console.log( editor );
                    editor.editing.view.change( writer => {
                        writer.setStyle( 'height', '300px', editor.editing.view.document.getRoot() );
                    } );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
@endsection
