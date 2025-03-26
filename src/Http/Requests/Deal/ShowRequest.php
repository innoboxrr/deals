<?php

namespace Innoboxrr\Deals\Http\Requests\Deal;

use Innoboxrr\Deals\Models\Deal;
use Innoboxrr\Deals\Http\Resources\Models\DealResource;
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

        $deal = Deal::findOrFail($this->deal_id);

        return $this->user()->can('view', $deal);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(Deal::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(Deal::$loadable_counts)
            ],
            'deal_id' => 'required|numeric'
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

        $deal = Deal::where('id', $this->deal_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealResource($deal);

    }
    
}
