<?php

namespace App\Policies;

use App\Models\Product;
use MoonShine\Laravel\Models\MoonshineUser;

class ProductPolicy
{
    public function viewAny(MoonshineUser $user): bool
    {
        return true;
    }

    public function view(MoonshineUser $user, Product $product): bool
    {
        return true;
    }

    public function create(MoonshineUser $user): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }

    public function update(MoonshineUser $user, Product $product): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }

    public function delete(MoonshineUser $user, Product $product): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }

    public function restore(MoonshineUser $user, Product $product): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }

    public function forceDelete(MoonshineUser $user, Product $product): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }
}