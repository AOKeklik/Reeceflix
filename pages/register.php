<?php require_once("../include/header.php")?>
<?php
    if (isset($_POST["register-submit"])) {
        echo "ll";
    }
?>
<body id="page-register" class="bg-gray-100">
    <main>
        <section class="w-70 mx-auto my-10 p-5 bg-white">
            <div class="w-30 mb-2">
                <img src="../assets/img/logo.png" alt="">
            </div>
            <div class="mb-4">
                <h2 class="text-3 mb-1">Sign Up</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, doloribus?</p>
            </div>
            <form action="register.php" method="post" class="flex-column gap-2 mb-4">
                <label for="register-firstname-input">
                    <input id="register-firstname-input" name="firstname" type="text" placeholder="First Name" />
                    <p class="register-firstname-error text-red-400 text-1.3 pt-05">Lorem ipsum dolor sit amet.</p>
                </label>
                <label for="register-lastname-input">
                    <input id="register-lastname-input" name="lastname" type="text" placeholder="Last Name" />
                    <p class="register-lastname-error text-red-400 text-1.3 pt-05">Lorem ipsum dolor sit amet.</p>
                </label>
                <label for="register-username-input">
                    <input id="register-username-input" name="username" type="text" placeholder="User Name" />
                    <p class="register-username-error text-red-400 text-1.3 pt-05">Lorem ipsum dolor sit amet.</p>
                </label>
                <label for="register-email-input">
                    <input id="register-email-input" name="email" type="text" placeholder="Email" />
                    <p class="register-email-error text-red-400 text-1.3 pt-05">Lorem ipsum dolor sit amet.</p>
                </label>
                <label for="register-confirmemail-input">
                    <input id="register-confirmemail-input" name="confirmemail" type="text" placeholder="Confirm Email" />
                    <p class="register-confirmemail-error text-red-400 text-1.3 pt-05">Lorem ipsum dolor sit amet.</p>
                </label>
                <label for="register-password-input">
                    <input id="register-password-input" name="password" type="text" placeholder="Password" />
                    <p class="register-password-error text-red-400 text-1.3 pt-05">Lorem ipsum dolor sit amet.</p>
                </label>
                <label for="register-confirmpassword-input">
                    <input id="register-confirmpassword-input" name="confirmpassword" type="text" placeholder="Confirm Password" />
                    <p class="register-confirmpassword-error text-red-400 text-1.3 pt-05">Lorem ipsum dolor sit amet.</p>
                </label>
                <div class="text-center">
                    <input class="btn btn-sm btn-primary btn-overlay" name="register-submit" type="submit" value="Register">
                </div>
            </form>
            <p class="text-right">
               Already have an account <a class="text-sky-400 hover:text-sky-700 bold" href="login.php">Login</a> here.
            </p>
        </section>
    </main>













<?php require_once("../include/footer.php")?>