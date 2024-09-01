<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stop;
use App\Models\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StopsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stops = Stop::all(); // O una query filtrata se necessario
        return response()->json(['stops' => $stops]);

        // Passa i dati alla vista
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request, $trip_id)
    {
        // // Recupera la data dalla query string
        // $dateString = $request->query('date');

        // // Verifica che l'ID del viaggio non sia nullo
        // if (is_null($trip_id)) {
        //     abort(404, 'ID del viaggio non trovato.');
        // }

        // // Converti la data in formato Y-m-d
        // try {
        //     $date = Carbon::createFromFormat('d M Y', $dateString);
        // } catch (\Exception $e) {
        //     abort(400, 'Data non valida.');
        // }

        return view('admin.stops.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        try {
            // Valida i dati di input
            // dd($request);
            $validatedData = $this->validation($request->all());


            // Controlla la sovrapposizione degli eventi
            $tripId = $validatedData['id_trip'];
            $startTime = $validatedData['time_start'];
            $endTime = $validatedData['time_end'];
            $day = $validatedData['day'];

            // Cerca eventi esistenti con lo stesso trip_id e giorno
            $overlappingEvents = Stop::where('id_trip', $tripId)
                // Filtra per il giorno specificato
                ->where('day', $day)
                // Aggiunge una condizione annidata per verificare la sovrapposizione degli orari
                ->where(function ($query) use ($startTime, $endTime) {
                    // Verifica se c'è un evento che inizia prima della fine dell'evento corrente e
                    // termina dopo l'inizio dell'evento corrente
                    $query->where('time_start', '<', $endTime)
                        ->where('time_end', '>', $startTime);
                })
                // Controlla se esiste almeno un evento che soddisfa tutte le condizioni sopra
                ->exists();

            // Se esiste un evento sovrapposto, restituisce un errore in formato JSON
            if ($overlappingEvents) {
                return response()->json(['status' => 'error', 'message' => 'L\'evento si sovrappone a un altro evento esistente.'], 422);
            }

            // Handle image file if present
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('images', 'public');
                $validatedData['image'] = $imagePath;
            }

            // Crea una nuova istanza di Stop e salva nel database
            $newStop = new Stop();
            $newStop->fill($validatedData);
            $newStop->save();

            // Renderizza il componente Blade come stringa
            $renderedView = view('components.accordionStops', ['event' => $newStop])->render();

            // Restituisce una risposta JSON con la vista renderizzata
            return response()->json(['status' => 'success', 'html' => $renderedView , 'message' => 'Tappa aggiunta con successo!']);
        } catch (\Exception $e) {
            // Restituisce una risposta JSON in caso di errore
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }







    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $stop = Stop::find($id);

        return view('components.ContentStopShow', compact('stop'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stop = Stop::findOrFail($id);
        return view('admin.stops.edit', compact('stop'))->render(); // Render il form come stringa HTML
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Definisci le regole di validazione
        $rules = [
            'day' => 'required|date',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string|min:5',
            'foods' => 'nullable|string',
            'country' => 'nullable|string',
            'city' => 'nullable|string',
            'street' => 'nullable|string',
            'curiosities' => 'nullable|string',
            'id_trip' => 'required|integer|exists:trips,id',
            'lonCountry' => 'nullable|numeric|between:-180,180',
            'latCountry' => 'nullable|numeric|between:-90,90',
            'lonStreet' => 'nullable|numeric|between:-180,180',
            'latStreet' => 'nullable|numeric|between:-90,90',
            'lonCity' => 'nullable|numeric|between:-180,180',
            'latCity' => 'nullable|numeric|between:-90,90',
            'time_start' => 'required|',
            'time_end' => 'required||after:time_start',
        ];

        // Definisci i messaggi di errore personalizzati
        $messages = [
            'id_trip.required' => 'Il campo id_trip è obbligatorio.',
            'id_trip.integer' => 'Il campo id_trip deve essere un numero intero.',
            'id_trip.exists' => 'Il viaggio selezionato non esiste.',
            'time_start.required' => 'L\'orario di inizio è obbligatorio.',
            'time_end.required' => 'L\'orario di fine è obbligatorio.',
            'time_start.date_format' => 'Il formato dell\'ora di inizio non è valido.',
            'time_end.date_format' => 'Il formato dell\'ora di fine non è valido.',
            'time_end.after' => 'L\'orario di fine deve essere successivo all\'orario di inizio.',
            'image.image' => 'Il file caricato deve essere un\'immagine.',
            'image.mimes' => 'L\'immagine deve essere di tipo jpeg, png o jpg.',
            'image.max' => 'L\'immagine non può essere più grande di 2MB.',
            'description.min' => 'La descrizione deve contenere almeno 5 caratteri.',
        ];

        // try {
        $validatedData = $request->validate($rules, $messages);
        $stop = Stop::findOrFail($id);

        // Gestisci l'immagine se presente
        if ($request->hasFile('image')) {
            // Elimina l'immagine precedente se esiste
            if ($stop->image) {
                Storage::disk('public')->delete($stop->image);
            }

            // Memorizza la nuova immagine
            $imagePath = $request->file('image')->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        $stop->update($validatedData);

        // Reindirizza alla pagina di dettaglio del viaggio associato alla tappa modificata
        return redirect()->route('admin.trips.show', ['trip' => $stop->id_trip])
            ->with('success', 'Tappa aggiornata con successo!');
        // } catch (\Exception $e) {
        //     dd($e->getMessage(), $e->getTrace());
        // }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        
        $stop = Stop::findOrFail($id); 
        $stop->delete();

        // return redirect()->route('admin.trips.show', ['trip' => $stop->id_trip]);
        return response()->json(['status' => 'success', 'message' => 'tappa con successo!']);    
    }

    




    private function validation($data)
    {
        // Prima validazione base
        $validator = Validator::make(
            $data,
            [
                'day' => 'required|date',
                'name' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'description' => 'nullable|string|min:5',
                'foods' => 'nullable|string',
                'country' => 'nullable|string',
                'city' => 'nullable|string',
                'street' => 'nullable|string',
                'curiosities' => 'nullable|string',
                'id_trip' => 'required|integer|exists:trips,id',
                'lonCountry' => 'nullable|numeric|between:-180,180',
                'latCountry' => 'nullable|numeric|between:-90,90',
                'lonStreet' => 'nullable|numeric|between:-180,180',
                'latStreet' => 'nullable|numeric|between:-90,90',
                'lonCity' => 'nullable|numeric|between:-180,180',
                'latCity' => 'nullable|numeric|between:-90,90',
                'time_start' => 'required|date_format:H:i',
                'time_end' => 'required|date_format:H:i|after:time_start'
            ],
            [
                'id_trip.required' => 'Il campo id_trip è obbligatorio.',
                'id_trip.integer' => 'Il campo id_trip deve essere un numero intero.',
                'id_trip.exists' => 'Il viaggio selezionato non esiste.',
                'time_start.required' => 'L\'orario di inizio è obbligatorio.',
                'time_end.required' => 'L\'orario di fine è obbligatorio.',
                'time_start.date_format' => 'Il formato dell\'ora di inizio non è valido.',
                'time_end.date_format' => 'Il formato dell\'ora di fine non è valido.',
                'time_end.after' => 'L\'orario di fine deve essere successivo all\'orario di inizio.',
            ]
        );

        return $validator->validate();
    }
}
