<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterCampaign;
use App\Models\NewsletterSubscription;
use App\Models\NewsletterLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\NewsletterMail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Jobs\SendNewsletterJob;
use Illuminate\Support\Facades\Log;

class NewsletterController extends Controller
{
    /**
     * Display a listing of newsletter subscriptions.
     */
    public function index()
    {
        $subscriptions = NewsletterSubscription::latest()->paginate(20);

        $stats = [
            'total' => NewsletterSubscription::count(),
            'active' => NewsletterSubscription::active()->count(),
            'pending' => NewsletterSubscription::pending()->count(),
            'unsubscribed' => NewsletterSubscription::where('status', 'unsubscribed')->count(),
        ];

        return view('admin.newsletter.index', compact('subscriptions', 'stats'));
    }

    /**
     * Show the form for creating a new newsletter campaign.
     */
    public function create()
    {
        $templates = [
            'default' => 'Template par défaut',
            'promotion' => 'Template promotionnel',
            'news' => 'Template actualités',
            'event' => 'Template événement'
        ];

        $activeSubscribers = NewsletterSubscription::active()->count();

        return view('admin.newsletter.create', compact('templates', 'activeSubscribers'));
    }

    /**
     * Store a newly created newsletter campaign.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'template' => 'required|string',
            'scheduled_at' => 'nullable|date|after_or_equal:now',
            'send_immediately' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        // Créer la campagne
        $campaign = NewsletterCampaign::create([
            'subject' => $data['subject'],
            'content' => $data['content'],
            'template' => $data['template'],
            'status' => $data['send_immediately'] ? 'sending' : ($data['scheduled_at'] ? 'scheduled' : 'draft'),
            'scheduled_at' => $data['send_immediately'] ? now() : ($data['scheduled_at'] ? $data['scheduled_at'] : null),
            'total_recipients' => NewsletterSubscription::active()->count(),
        ]);

        // Log important
        Log::info('Nouvelle campagne créée', [
            'id' => $campaign->id,
            'subject' => $campaign->subject,
            'send_immediately' => $data['send_immediately'],
            'status' => $campaign->status
        ]);

        // Si envoi immédiat
        if ($data['send_immediately']) {
            Log::info('Lancement immédiat du job pour la campagne ' . $campaign->id);

            try {
                // Exécuter le job immédiatement (synchrone)
                SendNewsletterJob::dispatchSync($campaign);

                return redirect()->route('admin.newsletter.campaigns.show', $campaign)
                    ->with('success', 'Campagne créée et envoyée avec succès !');
            } catch (\Exception $e) {
                Log::error('Erreur lors de l\'envoi immédiat: ' . $e->getMessage());

                return redirect()->route('admin.newsletter.campaigns.show', $campaign)
                    ->with('error', 'Campagne créée mais erreur lors de l\'envoi: ' . $e->getMessage());
            }
        }

        return redirect()->route('admin.newsletter.campaigns.show', $campaign)
            ->with('success', 'Campagne créée avec succès !');
    }

    /**
     * Display the specified newsletter campaign.
     */
    public function show(NewsletterCampaign $campaign)
    {
        $logs = $campaign->logs()
            ->with('subscription')
            ->latest()
            ->paginate(20);

        return view('admin.newsletter.show', compact('campaign', 'logs'));
    }

    /**
     * Show the form for editing the newsletter campaign.
     */
    public function edit(NewsletterCampaign $campaign)
    {
        if (!in_array($campaign->status, ['draft', 'scheduled'])) {
            return redirect()->route('admin.newsletter.campaigns.show', $campaign)
                ->with('error', 'Impossible de modifier une campagne déjà envoyée.');
        }

        $templates = [
            'default' => 'Template par défaut',
            'promotion' => 'Template promotionnel',
            'news' => 'Template actualités',
            'event' => 'Template événement'
        ];

        return view('admin.newsletter.edit', compact('campaign', 'templates'));
    }

