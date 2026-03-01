<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ $category->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow p-8">
                <div class="flex items-center justify-between mb-6">
                    <h3 class="text-xl font-bold text-gray-900">Expenses</h3>
                    <a href="{{ route('expenses.create', ['category_id' => $category->id]) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                        Create Expense
                    </a>
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
