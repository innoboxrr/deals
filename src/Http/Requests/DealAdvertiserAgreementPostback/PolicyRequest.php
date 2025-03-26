<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementPostback;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback;
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
                'exists:Innoboxrr\Deals\Models\DealAdvertiserAgreementPostback,id',
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

         $dealAdvertiserAgreementPostback = ($this->id) ? 
            DealAdvertiserAgreementPostback::findOrFail($this->id) : 
            app(DealAdvertiserAgreementPostback::class);

        return response()->json([
            $this->policy => $this->user()->can($this->policy, $dealAdvertiserAgreementPostback),
        ]);

    }

}
