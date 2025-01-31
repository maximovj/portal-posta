<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Carbon\Carbon;
use App\Models\Post;
use Illuminate\Support\Str;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Field;
use MoonShine\UI\Fields\Image;
use Illuminate\Validation\Rule;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\UI\Collections\Fields;
use MoonShine\Support\Enums\PageType;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Grid;
use Illuminate\Database\Eloquent\Builder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\UI\Components\Layout\Column;
use App\Models\MoonshineUser;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\ModelResource;
use App\MoonShine\Resources\MoonShineUserResource;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Post>
 */
class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected ?PageType $redirectAfterSave = PageType::INDEX;

    protected string $title = 'Publicaciones';

    protected bool $createInModal = false;

    protected bool $editInModal = false;

    protected bool $detailInModal = false;

    protected bool $errorsAbove = true;

    public function title(): string
    {
        return __('moonshine::ui.resource.book_title', 'Publicaciones');
    }
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Titulo', 'title'),
            Slug::make('URL de Entrada','slug'),
            Text::make('Nombre del autor', 'author'),
            Date::make('Fecha de publicación','date_published'),
            Switcher::make('Publish', 'published'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Tabs::make([
                    Tab::make('Campos para CEO',[
                        Grid::make([
                            Column::make([
                                Image::make('Portada','cover')
                                    ->disk(config('moonshine.disk', 'public'))
                                    ->dir('posts')
                                    ->allowedExtensions(['jpg', 'png', 'jpeg']),
                                Text::make('Titulo', 'title')
                                    ->reactive(function(Fields $fields, ?string $value): Fields {
                                        return tap($fields, static fn ($fields) => $fields
                                            ->findByColumn('slug')
                                            ?->setValue(str($value ?? '')->slug()->value())
                                        );
                                    })
                                    ->required(),
                                Slug::make('URL de Entrada','slug')
                                    ->unique()
                                    ->separator('-')
                                    ->from('title')
                                    ->reactive()
                                    ->onApply(function(Model $item){
                                        $item->slug = Str::slug($item->title);
                                        return $item;
                                    })
                                    ->locked()
                                    ->required(),
                                Text::make('Titulo', 'subtitle')
                                    ->required(),
                                Textarea::make('Descripción para búsqueda (SEO)','summary')
                                    ->required(),
                            ],
                            colSpan: 6,
                            adaptiveColSpan: 6),
                            Column::make([
                                BelongsTo::make(
                                    'Cuenta autor',
                                    'user',
                                    fn($item) => "$item->name | $item->email",  
                                    resource: MoonShineUserResource::class)
                                    ->required()    
                                    ->valuesQuery(fn(Builder $query, Field $field) => $query->where('id', auth()->id()))
                                    ->withImage('avatar', 'public', 'moonshine_users')
                                    ->default(MoonshineUser::find(auth()->id()))
                                    ->disabled(),
                                Text::make('Nombre del autor', 'author')->required(),
                                Text::make('Etiquetas', 'tags')
                                    ->tags(5),
                                Date::make('Fecha de publicación','date_published')
                                    ->format('Y-m-d')
                                    ->default(Carbon::now()->addDays(15)->format(''))
                                    ->required(),
                                Json::make('Redes sociales', 'network_social')
                                ->fields([
                                    Text::make('Title'),
                                    Text::make('Value'),
                                    Switcher::make('Active'),
                                ])
                                ->default([
                                    [
                                        'title' => 'Twitter',
                                        'value' => '@username',
                                        'active' => true
                                    ],
                                    [
                                        'title' => 'LinkedIn',
                                        'value' => 'username',
                                        'active' => true
                                    ]
                                ]),
                                Switcher::make('Publish', 'published'),
                            ],
                            colSpan: 6,
                            adaptiveColSpan: 6),
                        ]),
                    ]),
                    Tab::make('Introducción',[
                        TinyMce::make('Introducción','header')->required(),
                    ]),
                    Tab::make('Contenido',[
                        TinyMce::make('Contenido','content')->required(),
                    ]),
                    Tab::make('Conclusion',[
                        TinyMce::make('Conclusion','footer')->required(),
                    ]),
                ])
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Image::make('Portada','cover'),
            Text::make('Titulo', 'title'),
            Slug::make('URL de Entrada','slug'),
            Text::make('Titulo', 'subtitle'),
            Textarea::make('Descripción para búsqueda (SEO)','summary'),
            Text::make('Etiquetas', 'tags'),
            TinyMce::make('Introducción','header')->required(),
            TinyMce::make('Contenido','content')->required(),
            TinyMce::make('Conclusion','footer')->required(),
            Date::make('Fecha de publicación','date_published'),
            Switcher::make('Publish', 'published'),
        ];
    }

    /**
     * @param Post $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'title' => ['required', 'string', 'min:5'],
            'subtitle' => ['required', 'string', 'min:5'],
            'slug' => ['required', 'string', 'min:5', Rule::unique('posts')->ignore(Request::get('id'))],
            'summary' => ['required', 'string', 'min:5'],
            'content' => ['required', 'string', 'min:5'],
            'date_published' => ['required', 'date'],
        ];
    }
}
