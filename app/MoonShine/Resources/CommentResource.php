<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Article;
use App\Models\Comment;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Field;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Switcher;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Support\Enums\PageType;
use MoonShine\TinyMce\Fields\TinyMce;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Laravel\Pages\Crud\IndexPage;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Laravel\Resources\ModelResource;
use Illuminate\Contracts\Database\Eloquent\Builder;
use MoonShine\Laravel\Fields\Relationships\BelongsTo;

/**
 * @extends ModelResource<Comment>
 */
class CommentResource extends ModelResource
{
    protected string $model = Comment::class;

    protected string $title = 'Comentarios';

    protected ?PageType $redirectAfterSave = PageType::INDEX;

    protected array $with = ['article', 'moonshine_user'];

    protected bool $columnSelection = true;

    protected bool $createInModal = false;

    protected bool $editInModal = false;

    protected bool $detailInModal = false;

    //protected bool $withPolicy = true;

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            IndexPage::class,
            FormPage::class,
            DetailPage::class,
        ];
    }

    protected function modifyQueryBuilder(Builder $builder): Builder
    {
        return $builder->whereHas('moonshine_user', function ($query) {
            $query->where('id', auth()->id());
        });
    }
    
    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make(
                'Articulo',
                'article',
                fn($item) => "$item->title | $item->author",  
                resource: ArticleResource::class)
                ->sortable()
                ->required()    
                ->valuesQuery(fn(Builder $query, Field $field) => $query->where('id', auth()->id()))
                ->withImage('cover', config('moonshine.disk', 'public'), 'posts')
                ->disabled(),
            Text::make('Título del comentario', 'title')
                ->sortable()
                ->required(),
            Text::make('Etiquetas', 'tags')
                ->hint('Agrega etiquetas para mejorar el resultado de búsquedas')
                ->sortable()
                ->tags(5),
            Switcher::make('Publicar', 'is_publish'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                ID::make()->sortable(),
                BelongsTo::make(
                    'Articulo',
                    'article',
                    fn($item) => "$item->title | $item->author",  
                    resource: ArticleResource::class)
                    ->sortable()
                    ->required()    
                    ->valuesQuery(fn(Builder $query, Field $field) => $query->where('id', auth()->id()))
                    ->withImage('cover', config('moonshine.disk', 'public'), 'articles'),
                Text::make('Título del comentario', 'title')
                    ->sortable()
                    ->required(),
                TinyMce::make('Contenido','content')
                    ->menubar(false)
                    //->toolbar(true)
                    //->addPlugins(['code', 'image', 'link', 'media', 'table', 'autoresize'])
                    ->sortable()
                    ->required(),
                Text::make('Etiquetas', 'tags')
                    ->hint('Agrega etiquetas para mejorar el resultado de búsquedas')
                    ->sortable()
                    ->tags(5),
                Switcher::make('Publicar', 'is_publish'),
            ])
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make(
                'Articulo',
                'article',
                fn($item) => "$item->title | $item->author",  
                resource: ArticleResource::class)
                ->sortable()
                ->required()    
                ->valuesQuery(fn(Builder $query, Field $field) => $query->where('id', auth()->id()))
                ->withImage('cover', config('moonshine.disk', 'public'), 'articles')
                ->disabled(),
            Text::make('Título del comentario', 'title')
                ->sortable()
                ->required(),
            Textarea::make('Contenido','content')
                ->sortable()
                ->required(),
            Text::make('Etiquetas', 'tags')
                ->hint('Agrega etiquetas para mejorar el resultado de búsquedas')
                ->sortable()
                ->tags(5),
            Switcher::make('Publicar', 'is_publish'),
        ];
    }

    protected function filters(): iterable
    {
        return [
            BelongsTo::make(
                'Articulo',
                'article',
                fn($item) => "$item->title | $item->author",  
                resource: ArticleResource::class)
                ->withImage('cover', config('moonshine.disk', 'public'), 'posts'),
            Text::make('Titulo', 'title'),
            Text::make('Etiquetas', 'tags')
                ->tags(5),
            Switcher::make('Publicado', 'is_publish'),
        ];
    }

    protected function search(): array
    {
        return [
            'id',
            'article',
            'title',
            'content',
            'tags',
        ];
    }

    /**
     * @param Comment $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'article_id' => ['required', 'exists:articles,id'],
            'title' => ['required', 'string', 'min:1'],
            'content' => ['required', 'string', 'min:5'],
        ];
    }




}
