<?php require_once("../include/header.php")?>
<?php
    require_once("../core/class/formValidator.php");

    if (isset($_POST["register-submit"])) {

        
        $formData = [
            "firstname" => $_POST["firstname"],
            "lastname" => $_POST["lastname"],
            "username" => $_POST["username"],
            "email" => $_POST["email"],
            "confirmemail" => $_POST["confirmemail"],
            "password" => $_POST["password"],
            "confirmpassword" => $_POST["confirmpassword"],
        ];
        $validator = new FormValidatior($formData);
        $validator
            ->required("firstname", "First Name is required!")
            ->required("lastname", "Last Name is required!")

            ->required("username", "User Name is required!")
            ->minmax("username", 5,13)
            
            ->required("email", "Email is required!")
            ->email("email", "Email is required!")
            ->confirm("email", "confirmemail", "Emails do not match!")
            
            ->required("password", "Password is required!")
            ->minmax("password", 8,13)
            ->confirm("password", "confirmpassword", "Emails do not match!");

            
            
        echo $validator->hasErrors();
        print_r($validator->getErrors());
        print_r($validator->getData());
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
                    <input value="<?php echo $validator->getData()["firstname"]?>" name="firstname"  id="register-firstname-input" type="text" placeholder="First Name" />
                    <?php if ($validator->hasErrors("firstname")) echo $validator->getErrors()["firstname"] ?>
                </label>
                <label for="register-lastname-input">
                    <input value="<?php echo $validator->getData()["lastname"]?>" name="lastname" id="register-lastname-input" type="text" placeholder="Last Name" />
                    <?php if ($validator->hasErrors("lastname")) echo $validator->getErrors()["lastname"] ?>
                </label>
                <label for="register-username-input">
                    <input value="<?php echo $validator->getData()["username"]?>" id="register-username-input" name="username" type="text" placeholder="User Name" />
                    <?php if ($validator->hasErrors("username")) echo $validator->getErrors()["username"] ?>
                </label>
                <label for="register-email-input">
                    <input value="<?php echo $validator->getData()["email"]?>" id="register-email-input" name="email" type="text" placeholder="Email" />
                    <?php if ($validator->hasErrors("email")) echo $validator->getErrors()["email"] ?>
                </label>
                <label for="register-confirmemail-input">
                    <input value="<?php echo $validator->getData()["confirmemail"]?>" id="register-confirmemail-input" name="confirmemail" type="text" placeholder="Confirm Email" />
                    <?php if ($validator->hasErrors("confirmemail")) echo $validator->getErrors()["confirmemail"] ?>
                </label>
                <label for="register-password-input">
                    <input value="<?php echo $validator->getData()["password"]?>" id="register-password-input" name="password" type="text" placeholder="Password" />
                    <?php if ($validator->hasErrors("password")) echo $validator->getErrors()["password"] ?>
                </label>
                <label for="register-confirmpassword-input">
                    <input value="<?php echo $validator->getData()["confirmpassword"]?>" id="register-confirmpassword-input" name="confirmpassword" type="text" placeholder="Confirm Password" />
                    <?php if ($validator->hasErrors("confirmpassword")) echo $validator->getErrors()["confirmpassword"] ?>
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