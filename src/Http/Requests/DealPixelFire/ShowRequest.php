<?php

namespace Innoboxrr\Deals\Http\Requests\DealPixelFire;

use Innoboxrr\Deals\Models\DealPixelFire;
use Innoboxrr\Deals\Http\Resources\Models\DealPixelFireResource;
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

        $dealPixelFire = DealPixelFire::findOrFail($this->deal_pixel_fire_id);

        return $this->user()->can('view', $dealPixelFire);

    }

    public function rules()
    {
        return [
            'load_relations' => [
                'nullable',
                'array',
                Rule::in(DealPixelFire::$loadable_relations)
            ],
            'load_counts' => [
                'nullable',
                'array',
                Rule::in(DealPixelFire::$loadable_counts)
            ],
            'deal_pixel_fire_id' => 'required|numeric'
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

        $dealPixelFire = DealPixelFire::where('id', $this->deal_pixel_fire_id)
            ->with($this->load_relations ?? [])
            ->withCount($this->load_counts ?? [])
            ->firstOrFail();

        return new DealPixelFireResource($dealPixelFire);

    }
    
}
