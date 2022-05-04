@csrf
<div class="mb-3">
    <label for="name" class="form-label">{{ __('products.fields.name') }}</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name"
        value="{{ old('name', $product->name ?? '') }}">
    @error('name')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="detail" class="form-label">{{ __('products.fields.detail') }}</label>
    <textarea class="form-control @error('detail') is-invalid @enderror" name="detail" id="detail">{{ old('detail', $product->detail ?? '') }}</textarea>
    @error('detail')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>
<div class="mb-3">
    <label for="image" class="form-label">{{ __('Image (optional)') }}</label>
    <div class="images-input">
        <span class="d-flex align-items-center mb-3">
            <input type="file" class="form-control" name="images[]">
            <button class="btn btn-sm btn-success ml-2" type="button">Adicionar</button>
        </span>
    </div>
    <div class="clone d-none">
        <span class="d-flex align-items-center mb-3">
            <input type="file" class="form-control" name="images[]">
            <button class="btn btn-sm btn-danger ml-2" type="button">Remover</button>
        </span>
    </div>

    @if (isset($product))
        @foreach($product->getMedia('products') as $image)
            <img src="{{asset($image->getUrl('thumb'))}}" class="img-thumbnail rounded">
        @endforeach
    @endif
</div>
<div class="mb-3">
    <label for="price" class="form-label">{{ __('products.fields.price') }}</label>
    <input type="number" placeholder="0.00" required name="price" min="0" value="{{ old('price', $product->price ?? '') }}" step="0.01" title="Preço" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?'inherit':'red'" class="form-control @error('price') is-invalid @enderror">
    @error('price')
        <span class="invalid-feedback" role="alert">
            {{ $message }}
        </span>
    @enderror
</div>

<div class="mb-3 text-center">
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">{{ __('products.buttons.cancel') }}</a>
    <button type="submit" class="btn btn-primary">{{ __('products.buttons.save') }}</button>
</div>

@section('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
            .create( document.querySelector( '#detail' ), {
                fullPage: true,
                // extraPlugins: 'docprops',
                // Disable content filtering because if you use full product mode, you probably
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

    $(document).ready(function(){
        $('.btn-success').on('click', function(e){
            e.preventDefault();
            let clone = $('.clone').html();
            $('.images-input').prepend(clone);
        });

        $(document).on('click', '.btn-danger', function(e){
            e.preventDefault();
            $(this).parent().remove();
        });
    });
</script>
@endsection
