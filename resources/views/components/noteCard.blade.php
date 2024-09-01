@props(['event'])
<div id="my-note">
    <div class="notes-container container mt-4 text-center row-lg">
        <div class="col">
            <div class="col-12 col-lg-6 my-form-note mb-4 m-auto">
                <h4 class="mb-4">Scrivi note alla tappa</h4>
                <hr>
                <div class="row d-flex flex-column">
                    <div class="col">
                        <form id="form-notes" action="{{ route('admin.notes.store') }}" class="text-center" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="text">Testo della nota:</label>
                                <textarea name="text" id="text" class="form-control" rows="4" required></textarea>
                                <div class="error text-danger fs-4"></div>
                            </div>
                            <input type="hidden" name="id_stop" value="{{ $event->id }}">
                            <button type="submit" class="btn my-4">Aggiungi</button>
                        </form>
                    </div>
                </div>
            </div>
            {{-- note create  --}}
            <div id="notesWrapper" class="ms-bg-notes rounded p-4">
                <div class=" my-wrap-note m-auto">
                    @foreach ($event->notes as $note)
                        <div class="my-col d-flex flex-column align-items-center"
                            data-note-id="{{ $note->id }}">
                            <p class="mb-0 flex-grow-1 my-p-note">
                                {{ $note->text }}
                            </p>
                            <div class="d-flex gap-5 mb-3 my-fa-delete-left">
                                <i class="fa-solid fa-delete-left"></i>
                            </div>
                        </div>
                    @endforeach
                </div> <!-- Aggiunto gap (g-4) tra le righe e colonne -->
            </div>
        </div>
    </div>
</div>
