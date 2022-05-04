@csrf
<div class="mb-3">
    <label for="name" class="form-label">{{ __('roles.fields.name') }}</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
        value="{{ old('name', $role->name ?? '') }}">
    @error('name')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="permission" class="form-label">{{ __('roles.fields.permission') }}</label>
    @foreach($permission as $value)
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="{{$value->id}}" id="permission{{$value->id}}" name="permission[]"
            @if(isset($rolePermissions) && in_array($value->id, $rolePermissions)) checked @endif>
            <label class="form-check-label" for="permission{{$value->id}}">
                {{ $value->name }}
            </label>
        </div>
    @endforeach
    @error('permission')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="mb-3 text-center">
    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">{{ __('roles.buttons.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('roles.buttons.save') }}</button>
</div>

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
            .create( document.querySelector( '#permission' ), {
                fullPage: true,
                // extraPlugins: 'docprops',
                // Disable content filtering because if you use full role mode, you probably
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
