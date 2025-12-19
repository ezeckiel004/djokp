@extends('layouts.admin')

@section('title', 'Détails du paiement #' . $paiement->reference . ' | Admin DJOK PRESTIGE')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Détails du paiement</h1>
                <p class="text-gray-600 mt-1">Référence : {{ $paiement->reference }}</p>
            </div>
            <div>
                <a href="{{ route('admin.paiements.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Retour aux paiements
                </a>
            </div>
        </div>
    </div>

    <!-- Messages d'alerte -->
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-check-circle text-green-600 text-xl mr-3"></i>
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-exclamation-circle text-red-600 text-xl mr-3"></i>
            <p class="text-red-800 font-medium">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Information principale -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <!-- Header du paiement -->
                <div class="p-6 border-b border-gray-200">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="flex items-center mb-2">
                                <div class="text-2xl font-bold text-gray-900">{{ number_format($paiement->amount, 0,
                                    ',', ' ') }} €</div>
                                <div class="ml-3">
                                    <span
                                        class="px-3 py-1 text-xs font-semibold rounded-full {{ $paiement->status_color }}">
                                        {{ $paiement->formatted_status }}
                                    </span>
                                </div>
                            </div>
                            <p class="text-gray-600">Formation :
                                <span class="font-semibold">
                                    @if($paiement->formation)
                                    {{ $paiement->formation->title }}
                                    @else
                                    <span class="text-red-500">Formation supprimée</span>
                                    @endif
                                </span>
                            </p>
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500">Date création</div>
                            <div class="font-semibold">{{ $paiement->created_at->format('d/m/Y H:i') }}</div>
                            @if($paiement->paid_at)
                            <div class="text-sm text-gray-500 mt-2">Date paiement</div>
                            <div class="font-semibold">{{ $paiement->paid_at->format('d/m/Y H:i') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Détails -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Informations client -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations client</h3>
                            <div class="space-y-3">
                                <!-- Type d'achat -->
                                <div>
                                    @if($paiement->isLinkedToAccount())
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-user-check mr-1"></i> Achat avec compte
                                    </span>
                                    @else
                                    <span
                                        class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                        <i class="fas fa-user-clock mr-1"></i> Achat sans compte
                                    </span>
                                    @endif
                                </div>

                                <!-- Nom -->
                                <div>
                                    <div class="text-sm text-gray-500">Nom</div>
                                    <div class="font-medium">{{ $paiement->customer_name }}</div>
                                </div>

                                <!-- Email -->
                                <div>
                                    <div class="text-sm text-gray-500">Email</div>
                                    <div class="font-medium">{{ $paiement->customer_email ?? 'Non fourni' }}</div>
                                </div>

                                <!-- Compte client -->
                                @if($paiement->user)
                                <div>
                                    <div class="text-sm text-gray-500">Compte client</div>
                                    <div>
                                        <a href="{{ route('admin.users.show', $paiement->user_id) }}"
                                            class="text-blue-600 hover:text-blue-800 font-medium">
                                            <i class="fas fa-user mr-1"></i>{{ $paiement->user->name }}
                                        </a>
                                        <span class="text-xs text-gray-500 ml-2">(ID: {{ $paiement->user->id }})</span>
                                    </div>
                                </div>
                                @elseif($paiement->customer_email)
                                <div>
                                    <div class="text-sm text-gray-500">Statut compte</div>
                                    <div class="flex items-center">
                                        <span class="text-yellow-600 font-medium mr-2">
                                            <i class="fas fa-exclamation-triangle mr-1"></i>Aucun compte
                                        </span>
                                        <button
                                            onclick="suggestAccountCreation('{{ $paiement->customer_email }}', '{{ $paiement->customer_name }}')"
                                            class="text-xs bg-blue-50 text-blue-700 px-2 py-1 rounded hover:bg-blue-100">
                                            <i class="fas fa-user-plus mr-1"></i>Créer compte
                                        </button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>

                        <!-- Informations transaction -->
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations transaction</h3>
                            <div class="space-y-3">
                                <div>
                                    <div class="text-sm text-gray-500">Référence</div>
                                    <div class="font-mono text-sm bg-gray-50 p-2 rounded">{{ $paiement->reference }}
                                    </div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">ID Session Stripe</div>
                                    <div class="font-mono text-xs bg-gray-50 p-2 rounded">{{
                                        $paiement->stripe_session_id ?? 'N/A' }}</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">ID Paiement Stripe</div>
                                    <div class="font-mono text-xs bg-gray-50 p-2 rounded">{{
                                        $paiement->stripe_payment_intent_id ?? 'N/A' }}</div>
                                </div>
                                <div>
                                    <div class="text-sm text-gray-500">Devise</div>
                                    <div class="font-medium">{{ strtoupper($paiement->currency) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formation -->
                    @if($paiement->formation)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Formation associée</h3>
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">{{ $paiement->formation->title }}</h4>
                                <div class="flex flex-wrap items-center mt-2 text-sm text-gray-600 gap-2">
                                    <span class="px-2 py-1 bg-gray-100 rounded">
                                        <i class="fas fa-clock mr-1"></i>{{ $paiement->formation->duration_hours }}h
                                    </span>
                                    <span class="px-2 py-1 bg-gray-100 rounded">
                                        <i class="fas fa-chalkboard-teacher mr-1"></i>{{
                                        $paiement->formation->format_affichage ??
                                        ucfirst($paiement->formation->format_type) }}
                                    </span>
                                    <span class="px-2 py-1 bg-gray-100 rounded">
                                        @if($paiement->formation->type_formation === 'e_learning')
                                        <i class="fas fa-laptop mr-1"></i>E-learning
                                        @else
                                        <i class="fas fa-users mr-1"></i>Présentiel
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div>
                                <a href="{{ route('admin.formations.show', $paiement->formation_id) }}"
                                    class="text-blue-600 hover:text-blue-800 p-2 rounded hover:bg-blue-50">
                                    <i class="fas fa-external-link-alt"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Inscriptions et accès -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Inscriptions et accès</h3>

                        @if($paiement->user && $userFormations->count() > 0)
                        <!-- Cas 1: Utilisateur avec compte et inscriptions -->
                        <div class="space-y-3">
                            @foreach($userFormations as $userFormation)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="font-medium mb-2">Inscription utilisateur</div>
                                        <div class="flex items-center mb-2">
                                            <span class="text-sm text-gray-600 mr-3">
                                                Statut :
                                                <span
                                                    class="font-semibold {{ $userFormation->status === 'active' ? 'text-green-600' : ($userFormation->status === 'refunded' ? 'text-purple-600' : 'text-gray-600') }}">
                                                    @if($userFormation->status === 'active')
                                                    Actif
                                                    @elseif($userFormation->status === 'refunded')
                                                    Remboursé
                                                    @else
                                                    {{ $userFormation->status }}
                                                    @endif
                                                </span>
                                            </span>
                                            <span class="text-sm text-gray-600">
                                                Progression : <span class="font-semibold">{{ $userFormation->progress
                                                    }}%</span>
                                            </span>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            Accès du {{ $userFormation->access_start->format('d/m/Y') }} au {{
                                            $userFormation->access_end->format('d/m/Y') }}
                                        </div>
                                    </div>
                                    @if($userFormation->status === 'active')
                                    <a href="{{ route('admin.users.show', $paiement->user_id) }}?tab=formations"
                                        class="text-blue-600 hover:text-blue-800 text-sm">
                                        <i class="fas fa-external-link-alt mr-1"></i>Gérer
                                    </a>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @elseif($participant)
                        <!-- Cas 2: Visiteur avec inscription participant -->
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                            <div class="flex items-start">
                                <i class="fas fa-user-clock text-blue-600 mt-1 mr-3"></i>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-blue-800 mb-2">Inscription visiteur</h4>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-3">
                                        <div>
                                            <div class="text-sm text-gray-600">Statut</div>
                                            <div class="font-medium">
                                                @if($participant->statut === 'confirme')
                                                <span class="text-green-600">Confirmé</span>
                                                @elseif($participant->statut === 'en_attente')
                                                <span class="text-yellow-600">En attente</span>
                                                @elseif($participant->statut === 'annule')
                                                <span class="text-red-600">Annulé</span>
                                                @else
                                                {{ $participant->statut }}
                                                @endif
                                            </div>
                                        </div>
                                        <div>
                                            <div class="text-sm text-gray-600">Progression</div>
                                            <div class="font-medium">{{ $participant->progression }}%</div>
                                        </div>
                                        @if($participant->date_debut)
                                        <div>
                                            <div class="text-sm text-gray-600">Date début</div>
                                            <div class="font-medium">{{ $participant->date_debut->format('d/m/Y') }}
                                            </div>
                                        </div>
                                        @endif
                                        @if($participant->date_fin)
                                        <div>
                                            <div class="text-sm text-gray-600">Date fin</div>
                                            <div class="font-medium">{{ $participant->date_fin->format('d/m/Y') }}</div>
                                        </div>
                                        @endif
                                    </div>

                                    @if($paiement->customer_email)
                                    <div class="text-sm text-gray-700 mb-3">
                                        <i class="fas fa-envelope mr-1"></i>
                                        Email : <span class="font-medium">{{ $paiement->customer_email }}</span>
                                    </div>
                                    @endif

                                    @if($participant->notes)
                                    <div>
                                        <div class="text-sm text-gray-600 mb-1">Notes</div>
                                        <div class="text-sm text-gray-700 bg-white p-3 rounded border">{{
                                            $participant->notes }}</div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Cas 3: Aucune inscription trouvée -->
                        <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-yellow-600 mr-3"></i>
                                <div>
                                    <p class="text-yellow-800 font-medium">Aucune inscription trouvée</p>
                                    <p class="text-yellow-700 text-sm mt-1">
                                        Aucune inscription n'a été trouvée pour ce paiement.
                                        Cela peut arriver si l'inscription n'a pas encore été créée ou si elle a été
                                        supprimée.
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions sidebar -->
        <div class="space-y-6">
            <!-- Actions -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>

                <!-- Accès rapide -->
                <div class="space-y-3 mb-6">
                    @if($paiement->user_id)
                    <a href="{{ route('admin.users.show', $paiement->user_id) }}"
                        class="w-full flex items-center justify-center px-4 py-2.5 bg-blue-50 text-blue-700 rounded-lg hover:bg-blue-100 transition-colors">
                        <i class="fas fa-user mr-2"></i>
                        Voir le client
                    </a>
                    @endif

                    @if($paiement->formation_id)
                    <a href="{{ route('admin.formations.show', $paiement->formation_id) }}"
                        class="w-full flex items-center justify-center px-4 py-2.5 bg-green-50 text-green-700 rounded-lg hover:bg-green-100 transition-colors">
                        <i class="fas fa-graduation-cap mr-2"></i>
                        Voir la formation
                    </a>
                    @endif
                </div>

                <!-- Gestion du paiement -->
                <div class="border-t border-gray-200 pt-6">
                    <h4 class="font-semibold text-gray-900 mb-3">Gestion du paiement</h4>

                    @if($paiement->isPaid())
                    <!-- Remboursement -->
                    <div class="mb-4">
                        <button type="button"
                            onclick="document.getElementById('refundModal').classList.remove('hidden')"
                            class="w-full flex items-center justify-center px-4 py-2.5 bg-red-50 text-red-700 rounded-lg hover:bg-red-100 transition-colors">
                            <i class="fas fa-undo mr-2"></i>
                            Effectuer un remboursement
                        </button>
                    </div>
                    @endif

                    <!-- Télécharger reçu -->
                    @if($paiement->isPaid() || $paiement->isRefunded())
                    <div class="mb-4">
                        <button type="button" onclick="generateReceipt()"
                            class="w-full flex items-center justify-center px-4 py-2.5 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-colors">
                            <i class="fas fa-receipt mr-2"></i>
                            Générer un reçu
                        </button>
                    </div>
                    @endif
                </div>

                <!-- Données techniques -->
                <div class="border-t border-gray-200 pt-6">
                    <details class="group">
                        <summary class="flex items-center cursor-pointer text-sm text-gray-600 hover:text-gray-900">
                            <i class="fas fa-code mr-2"></i>
                            <span>Données techniques</span>
                            <i class="fas fa-chevron-down ml-auto group-open:rotate-180 transition-transform"></i>
                        </summary>
                        <div class="mt-3">
                            <pre
                                class="text-xs bg-gray-50 p-3 rounded-lg overflow-x-auto max-h-64 overflow-y-auto">{{ json_encode($paiement->stripe_response ?? [], JSON_PRETTY_PRINT) }}</pre>
                        </div>
                    </details>
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Historique</h3>
                <div class="space-y-4">
                    <!-- Création -->
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-8 w-8 rounded-full bg-gray-100 flex items-center justify-center mr-3">
                            <i class="fas fa-plus text-gray-600 text-sm"></i>
                        </div>
                        <div>
                            <div class="font-medium">Paiement créé</div>
                            <div class="text-sm text-gray-500">{{ $paiement->created_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>

                    <!-- Paiement -->
                    @if($paiement->paid_at)
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-8 w-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                            <i class="fas fa-euro-sign text-green-600 text-sm"></i>
                        </div>
                        <div>
                            <div class="font-medium">Paiement validé</div>
                            <div class="text-sm text-gray-500">{{ $paiement->paid_at->format('d/m/Y H:i') }}</div>
                        </div>
                    </div>
                    @endif

                    <!-- Remboursement -->
                    @if($paiement->refunded_at)
                    <div class="flex items-start">
                        <div
                            class="flex-shrink-0 h-8 w-8 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                            <i class="fas fa-undo text-purple-600 text-sm"></i>
                        </div>
                        <div>
                            <div class="font-medium">Remboursement</div>
                            <div class="text-sm text-gray-500">{{ $paiement->refunded_at->format('d/m/Y H:i') }}</div>
                            @if($paiement->refund_reason)
                            <div class="text-sm text-gray-600 mt-1">{{ $paiement->refund_reason }}</div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de remboursement -->
<div id="refundModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-xl bg-white">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Confirmer le remboursement</h3>
            <button type="button" onclick="document.getElementById('refundModal').classList.add('hidden')"
                class="text-gray-400 hover:text-gray-500">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <form action="{{ route('admin.paiements.refund', $paiement) }}" method="POST">
            @csrf
            @method('POST')

            <div class="mb-4">
                <label for="reason" class="block text-sm font-medium text-gray-700 mb-2">Raison du remboursement</label>
                <textarea name="reason" id="reason" rows="3"
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Optionnel - Ex: Demande du client, erreur de facturation..."></textarea>
            </div>

            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-triangle text-yellow-600 mr-2"></i>
                    <p class="text-sm text-yellow-800">
                        <strong>Attention :</strong> Cette action est irréversible.
                        Le client sera remboursé via Stripe et perdra l'accès à la formation.
                    </p>
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <button type="button" onclick="document.getElementById('refundModal').classList.add('hidden')"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                    Annuler
                </button>
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors">
                    Confirmer le remboursement
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Masquer le modal si on clique en dehors
    document.getElementById('refundModal').addEventListener('click', function(e) {
        if (e.target === this) {
            this.classList.add('hidden');
        }
    });

    // Suggérer la création de compte
    function suggestAccountCreation(email, name) {
        if (confirm('Voulez-vous créer un compte pour ce client ?\n\nEmail: ' + email + '\nNom: ' + name)) {
            // Rediriger vers la création d'utilisateur avec les informations pré-remplies
            window.location.href = '{{ route("admin.users.create") }}?email=' + encodeURIComponent(email) + '&name=' + encodeURIComponent(name);
        }
    }

    // Générer un reçu
    function generateReceipt() {
        const url = '{{ route("admin.paiements.show", $paiement) }}/receipt';
        window.open(url, '_blank');
    }

    // Formater la date
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('fr-FR', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric',
            hour: '2-digit',
            minute: '2-digit'
        });
    }
</script>
@endsection
