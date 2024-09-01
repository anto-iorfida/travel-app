<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
class StopsController extends Controller
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
        //
    }
    public function validateStop(Request $request)
    {
        try {
            $this->validation($request->all());
            return response()->json(['message' => 'Validation passed'], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
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
        //
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
