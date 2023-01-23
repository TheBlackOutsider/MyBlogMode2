<?php require_once "../App/Views/User/includes/header.php"; ?>




<main class="loginPage">

    <form action="/login" method="post">

        <fieldset>
            <div class="inputBox">
                <input type="email" name="email" id="email" placeholder="Insert your email...">
            </div>
            <div class="inputBox">
                <input type="password" name="pwd" id="pwd" placeholder="Insert your password">
            </div>
        </fieldset>
        <fieldset>
            <div class="inputBox">
                <label for="keep_conn">Keep connected</label>
                <input type="checkbox" name="keep_conn" id="keep_conn">
            </div>
            <div class="inputBox">
                <input type="submit" name="sign_in" value="se connecter">
            </div>
        </fieldset>
        <div>
            <p>Don't have an account? Please<a href="/sign-up"> Sign-up.</a></p>
        </div>

    </form>
</main>




<?php require_once "../App/Views/User/includes/footer.php"; ?>