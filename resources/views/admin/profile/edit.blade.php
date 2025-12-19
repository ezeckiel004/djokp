@extends('layouts.admin')

@section('title', 'Mon Profil Admin')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- En-tête -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mon Profil Administrateur</h1>
            <p class="text-gray-600 mt-2">Gérez vos informations personnelles et la sécurité de votre compte
                administrateur</p>
        </div>

        <!-- Messages -->
        @if (session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                <span class="text-green-700">{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if (session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                <span class="text-red-700">{{ session('error') }}</span>
            </div>
        </div>
        @endif

        @if (session('info'))
        <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-info-circle text-blue-500 mr-3"></i>
                <span class="text-blue-700">{{ session('info') }}</span>
            </div>
        </div>
        @endif

        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
            <div class="flex items-center mb-2">
                <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                <span class="text-red-700 font-medium">Veuillez corriger les erreurs ci-dessous</span>
            </div>
            <ul class="text-red-600 text-sm list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Informations personnelles -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Photo et informations de base -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Informations personnelles</h2>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row gap-6 items-start">
                            <!-- Photo de profil -->
                            <div class="flex-shrink-0">
                                <div class="relative">
                                    <div
                                        class="w-32 h-32 rounded-full overflow-hidden bg-gradient-to-br from-yellow-400 to-yellow-600">
                                        @if($user->profile_photo_path &&
                                        Storage::disk('public')->exists($user->profile_photo_path))
                                        <img src="{{ Storage::url($user->profile_photo_path) }}" alt="{{ $user->name }}"
                                            class="w-full h-full object-cover">
                                        @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <span class="text-white text-4xl font-bold">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        @endif
                                    </div>
                                    @if($user->profile_photo_path)
                                    <form action="{{ route('admin.profile.photo.destroy') }}" method="POST"
                                        class="mt-3">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full px-3 py-1 text-sm text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition">
                                            Supprimer la photo
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>

                            <!-- Formulaire principal -->
                            <div class="flex-1">
                                <form method="POST" action="{{ route('admin.profile.update') }}"
                                    enctype="multipart/form-data" id="mainProfileForm">
                                    @csrf
                                    @method('PUT')

                                    <div class="space-y-4">
                                        <!-- Nom -->
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                                Nom complet *
                                            </label>
                                            <input type="text" id="name" name="name"
                                                value="{{ old('name', $user->name) }}" required
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                            @error('name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Email -->
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                                Adresse email *
                                            </label>
                                            <input type="email" id="email" name="email"
                                                value="{{ old('email', $user->email) }}" required
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                            @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror

                                            @if (!$user->hasVerifiedEmail())
                                            <div class="mt-2">
                                                <span class="text-sm text-yellow-600">
                                                    Email non vérifié
                                                </span>
                                                <form action="{{ route('admin.profile.verification.send') }}"
                                                    method="POST" class="inline ml-2">
                                                    @csrf
                                                    <button type="submit"
                                                        class="text-sm text-yellow-700 hover:text-yellow-800 underline">
                                                        Renvoyer l'email de vérification
                                                    </button>
                                                </form>
                                            </div>
                                            @endif
                                        </div>

                                        <!-- Téléphone -->
                                        <div>
                                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                                Téléphone
                                            </label>
                                            <input type="tel" id="phone" name="phone"
                                                value="{{ old('phone', $user->phone) }}"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                            @error('phone')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Photo de profil -->
                                        <div>
                                            <label for="profile_photo"
                                                class="block text-sm font-medium text-gray-700 mb-2">
                                                Changer la photo de profil
                                            </label>
                                            <input type="file" id="profile_photo" name="profile_photo" accept="image/*"
                                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                            <p class="mt-1 text-xs text-gray-500">PNG, JPG, JPEG jusqu'à 2MB</p>
                                            @error('profile_photo')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Bouton -->
                                        <div class="pt-4">
                                            <button type="submit"
                                                class="px-6 py-2 bg-yellow-600 text-white font-medium rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition">
                                                Mettre à jour le profil
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informations supplémentaires -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Informations supplémentaires</h2>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="{{ route('admin.profile.update') }}" id="additionalInfoForm">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Adresse -->
                                <div class="md:col-span-2">
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                        Adresse
                                    </label>
                                    <input type="text" id="address" name="address"
                                        value="{{ old('address', $user->address) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                    @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Ville -->
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                        Ville
                                    </label>
                                    <input type="text" id="city" name="city" value="{{ old('city', $user->city) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                    @error('city')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Pays -->
                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                                        Pays
                                    </label>
                                    <input type="text" id="country" name="country"
                                        value="{{ old('country', $user->country) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                    @error('country')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Date de naissance -->
                                <div>
                                    <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                                        Date de naissance
                                    </label>
                                    <input type="date" id="birth_date" name="birth_date"
                                        value="{{ old('birth_date', $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') : '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                    @error('birth_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Numéro CNI -->
                                <div>
                                    <label for="cni_number" class="block text-sm font-medium text-gray-700 mb-2">
                                        Numéro CNI
                                    </label>
                                    <input type="text" id="cni_number" name="cni_number"
                                        value="{{ old('cni_number', $user->cni_number) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                    @error('cni_number')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Permis de conduire -->
                                <div>
                                    <label for="driver_license" class="block text-sm font-medium text-gray-700 mb-2">
                                        Permis de conduire
                                    </label>
                                    <input type="text" id="driver_license" name="driver_license"
                                        value="{{ old('driver_license', $user->driver_license) }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                    @error('driver_license')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Bouton -->
                                <div class="md:col-span-2 pt-4">
                                    <button type="submit"
                                        class="px-6 py-2 bg-gray-800 text-white font-medium rounded-lg hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition">
                                        Mettre à jour les informations
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Sidebar (Mot de passe et actions) -->
            <div class="space-y-8">
                <!-- Changement de mot de passe -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Changer le mot de passe</h2>
                    </div>
                    <div class="p-6">
                        <form method="POST" action="{{ route('admin.profile.password.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="space-y-4">
                                <!-- Mot de passe actuel -->
                                <div>
                                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Mot de passe actuel *
                                    </label>
                                    <input type="password" id="current_password" name="current_password" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                    @error('current_password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nouveau mot de passe -->
                                <div>
                                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nouveau mot de passe *
                                    </label>
                                    <input type="password" id="password" name="password" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                    <p class="mt-1 text-xs text-gray-500">Minimum 8 caractères</p>
                                    @error('password')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Confirmation -->
                                <div>
                                    <label for="password_confirmation"
                                        class="block text-sm font-medium text-gray-700 mb-2">
                                        Confirmer le mot de passe *
                                    </label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                    @error('password_confirmation')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Bouton -->
                                <div class="pt-2">
                                    <button type="submit"
                                        class="w-full px-4 py-2 bg-yellow-600 text-white font-medium rounded-lg hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition">
                                        Changer le mot de passe
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Informations du compte -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Informations du compte</h2>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            <li class="flex justify-between">
                                <span class="text-gray-600">Rôle :</span>
                                <span class="font-medium text-gray-900">
                                    @if($user->role)
                                    {{ $user->role->name }}
                                    @else
                                    Administrateur
                                    @endif
                                </span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Compte créé le :</span>
                                <span class="font-medium text-gray-900">
                                    {{ $user->created_at ? $user->created_at->format('d/m/Y') : 'N/A' }}
                                </span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Dernière connexion :</span>
                                <span class="font-medium text-gray-900">
                                    @if($user->last_login_at)
                                    {{ \Carbon\Carbon::parse($user->last_login_at)->format('d/m/Y H:i') }}
                                    @else
                                    Jamais
                                    @endif
                                </span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Statut :</span>
                                <span
                                    class="font-medium {{ isset($user->is_active) && $user->is_active ? 'text-green-600' : 'text-red-600' }}">
                                    {{ isset($user->is_active) && $user->is_active ? 'Actif' : 'Inactif' }}
                                </span>
                            </li>
                            <li class="flex justify-between">
                                <span class="text-gray-600">Email vérifié :</span>
                                <span
                                    class="font-medium {{ $user->hasVerifiedEmail() ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $user->hasVerifiedEmail() ? 'Oui' : 'Non' }}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Actions rapides</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            <a href="{{ route('admin.dashboard') }}"
                                class="flex items-center px-4 py-3 bg-gray-50 hover:bg-gray-100 rounded-lg transition">
                                <i class="fas fa-tachometer-alt text-gray-600 mr-3"></i>
                                <span>Retour au tableau de bord</span>
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="w-full flex items-center px-4 py-3 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition">
                                    <i class="fas fa-sign-out-alt mr-3"></i>
                                    <span>Se déconnecter</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Zone de danger -->
                <div class="bg-red-50 rounded-xl shadow-sm border border-red-200">
                    <div class="px-6 py-5 border-b border-red-200">
                        <h2 class="text-xl font-semibold text-red-700">Zone de danger</h2>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-red-600 mb-4">
                            La suppression de votre compte est irréversible. Toutes vos données seront perdues.
                        </p>
                        <form method="POST" action="{{ route('admin.profile.destroy') }}" id="deleteAccountForm">
                            @csrf
                            @method('DELETE')
                            <div class="mb-4">
                                <label for="delete_password" class="block text-sm font-medium text-red-700 mb-2">
                                    Confirmez votre mot de passe
                                </label>
                                <input type="password" id="delete_password" name="password" required
                                    class="w-full px-4 py-2 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                @error('password')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="button" onclick="confirmDelete()"
                                class="w-full px-4 py-3 text-white bg-red-600 hover:bg-red-700 rounded-lg transition font-medium">
                                <i class="fas fa-trash mr-2"></i> Supprimer mon compte
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Aperçu de la photo de profil
    document.getElementById('profile_photo')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            const profileImage = document.querySelector('.w-32.h-32 img');

            reader.onload = function(e) {
                if (profileImage) {
                    profileImage.src = e.target.result;
                } else {
                    // Si pas d'image, créer une prévisualisation
                    const div = document.querySelector('.w-32.h-32 div');
                    if (div) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'w-full h-full object-cover';
                        div.parentNode.replaceChild(img, div);
                    }
                }
            }

            reader.readAsDataURL(file);
        }
    });

    // Confirmation avant suppression
    function confirmDelete() {
        const password = document.getElementById('delete_password').value;

        if (!password) {
            alert('Veuillez entrer votre mot de passe pour confirmer la suppression.');
            return;
        }

        if (confirm('⚠️ Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible et toutes vos données seront perdues.')) {
            document.getElementById('deleteAccountForm').submit();
        }
    }

    // Empêcher la soumission du formulaire si des champs requis sont vides
    document.addEventListener('DOMContentLoaded', function() {
        const mainForm = document.getElementById('mainProfileForm');
        const additionalForm = document.getElementById('additionalInfoForm');

        if (mainForm) {
            mainForm.addEventListener('submit', function(e) {
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;

                if (!name || !email) {
                    e.preventDefault();
                    alert('Les champs Nom et Email sont obligatoires.');
                }
            });
        }

        if (additionalForm) {
            // Pour le formulaire additionnel, on peut soumettre même si vide
            // car ce sont des champs optionnels
        }
    });

    // Auto-hide messages après 5 secondes
    setTimeout(() => {
        const messages = document.querySelectorAll('.bg-green-50, .bg-red-50, .bg-blue-50');
        messages.forEach(message => {
            message.style.opacity = '0';
            message.style.transition = 'opacity 0.5s ease';
            setTimeout(() => {
                if (message.parentNode) {
                    message.remove();
                }
            }, 500);
        });
    }, 5000);
</script>
@endpush
@endsection
