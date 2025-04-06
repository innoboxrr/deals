<?php

namespace Innoboxrr\Deals\Models\Traits\Operations;

trait DealProductOperations
{

    public function buildPayload()
    {
        return [
            'general' => [
                'image'       => $this->meta('image'),
                'gallery'     => $this->meta('gallery'),
                'video_url'   => $this->meta('video_url'),
                'tagline'     => $this->meta('tagline'),
                'features'    => $this->meta('features'),
                'benefits'    => $this->meta('benefits'),
            ],
            'product_details' => [
                'category'      => $this->meta('category'),
                'sub_category'  => $this->meta('sub_category'),
                'brand'         => $this->meta('brand'),
                'model'         => $this->meta('model'),
                'price_range'   => $this->meta('price_range'),
                'warranty'      => $this->meta('warranty'),
                'availability'  => $this->meta('availability'),
            ],
            'target_audience' => [
                'min_age'         => $this->meta('min_age'),
                'max_age'         => $this->meta('max_age'),
                'gender'          => $this->meta('gender'),
                'ideal_interests' => $this->meta('ideal_interests'),
                'usage_context'   => $this->meta('usage_context'),
            ],
            'marketing' => [
                'key_message'     => $this->meta('key_message'),
                'differentiators' => $this->meta('differentiators'),
                'testimonials'    => $this->meta('testimonials'),
            ],
        ];
    }    

    public function updatePayload()
    {

        $this->payload = $this->buildPayload();

        return $this->save();

    }

}
