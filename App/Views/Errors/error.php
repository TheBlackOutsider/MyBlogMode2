<!-- include header -->
<?php require_once "../App/Views/User/includes/header.php"; ?>
<!-- main -->
<script>
    document.title = "Build Resume | ERROR";
</script>
<main class="ErrorPage">
    <?php if (isset($msgType["error"])) :; ?>
        <h1>Error: $error</h1>
        <h2>Code: $code</h2>
    <?php endif; ?>
</main>
<!-- include footer -->
<?php require_once "../App/Views/User/includes/footer.php"; ?>
</body>

</html>


<header>
    <!--logo-->
    <h1 class="logo">br</h1>
    <!--navigation-->
    <nav>
        <ul class="navigation">
            <li>
                <a href="index" id="homePageLink">
                    <i class="fa-solid fa-house"></i>
                    <span> accueil</span>
                </a>

            </li>
            <li>
                <a href="builder" id="builderPageLink">
                    <i class="fa-regular fa-pen-to-square"></i>
                    <span>créer</span>
                </a>

            </li>

            <li>
                <a href="feedback" id="feedbackPageLink">
                    <i class="fa-solid fa-solid fa-message"></i>
                    <span>feedback</span>
                </a>

            </li>
            <li>
                <?php if (isset($_SESSION["user_role"])) : ?>
                    <a href="/profil" id="showAccountBtn" class="showAccountBtn">
                        <i class="fa-solid fa-user"></i>
                        <span>mon compte</span>
                    </a>
                <?php else : ?>
                    <a href="sign-in">
                        <i class="fa-solid fa-sign-in"></i>
                        <span>Se connecter</span>
                    </a>
                <?php endif; ?>
            </li>
        </ul>
    </nav>

    <!-- account dashboard -->
    <?php if (isset($_SESSION['user_id'])) : ?>
        <div class="accountModal" id="accountModal">
            <span class="closeShowAccount" id="closeShowAccount">
                <i class="fa-solid fa-close"></i>
            </span>
            <ul>
                <!-- profil -->
                <div class="profil"><?= $_SESSION['user_profil']; ?></div>
                <div class="name"> <?= $_SESSION['user_name']; ?> </div>
                <!-- show dashboard if user is admin-->
                <?php if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 0) : ?>
                    <li>
                        <a href="dashboard">
                            <i class="fa-solid fa-dashboard"></i>
                            <span>dashbord</span>
                        </a>
                    </li>
                <?php endif ?>
                <!-- show link if user is connected -->
                <?php if (isset($_SESSION['user_id'])) : ?>
                    <li>
                        <a href="mes-cv/<?= $_SESSION['user_id']; ?>">
                            <i class="fa-solid fa-book"></i>
                            <span>Mes cv</span>
                        </a>
                    </li>
                    <li>
                        <a href="profil/<?= $_SESSION['user_id']; ?>">
                            <i class="fa-solid fa-edit"></i>
                            <span>Informations perssonnelles</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout">
                            <i class="fa-solid fa-sign-out"></i>
                            <span>Déconnexion</span>
                        </a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    <?php endif ?>
</header>