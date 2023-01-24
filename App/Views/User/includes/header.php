<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>


<!DOCTYPE html>
<html lang="fr-fr" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="                            " />

    <!-- here to find the links for adaptated icons -->
    <link href="/ressources/icons/touch-icon.png" rel="apple-touch-icon" />
    <link href="/ressources/icons/favicon.ico" rel="icon" type="image/png" />

    <!-- here to find the links for CSS stylesheet -->
    <link href="../../Public/Storage/assets/media/css/font_awesome/fontawesome.all.min.css" rel="stylesheet" />

    <link href="../../Public/Storage/assets/media/css/normalize.css" rel="stylesheet" />
    <link href="../../Public/Storage/assets/media/css/index.css" rel="stylesheet" />
    <link rel="stylesheet" href="/Storage/Css/theme.css">
    <!--favicon-->
    <link rel="shortcut icon" href="/Storage/Assets/Images/favicon.png" type="image/png">
    <!--font awesome cdn links-->
    <!-- <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script> -->


    <!-- here to find the links for @font-faces -->
    <link href="../../Public/Storage/assets/media/css/fontfaces.css" rel="stylesheet" />


    <!-- here to find the links for @media stylesheet -->
    <link href="../../Public/Storage/assets/media/css/media.css" rel="stylesheet" media="all">
    <!-- #### -->
    <link href="print.css" rel="stylesheet" media="print">
    <link href="mobile.css" rel="stylesheet" media="all">
    <link href="desktop.css" rel="stylesheet" media="screen and (min-width: 600px)">
    <link href="highres.css" rel="stylesheet" media="screen and (min-resolution: 300dpi)">

    <title>Cutie's Blog | Home</title>

</head>


<body>

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