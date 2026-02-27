<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Join Colocation') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Enter Invitation Key</h3>
                
                <form method="POST" action="{{ route('invitations.accept') }}">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="token" class="block text-sm font-medium text-gray-700 mb-2">
                            Invitation Key
                        </label>
                        <input type="text" name="token" id="token" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('token') border-red-500 @enderror"
                               placeholder="Enter your invitation key">
                        @error('token')
                            <div class="mt-2 bg-red-50 border-l-4 border-red-500 p-3 rounded">
                                <p class="text-sm font-medium text-red-800">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('dashboard') }}" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-center font-medium">
                            Cancel
                        </a>
                        <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                            Join
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
