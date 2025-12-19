<?php

namespace App\Http\Controllers\Formateur;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access-formateur-dashboard');
    }

    public function index()
    {
        if (!auth()->user()->hasRole('formateur')) {
            abort(403, 'Accès non autorisé.');
        }

        $user = Auth::user();

        // Récupérer les inscriptions assignées au formateur
        $inscriptions = Inscription::where('formateur_id', $user->id)
            ->with('user', 'formation')
            ->latest()
            ->get();

        $stats = [
            'total_inscriptions' => $inscriptions->count(),
            'active_formations' => $inscriptions->whereIn('status', ['confirmed', 'in_progress'])->count(),
            'today_sessions' => $inscriptions->whereHas('formation', function ($query) {
                $query->whereDate('session_date', today());
            })->count(),
            'completed_formations' => $inscriptions->where('status', 'completed')->count(),
        ];

        return view('formateur.dashboard', compact('user', 'inscriptions', 'stats'));
    }
}
