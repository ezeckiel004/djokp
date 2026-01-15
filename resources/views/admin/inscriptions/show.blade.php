@extends('layouts.admin')

@section('title', 'Inscription #' . $inscription->id)

@section('page-title', 'Détails de l\'inscription')

@section('content')
<div class="bg-white shadow rounded-lg overflow-hidden">
    <!-- En-tête -->
    <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-gray-900">
                    Inscription #{{ $inscription->id }}
                </h3>
                <p class="mt-1 text-sm text-gray-500">
                    Créée le {{ $inscription->created_at->format('d/m/Y à H:i') }}
                    @if($inscription->updated_at->gt($inscription->created_at))
                    | Modifiée le {{ $inscription->updated_at->format('d/m/Y à H:i') }}
                    @endif
                </p>
            </div>
            <div class="flex items-center space-x-3">
                <span
                    class="badge {{ $inscription->status == 'pending' ? 'badge-warning' : ($inscription->status == 'confirmed' ? 'badge-info' : ($inscription->status == 'in_progress' ? 'badge-primary' : ($inscription->status == 'completed' ? 'badge-success' : 'badge-danger'))) }}">
                    {{ $statuses[$inscription->status] }}
                </span>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.inscriptions.edit', $inscription) }}"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-djok-yellow hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-edit mr-2"></i> Modifier
                    </a>

                    <!-- Bouton pour renvoyer l'email de statut -->
                    <button type="button" onclick="resendStatusEmail()"
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        <i class="fas fa-paper-plane mr-2"></i> Renvoyer l'email
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="px-4 py-5 sm:p-6">
        <!-- Notification d'email envoyé -->
        <div id="email-notification" class="hidden mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex items-center">
                <i class="fas fa-check-circle text-green-600 mr-3"></i>
                <div>
                    <p class="font-medium text-green-800">Email envoyé</p>
                    <p id="email-message" class="text-green-700"></p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Informations étudiant -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Informations étudiant</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Nom complet</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $inscription->user->name }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Email</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $inscription->user->email }}</p>
                        <a href="mailto:{{ $inscription->user->email }}"
                            class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-envelope mr-1"></i> Envoyer un email
                        </a>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Téléphone</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $inscription->user->phone ?? 'Non renseigné' }}</p>
                        @if($inscription->user->phone)
                        <a href="tel:{{ $inscription->user->phone }}" class="text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-phone mr-1"></i> Appeler
                        </a>
                        @endif
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date de naissance</p>
                        <p class="mt-1 text-sm text-gray-900">
                            {{ $inscription->user->birth_date ? $inscription->user->birth_date->format('d/m/Y') : 'Non
                            renseigné' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Informations formation -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Informations formation</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Formation</p>
                        <p class="mt-1 text-sm font-semibold text-gray-900">{{ $inscription->formation->title }}</p>
                        <p class="mt-1 text-sm text-gray-600">{{ $inscription->formation->type }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Prix formation</p>
                        <p class="mt-1 text-sm text-gray-900">{{ number_format($inscription->formation->price, 2) }}€
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Description</p>
                        <p class="mt-1 text-sm text-gray-900">{{ Str::limit($inscription->formation->description, 200)
                            }}</p>
                    </div>
                    <div>
                        <a href="{{ route('formation.show', $inscription->formation->slug) }}" target="_blank"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm">
                            <i class="fas fa-external-link-alt mr-1"></i> Voir la formation
                        </a>
                    </div>
                </div>
            </div>

            <!-- Dates et statut -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Dates et statut</h4>
                <div class="space-y-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Statut</p>
                        <span
                            class="mt-1 inline-flex px-3 py-1 rounded-full text-sm font-medium {{ $inscription->status == 'pending' ? 'bg-yellow-100 text-yellow-800' : ($inscription->status == 'confirmed' ? 'bg-blue-100 text-blue-800' : ($inscription->status == 'in_progress' ? 'bg-purple-100 text-purple-800' : ($inscription->status == 'completed' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'))) }}">
                            {{ $statuses[$inscription->status] }}
                        </span>
                    </div>
                    @if($inscription->start_date)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date de début</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $inscription->start_date->format('d/m/Y') }}</p>
                    </div>
                    @endif
                    @if($inscription->end_date)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Date de fin</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $inscription->end_date->format('d/m/Y') }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-500">Durée totale</p>
                        <p class="mt-1 text-sm text-gray-900">
                            @if($inscription->start_date && $inscription->end_date)
                            {{ $inscription->start_date->diffInDays($inscription->end_date) + 1 }} jours
                            @else
                            Non définie
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Dernière mise à jour</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $inscription->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Informations financières -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Informations financières</h4>
                <div class="space-y-4">
                    <div class="flex justify-between">
                        <p class="text-sm font-medium text-gray-500">Montant total formation</p>
                        <p class="text-sm font-bold text-gray-900">{{ number_format($inscription->formation->price, 2)
                            }}€</p>
                    </div>
                    <div class="flex justify-between">
                        <p class="text-sm font-medium text-gray-500">Montant déjà payé</p>
                        <p class="text-sm font-medium text-green-600">{{ number_format($inscription->amount_paid, 2) }}€
                        </p>
                    </div>
                    <div class="flex justify-between border-t pt-2">
                        <p class="text-sm font-medium text-gray-500">Reste à payer</p>
                        <p class="text-sm font-bold text-gray-900">{{ number_format($inscription->formation->price -
                            $inscription->amount_paid, 2) }}€</p>
                    </div>
                    @if($inscription->payment_method)
                    <div>
                        <p class="text-sm font-medium text-gray-500">Méthode de paiement</p>
                        <p class="mt-1 text-sm text-gray-900">{{ $paymentMethods[$inscription->payment_method] ??
                            $inscription->payment_method }}</p>
                    </div>
                    @endif
                    <div>
                        <p class="text-sm font-medium text-gray-500">Progression du paiement</p>
                        <div class="mt-2 w-full bg-gray-200 rounded-full h-2.5">
                            @php
                            $progress = $inscription->formation->price > 0
                            ? min(100, ($inscription->amount_paid / $inscription->formation->price) * 100)
                            : 0;
                            @endphp
                            <div class="bg-green-600 h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">{{ number_format($progress, 1) }}% payé</p>
                    </div>
                </div>
            </div>

            <!-- Transfert de formation -->
            <div class="md:col-span-2 bg-gray-50 rounded-lg p-6">
                <h4 class="text-lg font-medium text-gray-900 mb-4">Transfert de formation</h4>
                <form action="{{ route('admin.inscriptions.transfer', $inscription) }}" method="POST"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir transférer cette inscription vers une autre formation ? Un email sera envoyé à l\'étudiant.')">
                    @csrf
                    <div class="flex items-end gap-4">
                        <div class="flex-1">
                            <label for="new_formation_id" class="block text-sm font-medium text-gray-700">
                                Nouvelle formation
                            </label>
                            <select name="new_formation_id" id="new_formation_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-djok-yellow focus:ring-djok-yellow">
                                <option value="">Sélectionner une nouvelle formation</option>
                                @foreach($formations as $formation)
                                <option value="{{ $formation->id }}">
                                    {{ $formation->title }} - {{ $formation->type }} ({{
                                    number_format($formation->price, 2) }}€)
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                            class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                            <i class="fas fa-exchange-alt mr-2"></i> Transférer
                        </button>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">
                        Le statut sera réinitialisé à "En attente" après le transfert. Un email de notification sera
                        envoyé à l'étudiant.
                    </p>
                </form>
            </div>

            <!-- Notes -->
            @if($inscription->notes)
            <div class="md:col-span-2 bg-gray-50 rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-lg font-medium text-gray-900">Notes</h4>
                    <button type="button" onclick="copyNotes()"
                        class="inline-flex items-center px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-copy mr-1"></i> Copier
                    </button>
                </div>
                <div id="notes-content" class="bg-white rounded border p-4">
                    <p class="text-sm text-gray-900 whitespace-pre-line">{{ $inscription->notes }}</p>
                </div>
            </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="mt-8 pt-6 border-t border-gray-200 flex flex-col sm:flex-row sm:items-center sm:justify-between">
            <div class="mb-4 sm:mb-0">
                <a href="{{ route('admin.inscriptions.index') }}"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
                </a>
            </div>
            <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                <!-- Bouton Certificat -->
                <button type="button" onclick="generateCertificate()"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-file-certificate mr-2"></i> Générer certificat
                </button>

                <!-- Bouton Facture -->
                <button type="button" onclick="generateInvoice()"
                    class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                    <i class="fas fa-file-invoice mr-2"></i> Générer facture
                </button>

                <!-- Bouton Supprimer -->
                <form action="{{ route('admin.inscriptions.destroy', $inscription) }}" method="POST"
                    onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette inscription ? Cette action est irréversible et un email sera envoyé à l\'étudiant.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        <i class="fas fa-trash mr-2"></i> Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialisation des tooltips si utilisés
        if (typeof $ !== 'undefined') {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });

    // Fonction pour renvoyer l'email de statut
    function resendStatusEmail() {
        if (confirm('Voulez-vous renvoyer l\'email de statut à l\'étudiant ?')) {
            // Afficher l'indicateur de chargement
            const button = event.target.closest('button');
            const originalHTML = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Envoi en cours...';
            button.disabled = true;

            fetch('{{ route('admin.inscriptions.resend-email', $inscription) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Restaurer le bouton
                button.innerHTML = originalHTML;
                button.disabled = false;

                // Afficher la notification
                const notification = document.getElementById('email-notification');
                const message = document.getElementById('email-message');

                if (data.success) {
                    notification.className = 'mb-6 p-4 bg-green-50 border border-green-200 rounded-lg';
                    message.textContent = data.message;
                } else {
                    notification.className = 'mb-6 p-4 bg-red-50 border border-red-200 rounded-lg';
                    message.textContent = 'Erreur : ' + data.message;
                }

                notification.classList.remove('hidden');

                // Faire défiler vers la notification
                notification.scrollIntoView({ behavior: 'smooth', block: 'center' });

                // Masquer la notification après 5 secondes
                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 5000);
            })
            .catch(error => {
                console.error('Error:', error);

                // Restaurer le bouton
                button.innerHTML = originalHTML;
                button.disabled = false;

                // Afficher l'erreur
                const notification = document.getElementById('email-notification');
                const message = document.getElementById('email-message');

                notification.className = 'mb-6 p-4 bg-red-50 border border-red-200 rounded-lg';
                message.textContent = 'Une erreur est survenue lors de l\'envoi de l\'email.';
                notification.classList.remove('hidden');

                setTimeout(() => {
                    notification.classList.add('hidden');
                }, 5000);
            });
        }
    }

    // Fonction pour copier les notes
    function copyNotes() {
        const notesElement = document.getElementById('notes-content');
        const text = notesElement.textContent || notesElement.innerText;

        // Créer un élément temporaire pour copier le texte
        const tempTextArea = document.createElement('textarea');
        tempTextArea.value = text;
        document.body.appendChild(tempTextArea);
        tempTextArea.select();
        tempTextArea.setSelectionRange(0, 99999); // Pour mobile

        try {
            const successful = document.execCommand('copy');
            if (successful) {
                // Afficher un message temporaire
                const button = event.target.closest('button');
                const originalHTML = button.innerHTML;
                button.innerHTML = '<i class="fas fa-check mr-1"></i> Copié !';

                setTimeout(() => {
                    button.innerHTML = originalHTML;
                }, 2000);
            }
        } catch (err) {
            console.error('Erreur lors de la copie:', err);
        }

        document.body.removeChild(tempTextArea);
    }

    // Fonction pour générer un certificat
    function generateCertificate() {
        alert('Fonctionnalité de génération de certificat à implémenter.');
        // À implémenter : génération de PDF de certificat
        // window.open('{{ route('admin.inscriptions.certificate', $inscription) }}', '_blank');
    }

    // Fonction pour générer une facture
    function generateInvoice() {
        alert('Fonctionnalité de génération de facture à implémenter.');
        // À implémenter : génération de PDF de facture
        // window.open('{{ route('admin.inscriptions.invoice', $inscription) }}', '_blank');
    }

    // Fonction pour changer le statut rapidement (si ajouté plus tard)
    function quickChangeStatus(newStatus) {
        if (confirm('Voulez-vous changer le statut à "' + newStatus + '" ? Un email sera envoyé à l\'étudiant.')) {
            fetch('{{ route('admin.inscriptions.update-status', $inscription) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Recharger la page pour voir les changements
                    location.reload();
                } else {
                    alert('Erreur lors du changement de statut');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Une erreur est survenue');
            });
        }
    }
</script>

<style>
    .badge {
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .badge-warning {
        background-color: #fef3c7;
        color: #92400e;
    }

    .badge-info {
        background-color: #dbeafe;
        color: #1e40af;
    }

    .badge-primary {
        background-color: #e9d5ff;
        color: #6b21a8;
    }

    .badge-success {
        background-color: #d1fae5;
        color: #065f46;
    }

    .badge-danger {
        background-color: #fee2e2;
        color: #991b1b;
    }

    /* Animation pour la notification */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    #email-notification {
        animation: slideIn 0.3s ease-out;
    }

    /* Style pour les boutons désactivés */
    button:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    /* Style pour les liens d'action */
    .action-link {
        transition: all 0.2s ease;
    }

    .action-link:hover {
        transform: translateY(-1px);
    }
</style>
@endsection
