
    <!-- include header -->
     <?php require_once "../App/Views/User/includes/header.php"; ?>
    <!-- main -->
    <script>
        document.title = "Build Resume | ERROR";
    </script>
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