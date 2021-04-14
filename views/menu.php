<nav class="navbar navbar-expand fixed-top">
    <a class="navbar-brand" href="accueil?page=1">petite_annonce.com</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="accueil?page=1">Accueil<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="rechercher">Rechercher</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="inscription_users">Inscription</a>
            </li>
            <li class="nav-item">
                <?php
                if(isset($_SESSION['connecter_users']) && $_SESSION['connecter_users'] === true){
                ?>
                <a class="nav-link" href="deconnexion">Deconnexion</a>
            <li class="nav-item">
                <a class="nav-link text-warning" href="gestion_annonces">Bonjour : <?= $_SESSION['email_utilisateur']  ?></a>
            </li>
            <?php
            }else{
                ?>
                <a class="nav-link" href="connexion_users">Connexion</a>
                <?php
            }
            ?>

            </li>

        </ul>
    </div>
</nav>