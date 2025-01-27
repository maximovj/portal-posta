<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Laravel\Components\Layout\{Locales, Notifications, Profile, Search};
use MoonShine\UI\Components\{Breadcrumbs,
    Components,
    Layout\Flash,
    Layout\Div,
    Layout\Body,
    Layout\Burger,
    Layout\Content,
    Layout\Footer,
    Layout\Head,
    Layout\Favicon,
    Layout\Assets,
    Layout\Meta,
    Layout\Header,
    Layout\Html,
    Layout\Layout,
    Layout\Logo,
    Layout\Menu,
    Layout\Sidebar,
    Layout\ThemeSwitcher,
    Layout\TopBar,
    Layout\Wrapper,
    When};
use App\MoonShine\Resources\ArticleResource;
use Illuminate\Support\Facades\Auth;
use MoonShine\Laravel\Models\MoonshineUser;
use MoonShine\Laravel\MoonShineAuth;
use MoonShine\MenuManager\MenuItem;

final class MoonShineLayout extends AppLayout
{
    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        $user_authenticated = auth()->user();
        $user_authenticated_role = $user_authenticated->moonshineUserRole->name;
        $menuItems = [];

        // Verificar si el usuario tiene el rol de 'Blogger'
        if ($user_authenticated && $user_authenticated_role === 'Blogger') {
            $menuItems[] = MenuItem::make('Artículos', ArticleResource::class);
        }

        if ($user_authenticated && $user_authenticated_role === 'Admin') {
            $menuItems[] = parent::menu();
        }

        return $menuItems;
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    public function build(): Layout
    {
        return parent::build();
    }
}
