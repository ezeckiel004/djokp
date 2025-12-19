<?php

namespace App\Http\Controllers\Chauffeur;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access-chauffeur-dashboard');
    }

    public function index()
    {
        if (!auth()->user()->hasRole('chauffeur')) {
            abort(403, 'Accès non autorisé.');
        }

        $user = Auth::user();

        // Récupérer les réservations assignées au chauffeur
        $reservations = Reservation::where('chauffeur_id', $user->id)
            ->orWhere('assigned_to', $user->id)
            ->with('vehicle', 'user')
            ->latest()
            ->get();

        $stats = [
            'total_reservations' => $reservations->count(),
            'today_reservations' => $reservations->where('start_date', '>=', now()->startOfDay())
                ->where('start_date', '<=', now()->endOfDay())
                ->count(),
            'upcoming_reservations' => $reservations->where('start_date', '>=', now())->count(),
            'completed_reservations' => $reservations->where('status', 'completed')->count(),
        ];

        return view('chauffeur.dashboard', compact('user', 'reservations', 'stats'));
    }
}
