<?php

namespace App\MoonShine\Resources\Category;

use App\Models\Category;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;

class CategoryResource extends ModelResource
{
    protected string $model = Category::class;
    
    protected string $title = 'Categories';
    
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

            Textarea::make('Description', 'description')
                ->setAttribute('rows', 3),
        ];
    }

    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),

            Text::make('Name', 'name')
                ->sortable(),

            Textarea::make('Description', 'description'),
        ];
    }
    
    protected function detailFields(): iterable
    {
        return $this->indexFields();
    }
}