<?php
require dirname(__DIR__).'/vendor/autoload.php';

use DBMOVIE\Router\Route;
use DBMOVIE\Router\Router;

$route =(isset($_GET['page'])) ? new Route($_GET['page']) : new Route('home');
Router::renderRouter($route);
/*try {
    if (isset($_GET['db'])) {
        $db = strip_tags($_GET['db']);
        if (isset($_GET['action'])) {
            $action = strip_tags($_GET['action']);
            if ($action === 'getmovie') {
                if (isset($_GET['id'])) {
                    $id = strip_tags($_GET['id']);
                    MovieController::getMovie($db, $id);
                    if (isset($_POST['update'])) {
                        $data = [
                            'id' => $id,
                            'title' => $_POST['dvd_title'],
                            'no_dvd' => $_POST['no_dvd'],
                            'year' => $_POST['year'],
                            'genre' => $_POST['genre'],
                            'duration' => $_POST['duration'],
                            'link_allocine' => $_POST['link_allocine'],
                        ];
                        MovieController::updateMovie($db, $data);
                    }
                }
            } elseif ($action === 'addmovie') {
                addMovie($db);
                if (isset($_POST['title']) && !empty($_POST['title'])) {
                    // je suis arreté ici dans l'ajout d'un nouveau film dans la base
                }
            }
        } elseif (isset($_GET['search'])) {
            $q = strip_tags($_GET['search']);
            MovieController::search($db, $q);
        } elseif (isset($_GET['page']) && !empty($_GET['page']) && $_GET['page'] > 0) {
            $page = intval($_GET['page']);
            MovieController::getMoviesOnPage($db, $page);
        } else {
            MovieController::getMoviesOnPage($db);
        }
    } else {
        require_once dirname(__DIR__).'/template/frontend/home.php';
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require_once 'template/frontend/error.php';
}*/