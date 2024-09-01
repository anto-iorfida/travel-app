@props(['event'])
<div class="modal fade my-bg-modal" id="editStopModal-{{ $event->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editStopModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content my-bg">
            <div class="modal-header">
                <h5 class="modal-title" id="editStopModalLabel">Modifica Tappa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>