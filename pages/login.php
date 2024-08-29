<?php require_once("../include/header.php")?>
<?php
    if (isset($_POST["login-submit"])) {
        echo "ll";
    }
?>
<body id="page-login" class="bg-gray-100">
    <main>
        <section class="w-70 mx-auto my-10 p-5 bg-white">
            <div class="w-30 mb-2">
                <img src="../assets/img/logo.png" alt="">
            </div>
            <div class="mb-4">
                <h2 class="text-3 mb-1">Login</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, doloribus?</p>
            </div>
            <form action="login.php" method="post" class="flex-column gap-2 mb-4">
                <label for="login-email-input">
                    <input id="login-email-input" name="email" type="text" placeholder="Email" />
                    <p class="login-email-error text-red-400 text-1.3 pt-05">Lorem ipsum dolor sit amet.</p>
                </label>
                <label for="login-password-input">
                    <input id="login-password-input" name="password" type="text" placeholder="Password" />
                    <p class="login-password-error text-red-400 text-1.3 pt-05">Lorem ipsum dolor sit amet.</p>
                </label>
                <div class="text-center">
                    <input class="btn btn-sm btn-primary btn-overlay" name="login-submit" type="submit" value="Login">
                </div>
            </form>
            <p class="text-right">
               Need an account <a class="text-sky-400 hover:text-sky-700 bold" href="register.php">Register</a> here.
            </p>
        </section>
    </main>













<?php require_once("../include/footer.php")?>