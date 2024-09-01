@props(['event'])
<section id="my-note-modal">
    <div class="modal fade my-bg-modal" id="notesStopModal-{{ $event->id }}" tabindex="-1" role="dialog"
        aria-labelledby="notesStopModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-fullscreen-lg-down" role="document">
            <div class="modal-content my-modal-content-note">
                <div class="modal-header justify-content-end">
                    {{-- <h5 class="modal-title" id="notesStopModalLabel">Notes</h5> --}}
                    <button type="button" class="close text-danger fs-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fa-regular fa-circle-xmark"></i></span>
                    </button>
                </div>
                <div class="modal-body p-0">
                   {{ $slot }}
                </div>
                {{-- <div class="modal-footer">
                    
                </div> --}}
            </div>
        </div>
    </div>
</section>
