<!-- Newsletter Section - Style Blog (fonctionnelle) -->
<section id="newsletter" class="bg-yellow-600 text-white py-16 rounded-2xl text-center mb-12 animate-pulse-gentle">
    <div class="max-w-2xl mx-auto px-4">
        <h2 class="text-3xl font-bold mb-4 animate-fade-in">
            Restez informé de nos actualités
        </h2>
        <p class="text-yellow-100 mb-8 text-lg animate-fade-in" style="animation-delay: 0.2s;">
            Recevez nos dernières conseils, astuces et actualités directement dans votre boîte mail
        </p>

        <!-- Formulaire fonctionnel -->
        <form action="{{ route('newsletter.subscribe') }}" method="POST"
            class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up"
            style="animation-delay: 0.4s;">
            @csrf
            <input type="email" name="email" placeholder="Votre adresse email" required value="{{ old('email') }}"
                class="flex-1 px-6 py-4 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-white min-w-0 transition duration-300 transform focus:scale-105">
            <button type="submit"
                class="bg-white text-yellow-600 px-8 py-4 rounded-xl hover:bg-gray-100 transition duration-300 transform hover:scale-105 font-semibold whitespace-nowrap shadow-lg hover:shadow-xl">
                S'inscrire à la newsletter
            </button>
        </form>

        <!-- Message de succès -->
        @if(session('success'))
        <p class="mt-4 text-green-100 font-medium animate-fade-in-up" style="animation-delay: 0.6s;">
            {{ session('success') }}
        </p>
        @endif

        <!-- Erreurs -->
        @error('email')
        <p class="mt-4 text-red-200 font-medium animate-fade-in-up" style="animation-delay: 0.6s;">
            {{ $message }}
        </p>
        @enderror
    </div>
</section>
