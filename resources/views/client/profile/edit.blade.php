{{-- resources/views/client/profile/edit.blade.php --}}
@extends('layouts.client')

@section('title', 'Modifier mon profil')
@section('page-title', 'Modifier mon profil')
@section('page-description', 'Mettez à jour vos informations personnelles')

@section('breadcrumb')
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Mon profil</span>
    </div>
</li>
<li>
    <div class="flex items-center">
        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
        <span class="text-gray-500">Modifier</span>
    </div>
</li>
@endsection

@section('content')
<div class="max-w-4xl mx-auto">
    {{-- Messages de succès/erreur --}}
    @if(session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-check-circle text-green-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-circle text-red-400"></i>
            </div>
            <div class="ml-3">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        </div>
    </div>
    @endif

    @if ($errors->any())
    <div class="mb-6 bg-red-50 border-l-4 border-red-400 p-4">
        <div class="flex">
            <div class="flex-shrink-0">
                <i class="fas fa-exclamation-triangle text-red-400"></i>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-red-800">Veuillez corriger les erreurs suivantes :</h3>
                <div class="mt-2 text-sm text-red-700">
                    <ul class="list-disc pl-5 space-y-1">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        {{-- En-tête --}}
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Informations personnelles</h2>
            <p class="text-gray-600 mt-1">Mettez à jour vos informations de contact</p>
        </div>

        {{-- Formulaire --}}
        <form action="{{ route('client.profile.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-8">
                {{-- Informations de base --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informations de base</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nom complet *
                            </label>
                            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email *
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}"
                                required
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Téléphone
                            </label>
                            <input type="tel" name="phone" id="phone" value="{{ old('phone', $user->phone) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                placeholder="+33 1 23 45 67 89">
                        </div>

                        <div>
                            <label for="birth_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Date de naissance
                            </label>
                            <input type="date" name="birth_date" id="birth_date"
                                value="{{ old('birth_date', $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                        </div>
                    </div>
                </div>

                {{-- Adresse --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Adresse</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="md:col-span-2">
                            <label for="address" class="block text-sm font-medium text-gray-700 mb-2">
                                Adresse
                            </label>
                            <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                placeholder="123 Rue de l'Exemple">
                        </div>

                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                Ville
                            </label>
                            <input type="text" name="city" id="city" value="{{ old('city', $user->city) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                placeholder="Paris">
                        </div>

                        <div>
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-2">
                                Pays
                            </label>
                            <input type="text" name="country" id="country" value="{{ old('country', $user->country) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                placeholder="France">
                        </div>
                    </div>
                </div>

                {{-- Documents --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Documents d'identité</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="cni_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Numéro CNI/Passeport
                            </label>
                            <input type="text" name="cni_number" id="cni_number"
                                value="{{ old('cni_number', $user->cni_number) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                placeholder="12AB34567 ou 123456789012">
                            <p class="mt-1 text-xs text-gray-500">
                                Format: 2 lettres + 5 chiffres (CNI) ou 12 chiffres (passeport)
                            </p>
                        </div>

                        <div>
                            <label for="driver_license" class="block text-sm font-medium text-gray-700 mb-2">
                                Numéro de permis de conduire
                            </label>
                            <input type="text" name="driver_license" id="driver_license"
                                value="{{ old('driver_license', $user->driver_license) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors"
                                placeholder="123456789012">
                            <p class="mt-1 text-xs text-gray-500">
                                12 chiffres
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Préférences --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Préférences</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <input type="checkbox" name="newsletter" id="newsletter" value="1" {{ old('newsletter',
                                $user->newsletter) ? 'checked' : '' }}
                            class="h-4 w-4 text-yellow-600 focus:ring-yellow-500 border-gray-300 rounded mt-1">
                            <label for="newsletter" class="ml-2 text-sm text-gray-700">
                                Je souhaite recevoir la newsletter de DJOK PRESTIGE (offres spéciales, actualités...)
                            </label>
                        </div>
                    </div>
                </div>

                {{-- Boutons d'action --}}
                <div class="pt-6 border-t border-gray-200 flex justify-between">
                    <div>
                        <a href="{{ route('client.dashboard') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                            <i class="fas fa-arrow-left mr-2"></i>Retour au tableau de bord
                        </a>
                    </div>

                    <div class="space-x-3">
                        <button type="reset"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                            <i class="fas fa-undo mr-2"></i>Réinitialiser
                        </button>

                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white text-sm font-medium rounded-md hover:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 transition-colors">
                            <i class="fas fa-save mr-2"></i>Enregistrer les modifications
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- Section changement de mot de passe --}}
    <div class="mt-8 bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Changer mon mot de passe</h2>
            <p class="text-gray-600 mt-1">Mettez à jour votre mot de passe de connexion</p>
        </div>

        <form action="{{ route('client.profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">
                @if(session('password_success'))
                <div class="bg-green-50 border-l-4 border-green-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-check-circle text-green-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">{{ session('password_success') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                @if(session('password_error'))
                <div class="bg-red-50 border-l-4 border-red-400 p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">{{ session('password_error') }}</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Mot de passe actuel *
                        </label>
                        <input type="password" name="current_password" id="current_password" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                    </div>

                    <div>
                        <label for="new_password" class="block text-sm font-medium text-gray-700 mb-2">
                            Nouveau mot de passe *
                        </label>
                        <input type="password" name="new_password" id="new_password" required minlength="8"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                    </div>

                    <div>
                        <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">
                            Confirmer le nouveau mot de passe *
                        </label>
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                            minlength="8"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500 transition-colors">
                    </div>
                </div>

                <div class="text-sm text-gray-500">
                    <i class="fas fa-info-circle mr-2"></i>
                    Le mot de passe doit contenir au moins 8 caractères.
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-gray-900 text-white text-sm font-medium rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors">
                        <i class="fas fa-key mr-2"></i>Changer le mot de passe
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Section informations du compte --}}
    <div class="mt-8 bg-white shadow rounded-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Informations du compte</h2>
            <p class="text-gray-600 mt-1">Statut et historique de votre compte</p>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Statut du compte</h3>
                    <div class="flex items-center">
                        @if($user->is_active)
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>Actif
                        </span>
                        @else
                        <span
                            class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times-circle mr-1"></i>Inactif
                        </span>
                        @endif
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Date d'inscription</h3>
                    <p class="text-sm text-gray-900">{{ $user->created_at->format('d/m/Y') }}</p>
                    <p class="text-xs text-gray-500">{{ $user->created_at->format('H:i') }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Dernière mise à jour</h3>
                    <p class="text-sm text-gray-900">{{ $user->updated_at->format('d/m/Y') }}</p>
                    <p class="text-xs text-gray-500">{{ $user->updated_at->format('H:i') }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4">
                    <h3 class="text-sm font-medium text-gray-500 mb-2">Dernière connexion</h3>
                    <p class="text-sm text-gray-900">
                        @if($user->last_login_at)
                        {{ \Carbon\Carbon::parse($user->last_login_at)->format('d/m/Y') }}
                        @else
                        <span class="text-gray-400">Jamais</span>
                        @endif
                    </p>
                    @if($user->last_login_at)
                    <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($user->last_login_at)->format('H:i') }}
                    </p>
                    @endif
                </div>
            </div>

            {{-- Rôle de l'utilisateur --}}
            <div class="mt-6">
                <h3 class="text-sm font-medium text-gray-500 mb-2">Type de compte</h3>
                <div class="flex items-center">
                    @if($user->isClient())
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-user mr-2"></i>Client
                    </span>
                    @elseif($user->isAdmin())
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        <i class="fas fa-crown mr-2"></i>Administrateur
                    </span>
                    @elseif($user->isChauffeur())
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        <i class="fas fa-car mr-2"></i>Chauffeur VTC
                    </span>
                    @elseif($user->isFormateur())
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                        <i class="fas fa-graduation-cap mr-2"></i>Formateur
                    </span>
                    @else
                    <span
                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                        <i class="fas fa-user mr-2"></i>{{ $user->getRoleName() ?? 'Utilisateur' }}
                    </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validation du formulaire principal
        const form = document.querySelector('form[action="{{ route("client.profile.update") }}"]');
        if (form) {
            form.addEventListener('submit', function(e) {
                const name = document.getElementById('name').value;
                const email = document.getElementById('email').value;

                if (!name || !email) {
                    e.preventDefault();
                    alert('Veuillez remplir les champs obligatoires (Nom et Email).');
                    return;
                }

                // Validation de l'email
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    e.preventDefault();
                    alert('Veuillez entrer une adresse email valide.');
                    return;
                }

                // Validation du numéro CNI (optionnel mais si rempli, doit être valide)
                const cniNumber = document.getElementById('cni_number').value;
                if (cniNumber) {
                    // Accepte: 2 lettres + 5 chiffres (CNI français) OU 9-12 chiffres (passeport)
                    const cniRegex = /^([A-Z]{2}\d{5}|\d{9,12})$/;
                    if (!cniRegex.test(cniNumber.toUpperCase())) {
                        e.preventDefault();
                        alert('Le numéro CNI/passeport doit être au format: 2 lettres suivies de 5 chiffres (ex: AB12345) ou 9 à 12 chiffres (passeport).');
                        return;
                    }
                }

                // Validation du permis (optionnel mais si rempli, doit être 12 chiffres)
                const driverLicense = document.getElementById('driver_license').value;
                if (driverLicense && !/^\d{12}$/.test(driverLicense)) {
                    e.preventDefault();
                    alert('Le numéro de permis doit contenir exactement 12 chiffres.');
                    return;
                }

                // Afficher un indicateur de chargement
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Enregistrement...';
                submitBtn.disabled = true;
            });
        }

        // Validation du formulaire de mot de passe
        const passwordForm = document.querySelector('form[action="{{ route("client.profile.password.update") }}"]');
        if (passwordForm) {
            passwordForm.addEventListener('submit', function(e) {
                const currentPassword = document.getElementById('current_password').value;
                const newPassword = document.getElementById('new_password').value;
                const confirmPassword = document.getElementById('new_password_confirmation').value;

                if (!currentPassword || !newPassword || !confirmPassword) {
                    e.preventDefault();
                    alert('Veuillez remplir tous les champs du mot de passe.');
                    return;
                }

                if (newPassword.length < 8) {
                    e.preventDefault();
                    alert('Le nouveau mot de passe doit contenir au moins 8 caractères.');
                    return;
                }

                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    alert('Les mots de passe ne correspondent pas.');
                    return;
                }

                // Afficher un indicateur de chargement
                const submitBtn = this.querySelector('button[type="submit"]');
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Changement en cours...';
                submitBtn.disabled = true;
            });
        }

        // Formatage du téléphone
        const phoneInput = document.getElementById('phone');
        if (phoneInput) {
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');

                if (value.length > 0) {
                    if (value.startsWith('33')) {
                        // Format français: +33 1 23 45 67 89
                        if (value.length <= 2) {
                            value = '+' + value;
                        } else if (value.length <= 4) {
                            value = '+' + value.substring(0, 2) + ' ' + value.substring(2, 3) + ' ' + value.substring(3);
                        } else if (value.length <= 6) {
                            value = '+' + value.substring(0, 2) + ' ' + value.substring(2, 3) + ' ' + value.substring(3, 5) + ' ' + value.substring(5);
                        } else if (value.length <= 8) {
                            value = '+' + value.substring(0, 2) + ' ' + value.substring(2, 3) + ' ' + value.substring(3, 5) + ' ' + value.substring(5, 7) + ' ' + value.substring(7);
                        } else {
                            value = '+' + value.substring(0, 2) + ' ' + value.substring(2, 3) + ' ' + value.substring(3, 5) + ' ' + value.substring(5, 7) + ' ' + value.substring(7, 9) + ' ' + value.substring(9, 11);
                        }
                    } else {
                        // Format international simple
                        if (value.length <= 3) {
                            value = '+' + value;
                        } else if (value.length <= 6) {
                            value = '+' + value.substring(0, 3) + ' ' + value.substring(3);
                        } else if (value.length <= 9) {
                            value = '+' + value.substring(0, 3) + ' ' + value.substring(3, 6) + ' ' + value.substring(6);
                        } else {
                            value = '+' + value.substring(0, 3) + ' ' + value.substring(3, 6) + ' ' + value.substring(6, 9) + ' ' + value.substring(9);
                        }
                    }
                }

                e.target.value = value;
            });
        }

        // Formatage CNI en majuscules
        const cniInput = document.getElementById('cni_number');
        if (cniInput) {
            cniInput.addEventListener('input', function(e) {
                // Convertir en majuscules
                e.target.value = e.target.value.toUpperCase();
            });
        }

        // Validation et formatage du permis (uniquement chiffres)
        const licenseInput = document.getElementById('driver_license');
        if (licenseInput) {
            licenseInput.addEventListener('input', function(e) {
                // Ne garder que les chiffres
                e.target.value = e.target.value.replace(/\D/g, '');

                // Limiter à 12 chiffres
                if (e.target.value.length > 12) {
                    e.target.value = e.target.value.substring(0, 12);
                }
            });
        }

        // Prévisualisation de la date de naissance
        const birthDateInput = document.getElementById('birth_date');
        if (birthDateInput) {
            // Calculer la date maximale (aujourd'hui - 16 ans)
            const today = new Date();
            const minDate = new Date();
            minDate.setFullYear(today.getFullYear() - 100); // 100 ans max

            const maxDate = new Date();
            maxDate.setFullYear(today.getFullYear() - 16); // 16 ans minimum

            birthDateInput.min = minDate.toISOString().split('T')[0];
            birthDateInput.max = maxDate.toISOString().split('T')[0];
        }

        // Afficher les valeurs actuelles dans la console pour débogage
        console.log('Données utilisateur:', {
            name: '{{ $user->name }}',
            email: '{{ $user->email }}',
            phone: '{{ $user->phone }}',
            address: '{{ $user->address }}',
            city: '{{ $user->city }}',
            country: '{{ $user->country }}',
            birth_date: '{{ $user->birth_date }}',
            cni_number: '{{ $user->cni_number }}',
            driver_license: '{{ $user->driver_license }}',
            newsletter: {{ $user->newsletter ? 'true' : 'false' }},
            is_active: {{ $user->is_active ? 'true' : 'false' }},
            last_login_at: '{{ $user->last_login_at }}'
        });
    });
</script>
@endpush
