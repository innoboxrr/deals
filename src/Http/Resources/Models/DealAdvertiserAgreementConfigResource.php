<?php

namespace Innoboxrr\Deals\Http\Resources\Models;

use Illuminate\Http\Resources\Json\JsonResource;

class DealAdvertiserAgreementConfigResource extends JsonResource
{
    
    public function toArray($request)
    {

        if ($request->has('appends') && is_array($request->get('appends'))) {
            $this->resource->setAppends($request->get('appends'));
        }
        
        return parent::toArray($request) + [
            'actions' => $this->actions($request)
        ];

    }

    private function actions($request) 
    {

        $actions = [];

        // Validaciones individuales por operación

        $actions[] = $this->view();

        $actions[] = $this->edit();

        $actions[] = $this->delete();

        return $actions;

    }

    private function view() 
    {
        return [
            'id' => 'view',
            'name' => 'Ver',
            'callback' => 'viewDealAdvertiserAgreementConfig',
            'icon' => 'fa-eye',
            'route' => true,
            'policy' => false,
            'params' => [
                'id' => $this->id,
                'to' => [
                    'name' => 'AdminShowDealAdvertiserAgreementConfig',
                    'params' => [
                        'id' => $this->id
                    ]
                ]
            ]
        ];
    }

    private function edit()
    {
        return [
            'id' => 'update',
            'name' => 'Editar',
            'callback' => 'editDealAdvertiserAgreementConfig',
            'icon' => 'fa-edit',
            'route' => true,
            'policy' => false,
            'params' => [
                'id' => $this->id,
                'to' => [
                    'name' => 'AdminEditDealAdvertiserAgreementConfig',
                    'params' => [
                        'id' => $this->id
                    ]
                ]
            ]
        ];
    }

    private function delete()
    {
        return [
            'id' => 'delete',
            'name' => 'Eliminar',
            'callback' => 'deleteModel',
            'icon' => 'fa-trash-alt',
            'route' => false,
            'policy' => false,
            'params' => [
                'id' => $this->id
            ]
        ];
    }
}
