{{-- resources/views/admin/participants/export.blade.php --}}
@extends('layouts.admin')

@section('title', 'Export des Participants')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a
                                            href="{{ route('admin.participants.index') }}">Participants</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Export</li>
                                </ol>
                            </nav>
                            <h4 class="card-title mb-0 mt-2">
                                <i class="fas fa-file-export mr-2"></i>Export des Participants
                            </h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.participants.index') }}" class="btn btn-primary">
                                <i class="fas fa-arrow-left"></i> Retour
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Options d'export -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-cog mr-2"></i>Options d'export</h5>
                </div>
                <div class="card-body">
                    <form id="exportForm" method="POST" action="{{ route('admin.participants.export.process') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label>Format d'export</label>
                                <select name="format" class="form-control">
                                    <option value="excel">Excel (.xlsx)</option>
                                    <option value="csv">CSV (.csv)</option>
                                    <option value="pdf">PDF (.pdf)</option>
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Date de début</label>
                                <input type="date" name="date_debut" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Date de fin</label>
                                <input type="date" name="date_fin" class="form-control">
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Statut</label>
                                <select name="statut" class="form-control">
                                    <option value="">Tous les statuts</option>
                                    <option value="en_attente">En attente</option>
                                    <option value="confirme">Confirmé</option>
                                    <option value="annule">Annulé</option>
                                    <option value="termine">Terminé</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Colonnes à inclure</label>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="columns[]" value="id"
                                            checked>
                                        <label class="form-check-label">ID</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="columns[]" value="nom"
                                            checked>
                                        <label class="form-check-label">Nom</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="columns[]" value="prenom"
                                            checked>
                                        <label class="form-check-label">Prénom</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="columns[]" value="email"
                                            checked>
                                        <label class="form-check-label">Email</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="columns[]"
                                            value="telephone">
                                        <label class="form-check-label">Téléphone</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="columns[]"
                                            value="formation">
                                        <label class="form-check-label">Formation</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="columns[]" value="statut"
                                            checked>
                                        <label class="form-check-label">Statut</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="columns[]"
                                            value="type_formation">
                                        <label class="form-check-label">Type de formation</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="columns[]"
                                            value="progression">
                                        <label class="form-check-label">Progression</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="columns[]"
                                            value="date_inscription" checked>
                                        <label class="form-check-label">Date d'inscription</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="columns[]"
                                            value="date_debut">
                                        <label class="form-check-label">Date de début</label>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="columns[]"
                                            value="date_fin">
                                        <label class="form-check-label">Date de fin</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="fas fa-download mr-2"></i>Générer l'export
                            </button>
                            <button type="button" id="selectAll" class="btn btn-outline-secondary">
                                <i class="fas fa-check-square mr-2"></i>Tout sélectionner
                            </button>
                            <button type="button" id="deselectAll" class="btn btn-outline-secondary">
                                <i class="fas fa-square mr-2"></i>Tout désélectionner
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Aperçu des données -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0"><i class="fas fa-eye mr-2"></i>Aperçu des données ({{ $participants->count() }}
                        participants)</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prénom</th>
                                    <th>Email</th>
                                    <th>Formation</th>
                                    <th>Type</th>
                                    <th>Statut</th>
                                    <th>Progression</th>
                                    <th>Date d'inscription</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($participants as $participant)
                                <tr>
                                    <td>#{{ $participant->id }}</td>
                                    <td>{{ $participant->nom }}</td>
                                    <td>{{ $participant->prenom }}</td>
                                    <td>{{ $participant->email }}</td>
                                    <td>{{ Str::limit($participant->formation->title, 30) }}</td>
                                    <td>
                                        <span class="badge badge-info">{{ $participant->type_formation_readable
                                            }}</span>
                                    </td>
                                    <td>
                                        @php
                                        $badgeClass = [
                                        'en_attente' => 'warning',
                                        'confirme' => 'success',
                                        'annule' => 'danger',
                                        'termine' => 'info',
                                        ][$participant->statut] ?? 'secondary';
                                        @endphp
                                        <span class="badge badge-{{ $badgeClass }}">{{ $participant->statut_readable
                                            }}</span>
                                    </td>
                                    <td>{{ $participant->progression }}%</td>
                                    <td>{{ $participant->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    @if($participants->count() > 100)
                    <div class="alert alert-info mt-3">
                        <i class="fas fa-info-circle mr-2"></i>
                        Seuls les 100 premiers participants sont affichés en aperçu.
                        L'export complet contiendra tous les {{ $participants->count() }} participants.
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Sélectionner/désélectionner toutes les colonnes
        document.getElementById('selectAll').addEventListener('click', function() {
            document.querySelectorAll('input[name="columns[]"]').forEach(function(checkbox) {
                checkbox.checked = true;
            });
        });

        document.getElementById('deselectAll').addEventListener('click', function() {
            document.querySelectorAll('input[name="columns[]"]').forEach(function(checkbox) {
                checkbox.checked = false;
            });
        });

        // Soumission du formulaire d'export
        document.getElementById('exportForm').addEventListener('submit', function(e) {
            e.preventDefault();

            // Vérifier qu'au moins une colonne est sélectionnée
            const checkedColumns = document.querySelectorAll('input[name="columns[]"]:checked');
            if (checkedColumns.length === 0) {
                alert('Veuillez sélectionner au moins une colonne à exporter.');
                return;
            }

            // Afficher un message de chargement
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Génération en cours...';
            submitBtn.disabled = true;

            // Soumettre le formulaire
            this.submit();
        });
    });
</script>
@endsection
