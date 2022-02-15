<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">{{ $title }}</h2>
            <button type="button" class="btn-close" wire:click="$emit('hideModal')" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {{ $body }}
        </div>
        <div class="modal-footer">
            {{ $footer }}
        </div>
    </div>
</div>
