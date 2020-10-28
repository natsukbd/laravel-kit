<?php

declare(strict_types=1);

namespace App\Http\Requests\Api\Kit;

use Illuminate\Foundation\Http\FormRequest;

final class VarietyRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'fields' => 'array',
            'show_relationships' => 'boolean|required'
        ];
    }
}
