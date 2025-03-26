<?php

namespace Innoboxrr\Deals\Http\Requests\DealPixelFire;

use Innoboxrr\Deals\Models\DealPixelFire;
use Innoboxrr\Deals\Http\Resources\Models\DealPixelFireResource;
use Innoboxrr\Deals\Http\Events\DealPixelFire\Events\ForceDeleteEvent;
use Illuminate\Foundation\Http\FormRequest;

class ForceDeleteRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        //
    }

    public function authorize()
    {

        $dealPixelFire = DealPixelFire::withTrashed()->findOrFail($this->deal_pixel_fire_id);
        
        return $this->user()->can('forceDelete', $dealPixelFire);

    }

    public function rules()
    {
        return [
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

        $dealPixelFire = DealPixelFire::withTrashed()->findOrFail($this->deal_pixel_fire_id);

        $dealPixelFire->forceDeleteModel();

        $response = new DealPixelFireResource($dealPixelFire);

        event(new ForceDeleteEvent($dealPixelFire, $this->all(), $response));

        return $response;

    }
    
}
