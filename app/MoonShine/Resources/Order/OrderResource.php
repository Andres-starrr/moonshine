<?php
// app/MoonShine/Resources/Order/OrderResource.php

namespace App\MoonShine\Resources\Order;

use App\Models\Order;
use App\Models\Product;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Number;

class OrderResource extends ModelResource
{
    protected string $model = Order::class;
    
    protected string $title = 'Orders';
    
    protected string $column = 'id';

    public function can(\MoonShine\Support\Enums\Ability|string $ability): bool
    {
        $user = auth()->user();
        
        if ($user instanceof \MoonShine\Laravel\Models\MoonshineUser) {
            $isAdmin = $user->moonshineUserRole?->name === 'Admin';
            
            // Convertir Enum a string si es necesario
            $abilityString = $ability instanceof \MoonShine\Support\Enums\Ability 
                ? $ability->value 
                : $ability;
            
            return match($abilityString) {
                'viewAny', 'view' => true,
                'create', 'update', 'delete' => $isAdmin,
                default => $isAdmin,
            };
        }
        
        return false;
    }

    protected function formFields(): iterable
    {
        return [
            BelongsTo::make('Product', 'product', resource: \App\MoonShine\Resources\Product\ProductResource::class)
                ->searchable()
                ->required(),

            Number::make('Quantity', 'quantity')
                ->required()
                ->min(1),

            Number::make('Total', 'total')
                ->required()
                ->min(0),
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Product', 'product', resource: \App\MoonShine\Resources\Product\ProductResource::class)
                ->searchable(),

            Number::make('Quantity', 'quantity')
                ->sortable(),

            Number::make('Total', 'total')
                ->sortable(),
        ];
    }
    
    protected function detailFields(): iterable
    {
        return $this->indexFields();
    }
}