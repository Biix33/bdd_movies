<?php
require_once 'controller/controller.php';

try {
    if (isset($_GET['db'])) {
        $db = strip_tags($_GET['db']);
        if (isset($_GET['action'])) {
            $action = strip_tags($_GET['action']);
            if ($action === 'movie') {
                if (isset($_GET['id'])) {
                    $id = strip_tags($_GET['id']);
                    getMovie($db, $id);
                    if (isset($_POST['update'])) {
                        if (empty($_POST['dvd_title'])) {
                            updateMovieLink($db, $id, $_POST['link_allocine']);
                        } else {
                            updateMovie(
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
            search($db, $q);
        } else {
            getMovies($db);
        }
    } else {
        require_once 'view/home.php';
    }
} catch (Exception $e) {
    $errorMessage = $e->getMessage();
    require_once 'view/frontend/error.php';
}
