@extends('layouts.admin')

@section('title', 'Gestion des cours E-learning | Admin DJOK PRESTIGE')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Gestion des cours</h1>
                <p class="text-gray-600 mt-1">Contenu pédagogique e-learning</p>
            </div>
            <a href="{{ route('admin.elearning.cours.create') }}"
                class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Nouveau cours
            </a>
        </div>
    </div>

    <!-- Liste des cours -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Cours
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Durée
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Contenu
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            QCM
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($cours as $coursItem)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">{{ $coursItem->title }}</div>
                            <div class="text-xs text-gray-500">{{ $coursItem->slug }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $coursItem->duration_formatted }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex space-x-2">
                                @if($coursItem->hasVideo())
                                <span class="px-2 py-1 text-xs bg-red-100 text-red-800 rounded-full">
                                    <i class="fas fa-video mr-1"></i> Vidéo
                                </span>
                                @endif
                                @if($coursItem->hasPdf())
                                <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                    <i class="fas fa-file-pdf mr-1"></i> PDF
                                </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="text-sm text-gray-900">{{ $coursItem->qcms_count }} QCM</div>
                        </td>
                        <td class="px-6 py-4">
                            @if($coursItem->is_active)
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                Actif
                            </span>
                            @else
                            <span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                Inactif
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.elearning.cours.edit', $coursItem->id) }}"
                                    class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('admin.elearning.qcms') }}?cours={{ $coursItem->id }}"
                                    class="text-green-600 hover:text-green-800">
                                    <i class="fas fa-question-circle"></i>
                                </a>
                                <form action="{{ route('admin.elearning.cours.destroy', $coursItem->id) }}"
                                    method="POST" class="inline" onsubmit="return confirm('Supprimer ce cours ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
