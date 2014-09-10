<?php // namespace libs\Events;

// http://jasonlewis.me/article/laravel-events
// http://heera.it/

// Event::fire('laravel.done                [Response $response]');
// Event::fire('laravel.log                 [String $type, String $message]');
// Event::fire('laravel.query               [String $sql, Array $bindings, String $time]');
// Event::fire('laravel.resolving           [String $type, Mixed $object]');
// Event::fire('laravel.composing: {view}   [View $view]');
// Event::fire('laravel.started: {bundle}   [String $bundle]');
// Event::first('laravel.controller.factory [String $controller]');
// Event::first('laravel.config.loader      [String $bundle, String $file]');
// Event::first('laravel.language.loader    [String $bundle, String $language, String $file]');
// Event::until('laravel.view.loader        [String $bundle, String $view]');
// Event::until('laravel.view.engine        [View $view]');
// Event::first('laravel.view.filter        [String $content, String $path]');
// Event::fire('eloquent.saving             [Eloquent $model]');
// Event::fire('eloquent.saving: {model}    [Eloquent $model]');
// Event::fire('eloquent.updated            [Eloquent $model]');
// Event::fire('eloquent.updated: {model}   [Eloquent $model]');
// Event::fire('eloquent.created            [Eloquent $model]');
// Event::fire('eloquent.created: {model}   [Eloquent $model]');
// Event::fire('eloquent.saved              [Eloquent $model]');
// Event::fire('eloquent.saved: {model}     [Eloquent $model]');
// Event::fire('eloquent.deleting           [Eloquent $model]');
// Event::fire('eloquent.deleting: {model}  [Eloquent $model]');
// Event::fire('eloquent.deleted            [Eloquent $model]');
// Event::fire('eloquent.deleted: {model}   [Eloquent $model]');
// Event::first('500');
// Event::first('404');


App::before(function($request) {
	$path = storage_path().'/logs/query.log';
	$start = PHP_EOL.'=| '.$request->method().' '.$request->path().' |='.PHP_EOL;
	File::append($path, $start);
});

Event::listen('illuminate.query', function($sql, $bindings, $time) {
	$path = storage_path().'/logs/query.log';
	$sql = str_replace(array('%', '?'), array('%%', '%s'), $sql);
	$sql = vsprintf($sql, $bindings);
	$time_now = (new DateTime)->format('Y-m-d H:i:s');
	$log = $time_now.' | '.$sql.' | '.$time.'ms'.PHP_EOL;
	File::append($path, $log);
});

Event::listen('laravel.auth: login', function($user)
{
	$path             = storage_path().'/logs/logging.log';
	$info_server      = Func::server_data();
	$user->last_login = Carbon::now();
	$user->save();
	Session::put('ses_user_id', $user->id);
	Session::put('ses_user_rut', $user->rut);
	Session::put('ses_user_tipo', $user->tipo);
	$log = 'Login | ' . Carbon::now() . ' | ' . $user->id . ' | ' . array_get($info_server, 'IP') . ' | ' . array_get($info_server, 'BROWSER') . PHP_EOL;
	File::append($path, $log);
});

Event::listen('laravel.auth: logout', function($user)
{
	$info_server = Func::server_data();
	Session::forget('ses_user_id');
	Session::forget('ses_user_rut');
	Session::forget('ses_user_tipo');
	$path = storage_path().'/logs/logging.log';
	$log = 'Logout | ' . Carbon::now() . ' | ' . $user->id . ' | ' . array_get($info_server, 'IP') . ' | ' . array_get($info_server, 'BROWSER') . PHP_EOL;
	File::append($path, $log);
});