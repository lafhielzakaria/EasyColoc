<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-gray-900">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
            </a>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ $category->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Expenses</h3>
                    <div class="flex gap-3">
                        @php
                            $categoryUrl = route('categories.show', $category->id);
                        @endphp
                        <select onchange="window.location.href = '{{ $categoryUrl }}?month=' + this.value;" class="px-3 py-2 border border-gray-300 rounded-lg text-sm">
                            @for($i = 0; $i < 12; $i++)
                                @php
                                    $date = now()->subMonths($i);
                                    $value = $date->format('Y-m');
                                @endphp
                                <option value="{{ $value }}" {{ $month == $value ? 'selected' : '' }}>
                                    {{ $date->format('F Y') }}
                                </option>
                            @endfor
                        </select>
                        <a href="{{ route('expenses.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                            Create Expense
                        </a>
                    </div>
                </div>

                @if($category->expenses->count() > 0)
                    <div class="space-y-4">
                        @foreach($category->expenses as $expense)
                            <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-gray-900">{{ $expense->description }}</p>
                                        <p class="text-sm text-gray-500">{{ $expense->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <p class="text-lg font-bold text-gray-900">{{ number_format($expense->amount, 2) }} €</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-8">No expenses yet. Create your first expense!</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
