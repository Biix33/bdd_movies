<!DOCTYPE html>
<html lang="FR-fr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.css"
          integrity="sha256-0XAFLBbK7DgQ8t7mRWU5BF2OMm9tjtfH945Z7TTeNIo=" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" media="screen" href="/css/style.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.js"
            integrity="sha256-29KjXnLtx9a95INIGpEvHDiqV/qydH2bBx0xcznuA6I=" crossorigin="anonymous"></script>
    <base href="<?= $_SERVER['HTTP_HOST'] ?>">
</head>

<body>
<div class="">
    <header class="jumbotron">
        <h1 class="title text-center"><a class="btn-block" href="/">Welcome Media Store</a></h1>
        <?php require_once 'includes/_navbar.php' ?>
    </header>
</div>
<div class="container">
    <div class="row">
        <?= $content ?>
    </div>
</div>
</body>
</html>