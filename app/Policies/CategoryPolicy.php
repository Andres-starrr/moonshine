<?php

namespace App\Policies;

use App\Models\Category;
use MoonShine\Laravel\Models\MoonshineUser;

class CategoryPolicy
{
    public function viewAny(MoonshineUser $user): bool
    {
        return true;
    }

    public function view(MoonshineUser $user, Category $category): bool
    {
        return true;
    }

    public function create(MoonshineUser $user): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }

    public function update(MoonshineUser $user, Category $category): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }

    public function delete(MoonshineUser $user, Category $category): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }

    public function restore(MoonshineUser $user, Category $category): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }

    public function forceDelete(MoonshineUser $user, Category $category): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }
}