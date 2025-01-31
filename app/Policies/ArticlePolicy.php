<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\Article;
use App\Models\MoonshineUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArticlePolicy
{
    use HandlesAuthorization;

    public function viewAny(MoonshineUser $user): bool
    {
        return true;
    }

    public function view(MoonshineUser $user, Article $item): bool
    {
        return $user->id === $item->moonshine_user_id;
    }

    public function create(MoonshineUser $user): bool
    {
        return true;
    }

    public function update(MoonshineUser $user, Article $item): bool
    {
        return $user->id === $item->moonshine_user_id;
    }

    public function delete(MoonshineUser $user, Article $item): bool
    {
        return $user->id === $item->moonshine_user_id;
    }

    public function restore(MoonshineUser $user, Article $item): bool
    {
        return $user->id === $item->moonshine_user_id;
    }

    public function forceDelete(MoonshineUser $user, Article $item): bool
    {
        return $user->id === $item->moonshine_user_id;
    }

    public function massDelete(MoonshineUser $user): bool
    {
        return true;
    }
}
