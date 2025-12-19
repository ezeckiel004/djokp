<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Inscription;
use App\Models\Reservation;
use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:access-admin-dashboard');
    }

    public function index(Request $request)
    {
        // Statistiques générales
        $stats = [
            'total_users' => User::count(),
            'total_inscriptions' => Inscription::count(),
            'total_reservations' => Reservation::count(),
            'pending_contacts' => Contact::where('status', 'new')->count(),
        ];

        // Évolution mensuelle des inscriptions
        $monthly_inscriptions = Inscription::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as total')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Évolution mensuelle des réservations
        $monthly_reservations = Reservation::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('YEAR(created_at) as year'),
            DB::raw('COUNT(*) as total'),
            DB::raw('SUM(total_amount) as revenue')
        )
            ->whereYear('created_at', date('Y'))
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->get();

        // Répartition par rôle
        $users_by_role = User::select('role_id', DB::raw('COUNT(*) as total'))
            ->with('role')
            ->groupBy('role_id')
            ->get();

        // Statuts des inscriptions
        $inscription_status = Inscription::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        // Répartition des réservations par statut
        $reservation_status = Reservation::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        // Top 5 utilisateurs avec le plus de réservations
        $top_users_reservations = User::withCount('reservations')
            ->orderBy('reservations_count', 'desc')
            ->take(5)
            ->get();

        return view('admin.statistics.index', compact(
            'stats',
            'monthly_inscriptions',
            'monthly_reservations',
            'users_by_role',
            'inscription_status',
            'reservation_status',
            'top_users_reservations'
        ));
    }
}
