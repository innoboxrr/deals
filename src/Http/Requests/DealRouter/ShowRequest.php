<?php

namespace Innoboxrr\Deals\Http\Requests\DealRouter;

use Innoboxrr\Deals\Models\DealRouter;
use Innoboxrr\Deals\Http\Resources\Models\DealRouterResource;
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

        $dealRouter = DealRouter::findOrFail($this->deal_router_id);

        return $this->user()->can('view', $dealRouter);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealRouter::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealRouter::$loadable_counts)
            ],
            'deal_router_id' => 'required|numeric'
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

        $dealRouter = DealRouter::where('id', $this->deal_router_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealRouterResource($dealRouter);

    }
    
}
