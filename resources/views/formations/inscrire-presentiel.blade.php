@extends('layouts.main')

@section('title', 'Inscription ' . $formation->title . ' | DJOK PRESTIGE')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-yellow-600">Accueil</a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-xs mx-2"></i>
                        <a href="{{ route('formation') }}" class="hover:text-yellow-600">Formations</a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-xs mx-2"></i>
                        <span class="text-gray-900 font-medium">{{ $formation->title }}</span>
                    </li>
                </ol>
            </nav>

            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- En-tête -->
                <div class="bg-gradient-to-r from-yellow-600 to-yellow-700 px-8 py-6">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Inscription : {{ $formation->title }}
                    </h1>
                    <div class="flex items-center text-yellow-200">
                        <i class="fas fa-chalkboard-teacher mr-2"></i>
                        <span>Formation présentielle • {{ $formation->duree }}</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-8">
                    <!-- Colonne gauche : Détails formation -->
                    <div class="lg:col-span-2">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Formulaire d'inscription</h2>

                        @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
                                <div>
                                    <h4 class="font-bold text-green-800">Inscription envoyée !</h4>
                                    <p class="text-green-700">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
                                <div>
                                    <h4 class="font-bold text-red-800">Erreur</h4>
                                    <p class="text-red-700">{{ session('error') }}</p>
                                </div>
                            </div>
                        </div>
                        @endif

                        <form action="{{ route('formation.inscrire.presentiel.store', $formation->id) }}" method="POST">
                            @csrf

                            <div class="space-y-6">
                                <!-- Informations personnelles -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                        <i class="fas fa-user mr-2"></i>Informations personnelles
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-gray-700 mb-2">Nom *</label>
                                            <input type="text" name="nom" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('nom') border-red-500 @enderror"
                                                value="{{ old('nom') }}" placeholder="Votre nom">
                                            @error('nom')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 mb-2">Prénom *</label>
                                            <input type="text" name="prenom" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('prenom') border-red-500 @enderror"
                                                value="{{ old('prenom') }}" placeholder="Votre prénom">
                                            @error('prenom')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Contact -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                        <i class="fas fa-address-card mr-2"></i>Coordonnées
                                    </h3>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-gray-700 mb-2">Email *</label>
                                            <input type="email" name="email" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                                value="{{ old('email') }}" placeholder="votre@email.com">
                                            @error('email')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 mb-2">Téléphone *</label>
                                            <input type="tel" name="telephone" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('telephone') border-red-500 @enderror"
                                                value="{{ old('telephone') }}" placeholder="01 23 45 67 89">
                                            @error('telephone')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 mb-2">Adresse *</label>
                                            <input type="text" name="adresse" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('adresse') border-red-500 @enderror"
                                                value="{{ old('adresse') }}" placeholder="Numéro et nom de la rue">
                                            @error('adresse')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                            <div>
                                                <label class="block text-gray-700 mb-2">Code postal *</label>
                                                <input type="text" name="code_postal" required
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('code_postal') border-red-500 @enderror"
                                                    value="{{ old('code_postal') }}" placeholder="75001">
                                                @error('code_postal')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="md:col-span-2">
                                                <label class="block text-gray-700 mb-2">Ville *</label>
                                                <input type="text" name="ville" required
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('ville') border-red-500 @enderror"
                                                    value="{{ old('ville') }}" placeholder="Paris">
                                                @error('ville')
                                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Informations spécifiques -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                        <i class="fas fa-id-card mr-2"></i>Informations administratives
                                    </h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-gray-700 mb-2">Date de naissance *</label>
                                            <input type="date" name="date_naissance" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('date_naissance') border-red-500 @enderror"
                                                value="{{ old('date_naissance') }}"
                                                max="{{ date('Y-m-d', strtotime('-18 years')) }}">
                                            <small class="text-gray-500 text-sm">Vous devez avoir au moins 18
                                                ans</small>
                                            @error('date_naissance')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="block text-gray-700 mb-2">Date d'obtention du permis *</label>
                                            <input type="date" name="permis_date" required
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('permis_date') border-red-500 @enderror"
                                                value="{{ old('permis_date') }}" max="{{ date('Y-m-d') }}">
                                            <small class="text-gray-500 text-sm">Permis B depuis au moins 3 ans pour
                                                VTC</small>
                                            @error('permis_date')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Message -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                        <i class="fas fa-comment mr-2"></i>Informations complémentaires
                                    </h3>
                                    <div>
                                        <label class="block text-gray-700 mb-2">Message (optionnel)</label>
                                        <textarea name="message" rows="4"
                                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('message') border-red-500 @enderror"
                                            placeholder="Précisions, questions, disponibilités...">{{ old('message') }}</textarea>
                                        @error('message')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Financement -->
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">
                                        <i class="fas fa-euro-sign mr-2"></i>Financement
                                    </h3>
                                    <div class="space-y-3">
                                        <div
                                            class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                            <input type="radio" id="financement_perso" name="financement" value="perso"
                                                {{ old('financement', 'perso' )==='perso' ? 'checked' : '' }}
                                                class="h-5 w-5 text-yellow-600 focus:ring-yellow-500">
                                            <label for="financement_perso"
                                                class="ml-3 block text-gray-900 cursor-pointer">
                                                <span class="font-medium">Financement personnel</span>
                                                <p class="text-sm text-gray-600">Paiement direct</p>
                                            </label>
                                        </div>
                                        <div
                                            class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                            <input type="radio" id="financement_cpf" name="financement" value="cpf" {{
                                                old('financement')==='cpf' ? 'checked' : '' }}
                                                class="h-5 w-5 text-yellow-600 focus:ring-yellow-500">
                                            <label for="financement_cpf"
                                                class="ml-3 block text-gray-900 cursor-pointer">
                                                <span class="font-medium">CPF (Compte Personnel de Formation)</span>
                                                <p class="text-sm text-gray-600">Nous vous accompagnerons dans les
                                                    démarches</p>
                                            </label>
                                        </div>
                                        <div
                                            class="flex items-center p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200">
                                            <input type="radio" id="financement_pole_emploi" name="financement"
                                                value="pole_emploi" {{ old('financement')==='pole_emploi' ? 'checked'
                                                : '' }} class="h-5 w-5 text-yellow-600 focus:ring-yellow-500">
                                            <label for="financement_pole_emploi"
                                                class="ml-3 block text-gray-900 cursor-pointer">
                                                <span class="font-medium">Pôle Emploi</span>
                                                <p class="text-sm text-gray-600">Aide à la formation</p>
                                            </label>
                                        </div>
                                    </div>
                                    @error('financement')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- CGV -->
                                <div>
                                    <div class="flex items-start p-3 bg-gray-50 rounded-lg">
                                        <input type="checkbox" id="terms" name="terms" value="1" required {{
                                            old('terms') ? 'checked' : '' }}
                                            class="mt-1 mr-3 h-5 w-5 text-yellow-600 rounded focus:ring-yellow-500 @error('terms') border-red-500 @enderror">
                                        <label for="terms" class="text-gray-700">
                                            J'accepte les <a href="{{ route('cgu') }}" target="_blank"
                                                class="text-yellow-600 hover:underline font-medium">conditions générales
                                                d'utilisation</a>
                                            et j'ai pris connaissance de la <a href="{{ route('rgpd') }}"
                                                target="_blank"
                                                class="text-yellow-600 hover:underline font-medium">politique de
                                                confidentialité</a>.
                                        </label>
                                    </div>
                                    @error('terms')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Bouton de soumission -->
                                <div>
                                    <button type="submit"
                                        class="w-full py-4 bg-yellow-600 text-white font-bold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105 flex items-center justify-center disabled:opacity-50 disabled:cursor-not-allowed"
                                        id="submit-btn">
                                        <i class="fas fa-paper-plane mr-3"></i>
                                        <span id="submit-text">Envoyer ma demande d'inscription</span>
                                        <span id="loading-spinner" class="hidden ml-3">
                                            <i class="fas fa-spinner fa-spin"></i>
                                        </span>
                                    </button>
                                    <p class="text-center text-sm text-gray-600 mt-3">
                                        Notre équipe vous contactera sous 48h pour confirmer votre inscription.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Colonne droite : Récapitulatif -->
                    <div>
                        <div class="bg-gray-50 rounded-xl p-6 sticky top-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-6">Récapitulatif</h3>

                            <!-- Formation -->
                            <div class="mb-6 p-4 bg-white rounded-lg border border-gray-200">
                                <h4 class="font-bold text-gray-900 mb-2">{{ $formation->title }}</h4>
                                <div class="space-y-2 text-sm text-gray-600">
                                    <div class="flex justify-between">
                                        <span>Durée :</span>
                                        <span class="font-medium">{{ $formation->duree }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Format :</span>
                                        <span class="font-medium">{{ $formation->format_affichage }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Frais examen :</span>
                                        <span
                                            class="{{ $formation->frais_examen == 'Inclus' ? 'text-green-600' : 'text-gray-500' }}">
                                            {{ $formation->frais_examen }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-4 pt-4 border-t border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <span class="text-gray-700">Prix :</span>
                                        <span class="text-2xl font-bold text-yellow-600">
                                            {{ number_format($formation->price, 0, ',', ' ') }} €
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Avantages -->
                            <div class="mb-6">
                                <h4 class="font-bold text-gray-900 mb-3">Inclus dans votre formation</h4>
                                <ul class="space-y-2">
                                    @if($formation->included_services && count($formation->included_services) > 0)
                                    @foreach($formation->included_services as $service)
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        <span class="text-sm">{{ $service }}</span>
                                    </li>
                                    @endforeach
                                    @else
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        <span class="text-sm">Manuel de formation complet</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        <span class="text-sm">Support pédagogique</span>
                                    </li>
                                    <li class="flex items-center">
                                        <i class="fas fa-check text-green-500 mr-2"></i>
                                        <span class="text-sm">Accompagnement administratif</span>
                                    </li>
                                    @endif
                                </ul>
                            </div>

                            <!-- Procédure -->
                            <div class="mb-6">
                                <h4 class="font-bold text-gray-900 mb-3">Procédure d'inscription</h4>
                                <ol class="space-y-3 text-sm">
                                    <li class="flex items-start">
                                        <span
                                            class="flex-shrink-0 w-6 h-6 bg-yellow-100 text-yellow-800 rounded-full flex items-center justify-center mr-2 text-xs font-bold">1</span>
                                        <span>Remplissez ce formulaire</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span
                                            class="flex-shrink-0 w-6 h-6 bg-yellow-100 text-yellow-800 rounded-full flex items-center justify-center mr-2 text-xs font-bold">2</span>
                                        <span>Nous vous contactons sous 48h</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span
                                            class="flex-shrink-0 w-6 h-6 bg-yellow-100 text-yellow-800 rounded-full flex items-center justify-center mr-2 text-xs font-bold">3</span>
                                        <span>Validation de votre dossier</span>
                                    </li>
                                    <li class="flex items-start">
                                        <span
                                            class="flex-shrink-0 w-6 h-6 bg-yellow-100 text-yellow-800 rounded-full flex items-center justify-center mr-2 text-xs font-bold">4</span>
                                        <span>Démarrage de la formation</span>
                                    </li>
                                </ol>
                            </div>

                            <!-- Assistance -->
                            <div class="p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                                <h4 class="font-bold text-yellow-900 mb-2">Besoin d'aide ?</h4>
                                <p class="text-yellow-800 text-sm mb-3">
                                    Notre équipe est à votre disposition pour toute question.
                                </p>
                                <div class="space-y-2">
                                    <div class="flex items-center text-yellow-800">
                                        <i class="fas fa-phone-alt text-yellow-600 mr-2"></i>
                                        <span class="text-sm">01 76 38 00 17</span>
                                    </div>
                                    <div class="flex items-center text-yellow-800">
                                        <i class="fas fa-envelope text-yellow-600 mr-2"></i>
                                        <span class="text-sm">formation@djokprestige.com</span>
                                    </div>
                                    <div class="flex items-center text-yellow-800">
                                        <i class="fas fa-clock text-yellow-600 mr-2"></i>
                                        <span class="text-sm">Lun-Ven 9h-19h</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Retour -->
            <div class="mt-8 text-center">
                <a href="{{ route('formation') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition-all duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour aux formations
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitBtn = document.getElementById('submit-btn');
        const submitText = document.getElementById('submit-text');
        const loadingSpinner = document.getElementById('loading-spinner');
        const termsCheckbox = document.getElementById('terms');
        
        // Validation avant soumission
        form.addEventListener('submit', function(e) {
            // Vérifier les termes
            if (!termsCheckbox.checked) {
                e.preventDefault();
                alert('Veuillez accepter les conditions générales d\'utilisation.');
                termsCheckbox.focus();
                return false;
            }
            
            // Vérifier l'âge (au moins 18 ans)
            const dateNaissance = document.querySelector('input[name="date_naissance"]');
            if (dateNaissance.value) {
                const birthDate = new Date(dateNaissance.value);
                const today = new Date();
                let age = today.getFullYear() - birthDate.getFullYear();
                const monthDiff = today.getMonth() - birthDate.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                
                if (age < 18) {
                    e.preventDefault();
                    alert('Vous devez avoir au moins 18 ans pour vous inscrire à cette formation.');
                    dateNaissance.focus();
                    return false;
                }
            }
            
            // Vérifier que le permis a au moins 3 ans (pour VTC)
            const permisDate = document.querySelector('input[name="permis_date"]');
            if (permisDate.value) {
                const permis = new Date(permisDate.value);
                const today = new Date();
                let years = today.getFullYear() - permis.getFullYear();
                const monthDiff = today.getMonth() - permis.getMonth();
                if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < permis.getDate())) {
                    years--;
                }
                
                if (years < 3) {
                    if (!confirm('Le permis de conduire doit être obtenu depuis au moins 3 ans pour l\'examen VTC. Souhaitez-vous tout de même continuer ?')) {
                        e.preventDefault();
                        permisDate.focus();
                        return false;
                    }
                }
            }
            
            // Activer le loading
            submitBtn.disabled = true;
            submitText.textContent = 'Envoi en cours...';
            loadingSpinner.classList.remove('hidden');
            submitBtn.classList.add('opacity-75', 'cursor-wait');
        });
        
        // Validation en temps réel
        function validateField(field) {
            if (field.value.trim() === '') {
                field.classList.add('border-red-500');
                return false;
            } else {
                field.classList.remove('border-red-500');
                return true;
            }
        }
        
        // Écouter les changements sur les champs requis
        const requiredFields = form.querySelectorAll('input[required], textarea[required]');
        requiredFields.forEach(field => {
            field.addEventListener('blur', function() {
                validateField(this);
            });
        });
        
        // Mettre à jour l'état du bouton en fonction des termes
        termsCheckbox.addEventListener('change', function() {
            submitBtn.disabled = !this.checked;
        });
        
        // Initialiser l'état du bouton
        submitBtn.disabled = !termsCheckbox.checked;
        
        // Formatage automatique du téléphone
        const phoneInput = document.querySelector('input[name="telephone"]');
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 2) {
                value = value.match(/(\d{0,2})(\d{0,2})(\d{0,2})(\d{0,2})(\d{0,2})/);
                e.target.value = !value[2] ? value[1] : value[1] + ' ' + value[2] + (value[3] ? ' ' + value[3] : '') + (value[4] ? ' ' + value[4] : '') + (value[5] ? ' ' + value[5] : '');
            }
        });
        
        // Limiter la date de naissance (au moins 18 ans)
        const birthDateInput = document.querySelector('input[name="date_naissance"]');
        const maxBirthDate = new Date();
        maxBirthDate.setFullYear(maxBirthDate.getFullYear() - 18);
        birthDateInput.max = maxBirthDate.toISOString().split('T')[0];
        
        // Limiter la date du permis (pas dans le futur)
        const permisDateInput = document.querySelector('input[name="permis_date"]');
        const today = new Date().toISOString().split('T')[0];
        permisDateInput.max = today;
        
        // Auto-sélection de Paris pour le code postal
        const codePostalInput = document.querySelector('input[name="code_postal"]');
        const villeInput = document.querySelector('input[name="ville"]');
        
        codePostalInput.addEventListener('change', function() {
            const code = this.value.trim();
            if (code.startsWith('75')) {
                villeInput.value = 'Paris';
            }
        });
        
        // Restaurer les données en cas de retour arrière
        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                location.reload();
            }
        });
    });
</script>

<style>
    /* Styles pour les champs invalid */
    input:invalid,
    textarea:invalid {
        border-color: #f87171;
    }

    input:valid,
    textarea:valid {
        border-color: #d1d5db;
    }

    /* Animation du bouton */
    @keyframes pulse {

        0%,
        100% {
            opacity: 1;
        }

        50% {
            opacity: 0.8;
        }
    }

    #submit-btn:disabled {
        animation: pulse 2s infinite;
    }

    /* Style pour les radios sélectionnées */
    input[type="radio"]:checked+label {
        font-weight: 600;
    }

    /* Style pour les champs focus */
    .focus\:ring-yellow-500:focus {
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.3);
    }
</style>
@endsection