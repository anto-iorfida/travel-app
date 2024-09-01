@props(['event'])
<div class="accordion p-0 mb-2 my-accordion" id="stop-{{ $event->id }}">
    <details class="accordion">
        <summary class="accordion-btn fs-2 fw-bold d-flex" style="padding-right: 70px;">
            <div class="d-flex gap-lg-4 mt-2 flex-wrap">
                <div class="d-flex gap-lg-3">
                    <strong class="me-1 d-flex align-items-center"><i
                            class="fa-regular fa-clock me-2  "></i>Da: {{ \Carbon\Carbon::parse($event->time_start)->format('H:i') }}</strong>
                    <strong class="d-flex align-items-center"><i
                            class="fa-regular fa-clock me-2  "></i>A: {{ \Carbon\Carbon::parse($event->time_end)->format('H:i') }}</strong>
                </div>
                <div class="d-flex gap-lg-3">
                    <strong class="me-3 d-flex align-items-center"><i
                            class="fa-solid fa-calendar-check me-2  "></i>Evento: {{ $event->name }}</strong>
                    <strong class="d-none d-xxl-block"><i
                            class="fa-solid fa-road me-2 "></i>Via: {{ $event->city }}</strong>
                </div>
            </div>
            <div class="d-flex gap-3 align-items-center flex-grow-1 justify-content-end">
                <a href="" class="ms-edit-stop" data-toggle="modal" data-target="#editStopModal-{{ $event->id }}"><i
                        class="fa-solid fa-pen-to-square"></i>
                </a>

                <a href="" class="ms-delete-stop" data-toggle="modal"
                    data-target="#deleteStopModal-{{ $event->id }}"><i
                        class="fa-solid fa-trash-can"></i>
                </a>
            </div>
        </summary>

        <div class="accordion-content">
            <x-ContentStopShow :event="$event" />
        </div>
    </details>
</div>


@foreach ($event as $events)
    <section id="section-modal">

        {{-- modale edit stop  --}}
        <x-modals.modalEditStop :event="$event">
            {{-- compononente edit stop  --}}
            @include('admin.stops.edit', ['stop' => $event])
        </x-modals.modalEditStop>

        {{-- modale selete stop  --}}
        <x-modals.modalDeleteStop :event="$event">
            {{-- compononente deltestop  --}}
            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-danger delele-stop-btn" data-stopdelit-id="{{ $event->id }}"  >Sì, elimina</button>
        </x-modals.modalDeleteStop>

    </section>
@endforeach

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
