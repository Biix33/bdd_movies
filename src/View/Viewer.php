<?php


namespace DBMOVIE\View;


class Viewer
{
    public static function render($path, $view, $params = [])
    {
        extract($params);
        ob_start();
        require_once $path . "" . $view . ".php";
        $content = ob_get_clean();
        return require_once '../template/template.php';
    }

    public static function render404()
    {
        return require_once '../template/404.php';
    }

    public static function redirect($route)
    {
        return header('Location: ' . "/" . $route);
    }
}