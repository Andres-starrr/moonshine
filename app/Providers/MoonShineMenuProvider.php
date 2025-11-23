<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use MoonShine\MenuManager\MenuGroup;
use MoonShine\MenuManager\MenuItem;
use MoonShine\Laravel\Menu\Menu;

use App\MoonShine\Resources\Category\CategoryResource;
use App\MoonShine\Resources\Product\ProductResource;
use App\MoonShine\Resources\Order\OrderResource;
use App\MoonShine\Resources\MoonShineUser\MoonShineUserResource;
use App\MoonShine\Resources\MoonShineUserRole\MoonShineUserRoleResource;

class MoonShineMenuProvider extends ServiceProvider
{
    public function boot(): void
    {
        Menu::make()
            ->add(
                MenuGroup::make('Gestión', [
                    MenuItem::make('Categorías', CategoryResource::class),
                    MenuItem::make('Productos', ProductResource::class),
                    MenuItem::make('Órdenes', OrderResource::class),
                ])
            )
            ->add(
                MenuGroup::make('Usuarios', [
                    MenuItem::make('Usuarios MoonShine', MoonShineUserResource::class),
                    MenuItem::make('Roles MoonShine', MoonShineUserRoleResource::class),
                ])
            );
    }
}
