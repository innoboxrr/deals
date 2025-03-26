<?php

namespace Innoboxrr\Deals\Models\Traits\Assignments;

/* Replace the word "Model" and "model" */

trait DealSessionEventAssignment
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
        	'deal_session_event_id' => $request->deal_session_event_id,
        	'operation' => $operationResult
        ]);

	}

	public function deallocateModel($request)
	{

		$operationResult = $this->models()->detach($request->model_id);

		return response()->json([
        	'model_id' => $request->model_id,
        	'deal_session_event_id' => $request->deal_session_event_id,
        	'operation' => $operationResult
        ]);

	}

}