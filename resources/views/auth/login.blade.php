<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-vinBordeaux px-4">
        
        <div class="w-full max-w-sm p-6 bg-white rounded-3xl shadow-2xl">
           
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logo-cave-du-nord.png') }}" alt="Cave du Nord" class="h-23 w-auto">
            </div>

            
            <h1 class="text-2xl font-bold text-center text-vinRouge mb-5">Connecte-toi à ton espace </h1>

            
            <form method="POST" action="{{ route('login') }}">
                @csrf

                
                <div class="mb-3">
                    <label for="email" class="block text-vinRouge text-sm font-medium">Email</label>
                    <input id="email" name="email" type="email" required autofocus
                        class="w-full bg-gray-100 text-vinRouge border-none rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-or">
                </div>

               
                <div class="mb-3">
                    <label for="password" class="block text-vinRouge text-sm font-medium">Mot de passe</label>
                    <input id="password" name="password" type="password" required
                        class="w-full bg-gray-100 text-vinRouge border-none rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-or">
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="w-full bg-vinRouge text-creme font-semibold px-4 py-2 rounded-md hover:bg-or transition-colors">
                        Se connecter
                    </button>
                </div>

            
                <div class="text-center mt-4">
                    <span class="text-sm text-gray-600">Pas encore inscrit ?</span>
                    <a href="{{ route('register') }}" class="text-vinRouge font-semibold hover:underline ml-1">
                        S’inscrire
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
