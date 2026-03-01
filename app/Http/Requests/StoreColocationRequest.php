<?php

namespace App\Http\Requests;

use App\Models\colocations;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreColocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return !\App\Models\memberships::where('user_id', Auth::id())
            ->where('role', 'owner')
            ->whereNull('left_at')
            ->exists();
    }

    protected function failedAuthorization()
    {
        throw \Illuminate\Validation\ValidationException::withMessages([
            'authorization' => 'Vous avez déjà une colocation active. Vous ne pouvez pas en créer une autre.'
        ]);
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:255'],
            'description' => ['nullable', 'string', 'max:500','min:20'], 
            'address' => ['nullable', 'string', 'max:255', 'regex:/^\d+\s+[\w\s]+,\s*\d{5}\s+[\w\s]+$/u']
        ];
    }
}
