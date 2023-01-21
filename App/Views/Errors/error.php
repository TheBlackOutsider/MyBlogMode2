<!DOCTYPE html>
<html lang="fr">

<head>
    <!--meta-->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content=" Amour DAHOU">
    <meta name="description" content="Build Resume est un outil qui vous permet de générer votre cv plus facilement.">
    <meta name="keyword" content="cv, cv builder, cv generator, cv maker">

    <!--title-->
    <title>Build Resume | ERROR</title>
    <!--style links-->
    <link rel="stylesheet" href="/Storage/Css/theme.css">
    <!--favicon-->
    <link rel="shortcut icon" href="Storage/Assets/Images/favicon.png" type="image/png">
    <!--font awesome cdn links-->
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
</head>
<!-- body -->

<body>
    <!-- include header -->
     <?php require_once "../App/Views/User/includes/header.php"; ?>
    <!-- main -->
    <main class="ErrorPage">
        <?php if(isset($msgType["error"])) : ;?>
                    <h1>Error: $error</h1>
                    <h2>Code: $code</h2>
        <?php endif;?>  
    </main>
    <!-- include footer -->
     <?php require_once "../App/Views/User/includes/footer.php"; ?>
</body>
</html>