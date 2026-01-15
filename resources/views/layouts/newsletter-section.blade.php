<!-- Newsletter Section - Style sobre avec fond or -->
<section id="newsletter" class="py-16 text-center mb-12" style="background: #caa24d; border-radius: 12px;">
    <div class="max-w-2xl mx-auto px-4 md:px-6">
        <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: black;">
            {{ __('newsletter.title') }}
        </h2>
        <p class="mb-8 text-lg" style="color: rgba(0, 0, 0, 0.8);">
            {{ __('newsletter.description') }}
        </p>

        <!-- Formulaire fonctionnel - Style sobre -->
        <form action="{{ route('newsletter.subscribe') }}" method="POST"
            class="flex flex-col sm:flex-row gap-4 justify-center items-center"
            aria-label="{{ __('newsletter.form_label') }}">
            @csrf
            <div class="flex-1 w-full sm:w-auto">
                <label for="newsletter-email" class="sr-only">{{ __('newsletter.email_label') }}</label>
                <input type="email" name="email" id="newsletter-email"
                    placeholder="{{ __('newsletter.email_placeholder') }}" required value="{{ old('email') }}"
                    class="w-full px-6 py-4 rounded-lg min-w-0 transition duration-300 hover:border-opacity-80 focus:outline-none focus:ring-2 focus:ring-black"
                    style="background: white; border: 1px solid rgba(0, 0, 0, 0.2); color: black;">
            </div>
            <button type="submit"
                class="px-8 py-4 rounded-lg transition duration-300 hover:opacity-90 font-semibold whitespace-nowrap"
                style="background: black; color: #caa24d; border: 2px solid black;"
                aria-label="{{ __('newsletter.submit_label') }}">
                {{ __('newsletter.submit_button') }}
            </button>
        </form>

        <!-- Message de succès -->
        @if(session('newsletter_success'))
        <div class="mt-6 p-4 rounded-lg" style="background: rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.3);">
            <div class="flex items-center justify-center">
                <div class="w-6 h-6 flex items-center justify-center rounded-full mr-3" style="background: black;">
                    <i class="fas fa-check" style="color: #caa24d; font-size: 0.75rem;"></i>
                </div>
                <p class="font-medium" style="color: black;">
                    {{ session('newsletter_success') }}
                </p>
            </div>
        </div>
        @endif

        <!-- Message d'erreur -->
        @if(session('newsletter_error'))
        <div class="mt-6 p-4 rounded-lg" style="background: rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.3);">
            <div class="flex items-center justify-center">
                <div class="w-6 h-6 flex items-center justify-center rounded-full mr-3" style="background: black;">
                    <i class="fas fa-exclamation-circle" style="color: #caa24d; font-size: 0.75rem;"></i>
                </div>
                <p class="font-medium" style="color: black;">
                    {{ session('newsletter_error') }}
                </p>
            </div>
        </div>
        @endif

        <!-- Erreurs de validation -->
        @error('email')
        <div class="mt-6 p-4 rounded-lg" style="background: rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.3);">
            <div class="flex items-center justify-center">
                <div class="w-6 h-6 flex items-center justify-center rounded-full mr-3" style="background: black;">
                    <i class="fas fa-exclamation-circle" style="color: #caa24d; font-size: 0.75rem;"></i>
                </div>
                <p class="font-medium" style="color: black;">
                    {{ $message }}
                </p>
            </div>
        </div>
        @enderror

        <!-- Information de confidentialité -->
        <p class="mt-6 text-sm" style="color: rgba(0, 0, 0, 0.7);">
            <i class="fas fa-shield-alt mr-2"></i>
            {{ __('newsletter.privacy_notice') }}
            @if(isset($privacy_policy_url) && $privacy_policy_url)
            <a href="{{ $privacy_policy_url }}" class="underline ml-1" style="color: rgba(0, 0, 0, 0.9);">
                {{ __('newsletter.privacy_policy') }}
            </a>
            @endif
        </p>

        <!-- Lien de désinscription optionnel -->
        @if(isset($unsubscribe_url) && $unsubscribe_url)
        <p class="mt-2 text-xs" style="color: rgba(0, 0, 0, 0.6);">
            <a href="{{ $unsubscribe_url }}" class="underline" style="color: rgba(0, 0, 0, 0.7);">
                {{ __('newsletter.unsubscribe_link') }}
            </a>
        </p>
        @endif
    </div>
</section>