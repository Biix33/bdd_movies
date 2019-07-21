<!DOCTYPE html>
<html lang="FR-fr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <base href="http://bdd-films.bix.lan/">
</head>

<body>
    <div class="container-fluid">
        <header class="jumbotron">
            <h1 class="title text-center"><a class="btn-block" href="/home">Welcome Media Store</a></h1>
        </header>
        <?php require_once 'includes/_navbar.php'?>
    </div>
    <div class="container">
        <div class="row">
            <?=$content?>
        </div>
    </div>
</body>

</html>