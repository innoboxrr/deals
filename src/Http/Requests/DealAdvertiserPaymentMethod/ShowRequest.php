<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserPaymentMethod;

use Innoboxrr\Deals\Models\DealAdvertiserPaymentMethod;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserPaymentMethodResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ShowRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealAdvertiserPaymentMethod = DealAdvertiserPaymentMethod::findOrFail($this->deal_advertiser_payment_method_id);

        return $this->user()->can('view', $dealAdvertiserPaymentMethod);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserPaymentMethod::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserPaymentMethod::$loadable_counts)
            ],
            'deal_advertiser_payment_method_id' => 'required|numeric'
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

        $dealAdvertiserPaymentMethod = DealAdvertiserPaymentMethod::where('id', $this->deal_advertiser_payment_method_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdvertiserPaymentMethodResource($dealAdvertiserPaymentMethod);

    }
    
}
