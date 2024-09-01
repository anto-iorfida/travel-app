<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use Illuminate\Support\Facades\Validator;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Log dei dati ricevuti
        // \Log::info('Dati ricevuti:', $request->all());
        // Salva i dati se la validazione è superata
        try {
            $validatedData = $this->validation($request->all());
            $rating = new Rating();
            $rating->fill($validatedData);
            $rating->save();

            return response()->json(['status' => 'success', 'message' => 'Valutazione salvata con successo',], 200); // 200 OK
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $rating = Rating::findOrFail($id); // Cerca il rating da eliminare
        $tripId = $rating->trip_id; // Salva l'ID del trip per il redirect
        $rating->delete(); // Elimina il rating

        return redirect()->route('admin.trips.show', ['id' => $tripId])->with('success', 'Rating eliminato con successo');
    }
    public function destroyByStop($stopId)
    {try{

        // Trova il rating associato alla tappa (stop) specifica
        $rating = Rating::where('stop_id', $stopId)->firstOrFail();

        // Salva l'ID del trip per il redirect prima di eliminare
        $tripId = $rating->trip_id;

        // Elimina il rating
        $rating->delete();

        // Reindirizza alla vista del trip associato con un messaggio di successo
        return response()->json(['status' => 'success', 'message' => 'Valutazione eliminata con successo',], 200); // 200 OK
    }catch (\Exception $e) {
        // Restituisce una risposta JSON in caso di errore
        return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
    }
    }
    private function validation($data) //----------------------------------------------------------------------------------------------------
    {
        return Validator::make(
            $data,

            [
                'stop_id' => 'nullable|integer|exists:stops,id',
                'trip_id' => 'required|integer|exists:trips,id',
                'rating' => 'required|numeric|between:0.5,5',
                'review' => 'nullable|string'
            ]
        )->validate();
    }
}
