<?php require_once("./core/load.php")?>

<?php
    if (isset($_POST["login-submit"])) {
        $formData = [
                "email",
                "password"
         ];
         $validator->formdata($formData);
         
         $validator             
             ->required("email")
             ->email("email")
             
             ->required("password")
             ->minmax("password", 8,13);
             
             if (!$validator->hasErrors()) {
                $isLoggedIn = $user->login($validator->getData());
 
                if ($isLoggedIn) {
                    $_SESSION["userLoggedIn"] = $validator->getData("email");
                    $validator->clearData($formData);
                    header("Location: index.php");
                } else
                    $validator->custom("password", "Not exist user!");
             }
        //  echo $validator->hasErrors();
        //  print_r($validator->getErrors());
        //  print_r($validator->getData());
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reeceflix | Login</title>
    <link rel="stylesheet" href="./assets/style/style.css">
</head>
<body id="page-login" class="bg-gray-100">
    <main>
        <section class="w-70 mx-auto my-10 p-5 bg-white">
            <div class="w-30 mb-2">
                <img src="./assets/img/logo.png" alt="">
            </div>
            <div class="mb-4">
                <h2 class="text-3 mb-1">Login</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ullam, doloribus?</p>
            </div>
            <form action="login.php" method="post" class="flex-column gap-2 mb-4">
                <label for="login-email-input">
                    <input value="<?php echo $validator->getData("email")?>" id="login-email-input" name="email" type="text" placeholder="Email" />
                    <?php if ($validator->hasErrors("email")) echo $validator->getErrors("email")[0] ?>
                </label>
                <label for="login-password-input">
                    <input value="<?php echo $validator->getData("password")?>" id="login-password-input" name="password" type="text" placeholder="Password" />
                    <?php if ($validator->hasErrors("password")) echo $validator->getErrors("password")[0] ?>
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
</body>
</html>