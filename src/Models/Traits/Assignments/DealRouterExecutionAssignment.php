<?php

namespace Innoboxrr\Deals\Models\Traits\Assignments;

/* Replace the word "Model" and "model" */

trait DealRouterExecutionAssignment
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
        	'deal_router_execution_id' => $request->deal_router_execution_id,
        	'operation' => $operationResult
        ]);

	}

	public function deallocateModel($request)
	{

		$operationResult = $this->models()->detach($request->model_id);

		return response()->json([
        	'model_id' => $request->model_id,
        	'deal_router_execution_id' => $request->deal_router_execution_id,
        	'operation' => $operationResult
        ]);

	}

}