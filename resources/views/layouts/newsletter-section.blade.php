<!-- Newsletter Section - Style sobre avec fond or -->
<section id="newsletter" class="py-16 text-center mb-12" style="background: #caa24d; border-radius: 12px;">
    <div class="max-w-2xl mx-auto px-4 md:px-6">
        <h2 class="text-2xl md:text-3xl font-bold mb-4" style="color: black;">
            Restez informé de nos actualités
        </h2>
        <p class="mb-8 text-lg" style="color: rgba(0, 0, 0, 0.8);">
            Recevez nos dernières conseils, astuces et actualités directement dans votre boîte mail
        </p>

        <!-- Formulaire fonctionnel - Style sobre -->
        <form action="{{ route('newsletter.subscribe') }}" method="POST"
            class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            @csrf
            <input type="email" name="email" placeholder="Votre adresse email" required value="{{ old('email') }}"
                class="flex-1 px-6 py-4 rounded-lg min-w-0 transition duration-300 hover:border-opacity-80 focus:outline-none focus:ring-2 focus:ring-black"
                style="background: white; border: 1px solid rgba(0, 0, 0, 0.2); color: black;">
            <button type="submit"
                class="px-8 py-4 rounded-lg transition duration-300 hover:opacity-90 font-semibold whitespace-nowrap"
                style="background: black; color: #caa24d; border: 2px solid black;">
                S'inscrire à la newsletter
            </button>
        </form>

        <!-- Message de succès -->
        @if(session('success'))
        <div class="mt-6 p-4 rounded-lg" style="background: rgba(0, 0, 0, 0.1); border: 1px solid rgba(0, 0, 0, 0.3);">
            <div class="flex items-center justify-center">
                <div class="w-6 h-6 flex items-center justify-center rounded-full mr-3" style="background: black;">
                    <i class="fas fa-check" style="color: #caa24d; font-size: 0.75rem;"></i>
                </div>
                <p class="font-medium" style="color: black;">
                    {{ session('success') }}
                </p>
            </div>
        </div>
        @endif

        <!-- Erreurs -->
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
            Nous respectons votre vie privée. Désabonnez-vous à tout moment.
        </p>
    </div>
</section>