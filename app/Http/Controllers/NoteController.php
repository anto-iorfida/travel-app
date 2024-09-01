<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Stop;
use Dotenv\Validator;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Visualizza l'elenco delle note.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {}

    /**
     * Mostra il modulo per la creazione di una nuova nota.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Ritorna la vista 'notes.create' per mostrare il form di creazione

    }

    /**
     * Memorizza una nuova nota nel database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            // Usa la validazione integrata di Laravel
            $validatedData = $request->validate([
                'text' => 'required|string|min:3',
                'id_stop' => 'required|exists:stops,id', // Assicurati che 'stops' sia il nome corretto della tua tabella
            ]);
    
            // Crea una nuova nota
            $note = new Note();
            $note->fill($validatedData);
            $note->save();
    
            // Restituisci la nota come JSON
            return response()->json([
                'status' => 'success',
                'message' => 'Nota salvata con successo',
                'note' => $note
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Errore di validazione',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Errore del server: ' . $e->getMessage() // Fornisce maggiori dettagli sull'errore
            ], 500);
        }
    }


    /**
     * Visualizza una singola nota.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        // Ritorna la vista 'notes.show' con la singola nota
    }

    /**
     * Mostra il modulo per modificare una nota esistente.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    {
        // Ritorna la vista 'notes.edit' con la nota da modificare
    }

    /**
     * Aggiorna una nota esistente nel database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        // Valida i dati di input
        $validatedData = $request->validate([
            'text' => 'required|string|min:3',
        ]);

        // Aggiorna la nota con i nuovi dati
        $note->update($validatedData);

        // Reindirizza alla pagina delle note con un messaggio di successo
        return redirect()->route('notes.index')->with('success', 'Nota aggiornata con successo!');
    }

    /**
     * Elimina una nota dal database.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $note->delete();
        // return response()->json(['status' => 'success', 'message' => 'Nota eliminata con successo!']);
        $note = Note::findOrFail($id); 
        $note->delete();
        return response()->json(['status' => 'success', 'message' => 'Nota eliminata con successo!']);
        // dd($id);


        // return redirect()->route('admin.trips.show', ['trip' => $stop->id_trip]);
    }
    
}
