<nav class="navbar navbar-inverse">
    <ul class="nav navbar-nav">
        <li><a class="" href="movies">Films</a></li>
        <li><a class="" href="tvshows">Séries</a></li>
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