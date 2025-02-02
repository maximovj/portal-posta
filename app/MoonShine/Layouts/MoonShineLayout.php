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
use App\Models\MoonshineUser;
use MoonShine\Laravel\MoonShineAuth;
use MoonShine\MenuManager\MenuItem;
use App\MoonShine\Resources\CommentResource;

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
        // Verificar si el usuario está autenticado
        if (moonshine_user()) {
            // Si el usuario tiene el rol de 'Admin', combinar los menús de la clase padre y 'Artículos'
            if (moonshine_role_name() === 'Admin') {
                return [
                    ...parent::menu(),
        ];
            }

            // Si el usuario tiene el rol de 'Blogger', mostrar solo el menú de 'Artículos'
            if (moonshine_role_name() === 'Blogger') {
                return [
                    MenuItem::make('Artículos', ArticleResource::class),
                    MenuItem::make('Comentarios', CommentResource::class),
                ];
            }
        }

        // Si el usuario no está autenticado o no tiene un rol válido, devolver un menú vacío
        return [];
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
