<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|max:255',
            'name' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        // Vérifier si l'email est déjà inscrit
        $existing = NewsletterSubscription::where('email', $data['email'])->first();

        if ($existing) {
            if ($existing->status === 'unsubscribed') {
                // Réinscrire
                $existing->resubscribe();
                $message = 'Vous avez été réinscrit à notre newsletter avec succès !';
            } else {
                $message = 'Vous êtes déjà inscrit à notre newsletter.';
            }
        } else {
            // Nouvelle inscription
            NewsletterSubscription::create([
                'email' => $data['email'],
                'name' => $data['name'] ?? null,
                'source' => $request->headers->get('referer') ?? 'direct',
                'token' => Str::random(32),
                'status' => 'confirmed', // Double opt-out désactivé pour simplifier
                'confirmed_at' => now(),
                'is_active' => true
            ]);

            $message = 'Merci pour votre inscription à notre newsletter !';
        }

        return redirect()->back()
            ->with('success', $message)
            ->with('newsletter_success', true);
    }

    public function unsubscribe($token)
    {
        $subscription = NewsletterSubscription::where('token', $token)->first();

        if (!$subscription) {
            return view('newsletter.unsubscribe-error');
        }

        $subscription->unsubscribe();

        return view('newsletter.unsubscribe-success', [
            'email' => $subscription->email
        ]);
    }

    public function confirm($token)
    {
        $subscription = NewsletterSubscription::where('token', $token)
            ->where('status', 'pending')
            ->first();

        if (!$subscription) {
            return view('newsletter.confirm-error');
        }

        $subscription->confirm();

        return view('newsletter.confirm-success', [
            'email' => $subscription->email
        ]);
    }
}
