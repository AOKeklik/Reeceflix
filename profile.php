<?php require_once ("includes/header.php")?>

<?php
    $userMessage = "";

    if (isset ($_POST["profile-user-submit"])) {
        $firstName = FormSanitizer::sanitizeFromString($_POST["firstName"]);
        $lastName = FormSanitizer::sanitizeFromString($_POST["lastName"]);
        $userName = FormSanitizer::sanitizeFromString($_POST["userName"]);
        $userNameNew = FormSanitizer::sanitizeFromString($_POST["userNameNew"]);

        if ($account->updateUser ($firstName, $lastName, $userName, $userNameNew, $userLoggedIn)) {
            $userMessage = '<div class="mb-4 bg-sky-400"><p class="text-white text-1.5 p-2">User info updated successfully.</p></div>';
        } else {
            $userMessage = '<div class="mb-4 bg-red-400"><p class="text-white text-1.5 p-2">'.$account->getFirstError().'</p></div>';
        }
    }

    $passMessage = "";

    if (isset ($_POST["profile-pass-submit"])) {
        $oldpass = FormSanitizer::sanitizeFromString($_POST["oldpassword"]);
        $pass = FormSanitizer::sanitizeFromString($_POST["newpassword"]);
        $pass2 = FormSanitizer::sanitizeFromString($_POST["confirmnewpassword"]);

        if ($account->updatePassword ($oldpass, $pass, $pass2, $userLoggedIn)) {
            $passMessage = '<div class="mb-4 bg-sky-400"><p class="text-white text-1.5 p-2">User password updated successfully.</p></div>';
        } else {
            $passMessage = '<div class="mb-4 bg-red-400"><p class="text-white text-1.5 p-2">'.$account->getFirstError().'</p></div>';
        }
    }

    $user = new User ($pdo, $userLoggedIn);

    $firstName = isset($_POST["firstName"]) ? $_POST["firstName"] : $user->firstName();
    $lastName = isset($_POST["lastName"]) ? $_POST["lastName"] : $user->lastName();
    $userName = isset($_POST["userName"]) ? $_POST["userName"] : $user->userName();


?>

<main>

    <section class="w-70 mx-auto my-10 p-5 bg-white">
        <div class="w-30 mb-2">
            <img src="<?php echo BASE_URL?>assets/img/logo.png" alt="">
        </div>
        <div class="mb-4">
            <h2 class="text-3 mb-1">User Details</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, doloribus?</p>
        </div>
        <?php echo $userMessage?>
        <form action="profile" method="post" class="flex-column gap-2 mb-4">
            <label for="profile-firstname-input">
                <input value="<?php echo $firstName?>" name="firstName"  id="profile-firstname-input" type="text" placeholder="First Name" />
            </label>
            <label for="profile-lastname-input">
                <input value="<?php echo $lastName?>" name="lastName" id="profile-lastname-input" type="text" placeholder="Last Name" />
            </label>
            <label for="register-username-input">
                <input value="<?php echo $userName?>" id="register-username-input" name="userName" type="text" placeholder="User Name" />
            </label>
            <label for="register-username-input">
                <input value="" id="register-userNameNew-input" name="userNameNew" type="text" placeholder="User Name" />
            </label>
            <div class="text-center">
                <input class="btn btn-sm btn-primary btn-overlay" name="profile-user-submit" type="submit" value="Save">
            </div>
        </form>
    </section>

    <section class="w-70 mx-auto my-10 p-5 bg-white">
        <div class="w-30 mb-2">
            <img src="<?php echo BASE_URL?>assets/img/logo.png" alt="">
        </div>
        <div class="mb-4">
            <h2 class="text-3 mb-1">Password</h2>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, doloribus?</p>
        </div>
        <?php echo $passMessage?>
        <form action="profile" method="post" class="flex-column gap-2 mb-4">
            <label for="profile-oldpassword-input">
                <input value="" id="profile-oldpassword-input" name="oldpassword" type="text" placeholder="Old Password" />
            </label>
            <label for="profile-newpassword-input">
                <input value="" id="profile-newpassword-input" name="newpassword" type="text" placeholder="New Password" />
            </label>
            <label for="profile-confirmnewpassword-input">
                <input value="" id="profile-confirmnewpassword-input" name="confirmnewpassword" type="text" placeholder="Confirm New Password" />
            </label>
            <div class="text-center">
                <input class="btn btn-sm btn-primary btn-overlay" name="profile-pass-submit" type="submit" value="Save">
            </div>
        </form>
    </section>

</main>

<?php require_once ("includes/footer.php")?>