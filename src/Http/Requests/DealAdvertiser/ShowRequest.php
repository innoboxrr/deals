<?php

namespace Innoboxrr\Deals\Http\Requests\DealAdvertiser;

use Innoboxrr\Deals\Models\DealAdvertiser;
use Innoboxrr\Deals\Http\Resources\Models\DealAdvertiserResource;
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

        $dealAdvertiser = DealAdvertiser::findOrFail($this->deal_advertiser_id);

        return $this->user()->can('view', $dealAdvertiser);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiser::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealAdvertiser::$loadable_counts)
            ],
            'deal_advertiser_id' => 'required|numeric'
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

        $dealAdvertiser = DealAdvertiser::where('id', $this->deal_advertiser_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealAdvertiserResource($dealAdvertiser);

    }
    
}
