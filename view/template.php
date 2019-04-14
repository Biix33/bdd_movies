<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=$title?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="../public/css/style.css" />
    <script type="text/javascript" src="../public/js/bootstrap.js">

    </script>
</head>

<body>
    <div class="container-fluid">
        <header class="jumbotron">
            <h1 class="title text-center"><a class="btn-block" href="../home">Welcome Media Store</a></h1>
        </header>
        <nav class="navbar navbar-inverse">
            <ul class="nav navbar-nav">
                <li><a class="" href="../films">Films</a></li>
                <li><a class="" href="../series">Séries</a></li>
            </ul>

            <form action="" class="navbar-form navbar-right inline-form" method="get">
                <div class="form-group">
                    <label for="table-search"></label>
                    <select name="db" id="table-search" class="input-sm form-control">
                        <option value="db_movies">Films</option>
                        <option value="tvShows">Séries</option>
                    </select>
                    <input type="search" name="search" placeholder="Rechercher" class="input-sm form-control">
                    <button type="submit" class="btn btn-default btn-sm"><span
                            class="glyphicon glyphicon-eye-open"></span>
                        Rechercher</button>
                </div>
            </form>
        </nav>
    </div>
    <div class="container">
        <div class="row">
            <?=$content?>
        </div>
    </div>
</body>

</html>