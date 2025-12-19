<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $categories = [
            'location' => 'Location',
            'vtc-transport' => 'VTC Transport',
            'conciergerie' => 'Conciergerie',
            'formation' => 'Formation',
        ];

        $icons = [
            'fa-car' => 'Voiture',
            'fa-taxi' => 'Taxi',
            'fa-bell' => 'Cloche',
            'fa-graduation-cap' => 'Diplôme',
            'fa-book' => 'Livre',
            'fa-chart-line' => 'Graphique',
            'fa-briefcase' => 'Porte-document',
            'fa-users' => 'Utilisateurs',
        ];

        $colors = [
            'yellow' => 'Jaune',
            'blue' => 'Bleu',
            'green' => 'Vert',
            'purple' => 'Violet',
            'red' => 'Rouge',
            'pink' => 'Rose',
            'indigo' => 'Indigo',
            'teal' => 'Sarcelle',
        ];

        return view('admin.articles.create', compact('categories', 'icons', 'colors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category' => 'required|in:location,vtc-transport,conciergerie,formation',
            'image' => 'nullable|image|max:2048',
            'icon' => 'nullable|string',
            'color' => 'nullable|string',
            'reading_time' => 'nullable|integer|min:1',
            'featured' => 'boolean',
            'published' => 'boolean',
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        // Définir la date de publication si publié
        if ($request->published) {
            $validated['published_at'] = now();
        }

        // Associer l'article à l'utilisateur connecté
        $validated['user_id'] = auth()->id();

        Article::create($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article créé avec succès.');
    }

    public function show(Article $article)
    {
        return view('admin.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = [
            'location' => 'Location',
            'vtc-transport' => 'VTC Transport',
            'conciergerie' => 'Conciergerie',
            'formation' => 'Formation',
        ];

        $icons = [
            'fa-car' => 'Voiture',
            'fa-taxi' => 'Taxi',
            'fa-bell' => 'Cloche',
            'fa-graduation-cap' => 'Diplôme',
            'fa-book' => 'Livre',
            'fa-chart-line' => 'Graphique',
            'fa-briefcase' => 'Porte-document',
            'fa-users' => 'Utilisateurs',
        ];

        $colors = [
            'yellow' => 'Jaune',
            'blue' => 'Bleu',
            'green' => 'Vert',
            'purple' => 'Violet',
            'red' => 'Rouge',
            'pink' => 'Rose',
            'indigo' => 'Indigo',
            'teal' => 'Sarcelle',
        ];

        return view('admin.articles.edit', compact('article', 'categories', 'icons', 'colors'));
    }

    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string',
            'content' => 'required|string',
            'category' => 'required|in:location,vtc-transport,conciergerie,formation',
            'image' => 'nullable|image|max:2048',
            'icon' => 'nullable|string',
            'color' => 'nullable|string',
            'reading_time' => 'nullable|integer|min:1',
            'featured' => 'boolean',
            'published' => 'boolean',
        ]);

        // Gestion de l'image
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($article->image) {
                Storage::disk('public')->delete($article->image);
            }
            $validated['image'] = $request->file('image')->store('articles', 'public');
        }

        // Mettre à jour la date de publication si l'article devient publié
        if ($request->published && !$article->published) {
            $validated['published_at'] = now();
        }

        $article->update($validated);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article mis à jour avec succès.');
    }

    public function destroy(Article $article)
    {
        // Supprimer l'image si elle existe
        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article supprimé avec succès.');
    }
}
