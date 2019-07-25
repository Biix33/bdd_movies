<?php
    require_once "../api-allocine-helper.php";
    
    // Construct the object
    $allohelper = new AlloHelper;
    
    // Get the movie code
    echo "Movie code: ";
    
    // Get the code
    $code = (int) fgets(STDIN);
    
    try
    {
        // Request
        $movie = $allohelper->movie($code);
        
        echo 'Title : ' . $tvShow->title . PHP_EOL;
        echo 'Synopsis : ' . $tvShow->synopsis . PHP_EOL;
        echo 'Poster URL : ' . $tvShow->poster . PHP_EOL;
    }
    
    // Error
    catch (ErrorException $e)
    {
        echo "Error " . $e->getCode() . ": " . $e->getMessage() . PHP_EOL;
    }
?>
