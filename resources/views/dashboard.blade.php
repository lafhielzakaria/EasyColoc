<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-lg mb-6">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
            @endif

            @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-lg mb-6">
                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                
                <!-- Main Content -->
                <div class="lg:col-span-3 space-y-6">
                    
                    <!-- Welcome Card -->
                    <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-xl shadow-lg p-8 text-white">
                        <h3 class="text-3xl font-bold mb-2">Welcome, {{ auth()->user()->name }}! 👋</h3>
                        <p class="text-indigo-100">Manage your colocation expenses easily</p>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white rounded-xl shadow p-6">
                            <p class="text-sm text-gray-500 mb-1">My Balance</p>
                            <p class="text-3xl font-bold text-gray-900">0.00 €</p>
                        </div>
                        <div class="bg-white rounded-xl shadow p-6">
                            <p class="text-sm text-gray-500 mb-1">Expenses</p>
                            <p class="text-3xl font-bold text-gray-900">0</p>
                        </div>
                        <div class="bg-white rounded-xl shadow p-6">
                            <p class="text-sm text-gray-500 mb-1">Reputation</p>
                            <p class="text-3xl font-bold text-gray-900">{{ auth()->user()->reputation }}</p>
                        </div>
                    </div>

                    <!-- Activity -->
                    <div class="bg-white rounded-xl shadow p-8">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Recent Activity</h3>
                        <p class="text-gray-500">Your colocation activity will appear here.</p>
                    </div>

                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    @if(auth()->user()->activeMembership)
                        <!-- Colocation Card -->
                        <div class="bg-gray-900 rounded-xl shadow-xl overflow-hidden sticky top-6">
                            <div class="p-6 border-b border-gray-800">
                                <h3 class="text-xl font-bold text-white mb-2">{{ $colocation->name }}</h3>
                                @if($colocation->description)
                                    <p class="text-gray-400 text-sm">{{ $colocation->description }}</p>
                                @endif
                            </div>
                            
                            <div class="p-6">
                                @if($colocation->address)
                                    <div class="mb-6">
                                        <p class="text-xs text-gray-500 mb-1">Address</p>
                                        <p class="text-sm text-white">{{ $colocation->address }}</p>
                                    </div>
                                @endif

                                <div class="mb-6">
                                    <p class="text-xs text-gray-500 mb-1">Owner</p>
                                    <div class="flex items-center gap-2">
                                        <p class="text-sm text-white">{{ $colocation->owner->name }}</p>
                                        <div class="w-5 h-5 bg-yellow-500 rounded-full flex items-center justify-center">
                                            <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <p class="text-xs text-gray-500 mb-3">MEMBERS</p>
                                    <div class="space-y-2">
                                        @foreach($colocation->activeMembers()->with('user')->get() as $membership)
                                            <div class="flex items-center justify-between bg-gray-800 rounded-lg px-4 py-3">
                                                <span class="text-sm font-medium text-white">{{ $membership->user->name }}</span>
                                                @if($membership->role === 'owner')
                                                    <div class="w-6 h-6 bg-yellow-500 rounded-full flex items-center justify-center">
                                                        <svg class="w-3.5 h-3.5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    </div>
                                                @else
                                                    <div class="w-6 h-6 bg-gray-700 rounded-full flex items-center justify-center">
                                                        <svg class="w-3.5 h-3.5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                    
                                    <form method="POST" action="{{ route('colocation.leave') }}" class="mt-4">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition text-sm font-medium">
                                            Leave Colocation
                                        </button>
                                    </form>
                                    
                                    <a href="{{ route('invitations.create') }}" class="mt-4 w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                                        Invite People
                                    </a>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- No Colocation -->
                        <div class="bg-white rounded-xl shadow p-8 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Colocation</h3>
                            <p class="text-sm text-gray-500 mb-6">Create or join one</p>
                            <div class="grid grid-cols-2 gap-3">
                                <a href="{{ route('invitations.join') }}" class="px-4 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition text-sm font-medium shadow-sm">
                                    Join Colocation
                                </a>
                                <a href="{{ route('colocations.create') }}" class="px-4 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium shadow-sm">
                                    Create Colocation
                                </a>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
