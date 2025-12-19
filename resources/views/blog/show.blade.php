@extends('layouts.main')

@section('title', 'Blog - DJOK PRESTIGE')

@section('content')
@php
// Données fictives pour la page blog
$articlesData = collect([
(object)[
'id' => 1,
'titre' => 'Guide complet de la location premium',
'excerpt' => 'Tout ce que vous devez savoir pour louer un véhicule haut de gamme.',
'service' => (object)['name' => 'Location', 'color' => 'yellow', 'icon' => 'car'],
'publie_le' => now()->subDays(2),
'reading_time' => 4,
'image' => null
],
(object)[
'id' => 2,
'titre' => 'Transport VTC : le luxe accessible',
'excerpt' => 'Découvrez nos services de transport VTC premium.',
'service' => (object)['name' => 'VTC Transport', 'color' => 'blue', 'icon' => 'taxi'],
'publie_le' => now()->subDays(5),
'reading_time' => 3,
'image' => null
],
(object)[
'id' => 3,
'titre' => 'Conciergerie : simplifiez-vous la vie',
'excerpt' => 'Comment notre service de conciergerie peut vous aider au quotidien.',
'service' => (object)['name' => 'Conciergerie', 'color' => 'green', 'icon' => 'bell'],
'publie_le' => now()->subDays(8),
'reading_time' => 5,
'image' => null
]
]);

$featuredData = $articlesData->first();
$servicesData = collect([
(object)['id' => 1, 'name' => 'Location', 'color' => 'yellow', 'icon' => 'car', 'articles_count' => 5],
(object)['id' => 2, 'name' => 'VTC Transport', 'color' => 'blue', 'icon' => 'taxi', 'articles_count' => 3],
(object)['id' => 3, 'name' => 'Conciergerie', 'color' => 'green', 'icon' => 'bell', 'articles_count' => 4],
]);
@endphp

<!-- Votre contenu existant pour blog.blade.php -->
<!-- ... -->

<!-- Section des articles -->
<section class="py-12">
    <div class="container mx-auto px-4">
        <!-- Votre code Alpine.js et HTML existant -->
        <!-- ... -->

        <div x-data="blogSearch()" x-init="init()">
            <!-- Les variables sont maintenant définies dans $articlesData, $featuredData, $servicesData -->
        </div>
    </div>
</section>
@endsection
