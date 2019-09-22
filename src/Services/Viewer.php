<?php


namespace DBMOVIE\Services;


class Viewer
{
    const TEMPLATE_PATH = '../template/';
    const TEMPLATE_BASE = '../template/template.php';

    public static function render($view, $params = [])
    {
        extract($params);
        ob_start();
        require_once self::TEMPLATE_PATH."{$view}.php";
        $content = ob_get_clean();
        return require_once self::TEMPLATE_BASE;
    }

    public static function render404()
    {
        return require_once '../template/error404.php';
    }

    public static function redirect($route)
    {
        return header('Location: ' . "/" . $route);
    }
}