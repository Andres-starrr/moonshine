<?php
// app/MoonShine/Resources/Product/ProductResource.php

namespace App\MoonShine\Resources\Product;

use App\Models\Product;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;

class ProductResource extends ModelResource
{
    protected string $model = Product::class;
    
    protected string $title = 'Products';
    
    protected string $column = 'name';

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
            Text::make('Name', 'name')
                ->required(),

            Text::make('Description', 'description')
                ->required(),

            Number::make('Price', 'price')
                ->required()
                ->min(0),

            Number::make('Stock', 'stock')
                ->required()
                ->min(0)
                ->default(0),

            BelongsTo::make('Category', 'category', resource: \App\MoonShine\Resources\Category\CategoryResource::class)
                ->searchable()
                ->required(),
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),

            Text::make('Name', 'name')
                ->sortable(),

            Text::make('Description', 'description'),

            Number::make('Price', 'price')
                ->sortable(),

            Number::make('Stock', 'stock')
                ->sortable(),

            BelongsTo::make('Category', 'category', resource: \App\MoonShine\Resources\Category\CategoryResource::class)
                ->searchable(),
        ];
    }
    
    protected function detailFields(): iterable
    {
        return $this->indexFields();
    }
}