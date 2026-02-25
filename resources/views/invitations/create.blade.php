<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Inviter un membre') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-8">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">{{ $colocation->name }}</h3>
                        <p class="text-sm text-gray-600 mt-1">Invitez un nouveau membre à rejoindre votre colocation</p>
                    </div>

                    <form method="POST" action="{{ route('invitations.send', $colocation) }}" class="space-y-6">
                        @csrf

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Adresse email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" id="email" required
                                   class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 @error('email') border-red-500 @enderror"
                                   value="{{ old('email') }}"
                                   placeholder="exemple@email.com">
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Message (optional) -->
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">
                                Message personnel (optionnel)
                            </label>
                            <textarea name="message" id="message" rows="4"
                                      class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                      placeholder="Ajoutez un message personnel à votre invitation...">{{ old('message') }}</textarea>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded">
                            <div class="flex">
                                <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        Un email d'invitation sera envoyé à cette adresse avec un lien unique pour rejoindre la colocation.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="{{ route('colocations.show', $colocation) }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition font-medium">
                                Annuler
                            </a>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                                Envoyer l'invitation
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Pending Invitations -->
            @if($pendingInvitations->count() > 0)
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-xl">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Invitations en attente</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @foreach($pendingInvitations as $invitation)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <div>
                                <p class="font-medium text-gray-900">{{ $invitation->email }}</p>
                                <p class="text-sm text-gray-500">Envoyée le {{ $invitation->created_at->format('d/m/Y à H:i') }}</p>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-xs font-medium rounded-full">
                                    En attente
                                </span>
                                <form method="POST" action="{{ route('invitations.cancel', $invitation) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">
                                        Annuler
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
