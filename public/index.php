<?php
require_once dirname(__DIR__) . '/Config/constants.php';
require_once BASE_DIR . '/vendor/autoload.php';
require_once BASE_DIR . '/Config/functions.php';

$dotenv = \Dotenv\Dotenv::createUnsafeImmutable(BASE_DIR);
$dotenv->load();

if (!session_id()) {
    session_start();
}

$fields = ['name' => 'test'];
//dd(\App\Models\UserModel::all());
//dd(\App\Models\UserModel::find(5));
//dd(\App\Models\UserModel::find(5)->get());
//dd(\App\Models\UserModel::findBy('name', 'test'));
//dd(\App\Models\UserModel::findBy('name', 'test')->get());
//dd(\App\Models\UserModel::findBy('name', 'test'))->update();
//dd(\App\Models\UserModel::select()->where('age', '>', 12)->where('name', '=', 'test', 'OR')->get());
//dd(\App\Models\UserModel::select()->where('age', '>', 80)->get());

//dd(\App\Models\UserModel::create(['age' => 34, 'name' => '123']));
//dd(\App\Models\UserModel::find(15)->update(['age' => 1]));
//dd(\App\Models\UserModel::delete(15));


try {
    $router = new \Core\Router();

    require_once BASE_DIR . '/routes/web.php';

    if (!preg_match('/assets/i', $_SERVER['REQUEST_URI'])) {
        $router->dispatch($_SERVER['REQUEST_URI']);
    }
} catch (Exception $exception) {
    dd($exception->getMessage());
}

