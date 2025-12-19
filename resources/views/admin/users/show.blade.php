@extends('layouts.admin')

@section('title', 'Profil utilisateur')

@section('page-title', 'Profil de ' . $user->name)

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <!-- En-tête avec statistiques et actions -->
        <div class="px-4 py-5 sm:px-6 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div class="flex items-center">
                    <div class="h-16 w-16 rounded-full bg-djok-yellow flex items-center justify-center">
                        <span class="text-white text-2xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </span>
                    </div>
                    <div class="ml-4">
                        <h2 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h2>
                        <p class="text-gray-500">{{ $user->email }}</p>
                        <div class="mt-2 flex flex-wrap gap-2">
                            @php
                            $roleColors = [
                            1 => 'bg-red-100 text-red-800',
                            2 => 'bg-blue-100 text-blue-800',
                            3 => 'bg-green-100 text-green-800',
                            4 => 'bg-purple-100 text-purple-800',
                            5 => 'bg-yellow-100 text-yellow-800'
                            ];
                            @endphp
                            <span
                                class="px-3 py-1 text-sm rounded-full {{ $roleColors[$user->role_id] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ $user->role->name ?? 'Aucun rôle' }}
                            </span>
                            <span
                                class="px-3 py-1 text-sm rounded-full {{ $user->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ $user->is_active ? 'Actif' : 'Inactif' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 sm:mt-0 flex space-x-3">
                    <a href="{{ route('admin.users.edit', $user) }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-edit mr-2"></i>
                        Éditer
                    </a>
                    <a href="{{ route('admin.users.index') }}"
                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-djok-yellow">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Retour
                    </a>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-blue-500 rounded-md p-2">
                            <i class="fas fa-file-signature text-white"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Inscriptions</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $user->inscriptions_count ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-green-500 rounded-md p-2">
                            <i class="fas fa-calendar-alt text-white"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Réservations</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $user->reservations_count ?? 0 }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 bg-purple-500 rounded-md p-2">
                            <i class="fas fa-sign-in-alt text-white"></i>
                        </div>
                        <div class="ml-4">
                            <p class="text-sm font-medium text-gray-500">Dernière connexion</p>
                            <p class="text-sm font-semibold text-gray-900">
                                {{ $user->last_login_at ? $user->last_login_at->format('d/m/Y H:i') : 'Jamais' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Corps -->
        <div class="px-6 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Informations personnelles -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-user-circle mr-2 text-gray-400"></i>
                        Informations personnelles
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Téléphone</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->phone ?? 'Non renseigné' }}</p>
                        </div>

                        @if($user->birth_date)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Date de naissance</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->birth_date->format('d/m/Y') }}</p>
                        </div>
                        @endif

                        @if($user->address || $user->city || $user->country)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Adresse</label>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ $user->address }}<br>
                                {{ $user->city }}<br>
                                {{ $user->country }}
                            </p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Documents -->
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-file-alt mr-2 text-gray-400"></i>
                        Documents
                    </h3>
                    <div class="space-y-4">
                        @if($user->cni_number)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">CNI</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->cni_number }}</p>
                        </div>
                        @endif

                        @if($user->driver_license)
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Permis de conduire</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $user->driver_license }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Dates -->
                <div class="md:col-span-2 border-t border-gray-200 pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Date d'inscription</label>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ $user->created_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-500">Dernière mise à jour</label>
                            <p class="mt-1 text-sm text-gray-900">
                                {{ $user->updated_at->format('d/m/Y à H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
