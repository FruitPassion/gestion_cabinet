<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="/gestion_cabinet/?action=Index">
            <img src="/gestion_cabinet/static/images/logo.png" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/gestion_cabinet/?action=AffichagePatients">Patients</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/gestion_cabinet/?action=AffichageMedecins">Médecins</a>
                </li>
            </ul>
            <div class="d-flex">
                <form action="" method="post" class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Chercher utilisateur"
                           aria-label="Search" name="search">
                    <input class="btn btn-outline-success" type="submit" value="Medecin" name="nom_med">
                    <input class="btn btn-outline-success" type="submit" value="Patient" name="nom_user">
                </form>
                <div class="dropdown mx-3">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownTheme"
                            data-bs-toggle="dropdown" aria-expanded="false">
                        Changer de thème
                    </button>
                    <form method="post">
                        <ul class="dropdown-menu" aria-labelledby="dropdownTheme">
                            <li id="theme-clair">
                                <button type="submit" name="clair" class="dropdown-item">
                                    <i class="fa fa-sun-o" aria-hidden="true"></i> Theme clair
                                </button>
                            </li>
                            <li id="theme-sombre">
                                <button type="submit" name="sombre" class="dropdown-item">
                                    <i class="fa fa-moon-o" aria-hidden="true"></i> Theme Sombre
                                </button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
