<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserPaymentMethod;

use Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PolicyRequest extends FormRequest
{

    protected $policies = [
        'index',
        'view',
        'viewAny',
        'create',
        'update',
        'delete',
        'restore',
        'forceDelete',
        'export',
    ];

    protected $modelPolicies = [
        'view',
        'update',
        'delete',
        'restore',
        'forceDelete',
    ];

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
            'policy' => [
                'required',
                Rule::in($this->policies)
            ],
            'id' => [
                'numeric',
                'exists:Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod,id',
                Rule::requiredIf(in_array($this->policy, $this->modelPolicies)),
            ]
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

    public function handle()
    {

         $dealAdvertiserPaymentMethod = ($this->id) ? 
            DealAdvertiserPaymentMethod::findOrFail($this->id) : 
            app(DealAdvertiserPaymentMethod::class);

        return response()->json([
            $this->policy => $this->user()->can($this->policy, $dealAdvertiserPaymentMethod),
        ]);

    }

}
