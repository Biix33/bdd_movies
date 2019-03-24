<?php
require_once 'DbManager.php';

class MovieManager extends Dbconfig
{
    private $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function getMovies()
    {
        $q = parent::dbConnect()->query('SELECT * FROM ' . $this->table . ' ORDER BY id LIMIT 0, 15');
        return $q->fetchAll();
    }

    public function count()
    {
        $count = parent::dbConnect()->query('SELECT id FROM ' . $this->table . '');
        return $count->rowCount();
    }

    public function getMovie($id)
    {
        $movie = parent::dbConnect()->prepare('SELECT * FROM ' . $this->table . ' WHERE id= ?');
        $movie->execute(array($id));
        return $movie;
    }

    public function addMovie($title, $noDvd, $year = '', $genre = '', $duration = '', $link_allocine = '')
    {
        if (empty($title)) {
            throw new Exception('Merci de rajouter au moins un titre pour votre film');
        }
        $newMovie = parent::dbConnect()->prepare('INSERT INTO ' . $this->table . '(title, no_dvd, year, genre, duration, link_allocine) VALUES(?, ?, ?, ?, ?, ?)');
        $affectedLines = $newMovie->execute(array($title, $noDvd, $year, $genre, $duration, $link_allocine));

        if ($affectedLines === false) {
            throw new Exception('Impossible d\'ajouter un nouveau film !');
        }
    }

    public function updateMovie($movieID, $newtitle, $newNoDvd, $newYear, $newGenre, $newDuration, $newLink)
    {
        $updateMovie = parent::dbConnect()->prepare('UPDATE ' . $this->table . ' SET title = :newtitle, no_dvd = :new_no_dvd, year = :newyear, genre = :newgenre, duration = :newduration,  link_allocine = :newlink WHERE id = :movieid');
        $updateMovie->execute(array(
            'newtitle' => $newtitle,
            'new_no_dvd' => $newNoDvd,
            'newyear' => $newYear,
            'newgenre' => $newGenre,
            'newduration' => $newDuration,
            'newlink' => $newLink,
            'movieid' => $movieID,
        ));

        if ($updateMovie === false) {
            throw new Exception('Un erreur c\'est produite lors de la mise à jour');
        }
    }

    public function updateMovieLink($movieID, $newLink)
    {
        $updateMovieLink = parent::dbConnect()->prepare('UPDATE ' . $this->table . ' SET link_allocine = :newlink WHERE id = :movieid');
        $updateMovieLink->execute(array(
            'newlink' => $newLink,
            'movieid' => $movieID,
        ));

        if ($updateMovieLink === false) {
            throw new Exception('Une erreur c\'est produite lors de la mise à jour');
        }
    }

    public function searchTitle($searchWord)
    {
        return parent::dbConnect()->query('SELECT id, title, no_dvd, year,  genre, duration, link_allocine FROM ' . $this->table . ' WHERE title LIKE "%' . $searchWord . '%" ORDER BY id DESC');
    }
}
