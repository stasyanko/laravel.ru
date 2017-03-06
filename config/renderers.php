<?php
/**
 * This file is part of laravel.su package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Рендер содержания по-умолчанию
    |--------------------------------------------------------------------------
    |
    | Укажите значение для "ключа" рендера по-умолчанию. Список всех доступных
    | рендеров содержатся в массиве "renderers" этого файла конфигурации.
    |
    */
    'default' => 'markdown',

    'renderers' => [
        /*
        |--------------------------------------------------------------------------
        | Рендер для парсинга Markdown разметки
        |--------------------------------------------------------------------------
        |
        | Это html-редер по-умолчанию. Используется для рендера GitHub
        | разметки в html.
        |
        */
        'markdown' => \Service\ContentRenderer\Renderers\MarkdownRenderer::class,

        /*
        |--------------------------------------------------------------------------
        | Рендер для парсинга документации Laravel
        |--------------------------------------------------------------------------
        |
        | Этот html-редер основан на рендере GitHub Markdown за исключением
        | дополнительной, специфичной для документации Laravel разметки.
        | Выберите его, если требуется Laravel-совместимый html-редер.
        |
        */
        'laravel'  => \Service\ContentRenderer\Renderers\LaravelDocsRenderer::class,

        /*
        |--------------------------------------------------------------------------
        | Рендер для парсинга документации Laravel из репозитория LaravelRUS
        |--------------------------------------------------------------------------
        |
        | Этот html-редер основан на рендере Laravel. Помимо основных соглашений вырезает
        | из исходного текста данные, специфичные для переводов репозитория LaravelRUS.
        |
        */
        'laravel-rus'  => \Service\ContentRenderer\Renderers\LaravelRusDocsRenderer::class,

        /*
        |--------------------------------------------------------------------------
        | Текстовый рендер
        |--------------------------------------------------------------------------
        |
        | Это markdown рендер, включающий в себя все текстовые теги и исключающий
        | всю визуализацию (все картинки и заголовки).
        | Например при отображении "Tip of the day".
        |
        */
        'text'     => \Service\ContentRenderer\Renderers\RawTextRenderer::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Контекстуальный биндинг
    |--------------------------------------------------------------------------
    |
    | Добавьте сюда ссылки на классы, для которых следует включить инжект
    | определённого текстового рендера при получении зависимости:
    |
    | <code>
    |   public function __construct(ContentRendererInterface $smth)
    |   {
    |       ...
    |   }
    | </code>
    |
    */
    'mapping' => [
         \App\Models\Tip\ContentObserver::class => 'text',
    ],
];
