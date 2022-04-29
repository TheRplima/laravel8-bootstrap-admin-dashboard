<div class="modal fade" id="destroyModal" tabindex="-1" role="dialog" aria-labelledby="destroyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="destroyModalLabel">{{ __('common.warning') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="#" method="post">
                <div class="modal-body">
                    @csrf
                    @method('DELETE')
                    <h5 class="text-center">{{ __('common.delete-modal-text') }} <span>###</span>?</h5>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fecha" data-dismiss="modal">{{ __('common.buttons.cancel') }}</button>
                    <button type="submit" class="btn btn-danger">{{ __('common.buttons.delete_confirm') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('scripts')
<script>
    $('#destroyModal').on('show.bs.modal', function(e) {
        var name = $(e.relatedTarget).data('name');
        var attr = $(e.relatedTarget).data('attr');

        $(e.currentTarget).find('form').attr('action',attr);
        $(e.currentTarget).find('h5 > span').text(name);
        console.log(name,attr)
    });
</script>
@endsection
