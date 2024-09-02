<?php require_once("./core/load.php")?>

<?php
    if (isset($_POST["register-submit"])) {
        $formData = [
                "firstName",
                "lastName",
                "userName",
                "email",
                "confirmemail",
                "password",
                "confirmpassword"
        ];
        $validator->formdata($formData);
        
        $validator
            ->required("firstName")
            ->minmax("firstName", 3,20)

            ->required("lastName")
            ->minmax("lastName", 3,20)

            ->required("userName")
            ->minmax("userName", 5,13)
            ->isExist("user", "userName", "Exist user!")
            
            ->required("email")
            ->required("confirmemail")
            ->email("email")
            ->isExist("user", "email", "Exist user!")
            ->confirm("email", "confirmemail", "Emails do not match!")
            
            ->required("password")
            ->required("confirmpassword")
            ->minmax("password", 8,13)
            ->confirm("password", "confirmpassword", "Passwords do not match!");

            
            
            if (!$validator->hasErrors()) {
                $userId = $database->create(
                    "user", 
                    $user->getFormatedRegisterFromData($validator->getData())
                );

                if ($userId) {
                    $_SESSION["userLoggedIn"] = $validator->getData("firstName");
                    // header("Location: ../index.php");

                    $validator->clearData($formData);
                }
            }
        // echo $validator->hasErrors();
        // print_r($validator->getErrors());
        // print_r($validator->getData());
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reeceflix | Register</title>
    <link rel="stylesheet" href="./assets/style/style.css">
</head>
<body id="page-register" class="bg-gray-100">
    <main>
        <section class="w-70 mx-auto my-10 p-5 bg-white">
            <div class="w-30 mb-2">
                <img src="./assets/img/logo.png" alt="">
            </div>
            <div class="mb-4">
                <h2 class="text-3 mb-1">Sign Up</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, doloribus?</p>
            </div>
            <form action="register.php" method="post" class="flex-column gap-2 mb-4">
                <label for="register-firstname-input">
                    <input value="<?php echo $validator->getData("firstName")?>" name="firstName"  id="register-firstname-input" type="text" placeholder="First Name" />
                    <?php if ($validator->hasErrors("firstName")) echo $validator->getErrors("firstName")[0] ?>
                </label>
                <label for="register-lastname-input">
                    <input value="<?php echo $validator->getData("lastName")?>" name="lastName" id="register-lastname-input" type="text" placeholder="Last Name" />
                    <?php if ($validator->hasErrors("lastName")) echo $validator->getErrors("lastName")[0] ?>
                </label>
                <label for="register-username-input">
                    <input value="<?php echo $validator->getData("userName")?>" id="register-username-input" name="userName" type="text" placeholder="User Name" />
                    <?php if ($validator->hasErrors("userName")) echo $validator->getErrors("userName")[0] ?>
                </label>
                <label for="register-email-input">
                    <input value="<?php echo $validator->getData("email")?>" id="register-email-input" name="email" type="text" placeholder="Email" />
                    <?php if ($validator->hasErrors("email")) echo $validator->getErrors("email")[0] ?>
                </label>
                <label for="register-confirmemail-input">
                    <input value="<?php echo $validator->getData("confirmemail")?>" id="register-confirmemail-input" name="confirmemail" type="text" placeholder="Confirm Email" />
                    <?php if ($validator->hasErrors("confirmemail")) echo $validator->getErrors("confirmemail")[0] ?>
                </label>
                <label for="register-password-input">
                    <input value="<?php echo $validator->getData("password")?>" id="register-password-input" name="password" type="text" placeholder="Password" />
                    <?php if ($validator->hasErrors("password")) echo $validator->getErrors("password")[0] ?>
                </label>
                <label for="register-confirmpassword-input">
                    <input value="<?php echo $validator->getData("confirmpassword")?>" id="register-confirmpassword-input" name="confirmpassword" type="text" placeholder="Confirm Password" />
                    <?php if ($validator->hasErrors("confirmpassword")) echo $validator->getErrors("confirmpassword")[0] ?>
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
</body>
</html>