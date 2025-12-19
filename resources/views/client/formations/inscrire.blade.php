@extends('layouts.client')

@section('title', 'Inscription à la formation')
@section('page-title', 'Inscription à : ' . $formation->title)

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <a href="{{ route('client.formations.catalogue') }}" class="text-gray-500 hover:text-gray-700">
            Catalogue
        </a>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span>Inscription</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- En-tête -->
        <div class="bg-gradient-to-r
            @if($formation->type_formation === 'e_learning') from-blue-600 to-blue-800
            @elseif($formation->type_formation === 'presentiel') from-green-600 to-green-800
            @else from-purple-600 to-purple-800 @endif px-6 py-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $formation->title }}</h1>
                    <p class="text-blue-100 mt-2">{{ $formation->format_affichage }}</p>
                </div>
                <div class="text-right">
                    <div class="text-3xl font-bold text-white">{{ number_format($formation->price, 0, ',', ' ') }} €
                    </div>
                    <div class="text-blue-100">TTC</div>
                </div>
            </div>
        </div>

        <!-- Formulaire -->
        <div class="p-6">
            @if(session('error'))
            <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
                    <div>
                        <h4 class="font-bold text-red-800">Erreur</h4>
                        <p class="text-red-700">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('client.formations.inscrire.store', $formation) }}" method="POST">
                @csrf

                <!-- Informations utilisateur -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Vos informations</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                            <input type="text" value="{{ $user->name }}" disabled
                                class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" value="{{ $user->email }}" disabled
                                class="w-full px-4 py-2 bg-gray-100 border border-gray-300 rounded-lg">
                        </div>
                    </div>
                </div>

                <!-- Informations spécifiques pour présentiel -->
                @if($formation->type_formation === 'presentiel' || $formation->type_formation === 'mixte')
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations d'inscription</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nom *</label>
                            <input type="text" name="nom" value="{{ old('nom', $user->name) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            @error('nom')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Prénom *</label>
                            <input type="text" name="prenom" value="{{ old('prenom') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            @error('prenom')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Téléphone *</label>
                            <input type="tel" name="telephone" value="{{ old('telephone', $user->telephone) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            @error('telephone')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Date de naissance *</label>
                            <input type="date" name="date_naissance" value="{{ old('date_naissance') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            @error('date_naissance')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Adresse *</label>
                        <input type="text" name="adresse" value="{{ old('adresse', $user->adresse) }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        @error('adresse')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ville *</label>
                            <input type="text" name="ville" value="{{ old('ville', $user->ville) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            @error('ville')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Code postal *</label>
                            <input type="text" name="code_postal" value="{{ old('code_postal', $user->code_postal) }}"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            @error('code_postal')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Date d'obtention du permis B
                            *</label>
                        <input type="date" name="permis_date" value="{{ old('permis_date') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                        @error('permis_date')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Mode de financement *</label>
                        <select name="financement" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">Sélectionnez...</option>
                            <option value="perso" {{ old('financement')=='perso' ? 'selected' : '' }}>Financement
                                personnel</option>
                            <option value="cpf" {{ old('financement')=='cpf' ? 'selected' : '' }}>CPF</option>
                            <option value="pole_emploi" {{ old('financement')=='pole_emploi' ? 'selected' : '' }}>Pôle
                                Emploi</option>
                        </select>
                        @error('financement')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Message (optionnel)</label>
                        <textarea name="message" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('message') }}</textarea>
                        @error('message')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>
                    @endif

                    <!-- Conditions générales -->
                    <div class="mb-8">
                        <div class="flex items-start">
                            <input type="checkbox" name="terms" id="terms" required
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded mt-1">
                            <label for="terms" class="ml-2 text-sm text-gray-700">
                                J'accepte les
                                <a href="{{ route('cgu') }}" target="_blank" class="text-blue-600 hover:underline">
                                    conditions générales d'utilisation
                                </a>
                                et la
                                <a href="{{ route('rgpd') }}" target="_blank" class="text-blue-600 hover:underline">
                                    politique de confidentialité
                                </a>
                                . *
                            </label>
                        </div>
                        @error('terms')<p class="text-red-500 text-sm mt-1">{{ $message }}</p>@enderror
                    </div>

                    <!-- Boutons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('client.formations.catalogue') }}"
                            class="px-6 py-3 bg-gray-200 text-gray-700 font-semibold rounded-lg hover:bg-gray-300 transition text-center">
                            Annuler
                        </a>

                        <button type="submit" class="flex-1 px-6 py-3
                                   @if($formation->type_formation === 'e_learning') bg-green-600 hover:bg-green-700
                                   @else bg-yellow-600 hover:bg-yellow-700 @endif
                                   text-white font-semibold rounded-lg transition text-center">
                            <i class="fas
                            @if($formation->type_formation === 'e_learning') fa-shopping-cart
                            @else fa-user-plus @endif mr-2"></i>
                            {{ $formation->type_formation === 'e_learning' ? 'Procéder au paiement' : 'Confirmer
                            l\'inscription' }}
                        </button>
                    </div>
            </form>
        </div>
    </div>

    <!-- Informations complémentaires -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <h4 class="font-semibold text-blue-900 mb-2">
                <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                Informations importantes
            </h4>
            <ul class="text-sm text-blue-800 space-y-1">
                <li>• Les champs marqués d'un * sont obligatoires</li>
                <li>• Pour le présentiel : vous serez contacté pour planifier les sessions</li>
                <li>• Pour l'e-learning : accès immédiat après paiement</li>
                <li>• Un email de confirmation vous sera envoyé</li>
            </ul>
        </div>

        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <h4 class="font-semibold text-green-900 mb-2">
                <i class="fas fa-question-circle text-green-600 mr-2"></i>
                Besoin d'aide ?
            </h4>
            <p class="text-sm text-green-800 mb-2">
                Contactez notre service client :
            </p>
            <div class="text-sm text-green-700">
                <p><i class="fas fa-phone mr-2"></i> 01 76 38 00 17</p>
                <p><i class="fas fa-envelope mr-2"></i> formation@djokprestige.com</p>
            </div>
        </div>
    </div>
</div>
@endsection
