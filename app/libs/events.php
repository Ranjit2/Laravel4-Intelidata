<?php namespace libs\Events;

// http://jasonlewis.me/article/laravel-events
// http://heera.it/

Event::fire('laravel.done                [Response $response]');
Event::fire('laravel.log                 [String $type, String $message]');
Event::fire('laravel.query               [String $sql, Array $bindings, String $time]');
Event::fire('laravel.resolving           [String $type, Mixed $object]');
Event::fire('laravel.composing: {view}   [View $view]');
Event::fire('laravel.started: {bundle}   [String $bundle]');
Event::first('laravel.controller.factory [String $controller]');
Event::first('laravel.config.loader      [String $bundle, String $file]');
Event::first('laravel.language.loader    [String $bundle, String $language, String $file]');
Event::until('laravel.view.loader        [String $bundle, String $view]');
Event::until('laravel.view.engine        [View $view]');
Event::first('laravel.view.filter        [String $content, String $path]');
Event::fire('eloquent.saving             [Eloquent $model]');
Event::fire('eloquent.saving: {model}    [Eloquent $model]');
Event::fire('eloquent.updated            [Eloquent $model]');
Event::fire('eloquent.updated: {model}   [Eloquent $model]');
Event::fire('eloquent.created            [Eloquent $model]');
Event::fire('eloquent.created: {model}   [Eloquent $model]');
Event::fire('eloquent.saved              [Eloquent $model]');
Event::fire('eloquent.saved: {model}     [Eloquent $model]');
Event::fire('eloquent.deleting           [Eloquent $model]');
Event::fire('eloquent.deleting: {model}  [Eloquent $model]');
Event::fire('eloquent.deleted            [Eloquent $model]');
Event::fire('eloquent.deleted: {model}   [Eloquent $model]');
Event::first('500');
Event::first('404');


Event::listen('404', function()
{
    // Show a cool 404 page!
});

Event::override('404', function()
{
    // Provide a different, but just as awesome, 404 page!
});
