@extends('layouts.admin')

@section('title', 'Gestion des Campagnes Newsletter')

@section('page-actions')
<a href="{{ route('admin.newsletter.campaigns.create') }}"
    class="inline-flex items-center px-4 py-2 bg-djok-yellow text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300 transform hover:scale-105">
    <i class="fas fa-plus mr-2"></i> Nouvelle campagne
</a>
@endsection

@section('content')
<div class="bg-white shadow overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
        <h3 class="text-lg font-medium leading-6 text-gray-900">Campagnes newsletter</h3>
        <p class="mt-1 text-sm text-gray-500">Gérez toutes vos campagnes d'emailing.</p>
    </div>

    <!-- Statistiques -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 px-4 py-4 bg-gray-50">
        <div class="bg-white p-4 rounded-lg shadow border">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-paper-plane text-blue-500 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Total campagnes</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow border">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-file-alt text-gray-500 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Brouillons</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['draft'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow border">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-clock text-yellow-500 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Planifiées</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['scheduled'] }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow border">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-500">Envoyées</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['sent'] }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-200">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Sujet
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Statut
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Destinataires
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Performance
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($campaigns as $campaign)
                    <tr>
                        <td class="px-6 py-4">
                            <div class="text-sm font-medium text-gray-900">
                                <a href="{{ route('admin.newsletter.campaigns.show', $campaign) }}"
                                    class="hover:text-djok-yellow">
                                    {{ Str::limit($campaign->subject, 50) }}
                                </a>
                            </div>
                            <div class="text-sm text-gray-500">Template: {{ $campaign->template }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @switch($campaign->status)
                            @case('draft')
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                Brouillon
                            </span>
                            @break
                            @case('scheduled')
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Planifié
                            </span>
                            @if($campaign->scheduled_at)
                            <div class="text-xs text-gray-500 mt-1">
                                {{ $campaign->scheduled_at->format('d/m H:i') }}
                            </div>
                            @endif
                            @break
                            @case('sending')
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                En cours
                            </span>
                            @break
                            @case('sent')
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Envoyé
                            </span>
                            @break
                            @case('cancelled')
                            <span
                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Annulé
                            </span>
                            @break
                            @endswitch
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $campaign->total_recipients }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center space-x-2">
                                @if($campaign->total_recipients > 0)
                                <div class="text-center">
                                    <div class="text-sm font-medium text-green-600">{{
                                        number_format($campaign->openRate(), 1) }}%</div>
                                    <div class="text-xs text-gray-500">Ouverture</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-sm font-medium text-blue-600">{{
                                        number_format($campaign->clickRate(), 1) }}%</div>
                                    <div class="text-xs text-gray-500">Clics</div>
                                </div>
                                @else
                                <div class="text-sm text-gray-500">-</div>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($campaign->sent_at)
                            <div class="text-sm text-gray-900">{{ $campaign->sent_at->format('d/m/Y') }}</div>
                            <div class="text-sm text-gray-500">{{ $campaign->sent_at->format('H:i') }}</div>
                            @else
                            <div class="text-sm text-gray-500">-</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="{{ route('admin.newsletter.campaigns.show', $campaign) }}"
                                class="text-djok-yellow hover:text-yellow-700 mr-3" title="Voir">
                                <i class="fas fa-eye"></i>
                            </a>

                            @if(in_array($campaign->status, ['draft', 'scheduled']))
                            <a href="{{ route('admin.newsletter.campaigns.edit', $campaign) }}"
                                class="text-blue-600 hover:text-blue-900 mr-3" title="Modifier">
                                <i class="fas fa-edit"></i>
                            </a>

                            @if($campaign->status === 'draft')
                            <form action="{{ route('admin.newsletter.campaigns.send', $campaign) }}" method="POST"
                                class="inline-block mr-2">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-900"
                                    onclick="return confirm('Envoyer cette campagne ?')" title="Envoyer">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </form>
                            @endif

                            @if($campaign->status === 'scheduled')
                            <form action="{{ route('admin.newsletter.campaigns.cancel', $campaign) }}" method="POST"
                                class="inline-block mr-2">
                                @csrf
                                <button type="submit" class="text-yellow-600 hover:text-yellow-900"
                                    onclick="return confirm('Annuler cette campagne ?')" title="Annuler">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                            @endif
                            @endif

                            @if(in_array($campaign->status, ['draft', 'cancelled']))
                            <form action="{{ route('admin.newsletter.campaigns.destroy', $campaign) }}" method="POST"
                                class="inline-block"
                                onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette campagne ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" title="Supprimer">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Aucune campagne trouvée.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-4 py-3 bg-gray-50 sm:px-6">
            {{ $campaigns->links() }}
        </div>
    </div>
</div>
@endsection
