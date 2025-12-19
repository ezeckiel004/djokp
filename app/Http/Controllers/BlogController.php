<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $featuredArticles = Article::published()->featured()->latest()->take(2)->get();
        $articles = Article::published()->latest()->paginate(6);

        // Compter les articles par catégorie
        $categoryCounts = [
            'location' => Article::published()->byCategory('location')->count(),
            'vtc-transport' => Article::published()->byCategory('vtc-transport')->count(),
            'conciergerie' => Article::published()->byCategory('conciergerie')->count(),
            'formation' => Article::published()->byCategory('formation')->count(),
        ];

        return view('blog', compact('featuredArticles', 'articles', 'categoryCounts'));
    }

    public function show($slug)
    {
        $article = Article::published()->where('slug', $slug)->firstOrFail();

        // Articles similaires (même catégorie)
        $relatedArticles = Article::published()
            ->where('category', $article->category)
            ->where('id', '!=', $article->id)
            ->latest()
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'relatedArticles'));
    }

    public function category($category)
    {
        $articles = Article::published()
            ->byCategory($category)
            ->latest()
            ->paginate(9);

        $categoryLabel = [
            'location' => 'Location',
            'vtc-transport' => 'VTC Transport',
            'conciergerie' => 'Conciergerie',
            'formation' => 'Formation',
        ][$category] ?? $category;

        return view('articles.category', compact('articles', 'categoryLabel'));
    }
}
