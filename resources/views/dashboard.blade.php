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
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xl font-bold text-gray-900">Recent Activity</h3>
                            @if($colocation)
                                <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                                    Create Category
                                </a>
                            @endif
                        </div>
                        <p class="text-gray-500">Your colocation activity will appear here.</p>
                    </div>

                    @if(session('settlements'))
                        <!-- Settlements -->
                        <div class="bg-white rounded-xl shadow p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Settlements Created</h3>
                            <div class="space-y-3">
                                @foreach(session('settlements') as $settlement)
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <p class="text-sm text-gray-800">
                                            <span class="font-bold text-lg">{{ number_format($settlement->amount, 2) }} €</span>: 
                                            <span class="font-medium text-red-600">{{ $settlement->debtor->name }}</span> 
                                            <span class="text-gray-500 mx-2">→</span> 
                                            <span class="font-medium text-green-600">{{ $settlement->creditor->name }}</span>
                                        </p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($settlements && $settlements->count() > 0)
                        <!-- Settlements -->
                        <div class="bg-white rounded-xl shadow p-8">
                            <div class="flex items-center justify-between mb-4">
                                <h3 class="text-xl font-bold text-gray-900">Unpaid Settlements</h3>
                                <div class="text-right">
                                    <p class="text-sm text-gray-500">Total You Owe</p>
                                    <p class="text-2xl font-bold text-red-600">{{ number_format($totalUnpaid, 2) }} €</p>
                                </div>
                            </div>
                            <div class="space-y-3">
                                @foreach($settlements as $settlement)
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <div class="flex items-center justify-between">
                                            <p class="text-sm text-gray-800">
                                                <span class="font-bold text-lg">{{ number_format($settlement->amount, 2) }} €</span>: 
                                                <span class="font-medium text-red-600">{{ $settlement->debtor->name }}</span> 
                                                <span class="text-gray-500 mx-2">→</span> 
                                                <span class="font-medium text-green-600">{{ $settlement->creditor->name }}</span>
                                            </p>
                                            @if($settlement->debtor_id == auth()->id())
                                                <form method="POST" action="{{ route('settlements.markPaid', $settlement->id) }}" class="inline">
                                                    @csrf
                                                    <button type="submit" class="px-3 py-1 bg-green-600 text-white text-xs rounded hover:bg-green-700 transition">
                                                        Mark as Paid
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if($colocation && $colocation->categories->count() > 0)
                        <!-- Categories -->
                        <div class="bg-white rounded-xl shadow p-8">
                            <h3 class="text-xl font-bold text-gray-900 mb-4">Categories</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($colocation->categories as $category)
                                    <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                        <a href="{{ route('categories.show', $category->id) }}" class="block hover:bg-gray-100 transition">
                                            <p class="font-medium text-gray-900">{{ $category->name }}</p>
                                            <p class="text-sm text-gray-500 mt-1">{{ $category->expenses->count() }} expenses</p>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    @if($colocation)
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
                                        @php
                                            $owner = $colocation->activeMembers()->where('role', 'owner')->with('user')->first();
                                        @endphp
                                        @if($owner)
                                            <p class="text-sm text-white">{{ $owner->user->name }}</p>
                                            <div class="w-5 h-5 bg-yellow-500 rounded-full flex items-center justify-center">
                                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div>
                                    <p class="text-xs text-gray-500 mb-3">MEMBERS</p>
                                    <div class="space-y-2">
                                        @php
                                            $isOwner = $colocation->activeMembers()->where('user_id', auth()->id())->where('role', 'owner')->exists();
                                        @endphp
                                        @foreach($colocation->activeMembers()->where('role', '!=', 'owner')->with('user')->get() as $membership)
                                            <div class="flex items-center justify-between bg-gray-800 rounded-lg px-4 py-3">
                                                <div class="flex items-center gap-2">
                                                    <span class="text-sm font-medium text-white">{{ $membership->user->name }}</span>
                                                    @if($isOwner)
                                                        <div class="flex items-center gap-1">
                                                            <form method="POST" action="{{ route('membership.transferOwnership', $membership->id) }}" class="inline">
                                                                @csrf
                                                                <button type="submit" class="w-6 h-6 bg-gray-700 rounded-full flex items-center justify-center hover:bg-yellow-500 transition">
                                                                    <svg class="w-3.5 h-3.5 text-gray-500 hover:text-white" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                            <form method="POST" action="{{ route('membership.remove', $membership->id) }}" class="inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="text-red-400 hover:text-red-300 transition">
                                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                </div>
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
