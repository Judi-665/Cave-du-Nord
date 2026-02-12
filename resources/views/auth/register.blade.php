<x-guest-layout>
    
    <div class="min-h-screen flex items-center justify-center bg-[#8B1C1C] px-4">
        <div class="w-full max-w-sm p-6 bg-white rounded-3xl shadow-2xl">
            
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo-cave-du-nord.png') }}" alt="Cave du Nord" class="h-23 w-auto">
            </div>

            <h1 class="text-2xl font-bold text-center text-[#6f1d1b] mb-5">Rejoins la Cave du Nord</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <label for="name" class="block text-[#6f1d1b] text-sm mb-1">Nom</label>
                <input id="name" name="name" type="text" required
                    class="w-full bg-[#f9f9f9] text-[#6f1d1b] border border-gray-300 rounded-md px-3 py-2 mb-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#8B1C1C]">

                <label for="email" class="block text-[#6f1d1b] text-sm mb-1">Email</label>
                <input id="email" name="email" type="email" required
                    class="w-full bg-[#f9f9f9] text-[#6f1d1b] border border-gray-300 rounded-md px-3 py-2 mb-3 text-sm focus:outline-none focus:ring-2 focus:ring-[#8B1C1C]">

                <label for="password" class="block text-[#6f1d1b] text-sm mb-1">Mot de passe</label>
                <input id="password" name="password" type="password" required
                    class="w-full bg-[#f9f9f9] text-[#6f1d1b] border border-gray-300 rounded-md px-3 py-2 mb-4 text-sm focus:outline-none focus:ring-2 focus:ring-[#8B1C1C]">

            
                <button type="submit"
                    class="w-full bg-[#6f1d1b] text-[#fff8e7] hover:bg-[#8B1C1C] px-3 py-2 rounded-md font-semibold text-sm transition-colors">
                    S’inscrire
                </button>

                <div class="text-center mt-4">
                    <span class="text-sm text-gray-600">Déjà inscrit ?</span>
                    <a href="{{ route('login') }}" class="text-[#8B1C1C] font-semibold hover:underline ml-1">
                        Se connecter
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