    /**
     * Update the specified newsletter campaign.
     */
    public function update(Request $request, NewsletterCampaign $campaign)
    {
        if (!in_array($campaign->status, ['draft', 'scheduled'])) {
            return redirect()->back()
                ->with('error', 'Impossible de modifier une campagne déjà envoyée.');
        }

        $validator = Validator::make($request->all(), [
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
            'template' => 'required|string',
            'scheduled_at' => 'nullable|date|after_or_equal:now',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        $campaign->update([
            'subject' => $data['subject'],
            'content' => $data['content'],
            'template' => $data['template'],
            'scheduled_at' => $data['scheduled_at'],
        ]);

        return redirect()->route('admin.newsletter.campaigns.show', $campaign)
            ->with('success', 'Campagne mise à jour avec succès !');
    }

    /**
     * Remove the specified newsletter campaign.
     */
    public function destroy(NewsletterCampaign $campaign)
    {
        if ($campaign->status === 'sending') {
            return redirect()->back()
                ->with('error', 'Impossible de supprimer une campagne en cours d\'envoi.');
        }

        $campaign->delete();

        return redirect()->route('admin.newsletter.campaigns')
            ->with('success', 'Campagne supprimée avec succès !');
    }

    /**
     * Display a listing of newsletter campaigns.
     */
    public function campaigns()
    {
        $campaigns = NewsletterCampaign::withCount('logs')
            ->latest()
            ->paginate(20);

        $stats = [
            'total' => NewsletterCampaign::count(),
            'draft' => NewsletterCampaign::draft()->count(),
            'scheduled' => NewsletterCampaign::scheduled()->count(),
            'sent' => NewsletterCampaign::sent()->count(),
        ];

        return view('admin.newsletter.campaigns', compact('campaigns', 'stats'));
    }

    /**
     * Send newsletter campaign.
     */
    public function send(NewsletterCampaign $campaign)
    {
        if (!in_array($campaign->status, ['draft', 'scheduled'])) {
            return redirect()->back()
                ->with('error', 'Cette campagne a déjà été envoyée ou est en cours d\'envoi.');
        }

        Log::info('Lancement manuel de la campagne ' . $campaign->id);

        // Mettre à jour le statut
        $campaign->update([
            'status' => 'sending',
        ]);

        try {
            // Exécuter le job immédiatement
            SendNewsletterJob::dispatchSync($campaign);

            return redirect()->back()
                ->with('success', 'Campagne envoyée avec succès !');
        } catch (\Exception $e) {
            Log::error('Erreur lors de l\'envoi manuel: ' . $e->getMessage());

            return redirect()->back()
                ->with('error', 'Erreur lors de l\'envoi: ' . $e->getMessage());
        }
    }

    /**
     * Cancel scheduled campaign.
     */
    public function cancel(NewsletterCampaign $campaign)
    {
        if ($campaign->status !== 'scheduled') {
            return redirect()->back()
                ->with('error', 'Seules les campagnes planifiées peuvent être annulées.');
        }

        $campaign->update([
            'status' => 'cancelled',
        ]);

        return redirect()->back()
            ->with('success', 'Campagne annulée avec succès !');
    }

    /**
     * Toggle subscription status.
     */
    public function toggleSubscription(NewsletterSubscription $subscription)
    {
        if ($subscription->status === 'unsubscribed') {
            $subscription->resubscribe();
            $message = 'Abonnement réactivé avec succès !';
        } else {
            $subscription->unsubscribe();
            $message = 'Abonnement désactivé avec succès !';
        }

        return redirect()->back()
            ->with('success', $message);
    }

    /**
     * Delete subscription.
     */
    public function destroySubscription(NewsletterSubscription $subscription)
    {
        $subscription->delete();

        return redirect()->back()
            ->with('success', 'Abonnement supprimé avec succès !');
    }

    /**
     * Export subscribers.
     */
    public function export(Request $request)
    {
        $query = NewsletterSubscription::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $subscribers = $query->select('email', 'name', 'status', 'source', 'created_at')
            ->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="subscribers_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function () use ($subscribers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Email', 'Nom', 'Statut', 'Source', 'Date d\'inscription']);

            foreach ($subscribers as $subscriber) {
                fputcsv($file, [
                    $subscriber->email,
                    $subscriber->name,
                    $subscriber->status,
                    $subscriber->source,
                    $subscriber->created_at->format('d/m/Y H:i'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Show statistics.
     */
    public function statistics()
    {
        // Statistiques générales
        $totalSubscribers = NewsletterSubscription::count();
        $activeSubscribers = NewsletterSubscription::active()->count();
        $unsubscribedRate = $totalSubscribers > 0
            ? (NewsletterSubscription::where('status', 'unsubscribed')->count() / $totalSubscribers) * 100
            : 0;

        // Statistiques des campagnes
        $totalCampaigns = NewsletterCampaign::count();
        $sentCampaigns = NewsletterCampaign::sent()->count();
        $averageOpenRate = NewsletterCampaign::sent()
            ->where('opened_count', '>', 0)
            ->avg(DB::raw('(opened_count / total_recipients) * 100'));

        // Campagnes récentes
        $recentCampaigns = NewsletterCampaign::withCount('logs')
            ->latest()
            ->take(5)
            ->get();

        // Évolution des inscriptions (30 derniers jours)
        $subscriptionGrowth = NewsletterSubscription::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Sources d'inscription
        $subscriptionSources = NewsletterSubscription::selectRaw('source, COUNT(*) as count')
            ->groupBy('source')
            ->orderBy('count', 'desc')
            ->get();

        return view('admin.newsletter.statistics', compact(
            'totalSubscribers',
            'activeSubscribers',
            'unsubscribedRate',
            'totalCampaigns',
            'sentCampaigns',
            'averageOpenRate',
            'recentCampaigns',
            'subscriptionGrowth',
            'subscriptionSources'
        ));
    }

    /**
     * Preview email template.
     */
    public function preview(Request $request)
    {
        $request->validate([
            'subject' => 'required|string',
            'content' => 'required|string',
            'template' => 'required|string',
        ]);

        $content = $request->content;
        $template = $request->template;
        $subject = $request->subject;

        return view('admin.newsletter.preview', compact('content', 'template', 'subject'));
    }

    /**
     * TEST DIRECT - Route pour tester l'envoi d'email
     */
    public function testMail(Request $request)
    {
        try {
            // Créer un abonné test s'il n'existe pas
            $subscription = NewsletterSubscription::first();
            if (!$subscription) {
                $subscription = NewsletterSubscription::create([
                    'email' => 'test-' . time() . '@example.com',
                    'name' => 'Test User',
                    'status' => 'active',
                    'token' => Str::random(32),
                    'source' => 'test'
                ]);
            }

            // Créer une campagne test
            $campaign = NewsletterCampaign::create([
                'subject' => 'TEST EMAIL - ' . now()->format('H:i:s'),
                'content' => '<h2>Test d\'envoi d\'email</h2><p>Ceci est un email de test envoyé via Mailpit.</p><p>Variables testées: {name}, {email}, {unsubscribe_url}</p>',
                'template' => 'default',
                'status' => 'draft',
                'total_recipients' => 1,
            ]);

            Log::info('=== TEST DIRECT D\'ENVOI D\'EMAIL ===');
            Log::info('Envoi à: ' . $subscription->email);
            Log::info('Sujet: ' . $campaign->subject);

            // Envoyer l'email directement
            Mail::to($subscription->email)
                ->send(new NewsletterMail($campaign, $subscription));

            Log::info('✓ Email envoyé avec succès');

            return response()->json([
                'success' => true,
                'message' => 'Email de test envoyé avec succès !',
                'to' => $subscription->email,
                'mailpit_url' => 'http://localhost:8025',
                'logs' => 'Vérifiez storage/logs/laravel.log'
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur test email: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
