<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Invite by Email') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-md mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Send Email Invitation</h3>
                
                <form method="POST" action="{{ route('invitations.store') }}">
                    @csrf
                    
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email Address
                        </label>
                        <input type="email" name="email" id="email" required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror"
                               placeholder="Enter email address">
                        @error('email')
                            <div class="mt-2 bg-red-50 border-l-4 border-red-500 p-3 rounded">
                                <p class="text-sm font-medium text-red-800">{{ $message }}</p>
                            </div>
                        @enderror
                    </div>

                    <div class="flex gap-3">
                        <a href="{{ route('invitations.create') }}" class="flex-1 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition text-center font-medium">
                            Cancel
                        </a>
                        <button type="submit" class="flex-1 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium">
                            Send
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
