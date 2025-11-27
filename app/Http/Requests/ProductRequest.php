<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class ProductRequest extends FormRequest
{
    /**
     * Autoriza la petición. Si hubiera lógica adicional, se colocaría aquí.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Reglas de validación y casting esperado.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
            'released_at' => ['nullable', 'date'],
            'image' => ['nullable', 'image', 'max:2048'],
            'metadata' => ['nullable', 'array'],
            'slug' => ['nullable', 'string', 'max:255'],
        ];
    }

    /**
     * Mensajes personalizados para guiar al desarrollador o usuario.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'price.numeric' => 'El precio debe ser un número válido.',
            'image.image' => 'La imagen debe ser un archivo de imagen válido.',
            'metadata.array' => 'Los metadatos deben llegar como un arreglo JSON.',
        ];
    }

    /**
     * Antes de validar ajustamos valores como checkbox o JSON manual.
     */
    protected function prepareForValidation(): void
    {
        if ($this->has('metadata') && is_string($this->input('metadata'))) {
            $decoded = json_decode($this->input('metadata'), true);
            if (is_array($decoded)) {
                $this->merge(['metadata' => $decoded]);
            }
        }

        $this->merge([
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    /**
     * Retorna solo los datos útiles para persistencia.
     */
    public function normalized(): array
    {
        $data = Arr::only($this->validated(), [
            'name',
            'slug',
            'description',
            'price',
            'stock',
            'is_active',
            'released_at',
            'metadata',
        ]);

        if (! array_key_exists('metadata', $data)) {
            $data['metadata'] = [];
        }

        return $data;
    }
}

