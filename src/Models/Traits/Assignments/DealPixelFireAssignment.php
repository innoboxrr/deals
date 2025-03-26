<?php

namespace Innoboxrr\Deals\Models\Traits\Assignments;

/* Replace the word "Model" and "model" */

trait DealPixelFireAssignment
{

	public function assignModel($request)
	{

        $operationResult = $this->models()->syncWithoutDetaching([
            $request->model_id => [
            	// Pivot values
            ]
        ]);

        return response()->json([
        	'model_id' => $request->model_id,
        	'deal_pixel_fire_id' => $request->deal_pixel_fire_id,
        	'operation' => $operationResult
        ]);

	}

	public function deallocateModel($request)
	{

		$operationResult = $this->models()->detach($request->model_id);

		return response()->json([
        	'model_id' => $request->model_id,
        	'deal_pixel_fire_id' => $request->deal_pixel_fire_id,
        	'operation' => $operationResult
        ]);

	}

}