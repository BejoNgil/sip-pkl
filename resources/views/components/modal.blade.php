<div class="modal fade" id="{{ $id }}" role="dialog" aria-labelledby="{{ $id }}-label" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="{{ $id }}-label">{{ $title }}</h4>
            </div>
            {{ $content }}
        </div>
    </div>
</div>
