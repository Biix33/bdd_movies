<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li class="dropdown-movie">
            <a data-toggle="dropdown" class="" href="#">Films <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/movies">Tous</a></li>
                <li><a href="/add-movie">Ajouter</a></li>
            </ul>
        </li>
        <li class="dropdown-tvshow">
            <a data-toggle="dropdown" class="" href="#">Séries <b class="caret"></b></a>
            <ul class="dropdown-menu">
                <li><a href="/tv-shows">Toutes</a></li>
                <li><a href="/add-tv-show">Ajouter</a></li>
            </ul>
        </li>
    </ul>

    <form action="/search" class="navbar-form navbar-right inline-form" method="get">
        <div class="form-group">
            <label for="q"></label>
            <input class="input-sm form-control" id="q" name="q" placeholder="Rechercher" type="search">
            <button type="submit" class="btn btn-default btn-sm"><span
                        class="glyphicon glyphicon-eye-open"></span>
                Rechercher
            </button>
        </div>
    </form>
</nav>