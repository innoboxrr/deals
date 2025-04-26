<?php

namespace Innoboxrr\Deals\Http\Requests\DealGateway;

use Innoboxrr\Deals\Models\DealGateway;
use Innoboxrr\Deals\Http\Resources\Models\DealGatewayResource;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SearchRequest extends FormRequest
{
    protected array $types;

    protected function prepareForValidation()
    {
        $this->types = config('app.lead_gateways');
    }

    public function authorize()
    {
        return $this->user()->can('index', DealGateway::class);
    }

    public function rules()
    {
        return [
            'type' => [
                'nullable', 
                Rule::in(array_keys($this->types))
            ],
            'search' => [
                'nullable', 
                'string'
            ],
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
        $query = $this->getModelQuery();

        $query
            ->when($this->input('name'), function ($query) {
                $query->where('name', 'like', '%' . $this->input('name') . '%');
            })
            ->when($this->input('not_in_deal_id'), function ($query) {
                $dealGateways = DealGateway::where('deal_id', $this->input('not_in_deal_id'))->pluck('id');
                $query->whereNotIn('id', $dealGateways);
            })
            ->when($this->input('workspace_id') ?? $this->input('app_workspace_id'), function ($query, $workspaceId) {
                $query->where('workspace_id', $workspaceId);
            });

        $results = $this->input('paginate') && $this->input('paginate') > 0
            ? $query->paginate($this->input('paginate'))
            : $query->get();

        return $this->formatResults($results);
    }

    protected function getModelQuery()
    {
        $type = $this->input('type'); 
        if ($type && array_key_exists($type, $this->types)) {
            return $this->types[$type]::query();
        }
        return DealGateway::query();
    }

    protected function formatResults($results)
    {
        $transform = function ($item) {
            return [
                'id' => $item->id,
                'name' => $item->name ?? null,
                'type' => mb_strtolower(class_basename($item)),
                'class' => get_class($item),
                'workspace_id' => $item->workspace_id ?? null,
                'created_at' => optional($item->created_at)->toDateTimeString(),
                'updated_at' => optional($item->updated_at)->toDateTimeString(),
            ];
        };

        if ($results instanceof \Illuminate\Pagination\AbstractPaginator) {
            $results->getCollection()->transform($transform);

            return $results;
        }
        return $results->transform($transform);
    }


}
