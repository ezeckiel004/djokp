@extends('layouts.admin')

@section('title', 'Détails de la Campagne')

@section('page-actions')
<div class="flex space-x-2">
    @if(in_array($campaign->status, ['draft', 'scheduled']))
    <a href="{{ route('admin.newsletter.campaigns.edit', $campaign) }}"
        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition-all duration-300">
        <i class="fas fa-edit mr-2"></i> Modifier
    </a>
    @endif

    @if($campaign->status === 'draft')
    <form action="{{ route('admin.newsletter.campaigns.send', $campaign) }}" method="POST" class="inline-block">
        @csrf
        <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-300"
            onclick="return confirm('Envoyer cette campagne ?')">
            <i class="fas fa-paper-plane mr-2"></i> Envoyer
        </button>
    </form>
    @endif

    @if($campaign->status === 'scheduled')
    <form action="{{ route('admin.newsletter.campaigns.cancel', $campaign) }}" method="POST" class="inline-block">
        @csrf
        <button type="submit"
            class="inline-flex items-center px-4 py-2 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300"
            onclick="return confirm('Annuler cette campagne ?')">
            <i class="fas fa-times mr-2"></i> Annuler
        </button>
    </form>
    @endif
</div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Informations principales -->
    <div class="lg:col-span-2">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Détails de la campagne</h3>
                <p class="mt-1 text-sm text-gray-500">Informations complètes sur cette campagne.</p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Sujet</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $campaign->subject }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Statut</dt>
                        <dd class="mt-1">
                            @switch($campaign->status)
                            @case('draft')
                            <span
                                class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                Brouillon
                            </span>
                            @break
                            @case('scheduled')
                            <span
                                class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Planifié
                            </span>
                            @break
                            @case('sending')
                            <span
                                class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                En cours d'envoi
                            </span>
                            @break
                            @case('sent')
                            <span
                                class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Envoyé
                            </span>
                            @break
                            @case('cancelled')
                            <span
                                class="px-3 py-1 inline-flex text-sm leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                Annulé
                            </span>
                            @break
                            @endswitch
                        </dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Template</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $campaign->template }}</dd>
                    </div>

                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Destinataires</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $campaign->total_recipients }}</dd>
                    </div>

                    @if($campaign->scheduled_at)
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Planifié pour</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $campaign->scheduled_at->format('d/m/Y à H:i') }}
                        </dd>
                    </div>
                    @endif

                    @if($campaign->sent_at)
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Envoyé le</dt>
                        <dd class="mt-1 text-sm text-gray-900">
                            {{ $campaign->sent_at->format('d/m/Y à H:i') }}
                        </dd>
                    </div>
                    @endif
                </dl>

                <!-- Contenu -->
                <div class="mt-8">
                    <dt class="text-sm font-medium text-gray-500 mb-2">Contenu de l'email</dt>
                    <div class="mt-1 p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <div class="prose max-w-none">
                            {!! $campaign->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Logs d'envoi -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-6">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Logs d'envoi</h3>
                <p class="mt-1 text-sm text-gray-500">Historique des interactions avec cette campagne.</p>
            </div>
            <div class="border-t border-gray-200">
                @if($logs->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Action
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    IP
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($logs as $log)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $log->email }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($log->action === 'sent')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Envoyé
                                    </span>
                                    @elseif($log->action === 'opened')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        Ouvert
                                    </span>
                                    @else
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Clic
                                    </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $log->created_at->format('d/m/Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $log->created_at->format('H:i:s') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $log->ip_address ?? '-' }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-4 py-3 bg-gray-50 sm:px-6">
                    {{ $logs->links() }}
                </div>
                @else
                <div class="px-4 py-12 text-center">
                    <i class="fas fa-history text-gray-400 text-4xl mb-4"></i>
                    <p class="text-gray-500">Aucun log disponible pour cette campagne</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="lg:col-span-1">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Statistiques</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                @if($campaign->total_recipients > 0)
                <div class="space-y-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-gray-900">{{ $campaign->total_recipients }}</div>
                        <div class="text-sm text-gray-500">Destinataires</div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-4 bg-green-50 rounded-lg">
                            <div class="text-2xl font-bold text-green-600">{{ $campaign->opened_count }}</div>
                            <div class="text-sm text-green-800">Ouvertures</div>
                            <div class="text-xs text-green-600 mt-1">{{ number_format($campaign->openRate(), 1) }}%
                            </div>
                        </div>

                        <div class="text-center p-4 bg-blue-50 rounded-lg">
                            <div class="text-2xl font-bold text-blue-600">{{ $campaign->clicked_count }}</div>
                            <div class="text-sm text-blue-800">Clics</div>
                            <div class="text-xs text-blue-600 mt-1">{{ number_format($campaign->clickRate(), 1) }}%
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Taux d'ouverture</span>
                            <span class="font-medium">{{ number_format($campaign->openRate(), 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-green-600 h-2 rounded-full"
                                style="width: {{ min($campaign->openRate(), 100) }}%"></div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Taux de clics</span>
                            <span class="font-medium">{{ number_format($campaign->clickRate(), 1) }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 h-2 rounded-full"
                                style="width: {{ min($campaign->clickRate(), 100) }}%"></div>
                        </div>
                    </div>
                </div>
                @else
                <div class="text-center py-8">
                    <i class="fas fa-chart-bar text-gray-400 text-4xl mb-4"></i>
                    <p class="text-gray-500">Aucune statistique disponible</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="bg-white shadow overflow-hidden sm:rounded-lg mt-6">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Actions</h3>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
                <div class="space-y-3">
                    <a href="{{ route('admin.newsletter.campaigns') }}"
                        class="w-full flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                        <i class="fas fa-arrow-left mr-2"></i> Retour aux campagnes
                    </a>

                    @if(in_array($campaign->status, ['draft', 'cancelled']))
                    <form action="{{ route('admin.newsletter.campaigns.destroy', $campaign) }}" method="POST"
                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette campagne ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full flex items-center justify-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                            <i class="fas fa-trash mr-2"></i> Supprimer la campagne
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
