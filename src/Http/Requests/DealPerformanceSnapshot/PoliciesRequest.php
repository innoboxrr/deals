<?php

namespace Innoboxrr\Deals\Http\Requests\DealPerformanceSnapshot;

use Innoboxrr\Deals\Models\DealPerformanceSnapshot;
use Illuminate\Foundation\Http\FormRequest;

class PoliciesRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'id' => 'nullable|numeric|exists:Innoboxrr\Deals\Models\DealPerformanceSnapshot,id'
        ];
    }

    public function messages()
    {
        return [
            //
        ];
    }

    public function attributes()
    {
        return [
            //
        ];
    }

    protected function passedValidation()
    {
        //
    }

    public function handle($controllerClass)
    {

        $model = ($this->id) ? DealPerformanceSnapshot::findOrFail($this->id) : app(DealPerformanceSnapshot::class);

        $result = [];

        $methods = get_class_methods($controllerClass);

        $policyMethodMapping = [
            'show' => 'view', // Mapea 'show' a 'view'
            // Agrega aquí más mapeos si es necesario
        ];

        foreach ($methods as $method) {

            $policyMethod = $policyMethodMapping[$method] ?? $method; // Obtiene el nombre de la política correspondiente, o el mismo nombre del método si no hay mapeo

            if (method_exists($controllerClass, $method) && is_callable([$controllerClass, $method])) {
            
                $result[$method] = $this->user()->can($policyMethod, $model);
        
                $result[$policyMethod] = $this->user()->can($policyMethod, $model);
            
            }

        }

        return response()->json($result);

    }
    
}
