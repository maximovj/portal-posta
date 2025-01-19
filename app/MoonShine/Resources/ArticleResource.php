<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Article;
use App\Models\Post;
use App\MoonShine\Resources\MoonShineUserResource;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;
use MoonShine\Laravel\Fields\Slug;
use MoonShine\Laravel\Models\MoonshineUser;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Support\Enums\PageType;
use MoonShine\TinyMce\Fields\TinyMce;
use MoonShine\UI\Collections\Fields;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Components\Layout\Column;
use MoonShine\UI\Components\Layout\Grid;
use MoonShine\UI\Components\Tabs;
use MoonShine\UI\Components\Tabs\Tab;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Field;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Json;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;


/**
 * @extends ModelResource<Article>
 */
class ArticleResource extends ModelResource
{
    protected string $model = Article::class;

    protected string $title = 'Artículos';

    protected ?PageType $redirectAfterSave = PageType::INDEX;

    protected bool $createInModal = false;

    protected bool $editInModal = false;

    protected bool $detailInModal = false;

    
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
            Date::make('Fecha de publicación','published_at'),
            Switcher::make('Publish', 'is_publish'),
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
                    Tab::make('Información del artículo (SEO)',[
                        Grid::make([
                            Column::make([
                                Image::make('Portada','cover')
                                    ->disk(config('moonshine.disk', 'public'))
                                    ->dir('posts')
                                    ->allowedExtensions(['jpg', 'png', 'jpeg']),
                                Text::make('Titulo', 'title')
                                    ->placeholder('Escribe el titulo del artículo')
                                    ->reactive(function(Fields $fields, ?string $value): Fields {
                                        return tap($fields, static fn ($fields) => $fields
                                            ->findByColumn('slug')
                                            ?->setValue(str($value ?? '')->slug()->value())
                                        );
                                    })
                                    ->required(),
                                Slug::make('URL de Entrada','slug')
                                    ->placeholder('Escribe un URL amigable para el artículo')
                                    ->hint('Este será el acceso al artículo')
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
                                Text::make('Subtitulo', 'subtitle')
                                ->placeholder('Escribe el sub-titulo del artículo')
                                    ->required(),
                                Textarea::make('Descripción para búsqueda (SEO)','summary')
                                    ->hint('Este se usará para las buscadores del artículo')
                                    ->required(),
                            ],
                            colSpan: 6,
                            adaptiveColSpan: 6),
                            Column::make([
                                BelongsTo::make(
                                    'Cuenta autor',
                                    'moonshine_user',
                                    fn($item) => "$item->name | $item->email",  
                                    resource: MoonShineUserResource::class)
                                    ->required()    
                                    ->valuesQuery(fn(Builder $query, Field $field) => $query->where('id', auth()->id()))
                                    ->withImage('avatar', 'public', 'moonshine_users')
                                    ->default(MoonshineUser::find(auth()->id()))
                                    ->disabled(),
                                Text::make('Nombre del autor', 'author')
                                    ->placeholder('Escribe el nombre del autor')
                                    ->required(),
                                Text::make('Profesión del autor', 'profession')
                                    ->placeholder('Escribe la profesión del autor')
                                    ->required(),
                                Text::make('Etiquetas', 'tags')
                                    ->hint('Agrega etiquetas para mejorar el resultado de búsquedas')
                                    ->tags(5),
                                Date::make('Fecha de publicación','published_at')
                                    ->hint('NOTA: Presiona el icono calendario para poder agregar la fecha')
                                    ->withTime()
                                    ->format('Y-m-d')
                                    ->default(Carbon::now()->addDays(15)->format(''))
                                    ->required(),
                                Json::make('Redes sociales', 'network_social')
                                    ->hint('NOTA: Presiona el icono del candado para poder editar los campos')
                                    ->fields([
                                        Text::make('Title')->locked(),
                                        Text::make('Value')->locked(),
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
                                Switcher::make('Publish', 'is_publish'),
                            ],
                            colSpan: 6,
                            adaptiveColSpan: 6),
                        ]),
                    ]),
                    Tab::make('Introducción',[
                        TinyMce::make('Introducción','header')
                            ->hint('NOTA: Todo el texto será convertido a HTML')
                            ->required(),
                    ]),
                    Tab::make('Contenido',[
                        TinyMce::make('Contenido','content')
                            ->hint('NOTA: Todo el texto será convertido a HTML')
                            ->required(),
                    ]),
                    Tab::make('Conclusión',[
                        TinyMce::make('Conclusion','footer')
                            ->hint('NOTA: Todo el texto será convertido a HTML')
                            ->required(),
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
            Text::make('Titulo', 'author'),
            Text::make('Titulo', 'profession'),
            Text::make('Titulo', 'title'),
            Slug::make('URL de Entrada','slug'),
            Text::make('Titulo', 'subtitle'),
            Textarea::make('Descripción para búsqueda (SEO)','summary'),
            Text::make('Etiquetas', 'tags'),
            TinyMce::make('Introducción','header')->required(),
            TinyMce::make('Contenido','content')->required(),
            TinyMce::make('Conclusion','footer')->required(),
            Date::make('Fecha de publicación','published_at'),
            Switcher::make('Publish', 'is_publish'),
        ];
    }

    /**
     * @param Article $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'author' => ['required', 'string', 'min:5'],
            'profession' => ['required', 'string', 'min:5'],
            'title' => ['required', 'string', 'min:5'],
            'subtitle' => ['required', 'string', 'min:5'],
            'slug' => ['required', 'string', 'min:5', Rule::unique('posts')->ignore(Request::get('id'))],
            'summary' => ['required', 'string', 'min:5'],
            'content' => ['required', 'string', 'min:5'],
            'published_at' => ['required', 'date'],
        ];
    }
}
