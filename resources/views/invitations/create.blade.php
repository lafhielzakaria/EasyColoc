<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Invite People') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Choose invitation method</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Generate Key -->
                    <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-indigo-500 transition">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Generate Key</h4>
                            <p class="text-sm text-gray-600 mb-4">Create a unique invitation key that can be shared</p>
                            
                            @if(session('generatedToken'))
                                <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4 mb-4">
                                    <p class="text-xs text-gray-600 mb-2">Your invitation key:</p>
                                    <div class="flex items-center gap-2">
                                        <input type="text" value="{{ session('generatedToken') }}" readonly class="flex-1 px-3 py-2 bg-white border border-gray-300 rounded text-sm font-mono">
                                        <button onclick="navigator.clipboard.writeText('{{ session('generatedToken') }}')" class="px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                                            Copy
                                        </button>
                                    </div>
                                </div>
                            @else
                                <form method="POST" action="{{ route('invitations.generateKey') }}">
                                    @csrf
                                    <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                                        Generate Key
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <!-- Invite by Email -->
                    <div class="border-2 border-gray-200 rounded-xl p-6 hover:border-indigo-500 transition">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-2">Invite by Email</h4>
                            <p class="text-sm text-gray-600 mb-4">Send an invitation directly to someone's email</p>
                            
                            <a href="{{ route('invitations.email') }}" class="w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-medium inline-block">
                                Send Email
                            </a>
                        </div>
                    </div>

                </div>

                <div class="mt-6 text-center">
                    <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900 text-sm font-medium">
                        ← Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
