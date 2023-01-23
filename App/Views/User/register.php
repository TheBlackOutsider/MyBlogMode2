<?php
require_once "../App/Views/User/includes/header.php";

?>


<main class="registrationPage"  id="registrationPage">

    <form action="/register" method="post">

        <fieldset>
            <div class="inputBox">
                <input type="text" name="fname" id="fname" maxlength="40" placeholder="Dear, your name" required>
            </div>
            <div class="inputBox">
                <input type="text" name="lname" id="lname" maxlength="40" placeholder="Dear, your lastname" required>
            </div>
            <div class="inputBox">
                <input type="date" name="bday" placeholder="Insert your birthday">
            </div>

        </fieldset>
        <fieldset>
            <div class="inputBox">
                <input type="email" name="email" id="email" maxlength="50" placeholder="Insert your email..." required>
            </div>
            <div class="inputBox">
                <input type="password" name="pwd" id="pwd" placeholder="your password" required>
            </div>
            <div class="inputBox">
                <input type="password" name="confPwd" id="confPwd" required placeholder="confirm your password">
            </div>

        </fieldset>
        <fieldset>
            <div class="inputBox">
                <input type="checkbox" name="keep_conn" id="keep_conn" placeholder="Keep connected">
            </div>

            <div class="inputBox">
            <input type="submit" name="sign_up" value="s'inscrire" disabled>
            </div>

        </fieldset>
        <div class="inputBox">
            <p>Already registered ? Please <a href="/sign-in">Sign in</a></p>
        </div>


    </form>

</main>


<?php
require_once "../App/Views/User/includes/footer.php";

?>