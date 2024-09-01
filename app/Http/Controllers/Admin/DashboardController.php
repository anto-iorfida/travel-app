<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use illuminate\Support\Facades\Auth;
class DashboardController extends Controller
{
    public function index()
    {
        // $user = Auth::user(); //istanza di user loggato
        // $user = Auth::id(); //ritorna numero id utente logato
        // $user = Auth::check(); //ritorna valore tru o false se e loggato o no

        $user = Auth::user();
        $tripsCount = $user->trips->count();
        // Recupera tutti i trips dell'utente e le loro recensioni
        $trips = $user->trips()->with('ratings')->get();

        // Calcola la somma totale delle recensioni
        $totalRatingCount = $trips->flatMap(function ($trip) {
            return $trip->ratings;
        })->count('rating');

        $totalRatingAvg = $trips->flatMap(function ($trip) {
            return $trip->ratings;
        })->avg('rating');

        $allStops = $trips->flatMap(function ($trip) {
            return $trip->stops;
        })->count('id');
       
        $tripCountries = $user->trips()->distinct()->pluck('country');
        $tripCities = $user->trips()->distinct()->pluck('city');
        $stopCities = $user->trips()->with('stops') // Carica i viaggi e le tappe
        ->get() // Recupera i viaggi con le tappe
        ->flatMap(function ($trip) {
            return $trip->stops->pluck('city'); // Estrae le città da tutte le tappe
        })
        ->unique() // Rimuove i duplicati
        ->sort() // Ordina le città
        ->values(); // Resetta le chiavi dell'array

        return view('admin.dashboard', compact('user', 'tripsCount', 'totalRatingCount', 'totalRatingAvg','allStops','tripCountries','stopCities','tripCities'));
    }
}
