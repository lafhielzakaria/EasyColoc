<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ $colocation->name }}
            </h2>
            @if(auth()->user()->isOwnerOf($colocation))
            <div class="flex space-x-3">
                <a href="{{ route('colocations.invite', $colocation) }}" class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 transition">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Inviter
                </a>
                <a href="{{ route('colocations.edit', $colocation) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                    Paramètres
                </a>
            </div>
            @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Filter by Month -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl p-6">
                <form method="GET" class="flex items-center space-x-4">
                    <label class="text-sm font-medium text-gray-700">Filtrer par mois:</label>
                    <select name="month" class="rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">Tous les mois</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                            </option>
                        @endfor
                    </select>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                        Filtrer
                    </button>
                </form>
            </div>

            <!-- Members Section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Membres ({{ $colocation->activeMembers()->count() }})</h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($colocation->activeMembers as $membership)
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div class="flex-shrink-0 h-12 w-12 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ substr($membership->user->name, 0, 1) }}
                            </div>
                            <div class="ml-4 flex-1">
                                <p class="font-semibold text-gray-900">{{ $membership->user->name }}</p>
                                <div class="flex items-center space-x-2">
                                    @if($membership->role === 'owner')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                        Owner
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">
                                        Membre
                                    </span>
                                    @endif
                                    <span class="text-xs text-gray-500">⭐ {{ $membership->user->reputation }}</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Balance Overview -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-6 border-b border-gray-200 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-gray-900">Vue d'ensemble des soldes</h3>
                    <a href="{{ route('expenses.create', $colocation) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 transition">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Ajouter une dépense
                    </a>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($colocation->activeMembers as $membership)
                        <div class="p-6 bg-gradient-to-br from-gray-50 to-gray-100 rounded-xl border border-gray-200">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="font-semibold text-gray-900">{{ $membership->user->name }}</h4>
                                <div class="h-10 w-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold">
                                    {{ substr($membership->user->name, 0, 1) }}
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Total payé:</span>
                                    <span class="font-semibold text-green-600">0.00 €</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-600">Part due:</span>
                                    <span class="font-semibold text-gray-900">0.00 €</span>
                                </div>
                                <div class="pt-2 border-t border-gray-300">
                                    <div class="flex justify-between">
                                        <span class="font-semibold text-gray-700">Solde:</span>
                                        <span class="font-bold text-lg text-indigo-600">0.00 €</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Settlements (Who owes whom) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Remboursements simplifiés</h3>
                    <p class="text-sm text-gray-500 mt-1">Qui doit rembourser qui</p>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-center p-8 text-gray-500">
                            <svg class="w-12 h-12 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p>Tous les comptes sont équilibrés !</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Expenses List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Historique des dépenses</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payé par</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Montant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    Aucune dépense enregistrée
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
