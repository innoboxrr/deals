<?php

namespace Innoboxrr\Deals\Http\Requests\DealPixelFire;

use Innoboxrr\Deals\Models\DealPixelFire;
use Innoboxrr\Deals\Http\Resources\Models\DealPixelFireResource;
use Innoboxrr\Deals\Http\Events\DealPixelFire\Events\UpdateEvent;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {
        
        $dealPixelFire = DealPixelFire::findOrFail($this->deal_pixel_fire_id);

        return $this->user()->can('update', $dealPixelFire);

    }

    public function rules()
    {
        return [
            //
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

        $dealPixelFire = DealPixelFire::findOrFail($this->deal_pixel_fire_id);

        $dealPixelFire = $dealPixelFire->updateModel($this);

        $response = new DealPixelFireResource($dealPixelFire);

        event(new UpdateEvent($dealPixelFire, $this->all(), $response));

        return $response;

    }

}
