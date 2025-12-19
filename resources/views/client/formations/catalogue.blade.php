@extends('layouts.client')

@section('title', 'Catalogue des Formations')
@section('page-title', 'Catalogue des Formations')
@section('page-description', 'Découvrez et inscrivez-vous à nos formations')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Formations</span>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span>Catalogue</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Filtres -->
    <div class="mb-8">
        <div class="bg-white shadow rounded-lg p-4">
            <div class="flex flex-wrap gap-4">
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                    data-filter="all">
                    Toutes les formations
                </button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition"
                    data-filter="presentiel">
                    Présentiel
                </button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition"
                    data-filter="elearning">
                    E-learning
                </button>
                <button class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition"
                    data-filter="mixte">
                    Mixte
                </button>
            </div>
        </div>
    </div>

    <!-- Formations E-learning -->
    @if($formationsElearning->count() > 0)
    <div class="mb-12 formation-section" data-type="elearning">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Formations en ligne (E-learning)</h2>
            <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
                {{ $formationsElearning->count() }} formation(s)
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($formationsElearning as $formation)
            @include('client.formations.partials.catalogue-card', ['formation' => $formation])
            @endforeach
        </div>
    </div>
    @endif

    <!-- Formations Présentiel -->
    @if($formationsPresentiel->count() > 0)
    <div class="mb-12 formation-section" data-type="presentiel">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Formations en présentiel</h2>
            <span class="bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded-full">
                {{ $formationsPresentiel->count() }} formation(s)
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($formationsPresentiel as $formation)
            @include('client.formations.partials.catalogue-card', ['formation' => $formation])
            @endforeach
        </div>
    </div>
    @endif

    <!-- Formations Mixte -->
    @if($formationsMixte->count() > 0)
    <div class="mb-12 formation-section" data-type="mixte">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Formations mixtes</h2>
            <span class="bg-purple-100 text-purple-800 text-sm font-medium px-3 py-1 rounded-full">
                {{ $formationsMixte->count() }} formation(s)
            </span>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($formationsMixte as $formation)
            @include('client.formations.partials.catalogue-card', ['formation' => $formation])
            @endforeach
        </div>
    </div>
    @endif

    <!-- Aucune formation -->
    @if($formationsElearning->count() == 0 && $formationsPresentiel->count() == 0 && $formationsMixte->count() == 0)
    <div class="text-center py-12">
        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">Aucune formation disponible</h3>
        <p class="mt-2 text-sm text-gray-500">
            Aucune formation n'est actuellement disponible dans le catalogue.
        </p>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Filtrage des formations
    const filterButtons = document.querySelectorAll('[data-filter]');
    const formationSections = document.querySelectorAll('.formation-section');

    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.dataset.filter;

            // Mettre à jour les boutons actifs
            filterButtons.forEach(btn => {
                if (btn.dataset.filter === filter) {
                    btn.classList.remove('bg-gray-200', 'text-gray-700');
                    btn.classList.add('bg-blue-600', 'text-white');
                } else {
                    btn.classList.remove('bg-blue-600', 'text-white');
                    btn.classList.add('bg-gray-200', 'text-gray-700');
                }
            });

            // Filtrer les sections
            formationSections.forEach(section => {
                if (filter === 'all' || section.dataset.type === filter) {
                    section.style.display = 'block';
                } else {
                    section.style.display = 'none';
                }
            });
        });
    });
});
</script>
@endpush
