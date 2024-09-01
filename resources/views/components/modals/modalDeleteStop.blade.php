@props(['event'])
<div class="modal fade my-bg-modal" id="deleteStopModal-{{ $event->id }}" tabindex="-1" role="dialog"
    aria-labelledby="deleteStopModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content my-bg">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteStopModalLabel">Conferma Eliminazione</h5>
                <button type="button" id="miauu" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Sei sicuro di voler eliminare la tappa "{{ $event->name }}"?</p>
            </div>
            <div class="modal-footer">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>