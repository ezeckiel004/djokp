@extends('layouts.main')

@section('title', __('payment-cancel.title'))

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="container mx-auto px-6">
        <div class="max-w-2xl mx-auto">
            <!-- Carte d'annulation -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- En-tête annulation -->
                <div class="bg-gradient-to-r from-orange-500 to-orange-600 px-8 py-8 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-white rounded-full mb-4">
                        <i class="{{ __('payment-cancel.icons.cancel') }} text-orange-600 text-4xl"></i>
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">
                        {{ __('payment-cancel.header.title') }}
                    </h1>
                    <p class="text-orange-100">
                        {{ __('payment-cancel.header.subtitle') }}
                    </p>
                </div>

                <div class="p-8">
                    <!-- Message -->
                    <div class="mb-8 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 bg-orange-100 rounded-full mb-4">
                            <i class="{{ __('payment-cancel.icons.warning') }} text-orange-600 text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            {{ __('payment-cancel.message.title') }}
                        </h2>
                        <p class="text-gray-700 mb-6">
                            {{ __('payment-cancel.message.content') }}
                        </p>

                        <div class="p-4 bg-orange-50 rounded-lg border border-orange-200 max-w-md mx-auto">
                            <p class="text-orange-800">
                                <i class="{{ __('payment-cancel.icons.info') }} text-orange-600 mr-2"></i>
                                {{ __('payment-cancel.message.info') }}
                            </p>
                        </div>
                    </div>

                    <!-- Causes possibles -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">
                            {{ __('payment-cancel.causes.title') }}
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-times text-red-500 mt-1 mr-3"></i>
                                <span>{{ __('payment-cancel.causes.items.voluntary') }}</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-exclamation-circle text-red-500 mt-1 mr-3"></i>
                                <span>{{ __('payment-cancel.causes.items.technical') }}</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-credit-card text-red-500 mt-1 mr-3"></i>
                                <span>{{ __('payment-cancel.causes.items.card') }}</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-clock text-red-500 mt-1 mr-3"></i>
                                <span>{{ __('payment-cancel.causes.items.timeout') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8">
                        <a href="{{ url()->previous() }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-yellow-600 text-white font-semibold rounded-lg hover:bg-yellow-700 transition-all duration-300">
                            <i class="{{ __('payment-cancel.icons.retry') }} mr-2"></i>
                            {{ __('payment-cancel.actions.retry') }}
                        </a>
                        <a href="{{ route('formation') }}"
                            class="inline-flex items-center justify-center px-6 py-3 bg-gray-200 text-gray-800 font-semibold rounded-lg hover:bg-gray-300 transition-all duration-300">
                            <i class="{{ __('payment-cancel.icons.back') }} mr-2"></i>
                            {{ __('payment-cancel.actions.back_formations') }}
                        </a>
                    </div>

                    <!-- Assistance -->
                    <div class="p-6 bg-gray-50 rounded-xl text-center">
                        <h3 class="text-lg font-bold text-gray-900 mb-3">
                            {{ __('payment-cancel.assistance.title') }}
                        </h3>
                        <p class="text-gray-700 mb-4">
                            {{ __('payment-cancel.assistance.content') }}
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <div class="flex items-center justify-center text-gray-700">
                                <i class="{{ __('payment-cancel.icons.phone') }} text-yellow-600 mr-2"></i>
                                <div>
                                    <p class="font-medium">{{ __('payment-cancel.assistance.phone') }}</p>
                                    <p class="text-sm text-gray-600">{{ __('payment-cancel.assistance.phone_hours') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center justify-center text-gray-700">
                                <i class="{{ __('payment-cancel.icons.email') }} text-yellow-600 mr-2"></i>
                                <div>
                                    <p class="font-medium">{{ __('payment-cancel.assistance.email') }}</p>
                                    <p class="text-sm text-gray-600">{{ __('payment-cancel.assistance.response_time') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Informations complémentaires -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                            <div class="p-3 bg-green-50 rounded-lg">
                                <i class="fas fa-shield-alt text-green-600 text-xl mb-2"></i>
                                <p class="text-sm text-green-700 font-medium">{{
                                    __('payment-cancel.status_messages.no_charge') }}</p>
                            </div>
                            <div class="p-3 bg-blue-50 rounded-lg">
                                <i class="fas fa-lock text-blue-600 text-xl mb-2"></i>
                                <p class="text-sm text-blue-700 font-medium">{{
                                    __('payment-cancel.status_messages.safe_transaction') }}</p>
                            </div>
                            <div class="p-3 bg-purple-50 rounded-lg">
                                <i class="fas fa-sync-alt text-purple-600 text-xl mb-2"></i>
                                <p class="text-sm text-purple-700 font-medium">{{
                                    __('payment-cancel.status_messages.can_retry') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
