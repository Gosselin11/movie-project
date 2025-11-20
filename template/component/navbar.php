<header>
    <nav class="container">
        <ul>
            <li><strong>Movies Project</strong></li>
        </ul>
        <ul>
            <li><strong><a href="/">Accueil</a></strong></li>
            <?php if (isset($_SESSION["connected"]) && $_SESSION["connected"] == true) : ?>
                <li>
                    <details class="dropdown">
                        <summary>
                            Categorie
                        </summary>
                        <ul dir="rtl">
                            <li><a href="/category/add">Ajouter une Categorie</a></li>
                            <li><a href="/categories">Liste des Categories</a></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details class="dropdown">
                        <summary>
                            Film
                        </summary>
                        <ul dir="rtl">
                            <li><a href="/movie/add">Ajouter un Film</a></li>
                            <li><a href="/movies">Liste des Films</a></li>
                        </ul>
                    </details>
                </li>
                <li><a href="/logout">Déconnexion</a></li>
            <?php else : ?>
                <li><a href="/login">Connexion</a></li>
                <li><a href="/register">Inscription</a></li>
            <?php endif ?>
        </ul>
    </nav>
</header>