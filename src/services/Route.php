<?php 
namespace services;
class Route {

    public static function start()
    {
        $url = $_GET['url'] ?? '/'; //то что ввел пользователь в адресную строку
        $routes = require_once __DIR__ .  '/../routes.php'; // массив со всеми допустимыми маршрутами

        try {
            if(!isset($routes[$url])) {
                throw new \Exceptions\NotFoundException();
            }
            list($controllerName, $methodName) = explode('@', $routes[$url]);
            $controllerPath = 'Controllers\\' . $controllerName;
            if(!file_exists('src/' . $controllerPath . '.php')){
                // если не существут файла с контроллером
                throw new \Exceptions\AppException('Controller not Found');
            }
            $controller = new $controllerPath(); //экземпляр класса контроллера


            if(!method_exists($controller, $methodName)) {
                throw new \Exceptions\AppException('Method not Found');
            }
            $controller->$methodName();

        }
        catch (\Exceptions\NotFoundException $e) {
            \View\View::render('errors/404', [], 404);
        }
        catch (\Exceptions\AppException $e) {
            \View\View::render('errors/500', ['error' =>
                $e->getMessage()], 500);
        }
        catch (\Exceptions\DbException $e) {
            \View\View::render('errors/500', ['error' =>
                $e->getMessage()], 500);
        }

    }
}