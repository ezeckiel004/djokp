<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Inscription;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access-admin-dashboard');
    }

    public function index()
    {
        // Vérification supplémentaire
        if (!auth()->user()->hasRole('admin')) {
            abort(403, 'Accès non autorisé.');
        }

        $stats = [
            'total_users' => User::count(),
            'total_inscriptions' => Inscription::count(),
            'total_reservations' => Reservation::count(),
            'total_vehicles' => Vehicle::count(),
            'pending_contacts' => Contact::where('status', 'new')->count(),
            'active_formations' => Inscription::whereIn('status', ['confirmed', 'in_progress'])->count(),
        ];

        $recent_users = User::latest()->take(5)->get();
        $recent_inscriptions = Inscription::with(['user', 'formation'])
            ->latest()
            ->take(5)
            ->get();
        $recent_contacts = Contact::where('status', 'new')
            ->latest()
            ->take(5)
            ->get();

        // Statistiques mensuelles
        $monthly_stats = Reservation::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(total_amount) as revenue')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->get()
            ->keyBy('month');

        return view('admin.dashboard', compact(
            'stats',
            'recent_users',
            'recent_inscriptions',
            'recent_contacts',
            'monthly_stats'
        ));
    }
}
