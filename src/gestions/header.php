<header>
    <!-- Header-with-burgerMenu -->
    <div class="header-s">
        <img class="logo-site" src="assets/images/logo/logoQDND.png" alt="Logo_quoi-de-neuf-doc">
        <div>
            <button class="btn-tr"><img class="menu-burger" src="assets/icones/burgermenu.png" height="40px" alt="burger-menu"></button>
        </div>
    </div>
    <!-- Burger navigation -->
    <div class="nav-burger">
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="search.php">Rechercher</a></li>
            <li><a href="about.php">A propos</a></li>
            <li><a href="#homepage-contact">Contact</a></li>
            <?php if(userLogin()): ?>
                <li><a class="user-profile-btn" href="profile-user.php">Mon Profile</a></li>
                <li><a class="connexion-btn" href="deconnexion.php"><div class="btn-style-bgm"><span>Déconnexion</span></div></a></li>
            <?php elseif(doctorLogin()): ?>
                <li><a class="doc-profile-btn" href="profile-doctor.php">Mon Profile</a></li>
                <li><a class="connexion-btn" href="deconnexion.php"><div class="btn-style-bgm"><span>Déconnexion</span></div></a></li>
            <?php else: ?>
                <li><a class="connexion-btn" href="#" role="button" data-target="#modal" data-toggle="modal"><div class="btn-style-bgm"><span>Connexion</span></div></a></li>
            <?php endif; ?>
        </ul>
    </div>
    <!-- Format header desktop -->
    <div class="header-xl">
        <img class="logo-site" src="assets/images/logo/logoQDND.png" alt="Logo_quoi-de-neuf-doc">
        <nav>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="search.php">Rechercher</a></li>
                <li><a href="about.php">A propos</a></li>
                <li><a href="#homepage-contact">Contact</a></li>
            </ul>
        </nav>
        <div class="login-pro">
            <?php if(userLogin()): ?>
                <a class="user-profile-btn" href="profile-user.php">Mon Profile</a>
                <a class="connexion-btn" href="deconnexion.php" role="button">
                    <div class="btn-style">
                        <div class="btn-style-c"><div class="btn-style-d2"></div></div>
                        <span>Déconnexion</span>
                    </div>
                </a>
            <?php elseif(doctorLogin()): ?>
                <a class="doc-profile-btn" href="profile-doctor.php">Mon Profile</a>
                <a class="connexion-btn" href="deconnexion.php" role="button">
                    <div class="btn-style">
                        <div class="btn-style-c"><div class="btn-style-d2"></div></div>
                        <span>Déconnexion</span>
                    </div>
                </a>
            <?php else: ?>
                <a class="connexion-btn" href="#" role="button" data-target="#modal" data-toggle="modal">
                    <div class="btn-style">
                        <div class="btn-style-c"><div class="btn-style-c2"></div></div>
                        <span>Connexion</span>
                    </div>
                </a>
            <?php endif; ?>
        </div>
    </div>
</header>