<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiserAgreementDaily;

use Innoboxrr\Deals\Models\DealAdvertiserAgreementDaily;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserAgreementDailyResource;
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

        $dealAdvertiserAgreementDaily = DealAdvertiserAgreementDaily::findOrFail($this->deal_advertiser_agreement_daily_id);

        return $this->user()->can('view', $dealAdvertiserAgreementDaily);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementDaily::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiserAgreementDaily::$loadable_counts)
            ],
            'deal_advertiser_agreement_daily_id' => 'required|numeric'
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

        $dealAdvertiserAgreementDaily = DealAdvertiserAgreementDaily::where('id', $this->deal_advertiser_agreement_daily_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdvertiserAgreementDailyResource($dealAdvertiserAgreementDaily);

    }
    
}
