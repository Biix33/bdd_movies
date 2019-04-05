<?php
require_once 'Controller/MovieController.php';
use DBMOVIE\Controller\MovieController;

try {
    if (isset($_GET['db'])) {
        $db = strip_tags($_GET['db']);
        if (isset($_GET['action'])) {
            $action = strip_tags($_GET['action']);
            if ($action === 'getmovie') {
                if (isset($_GET['id'])) {
                    $id = strip_tags($_GET['id']);
                    MovieController::getMovie($db, $id);
                    if (isset($_POST['update'])) {
                        if (empty($_POST['dvd_title'])) {
                            MovieController::updateMovieLink($db, $id, $_POST['link_allocine']);
                        } else {
                            MovieController::updateMovie(
                                $db,
                                $id,
                                htmlspecialchars($_POST['dvd_title']),
                                htmlspecialchars($_POST['no_dvd']),
                                htmlspecialchars($_POST['year']),
                                htmlspecialchars($_POST['genre']),
                                htmlspecialchars($_POST['duration']),
                                htmlspecialchars($_POST['link_allocine'])
                            );
                        }
                    }
                }
            } elseif ($action === 'addMovie') {
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
        require_once 'view/home.php';
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require_once 'view/frontend/error.php';
}
