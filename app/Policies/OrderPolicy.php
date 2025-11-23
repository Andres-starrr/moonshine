<?php

namespace App\Policies;

use App\Models\Order;
use MoonShine\Laravel\Models\MoonshineUser;

class OrderPolicy
{
    public function viewAny(MoonshineUser $user): bool
    {
        return true;
    }

    public function view(MoonshineUser $user, Order $order): bool
    {
        return true;
    }

    public function create(MoonshineUser $user): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }

    public function update(MoonshineUser $user, Order $order): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }

    public function delete(MoonshineUser $user, Order $order): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }

    public function restore(MoonshineUser $user, Order $order): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }

    public function forceDelete(MoonshineUser $user, Order $order): bool
    {
        return $user->moonshineUserRole?->name === 'Admin';
    }
}